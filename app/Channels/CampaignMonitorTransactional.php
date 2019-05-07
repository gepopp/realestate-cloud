<?php

namespace App\Channels;

use CS_REST_Transactional_SmartEmail;
use Illuminate\Notifications\Notification;

class CampaignMonitorTransactional
{
    protected $email_id;

    public function send($notifiable, Notification $notification)
    {
        $sender = new CS_REST_Transactional_SmartEmail($notification->email_id, ['api_key' => config('services.campaign_monitor.key')]);
        $message = $notification->toTransactional($notifiable);
        $consent_to_track = 'yes'; # Valid: 'yes', 'no', 'unchanged'
        $result = $sender->send($message, $consent_to_track);
        if (!$result->was_successful()) {
            throw new \Exception("Mail could not be sent." . print_r($result, true));
        }
    }
}