@extends('backend/layout/main')
@section('content')
<div class="container-fluid">
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-6">
            <h1 class="h3 mb-2 text-gray-800">List Album</h1>
        </div>
        <div class="col-lg-6 text-right">
            <a href="{{ route('album.tambah') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
        </div>
    </div>

    @if (session()->has('pesan'))
    <div class="alert alert-{{session()->get('pesan')[0]}}">
        {{session()->get('pesan')[1]}}
    </div>

    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Album</th>
                            <th>Gambar album</th>
                            <th>Genre</th>
                            <th>Stock</th>
                            <th>Nama Artist</th>
                            <th>Price</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($album as $row)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$row->name_album}}</td>
                            <td><img src="{{route('storage', $row->gambar_album)}}" width="200px" height="200px"></td>
                            <td>{{$row->genre}}</td>
                            <td>{{$row->stock}}</td>
                            <td>{{$row->artist->nama_artist}}</td>
                            <td>{{$row->price}}</td>
                            <td>
                                <a href="{{route('album.ubah',$row->id_album)}}" class="btn btn-sm btn-warning" style="color: black;"><i class="fa fa-edit"></i> Ubah</a>
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusAlbumModal" data-id="{{$row->id_album}}" data-name="{{$row->name_album}}"><i class="fa fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusAlbumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="color: black">
            <div class="modal-header" style="background-color: pink">
                <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin hapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik Hapus jika kamu benar benar ingin hapus <strong></strong></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="deleteButton" href="#">Hapus</a>
            </div>
        </div>
    </div>
</div>

@endsection