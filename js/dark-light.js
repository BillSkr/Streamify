const toggle = document.getElementById('theme-toggle');
const icon   = document.getElementById('theme-icon');
const root   = document.documentElement;

// initialize from localStorage
if (localStorage.getItem('theme') === 'dark') {
  root.setAttribute('data-theme', 'dark');
  icon.textContent = '☀️';
}

toggle.addEventListener('click', () => {
  const current = root.getAttribute('data-theme');
  if (current === 'light') {
    root.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
    icon.textContent = '☀️';
  } else {
    root.setAttribute('data-theme', 'light');
    localStorage.setItem('theme', 'light');
    icon.textContent = '🌙';
  }
});