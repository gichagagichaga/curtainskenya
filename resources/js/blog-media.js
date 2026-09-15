import Youtube from '@tiptap/extension-youtube';
import Image from '@tiptap/extension-image';

export const ArticleImage = Image.extend({
    addAttributes() {
        return { ...this.parent(), caption: { default: null, rendered: false, parseHTML: element => element.closest('figure')?.querySelector('figcaption')?.textContent || null } };
    },
    parseHTML() { return [{ tag: 'img[src]' }]; },
    renderHTML(props) {
        const image = this.parent(props);
        return props.node.attrs.caption ? ['figure', {}, image, ['figcaption', {}, props.node.attrs.caption]] : image;
    },
});

export const ArticleYoutube = Youtube.extend({
    addAttributes() {
        return { ...this.parent(),
            title: { default: 'YouTube video', parseHTML: element => element.getAttribute('title') || 'YouTube video' },
            caption: { default: null, rendered: false, parseHTML: element => element.closest('figure')?.querySelector('figcaption')?.textContent || null },
        };
    },
    parseHTML() { return [{ tag: 'iframe[src*="youtube.com/embed/"]' }, { tag: 'iframe[src*="youtube-nocookie.com/embed/"]' }]; },
    renderHTML(props) {
        const rendered = this.parent(props);
        return ['figure', {}, rendered[2], ...(props.node.attrs.caption ? [['figcaption', {}, props.node.attrs.caption]] : [])];
    },
});

export function installVideoDialog(root, editor, button, deleteButton) {
    const dialog = document.createElement('dialog');
    dialog.className = 'blog-heading-dialog';
    dialog.setAttribute('aria-label', 'YouTube video');
    dialog.innerHTML = `<h2>YouTube video</h2><div class="blog-heading-fields"><label>Video URL<input data-url type="url" required></label><label>Alternative description / accessible title<input data-title maxlength="255" required></label><label>Caption (optional)<input data-caption maxlength="255"></label></div><p data-error role="alert"></p><div class="blog-heading-actions"><button type="button" data-cancel>Cancel</button><button type="button" data-apply>Apply video</button></div>`;
    root.append(dialog);
    const videoChoice = document.createElement('select');
    videoChoice.setAttribute('aria-label', 'Existing video or new video');
    dialog.querySelector('h2').after(videoChoice);
    const remove = document.createElement('button');
    remove.type = 'button';
    remove.textContent = 'Delete selected video';
    dialog.querySelector('.blog-heading-actions').prepend(remove);
    let selectedPosition = null;
    let selection;
    button.addEventListener('click', () => {
        selection = { from: editor.state.selection.from, to: editor.state.selection.to };
        selectedPosition = editor.isActive('youtube') ? editor.state.selection.from : null;
        const attrs = editor.getAttributes('youtube');
        dialog.querySelector('[data-url]').value = attrs.src || '';
        dialog.querySelector('[data-title]').value = attrs.title || '';
        dialog.querySelector('[data-caption]').value = attrs.caption || '';
        dialog.querySelector('[data-error]').textContent = '';
        videoChoice.replaceChildren(new Option('Insert new video', ''));
        editor.state.doc.descendants((node, pos) => {
            if (node.type.name === 'youtube') videoChoice.add(new Option(node.attrs.title || 'YouTube video', String(pos)));
        });
        videoChoice.value = selectedPosition === null ? '' : String(selectedPosition);
        dialog.showModal();
    });
    videoChoice.addEventListener('change', () => {
        selectedPosition = videoChoice.value === '' ? null : Number(videoChoice.value);
        const attrs = selectedPosition === null ? {} : editor.state.doc.nodeAt(selectedPosition)?.attrs || {};
        dialog.querySelector('[data-url]').value = attrs.src || '';
        dialog.querySelector('[data-title]').value = attrs.title || '';
        dialog.querySelector('[data-caption]').value = attrs.caption || '';
    });
    remove.addEventListener('click', () => {
        if (selectedPosition === null) {
            dialog.querySelector('[data-error]').textContent = 'Choose an existing video to delete.';
            return;
        }
        editor.chain().focus().setNodeSelection(selectedPosition).deleteSelection().run();
        dialog.close();
    });
    dialog.querySelector('[data-cancel]').addEventListener('click', () => dialog.close());
    dialog.querySelector('[data-apply]').addEventListener('click', () => {
        if (![...dialog.querySelectorAll('input')].every(input => input.reportValidity())) return;
        const attrs = { src: dialog.querySelector('[data-url]').value.trim(), title: dialog.querySelector('[data-title]').value.trim(), caption: dialog.querySelector('[data-caption]').value.trim(), width: 640, height: 360 };
        if (!/^https:\/\/(www\.)?(youtube\.com\/(watch\?|embed\/|shorts\/)|youtube-nocookie\.com\/embed\/|youtu\.be\/)/i.test(attrs.src)) {
            dialog.querySelector('[data-error]').textContent = 'Enter a valid HTTPS YouTube URL.';
            return;
        }
        if (selectedPosition !== null) editor.chain().focus().setNodeSelection(selectedPosition).updateAttributes('youtube', attrs).run();
        else editor.chain().focus().setTextSelection(selection).insertContent({ type: 'youtube', attrs }).run();
        dialog.close();
    });
    deleteButton.addEventListener('click', () => {
        if (editor.isActive('youtube')) editor.chain().focus().deleteSelection().run();
        else button.click();
    });
}
