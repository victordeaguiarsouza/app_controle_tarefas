<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificarEmailNotification extends VerifyEmail
{
    use Queueable;
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Confirmação de email')
            ->greeting("Olá $this->name,")
            ->line('clique no botão abaixo para validar seu email')
            ->action('Clique aqui para validar seu email', $url)
            ->line('Caso não tenha feito a solicitação, favor desconsiderar.');
    }

}
