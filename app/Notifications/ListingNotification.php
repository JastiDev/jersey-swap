<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ListingNotification extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $data;
    public function __construct($lisiting_data)
    {
        $this->data = $lisiting_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->data['type']=="cancelled"){
            return (new MailMessage)
                    ->subject('Listing Cancelled')
                    ->greeting('Hi,')
                    ->line('Your listing has been cancelled. You can create another listing and find a perfect offer.')
                    ->action('Create Listing', url('listings/add-listing'))
                    ->line('Thanks for using Jersey Swap!');
        }
        return (new MailMessage)
                    ->line($this->data['message'])
                    ->action($this->data['url_text'], $this->data['url'])
                    ->line('Thank you for using Jersey Swap!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => $this->data['type'],
            'message' => $this->data['message'],
            'url' => $this->data['url'],
            'url_text' => $this->data['url_text'] ?? ""
        ];
    }
}
