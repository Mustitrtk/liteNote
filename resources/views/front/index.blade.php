@extends('front.layout.app')

@section('content')
    <div class="card my-3">
        <div class="card-body">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Notlarım</h5>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createNoteModal">
                    +
                </button>
            </div>

            @foreach($notes as $note)
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$note->title}}</h5>
                        <p class="card-text">{{$note->theme}}</p>

                        <!--Button Trigger Modal-->
                        <button type="button" onclick="edit({{$note}})" data-toggle="modal" data-target="#updateNoteModal" class="btn btn-info">Güncelle</button>
                        <button type="button" class="btn btn-danger" onclick="del({{$note->id}})">Sil</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('modals')
    <!-- Modal of the Create Note-->
    <div class="modal fade" id="createNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Not Oluştur</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form id="note_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Başlık</label>
                            <input required value="{{old('title')}}" name="title" type="text" class="form-control" id="title" placeholder="Başlık">
                        </div>
                        <div class="form-group">
                            <label for="theme">İçerik</label>
                            <input required value="{{old('theme')}}" name="theme" type="text" class="form-control" id="theme" placeholder="Metin">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="action_button" id="action_button" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal of the Update Note-->
    <div class="modal fade" id="updateNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Not Oluştur</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form id="edit_note_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="yid" id="yid">
                        <div class="form-group">
                            <label for="title">Başlık</label>
                            <input required name="ytitle" type="text" class="form-control" id="ytitle" placeholder="Başlık">
                        </div>
                        <div class="form-group">
                            <label for="theme">İçerik</label>
                            <input required name="ytheme" type="text"  class="form-control" id="ytheme" placeholder="Metin">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="action_button" id="action_button" class="btn btn-primary">Güncelle</button>
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

        $("#note_form").submit(function (e){
            e.preventDefault();
            var df = new FormData(this);

            $.ajax({
                method: 'POST', // Change the method to POST
                url: "{{ route('note.create') }}",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: df,
                success: function (data) {
                    console.log(data);
                    $('#createNoteModal').modal('hide');
                    location.reload();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        function edit(note) {
            $('#updateNoteModal').modal('show');
            $.ajax({
                type:"GET",
                url:"{{route('note.edit')}}",
                data:{
                    id:note['id'],
                },
                success: function (response){

                    $('#yid').val(response.data.id);
                    $('#ytitle').val(response.data.title);
                    $('#ytheme').val(response.data.theme);
                },
                error: function (xhr,status,error)
                {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }

        $("#edit_note_form").submit(function (e){
            e.preventDefault();
            var df = new FormData(this);

            $.ajax({
                method: 'POST', // Change the method to POST
                url: "{{ route('note.update') }}",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: df,
                success: function (data) {
                    console.log(data);
                    $('#updateNoteModal').modal('hide');
                    location.reload();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        function del(id){
            if( confirm('Silmek istediğinize emin misiniz ?') == true ){
                $.ajax({
                    type:"DELETE",
                    url:"{{route('note.delete')}}",
                    data:{
                        id:id,
                    },
                    success: function (response){
                        console.log(response)
                        location.reload();
                    },
                    error: function (response){
                        console.log(response)
                    },
                });
            }
        }

    </script>
@endsection
