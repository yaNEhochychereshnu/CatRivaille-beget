<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderAssemblyNotification extends Notification
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
            ->subject('Статус заказа изменен на "в сборке"')
            ->line('Заказ номер ' . $this->order->id . ' находится в процессе сборки.')
            ->action('Просмотреть заказ', url('/orders/' . $this->order->id))
            ->line('Информация о клиенте:')
            ->line('ФИО: ' . $this->order->full_name)
            ->line('Адрес: ' . $this->order->address)
            ->line('Почтовый индекс: ' . $this->order->postcode)
            ->line('Телефон: ' . $this->order->phone)
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
