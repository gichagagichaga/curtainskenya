import { Extension } from '@tiptap/core';

const properties = ['font-family', 'font-size', 'color', 'font-weight', 'font-style', 'text-decoration', 'line-height', 'margin-top', 'margin-bottom'];

export const HeadingAppearance = Extension.create({
    name: 'headingAppearance',
    addGlobalAttributes() {
        return [{ types: ['heading'], attributes: Object.fromEntries(properties.map((property) => [property, {
            default: null,
            parseHTML: (element) => element.style.getPropertyValue(property) || null,
            renderHTML: (attributes) => attributes[property] ? { style: `${property}: ${attributes[property]}` } : {},
        }])) }];
    },
});

export function installHeadingStyleDialog(root, editor, button) {
    const dialog = document.createElement('dialog');
    dialog.className = 'blog-heading-dialog';
    dialog.setAttribute('aria-label', 'Modify heading style');
    dialog.innerHTML = `<h2>Modify heading style</h2>
        <p>Change this heading or all headings of the same level in this article. Save the article to keep your changes.</p>
        <div class="blog-heading-fields">
        <label>Heading level<select data-field="level"><option value="1">Heading 1</option><option value="2">Heading 2</option><option value="3">Heading 3</option><option value="4">Heading 4</option></select></label>
        <label>Font<select data-field="font-family"><option>Arial</option><option>Calibri</option><option>Georgia</option><option>Times New Roman</option><option>Tahoma</option><option>Verdana</option></select></label>
        <label>Size (pt)<input data-field="font-size" type="number" min="8" max="72" value="24"></label>
        <label>Colour<input data-field="color" type="color" value="#29231e"></label>
        <label>Alignment<select data-field="textAlign"><option value="left">Left</option><option value="center">Centre</option><option value="right">Right</option><option value="justify">Justified</option></select></label>
        <label>Line spacing<select data-field="line-height"><option>1</option><option>1.3</option><option>1.5</option><option>2</option></select></label>
        <label>Space before (pt)<input data-field="margin-top" type="number" min="0" max="72" value="18"></label>
        <label>Space after (pt)<input data-field="margin-bottom" type="number" min="0" max="72" value="10"></label>
        </div>
        <div class="blog-heading-options"><label><input data-field="font-weight" type="checkbox"> Bold</label><label><input data-field="font-style" type="checkbox"> Italic</label><label><input data-field="text-decoration" type="checkbox"> Underline</label></div>
        <div data-style-preview class="blog-heading-preview">Custom curtains for your home</div>
        <label><input data-field="all" type="checkbox" checked> Apply to all headings of this level in this article</label>
        <p data-style-error role="alert"></p>
        <div class="blog-heading-actions"><button type="button" data-cancel>Cancel</button><button type="button" data-apply>Apply style</button></div>`;
    root.append(dialog);
    const field = (name) => dialog.querySelector(`[data-field="${name}"]`);
    let selection;
    const attributes = () => ({
        'font-family': field('font-family').value,
        'font-size': `${field('font-size').value}pt`,
        color: field('color').value,
        'font-weight': field('font-weight').checked ? '700' : '400',
        'font-style': field('font-style').checked ? 'italic' : 'normal',
        'text-decoration': field('text-decoration').checked ? 'underline' : 'none',
        'line-height': field('line-height').value,
        'margin-top': `${field('margin-top').value}pt`,
        'margin-bottom': `${field('margin-bottom').value}pt`,
        textAlign: field('textAlign').value,
    });
    const preview = () => {
        const element = dialog.querySelector('[data-style-preview]');
        for (const [key, value] of Object.entries(attributes())) element.style.setProperty(key === 'textAlign' ? 'text-align' : key, value);
    };
    const load = () => {
        const level = Number(field('level').value);
        let existing;
        editor.state.doc.descendants((node) => {
            if (!existing && node.type.name === 'heading' && node.attrs.level === level) existing = node.attrs;
        });
        existing ||= {};
        field('font-family').value = existing['font-family'] || 'Arial';
        if (!field('font-family').value) field('font-family').value = 'Arial';
        field('font-size').value = parseFloat(existing['font-size']) || [0, 28, 24, 20, 16][level];
        field('color').value = /^#[0-9a-f]{6}$/i.test(existing.color || '') ? existing.color : '#29231e';
        field('textAlign').value = existing.textAlign || 'left';
        field('line-height').value = existing['line-height'] || '1.3';
        field('margin-top').value = parseFloat(existing['margin-top']) || 18;
        field('margin-bottom').value = parseFloat(existing['margin-bottom']) || 10;
        field('font-weight').checked = !existing['font-weight'] || Number(existing['font-weight']) >= 600 || existing['font-weight'] === 'bold';
        field('font-style').checked = existing['font-style'] === 'italic';
        field('text-decoration').checked = existing['text-decoration'] === 'underline';
        preview();
    };
    button.addEventListener('click', () => {
        selection = { from: editor.state.selection.from, to: editor.state.selection.to };
        field('level').value = editor.getAttributes('heading').level || 2;
        dialog.querySelector('[data-style-error]').textContent = '';
        load();
        dialog.showModal();
    });
    field('level').addEventListener('change', load);
    dialog.addEventListener('input', preview);
    dialog.querySelector('[data-cancel]').addEventListener('click', () => dialog.close());
    dialog.querySelector('[data-apply]').addEventListener('click', () => {
        if (![...dialog.querySelectorAll('input')].every((input) => input.reportValidity())) return;
        const level = Number(field('level').value);
        const attrs = attributes();
        const targets = [];
        editor.state.doc.descendants((node, pos) => {
            if (node.type.name === 'heading' && node.attrs.level === level && (field('all').checked || (pos <= selection.to && pos + node.nodeSize > selection.from))) targets.push({ node, pos });
        });
        if (!targets.length) {
            dialog.querySelector('[data-style-error]').textContent = 'Select an existing heading of this level, or apply a heading using the Paragraph menu first.';
            return;
        }
        const transaction = editor.state.tr;
        for (const { node, pos } of targets) {
            transaction.setNodeMarkup(pos, undefined, { ...node.attrs, ...attrs });
            // Remove conflicting inline typography but preserve links and other content.
            node.descendants((child, offset) => {
                if (!child.isText) return;
                for (const mark of child.marks) {
                    if (['textStyle', 'bold', 'italic', 'underline'].includes(mark.type.name)) transaction.removeMark(pos + 1 + offset, pos + 1 + offset + child.nodeSize, mark.type);
                }
            });
        }
        editor.view.dispatch(transaction);
        dialog.close();
        editor.commands.focus();
    });
}
