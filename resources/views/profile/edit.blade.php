<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-semibold text-dark">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container mx-auto px-sm-4 px-lg-5 d-grid gap-4">
            <div class="p-4 p-sm-5 bg-white shadow rounded">
                <div class="profile-form-container">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 p-sm-5 bg-white shadow rounded">
                <div class="profile-form-container">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 p-sm-5 bg-white shadow rounded">
                <div class="profile-form-container">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
