document.addEventListener("DOMContentLoaded", () => {
    const postBody = document.querySelector('.blog-post-body');
    if (!postBody) return;
    const headings = postBody.querySelectorAll('h3');
    if (headings.length === 0) return;

    // Create TOC container
    const tocContainer = document.createElement('div');
    tocContainer.className = 'toc-box';
    
    const tocTitle = document.createElement('button');
    tocTitle.className = 'toc-title';
    tocTitle.type = 'button';
    tocTitle.setAttribute('aria-expanded', 'true');
    tocTitle.setAttribute('aria-controls', 'blog-table-of-contents-list');
    tocTitle.innerHTML = `
        <span class="toc-title-label">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <line x1="8" y1="6" x2="21" y2="6"></line>
            <line x1="8" y1="12" x2="21" y2="12"></line>
            <line x1="8" y1="18" x2="21" y2="18"></line>
            <line x1="3" y1="6" x2="3.01" y2="6"></line>
            <line x1="3" y1="12" x2="3.01" y2="12"></line>
            <line x1="3" y1="18" x2="3.01" y2="18"></line>
        </svg>
        Table of Contents
        </span>
        <svg class="toc-toggle-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    `;
    tocContainer.appendChild(tocTitle);

    const tocList = document.createElement('ul');
    tocList.className = 'toc-list mb-0';
    tocList.id = 'blog-table-of-contents-list';

    headings.forEach((heading, index) => {
        const id = 'heading-' + index;
        heading.id = id;
        
        const listItem = document.createElement('li');
        const link = document.createElement('a');
        link.href = '#' + id;
        link.textContent = heading.textContent;
        link.className = 'toc-link';
        
        listItem.appendChild(link);
        tocList.appendChild(listItem);
    });

    tocContainer.appendChild(tocList);

    tocTitle.addEventListener('click', () => {
        const isCollapsed = tocContainer.classList.toggle('is-collapsed');
        tocTitle.setAttribute('aria-expanded', String(!isCollapsed));
        tocList.setAttribute('aria-hidden', String(isCollapsed));

        if (isCollapsed) {
            tocList.setAttribute('inert', '');
        } else {
            tocList.removeAttribute('inert');
        }
    });

    // Insert before the first heading
    const firstHeading = postBody.querySelector('h3');
    if (firstHeading) {
        postBody.insertBefore(tocContainer, firstHeading);
    } else {
        postBody.prepend(tocContainer);
    }
});
