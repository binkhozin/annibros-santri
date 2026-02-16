<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     * Format: id, judul, judul_arab, kategori, tag, konten
     */
    public function index(Request $request): JsonResponse
    {
        $query = Article::query()
            ->published()
            ->orderBy('published_at', 'desc');

        // Filter by category
        if ($request->has('kategori')) {
            $query->where('category', $request->kategori);
        }

        // Filter by tag
        if ($request->has('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Search by title (Latin or Arabic)
        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('arabic_title', 'like', "%{$search}%");
            });
        }

        $articles = $query->get()->map(function ($article) {
            return [
                'id' => $article->id,
                'judul' => $article->title,
                'judul_arab' => $article->arabic_title,
                'kategori' => $article->category,
                'tag' => $article->tags ?? [],
                'konten' => strip_tags($article->content), // Remove HTML tags for Flutter
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $articles,
            'total' => $articles->count(),
        ]);
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article): JsonResponse
    {
        // Increment views
        $article->increment('views_count');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $article->id,
                'judul' => $article->title,
                'judul_arab' => $article->arabic_title,
                'kategori' => $article->category,
                'tag' => $article->tags ?? [],
                'konten' => strip_tags($article->content),
                'thumbnail' => $article->thumbnail,
                'published_at' => $article->published_at?->format('Y-m-d H:i:s'),
                'views_count' => $article->views_count,
            ],
        ]);
    }

    /**
     * Get all categories.
     */
    public function categories(): JsonResponse
    {
        $categories = Article::published()
            ->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Get all tags.
     */
    public function tags(): JsonResponse
    {
        $articles = Article::published()
            ->whereNotNull('tags')
            ->get();

        $tags = [];
        foreach ($articles as $article) {
            if (is_array($article->tags)) {
                foreach ($article->tags as $tag) {
                    if (!in_array($tag, $tags)) {
                        $tags[] = $tag;
                    }
                }
            }
        }

        sort($tags);

        return response()->json([
            'success' => true,
            'data' => $tags,
        ]);
    }

    /**
     * Get featured articles.
     */
    public function featured(): JsonResponse
    {
        $articles = Article::featured()
            ->published()
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'judul' => $article->title,
                    'judul_arab' => $article->arabic_title,
                    'kategori' => $article->category,
                    'tag' => $article->tags ?? [],
                    'konten' => strip_tags($article->content),
                    'thumbnail' => $article->thumbnail,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }
}