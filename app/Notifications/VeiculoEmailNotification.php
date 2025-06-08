<?php 
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VeiculoEmailNotification extends Notification
{
    protected $mensagem;

    public function __construct($mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->mensagem);
    }
}
