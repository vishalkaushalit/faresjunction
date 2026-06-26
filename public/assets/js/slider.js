// Testimonials Slider & Deals Filter Controller
document.addEventListener('DOMContentLoaded', () => {

  // =====================
  // TESTIMONIALS SLIDER
  // =====================
  const slider = document.getElementById('testimonialsSlider');
  const prevBtn = document.getElementById('sliderPrev');
  const nextBtn = document.getElementById('sliderNext');
  const dots = document.querySelectorAll('.slider-dot');

  if (slider) {
    const cards = slider.querySelectorAll('.testimonial-card');
    let current = 0;
    let autoSlideTimer;

    // Determine visible cards count based on viewport
    const getVisibleCount = () => {
      if (window.innerWidth < 576) return 1;
      if (window.innerWidth < 992) return 2;
      return 1;
    };

    const getMaxIndex = () => Math.max(0, cards.length - getVisibleCount());

    const goTo = (index) => {
      current = Math.max(0, Math.min(index, getMaxIndex()));
      const cardWidth = cards[0].offsetWidth + 24; // card + gap
      slider.style.transform = `translateX(-${current * cardWidth}px)`;
      
      dots.forEach((d, i) => d.classList.toggle('active', i === current));
    };

    const autoSlide = () => {
      autoSlideTimer = setInterval(() => {
        goTo(current < getMaxIndex() ? current + 1 : 0);
      }, 4500);
    };

    const resetAuto = () => {
      clearInterval(autoSlideTimer);
      autoSlide();
    };

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        goTo(current > 0 ? current - 1 : getMaxIndex());
        resetAuto();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        goTo(current < getMaxIndex() ? current + 1 : 0);
        resetAuto();
      });
    }

    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => {
        goTo(i);
        resetAuto();
      });
    });

    // Touch/swipe support
    let touchStartX = 0;
    slider.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
    slider.addEventListener('touchend', (e) => {
      const diff = touchStartX - e.changedTouches[0].screenX;
      if (Math.abs(diff) > 40) {
        diff > 0 ? goTo(current + 1) : goTo(current - 1);
        resetAuto();
      }
    });

    // Recalculate on resize
    window.addEventListener('resize', () => goTo(Math.min(current, getMaxIndex())));

    autoSlide(); // start auto-play
  }

  // =====================
  // DEALS FILTER
  // =====================
  const dealTabBtns = document.querySelectorAll('.deal-tab-btn');
  const dealCards = document.querySelectorAll('.deal-card');

  dealTabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      dealTabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      
      const filter = btn.getAttribute('data-deal-filter');
      
      dealCards.forEach(card => {
        const types = card.getAttribute('data-deal-type') || '';
        const isVisible = filter === 'all' || types.includes(filter);
        card.style.display = isVisible ? 'block' : 'none';
      });
    });
  });

  // =====================
  // VACATION PACKAGES SLIDER
  // =====================
  const vacSlider = document.getElementById('vacationsSlider');
  const vacPrevBtn = document.getElementById('vacationsPrev');
  const vacNextBtn = document.getElementById('vacationsNext');

  if (vacSlider) {
    const cards = vacSlider.querySelectorAll('.vacation-card');
    let current = 0;

    const getVisibleCount = () => {
      if (window.innerWidth < 576) return 1;
      if (window.innerWidth < 992) return 2;
      return 3;
    };

    const getMaxIndex = () => Math.max(0, cards.length - getVisibleCount());

    const goTo = (index) => {
      current = Math.max(0, Math.min(index, getMaxIndex()));
      const cardWidth = cards[0].offsetWidth + 24; // card + gap
      vacSlider.style.transform = `translateX(-${current * cardWidth}px)`;
      
      // Toggle disable style/attribute on navigation buttons
      if (vacPrevBtn) {
        if (current === 0) {
          vacPrevBtn.style.opacity = '0.5';
          vacPrevBtn.style.cursor = 'not-allowed';
        } else {
          vacPrevBtn.style.opacity = '1';
          vacPrevBtn.style.cursor = 'pointer';
        }
      }
      if (vacNextBtn) {
        if (current >= getMaxIndex()) {
          vacNextBtn.style.opacity = '0.5';
          vacNextBtn.style.cursor = 'not-allowed';
        } else {
          vacNextBtn.style.opacity = '1';
          vacNextBtn.style.cursor = 'pointer';
        }
      }
    };

    if (vacPrevBtn) {
      vacPrevBtn.addEventListener('click', () => {
        if (current > 0) goTo(current - 1);
      });
    }

    if (vacNextBtn) {
      vacNextBtn.addEventListener('click', () => {
        if (current < getMaxIndex()) goTo(current + 1);
      });
    }

    // Touch/swipe support
    let touchStartX = 0;
    vacSlider.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
    vacSlider.addEventListener('touchend', (e) => {
      const diff = touchStartX - e.changedTouches[0].screenX;
      if (Math.abs(diff) > 40) {
        if (diff > 0) {
          if (current < getMaxIndex()) goTo(current + 1);
        } else {
          if (current > 0) goTo(current - 1);
        }
      }
    });

    // Recalculate on resize
    window.addEventListener('resize', () => goTo(Math.min(current, getMaxIndex())));

    // Initial setup
    setTimeout(() => goTo(0), 100);
  }

});

