@extends('front.layout.app')

@section('content')
    <div class="card my-3">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">Kullanıcılar</h5>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createUserModal">
                +
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="userTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ad</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modals')
    <!-- Modal of Create User -->
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Oluştur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="user_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Oluştur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal of Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="user_edit_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="user_id">
                        <div class="form-group">
                            <label for="user_name">Name</label>
                            <input type="text" class="form-control" id="user_name" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email address</label>
                            <input type="email" class="form-control" id="user_email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" class="form-control" id="user_password" name="password" placeholder="Password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
                {data:'action',name:'action'},
            ],
        });

        $('#user_form').submit(function (e){
            e.preventDefault();
            var df = new FormData(this);

            $.ajax({
                method:"POST",
                url:"{{route('user.create')}}",
                dataType:"json",
                data:df,
                cache: false,
                contentType: false,
                processData: false,
                success:function (data){
                    console.log(data);
                    $('#createUserModal').modal('hide');
                    dataTable.ajax.reload();
                },
                error:function (data){
                    console.log(data);
                }
            });
        });

        function edit(id){

            $.ajax({
                method:"GET",
                url:"{{route('user.edit')}}",
                data: {
                    id: id,
                },
                success:function (res){
                    $('#editUserModal').modal("show");
                    $('#user_id').val(res.data.id);
                    $('#user_name').val(res.data.name);
                    $('#user_email').val(res.data.email);
                    $('#user_password').val(res.data.password);
                    dataTable.ajax.reload();
                },
                error:function (data){
                    console.log(data);
                }
            });
        }

        $('#user_edit_form').submit(function (e){
            e.preventDefault();

            var df = new FormData(this);

            $.ajax({
                method: 'POST', // Change the method to POST
                url: "{{ route('user.edit.action') }}",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: df,
                success: function (data) {
                    console.log(data);
                    $('#editUserModal').modal('hide');
                    dataTable.ajax.reload();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });


    </script>
@endsection
