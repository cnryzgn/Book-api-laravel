<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        if (count($authors) === 0) {
            return response()->json([
                'data' => 'Not found any author!'
            ], 404);
        }

        return response()->json([
            'data' => $authors
        ], 200);
    }

    public function show($id)
    {
        $author = Author::Where('id', $id)->first();

        if (!$author) {
            return response()->json([
                'data' => 'Author not found!'
            ], 404);
        }

        return response()->json([
            'data' => $author
        ], 200);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required'
        ]);

        $author = Author::create([
            'name' => $request->name
        ]);

        if (!$author) {
            return response()->json([
                'data' => 'Somethings went wrong!'
            ], 500);
        }

        return response()->json([
            'data' => 'Author created!'
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required'
        ]);

        $author = Author::Where('id', $id)
                        ->update([ 'name' => $request->name ]);

        if (!$author) {
            return response()->json([
                'data' => 'Somethings went wrong!'
            ], 500);
        }

        return response()->json([
            'data' => 'Author updated!'
        ], 200);
    }
    
    public function destroy($id)
    {
        $author = Author::Where('id', $id)->first();

        if (!$author) {
            return response()->json([
                'data' => 'Author not found!'
            ], 500);
        }

        $author->delete();

        return response()->json([
            'data' => 'Author deleted!'
        ], 200);
    }
}
