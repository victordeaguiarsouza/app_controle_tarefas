<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;

    public $token;
    public $email;
    public $name;

    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name  = $name;
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
        $url     = 'http://localhost/password/reset/'. $this->token.'?email='.$this->email;
        $minutos = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

        return (new MailMessage)
            ->greeting("Olá $this->name,")
            ->subject('Atualização de senha')
            ->line('Esqueceu a senha? Sem problemas, vamos resolver isso!!!')
            ->action('Clique aqui para modificar a senha', $url)
            ->line('O link acima expira em '.$minutos.' minutos.')
            ->line('Caso você não tenha solicitado alteração de senha, nenhuma ação é necessário.')
            ->line('')
            ->salutation('Atenciosamente,')
            ;
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
