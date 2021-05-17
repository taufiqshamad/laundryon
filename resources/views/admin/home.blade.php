@extends('layouts.appAdmin')

@section('content')
<!-- Header -->
    <header id="header" class="ex-header" style="background-color:#eee">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Pesanan masuk</h1>
                    <h3>Daftar pesanan yang masuk</h6>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
<!-- end of header -->
<!-- Details 1 -->
    <div class="bg-light pt-5">
        <div class="container">
            <div class="row">
                @if(session('success'))
                    <div class="col-lg-6 offset-lg-3 alert alert-success alert-dismissible">
                        {{ session('success') }}
                    </div>
                @endif
                @foreach($orders as $order)

                <div class="col-lg-12 shadow p-0 mb-3 bg-white d-flex flex-wrap">
                    <div class="col-lg-4 py-4 d-flex flex-wrap">
                        <div class="col-lg-12">
                            <h6 class="text-success">Nama Pemesan</h3>
                            <h5 class="black">{{ $order->user->nama }}</h6>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="text-success">No. HP</h3>
                            <h5 class="black">{{ $order->user->no_telp }}</h6>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="text-success">Email</h3>
                            <h5 class="black">{{ $order->user->email }}</h6>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="text-success">Alamat</h3>
                            <h5 class="black">{{ $order->user->alamat }}</h6>
                        </div>
                    </div>

                    <div class="col-lg-4 py-4 d-flex flex-wrap">
                        <div class="col-lg-12">
                            <h6 class="text-success">Lokasi Penjemputan</h3>
                            <h5 class="black">{{ $order->lokasi }}</h6>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="text-success">Berat</h3>
                            <h5 class="black">{{ $order->berat }}</h6>
                        </div>
                        <div class="col-lg-12">
                            <h6 class="text-success">Harga</h3>
                            <h5 class="black">{{ empty($order->harga)?"Sedang dikonfirmasi...":"Rp. ".number_format($order->harga,0,'.','.') }}</h6>
                        </div>
                        <div class="col-lg-12 mb-4">
                            <h6 class="text-success">Status</h3>
                            <span style="font-size:10px;color:#fff;padding:10px;border-radius:50px;background-color:{{ $order->isComplete?"#28a745":"#ffc107" }}">
                        {{ $order->isComplete?"Complete":"Belum Complete" }}
                            </span>
                        </div>
                        <div class="col-lg-12">
                            {{-- <hr>
                            <a href="{{ route('bookingComplete') }}" class="btn btn-solid-lg btn-block">Lihat Pesanan</a> --}}
                            <h6>Tanggal Order : {{ date("d M Y", strtotime($order->created_at)) }}</h6>
                        </div>
                    </div>

                    <div class="col-lg-4 pt-3">
                        @if(empty($order->harga))
                        <h3 class="black">Update Harga</h3>
                        <form action="{{ route('admin.updateHarga', $order) }}" method="POST">
                            @csrf
                            <div class="alert alert-primary">
                                Harga = Jumlah berat x Rp. 6000
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input class="form-control" name="harga" placeholder="Contoh : 10000">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-solid-lg btn-block">Update</button>
                            </div>
                        </form>
                        @elseif(!empty($order->harga) && !$order->isComplete)
                        <h3 class="black">Complete Pesanan</h3>
                        <form action="{{ route('admin.updateHarga', $order) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <h6 class="text-success">Harga</h3>
                                <h5 class="black">Rp. {{ number_format($order->harga,0,'.','.') }}</h6>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.completeOrder', $order) }}" class="btn btn-solid-lg btn-block">Complete Pesanan</a>
                            </div>
                        </form>
                        @else
                            <h3 class="black">Pesanan Complete!</h3>
                            <div class="form-group">
                                <h6 class="text-success">Tanggal Complete</h3>
                                <h5 class="black">{{ date("d M Y", strtotime($order->updated_at)) }}</h6>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- <div class="col-lg-12" style="margin-top:40px;">
                    <div class="col-lg-12 shadow p-0 d-flex flex-wrap">
                        <div class="col-lg-6 py-4">
                            <div>
                                <span style="font-size:10px;color:#fff;padding:10px;border-radius:50px;background-color:{{ $booking->bookingComplete==true?"#28a745":"#ffc107" }}">
                                    {{ $booking->bookingComplete==true?"Complete":"Belum Complete" }}
                                </span>
                            </div>
                            <h3 class="black mt-3">{{ $booking->tipe_service=='motor'?'Motor':'Mobil' }} - {{ $booking->tipe_kendaraan }}</h3>

                            <h6>{{ $booking->no_polisi }}</h6>
                            <h4 class="text-info">{{ $booking->lokasi }}</h4>
                            @if(!empty($booking->user))
                            <br>
                            <h6>Pemesan</h6>
                            <h4 class="black">{{ $booking->user->nama }}</h6>
                            <h4>{{ $booking->user->no_telp }}</h6>
                            @endif
                            @if(empty($booking->user->no_antrian))
                                
                            @else
                                
                            @endif
                        </div>
                        <div class="col-lg-6 py-4">
                            @if(!$booking->bookingComplete)
                            <h2 class="black">Antrian</h2>
                            @if(empty($booking->no_antrian))
                            <form method="POST" action="{{ route('admin.prosesAntrian', $booking) }}">
                                @csrf
                                <div class="form-group">
                                    <label>Bengkel</label>
                                    <select name="bengkel" class="form-control">
                                        @foreach($bengkels as $bengkel)
                                        <option value="{{ $bengkel->id }}">{{ $bengkel->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No. Antrian</label>
                                    <input type="text" name="no_antrian" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-solid-lg btn-block">Proses Antrian</button>
                            </form>
                            @else
                            <h4 class="text-info">No. Antrian : {{ $booking->no_antrian }}</h4>
                            <br>
                            <h6>Bengkel</h6>
                            <h4 class="black">{{ $booking->bengkel->nama }}</h4>
                            <form method="POST" action="{{ route('admin.completeBooking', $booking) }}">
                                @csrf
                                <button type="submit" class="btn btn-solid-lg btn-block">Complete Booking</button>
                            </form>
                            @endif
                            @endif
                        </div>
                    </div>
                </div> <!-- end of col --> --}}

                @endforeach
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-2 -->
    <!-- end of details 1 -->
@endsection
