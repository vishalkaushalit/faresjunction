<section>
    <header>
        <h2 class="h5 fw-medium text-dark">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 small text-secondary">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4 d-grid gap-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 d-block w-100" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" name="age" type="number" min="1" max="120" class="mt-1 d-block w-100" :value="old('age', $user->age)" />
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>

        <div>
            <x-input-label for="experience" :value="__('Experience')" />
            <x-text-input id="experience" name="experience" type="text" class="mt-1 d-block w-100" :value="old('experience', $user->experience)" />
            <x-input-error class="mt-2" :messages="$errors->get('experience')" />
        </div>

        <div>
            <x-input-label for="social_media_profile" :value="__('Social Media Profile')" />
            <x-text-input id="social_media_profile" name="social_media_profile" type="url" class="mt-1 d-block w-100" :value="old('social_media_profile', $user->social_media_profile)" placeholder="https://linkedin.com/in/name" />
            <x-input-error class="mt-2" :messages="$errors->get('social_media_profile')" />
        </div>

        <div>
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 d-block w-100" :value="old('contact_number', $user->contact_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 d-block w-100" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="small mt-2 text-dark">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="text-decoration-underline small text-secondary rounded">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 fw-medium small text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <input id="profile_image" name="profile_image" type="file" accept="image/*"
                class="mt-1 d-block w-100 small text-dark" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_image')" />

            @if ($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}"
                    class="mt-3 h-20 w-20 rounded-full object-cover">
            @endif
        </div>

        <div class="d-flex align-items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="small text-secondary"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
