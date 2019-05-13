<?php
/**
 * Created by PhpStorm.
 * User: gerha
 * Date: 06.04.2019
 * Time: 08:01
 */
namespace App\Notifications;
use App\Channels\CampaignMonitorTransactional;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
class CMPasswordReset extends Notification
{
    use Queueable;
    public $email_id = 'b87d1d1c-af91-44fe-ba95-0a01a9dc7d20';

    protected $profile_id;

    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }
    /**
     * Get the notification channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return [CampaignMonitorTransactional::class];
    }
    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return VoiceMessage
     */
    public function toTransactional($notifiable)
    {
        return [
            'To' => $notifiable->email,
            'Data' =>[
                'name' => $notifiable->name,
                'link' =>  url( "/password/reset/" . $this->token )
            ]
        ];
    }
}