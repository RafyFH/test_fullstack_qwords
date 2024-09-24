<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseInvoice;
use PDF;
use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function show($domain)
    {
        return view('page.checkout', ['domain' => (object)['domain_name' => $domain]]);
    }

    public function processCheckout(Request $request, $domain)
    {
        $request->validate([
            'duration' => 'required|integer|min:1',
            'name' => Auth::check() ? 'nullable' : 'required|string|max:255',
            'email' => Auth::check() ? 'nullable' : 'required|email|unique:users,email',
            'password' => Auth::check() ? 'nullable' : 'required|string|min:8',
        ]);

        if (!Auth::check()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            Auth::login($user);
        } else {
            $user = Auth::user();
        }

        // Create the domain entry if it doesn't exist
        Domain::firstOrCreate(['domain_name' => $domain]);

        $domain = Domain::where('domain_name', $domain)->first();
        $totalPrice = $request->duration * 10000;

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'domain_id' => $domain->id, // Ensure this corresponds to your Domain model
            'duration' => $request->duration,
            'total_price' => $totalPrice,
        ]);
//        Mail::to($user->email)->send(new PurchaseInvoice($transaction, $domain, $user));
        return view('page.invoice', [
            'transaction' => $transaction,
            'domain' => $domain,
            'user' => $user,
        ]);
    }
    public function downloadInvoice($transactionId)
    {
        $transaction = Transaction::with('domain')->findOrFail($transactionId);
        $user = User::findOrFail($transaction->user_id);
        $domain = $transaction->domain;
        $pdf = PDF::loadView('invoice_pdf', [
            'transaction' => $transaction,
            'user' => $user,
            'domain' => $domain,
        ]);

        return $pdf->download('invoice-' . $transactionId . '.pdf');
    }
}
