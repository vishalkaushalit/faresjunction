<?php
$pageTitle = "Terms & Conditions - Booking Policies & Rules | Fares Junction";
$pageDescription = "Review Fares Junction' terms and conditions, booking agreements, flight cancellation policies, and refund rules.";
ob_start();
?>

<div style="padding: 5rem 0; background-color: var(--gray-100); min-height: 60vh;">
  <div class="container" style="max-width: 800px; margin: 0 auto;">
    <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--primary-color); border-bottom: 2px solid var(--gray-200); padding-bottom: 0.75rem; margin-bottom: 1.5rem;">Terms &amp; Conditions</h1>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
      Last Updated: June 18, 2026
    </p>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
      Welcome to Fares Junction. Please read these Terms and Conditions carefully before using our booking services, website, or speaking to our travel agents. By making a booking with us, you agree to comply with all terms stated herein.
    </p>
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-top: 1.5rem; margin-bottom: 0.75rem;">1. Booking Agreements</h3>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
      All bookings are subject to availability and airline/hotel booking restrictions. Airfares and prices are dynamic and are only guaranteed once ticketing is completed and payment is fully cleared.
    </p>
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-top: 1.5rem; margin-bottom: 0.75rem;">2. Cancellations and Changes</h3>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1rem;">
      Most low-cost flight bookings and promotional packages are non-refundable and non-transferable. Airline change penalties, fare differences, and agency processing fees apply to all modification requests.
    </p>
    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--primary-color); margin-top: 1.5rem; margin-bottom: 0.75rem;">3. Passports and Visas</h3>
    <p style="color: var(--gray-800); font-size: 1rem; line-height: 1.6; margin-bottom: 1.5rem;">
      It is the sole responsibility of the traveler to ensure passport validity (minimum 6 months from travel date), secure valid visa approvals, and carry required vaccinations or travel documentation.
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
