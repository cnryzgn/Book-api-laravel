<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        
        if (count($genres) === 0) {
            return response()->json([
                'data' => 'Not found any genre!'
            ], 404);
        }

        return response()->json([
            'data' => $genres,
        ], 200);
    }

    public function show($id)
    {
        $genre = Genre::Where('id', $id)->first();

        if (!$genre) {
            return response()->json([
                'data' => 'Genre not found!'
            ], 404);
        }

        return response()->json([
            'data' => $genre
        ], 200);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required'
        ]);

        $genre = Genre::create(['name' => $request->name]);

        if (!$genre) {
            return response()->json([
                'data' => 'Something went wrong!'
            ], 500);
        }

        return response()->json([
            'data' => 'Genre created!'
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required'
        ]);

        $genre = Genre::Where(['id' => $id])
                        ->update([
                            'name' => $request->name
                        ]);

        if (!$genre) {
            return response()->json([
                'data' => 'Something went wrong!'
            ], 500); 
        }

        return response()->json([
            'data' => 'Genre updated!'
        ], 201);
    }

    public function destroy($id)
    {
        $genre = Genre::Where(['id' => $id])->first();
        $genre->delete();

        return response()->json([
            'data' => 'Genre deleted!'
        ], 200);
    }
}
