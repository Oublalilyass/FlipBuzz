<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Message;


class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hello, ' . $notifiable->name)
                    ->line('You have received a new message from ' . $this->message->sender->name)
                    ->line('Message: "' . $this->message->message_body . '"')
                    ->action('View Message', url('/listings/' . $this->message->listing_id))
                    ->line('Thank you for using Flipbuzz!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // \Log::info($this->message->content); // Debugging line

        return [
            'message_id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'listing_id' => $this->message->listing_id,
            'message_body' => $this->message->message_body,
        ];
    }
}
