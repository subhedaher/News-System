<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusArticle extends Notification
{
    use Queueable;

    private $article_slug;
    private $adminName;
    private $notes;
    private $title;
    private $created_at;
    /**
     * Create a new notification instance.
     */
    public function __construct($article_slug, $adminName, $notes, $title, $created_at)
    {
        $this->article_slug = $article_slug;
        $this->adminName = $adminName;
        $this->notes = $notes;
        $this->title = $title;
        $this->created_at = $created_at;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'article_slug' => $this->article_slug,
            'adminName' => $this->adminName,
            'notes' => $this->notes,
            'title' => $this->title,
            'created_at' => $this->created_at
        ];
    }
}
