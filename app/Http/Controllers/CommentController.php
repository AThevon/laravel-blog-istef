<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Notifications\UserNotification;
use App\Enums\NotificationType;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $article->comments()->create([
            'content' => $validatedData['content'],
            'user_id' => Auth::id(),
        ]);

        $user = $article->user;
        $user->notify(new UserNotification(NotificationType::NEW_COMMENT));

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('articles.commentEdit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->update($validatedData);

        return redirect()->route('articles.show', $comment->article_id)
            ->with('success', 'Commentaire modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('articles.show', $comment->article_id)
            ->with('success', 'Commentaire supprimé avec succès.');
    }
}
