<?php
$pageTitle = "Privacy Policy - User Data & Information Security | Fond Travels";
$pageDescription = "Read the Fond Travels privacy policy to understand how we collect, store, protect, and use your personal information during flight and hotel bookings.";
ob_start();
?>

<div style="padding: 5rem 0; background-color: var(--gray-100); min-height: 60vh;">
  <div class="container" style="max-width: 800px; margin: 0 auto;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--primary-color); border-bottom: 2px solid var(--gray-200); padding-bottom: 0.75rem; margin-bottom: 1.5rem;">Privacy Policy</h1>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
      Last Updated: June 18, 2026
    </p>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
      At Fond Travels, we value your trust and are committed to protecting your personal information. This Privacy Policy describes how we collect, use, and share your personal data when you visit our website, call our travel agents, or make a booking with us.
    </p>
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-top: 1.5rem; margin-bottom: 0.75rem;">1. Information We Collect</h3>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
      We collect personal details such as your full name, email address, phone number, travel dates, passport numbers, and billing details when you book flights, hotels, or vacation packages. We also collect anonymous analytical data about your browsing behavior.
    </p>
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-top: 1.5rem; margin-bottom: 0.75rem;">2. How We Use Your Information</h3>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
      We use your personal data to process bookings, issue flight tickets, send confirmation emails, request feedback, and provide 24/7 customer assistance.
    </p>
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-top: 1.5rem; margin-bottom: 0.75rem;">3. Data Security</h3>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1.5rem;">
      We implement industry-standard secure socket layer (SSL) encryption to protect your transaction data. We do not store full credit card details on our servers.
    </p>
    <a href="index.php" class="btn btn-call" style="display: inline-block; text-decoration: none; padding: 0.8rem 2rem; border-radius: var(--btn-radius); font-weight: 700;">Back to Home</a>
  </div>
</div>

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
