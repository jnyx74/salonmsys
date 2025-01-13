<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreatedNotication extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Appointment Confirmation')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your appointment has been successfully created.')
            ->line('**Date:** ' . $this->appointment->appointment_date)
            ->line('**Time:** ' . $this->appointment->appointment_time)
            ->line('**Hairdresser:** ' . $this->appointment->hairdresser->name)
            ->action('View Appointment', url('/appointments/' . $this->appointment->id))
            ->line('Thank you for booking with us!');
    }
}
