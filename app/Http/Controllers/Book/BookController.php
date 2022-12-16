<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $db_books = Book::all();
        $books = [];

        if (count($db_books) === 0) {
            return response()->json([
                'data' => 'Not found any book!'
            ], 404);
        }

        foreach ($db_books as $book)
        {
            $author = Author::Where('id', $book['author_id'])->first();
            if (!$author) return response()->json(['data' => 'Author not found!'], 404);

            $genre = Genre::Where('id', $book['genre_id'])->first();
            if (!$genre) return response()->json(['data' => 'Genre not found!'], 404);
            
            array_push($books, [
                'id' => $book['id'],
                'name' => $book['name'],
                'author' => $author->name,
                'genre' => $genre->name,
                'created_at' => $book['created_at'], 
                'updated_at' => $book['updated_at'], 
            ]);
        }

        return response()->json([
            'data' => $books
        ], 200);
    }

    public function show($id)
    {
        $db_book = Book::Where('id', $id)->first();
        $book = [];

        if (!$db_book) {
            return response()->json([
                'data' => 'Book not found!'
            ], 404);
        }

        $author = Author::Where('id', $db_book->author_id)->first();
        if (!$author) return response()->json(['data' => 'Author not found!'], 404);

        $genre = Genre::Where('id', $db_book->genre_id)->first();
        if (!$genre) return response()->json(['data' => 'Genre not found!'], 404); 

        array_push($book, [
            'id' => $db_book->id,
            'name' => $db_book->name,
            'author' => $author->name,
            'genre' => $genre->name,
            'created_at' => $db_book->created_at,
            'updated_at' => $db_book->updated_at,
        ]);

        return response()->json([
            'data' => $book
        ], 200);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'genre' => 'required'
        ]);

        // Check author if exists?
        $author = Author::Where('name', $request->author)->first();
        if (!$author) return response()->json(['data' => 'Author not found!'], 404);

        // Check genre if exists?
        $genre = Genre::Where('name', $request->genre)->first();
        if (!$genre) return response()->json(['data' => 'Genre not found!'], 404); 

        $book = Book::create([
            'name' => $request->name,
            'author_id' => $author->id,
            'genre_id' => $genre->id
        ]);

        if (!$book) {
            return response()->json([
                'data' => 'Somethings went wrong!'
            ], 404);
        }

        return response()->json([
            'data' => 'Book created!',
            'book' => $book,
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required',
            'author' => 'required',
            'genre' => 'required',
        ]);

        $author = Author::Where('name', $request->author)->first();
        if (!$author) return response()->json(['data' => 'Author not found!'], 404);

        $genre = Genre::Where('name', $request->genre)->first();
        if (!$genre) return response()->json(['data' => 'Genre not found!'], 404); 


        $book = Book::Where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'author_id' => $author->id,
                        'genre_id' => $genre->id,
                    ]);

        if (!$book) {
            return response()->json(['data' => 'Book not found!'], 404);
        }

        return response()->json([
            'data' => 'Book updated!'
        ], 200);

    }

    public function destroy($id)
    {
        $book = Book::Where('id', $id)->first();

        if (!$book) {
            return response()->json([
                'data' => 'Book not found!'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'data' => 'Book deleted!'
        ], 200);
    }
}
