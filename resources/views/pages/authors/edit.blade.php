@extends('layouts.app')

@section('content')
    <div class="container mt-2">

        <h2>Edit Author</h2>

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
        <form action="{{ route('author.update',$author->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3 mt-3">
                <label for="name">Name :</label>
                <input type="text" class="form-control" id="name" value="{{ $author->name }}" placeholder="Enter name" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('author.index') }}"> Back</a>
        </form>
    @endsection
