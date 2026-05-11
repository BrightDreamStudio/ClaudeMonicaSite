document.querySelectorAll('.circle').forEach(circle => {
    circle.addEventListener('click', () => {
        const wrapper = circle.closest('.circle-wrapper');
        wrapper.classList.toggle('active');
    });
});

document.querySelectorAll('.play-button').forEach(button => {
    button.addEventListener('click', (e) => {
        e.stopPropagation(); // Empêche le clic de se propager au cercle
        const link = button.closest('.circle-wrapper').getAttribute('data-link');
        window.open(link, '_blank');
    });
});