<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Author::get();
            return datatables(Author::all())
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return '
                                <a href="'. route('author.edit', $row->id) .'" class="edit btn btn-secondary btn-sm d-inline">Edit</a>
                                <form class="d-inline" action="' . route('author.destroy', $row->id) . '" method="POST">
                                    <button class="destroy btn btn-danger btn-sm d-inline" >Hapus</button>
                                    ' . method_field('delete') . csrf_field() . '
                                </form>
                        ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.authors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.authors.create');
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
            'name' => 'required',
        ]);

        Author::create($request->all());

        return redirect()->route('author.index')
                        ->with('success','Author has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('pages.authors.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $author->update($request->all());

        return redirect()->route('author.index')
                        ->with('success','Author updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('author.index')
                        ->with('success','Author has been deleted successfully');
    }
}
