<?php

namespace Modules\ForTheBuilder\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BeforePrepayment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $booking;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
//        return ['mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notifications Action', 'https://laravel.com')
//                    ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $expire_date = json_decode($this->booking['expire_dates']);
        return [
            'id'=>$this->booking['id'],
            'first_name'=>$this->booking->clients['first_name'],
            'last_name'=>$this->booking->clients['last_name'],
            'middle_name'=>$this->booking->clients['middle_name'],
            'avatar'=>$this->booking->clients['avatar'],
            'prepayment'=>$this->booking['prepayment'],
            'house_flat_id'=>$this->booking['house_flat_id'],
            'house_id'=>$this->booking['house_id'],
            'expire_dates'=>strtotime(end($expire_date)->date),
            'notification_date'=>$this->booking['notification_date'],
            'admin_name'=>$this->booking->user['first_name'],
            'is_read'=>$this->booking->notification['is_read'],
            'is_read_before'=>$this->booking->notification['is_read_before'],
            'is_notify_before'=>$this->booking->notification['is_notify_before'],
            'is_notify'=>$this->booking->notification['is_notify'],
            'admin_id'=>$this->booking['user_id'],
            'client_id'=>$this->booking['client_id'],
            'updated_at'=>$this->booking['updated_at']
        ];
    }
}
