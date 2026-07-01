<?php
require resource_path('views/layouts/includes/blogs-data.php');
require resource_path('views/layouts/includes/packages-data.php');

if (!empty($databasePost)) {
    $postKey = $databasePost->slug;
    $blog = [
        'title' => $databasePost->title,
        'excerpt' => $databasePost->excerpt ?: str($databasePost->content)->stripTags()->limit(160)->toString(),
        'tag' => $databasePost->category?->name ?? 'Travel',
        'author' => $databasePost->author?->name ?? 'Fond Travels',
        'date' => optional($databasePost->published_at ?? $databasePost->created_at)->format('F j, Y'),
        'readTime' => ceil(str_word_count(strip_tags($databasePost->content)) / 200) . ' min read',
        'image' => $databasePost->featured_image ? asset('storage/' . $databasePost->featured_image) : asset('dashboardAssets/img/news-1.jpg'),
        'imageAlt' => $databasePost->featured_image_alt ?: $databasePost->title,
        'content' => $databasePost->content,
        'tags' => $databasePost->tags
            ->map(fn ($tag) => ['name' => $tag->name, 'slug' => $tag->slug])
            ->all(),
        'tableOfContents' => $databasePost->table_of_contents ?? [],
    ];
} else {
    // Resolve post from route slug or legacy query parameter, fallback to default
    $postKey = $postKey ?? ($_GET['post'] ?? 'best-time-to-visit-europe');
    if (!isset($blogsData[$postKey])) {
        $postKey = 'best-time-to-visit-europe';
    }

    $blog = $blogsData[$postKey];
    $blog['imageAlt'] = $blog['imageAlt'] ?? $blog['title'];
    $blog['tags'] = $blog['tags'] ?? [];
    $blog['tableOfContents'] = $blog['tableOfContents'] ?? [];
}

$pageTitle = $blog['title'] . " | Travel Blog & Insights";
$pageDescription = $blog['excerpt'];
$extraCSS = ['css/blog-details.css'];
$extraJS = ['js/blog-details.js'];

ob_start();
?>
        <!-- Breadcrumbs -->
        <div class="breadcrumb-container">
          <div class="container">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php#blog">Blogs</a></li>
              <li id="breadcrumb-active"><?php echo htmlspecialchars($blog['title']); ?></li>
            </ul>
          </div>
        </div>

        <!-- Main Blog Details Section -->
        <section class="blog-details-section">
          <div class="container">
            <div class="blog-details-grid">
              
              <!-- Left Column: Blog Post Content -->
              <article class="blog-post-card">
                <div class="blog-post-header">
                  <span class="blog-post-tag"><?php echo htmlspecialchars($blog['tag']); ?></span>
                  <h1 class="blog-post-title"><?php echo htmlspecialchars($blog['title']); ?></h1>
                  
                  <div class="blog-post-meta">
                    <div class="blog-post-meta-item">
                      <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                      <span>By <strong><?php echo htmlspecialchars($blog['author']); ?></strong></span>
                    </div>
                    <div class="blog-post-meta-item">
                      <svg viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5C3.89 3 3 3.9 3 5v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/></svg>
                      <span>Published on <?php echo htmlspecialchars($blog['date']); ?></span>
                    </div>
                    <div class="blog-post-meta-item">
                      <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 10h3l-4 4-4-4h3V7h2v5z"/></svg>
                      <span><?php echo htmlspecialchars($blog['readTime']); ?></span>
                    </div>
                  </div>
                </div>

                <div class="blog-post-banner">
                  <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="<?php echo htmlspecialchars($blog['imageAlt']); ?>">
                </div>

                <?php if (!empty($blog['tags'])) { ?>
                <div class="blog-post-tags" aria-label="Blog tags">
                  <?php foreach ($blog['tags'] as $tag) { ?>
                    <?php
                        $tagName = is_array($tag) ? ($tag['name'] ?? '') : $tag;
                        $tagSlug = is_array($tag) ? ($tag['slug'] ?? \Illuminate\Support\Str::slug($tagName)) : \Illuminate\Support\Str::slug($tagName);

                        if ($tagName === '') {
                            continue;
                        }
                    ?>
                    <a href="<?php echo route('website.blog', ['tag' => $tagSlug], false); ?>"><?php echo htmlspecialchars($tagName); ?></a>
                  <?php } ?>
                </div>
                <?php } ?>

                <?php if (!empty($blog['tableOfContents'])) { ?>
                <nav class="blog-table-of-contents" aria-label="Table of Contents">
                  <div class="toc-heading">
                    <span class="toc-heading-icon">&#9776;</span>
                    <h2>Table of Contents</h2>
                  </div>
                  <ul>
                    <?php foreach ($blog['tableOfContents'] as $tocItem) {
                        $tocTitle = $tocItem['title'] ?? '';
                        $tocLink = $tocItem['link'] ?? '#';

                        if ($tocTitle === '') {
                            continue;
                        }
                        ?>
                        <li>
                          <a href="<?php echo htmlspecialchars($tocLink); ?>"><?php echo htmlspecialchars($tocTitle); ?></a>
                        </li>
                    <?php } ?>
                  </ul>
                </nav>
                <?php } ?>

                <div class="blog-post-body">
                  <?php echo $blog['content']; ?>
                </div>
              </article>

              <!-- Right Column: Sticky Sidebar -->
              <aside class="blog-sidebar-sticky">
                
                <!-- Book Your Trip CTA Widget -->
                <div class="sidebar-widget sidebar-cta-widget">
                  <h3 class="cta-widget-title">Exclusive Flight Offers!</h3>
                  <p class="cta-widget-desc">Get unpublished airline fares and custom vacation packages. Speak to our booking experts now.</p>
                  <a href="tel:+13238006001" class="cta-widget-btn">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 00-1.01.24l-2.2 2.2a15.045 15.045 0 01-6.59-6.59l2.2-2.21a.96.96 0 00.25-1A11.36 11.36 0 018.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1z"/></svg>
                    +1 (323) 800-6001
                  </a>
                </div>

                <!-- Recent / Other Articles Widget -->
                <div class="sidebar-widget">
                  <h3 class="widget-title">Recent Articles</h3>
                  <div class="widget-posts-list">
                    <?php 
                    foreach ($blogsData as $key => $recentPost) {
                        if ($key === $postKey) continue; // Skip current post
                        ?>
                        <a href="<?php echo route('website.blog-details', ['slug' => $key], false); ?>" class="widget-post-item">
                          <div class="widget-post-img">
                            <img src="<?php echo htmlspecialchars($recentPost['image']); ?>" alt="<?php echo htmlspecialchars($recentPost['title']); ?>" loading="lazy">
                          </div>
                          <div class="widget-post-info">
                            <h4 class="widget-post-title"><?php echo htmlspecialchars($recentPost['title']); ?></h4>
                            <span class="widget-post-date"><?php echo htmlspecialchars($recentPost['date']); ?></span>
                          </div>
                        </a>
                        <?php
                    }
                    ?>
                  </div>
                </div>

                <!-- Trending Vacation Offers Widget -->
                <div class="sidebar-widget">
                  <h3 class="widget-title">Trending Tours</h3>
                  <div class="widget-posts-list">
                    <?php 
                    $count = 0;
                    foreach ($packagesData as $pkgKey => $pkg) {
                        if ($count >= 2) break; // Display top 2 packages
                        $count++;
                        ?>
                        <a href="package-details.php?package=<?php echo urlencode($pkgKey); ?>" class="widget-post-item">
                          <div class="widget-post-img">
                            <img src="<?php echo htmlspecialchars($pkg['heroImage']); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>" loading="lazy">
                          </div>
                          <div class="widget-post-info">
                            <h4 class="widget-post-title"><?php echo htmlspecialchars($pkg['title']); ?></h4>
                            <span class="widget-post-date" style="color: var(--secondary-color); font-weight: 700;"><?php echo htmlspecialchars($pkg['price']); ?></span>
                          </div>
                        </a>
                        <?php
                    }
                    ?>
                  </div>
                </div>

              </aside>

            </div>
          </div>
        </section>

<?php
$extraCSS = $extraCSS ?? [];
$extraJS = $extraJS ?? [];
$slot = new \Illuminate\Support\HtmlString(ob_get_clean());

echo view("layouts.guest", compact(
    "slot",
    "pageTitle",
    "pageDescription",
    "extraCSS",
    "extraJS",
))->render();
?>
