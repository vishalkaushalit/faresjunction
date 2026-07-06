document.addEventListener('DOMContentLoaded', () => {
  const backToTopBtn = document.getElementById('backToTopBtn');

  if (!backToTopBtn) {
    return;
  }

  const toggleBackToTop = () => {
    backToTopBtn.classList.toggle('show', window.scrollY > 100);
  };

  backToTopBtn.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  });

  toggleBackToTop();
  window.addEventListener('scroll', toggleBackToTop, { passive: true });
});
