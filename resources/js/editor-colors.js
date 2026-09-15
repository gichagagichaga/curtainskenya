export const commonColors = [['#000000', 'Black'], ['#ffffff', 'White'], ['#808080', 'Grey'], ['#c00000', 'Dark red'], ['#ff0000', 'Red'], ['#ff6600', 'Orange'], ['#ffc000', 'Gold'], ['#ffff00', 'Yellow'], ['#92d050', 'Light green'], ['#008000', 'Green'], ['#00b0f0', 'Light blue'], ['#0070c0', 'Blue'], ['#002060', 'Navy'], ['#7030a0', 'Purple'], ['#ff00ff', 'Magenta']];

export function colorMenu(label, change, initial = '') {
    const select = document.createElement('select');
    select.className = 'blog-editor-select';
    select.setAttribute('aria-label', label);
    select.add(new Option(label, ''));
    for (const [value, name] of commonColors) {
        const option = new Option(name, value);
        option.style.backgroundColor = value;
        option.style.color = ['#000000', '#c00000', '#008000', '#0070c0', '#002060', '#7030a0'].includes(value) ? '#ffffff' : '#000000';
        select.add(option);
    }
    select.value = initial;
    select.addEventListener('change', () => change(select.value));
    return select;
}
