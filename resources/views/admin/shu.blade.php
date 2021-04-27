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
                <p class="filter-title">Laporan Laba/Rugi</p>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-sm-12 col-md-12 col-lg-12" id="ShowTable">
        <div class="card">
            <div class="header text-center">
                <h4 class="title"><b>Laporan Laba/Rugi</b> </h4>
                <br />
            </div>
            <div class="row text-center">
                <div class="form-group ">
                    <select name="" id="filter-koperasi" class="form-control">
                    <option selected value=""> - Koperasi -</option>
                    @foreach($list_koperasi as $koperasi)
                        <option value="{{$koperasi->end_point}}"> {{$koperasi->name}} </option>
                    @endforeach
                    </select>
                
                </div>
                <div class="form-group ">
                    <select required  name="periode" class="beautiful-select" style="height: 1.9em" id="select-periode">
                        <option disabled selected > - Periode -</option>
                    </select>
                
                </div>
            </div>
        </div>

        <div class="card" id="div-pendapatan">

            <div class="header text-center">
                <h4  id="titlePrint3" class="title"><b>Laporan Pendapatan</b> </h4>
                <p  id="titlePrint4" class="category">Laporan Pendapatan periode <span class="span-periode"></span></p>
                
                <br />
            </div>

            <table id="bootstrap-table" class="table ">
                <thead>
                    <th class="text-left">ID</th>
                    <th> Keterangan</th>
                    <th> Jumlah</th>
                </thead>
                <tbody id="tb-data-pendapatan">
                </tbody>
            </table>
        </div>

        <div class="card" id="div-pengeluaran">

            <div class="header text-center">
                <h4  id="titlePrint3" class="title"><b>Laporan Pengeluaran</b> </h4>
                <p  id="titlePrint4" class="category">Laporan Pengeluaran periode <span class="span-periode"></span></p>
                <br />
            </div>

            <table id="bootstrap-table" class="table ">
                <thead>
                    <th class="text-left">ID</th>
                    <th> Keterangan</th>
                    <th> Jumlah</th>
                </thead>
                <tbody id="tb-data-pengeluaran">
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
<script>
    $().ready(function(){
        $('#filter-koperasi').select2()
        reset()

        $('#filter-koperasi').change(async function(){
            if($(this).val() == ''){
                reset();
                return false;
            }
            const response = await fetch($(this).val()+'{{env("END_POINT_REPORT_SHU")}}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            });
            const data = await response.json();
            // console.log(data);
            build_data(data)
        });

        $('#select-periode').change(async function(){
            const response = await fetch($('#filter-koperasi').val()+'{{env("END_POINT_REPORT_SHU")}}/'+$(this).val(), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            });
            const data = await response.json();
            build_data(data)
        });
    });

    function build_data(data){
        $('.span-periode').text(data.data.bulan);
        $('#select-periode').html(build_periode(data.data.periode));
        $('#tb-data-pendapatan').html(build_table(data.data.data_laba, data.data.laba, "JUMLAH PENDAPATAN"));
        $('#tb-data-pengeluaran').html(build_table(data.data.data_rugi, data.data.rugi, "JUMLAH PENGELUARAN"));
        $('#div-pendapatan').slideDown()
        $('#div-pengeluaran').slideDown()
    }

    function reset(){
        $('.span-periode').text('');
        $('#select-periode').html('<option disabled selected > - Periode -</option>');
        $('#tb-data-pendapatan').empty();
        $('#tb-data-pengeluaran').empty();
        $('#div-pendapatan').slideUp()
        $('#div-pengeluaran').slideUp()
    }

    function build_table(data, total, str_total){
        let tr = '';
        data.forEach(function(item){
            let saldo = '';
            if(item.tipe_rekening == 'detail' && parseFloat(item.saldo) == 0){
                return;
            }else{
                if(item.tipe_rekening == 'detail' && parseFloat(item.saldo) != 0){
                    if(item.tipe_rekening == 'detail'){
                        saldo = parseFloat(item.saldo)
                    }
                }
            }

            tr += '<tr>' +
                        '<td class="text-left">'+item.id_bmt+'</td>' +
                        '<td class="text-left">' + space_(item.point) + item.nama + '</td>' +
                        '<td class="text-right">'+saldo+'</td>' +
                    '</tr>'
        });

        tr += '<tr>' +
                    '<td></td>' +
                    '<td class="text-center text-uppercase"><h5><b>'+str_total+'</b>  </h5></td>' +
                    '<td class="text-right"><b>'+total+'</b></td>' +
                '</tr>';

        return tr;
    }

    function build_periode(periode){
        let option = '<option disabled selected > - Periode -</option>'
        periode.forEach(function(item){
            option += '<option value="'+item.substring(0, 4)+'/'+item.substring(4, 6)+'"> '+item.substring(0, 4)+'-'+item.substring(4, 6)+'</option>'
        });

        return option;
    }

    function space_(data){
            let str = '';
            for(let i = 0 ; i < data ; i ++){
                str += '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            return str
        }
</script>
@endsection
@section('footer')
	@include('layouts.footer')
@endsection