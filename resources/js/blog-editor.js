import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import TextAlign from '@tiptap/extension-text-align';
import Image from '@tiptap/extension-image';
import { TableKit } from '@tiptap/extension-table';
import Youtube from '@tiptap/extension-youtube';
import { TextStyleKit } from '@tiptap/extension-text-style';
import Highlight from '@tiptap/extension-highlight';
import Subscript from '@tiptap/extension-subscript';
import Superscript from '@tiptap/extension-superscript';
import CharacterCount from '@tiptap/extension-character-count';

const buttonClass = 'blog-editor-button';
const editorInstances = new Map();

const createButton = (label, title, run, active = null) => {
    const button = document.createElement('button');
    button.type = 'button';
    button.className = buttonClass;
    button.textContent = label;
    button.title = title;
    button.setAttribute('aria-label', title);
    button.addEventListener('mousedown', (event) => event.preventDefault());
    button.addEventListener('click', (event) => {
        event.preventDefault();
        run(event);
    });

    if (active) button.dataset.activeCheck = active;

    return button;
};

const createSelect = (title, options, change) => {
    const select = document.createElement('select');
    select.className = 'blog-editor-select';
    select.title = title;
    select.setAttribute('aria-label', title);

    options.forEach(([value, label]) => select.add(new Option(label, value)));
    select.addEventListener('change', () => change(select.value));

    return select;
};

const createGroup = (toolbar, label) => {
    const group = document.createElement('div');
    group.className = 'blog-editor-toolbar-group';
    group.setAttribute('aria-label', label);
    toolbar.append(group);

    return group;
};

const transformWordHtml = (html) => {
    if (! html || ! /(?:class=["'][^"']*Mso|mso-|urn:schemas-microsoft)/i.test(html)) return html;

    const parsed = new DOMParser().parseFromString(html, 'text/html');
    parsed.querySelectorAll('meta, link, style, script, xml').forEach((element) => element.remove());
    parsed.querySelectorAll('*').forEach((element) => {
        const className = element.getAttribute('class') || '';
        const style = element.getAttribute('style') || '';
        const headingLevel = className.match(/MsoHeading([1-4])/i)?.[1]
            || style.match(/mso-outline-level:\s*([1-4])/i)?.[1];

        if (headingLevel && ['P', 'DIV'].includes(element.tagName)) {
            const heading = parsed.createElement(`h${headingLevel}`);
            heading.innerHTML = element.innerHTML;
            if (style) heading.setAttribute('style', style);
            element.replaceWith(heading);
            return;
        }

        const safeStyles = style.split(';').map((declaration) => declaration.trim()).filter((declaration) => {
            const property = declaration.split(':', 1)[0]?.trim().toLowerCase();
            return ['text-align', 'font-family', 'font-size', 'font-weight', 'font-style', 'color', 'background-color', 'text-decoration', 'line-height'].includes(property);
        });
        if (safeStyles.length) element.setAttribute('style', safeStyles.join('; '));
        else element.removeAttribute('style');
        element.removeAttribute('class');
        [...element.attributes].filter((attribute) => attribute.name.toLowerCase().startsWith('mso-') || attribute.name.toLowerCase().startsWith('xmlns')).forEach((attribute) => element.removeAttribute(attribute.name));
    });

    return parsed.body.innerHTML;
};

const initializeBlogEditor = (root) => {
    if (editorInstances.has(root)) return;

    const surface = root.querySelector('[data-editor-surface]');
    const toolbar = root.querySelector('[data-editor-toolbar]');
    const input = root.querySelector('[data-editor-image-input]');
    const imageDialog = root.querySelector('[data-editor-image-dialog]');
    const imageAlt = root.querySelector('[data-editor-image-alt]');
    const imageTitle = root.querySelector('[data-editor-image-title]');
    const imageError = root.querySelector('[data-editor-image-error]');
    const imageSubmit = root.querySelector('[data-editor-image-submit]');
    const linkDialog = root.querySelector('[data-editor-link-dialog]');
    const linkUrl = root.querySelector('[data-editor-link-url]');
    const linkText = root.querySelector('[data-editor-link-text]');
    const linkNewTab = root.querySelector('[data-editor-link-new-tab]');
    const linkError = root.querySelector('[data-editor-link-error]');
    const contentInput = root.querySelector('#content');
    const saveStatus = root.querySelector('[data-editor-save-status]');

    let editor;
    let paragraphStyle;

    const updateStatus = () => {
        const words = editor.storage.characterCount.words();
        const characters = editor.storage.characterCount.characters();
        root.querySelector('[data-editor-words]').textContent = words.toLocaleString();
        root.querySelector('[data-editor-characters]').textContent = characters.toLocaleString();
        root.querySelector('[data-editor-reading-time]').textContent = Math.max(1, Math.ceil(words / 200));
        contentInput.value = editor.getHTML();
        saveStatus.textContent = 'Changes ready to save';
    };

    const updateActiveButtons = () => {
        toolbar.querySelectorAll('[data-active-check]').forEach((button) => {
            const [type, value] = button.dataset.activeCheck.split(':');
            const active = value ? editor.isActive(type, { level: Number(value) || value }) : editor.isActive(type);
            button.classList.toggle('is-active', active);
            button.setAttribute('aria-pressed', active.toString());
        });

        if (paragraphStyle) {
            paragraphStyle.value = [1, 2, 3, 4].find((level) => editor.isActive('heading', { level }))?.toString()
                || (editor.isActive('blockquote') ? 'blockquote' : null)
                || (editor.isActive('codeBlock') ? 'codeBlock' : 'paragraph');
        }
    };

    editor = new Editor({
        element: surface,
        content: contentInput.value,
        extensions: [
            StarterKit.configure({
                heading: { levels: [1, 2, 3, 4] },
                link: {
                    openOnClick: false,
                    autolink: true,
                    linkOnPaste: true,
                    HTMLAttributes: { rel: 'noopener noreferrer' },
                },
            }),
            TextStyleKit,
            TextAlign.configure({ types: ['heading', 'paragraph'] }),
            Highlight.configure({ multicolor: true }),
            Image.configure({ allowBase64: false, inline: false }),
            TableKit.configure({ table: { resizable: true } }),
            Youtube.configure({ nocookie: true, modestBranding: true }),
            Subscript,
            Superscript,
            CharacterCount,
        ],
        editorProps: {
            transformPastedHTML: transformWordHtml,
            attributes: {
                class: 'blog-editor-document prose prose-zinc max-w-none focus:outline-none dark:prose-invert',
                role: 'textbox',
                'aria-multiline': 'true',
                'aria-label': 'Article body',
                spellcheck: 'true',
            },
        },
        onCreate: () => {
            updateStatus();
            saveStatus.textContent = 'Ready';
        },
        onUpdate: updateStatus,
        onSelectionUpdate: updateActiveButtons,
        onTransaction: updateActiveButtons,
    });
    editorInstances.set(root, editor);
    root.dataset.editorInitialized = 'true';

    const history = createGroup(toolbar, 'History');
    history.append(
        createButton('↶', 'Undo (Ctrl+Z)', () => editor.chain().focus().undo().run()),
        createButton('↷', 'Redo (Ctrl+Y)', () => editor.chain().focus().redo().run()),
        createButton('All', 'Select all', () => editor.chain().focus().selectAll().run()),
    );

    const text = createGroup(toolbar, 'Text formatting');
    text.append(
        createButton('B', 'Bold (Ctrl+B)', () => editor.chain().focus().toggleBold().run(), 'bold'),
        createButton('I', 'Italic (Ctrl+I)', () => editor.chain().focus().toggleItalic().run(), 'italic'),
        createButton('U', 'Underline (Ctrl+U)', () => editor.chain().focus().toggleUnderline().run(), 'underline'),
        createButton('S', 'Strikethrough', () => editor.chain().focus().toggleStrike().run(), 'strike'),
        createButton('x²', 'Superscript', () => editor.chain().focus().toggleSuperscript().run(), 'superscript'),
        createButton('x₂', 'Subscript', () => editor.chain().focus().toggleSubscript().run(), 'subscript'),
        createButton('Clear', 'Clear formatting', () => editor.chain().focus().unsetAllMarks().clearNodes().run()),
    );

    const typography = createGroup(toolbar, 'Typography');
    paragraphStyle = createSelect('Paragraph and heading style', [['paragraph', 'Paragraph'], ['1', 'Heading 1'], ['2', 'Heading 2'], ['3', 'Heading 3'], ['4', 'Heading 4'], ['blockquote', 'Blockquote'], ['codeBlock', 'Code block']], (value) => {
            const chain = editor.chain().focus();
            if (value === 'paragraph') chain.setParagraph().run();
            else if (value === 'blockquote') chain.setBlockquote().run();
            else if (value === 'codeBlock') chain.setCodeBlock().run();
            else chain.setHeading({ level: Number(value) }).run();
        });
    typography.append(
        paragraphStyle,
        createSelect('Font family', [['', 'Default font'], ['Arial', 'Arial'], ['Georgia', 'Georgia'], ['Tahoma', 'Tahoma'], ['Times New Roman', 'Times New Roman'], ['Verdana', 'Verdana']], (value) => value ? editor.chain().focus().setFontFamily(value).run() : editor.chain().focus().unsetFontFamily().run()),
        createSelect('Font size', [['', 'Font size'], ['12px', '12'], ['14px', '14'], ['16px', '16'], ['18px', '18'], ['20px', '20'], ['24px', '24'], ['30px', '30'], ['36px', '36']], (value) => value ? editor.chain().focus().setFontSize(value).run() : editor.chain().focus().unsetFontSize().run()),
        createSelect('Line spacing', [['', 'Line spacing'], ['1', '1.0'], ['1.25', '1.25'], ['1.5', '1.5'], ['1.75', '1.75'], ['2', '2.0']], (value) => value ? editor.chain().focus().setLineHeight(value).run() : editor.chain().focus().unsetLineHeight().run()),
    );

    const colors = createGroup(toolbar, 'Colors');
    const textColor = document.createElement('input');
    textColor.type = 'color';
    textColor.value = '#29231e';
    textColor.className = 'blog-editor-color';
    textColor.title = 'Text color';
    textColor.setAttribute('aria-label', 'Text color');
    textColor.addEventListener('input', () => editor.chain().focus().setColor(textColor.value).run());
    const highlightColor = textColor.cloneNode();
    highlightColor.value = '#fff1a8';
    highlightColor.title = 'Highlight color';
    highlightColor.setAttribute('aria-label', 'Highlight color');
    highlightColor.addEventListener('input', () => editor.chain().focus().setHighlight({ color: highlightColor.value }).run());
    colors.append(textColor, highlightColor);

    const alignment = createGroup(toolbar, 'Alignment');
    [['Left', 'left'], ['Center', 'center'], ['Right', 'right'], ['Justify', 'justify']].forEach(([label, value]) => {
        alignment.append(createButton(label, `Align ${value}`, () => editor.chain().focus().setTextAlign(value).run()));
    });

    const lists = createGroup(toolbar, 'Lists and indentation');
    lists.append(
        createButton('• List', 'Bulleted list', () => editor.chain().focus().toggleBulletList().run(), 'bulletList'),
        createButton('1. List', 'Numbered list', () => editor.chain().focus().toggleOrderedList().run(), 'orderedList'),
        createButton('←', 'Decrease indentation', () => editor.chain().focus().liftListItem('listItem').run()),
        createButton('→', 'Increase indentation', () => editor.chain().focus().sinkListItem('listItem').run()),
    );

    const insertion = createGroup(toolbar, 'Insert');
    const uploadButton = createButton('Upload image', 'Upload an image with alt text', () => input.click());
    insertion.append(
        uploadButton,
        createButton('Image URL', 'Insert an image from a URL', () => {
            const src = window.prompt('Image URL');
            if (! src) return;
            const alt = window.prompt('Describe the image for accessibility and SEO');
            if (! alt) return;
            const title = window.prompt('Optional image title or caption') || null;
            editor.chain().focus().setImage({ src, alt, title }).run();
        }),
        createButton('Link', 'Add or edit a link', () => {
            const previous = editor.getAttributes('link');
            const selected = editor.state.doc.textBetween(editor.state.selection.from, editor.state.selection.to, ' ');
            linkDialog.dataset.hasSelection = selected ? 'true' : 'false';
            linkUrl.value = previous.href || '';
            linkText.value = selected;
            linkNewTab.checked = previous.target === '_blank';
            linkError.classList.add('hidden');
            linkDialog.showModal();
        }),
        createButton('Unlink', 'Remove link', () => editor.chain().focus().extendMarkRange('link').unsetLink().run()),
        createButton('Table', 'Insert a 3 by 3 table', () => editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run()),
        createButton('+ Row', 'Add a table row', () => editor.chain().focus().addRowAfter().run()),
        createButton('− Row', 'Delete the current table row', () => editor.chain().focus().deleteRow().run()),
        createButton('+ Column', 'Add a table column', () => editor.chain().focus().addColumnAfter().run()),
        createButton('− Column', 'Delete the current table column', () => editor.chain().focus().deleteColumn().run()),
        createButton('Delete table', 'Delete the current table', () => editor.chain().focus().deleteTable().run()),
        createButton('—', 'Insert horizontal line', () => editor.chain().focus().setHorizontalRule().run()),
        createButton('YouTube', 'Embed a YouTube video', () => {
            const src = window.prompt('YouTube video URL');
            if (src) editor.chain().focus().setYoutubeVideo({ src, width: 640, height: 360 }).run();
        }),
    );

    uploadButton.replaceWith(createButton('Upload image', 'Upload an image with alt text', () => {
        imageError.classList.add('hidden');
        imageError.textContent = '';
        imageDialog.showModal();
    }));

    root.querySelector('[data-editor-image-cancel]').addEventListener('click', () => imageDialog.close());
    imageSubmit.addEventListener('click', async () => {
        const file = input.files[0];
        const alt = imageAlt.value.trim();
        imageError.classList.add('hidden');

        if (! file || ! alt) {
            imageError.textContent = 'Choose an image and provide meaningful alt text.';
            imageError.classList.remove('hidden');
            return;
        }

        const body = new FormData();
        body.append('alt', alt);
        body.append('title', imageTitle.value.trim());
        imageSubmit.disabled = true;
        imageSubmit.textContent = 'Preparing…';

        try {
            const uploadFile = await prepareImageFile(file);
            body.append('image', uploadFile);
            imageSubmit.textContent = 'Uploading…';
            const response = await fetch(root.dataset.uploadUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'X-CSRF-TOKEN': root.dataset.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    Accept: 'application/json',
                },
                body,
            });
            const result = await response.json().catch(() => ({}));
            if (! response.ok) {
                const validationMessage = Object.values(result.errors || {}).flat()[0];
                const fallback = response.status === 413
                    ? 'The image is too large for the server. Choose a smaller image and try again.'
                    : 'The image could not be uploaded.';
                throw new Error(validationMessage || result.message || fallback);
            }
            editor.chain().focus().setImage(result).run();
            input.value = '';
            imageAlt.value = '';
            imageTitle.value = '';
            imageDialog.close();
        } catch (error) {
            imageError.textContent = error.message;
            imageError.classList.remove('hidden');
        } finally {
            imageSubmit.disabled = false;
            imageSubmit.textContent = 'Upload and insert';
        }
    });

    root.querySelector('[data-editor-link-cancel]').addEventListener('click', () => linkDialog.close());
    root.querySelector('[data-editor-link-submit]').addEventListener('click', () => {
        const href = linkUrl.value.trim();
        const text = linkText.value.trim();

        if (! href || ! text) {
            linkError.textContent = 'Enter both the link URL and the text readers should see.';
            linkError.classList.remove('hidden');
            return;
        }

        const attributes = { href, target: linkNewTab.checked ? '_blank' : null };
        if (linkDialog.dataset.hasSelection === 'true') {
            editor.chain().focus().extendMarkRange('link').setLink(attributes).run();
        } else {
            editor.chain().focus().insertContent({ type: 'text', text, marks: [{ type: 'link', attrs: attributes }] }).run();
        }
        linkDialog.close();
    });

    const preview = root.querySelector('[data-editor-preview]');
    root.querySelector('[data-editor-preview-open]').addEventListener('click', () => {
        root.querySelector('[data-editor-preview-title]').textContent = document.querySelector('[name="title"]').value || 'Untitled article';
        root.querySelector('[data-editor-preview-meta]').textContent = `By ${document.documentElement.dataset.userName || 'Curtains Kenya'} · ${new Intl.DateTimeFormat(undefined, { dateStyle: 'long' }).format(new Date())}`;
        root.querySelector('[data-editor-preview-body]').innerHTML = editor.getHTML();

        const previewImage = root.querySelector('[data-editor-preview-image]');
        const featuredImage = document.querySelector('[name="featured_image"]')?.files?.[0];
        const imageUrl = featuredImage ? URL.createObjectURL(featuredImage) : root.dataset.existingFeaturedImage;
        previewImage.classList.toggle('hidden', !imageUrl);
        previewImage.src = imageUrl || '';
        previewImage.alt = document.querySelector('[name="featured_image_alt"]')?.value || '';
        preview.showModal();
    });
    root.querySelector('[data-editor-preview-close]').addEventListener('click', () => preview.close());
    preview.addEventListener('click', (event) => {
        if (event.target === preview) preview.close();
    });

    root.closest('form').addEventListener('submit', () => {
        contentInput.value = editor.getHTML();
        saveStatus.textContent = 'Saving…';
    });
};

const initializeBlogEditors = () => {
    document.querySelectorAll('[data-blog-editor]').forEach((root) => {
        try {
            initializeBlogEditor(root);
        } catch (error) {
            root.dataset.editorInitialized = 'failed';
            const status = root.querySelector('[data-editor-save-status]');
            if (status) status.textContent = 'Editor failed to start. Refresh this page.';
            console.error('Blog editor initialization failed.', error);
        }
    });

    document.querySelectorAll('[data-blog-category-select]').forEach((select) => {
        if (select.dataset.categoryChoiceInitialized === 'true') return;
        select.dataset.categoryChoiceInitialized = 'true';
        const categoryName = document.querySelector('[data-blog-category-name]');
        select.addEventListener('change', () => {
            if (select.value) categoryName.value = '';
        });
        categoryName.addEventListener('input', () => {
            if (categoryName.value.trim()) select.value = '';
        });
    });
};

const prepareImageFile = async (file) => {
    if (file.size <= 1_800_000) return file;

    const bitmap = await createImageBitmap(file);
    const scale = Math.min(1, 2000 / Math.max(bitmap.width, bitmap.height));
    const canvas = document.createElement('canvas');
    canvas.width = Math.round(bitmap.width * scale);
    canvas.height = Math.round(bitmap.height * scale);
    canvas.getContext('2d').drawImage(bitmap, 0, 0, canvas.width, canvas.height);
    bitmap.close();

    const blob = await new Promise((resolve, reject) => {
        canvas.toBlob((result) => result ? resolve(result) : reject(new Error('The image could not be prepared.')), 'image/webp', 0.86);
    });

    return new File([blob], `${file.name.replace(/\.[^.]+$/, '')}.webp`, { type: 'image/webp' });
};

document.addEventListener('livewire:navigating', () => {
    editorInstances.forEach((editor, root) => {
        editor.destroy();
        root.removeAttribute('data-editor-initialized');
    });
    editorInstances.clear();
});

document.addEventListener('DOMContentLoaded', initializeBlogEditors);
document.addEventListener('livewire:navigated', initializeBlogEditors);
