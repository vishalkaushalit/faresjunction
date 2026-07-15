@php
    $inquiryPrefix = $inquiryPrefix ?? 'travel';
    $inquiryInterest = $inquiryInterest ?? 'our travel offers';
    $inquirySource = $inquirySource ?? 'blog';
    $inquiryPackageSlug = $inquiryPackageSlug ?? null;
@endphp

<div class="inquiry-card">
    <form class="inquiry-form-new" id="{{ $inquiryPrefix }}InquiryForm" data-inquiry-form action="{{ route('package-inquiries.store') }}" method="POST">
        @csrf
        <input type="hidden" name="source" value="{{ $inquirySource }}">
        <input type="hidden" name="interest" value="{{ $inquiryInterest }}">
        @if ($inquiryPackageSlug)<input type="hidden" name="package_slug" value="{{ $inquiryPackageSlug }}">@endif
        <div class="input-field-group">
            <input type="text" name="name" data-inquiry-name placeholder="Name*" required>
        </div>
        <div class="input-field-group">
            <input type="email" name="email" data-inquiry-email placeholder="Email*" required>
        </div>
        <div class="input-field-group">
            <input type="tel" name="phone" data-inquiry-phone placeholder="Your Phone*" required>
        </div>
        <div class="form-row-side-by-side">
            <div class="input-field-group date-wrapper">
                <input type="text" name="travel_date" data-inquiry-date placeholder="Travel Date"
                    onfocus="this.type='date'" onblur="if(!this.value)this.type='text'" required>
                <svg class="calendar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                </svg>
            </div>
            <div class="input-field-group count-wrapper">
                <input type="number" name="traveler_count" data-inquiry-count min="1" max="99" value="1" required>
            </div>
        </div>
        <div class="input-field-group">
            <textarea name="message" data-inquiry-message placeholder="Message" rows="3"></textarea>
        </div>
        <button type="submit" class="inquiry-submit-btn-orange">Send Enquiry</button>
    </form>

    <div class="inquiry-success-msg" data-inquiry-success>
        <div class="success-check-icon">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12" /></svg>
        </div>
        <h4 class="success-title">Inquiry Submitted!</h4>
        <p class="success-desc">Thank you for your interest in <strong>{{ $inquiryInterest }}</strong>. One of our destination specialists will contact you shortly.</p>
    </div>
</div>
