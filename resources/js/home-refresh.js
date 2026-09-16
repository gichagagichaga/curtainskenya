import '../css/home-refresh.css';

function initializeHomeRefresh() {
    document.querySelectorAll('[data-category-slider]').forEach((slider) => {
        if (slider.dataset.initialized) return;
        slider.dataset.initialized = 'true';
        const track = slider.querySelector('[data-home-category-grid]');
        const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        let paused = reducedMotion.matches;
        let hovered = false;
        const pauseButton = slider.querySelector('[data-category-pause]');
        const updatePause = () => {
            pauseButton.textContent = paused ? 'Play' : 'Pause';
            pauseButton.setAttribute('aria-pressed', String(paused));
        };
        const move = (direction) => {
            const first = track.firstElementChild;
            if (!first || track.scrollWidth <= track.clientWidth + 1) return;
            const step = first.getBoundingClientRect().width + parseFloat(getComputedStyle(track).gap);
            const max = track.scrollWidth - track.clientWidth;
            const left = direction > 0 && track.scrollLeft >= max - 2 ? 0
                : direction < 0 && track.scrollLeft <= 2 ? max : track.scrollLeft + step * direction;
            track.scrollTo({ left, behavior: reducedMotion.matches ? 'instant' : 'smooth' });
        };
        slider.querySelector('[data-category-next]').addEventListener('click', () => move(1));
        slider.querySelector('[data-category-previous]').addEventListener('click', () => move(-1));
        pauseButton.addEventListener('click', () => { paused = !paused; updatePause(); });
        slider.addEventListener('mouseenter', () => { hovered = true; });
        slider.addEventListener('mouseleave', () => { hovered = false; });
        updatePause();
        const timer = window.setInterval(() => {
            if (!slider.isConnected) return window.clearInterval(timer);
            if (!paused && !hovered && !document.hidden && !slider.contains(document.activeElement)) move(1);
        }, 5000);
    });
    document.querySelectorAll('header nav a').forEach((link) => {
        if (link.dataset.closeNavigation) return;
        link.dataset.closeNavigation = 'true';
        link.addEventListener('click', () => window.dispatchEvent(new CustomEvent('close-navigation')));
    });
}
document.addEventListener('DOMContentLoaded', initializeHomeRefresh);
document.addEventListener('livewire:navigated', initializeHomeRefresh);
