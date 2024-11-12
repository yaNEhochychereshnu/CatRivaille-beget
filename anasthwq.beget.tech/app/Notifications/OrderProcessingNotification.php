<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderProcessingNotification extends Notification
{
    use Queueable;

    protected $order;
    protected $email;

    /**
     * Create a new notification instance.
     *
     * @param Order $order
     * @param string $email
     * @return void
     */
    public function __construct($order, $email)
    {
        $this->order = $order;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
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
        ->greeting('Здравствуйте!')
        ->subject('Статус заказа изменен на "в обработке"')
        ->line('Статус заказа № ' . $this->order->id .' был изменен на '.$this->order->status)
        ->action('Просмотреть заказ', url('/orders/' . $this->order->id))
        ->line('Необходимо проверить чек на оплату.')
        ->salutation('С уважением, CatRivaille');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
