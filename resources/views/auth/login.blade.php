<x-guest-layout>
    <?php
    $pageTitle = 'Fares Junction - Login';
    $pageDescription = 'Explore and book flights, hotels, and holiday destinations around the world with Fares Junction.';
    ?>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="login_sec section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <h1 class="text-center mb-3 fs-3 fw-semibold">Login</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="d-block mt-1 w-100" type="email" name="email"
                                :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="d-block mt-1 w-100" type="password" name="password"
                                required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="d-block mt-4">
                            <label for="remember_me" class="d-inline-flex align-items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-secondary text-primary shadow-sm"
                                    name="remember">
                                <span class="ms-2 small text-secondary">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="d-flex align-items-center justify-content-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-underline small text-secondary rounded"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-primary-button class="btn btn-call ms-3">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
