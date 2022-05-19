@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Books</h2>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <p class="text-end">
        <a href="{{ route('book.create') }}" class="btn btn-primary">Create author</a>
    </p>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Author</th>
                <th width="200px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('book.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'name', name: 'author'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

  });
</script>

@endsection

