@php
    $listFields = [
        'highlights' => ['Highlights', 'Enter a package highlight'],
        'inclusions' => ['Inclusions', 'Enter an included item'],
        'exclusions' => ['Exclusions', 'Enter an excluded item'],
        'notes' => ['Important notes', 'Enter an important note'],
    ];
    $structuredSections = [
        'itinerary' => ['label' => 'Itinerary', 'fields' => [
            ['day', 'Day', 'number', 2, '1'], ['title', 'Title', 'text', 10, 'Arrival in Bangkok'],
            ['description', 'Description', 'textarea', 12, 'Describe this day of the itinerary'],
        ]],
        'hotels' => ['label' => 'Hotels', 'fields' => [
            ['city', 'City', 'text', 3, 'Bangkok'], ['name', 'Hotel name', 'text', 5, 'Hotel name or similar'],
            ['rating', 'Rating', 'number', 4, '5'], ['desc', 'Description', 'textarea', 12, 'Hotel details'],
        ]],
        'activities' => ['label' => 'Activities', 'fields' => [
            ['name', 'Activity name', 'text', 6, 'City Tour'], ['image', 'Activity image', 'file', 6, ''],
            ['desc', 'Description', 'textarea', 12, 'Activity details'],
        ]],
        'pricing' => ['label' => 'Pricing options', 'fields' => [
            ['tier', 'Package option', 'text', 3, 'Standard Package'], ['hotelType', 'Hotel tier', 'text', 3, '3-Star Hotels'],
            ['price', 'Starting price', 'text', 3, 'USD 799'], ['description', 'Package details', 'textarea', 12, 'Pricing details'],
        ]],
        'reviews' => ['label' => 'Reviews', 'fields' => [
            ['name', 'Traveler name', 'text', 4, 'Guest name'], ['date', 'Date', 'text', 4, 'July 2026'],
            ['rating', 'Rating', 'number', 4, '5'], ['text', 'Review', 'textarea', 12, 'Traveler review'],
        ]],
    ];
@endphp

<div class="row g-3 mb-3">
    <div class="col-md-8"><label class="form-label fw-bold">Title</label><input name="title" class="form-control" value="{{ old('title', $package?->title) }}" required></div>
    <div class="col-md-4"><label class="form-label fw-bold">Slug</label><input name="slug" class="form-control" value="{{ old('slug', $package?->slug) }}"><small class="text-muted">Generated from title if blank.</small></div>
    <div class="col-md-6"><label class="form-label fw-bold">Nights detail</label><input name="nights_detail" class="form-control" value="{{ old('nights_detail', $package?->nights_detail) }}" placeholder="2 Nights Bangkok & 3 Nights Phuket" required></div>
    <div class="col-md-2"><label class="form-label fw-bold">Duration</label><input name="duration" class="form-control" value="{{ old('duration', $package?->duration) }}" placeholder="5 Nights / 6 Days" required></div>
    <div class="col-md-2"><label class="form-label fw-bold">Price</label><input name="price" class="form-control" value="{{ old('price', $package?->price) }}" placeholder="USD 799" required></div>
    <div class="col-md-1"><label class="form-label fw-bold">Rating</label><input type="number" min="1" max="5" name="rating" class="form-control" value="{{ old('rating', $package?->rating ?? 5) }}" required></div>
    <div class="col-md-1"><label class="form-label fw-bold">Stars</label><input type="number" min="1" max="5" name="stars" class="form-control" value="{{ old('stars', $package?->stars ?? 5) }}" required></div>
    <div class="col-md-10"><label class="form-label fw-bold">Hero image URL</label><input name="hero_image" class="form-control" value="{{ old('hero_image', $package?->hero_image) }}" required></div>
    <div class="col-md-2"><label class="form-label fw-bold">Sort order</label><input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', $package?->sort_order ?? 0) }}"></div>
    <div class="col-12"><label class="form-label fw-bold">Overview</label><textarea name="overview" rows="4" class="form-control" required>{{ old('overview', $package?->overview) }}</textarea></div>
    <div class="col-12">
        <label for="gallery-images" class="form-label fw-bold">Gallery images</label>
        <input type="file" id="gallery-images" name="gallery_images[]" class="form-control" accept="image/*" multiple>
        <small class="text-muted">Select multiple images. Maximum 5 MB per image.</small>

        <div id="gallery-preview-grid" class="d-flex flex-wrap gap-3 mt-3">
            @foreach ($package?->gallery ?? [] as $image)
                <div class="package-gallery-preview position-relative border rounded overflow-hidden" style="width: 180px; height: 130px;" data-existing-image="{{ $image }}">
                    <input type="hidden" name="existing_gallery[]" value="{{ $image }}">
                    <img src="{{ $package->imageUrl($image) }}" alt="Gallery image" class="w-100 h-100" style="object-fit: cover;">
                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-gallery-image" aria-label="Delete image" title="Delete image"><i class="bi bi-trash"></i></button>
                </div>
            @endforeach
        </div>
    </div>
    @foreach ($listFields as $field => [$label, $placeholder])
        @php
            $items = old($field, $package?->{$field} ?? []);
            $items = count($items) ? $items : [''];
        @endphp
        <div class="col-md-6" data-list-section="{{ $field }}">
            <label class="form-label fw-bold">{{ $label }}</label>
            <div class="list-item-rows">
                @foreach ($items as $item)
                    <div class="list-item-row input-group mb-2">
                        <input type="text" name="{{ $field }}[]" class="form-control" value="{{ $item }}" placeholder="{{ $placeholder }}">
                        <button type="button" class="btn btn-outline-danger remove-list-item" aria-label="Delete row" title="Delete row"><i class="bi bi-trash"></i></button>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary add-list-item"><i class="bi bi-plus-circle me-1"></i>Add row</button>
        </div>
    @endforeach
    @php
        $selectedRelated = array_map('strval', old('related_slugs', $package?->related_slugs ?? []));
    @endphp
    <div class="col-md-6">
        <label class="form-label fw-bold">Related packages</label>
        <div class="dropdown" id="related-packages-dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start d-flex justify-content-between align-items-center" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <span id="related-packages-label">Select related packages</span>
            </button>
            <div class="dropdown-menu w-100 p-2 shadow" style="max-height: 300px; overflow-y: auto;">
                @forelse ($availablePackages as $relatedPackage)
                    <label class="dropdown-item d-flex align-items-start gap-2 py-2" style="white-space: normal; cursor: pointer;">
                        <input type="checkbox" name="related_slugs[]" value="{{ $relatedPackage->slug }}" class="form-check-input related-package-checkbox mt-1" @checked(in_array($relatedPackage->slug, $selectedRelated, true))>
                        <span>
                            <strong>{{ $relatedPackage->title }}</strong>
                            <small class="d-block text-muted">{{ $relatedPackage->slug }}{{ $relatedPackage->status ? '' : ' · Inactive' }}</small>
                        </span>
                    </label>
                @empty
                    <span class="dropdown-item-text text-muted">No other packages are available.</span>
                @endforelse
            </div>
        </div>
        <small class="text-muted">Open the dropdown and select multiple packages using the checkboxes.</small>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-list-section]').forEach((section) => {
            const rows = section.querySelector('.list-item-rows');
            const fieldName = section.dataset.listSection;

            section.querySelector('.add-list-item').addEventListener('click', () => {
                const newRow = rows.querySelector('.list-item-row').cloneNode(true);
                const input = newRow.querySelector('input');
                input.value = '';
                input.name = `${fieldName}[]`;
                rows.appendChild(newRow);
                input.focus();
            });

            rows.addEventListener('click', (event) => {
                const button = event.target.closest('.remove-list-item');
                if (! button) return;

                const allRows = rows.querySelectorAll('.list-item-row');
                if (allRows.length === 1) {
                    allRows[0].querySelector('input').value = '';
                } else {
                    button.closest('.list-item-row').remove();
                }
            });
        });

        const input = document.getElementById('gallery-images');
        const grid = document.getElementById('gallery-preview-grid');
        const deleteUrl = @json($package?->exists ? route('admin-packages.gallery-image.destroy', $package) : null);
        let selectedFiles = [];

        const syncInput = () => {
            const transfer = new DataTransfer();
            selectedFiles.forEach((file) => transfer.items.add(file));
            input.files = transfer.files;
        };

        const renderSelectedFiles = () => {
            grid.querySelectorAll('[data-new-image]').forEach((preview) => preview.remove());
            selectedFiles.forEach((file, index) => {
                const preview = document.createElement('div');
                preview.className = 'package-gallery-preview position-relative border rounded overflow-hidden';
                preview.style.cssText = 'width: 180px; height: 130px;';
                preview.dataset.newImage = index;
                preview.innerHTML = `<img alt="Selected gallery image" class="w-100 h-100" style="object-fit:cover"><button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-new-gallery-image" data-index="${index}" aria-label="Remove selected image" title="Remove image"><i class="bi bi-trash"></i></button>`;
                preview.querySelector('img').src = URL.createObjectURL(file);
                grid.appendChild(preview);
            });
        };

        input.addEventListener('change', () => {
            selectedFiles = [...selectedFiles, ...Array.from(input.files)];
            syncInput();
            renderSelectedFiles();
        });

        grid.addEventListener('click', async (event) => {
            const newRemoveButton = event.target.closest('.remove-new-gallery-image');
            if (newRemoveButton) {
                selectedFiles.splice(Number(newRemoveButton.dataset.index), 1);
                syncInput();
                renderSelectedFiles();
                return;
            }

            const existingRemoveButton = event.target.closest('.remove-gallery-image');
            if (! existingRemoveButton) return;

            const preview = existingRemoveButton.closest('[data-existing-image]');
            if (! deleteUrl || ! confirm('Delete this gallery image?')) return;

            existingRemoveButton.disabled = true;
            try {
                const response = await fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                    body: JSON.stringify({image: preview.dataset.existingImage}),
                });
                if (! response.ok) throw new Error('Unable to delete the image.');
                preview.remove();
            } catch (error) {
                existingRemoveButton.disabled = false;
                alert(error.message);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = Array.from(document.querySelectorAll('.related-package-checkbox'));
        const label = document.getElementById('related-packages-label');

        const updateRelatedLabel = () => {
            const selected = checkboxes.filter((checkbox) => checkbox.checked);
            if (selected.length === 0) {
                label.textContent = 'Select related packages';
            } else if (selected.length === 1) {
                label.textContent = selected[0].closest('label').querySelector('strong').textContent.trim();
            } else {
                label.textContent = `${selected.length} packages selected`;
            }
        };

        checkboxes.forEach((checkbox) => checkbox.addEventListener('change', updateRelatedLabel));
        updateRelatedLabel();
    });
</script>

<div class="accordion mb-3" id="packageStructuredData">
    @foreach ($structuredSections as $sectionKey => $section)
        @php
            $rows = old($sectionKey, $package?->{$sectionKey} ?? []);
            $rows = count($rows) ? $rows : [[]];
        @endphp
        <div class="accordion-item">
            <h2 class="accordion-header"><button class="accordion-button {{ $loop->first ? '' : 'collapsed' }} fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#package-{{ $sectionKey }}">{{ $section['label'] }}</button></h2>
            <div id="package-{{ $sectionKey }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#packageStructuredData">
                <div class="accordion-body" data-repeatable-section="{{ $sectionKey }}">
                    <div class="repeatable-rows">
                        @foreach ($rows as $rowIndex => $row)
                            <div class="repeatable-row border rounded p-3 mb-3 bg-light">
                                <div class="row g-3">
                                    @foreach ($section['fields'] as [$fieldKey, $fieldLabel, $fieldType, $columnWidth, $placeholder])
                                        @php
                                            $fieldValue = $row[$fieldKey] ?? '';
                                            if ($sectionKey === 'hotels' && $fieldKey === 'rating' && ! is_numeric($fieldValue)) {
                                                $fieldValue = substr_count((string) $fieldValue, '★') ?: '';
                                            }
                                        @endphp
                                        <div class="col-md-{{ $columnWidth }}">
                                            <label class="form-label fw-bold">{{ $fieldLabel }}</label>
                                            @if ($fieldType === 'textarea')
                                                <textarea name="{{ $sectionKey }}[{{ $rowIndex }}][{{ $fieldKey }}]" rows="3" class="form-control" placeholder="{{ $placeholder }}">{{ $fieldValue }}</textarea>
                                            @elseif ($fieldType === 'file')
                                                @php($activityImage = $row[$fieldKey] ?? $row['current_image'] ?? '')
                                                <input type="hidden" name="{{ $sectionKey }}[{{ $rowIndex }}][current_image]" value="{{ $activityImage }}" class="activity-current-image">
                                                <input type="file" name="{{ $sectionKey }}[{{ $rowIndex }}][image_file]" class="form-control activity-image-input" accept="image/*">
                                                <div class="activity-image-preview mt-2 {{ empty($activityImage) ? 'd-none' : '' }}">
                                                    <img src="{{ $activityImage ? $package?->imageUrl($activityImage) : '' }}" alt="Activity image preview" class="rounded border" style="width: 140px; height: 95px; object-fit: cover;">
                                                </div>
                                            @else
                                                <input type="{{ $fieldType }}" name="{{ $sectionKey }}[{{ $rowIndex }}][{{ $fieldKey }}]" class="form-control" value="{{ $fieldValue }}" placeholder="{{ $placeholder }}" @if ($fieldType === 'number') min="1" @if (in_array($sectionKey, ['hotels', 'reviews'], true)) max="5" @endif @endif>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="col-12"><button type="button" class="btn btn-sm btn-outline-danger remove-structured-row"><i class="bi bi-trash me-1"></i>Remove row</button></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary add-structured-row"><i class="bi bi-plus-circle me-1"></i>Add {{ rtrim($section['label'], 's') }} row</button>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-repeatable-section]').forEach((section) => {
            const rows = section.querySelector('.repeatable-rows');
            const sectionName = section.dataset.repeatableSection;

            const reindex = () => {
                rows.querySelectorAll('.repeatable-row').forEach((row, index) => {
                    row.querySelectorAll('[name]').forEach((field) => {
                        field.name = field.name.replace(new RegExp(`^${sectionName}\\[\\d+\\]`), `${sectionName}[${index}]`);
                    });
                });
            };

            section.querySelector('.add-structured-row').addEventListener('click', () => {
                const newRow = rows.querySelector('.repeatable-row').cloneNode(true);
                newRow.querySelectorAll('input, textarea').forEach((field) => field.value = '');
                newRow.querySelectorAll('.activity-image-preview').forEach((preview) => {
                    preview.classList.add('d-none');
                    preview.querySelector('img').removeAttribute('src');
                });
                rows.appendChild(newRow);
                reindex();
            });

            rows.addEventListener('click', (event) => {
                const button = event.target.closest('.remove-structured-row');
                if (! button) return;

                const allRows = rows.querySelectorAll('.repeatable-row');
                if (allRows.length === 1) {
                    allRows[0].querySelectorAll('input, textarea').forEach((field) => field.value = '');
                } else {
                    button.closest('.repeatable-row').remove();
                    reindex();
                }
            });

            rows.addEventListener('change', (event) => {
                if (! event.target.classList.contains('activity-image-input') || ! event.target.files[0]) return;

                const row = event.target.closest('.repeatable-row');
                const preview = row.querySelector('.activity-image-preview');
                preview.querySelector('img').src = URL.createObjectURL(event.target.files[0]);
                preview.classList.remove('d-none');
            });
        });
    });
</script>

<div class="row g-3 mb-3">
    <div class="col-md-6"><label class="form-label fw-bold">Meta title</label><input name="meta_title" class="form-control" value="{{ old('meta_title', $package?->meta_title) }}"></div>
    <div class="col-md-6"><label class="form-label fw-bold">Meta description</label><textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description', $package?->meta_description) }}</textarea></div>
    <div class="col-12"><input type="hidden" name="status" value="0"><div class="form-check"><input type="checkbox" id="package-status" name="status" value="1" class="form-check-input" @checked((int) old('status', $package?->exists ? $package->status : 1) === 1)><label for="package-status" class="form-check-label fw-bold">Active</label></div></div>
</div>
