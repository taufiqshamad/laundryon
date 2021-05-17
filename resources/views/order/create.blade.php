@extends('layouts.app')

@section('content')
<!-- Header -->
    <header id="header" class="ex-header" style="background-color:#fff">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2 class="black">Lokasi dan Berat</h1>
                    <h5>Silahkan isi lokasi penjemputan dan berat pakaian</h6>
                    <form method="POST" action="{{route('order.store')}}">
                        @csrf
                        <div class="form-group pt-4 mt-4">
                            <label class="float-left">Lokasi Penjemputan</label>
                            <input class="form-control" placeholder="Contoh : Jl. Sisingamangaraja No. 54A" name="lokasi" value="{{ old('lokasi') }}">
                            @error('lokasi')
                            <h6 class="text-danger text-left">Lokasi tidak boleh kosong</h6>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="float-left">Berat</label>
                            <input class="form-control" name="berat" placeholder="Contoh : sekitar 2kg" value="{{ old('berat') }}">
                            @error('berat')
                            <h6 class="text-danger text-left">Berat tidak boleh kosong</h6>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-solid-lg btn-block">Lanjut</button>  
                        </div>
                    </form>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
<!-- end of header -->
@endsection
