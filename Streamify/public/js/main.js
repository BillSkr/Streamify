// Theme toggle
const themeToggle = () => {
    const current = document.body.classList.contains('dark') ? 'dark' : 'light';
    const target = current === 'dark' ? 'light' : 'dark';
    document.body.className = target;
    document.cookie = `theme=${target};path=/;max-age=31536000`;
};
document.getElementById('theme-toggle')?.addEventListener('click', themeToggle);

// Apply saved theme
document.addEventListener('DOMContentLoaded', () => {
    const match = document.cookie.match(/theme=(dark|light)/);
    if (match) document.body.className = match[1];
});

// Accordion
document.querySelectorAll('.accordion').forEach(btn => {
    btn.addEventListener('click', () => {
        const content = btn.nextElementSibling;
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
    });
});
