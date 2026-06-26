# Fond Travels Clone Specification Document

This document defines the layout hierarchy, styling design system, and component guidelines for the fondtravels.com clone.

---

## 1. Section Hierarchy

The home page follows a traditional, conversion-oriented travel agency structure:
1. **Top Bar & Header**: Critical contact info (toll-free number), main nav links, booking search categories.
2. **Hero / Search Form**: Immersive travel banner with a highly detailed, tabbed booking engine (Flights, Hotels, Packages).
3. **Deals & Offers**: Categorized grid of current hot travel deals (e.g., flight discounts, holiday promotions).
4. **Destinations Showcase**: Image-rich grids of trending global destinations.
5. **Why Choose Us / Features**: Highlights of value propositions (best price guarantee, 24/7 support, easy booking).
6. **Testimonials**: Customer review slider (leveraging Trustpilot ratings style).
7. **Blog / Travel Guide**: Cards with travel guides, planning tips, and articles.
8. **Footer**: Deep links to popular flight routes, airline portals, legal documents, contact info, and accepted payments.

---

## 2. Component Structures

### Header Structure
- **Top Bar**:
  - Left: "Customer Support 24/7" badge and social media icons.
  - Right: Phone icon with click-to-call link (`tel:+13238006001`) displaying the toll-free support number.
- **Main Navigation Bar**:
  - Brand Logo: "Fond Travels" logo (Deep Blue text with Orange airplane/swoosh).
  - Navigation Menu: Links to `Flights`, `Hotels`, `Cars`, `Packages`, `About Us`, and `Contact`.
  - Mobile Menu Trigger: Hamburger menu icon toggling a side-drawer or full-screen navigation on smaller screens.

### Hero Structure
- **Background Banner**: Large, optimized background image or slider displaying inspiring travel locations (e.g., sandy beaches, historic cities) overlaid with a dark blue linear gradient (`rgba(15, 41, 77, 0.6)`) to ensure text contrast.
- **Hero Typography**:
  - Eyebrow header: "Explore the World & Save More"
  - Primary title (H1): "Find Cheap Flights & Hotel Deals"

### Search Widget Structure
The booking console is the most complex component and requires strict structural definition:
- **Booking Tabs**: Top buttons for switching modes (`Flights`, `Hotels`, `Packages`). Active tab styled with active brand colors.
- **Trip Modifiers**: Select options/radios for:
  - Trip Type: Round Trip, One Way, Multi-City.
  - Cabin Class: Economy, Premium Economy, Business, First Class.
  - Passenger Count Selector: Interactive dropdown separating Adults, Children, and Infants.
- **Input Fields Grid**:
  - Origin Input: Searchable field with airport auto-suggest dropdown.
  - Destination Input: Searchable field with airport auto-suggest dropdown.
  - Depart Date: Datepicker calendar selector.
  - Return Date: Datepicker calendar selector (disabled if One Way is selected).
- **Search Button**: High-contrast, large orange button with search icon.

### Destinations Section
- **Header**: Main title "Trending Global Destinations" and subtitle.
- **Grid Layout**: Responsive grid containing card modules for top cities:
  - London, Paris, New York, Tokyo, Dubai, Rome.
- **Destination Card Elements**:
  - Image: Hover scale transition effect.
  - Overlay: Dark gradient showing City Name, Country, and "Explore Deals" link.

### Deals Section
- **Category Tabs**: Filter deals by categories (e.g., Domestic Flights, International Flights, Last-Minute Deals).
- **Deals Cards**:
  - Airline logo and airline name.
  - Route (e.g., New York (NYC) to Orlando (MCO)).
  - Price: "Fares starting from $X".
  - CTA Button: "Book Now" link.

### Testimonials Section
- **Header**: "What Our Travelers Say" + Trustpilot badge.
- **Slider Container**: Swipeable/draggable slide panels displaying:
  - Star rating (5-star icons in green/gold).
  - Review title & detailed description.
  - Traveler name & booking date.
  - Verified booking badge.

### Blog Section
- **Grid Layout**: 3-column article list showing:
  - Featured thumbnail image.
  - Date published & author tag.
  - Title and short excerpt.
  - "Read More" text link with transition arrow.

### Footer Structure
- **Top Footer**: Four-column directory links:
  - *Popular Routes*: Flights from Chicago, Los Angeles, New York, etc.
  - *Airlines*: American, Delta, United, British Airways, Lufthansa.
  - *Company*: About Us, Contact, Blogs, Terms, Privacy Policy.
  - *Newsletter Sign-up*: Input field and button.
- **Bottom Footer**:
  - Contact Details: Toll-free number, support email, physical address.
  - Payment Gateways: SVG icons for Visa, Mastercard, American Express, Discover.
  - Copyright line: "© 2026 Fond Travels. All rights reserved."

---

## 3. Styling & Token Specifications

### Colors
- **Primary Blue**: `#0f294d` (Deep Navy used for headers, dark backgrounds, text headings).
- **Primary Accent Blue**: `#0d6efd` (Electric Blue used for links, highlighted badges, hover states).
- **Secondary Orange**: `#ff7b25` (Brilliant Orange used for main conversion buttons/CTAs, active tabs, review stars).
- **Neutral Light**: `#f4f6f9` (Cool Grey background for alternating sections, cards).
- **Neutral Dark**: `#1e293b` (Slate Grey for body text).
- **White**: `#ffffff` (Card backgrounds, header navigation, overlays).

### Typography
- **Primary Sans-Serif**: `Outfit`, sans-serif (used for all UI controls, body text, form elements, buttons).
- **Headings Font**: `Playfair Display`, serif (used selectively for section titles to convey a premium travel/editorial feel).
- **Font Sizes**:
  - H1: `2.5rem` to `3.5rem`
  - H2: `2.0rem` to `2.5rem`
  - H3: `1.5rem` to `1.75rem`
  - Body Text: `1rem` (16px)
  - Small Text / Labels: `0.875rem` (14px)

### Spacing & Grid System
- **Grid Container**: Max-width `1200px` centered with `1.5rem` padding on sides.
- **Section Padding**: `4rem` top & bottom spacing for desktop, scaling to `2.5rem` for mobile.
- **Component Gap**: `1.5rem` (24px) grid gap for cards.
- **Border Radius**: `8px` for buttons, cards, and input fields.

---

## 4. Responsive & Interactive Behavior

- **Mobile (< 576px)**:
  - Header: Branding on left, hamburger menu and call icon on right. Navigation links hide inside drawer.
  - Search Form: All tab options stack vertically; inputs go full-width.
  - Grids (Deals, Destinations, Blogs): Reflow to a single-column layout.
- **Tablet (576px - 992px)**:
  - Search Form: Grid transitions to 2 columns.
  - Cards: Grid displays 2 columns.
- **Desktop (> 992px)**:
  - Navigation: Full top-bar and main navigation menu displayed inline.
  - Search Form: Large horizontal layout grid.
  - Cards: Grid displays 3 to 4 columns.
- **Micro-Animations**:
  - Interactive inputs display a subtle drop-shadow or border color shift (`--primary-accent-blue`) on focus.
  - Buttons transition scale (`transform: scale(1.02)`) and background color smoothly over 200ms on hover.
  - Destination cards enlarge images (`transform: scale(1.05)`) with an overflow hidden boundary.
