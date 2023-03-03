<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\SendReminderMailNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendReminderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // mobile_verified_at
        $users = User::whereNull('mobile_verified_at')
            ->whereDate('created_at', '<=', Carbon::now()->subDays(1))
            ->get();
        Notification::send($users, new SendReminderMailNotification);
    }
}
