@extends('layouts.app')

@section('content')
    <div class="container mt-2">

        <h2>Edit Book</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('book.update',$book->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3 mt-3">
                <label for="name">Title :</label>
                <input type="text" class="form-control" id="title" value="{{ $book->title }}" placeholder="Enter name" name="title">
            </div>
            <div class="mb-3 mt-3">
                <label for="name">Author :</label>
                <select class="form-control" id="author_id" name="author_id">
                    @foreach ($author as $item)
                       <option value="{{ $item->id }}" @if ($book->author_id == $item->id) {{ 'selected' }} @endif>{{ $item->name }}</option>
                    @endforeach
                 </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="name">Description :</label>
                <textarea class="form-control" id="description" placeholder="Enter description" name="description">{{ $book->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('book.index') }}"> Back</a>
        </form>
    @endsection
