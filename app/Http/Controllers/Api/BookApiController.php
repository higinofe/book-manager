<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OpenLibraryService;
use Illuminate\Http\Request;

class BookApiController extends Controller
{

    protected OpenLibraryService $openLibraryService;

    public function __construct(OpenLibraryService $openLibraryService)
    {
        $this->openLibraryService = $openLibraryService;
    }

    public function searchBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3',
        ]);

        $title = str_replace(' ', '+', $request->input('title'));
 
        $book = $this->openLibraryService->searchBook($title);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $authorKey = $book['author_key'][0] ?? null;

        if (!$authorKey) {
            return response()->json(['message' => 'Autor não encontrado'], 404);
        }

        $bio = $this->openLibraryService->getAuthorBio($authorKey);

        return response()->json([
            'title' => $book['title'],
            'author' => $book['author_name'][0] ?? 'Desconhecido',
            'author_bio' => $bio,
        ]);
    }

}
