document.addEventListener('DOMContentLoaded', () => {
  const forms = document.querySelectorAll('.footer-subscribe-form');

  forms.forEach((form) => {
    const input = form.querySelector('input[name="email"]');
    const button = form.querySelector('button[type="submit"]');
    const status = form.querySelector('.newsletter-status');

    form.addEventListener('submit', async (event) => {
      event.preventDefault();

      if (!input || !input.value.trim()) {
        return;
      }

      if (status) {
        status.style.display = 'none';
        status.textContent = '';
        status.classList.remove('is-success', 'is-error');
      }

      if (button) {
        button.disabled = true;
        button.setAttribute('aria-label', 'Subscribing');
      }

      try {
        const response = await fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
          credentials: 'same-origin',
        });

        const data = await response.json().catch(() => ({}));

        if (!response.ok) {
          const validationMessage = data.errors ? Object.values(data.errors).flat()[0] : null;
          throw new Error(validationMessage || data.message || 'Unable to subscribe right now. Please try again.');
        }

        input.value = '';

        if (status) {
          status.textContent = data.message || 'Thank you for subscribing!';
          status.style.display = 'block';
          status.classList.add('is-success');
        }
      } catch (error) {
        if (status) {
          status.textContent = error.message;
          status.style.display = 'block';
          status.classList.add('is-error');
        } else {
          alert(error.message);
        }
      } finally {
        if (button) {
          button.disabled = false;
          button.setAttribute('aria-label', 'Subscribe to newsletter');
        }
      }
    });
  });
});
