<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BookApiController;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /** 
     * API staying openlibrary  
     */
    protected BookApiController $bookApiController;

    public function __construct(BookApiController $bookApiController)
    {
        $this->bookApiController = $bookApiController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $books = Book::all();
        return view('book.list-show-view', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        return view('book.create-view');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $request->validate([
            'titulo' => 'required',
            'preco' => 'required|numeric',
            'quantidade_estoque' => 'required|integer'
        ]);

        $newRequest = new Request([
            'title' => $request->input('titulo'),
        ]);

        //connection api openlibrary
        $bookRequest = $this->bookApiController->searchBook($newRequest);

        $result = json_decode($bookRequest->content());

        if(property_exists($result, 'message')){
            return redirect()->route('books.index')->with('success', 'Livro não encontrado!');
        }

        $request->merge(['autor' => $result->author]);
        $request->merge(['descricao' => $result->author_bio]);
               
        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book) 
    {
        return view('book.edit-view', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book) 
    {
        $request->validate([
            'titulo' => 'required',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book) 
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }

}
