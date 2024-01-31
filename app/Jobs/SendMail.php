<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\SendBarcode;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $barcode;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $barcode)
    {
        $this->user = $user;
        $this->barcode = $barcode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new SendBarcode($this->barcode));
    }
}
