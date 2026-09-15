function initializeImageMetadata() {
    document.querySelectorAll('input[type="file"][name="images[]"]').forEach((input) => {
        if (input.dataset.metadataReady) return;
        input.dataset.metadataReady = 'true';
        const container = document.createElement('div');
        container.className = 'grid gap-3 mt-3';
        input.after(container);
        input.addEventListener('change', () => {
            container.replaceChildren();
            [...input.files].forEach((file, index) => {
                const group = document.createElement('fieldset');
                group.className = 'grid gap-2 border rounded p-3';
                const legend = document.createElement('legend');
                legend.textContent = file.name;
                group.append(legend);
                for (const [name, text] of [['alt_texts', 'Alternative text'], ['image_titles', 'Title (optional)'], ['image_captions', 'Caption (optional)']]) {
                    const label = document.createElement('label');
                    label.textContent = text;
                    const field = document.createElement('input');
                    field.name = `${name}[${index}]`;
                    field.maxLength = 255;
                    field.className = 'block w-full border rounded p-2 dark:bg-zinc-800';
                    label.append(field);
                    group.append(label);
                }
                container.append(group);
            });
        });
    });
}
document.addEventListener('DOMContentLoaded', initializeImageMetadata);
document.addEventListener('livewire:navigated', initializeImageMetadata);
