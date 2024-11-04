<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Mon premier',
                'content' => 'Contenu de mon premier article',
                'user_id' => 3,
            ],
            [
                'title' => 'Mon deuxième',
                'content' => 'Contenu de mon deuxième article',
                'user_id' => 3,
            ],
            [
                'title' => 'Mon troisième article',
                'content' => 'Contenu de mon troisième article',
                'user_id' => 3,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
