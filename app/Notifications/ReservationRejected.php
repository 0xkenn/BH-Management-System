<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationRejected extends Notification
{
    use Queueable;

    protected $reservation;

    /**
     * Create a new notification instance.
     *
     * @param $reservation The reservation that was rejected
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
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
                    ->line('Unfortunately, your reservation for Room #' . $this->reservation->room->id . ' has been rejected.')
                    ->line('Room Details:')
                    ->line('Room Name: ' . $this->reservation->room->name)
                    ->line('Capacity: ' . $this->reservation->room->capacity)
                    ->line('Please consider making a new reservation.')
                    ->line('Thank you for your understanding!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reservation_id' => $this->reservation->id,
            'room_id' => $this->reservation->room->id,
            'room_name' => $this->reservation->room->name,
            'message' => 'Your reservation has been rejected',
            'status' => 'Rejected',
        ];
    }
}
