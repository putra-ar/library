<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::select('books.id', 'books.title', 'books.description', 'authors.name')->join('authors', 'books.author_id', 'authors.id')->get();
            return datatables($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return '
                                <a href="'. route('book.show', $row->id) .'" class="show btn btn-primary btn-sm d-inline">View</a>
                                <a href="'. route('book.edit', $row->id) .'" class="edit btn btn-secondary btn-sm d-inline">Edit</a>
                                <form class="d-inline" action="' . route('book.destroy', $row->id) . '" method="POST">
                                    <button class="destroy btn btn-danger btn-sm d-inline" >Hapus</button>
                                    ' . method_field('delete') . csrf_field() . '
                                </form>
                        ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author = Author::all();

        return view('pages.books.create', compact('author'));
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
            'author_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        Book::create($request->all());

        return redirect()->route('book.index')
                        ->with('success','Book has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('pages.books.detail', compact('book'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $author = Author::all();

        return view('pages.books.edit',compact('book','author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'author_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $book->update($request->all());

        return redirect()->route('book.index')
                        ->with('success','Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('book.index')
                        ->with('success','Book has been deleted successfully');
    }
}
