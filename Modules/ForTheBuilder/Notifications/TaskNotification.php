<?php

namespace Modules\ForTheBuilder\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskNotification extends Notification
{
    use Queueable;

    private $task;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail','database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', 'https://laravel.com')
    //                 ->line($this->task['body']);
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */

    public function toArray($notifiable)
    {
        return [
            'id' => $this->task['id'],
            'title' => $this->task['title'],
            'performer_id' => $this->task->performer['id'],
            'user_fio' => $this->task->user['first_name'].' '.$this->task->user['last_name'],
            'performer_fio' => $this->task->performer['first_name'].' '.$this->task->performer['last_name'],
            'performer_middle_name' => $this->task->performer['middle_name'],
            'performer_avatar' => $this->task->performer['avatar'],
            'client_id' => $this->task->deal->client['id'],
            'client_fio' => $this->task->deal->client['first_name'].' '.$this->task->deal->client['last_name'],
            'type' => $this->task['type'],
            'task_date' => $this->task['task_date']
        ];
    }
}
