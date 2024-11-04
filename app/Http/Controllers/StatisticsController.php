<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Notifications\UserNotification;
use App\Enums\NotificationType;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    /**
     * Send the user statistics notification.
     */
    public function sendUserStats(Request $request)
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }


        // Calculer les statistiques globales
        $totalArticlesCount = Article::count();
        $totalCommentsCount = Comment::count();

        // Détail : nombre de commentaires par article
        $commentsPerArticle = Article::withCount('comments')->get()->map(function ($article) {
            return [
                'title' => $article->title,
                'comments_count' => $article->comments_count,
            ];
        });

        // Envoyer la notification
        $user->notify(new UserNotification(NotificationType::STATISTICS, $totalArticlesCount, $totalCommentsCount, $commentsPerArticle));

        return back()->with('status', 'Statistics sent successfully.');
    }
}