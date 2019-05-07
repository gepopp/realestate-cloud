<?php

namespace App\Notifications;

use App\Channels\CampaignMonitorTransactional;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class CMVerifyEmail extends Notification
{
    use Queueable;

    public $email_id = 'e7d85159-f3c8-4ed7-a929-d5e6acd73cc4';



    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [CampaignMonitorTransactional::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTransactional($notifiable)
    {
        return [
            'To' => $notifiable->name . '<' . $notifiable->email . '>',
            'Data' =>[
                'name' => $notifiable->name,
                'link' => $this->VerifyLink($notifiable)
            ]
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function VerifyLink($notifiable){
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $notifiable->getKey()]
        );
    }
}
