<?php
namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function index()
    {
        $contactdata = DB::table('contact')->orderByDesc('id')->simplePaginate(10);
        return view('contact.index', compact('contactdata'));
    }

    public function create(Request $request)
    {
        $currentDateTime = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
        $validated = $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'contact_subject' => 'required|string|max:255',
            'contact_message' => 'required|string|max:1000',
        ]);

        $safeName = e($validated['contact_name']);
        $safeEmail = e($validated['contact_email']);
        $safePhone = e($validated['contact_phone']);
        $safeSubject = e($validated['contact_subject']);
        $safeMessage = nl2br(e($validated['contact_message']));

        DB::table('contact')->insert([
            'name' => $validated['contact_name'],
            'email' => $validated['contact_email'],
            'phone' => $validated['contact_phone'] ?? null,
            'message' => $validated['contact_message'],
            'created_at' => $currentDateTime,
        ]);

        $adminEmail = 'crm@callinggenie.com';
        Mail::send([], [], function ($message) use ($validated, $adminEmail, $safeName, $safeEmail, $safePhone, $safeSubject, $safeMessage) {
            $message->to($adminEmail)
                ->replyTo($validated['contact_email'], $validated['contact_name'])
                ->subject('New Contact Enquiry: ' . $validated['contact_subject'])
                ->html(
                "Hello Admin,<br><br>" .
                "A new enquiry has been submitted.<br><br>" .
                "<strong>Name:</strong> {$safeName}<br>" .
                "<strong>Email:</strong> {$safeEmail}<br>" .
                "<strong>Phone:</strong> {$safePhone}<br>" .
                "<strong>Subject:</strong> {$safeSubject}<br>" .
                "<strong>Message:</strong><br>{$safeMessage}<br><br>" .
                "Regards,<br>Fares Junction"
            );
        });

        Mail::send([], [], function ($message) use ($validated, $safeName) {
            $message->to($validated['contact_email'], $validated['contact_name'])
                ->subject('We received your Fares Junction inquiry')
                ->html(
                    "Hello {$safeName},<br><br>" .
                    "Thank you for contacting Fares Junction. Our reservation desk has received your details and will reach out within 2 business days.<br><br>" .
                    "Regards,<br>Fares Junction"
                );
        });

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your inquiry has been submitted successfully!',
                'name' => $validated['contact_name'],
            ]);
        }

        return back()->with('success', 'Your inquiry has been submitted successfully!');
    }

    public function delete($id)
    {
        $data = DB::table('contact')->find($id);
        if (!$data)
            return back()->with('error', 'Data not found.');

        DB::table('contact')->where('id', $id)->delete();
        return back()->with('success', 'Data deleted successfully.');
    }

    public function subscribeIndex()
    {
        $subscribedata = DB::table('subscribe')->orderByDesc('id')->simplePaginate(10);
        return view('subscribe.index', compact('subscribedata'));
    }

    public function subscribeCreate(Request $request)
    {
        $currentDateTime = Carbon::now('Asia/Kolkata')->format('Y-m-d H:i:s');
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $safeEmail = e($validated['email']);

        DB::table('subscribe')->insert([
            'email' => $validated['email'],
            'created_at' => $currentDateTime,
        ]);

        $adminEmail = 'crm@callinggenie.com';
        Mail::send([], [], function ($message) use ($validated, $adminEmail, $safeEmail) {
            $message->to($adminEmail)
                ->replyTo($validated['email'])
                ->subject('New Newsletter Subscription')
                ->html(
                "Hello Admin,<br><br>" .
                "A new newsletter subscription has been submitted.<br><br>" .
                "<strong>Email:</strong> {$safeEmail}<br><br>" .
                "Regards,<br>Fares Junction"
            );
        });

        Mail::send([], [], function ($message) use ($validated, $safeEmail) {
            $message->to($validated['email'])
                ->subject('You are subscribed to Fares Junction')
                ->html(
                    "Hello,<br><br>" .
                    "Thank you for subscribing to Fares Junction. We will send exclusive flight deals, travel guides, and tips to {$safeEmail}.<br><br>" .
                    "Regards,<br>Fares Junction"
                );
        });

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Thank you for subscribing!',
                'email' => $validated['email'],
            ]);
        }

        return back()->with('success', 'Thank you for subscribing!');
    }

    public function subscribeDelete($id)
    {
        $data = DB::table('subscribe')->find($id);
        if (!$data)
            return back()->with('error', 'Data not found.');

        DB::table('subscribe')->where('id', $id)->delete();
        return back()->with('success', 'Data deleted successfully.');
    }

}
