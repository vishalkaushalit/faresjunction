document.addEventListener('DOMContentLoaded', () => {

  // 1. DATE PICKER MIN CONSTRAINTS
  const depDateInput = document.getElementById('flight-departure');
  const retDateInput = document.getElementById('flight-return');

  if (depDateInput) {
    const today = new Date().toISOString().split('T')[0];
    // For date inputs, set min attribute when they are focused / active
    depDateInput.addEventListener('focus', () => {
      depDateInput.min = today;
    });

    depDateInput.addEventListener('change', () => {
      if (retDateInput) {
        retDateInput.min = depDateInput.value;
        if (retDateInput.value && retDateInput.value < depDateInput.value) {
          retDateInput.value = '';
        }
      }
    });
  }

  if (retDateInput) {
    retDateInput.addEventListener('focus', () => {
      const minDate = depDateInput && depDateInput.value ? depDateInput.value : new Date().toISOString().split('T')[0];
      retDateInput.min = minDate;
    });
  }

  // 2. TRIP TYPE ROUND TRIP vs ONE WAY RADIO BEHAVIOR
  const radioRoundtrip = document.getElementById('radio-roundtrip');
  const radioOneway = document.getElementById('radio-oneway');

  if (radioRoundtrip && radioOneway) {
    const toggleReturnField = () => {
      if (radioOneway.checked) {
        if (retDateInput) {
          retDateInput.disabled = true;
          retDateInput.value = '';
          retDateInput.removeAttribute('required');
          retDateInput.placeholder = 'N/A (One Way)';
        }
      } else {
        if (retDateInput) {
          retDateInput.disabled = false;
          retDateInput.setAttribute('required', 'required');
          retDateInput.placeholder = 'Return Date';
        }
      }
    };

    radioRoundtrip.addEventListener('change', toggleReturnField);
    radioOneway.addEventListener('change', toggleReturnField);
  }

  // 3. DESTINATION SWAP BUTTON
  const swapBtn = document.getElementById('btn-swap-dest');
  const originInput = document.getElementById('flight-origin');
  const destInput = document.getElementById('flight-destination');

  if (swapBtn && originInput && destInput) {
    swapBtn.addEventListener('click', () => {
      const temp = originInput.value;
      originInput.value = destInput.value;
      destInput.value = temp;
    });
  }

  // 4. FAQ ACCORDION TOGGLES
  const faqItems = document.querySelectorAll('#faqAccordion .faq-item');
  faqItems.forEach(item => {
    const header = item.querySelector('.faq-header');
    const body = item.querySelector('.faq-body');

    if (header && body) {
      header.addEventListener('click', () => {
        const isOpen = item.classList.contains('active');

        // Close all FAQs
        faqItems.forEach(f => {
          f.classList.remove('active');
          f.querySelector('.faq-body').style.display = 'none';
        });

        // Open current if it was closed
        if (!isOpen) {
          item.classList.add('active');
          body.style.display = 'block';
        }
      });
    }
  });

  // 5. INQUIRY FORM SUBMISSION & SUCCESS WIDGET
  const form = document.getElementById('flightsInquiryForm');
  const searchWidget = document.getElementById('flightSearchWidget');
  const successWidget = document.getElementById('flightSuccessWidget');
  const successRoute = document.getElementById('success-flight-route');

  if (form && searchWidget && successWidget) {
    const phoneInput = document.getElementById('flight-phone');
    if (phoneInput) {
      phoneInput.addEventListener('input', () => {
        phoneInput.classList.remove('is-invalid');
      });
    }

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const origin = originInput ? originInput.value.trim() : '';
      const destination = destInput ? destInput.value.trim() : '';
      const name = document.getElementById('flight-name') ? document.getElementById('flight-name').value.trim() : '';
      const emailInput = document.getElementById('flight-email');
      const email = emailInput ? emailInput.value.trim() : '';
      const phone = phoneInput ? phoneInput.value.trim() : '';

      if (phoneInput) {
        phoneInput.classList.remove('is-invalid');
      }

      if (!origin || !destination || !name || !email || !phone) {
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

      if (successRoute && origin && destination) {
        successRoute.textContent = `${origin} to ${destination}`;
      }

      searchWidget.style.display = 'none';
      successWidget.style.display = 'block';
    });
  }

});
