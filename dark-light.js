  const themeToggle = document.getElementById('theme-toggle');
  const themeIcon   = document.getElementById('theme-icon');
  const htmlEl      = document.documentElement;

  // Κατά το load: διάβασε cookie και ρύθμισε θέμα + εικονίδιο
  const match = document.cookie.match(/theme=(dark|light)/);
  const current = match ? match[1] : 'light';
  htmlEl.dataset.theme = current;
  themeIcon.textContent = current === 'dark' ? '☀️' : '🌙';

  themeToggle.addEventListener('click', () => {
    const newTheme = htmlEl.dataset.theme === 'dark' ? 'light' : 'dark';
    htmlEl.dataset.theme = newTheme;
    document.cookie = `theme=${newTheme}; path=/; max-age=31536000`;
    themeIcon.textContent = newTheme === 'dark' ? '☀️' : '🌙';
  });