<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class QueuedResetPassword extends Notification implements ShouldQueue
{
	use Queueable;

	public $token;

	public function __construct($token)
	{
		$this->token = $token;
	}

	public function via($notifiable)
	{
		return ['mail'];
	}

	public function toMail($notifiable)
	{
		$url = url(sprintf('%s/reset-password?token=%s&email=%s', config('app.url'), $this->token, urlencode($notifiable->email)));

		return (new MailMessage)
			->from(config('mail.from.address'), config('mail.from.name')) // garante remetente definido
			->subject('Redefinição de senha')
			->line('Você recebeu este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
			->action('Redefinir Senha', $url)
			->line('Se você não solicitou a redefinição, nenhuma ação é necessária.');
	}
}
