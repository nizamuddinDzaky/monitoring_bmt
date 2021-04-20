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
                <p class="filter-title">Report Koperasi</p>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-sm-12 col-md-12 col-lg-12" id="ShowTable">
        <div class="card">
            <div class="header text-center">
                <h4 class="title"><b>Report Koperasi</b> </h4>
                <p class="category">Neraca Koperasi</p>
                <br />
            </div>
            <div class="row">
                <div class="form-group col-md-10 col-md-offset-1">
                    <select name="" id="filter-koperasi" class="form-control">
                    <option selected > - Koperasi -</option>
                    @foreach($list_koperasi as $koperasi)
                        <option value="{{$koperasi->id}}"> {{$koperasi->name}} </option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
        
    <script>
        $().ready(function(){
            $('#filter-koperasi').select2()
        });
    </script>

@endsection
@section('footer')
	@include('layouts.footer')
@endsection