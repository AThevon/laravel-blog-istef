<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'article_id',
    ];


    /**
     * Relation avec l'Article.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Relation avec l'Utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}