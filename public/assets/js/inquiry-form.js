document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-inquiry-form]').forEach((form) => {
    const dateInput = form.querySelector('[data-inquiry-date]');
    const phoneInput = form.querySelector('[data-inquiry-phone]');
    const success = form.parentElement.querySelector('[data-inquiry-success]');

    if (dateInput) dateInput.min = new Date().toISOString().split('T')[0];
    phoneInput?.addEventListener('input', () => phoneInput.classList.remove('is-invalid'));

    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const requiredFields = ['[data-inquiry-name]', '[data-inquiry-email]', '[data-inquiry-phone]', '[data-inquiry-date]'];
      if (requiredFields.some((selector) => !form.querySelector(selector)?.value.trim())) {
        alert('Please fill out all required fields.');
        return;
      }

      const phone = phoneInput.value.trim();
      const digits = phone.replace(/\D/g, '');
      if (!/^[0-9\s\-()+]+$/.test(phone) || digits.length < 9 || digits.length > 10) {
        phoneInput.classList.add('is-invalid');
        alert('Please enter a valid phone number (exactly 9 or 10 digits).');
        phoneInput.focus();
        return;
      }

      const submitButton = form.querySelector('[type="submit"]');
      submitButton.disabled = true;

      try {
        const response = await fetch(form.action, {
          method: 'POST',
          headers: {'Accept': 'application/json'},
          body: new FormData(form),
        });
        const result = await response.json();

        if (!response.ok) {
          const firstError = Object.values(result.errors || {}).flat()[0];
          throw new Error(firstError || result.message || 'Unable to submit your inquiry.');
        }

        form.style.display = 'none';
        if (success) success.style.display = 'flex';
      } catch (error) {
        alert(error.message);
        submitButton.disabled = false;
      }
    });
  });
});
