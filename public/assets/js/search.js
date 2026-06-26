// Flight Search Form Widget Interactive Controller
document.addEventListener('DOMContentLoaded', () => {
  // 1. Tab Switching Logic
  const tabs = document.querySelectorAll('.tab-btn');
  const panes = document.querySelectorAll('.tab-pane');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      // Deactivate all tabs and panes
      tabs.forEach(t => {
        t.classList.remove('active');
        t.setAttribute('aria-selected', 'false');
      });
      panes.forEach(p => p.classList.remove('active'));

      // Activate clicked tab and matching pane
      tab.classList.add('active');
      tab.setAttribute('aria-selected', 'true');
      const targetId = tab.getAttribute('aria-controls');
      const targetPane = document.getElementById(targetId);
      if (targetPane) {
        targetPane.classList.add('active');
      }
    });
  });

  // 2. Trip Type Switch (RoundTrip vs One Way)
  const tripTypeRadios = document.querySelectorAll('input[name="trip-type"]');
  const returnDateContainer = document.getElementById('return-date-container');
  const returnDateInput = document.getElementById('return-date-input');

  const updateReturnDateStatus = () => {
    const activeRadio = document.querySelector('input[name="trip-type"]:checked');
    if (activeRadio && activeRadio.value === 'oneway') {
      returnDateContainer.classList.add('disabled');
      returnDateInput.setAttribute('disabled', 'true');
      returnDateInput.removeAttribute('required');
      returnDateInput.value = '';
      returnDateInput.type = 'text'; // reset field display type
    } else {
      returnDateContainer.classList.remove('disabled');
      returnDateInput.removeAttribute('disabled');
      returnDateInput.setAttribute('required', 'true');
    }
  };

  tripTypeRadios.forEach(radio => {
    radio.addEventListener('change', updateReturnDateStatus);
  });
  updateReturnDateStatus(); // initialize status

  // 3. Passenger Selector Dropdown Logic
  const trigger = document.getElementById('passengerDropdownTrigger');
  const popup = document.getElementById('passengerPopup');
  const applyBtn = document.getElementById('applyPassengers');
  const summarySpan = document.getElementById('passenger-summary');
  const cabinSelect = document.getElementById('cabin-class');

  // Count buttons logic
  const counts = { adults: 1, children: 0, infants: 0 };

  const updateCounterUI = () => {
    for (const key in counts) {
      document.getElementById(`count-${key}`).textContent = counts[key];
    }
    const totalTravelers = counts.adults + counts.children + counts.infants;
    
    // Enable/disable decrease buttons
    document.querySelector('.minus[data-type="adults"]').disabled = counts.adults <= 1;
    document.querySelector('.minus[data-type="children"]').disabled = counts.children <= 0;
    document.querySelector('.minus[data-type="infants"]').disabled = counts.infants <= 0;
    
    // Enable/disable increase buttons based on passenger limit of 9
    document.querySelectorAll('.btn-count.plus').forEach(btn => {
      btn.disabled = totalTravelers >= 9;
    });
  };

  // Setup click triggers on counters
  document.querySelectorAll('.btn-count').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const type = btn.getAttribute('data-type');
      const isPlus = btn.classList.contains('plus');
      
      if (isPlus) {
        const totalTravelers = counts.adults + counts.children + counts.infants;
        if (totalTravelers >= 9) return;
        counts[type]++;
      } else {
        if (type === 'adults' && counts.adults <= 1) return;
        if (type !== 'adults' && counts[type] <= 0) return;
        counts[type]--;
      }
      updateCounterUI();
    });
  });

  const updateSummaryText = () => {
    const totalTravelers = counts.adults + counts.children + counts.infants;
    const cabin = cabinSelect.value;
    const travelerText = totalTravelers === 1 ? 'Traveler' : 'Travelers';
    summarySpan.textContent = `${totalTravelers} ${travelerText} ${cabin}`;
  };

  const togglePopup = (e) => {
    e.stopPropagation();
    const isOpen = popup.classList.contains('show');
    if (isOpen) {
      popup.classList.remove('show');
      trigger.setAttribute('aria-expanded', 'false');
    } else {
      popup.classList.add('show');
      trigger.setAttribute('aria-expanded', 'true');
    }
  };

  trigger.addEventListener('click', togglePopup);
  applyBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    popup.classList.remove('show');
    trigger.setAttribute('aria-expanded', 'false');
    updateSummaryText();
  });

  cabinSelect.addEventListener('change', updateSummaryText);

  // Close dropdown on click outside
  document.addEventListener('click', (e) => {
    if (!trigger.contains(e.target) && !popup.contains(e.target)) {
      popup.classList.remove('show');
      trigger.setAttribute('aria-expanded', 'false');
    }
  });

  updateCounterUI(); // initial run

  // 4. Auto-suggest list Logic (Simulated airport databases)
  const airports = [
    { code: 'NYC', name: 'New York All Airports, NY', desc: 'United States' },
    { code: 'JFK', name: 'John F. Kennedy Intl Airport, NY', desc: 'United States' },
    { code: 'LAX', name: 'Los Angeles Intl Airport, CA', desc: 'United States' },
    { code: 'ORD', name: 'O\'Hare Intl Airport, Chicago, IL', desc: 'United States' },
    { code: 'LHR', name: 'London Heathrow Airport', desc: 'United Kingdom' },
    { code: 'DXB', name: 'Dubai Intl Airport', desc: 'United Arab Emirates' },
    { code: 'HND', name: 'Haneda Airport, Tokyo', desc: 'Japan' },
    { code: 'MIA', name: 'Miami Intl Airport, FL', desc: 'United States' }
  ];

  const setupAutocomplete = (input, list) => {
    input.addEventListener('input', () => {
      const val = input.value.trim().toLowerCase();
      list.innerHTML = '';
      if (!val) {
        list.style.display = 'none';
        return;
      }

      const matches = airports.filter(item => 
        item.code.toLowerCase().includes(val) || 
        item.name.toLowerCase().includes(val)
      );

      if (matches.length > 0) {
        matches.forEach(match => {
          const div = document.createElement('div');
          div.className = 'autocomplete-item';
          div.innerHTML = `<strong>${match.code}</strong> - ${match.name} (${match.desc})`;
          div.addEventListener('click', () => {
            input.value = `${match.name} (${match.code})`;
            list.style.display = 'none';
          });
          list.appendChild(div);
        });
        list.style.display = 'block';
      } else {
        list.style.display = 'none';
      }
    });

    // Close on click outside
    document.addEventListener('click', (e) => {
      if (!input.contains(e.target)) {
        list.style.display = 'none';
      }
    });
  };

  const originInput = document.getElementById('origin-input');
  const destinationInput = document.getElementById('destination-input');
  if (originInput && document.getElementById('origin-suggestions')) {
    setupAutocomplete(originInput, document.getElementById('origin-suggestions'));
  }
  if (destinationInput && document.getElementById('destination-suggestions')) {
    setupAutocomplete(destinationInput, document.getElementById('destination-suggestions'));
  }

  // Hotels Autocomplete
  const hotelDest = document.getElementById('hotel-destination-input');
  const hotelSuggestions = document.getElementById('hotel-destination-suggestions');
  if (hotelDest && hotelSuggestions) {
    setupAutocomplete(hotelDest, hotelSuggestions);
  }

  // Vacations Autocomplete
  const vacOrigin = document.getElementById('vacation-origin-input');
  const vacOriginSuggestions = document.getElementById('vacation-origin-suggestions');
  if (vacOrigin && vacOriginSuggestions) {
    setupAutocomplete(vacOrigin, vacOriginSuggestions);
  }
  const vacDest = document.getElementById('vacation-destination-input');
  const vacDestSuggestions = document.getElementById('vacation-destination-suggestions');
  if (vacDest && vacDestSuggestions) {
    setupAutocomplete(vacDest, vacDestSuggestions);
  }

  // Car Autocomplete
  const carPickup = document.getElementById('car-pickup-input');
  const carPickupSuggestions = document.getElementById('car-pickup-suggestions');
  if (carPickup && carPickupSuggestions) {
    setupAutocomplete(carPickup, carPickupSuggestions);
  }

  // Bus Autocomplete
  const busOrigin = document.getElementById('bus-origin-input');
  const busOriginSuggestions = document.getElementById('bus-origin-suggestions');
  if (busOrigin && busOriginSuggestions) {
    setupAutocomplete(busOrigin, busOriginSuggestions);
  }
  const busDest = document.getElementById('bus-destination-input');
  const busDestSuggestions = document.getElementById('bus-destination-suggestions');
  if (busDest && busDestSuggestions) {
    setupAutocomplete(busDest, busDestSuggestions);
  }

  // 5. Swap Button Logic
  const swapBtn = document.getElementById('swapLocationsButton');
  if (swapBtn && originInput && destinationInput) {
    swapBtn.addEventListener('click', () => {
      const temp = originInput.value;
      originInput.value = destinationInput.value;
      destinationInput.value = temp;
    });
  }

  // Vacations Swap
  const vacSwap = document.getElementById('vacationSwapButton');
  if (vacSwap && vacOrigin && vacDest) {
    vacSwap.addEventListener('click', () => {
      const temp = vacOrigin.value;
      vacOrigin.value = vacDest.value;
      vacDest.value = temp;
    });
  }

  // Bus Swap
  const busSwap = document.getElementById('busSwapButton');
  if (busSwap && busOrigin && busDest) {
    busSwap.addEventListener('click', () => {
      const temp = busOrigin.value;
      busOrigin.value = busDest.value;
      busDest.value = temp;
    });
  }

  // 6. Dynamic Date Picker Restrictions (min constraints)
  const todayStr = new Date().toISOString().split('T')[0];

  const setupDateMinConstraints = (departInputId, returnInputId) => {
    const dep = document.getElementById(departInputId);
    const ret = document.getElementById(returnInputId);

    if (dep) {
      dep.addEventListener('focus', () => {
        dep.min = todayStr;
      });

      dep.addEventListener('change', () => {
        if (ret) {
          ret.min = dep.value;
          if (ret.value && ret.value < dep.value) {
            ret.value = '';
          }
        }
      });
    }

    if (ret) {
      ret.addEventListener('focus', () => {
        ret.min = dep && dep.value ? dep.value : todayStr;
      });
    }
  };

  setupDateMinConstraints('depart-date-input', 'return-date-input'); // Flights
  setupDateMinConstraints('hotel-checkin-input', 'hotel-checkout-input'); // Hotels
  setupDateMinConstraints('vacation-depart-input', 'vacation-return-input'); // Vacations
  setupDateMinConstraints('car-pickup-date-input', 'car-dropoff-date-input'); // Cars
  setupDateMinConstraints('bus-journey-date-input', 'bus-return-date-input'); // Bus
});
