<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class OpenLibraryService
{
    protected string $baseUrl = 'https://openlibrary.org';

    public function searchBook(string $title): ?array
    {
        $cacheKey = "book_search_" . md5($title);

        return Cache::remember($cacheKey, now()->addHours(2), function () use ($title) {
            $response = Http::get("{$this->baseUrl}/search.json", [
                'q' => $title,
            ]);

            if ($response->failed()) {
                return null;
            }

            $books = $response->json('docs', []);
            return $books[0] ?? null;
        });
    }

    public function getAuthorBio(string $authorKey): ?string
    {
        $cacheKey = "author_bio_" . $authorKey;

        return Cache::remember($cacheKey, now()->addHours(2), function () use ($authorKey) {
            $response = Http::get("{$this->baseUrl}/authors/{$authorKey}.json");

            if ($response->failed()) {
                return null;
            }

            return $response->json('bio') ?? 'Biografia não disponível';
        });
    }

}
