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
                                @can('admin')
                                    <a href="{{route('album.ubah',$row->id_album)}}" class="btn btn-sm btn-warning" style="color: black;"><i class="fa fa-edit"></i> Ubah</a>
                                    <a href="{{route('album.hapus',$row->id_album)}}" onclick="return confirm('Anda yakin?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
