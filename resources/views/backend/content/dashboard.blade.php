@extends('backend.layout.main')
@section('content')

<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Artist</p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalArtist }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-album-2 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Album</p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalAlbum }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Product Section -->
    <div class="product-section mt-4">
        <div class="row">
            @foreach($latestAlbums as $album)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $album->gambar_album) }}" class="card-img-top" alt="{{ $album->name_album }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $album->name_album }}</h5>
                        <p class="card-text">{{ $album->genre }}</p>
                        <p class="card-text">Price: Rp {{ number_format($album->price, 2) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- End Product Section -->

</div>
@endsection
