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

const createButton = (label, title, run, active = null) => {
    const button = document.createElement('button');
    button.type = 'button';
    button.className = buttonClass;
    button.textContent = label;
    button.title = title;
    button.setAttribute('aria-label', title);
    button.addEventListener('click', run);

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

const initializeBlogEditor = (root) => {
    if (root.dataset.editorInitialized === 'true') return;
    root.dataset.editorInitialized = 'true';

    const surface = root.querySelector('[data-editor-surface]');
    const toolbar = root.querySelector('[data-editor-toolbar]');
    const input = root.querySelector('[data-editor-image-input]');
    const contentInput = root.querySelector('#content');
    const saveStatus = root.querySelector('[data-editor-save-status]');

    let editor;

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
    typography.append(
        createSelect('Paragraph and heading style', [['paragraph', 'Paragraph'], ['1', 'Heading 1'], ['2', 'Heading 2'], ['3', 'Heading 3'], ['4', 'Heading 4'], ['blockquote', 'Blockquote'], ['codeBlock', 'Code block']], (value) => {
            const chain = editor.chain().focus();
            if (value === 'paragraph') chain.setParagraph().run();
            else if (value === 'blockquote') chain.toggleBlockquote().run();
            else if (value === 'codeBlock') chain.toggleCodeBlock().run();
            else chain.toggleHeading({ level: Number(value) }).run();
        }),
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
            const href = window.prompt('Link URL (internal links may start with /)', previous.href || 'https://');
            if (! href) return;
            const selected = editor.state.doc.textBetween(editor.state.selection.from, editor.state.selection.to, ' ');
            const linkText = selected || window.prompt('Link text');
            if (! linkText) return;
            const newTab = window.confirm('Open this link in a new tab?');
            const attributes = { href, target: newTab ? '_blank' : null };
            if (selected) editor.chain().focus().extendMarkRange('link').setLink(attributes).run();
            else editor.chain().focus().insertContent({ type: 'text', text: linkText, marks: [{ type: 'link', attrs: attributes }] }).run();
        }),
        createButton('Unlink', 'Remove link', () => editor.chain().focus().extendMarkRange('link').unsetLink().run()),
        createButton('Table', 'Insert a 3 by 3 table', () => editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run()),
        createButton('+ Row', 'Add a table row', () => editor.chain().focus().addRowAfter().run()),
        createButton('+ Column', 'Add a table column', () => editor.chain().focus().addColumnAfter().run()),
        createButton('Delete table', 'Delete the current table', () => editor.chain().focus().deleteTable().run()),
        createButton('—', 'Insert horizontal line', () => editor.chain().focus().setHorizontalRule().run()),
        createButton('YouTube', 'Embed a YouTube video', () => {
            const src = window.prompt('YouTube video URL');
            if (src) editor.chain().focus().setYoutubeVideo({ src, width: 640, height: 360 }).run();
        }),
    );

    input.addEventListener('change', async () => {
        const file = input.files[0];
        if (! file) return;
        const alt = window.prompt('Describe this image for accessibility and SEO');
        if (! alt) {
            input.value = '';
            return;
        }
        const title = window.prompt('Optional image title or caption') || '';
        const body = new FormData();
        body.append('image', file);
        body.append('alt', alt);
        body.append('title', title);
        uploadButton.disabled = true;
        uploadButton.textContent = 'Uploading…';

        try {
            const response = await fetch(root.dataset.uploadUrl, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': root.dataset.csrfToken, Accept: 'application/json' },
                body,
            });
            if (! response.ok) throw new Error('The image could not be uploaded.');
            const image = await response.json();
            editor.chain().focus().setImage(image).run();
        } catch (error) {
            window.alert(error.message);
        } finally {
            uploadButton.disabled = false;
            uploadButton.textContent = 'Upload image';
            input.value = '';
        }
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
    document.querySelectorAll('[data-blog-editor]').forEach(initializeBlogEditor);
};

document.addEventListener('DOMContentLoaded', initializeBlogEditors);
document.addEventListener('livewire:navigated', initializeBlogEditors);
