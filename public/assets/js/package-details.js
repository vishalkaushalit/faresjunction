document.addEventListener('DOMContentLoaded', () => {

  // 1. GALLERY INTERACTION (THUMBNAIL CLICKS)
  const mainImg = document.getElementById('gallery-main-img');
  const thumbs = document.querySelectorAll('.gallery-thumb');

  thumbs.forEach(thumb => {
    thumb.addEventListener('click', () => {
      thumbs.forEach(t => t.classList.remove('active'));
      thumb.classList.add('active');
      const imgUrl = thumb.getAttribute('data-img-url');
      if (imgUrl && mainImg) {
        mainImg.src = imgUrl;
      }
    });
  });

  // 2. ITINERARY ACCORDION TOGGLES
  const dayHeaders = document.querySelectorAll('.itinerary-day-header');
  dayHeaders.forEach(header => {
    header.addEventListener('click', () => {
      const dayDiv = header.parentElement;
      const body = dayDiv.querySelector('.itinerary-day-body');
      const isExpanded = body.style.display === 'block';

      // Close all days
      document.querySelectorAll('.itinerary-day-body').forEach(b => b.style.display = 'none');
      document.querySelectorAll('.itinerary-day-header').forEach(h => h.classList.remove('active'));
      document.querySelectorAll('.itinerary-day').forEach(d => d.classList.remove('active'));

      // Open current day if it was closed
      if (!isExpanded) {
        body.style.display = 'block';
        header.classList.add('active');
        dayDiv.classList.add('active');
      }
    });
  });

  // 3. SCROLLSPY SUB-NAVIGATION & SMOOTH SCROLLING
  const navLinks = document.querySelectorAll('.package-nav-link');
  const sections = document.querySelectorAll('.detail-card');

  // Smooth scroll click handler
  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = link.getAttribute('href');
      const targetSection = document.querySelector(targetId);
      
      if (targetSection) {
        const offset = 130; // height of headers + sticky bar
        const bodyRect = document.body.getBoundingClientRect().top;
        const elementRect = targetSection.getBoundingClientRect().top;
        const elementPosition = elementRect - bodyRect;
        const offsetPosition = elementPosition - offset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // ScrollSpy logic to highlight active link
  window.addEventListener('scroll', () => {
    let currentActiveId = '';
    const scrollPos = window.scrollY + 150; // offset activation point

    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;

      if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
        currentActiveId = `#${section.getAttribute('id')}`;
      }
    });

    if (currentActiveId) {
      navLinks.forEach(link => {
        link.classList.toggle('active', link.getAttribute('href') === currentActiveId);
      });
    }
  });


  // 4. INQUIRY FORM VALIDATION AND MOCK SUBMISSION
  const form = document.getElementById('packageInquiryForm');
  const successWidget = document.getElementById('inquirySuccessWidget');

  if (form) {
    // Set min date of travel date input to today
    const dateInput = document.getElementById('travel-date');
    if (dateInput) {
      const today = new Date().toISOString().split('T')[0];
      dateInput.min = today;
    }

    const phoneInput = document.getElementById('traveler-phone');
    if (phoneInput) {
      phoneInput.addEventListener('input', () => {
        phoneInput.classList.remove('is-invalid');
      });
    }

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      // Basic inputs
      const name = document.getElementById('traveler-name').value.trim();
      const email = document.getElementById('traveler-email').value.trim();
      const phone = phoneInput ? phoneInput.value.trim() : '';
      const date = document.getElementById('travel-date').value;

      if (phoneInput) {
        phoneInput.classList.remove('is-invalid');
      }

      if (!name || !email || !phone || !date) {
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
      form.style.display = 'none';
      if (successWidget) {
        successWidget.style.display = 'flex';
      }
    });
  }

  // 5. MOST SEARCHED PACKAGES SLIDER
  const slides = document.querySelectorAll('.sidebar-slide');
  const btnPrev = document.querySelector('.slider-control-btn.btn-prev');
  const btnNext = document.querySelector('.slider-control-btn.btn-next');
  let currentSlide = 0;

  if (slides.length > 0 && btnPrev && btnNext) {
    const showSlide = (idx) => {
      slides.forEach((slide, sIdx) => {
        if (sIdx === idx) {
          slide.style.display = 'block';
          slide.classList.add('active');
        } else {
          slide.style.display = 'none';
          slide.classList.remove('active');
        }
      });
      currentSlide = idx;

      // Toggle active styling on buttons
      btnPrev.classList.toggle('active', currentSlide > 0);
      btnNext.classList.toggle('active', currentSlide < slides.length - 1);
    };

    btnPrev.addEventListener('click', () => {
      if (currentSlide > 0) {
        showSlide(currentSlide - 1);
      }
    });

    btnNext.addEventListener('click', () => {
      if (currentSlide < slides.length - 1) {
        showSlide(currentSlide + 1);
      }
    });

    // Initialize buttons
    showSlide(0);
  }

});
