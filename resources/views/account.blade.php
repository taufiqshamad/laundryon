@extends('layouts.app')

@section('content')
<!-- Header -->
    <header id="header" class="ex-header" style="background-color:#eee">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Halaman Akun</h1>
                    <h3>Anda dapat mengelola akun dan pesanan</h6>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
<!-- end of header -->
<!-- Details 1 -->
    <div class="bg-light" style="padding-bottom:100px;margin-bottom:-100px">
        <div class="container">
            <div class="row">

                <div class="col-lg-4" style="margin-top:40px;">
                    <h3 class="black">Akun</h3>
                    <div class="col-lg-12 shadow p-0 bg-white">
                        <div class="col-lg-12 py-4">
                            <h6>Nama</h6>
                            <h4 class="black">{{ $user->nama }}</h4>
                            <h6>Alamat</h6>
                            <h4 class="black">{{ $user->alamat }}</h4>
                            <h6>No. HP</h6>
                            <h4 class="black">{{ $user->no_telp }}</h4>
                            <h6>Email</h6>
                            <h4 class="black">{{ $user->email }}</h4>

                            {{-- <a href="{{ route('bookingComplete') }}" class="btn btn-solid-lg btn-block">Pilih Bengkel</a> --}}
                        </div>
                    </div>
                </div> <!-- end of col -->

                <div class="col-lg-8" style="margin-top:40px;">
                    <h3 class="black">Pesanan</h3>
                        @foreach($orders as $order)
                            <div class="col-lg-12 shadow p-0 mb-3 bg-white">
                                <div class="col-lg-12 py-4 d-flex flex-wrap">
                                    <div class="col-lg-4">
                                        <h6 class="text-success">Lokasi</h3>
                                        <h5 class="black">{{ $order->lokasi }}</h6>
                                    </div>
                                    <div class="col-lg-2">
                                        <h6 class="text-success">Berat</h3>
                                        <h5 class="black">{{ $order->berat }}</h6>
                                    </div>
                                    <div class="col-lg-3">
                                        <h6 class="text-success">Harga</h3>
                                        <h5 class="black">{{ empty($order->harga)?"Sedang dikonfirmasi...":"Rp. ".number_format($order->harga,0,'.','.') }}</h6>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <h6 class="text-success">Status</h3>
                                        <span style="font-size:10px;color:#fff;padding:10px;border-radius:50px;background-color:{{ $order->isComplete?"#28a745":"#ffc107" }}">
                                    {{ $order->isComplete?"Complete":"Belum Complete" }}
                                        </span>
                                    </div>
                                    <div class="col-lg-12">
                                        {{-- <hr>
                                        <a href="{{ route('bookingComplete') }}" class="btn btn-solid-lg btn-block">Lihat Pesanan</a> --}}
                                        <h6>Tanggal Order : {{ date("d M Y", strtotime($order->created_at)) }}</h6>
                                        @if($order->isComplete)
                                        <h6>Tanggal Complete : {{ date("d M Y", strtotime($order->updated_at)) }}</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div> <!-- end of col -->

            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-2 -->
    <!-- end of details 1 -->
@endsection
