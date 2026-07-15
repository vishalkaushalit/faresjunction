<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageInquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class PackageInquiryController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'package_slug' => ['nullable', 'string', 'exists:packages,slug'],
            'source' => ['required', 'in:package,blog'],
            'interest' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+\-\s()]+$/'],
            'travel_date' => ['required', 'date', 'after_or_equal:today'],
            'traveler_count' => ['required', 'integer', 'between:1,99'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $package = isset($validated['package_slug'])
            ? Package::query()->where('slug', $validated['package_slug'])->first()
            : null;

        $inquiryData = $validated;
        unset($inquiryData['package_slug']);

        $inquiry = PackageInquiry::create([
            ...$inquiryData,
            'package_id' => $package?->id,
            'interest' => $package?->title ?? ($validated['interest'] ?? 'Travel enquiry'),
        ]);

        $errors = [];
        try {
            $this->mailAdmin($inquiry);
            $inquiry->update(['admin_notified_at' => now()]);
        } catch (Throwable $exception) {
            $errors[] = 'Admin email: '.$exception->getMessage();
            Log::error('Package inquiry admin notification failed.', ['inquiry_id' => $inquiry->id, 'exception' => $exception]);
        }

        try {
            $this->mailUser($inquiry);
            $inquiry->update(['user_notified_at' => now()]);
        } catch (Throwable $exception) {
            $errors[] = 'User email: '.$exception->getMessage();
            Log::error('Package inquiry user notification failed.', ['inquiry_id' => $inquiry->id, 'exception' => $exception]);
        }

        if ($errors) {
            $inquiry->update(['notification_error' => implode(PHP_EOL, $errors)]);
        }

        $message = 'Your inquiry has been submitted successfully!';

        return $request->expectsJson()
            ? response()->json(['message' => $message])
            : back()->with('success', $message);
    }

    public function index(): View
    {
        return view('package-inquiries.index', [
            'inquiries' => PackageInquiry::query()->with('package')->latest()->paginate(15),
        ]);
    }

    public function destroy(PackageInquiry $packageInquiry): RedirectResponse
    {
        $packageInquiry->delete();

        return back()->with('success', 'Package inquiry deleted successfully.');
    }

    private function mailAdmin(PackageInquiry $inquiry): void
    {
        $adminEmail = config('mail.admin_address');
        $details = $this->emailDetails($inquiry);

        Mail::send([], [], fn ($mail) => $mail->to($adminEmail)
            ->replyTo($inquiry->email, $inquiry->name)
            ->subject('New Travel Enquiry: '.$inquiry->interest)
            ->html("Hello Admin,<br><br>A new travel enquiry has been submitted.<br><br>{$details}<br>Regards,<br>Fares Junction"));
    }

    private function mailUser(PackageInquiry $inquiry): void
    {
        $safeName = e($inquiry->name);
        $safeInterest = e($inquiry->interest);

        Mail::send([], [], fn ($mail) => $mail->to($inquiry->email, $inquiry->name)
            ->subject('We received your Fares Junction travel enquiry')
            ->html("Hello {$safeName},<br><br>Thank you for your interest in <strong>{$safeInterest}</strong>. We received your travel details and one of our specialists will contact you shortly.<br><br>Regards,<br>Fares Junction"));
    }

    private function emailDetails(PackageInquiry $inquiry): string
    {
        return '<strong>Name:</strong> '.e($inquiry->name).'<br>'.
            '<strong>Email:</strong> '.e($inquiry->email).'<br>'.
            '<strong>Phone:</strong> '.e($inquiry->phone).'<br>'.
            '<strong>Interest:</strong> '.e($inquiry->interest).'<br>'.
            '<strong>Travel date:</strong> '.e($inquiry->travel_date->format('F j, Y')).'<br>'.
            '<strong>Travelers:</strong> '.$inquiry->traveler_count.'<br>'.
            '<strong>Message:</strong> '.nl2br(e($inquiry->message ?: 'Not provided')).'<br><br>';
    }
}
