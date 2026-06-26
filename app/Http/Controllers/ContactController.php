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
            'contact_phone' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'contact_subject' => 'required|string|max:255',
            'contact_message' => 'required|string|max:1000',
        ]);

        DB::table('contact')->insert([
            'name' => $validated['contact_name'],
            'email' => $validated['contact_email'],
            'phone' => $validated['contact_phone'] ?? null,
            'subject' => $validated['contact_subject'],
            'message' => $validated['contact_message'],
            'created_at' => $currentDateTime,
        ]);

         // Send email to Admin
        $adminEmail = "support@codesexperts.com"; // change to your admin email
        Mail::send([], [], function ($message) use ($validated, $adminEmail) {
            $message->to($adminEmail)
                ->subject("New Contact Enquiry: " . $validated['contact_subject'])
                ->html(
                "Hello Admin,<br><br>" .
                "A new enquiry has been submitted.<br><br>" .
                "<strong>Name:</strong> {$validated['contact_name']}<br>" .
                "<strong>Email:</strong> {$validated['contact_email']}<br>" .
                "<strong>Phone:</strong> {$validated['contact_phone']}<br>" .
                "<strong>Subject:</strong> {$validated['contact_subject']}<br><br>" .
                "Regards,<br>Codes Experts"
            );
        });

        return back()->with('success', 'Your Request submitted successfully!');
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

        DB::table('subscribe')->insert([
            'email' => $validated['email'],
            'created_at' => $currentDateTime,
        ]);

         // Send email to Admin
        $adminEmail = "support@codesexperts.com"; // change to your admin email
        Mail::send([], [], function ($message) use ($validated, $adminEmail) {
            $message->to($adminEmail)
                ->subject("New Subscribe Enquiry: ")
                ->html(
                "Hello Admin,<br><br>" .
                "A new subscribe enquiry has been submitted.<br><br>" .
                "<strong>Email:</strong> {$validated['email']}<br>" .
                "Regards,<br>Codes Experts"
            );
        });

        return back()->with('success', 'Your Request submitted successfully!');
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