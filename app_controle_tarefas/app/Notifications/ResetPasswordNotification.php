<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    private $token, $name, $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
        /*Poderia ter feito uma variavel de minutos
        como foi feito com url mas preferi deixar como do jeito que está*/

        $url = "http://127.0.0.1:8000/password/reset/$this->token?email=$this->email";
        $minutos =config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        return (new MailMessage)
            ->subject('Atualização de senha.')
            ->greeting("Olá $this->name")
            ->line('Esqueceu sua senha ? Sem problemas, vamos recupera-lá!!!')
            ->action('Recuperar senha.', $url)
            ->line("O link expira em $minutos minutos")
            ->line('Caso não tenha pedido a redefinição de senha, então nenhuma ação deverá ser tomada.')
            ->salutation('Até breve!');
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
