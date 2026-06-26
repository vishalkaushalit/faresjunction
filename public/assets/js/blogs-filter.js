document.addEventListener('DOMContentLoaded', () => {

  const tabButtons = document.querySelectorAll('#blogFilterTabs .filter-tab-btn');
  const searchInput = document.getElementById('blogSearchInput');
  const blogCards = document.querySelectorAll('#blogsListingGrid .blog-card');
  const noResultsMsg = document.getElementById('noBlogsFoundMessage');

  let activeCategory = 'all';
  let searchQuery = '';

  // Filter logic function
  const applyFilters = () => {
    let visibleCount = 0;

    blogCards.forEach(card => {
      const cardCategory = card.getAttribute('data-category');
      const cardTitle = card.getAttribute('data-title') || '';
      
      const matchesCategory = (activeCategory === 'all' || cardCategory === activeCategory);
      const matchesSearch = cardTitle.includes(searchQuery);

      if (matchesCategory && matchesSearch) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (noResultsMsg) {
      noResultsMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
    }
  };

  // Tab Button Click Handler
  tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      tabButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      activeCategory = btn.getAttribute('data-category');
      applyFilters();
    });
  });

  // Search Input Keyup/Input Handler
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      searchQuery = e.target.value.toLowerCase().trim();
      applyFilters();
    });
  }

});
