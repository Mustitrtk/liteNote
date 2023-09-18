@extends('front.layout.app')

@section('content')
    <div class="card my-3">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">Kullanıcılar</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="userTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ad</th>
                        <th>Email</th>
                        <th>Created_at</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modals')

@endsection

@section('scripts')
    <script>
        var dataTable = null;
        dataTable = $('#userTable').DataTable({
            processing:true,
            serverSide:true,
            ajax:{
                url:"{{route('admin.index')}}",
            },
            columns:[
                {data:'id',name:'id'},
                {data:'name',name:'name'},
                {data:'email',name:'email'},
                {data:'created_at',name:'created_at'},
            ],
        });
    </script>
@endsection
