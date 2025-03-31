<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Article;

class ArticleUpdated extends Notification
{
    use Queueable;

    protected $article;
    protected $action;

    public function __construct(Article $article, $action)
    {
        $this->article = $article;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Artículo {$this->action}: {$this->article->title}")
            ->line("El artículo ha sido {$this->action} por {$this->article->user->name}.")
            ->action('Ver artículo', url('/articles/' . $this->article->id))
            ->line('Gracias por estar atento a las actualizaciones.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "El artículo '{$this->article->title}' ha sido {$this->action}.",
            'url' => url('/articles/' . $this->article->id),
        ];
    }
}
