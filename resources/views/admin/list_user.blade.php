@extends('layouts.apps')

@section('side-navbar')
	@include('layouts.side_navbar')
@endsection

@section('top-navbar')
	@include('layouts.top_navbar')
@endsection
@section('extra_style')
    <style>
        .td-status{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')

<div class="head">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">

            <div class="head-filter">
                <p class="filter-title">Daftar User</p>
                <button class="btn btn-primary rounded right shadow-effect" id="btn-add-user" data-url="{{route('admin.add.user')}}"><i class="fa fa-handshake-o"></i> Tambah User</button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-sm-12 col-md-12 col-lg-12" id="ShowTable">
        <div class="card">
            <div class="header text-center">
                <h4 class="title"><b>Daftar User</b> </h4>
                <br />
            </div>
            <table class="table bootstrap-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_user as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td class="text-center">
                            <span class="td-status label label-{{$user->is_active == 1 ? 'success':'danger'}}" 
                                data-status = "{{$user->is_active}}"
                                data-url="{{route('admin.edit.status.user', ['id_user' => $user->id, 'next_status' => ($user->is_active == 1 ? 0 : 1)])}}"
                            >{{$user->is_active == 1 ? 'Aktif':'Tidak Aktif'}}</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm btn-edit-user" data-value="{{$user}}" data-url="{{route('admin.edit.user')}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('modal')
    @include('modal.list_user')
@endsection
@section('extra_script')
    <script>
        $(document).ready(function(){
            $('#btn-add-user').click(function(){
                $('#title-form').text("Tambah User");
                $('#form-user').attr('action', $(this).data('url'));
                $("#form-user").trigger("reset");
                $('#modal-form-user').modal('toggle');
                $('#modal-form-user').modal('show');
            })

            $('.btn-edit-user').click(function(){
                let data_user = $(this).data('value');
                $('#title-form').text("Edit User");
                $('#input-id').val(data_user.id);
                $('#form-user').attr('action', $(this).data('url'));
                $("#form-user").trigger("reset");
                $('#input-email').val(data_user.email)
                $('#input-name').val(data_user.name)
                $('#modal-form-user').modal('toggle');
                $('#modal-form-user').modal('show');
            });
            $('.td-status').click(function(){
                let url = $(this).data('url');
                let status = $(this).data('status')
                let message = '';
                if(status == 1 || status == '1'){
                    message = 'Apakah Anda Ingin Me non Aktifkan Pengguna ?';
                }else{
                    message = 'Apakah Anda Ingin Meng Aktifkan Pengguna ?';
                }
                swal({
                    title: message,
                    showDenyButton: true,
                    type : 'question',
                    showCancelButton: true,
                    confirmButtonText: `Save`,
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.value) {
                        window.location.href = url;
                    }
                })
            })
        });
    </script>

@endsection
@section('footer')
	@include('layouts.footer')
@endsection