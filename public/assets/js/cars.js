document.addEventListener('DOMContentLoaded', () => {

  // 1. CAR SEARCH FORM VALIDATION & MOCK SUBMISSION
  const form = document.getElementById('carsInquiryForm');
  const successWidget = document.getElementById('carSuccessWidget');
  const searchWidget = document.getElementById('carSearchWidget');

  if (form) {
    // Set min date of travel date inputs to today
    const pickupDateInput = document.getElementById('car-pickup-date');
    const dropoffDateInput = document.getElementById('car-dropoff-date');
    
    if (pickupDateInput && dropoffDateInput) {
      const today = new Date().toISOString().split('T')[0];
      pickupDateInput.min = today;
      dropoffDateInput.min = today;

      // Update drop-off min date when pick-up date changes
      pickupDateInput.addEventListener('change', () => {
        if (pickupDateInput.value) {
          dropoffDateInput.min = pickupDateInput.value;
        }
      });
    }

    const phoneInput = document.getElementById('car-phone');
    if (phoneInput) {
      phoneInput.addEventListener('input', () => {
        phoneInput.classList.remove('is-invalid');
      });
    }

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      // Basic inputs
      const location = document.getElementById('car-location').value.trim();
      const name = document.getElementById('car-name').value.trim();
      const email = document.getElementById('car-email').value.trim();
      const phone = phoneInput ? phoneInput.value.trim() : '';
      const pickupDate = pickupDateInput.value;
      const dropoffDate = dropoffDateInput.value;

      if (phoneInput) {
        phoneInput.classList.remove('is-invalid');
      }

      if (!location || !name || !email || !phone || !pickupDate || !dropoffDate) {
        alert('Please fill out all required fields.');
        return;
      }

      // Phone validation (exactly 9 or 10 digits, allows +, spaces, dashes, parentheses)
      const phoneRegex = /^[0-9\s\-()+]+$/;
      const digits = phone.replace(/\D/g, '');
      if (phoneInput && (!phoneRegex.test(phone) || digits.length < 9 || digits.length > 10)) {
        phoneInput.classList.add('is-invalid');
        alert('Please enter a valid phone number (exactly 9 or 10 digits, e.g. 123-456-7890).');
        phoneInput.focus();
        return;
      }

      // Hide form and show success state
      if (searchWidget) {
        searchWidget.style.display = 'none';
      }
      if (successWidget) {
        const locSpan = document.getElementById('success-car-loc');
        if (locSpan) {
          locSpan.textContent = location;
        }
        successWidget.style.display = 'block';
      }
    });
  }

});
