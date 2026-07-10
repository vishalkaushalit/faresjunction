# Airline Page Layout

This folder contains the Fares Junction airline detail layout.

## Main File

- `airline.blade.php` renders the airline banner, flight search widget, title area, sidebar navigation, main content, popular routes, and FAQ section.
- The page uses `resources/views/layouts/airline.blade.php` for the shared header, footer, scripts, and global website layout.

## Sidebar Behavior

The sidebar is link-based navigation, not tab navigation.

Each sidebar item loads the same airline page with query parameters:

```text
/airlines/american-airlines/baggage
```

The first path value selects the airline data. The second path value selects the active sidebar page content.

## Adding Another Airline

Add a new item to the `$airlines` array in `airline.blade.php`.

Required keys:

- `name`
- `code`
- `intro`
- `routes`

Example:

```php
'new-airline' => [
    'name' => 'New Airline',
    'code' => 'NA',
    'intro' => 'Intro text for the airline page.',
    'routes' => [
        'New York (JFK) to Los Angeles (LAX)',
    ],
],
```

Then open it with:

```text
/airlines/new-airline
```

## Adding Sidebar Pages

Update the `$sidebarPages` array to add, remove, or rename sidebar links. If a new section key is added, also add matching content in `$contentMap`.

## Assets Used

- `public/assets/css/hero.css` for the existing search widget styling.
- `public/assets/js/search.js` for the flight search interactions.
- `public/assets/css/airline.css` for the airline banner, title area, sidebar, content cards, popular routes, and FAQ styling.
- `public/assets/images/airline_banner_bg.png` for the airline hero background.
