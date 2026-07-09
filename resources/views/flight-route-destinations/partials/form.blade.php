@php
    $isPublished = (int) old('is_published', $item?->exists ? $item->is_published : 0) === 1;
@endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="image" class="form-label">{{ $imageLabel }}</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*">
        @if ($item?->image_url)
            <div class="mt-2">
                <img src="{{ $item->image_url }}" alt="{{ $item->route_text }}" width="120"
                    class="rounded border">
            </div>
        @endif
    </div>

    <div class="col-md-6 mb-3">
        <label for="route_text" class="form-label">{{ $itemLabel }}</label>
        <input type="text" id="route_text" name="route_text" class="form-control"
            value="{{ old('route_text', $item?->route_text) }}"
            placeholder="{{ $type === \App\Models\FlightRouteDestination::TYPE_ROUTE ? 'New York to London via Boston' : 'Dubai' }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label for="flight_category_id" class="form-label">Category Name</label>
        <select id="flight_category_id" name="flight_category_id" class="form-select">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('flight_category_id', $item?->flight_category_id) === $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="trip_type" class="form-label">Trip Type</label>
        <select id="trip_type" name="trip_type" class="form-select" required>
            <option value="">Select Trip Type</option>
            @foreach (\App\Models\FlightRouteDestination::TRIP_TYPES as $value => $label)
                <option value="{{ $value }}" @selected(old('trip_type', $item?->trip_type) === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="cabin_class" class="form-label">Cabin Class</label>
        <select id="cabin_class" name="cabin_class" class="form-select" required>
            <option value="">Select Cabin Class</option>
            @foreach (\App\Models\FlightRouteDestination::CABIN_CLASSES as $value => $label)
                <option value="{{ $value }}" @selected(old('cabin_class', $item?->cabin_class) === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="pricing" class="form-label">Pricing</label>
        <input type="text" id="pricing" name="pricing" class="form-control"
            value="{{ old('pricing', $item?->pricing) }}" placeholder="$499">
    </div>

    <div class="col-md-6 mb-3">
        <label for="tag" class="form-label">Tag</label>
        <input type="text" id="tag" name="tag" class="form-control"
            value="{{ old('tag', $item?->tag) }}" placeholder="Popular">
    </div>

    <div class="col-md-12 mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="6" class="form-control">{{ old('description', $item?->description) }}</textarea>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-check">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" id="is_published" name="is_published" value="1" class="form-check-input"
                @checked($isPublished)>
            <label for="is_published" class="form-check-label">Publish</label>
        </div>
    </div>
</div>
