<?php
$blog['imageAlt'] = $blog['imageAlt'] ?? $blog['title'];
$blog['tags'] = $blog['tags'] ?? [];
$blog['tableOfContents'] = $blog['tableOfContents'] ?? [];
$recentPosts = $recentPosts ?? [];

$pageTitle = $blog['title'] . ' | Travel Blog & Insights';
$pageDescription = $blog['excerpt'];
$extraCSS = ['css/blog-details.css', 'css/flights.css', 'css/contact.css'];
$extraJS = ['js/blog-details.js', 'js/contact.js'];

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
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                            </svg>
                            <span>By <strong><?php echo htmlspecialchars($blog['author']); ?></strong></span>
                        </div>
                        <div class="blog-post-meta-item">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M19 3h-1V1h-2v2H8V1H6v2H5C3.89 3 3 3.9 3 5v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z" />
                            </svg>
                            <span>Published on <?php echo htmlspecialchars($blog['date']); ?></span>
                        </div>
                        <div class="blog-post-meta-item">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 10h3l-4 4-4-4h3V7h2v5z" />
                            </svg>
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
                    $tagName = is_array($tag) ? $tag['name'] ?? '' : $tag;
                    $tagSlug = is_array($tag) ? $tag['slug'] ?? \Illuminate\Support\Str::slug($tagName) : \Illuminate\Support\Str::slug($tagName);

                    if ($tagName === '') {
                        continue;
                    }
                    ?>
                    <a href="<?php echo route('website.blog', ['tag' => $tagSlug], false); ?>"><?php echo htmlspecialchars($tagName); ?></a>
                    <?php } ?>
                </div>
                <?php } ?>

                <div class="blog-post-body">
                    <?php echo $blog['content']; ?>
                </div>
            </article>

            <!-- Right Column: Sticky Sidebar -->
            <aside class="blog-sidebar-sticky">

                <div class="contact-form-wrapper p-4" id="contactFormContainer">
                    <h3 class="widget-title">Submit an Inquiry</h3>
                    <form id="contactInquiryForm" class="contact-form" method="POST" action="<?php echo route('contact.create'); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="contact_subject" value="Blog Detail Inquiry">

                        <div class="input-field-wrapper">
                            <input type="text" id="contact-name" name="contact_name" placeholder="Your Name*" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>

                        <div class="input-field-wrapper">
                            <input type="email" id="contact-email" name="contact_email" placeholder="Email ID*" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>

                        <div class="input-field-wrapper">
                            <input type="tel" id="contact-phone" name="contact_phone" placeholder="Phone Number*" required>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>

                        <div class="input-field-wrapper text-area-wrapper">
                            <textarea id="contact-message" name="contact_message" placeholder="Message*" rows="5" required></textarea>
                            <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>

                        <button type="submit" class="contact-submit-btn">Send Message</button>
                    </form>
                </div>

                <div class="banner-success-card contact-success-card" id="contactSuccessWidget" style="display: none;">
                    <div style="background-color: var(--secondary-color); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: var(--white);">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <h2>Inquiry Submitted!</h2>
                    <p>Thank you for contacting us, <span id="success-contact-name" style="color: var(--secondary-color); font-weight: 700;">traveler</span>. Our reservation desk will contact you within 2 business days.</p>
                </div>

                <!-- Recent / Other Articles Widget -->
                <div class="sidebar-widget">
                    <h3 class="widget-title">Recent Articles</h3>
                    <div class="widget-posts-list">
                        <?php
                    foreach ($recentPosts as $key => $recentPost) {
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
                        <a href="<?php echo route('website.package-details', $pkgKey); ?>" class="widget-post-item">
                            <div class="widget-post-img">
                                <img src="<?php echo htmlspecialchars($pkg['heroImage']); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>" loading="lazy">
                            </div>
                            <div class="widget-post-info">
                                <h4 class="widget-post-title"><?php echo htmlspecialchars($pkg['title']); ?></h4>
                                <span class="widget-post-date"
                                    style="color: var(--secondary-color); font-weight: 700;"><?php echo htmlspecialchars($pkg['price']); ?></span>
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

echo view('layouts.guest', compact('slot', 'pageTitle', 'pageDescription', 'extraCSS', 'extraJS'))->render();
?>
