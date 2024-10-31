<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class RedirectIfReader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isReader()) {
            $lastArticle = Article::latest()->first();
            return redirect()->route('articles.show', $lastArticle->id);
        }

        return $next($request);
    }
}
