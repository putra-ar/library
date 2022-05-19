@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Users</h2>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>name</th>
                <th>email</th>
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
        ajax: "{{ route('user.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
        ]
    });

  });
</script>

@endsection

