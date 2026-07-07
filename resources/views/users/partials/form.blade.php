@php
    $isActive = (int) old('status', $user?->exists ? $user->status : 1) === 1;
@endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user?->name) }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label for="role" class="form-label">Role</label>
        <select id="role" name="role" class="form-select" required>
            @foreach ($roles as $value => $label)
                <option value="{{ $value }}" @selected(old('role', $user?->role ?? \App\Models\User::ROLE_AUTHOR) === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" id="age" name="age" class="form-control" value="{{ old('age', $user?->age) }}"
            min="1" max="120">
    </div>

    <div class="col-md-6 mb-3">
        <label for="experience" class="form-label">Experience</label>
        <input type="text" id="experience" name="experience" class="form-control"
            value="{{ old('experience', $user?->experience) }}" placeholder="5 years">
    </div>

    <div class="col-12 mb-3">
        <label for="bio" class="form-label">Bio</label>
        <textarea id="bio" name="bio" class="form-control" rows="4">{{ old('bio', $user?->bio) }}</textarea>
    </div>

    <div class="col-md-6 mb-3">
        <label for="social_media_profile" class="form-label">Social Media Profile</label>
        <input type="url" id="social_media_profile" name="social_media_profile" class="form-control"
            value="{{ old('social_media_profile', $user?->social_media_profile) }}" placeholder="https://linkedin.com/in/name">
    </div>

    <div class="col-md-6 mb-3">
        <label for="contact_number" class="form-label">Contact Number</label>
        <input type="text" id="contact_number" name="contact_number" class="form-control"
            value="{{ old('contact_number', $user?->contact_number) }}">
    </div>

    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user?->email) }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label d-block">Status</label>
        <div class="form-check">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" id="status" name="status" value="1" class="form-check-input"
                @checked($isActive)>
            <label for="status" class="form-check-label">Active</label>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="profile_image" class="form-label">Profile Image</label>
        <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*">
        @if ($user?->profile_image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" width="120"
                    class="rounded border">
            </div>
        @endif
    </div>

    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" @required(! $user?->exists)>
        @if ($user?->exists)
            <small class="text-muted">Leave blank to keep the current password.</small>
        @endif
    </div>

    <div class="col-md-6 mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
            @required(! $user?->exists)>
    </div>
</div>
