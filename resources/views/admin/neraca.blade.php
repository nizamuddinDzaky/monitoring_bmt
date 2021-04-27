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
                <p class="filter-title">Report Neraca</p>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-sm-12 col-md-12 col-lg-12" id="ShowTable">
        <div class="card">
            <div class="header text-center">
                <h4 class="title"><b>Report Neraca</b> </h4>
                <div class="hidden" id="div-status-neraca"><p class="category"><span  class="label badge-pill label-success" id="span-status-neraca">Neraca Seimbang</span></p></div>
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

        <div class="card" id="div-aktiva">

            <div class="header text-center">
                <h4  id="titlePrint3" class="title"><b>Laporan Neraca</b> </h4>
                <p  id="titlePrint4" class="category">Laporan Kewajiban dan Modal periode <span class="span-periode"></span></p>
                
                <br />
            </div>

            <table id="bootstrap-table" class="table ">
                <thead>
                    <th class="text-left">ID</th>
                    <th> Keterangan</th>
                    <th> Jumlah</th>
                </thead>
                <tbody id="tb-data-aktiva">
                </tbody>
            </table>
        </div>

        <div class="card" id="div-pasiva">

            <div class="header text-center">
                <h4  id="titlePrint3" class="title"><b>Laporan Neraca</b> </h4>
                <p  id="titlePrint4" class="category">Laporan Kewajiban dan Modal periode <span class="span-periode">asdasd</span></p>
                <br />
            </div>

            <table id="bootstrap-table" class="table ">
                <thead>
                    <th class="text-left">ID</th>
                    <th> Keterangan</th>
                    <th> Jumlah</th>
                </thead>
                <tbody id="tb-data-pasiva">
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
        
    <script>
        $().ready(function(){
            reset_neraca()
            $('#filter-koperasi').select2()

            $('#filter-koperasi').change(async function(){
                if($(this).val() == ''){
                    reset_neraca();
                    return false;
                }
                const response = await fetch($(this).val()+'{{env("END_POINT_REPORT_NERACA")}}', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                });
                const data = await response.json();
                build_data(data)
            });

            $('#select-periode').change(async function(){
                console.log($('#select-periode').val())
                const response = await fetch($('#filter-koperasi').val()+'{{env("END_POINT_REPORT_NERACA")}}'+$(this).val(), {
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
            let str_status_neraca = 'Neraca Seimbang';
            let label_status_neraca = 'label-success';
            if(!data.data.statusNeraca){
                str_status_neraca = 'Neraca tidak Seimbang';
                label_status_neraca = 'label-danger';
            }
            $('.span-periode').text(data.data.bulan);
            $('#div-status-neraca').removeClass('hidden');
            $('#span-status-neraca').text(str_status_neraca).removeClass('label-success').removeClass('label-danger').addClass(label_status_neraca)
            $('#select-periode').html(build_periode(data.data.periode));
            $('#tb-data-aktiva').html(build_table(data.data.data_aktiva, data.data.aktiva, "JUMLAH AKTIVA"))
            $('#tb-data-pasiva').html(build_table(data.data.data_pasiva, data.data.pasiva, "JUMLAH PASIVA"))
            
            $('#div-aktiva').slideDown()
            $('#div-pasiva').slideDown()
        }

        function build_periode(periode){
            let option = '<option disabled selected > - Periode -</option>'
            periode.forEach(function(item){
                option += '<option value="'+item.substring(0, 4)+'/'+item.substring(4, 6)+'"> '+item.substring(0, 4)+'-'+item.substring(4, 6)+'</option>'
            });

            return option;
        }

        function build_table(data, total, str_total){
            let tr = '';
            data.forEach(function(item){
                let saldo = '';
                if(item.tipe_rekening == 'detail'){
                    if(parseFloat(item.saldo) < 0){
                        saldo = Math.abs(parseFloat(item.saldo));
                    }else{
                        saldo = parseFloat(item.saldo);
                    }
                }
                console.log(saldo);
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
                '</tr>'
            return tr;
        }

        function space_(data){
            let str = '';
            for(let i = 0 ; i < data ; i ++){
                str += '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            return str
        }

        function reset_neraca(){
            $('#select-periode').html('<option disabled selected > - Periode -</option>');
            $('#tb-data-aktiva').empty();
            $('#tb-data-pasiva').empty();
            $('.span-periode').text('');
            $('#div-status-neraca').addClass('hidden');
            $('#div-aktiva').slideUp()
            $('#div-pasiva').slideUp()
        }
    </script>

@endsection
@section('footer')
	@include('layouts.footer')
@endsection