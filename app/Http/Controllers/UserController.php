<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->latest()
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create', [
            'user' => null,
            'roles' => User::ROLES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedUserData($request);
        $validated['password'] = Hash::make($validated['password']);
        $validated['profile_image'] = $this->storeProfileImage($request);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => User::ROLES,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $this->validatedUserData($request, $user);

        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('profile_image')) {
            $this->deleteFile($user->profile_image);
            $validated['profile_image'] = $this->storeProfileImage($request);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account while logged in.');
        }

        $this->deleteFile($user->profile_image);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    private function validatedUserData(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'experience' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'social_media_profile' => ['nullable', 'url', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:30'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user),
            ],
            'profile_image' => ['nullable', 'image', 'max:2048'],
            'role' => ['required', Rule::in(array_keys(User::ROLES))],
            'password' => [$user ? 'nullable' : 'required', 'confirmed', Rules\Password::defaults()],
        ]);
    }

    private function storeProfileImage(Request $request): ?string
    {
        return $request->file('profile_image')?->store('authors', 'public');
    }

    private function deleteFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
