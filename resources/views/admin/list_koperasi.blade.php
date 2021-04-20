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
                <p class="filter-title">Daftar Koperasi</p>
                <button class="btn btn-primary rounded right shadow-effect" id="btn-add-koperasi" data-url="{{route('admin.add.koperasi')}}"><i class="fa fa-handshake-o"></i> Tambah Koperasi</button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-sm-12 col-md-12 col-lg-12" id="ShowTable">
        <div class="card">
            <div class="header text-center">
                <h4 class="title"><b>Daftar Koperasi</b> </h4>
                <br />
            </div>
            <table class="table bootstrap-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>End Point</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_koperasi as $koperasi)
                    <tr>
                        <td>{{$koperasi->name}}</td>
                        <td>{{$koperasi->end_point}}</td>
                        <td class="text-center">
                            <span class="td-status label label-{{$koperasi->is_active == 1 ? 'success':'danger'}}" 
                                data-status = "{{$koperasi->is_active}}"
                                data-url="{{route('admin.edit.status.koperasi', ['id_koperasi' => $koperasi->id, 'next_status' => ($koperasi->is_active == 1 ? 0 : 1)])}}"
                            >{{$koperasi->is_active == 1 ? 'Aktif':'Tidak Aktif'}}</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm btn-edit-koperasi" data-value="{{$koperasi}}" data-url="{{route('admin.edit.koperasi')}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
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
    @include('modal.list_koperasi')
@endsection
@section('extra_script')
    <script>
        $(document).ready(function(){
            $('#btn-add-koperasi').click(function(){
                $('#title-form').text("Tambah Koperasi");
                $('#form-koperasi').attr('action', $(this).data('url'));
                $("#form-koperasi").trigger("reset");
                $('#modal-form-koperasi').modal('toggle');
                $('#modal-form-koperasi').modal('show');
            })

            $('.btn-edit-koperasi').click(function(){
                let data_koperasi = $(this).data('value');
                $('#title-form').text("Edit Koperasi");
                $('#input-id').val(data_koperasi.id);
                $('#form-koperasi').attr('action', $(this).data('url'));
                $("#form-koperasi").trigger("reset");
                $('#input-end-point').val(data_koperasi.end_point)
                $('#input-name').val(data_koperasi.name)
                $('#modal-form-koperasi').modal('toggle');
                $('#modal-form-koperasi').modal('show');
            });
            $('.td-status').click(function(){
                let url = $(this).data('url');
                let status = $(this).data('status')
                let message = '';
                if(status == 1 || status == '1'){
                    message = 'Apakah Anda Ingin Me non Aktifkan Koperasi ?';
                }else{
                    message = 'Apakah Anda Ingin Meng Aktifkan Koperasi ?';
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