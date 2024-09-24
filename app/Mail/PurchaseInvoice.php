<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $domain;
    public $user;

    public function __construct(Transaction $transaction, $domain, $user)
    {
        $this->transaction = $transaction;
        $this->domain = $domain;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.purchase_invoice')
            ->subject('Your Domain Purchase Invoice')
            ->with([
                'transaction' => $this->transaction,
                'domain' => $this->domain,
                'user' => $this->user,
            ]);
    }
}
