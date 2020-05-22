<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //     ->line('Kamu menerima email ini karena kami menerima permintaan pengaturan ulang password untuk akun Anda.')
        //     ->action('Reset Password', route('frontend.password.reset-get', $this->token))
        //     ->line('Jika Kamu tidak meminta pengaturan ulang kata sandi, mohon abaikan email ini.');

        return (new MailMessage)->subject(' Atur Ulang Kata Sandi')->view(
            'emails.forget', ['user' => $notifiable,'token'=>route('cms.password.reset-get', $this->token)]
        );
            // ->bcc(config('custom.emails.bcc'));
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
            //
        ];
    }
}
