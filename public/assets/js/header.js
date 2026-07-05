// Header Navigation & Accessible Mobile Menu Drawer
document.addEventListener('DOMContentLoaded', () => {
  const header = document.querySelector('.main-header');
  const mobileToggle = document.querySelector('.mobile-toggle');
  const drawerClose = document.querySelector('.drawer-close');
  const drawer = document.querySelector('.mobile-drawer');
  const overlay = document.querySelector('.drawer-overlay');

  // Sticky Header Logic with Hysteresis & Dynamic Padding
  const handleScroll = () => {
    if (window.scrollY > 200) {
      if (!header.classList.contains('sticky')) {
        const headerHeight = header.offsetHeight;
        document.body.style.paddingTop = `${headerHeight}px`;
        header.classList.add('sticky');
      }
    } else if (window.scrollY < 100) {
      if (header.classList.contains('sticky')) {
        header.classList.remove('sticky');
        document.body.style.paddingTop = '0';
      }
    }
  };
  window.addEventListener('scroll', handleScroll);

  // Recalculate body padding on viewport resize if header is sticky
  window.addEventListener('resize', () => {
    if (header.classList.contains('sticky')) {
      header.classList.remove('sticky');
      const headerHeight = header.offsetHeight;
      header.classList.add('sticky');
      document.body.style.paddingTop = `${headerHeight}px`;
    }
  });

  // Open Drawer Function
  const openDrawer = () => {
    drawer.classList.add('open');
    overlay.classList.add('open');
    mobileToggle.setAttribute('aria-expanded', 'true');
    drawer.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
    drawerClose.focus();
  };

  // Close Drawer Function
  const closeDrawer = () => {
    drawer.classList.remove('open');
    overlay.classList.remove('open');
    mobileToggle.setAttribute('aria-expanded', 'false');
    drawer.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = ''; // Restore scrolling
    mobileToggle.focus();
  };

  // Event Listeners
  mobileToggle.addEventListener('click', openDrawer);
  drawerClose.addEventListener('click', closeDrawer);
  overlay.addEventListener('click', closeDrawer);

  // Close on Escape Key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && drawer.classList.contains('open')) {
      closeDrawer();
    }
  });

  // Focus Trapping in Mobile Drawer
  const focusableElements = drawer.querySelectorAll('a, button');
  if (focusableElements.length > 0) {
    const firstFocusable = focusableElements[0];
    const lastFocusable = focusableElements[focusableElements.length - 1];

    drawer.addEventListener('keydown', (e) => {
      if (e.key === 'Tab') {
        if (e.shiftKey) { // Shift + Tab
          if (document.activeElement === firstFocusable) {
            lastFocusable.focus();
            e.preventDefault();
          }
        } else { // Tab
          if (document.activeElement === lastFocusable) {
            firstFocusable.focus();
            e.preventDefault();
          }
        }
      }
    });
  }

  // Open placeholder date fields on the first click.
  const dateInputs = document.querySelectorAll('input[onfocus*="date"], .date-wrapper input');

  const openDatePicker = (input) => {
    if (!input || input.disabled || input.readOnly) return;

    if (input.type !== 'date') {
      input.type = 'date';
    }

    input.focus({ preventScroll: true });

    if (typeof input.showPicker === 'function') {
      try {
        input.showPicker();
      } catch (error) {
        // Some browsers reject showPicker when the native picker is already open.
      }
    }
  };

  dateInputs.forEach((input) => {
    input.addEventListener('pointerdown', () => openDatePicker(input));

    input.addEventListener('blur', () => {
      if (!input.value) {
        input.type = 'text';
      }
    });
  });
});
