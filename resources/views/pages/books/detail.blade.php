@extends('layouts.app')

@section('content')
    <div class="container mt-2">

        <h2>Book Detail</h2>
        <ul>
            <li>Title: {{ $book->title }}</li>
            <li>Athor: {{ $book->name }}</li>
            <li>Description: {{ $book->description }}</li>
        </ul>
        <a class="btn btn-primary" href="{{ route('book.index') }}"> Back</a>

    @endsection
