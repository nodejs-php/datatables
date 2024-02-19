@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <h2>Users</h2>
            <table class="table table-bordered data-table" width="100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>config</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(function(){
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    })
</script>
