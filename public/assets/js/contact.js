document.addEventListener('DOMContentLoaded', () => {

  const form = document.getElementById('contactInquiryForm');
  const successWidget = document.getElementById('contactSuccessWidget');
  const formContainer = document.getElementById('contactFormContainer');

  if (form) {
    const phoneInput = document.getElementById('contact-phone');
    if (phoneInput) {
      phoneInput.addEventListener('input', () => {
        phoneInput.classList.remove('is-invalid');
      });
    }

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const nameInput = document.getElementById('contact-name');
      const emailInput = document.getElementById('contact-email');
      const messageInput = document.getElementById('contact-message');
      const submitButton = form.querySelector('button[type="submit"]');

      const name = nameInput.value.trim();
      const email = emailInput.value.trim();
      const phone = phoneInput ? phoneInput.value.trim() : '';
      const message = messageInput.value.trim();

      if (phoneInput) {
        phoneInput.classList.remove('is-invalid');
      }

      if (!name || !email || !phone || !message) {
        alert('Please fill out all required fields.');
        return;
      }

      // Phone number format validation (exactly 9 or 10 digits, allows +, spaces, dashes, parentheses)
      const phoneRegex = /^[0-9\s\-()+]+$/;
      const digits = phone.replace(/\D/g, '');
      if (phoneInput && (!phoneRegex.test(phone) || digits.length < 9 || digits.length > 10)) {
        phoneInput.classList.add('is-invalid');
        alert('Please enter a valid phone number (exactly 9 or 10 digits, e.g. 123-456-7890).');
        phoneInput.focus();
        return;
      }

      if (submitButton) {
        submitButton.disabled = true;
        submitButton.dataset.originalText = submitButton.textContent;
        submitButton.textContent = 'Sending...';
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
          throw new Error(validationMessage || data.message || 'Something went wrong. Please try again.');
        }

        // Hide form and show success state after the server saves and sends emails.
        if (formContainer) {
          formContainer.style.display = 'none';
        }
        if (successWidget) {
          const nameSpan = document.getElementById('success-contact-name');
          if (nameSpan) {
            nameSpan.textContent = data.name || name;
          }
          successWidget.style.display = 'block';
        }
      } catch (error) {
        alert(error.message);
      } finally {
        if (submitButton) {
          submitButton.disabled = false;
          submitButton.textContent = submitButton.dataset.originalText || 'Send Message';
        }
      }
    });
  }

});
