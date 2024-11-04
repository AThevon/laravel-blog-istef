<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Enums\NotificationType;

class UserNotification extends Notification
{
    use Queueable;

    protected NotificationType $type;
    protected int $totalArticlesCount;
    protected int $totalCommentsCount;
    protected $commentsPerArticle;

    /**
     * Create a new notification instance.
     */
    public function __construct(NotificationType $type, int $totalArticlesCount = 0, int $totalCommentsCount = 0, $commentsPerArticle = [])
    {
        $this->type = $type;
        $this->totalArticlesCount = $totalArticlesCount;
        $this->totalCommentsCount = $totalCommentsCount;
        $this->commentsPerArticle = $commentsPerArticle;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'));

        switch ($this->type) {
            case NotificationType::REGISTRATION:
                $mailMessage->subject('Welcome!')
                    ->line('Thank you for registering.')
                    ->action('Visit', url('/'));
                break;

            case NotificationType::PROFILE_UPDATE:
                $mailMessage->subject('Profile Updated')
                    ->line('Your profile has been successfully updated.');
                break;

            case NotificationType::NEW_COMMENT:
                $mailMessage->subject('New Comment')
                    ->line('A new comment was added to your post.');
                break;

            case NotificationType::NEW_ARTICLE:
                $mailMessage->subject('New Article')
                    ->line('A new article has been published.');
                break;

            case NotificationType::STATISTICS:
                $mailMessage->subject('Site Statistics')
                    ->line("Total Articles: {$this->totalArticlesCount}")
                    ->line("Total Comments: {$this->totalCommentsCount}")
                    ->line('Comments per Article:');

                // Ajouter chaque ligne de détails pour les commentaires par article
                foreach ($this->commentsPerArticle as $article) {
                    $mailMessage->line("{$article['title']}: {$article['comments_count']} comments");
                }
                break;

            default:
                $mailMessage->subject('Notification')
                    ->line('You have a new notification.');
                break;
        }

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification for database storage.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'message' => match ($this->type) {
                NotificationType::REGISTRATION => 'Thank you for registering.',
                NotificationType::PROFILE_UPDATE => 'Your profile has been updated.',
                NotificationType::NEW_COMMENT => 'A new comment was added.',
                NotificationType::NEW_ARTICLE => 'A new article was published.',
                NotificationType::STATISTICS => [
                    'total_articles' => $this->totalArticlesCount,
                    'total_comments' => $this->totalCommentsCount,
                    'comments_per_article' => $this->commentsPerArticle,
                ],
                default => 'You have a new notification.',
            },
            'user_id' => $notifiable->id,
            'timestamp' => now(),
        ];
    }
}