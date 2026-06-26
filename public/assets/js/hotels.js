document.addEventListener('DOMContentLoaded', () => {

  // 1. HOTEL SEARCH FORM VALIDATION & MOCK SUBMISSION
  const form = document.getElementById('hotelsInquiryForm');
  const successWidget = document.getElementById('hotelSuccessWidget');
  const searchWidget = document.getElementById('hotelSearchWidget');

  if (form) {
    // Set min date of travel date inputs to today
    const checkinInput = document.getElementById('hotel-checkin');
    const checkoutInput = document.getElementById('hotel-checkout');
    
    if (checkinInput && checkoutInput) {
      const today = new Date().toISOString().split('T')[0];
      checkinInput.min = today;
      checkoutInput.min = today;

      // Update check-out min date when check-in date changes
      checkinInput.addEventListener('change', () => {
        if (checkinInput.value) {
          checkoutInput.min = checkinInput.value;
        }
      });
    }

    const phoneInput = document.getElementById('hotel-phone');
    if (phoneInput) {
      phoneInput.addEventListener('input', () => {
        phoneInput.classList.remove('is-invalid');
      });
    }

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      // Basic inputs
      const destination = document.getElementById('hotel-destination').value.trim();
      const name = document.getElementById('hotel-name').value.trim();
      const email = document.getElementById('hotel-email').value.trim();
      const phone = phoneInput ? phoneInput.value.trim() : '';
      const checkin = document.getElementById('hotel-checkin').value;
      const checkout = document.getElementById('hotel-checkout').value;

      if (phoneInput) {
        phoneInput.classList.remove('is-invalid');
      }

      if (!destination || !name || !email || !phone || !checkin || !checkout) {
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
        const destSpan = document.getElementById('success-hotel-dest');
        if (destSpan) {
          destSpan.textContent = destination;
        }
        successWidget.style.display = 'block';
      }
    });
  }

  // 2. FAQ ACCORDION TOGGLES
  const faqAccordion = document.getElementById('hotelFaqAccordion');
  if (faqAccordion) {
    const faqHeaders = faqAccordion.querySelectorAll('.faq-header');
    
    faqHeaders.forEach(header => {
      header.addEventListener('click', () => {
        const item = header.parentElement;
        const body = item.querySelector('.faq-body');
        const isExpanded = body.style.display === 'block';

        // Close all items
        faqAccordion.querySelectorAll('.faq-body').forEach(b => b.style.display = 'none');
        faqAccordion.querySelectorAll('.faq-header').forEach(h => h.classList.remove('active'));
        faqAccordion.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));

        // Toggle current item
        if (!isExpanded) {
          body.style.display = 'block';
          header.classList.add('active');
          item.classList.add('active');
        }
      });
    });
  }

});
