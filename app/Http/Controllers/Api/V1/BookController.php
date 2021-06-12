<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return response()->json([
            'status' => true,
            'message' => 'List of all books',
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'book_cost' => 'required',
        ]);

        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'book_cost' => $request->book_cost,
            'author_id' => auth()->user()->id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Book created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Book::where('id', $id)->exists()) {

            $book = Book::find($id);

            return response()->json([
                'status' => true,
                'mesage' => 'Book data',
                'data' => $book
            ]);
        } else {

            return response()->json([
                'status' => false,
                'mesage' => 'Book not found', 
            ]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if(Book::where(['id' => $id, 'author_id' => auth()->user()->id])->exists()) {
           
            $book = Book::find($id);
            $book->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Book updated successfully'
            ]);
        }else {

            return response()->json([
                'status' => false,
                'message' => 'Book not found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(Book::where(['id' => $id, 'author_id' => auth()->user()->id])->exists()) {
            
            Book::destroy($id);

            return response()->json([
                'status' => true,
                'message' => 'Book deleted successfully'
            ]);
        }else {

            return response()->json([
                'status' => false,
                'message' => 'Book not found'
            ]);
        }
    }
}
