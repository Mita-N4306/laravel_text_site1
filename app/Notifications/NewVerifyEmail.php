<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class NewVerifyEmail extends VerifyEmail
{

    protected function buildMailMessage($url)
    {
      return (New Mailmessage)
      ->subject('メールアドレスの確認')
      ->line('ご登録ありがとうございます。')
      ->line('新しいメンバーが増えてとてもうれしいです。')
      ->action('このボタンをクリック',$url)
      ->line('上記ボタンをクリックするとご登録が完了します！');
    }
}
