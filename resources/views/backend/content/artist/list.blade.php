@extends('backend/layout/main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h3 mb-2 text-gray-800">List Artist</h1>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ route('artist.tambah') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama artist</th>
                                <th>Kategori</th>
                                <th>Description</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                                </tr>
                        </thead>
                        <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach ($artist as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->nama_artist}}</td>
                                <td>{{$row->kategori->nama_kategori}}</td>
                                <td>{{$row->description}}</td>
                                <td><img src="{{route('storage', $row->gambar_artist)}}" width="200px" height="200px"></td>
                                <td>
                                    <a href="{{route('artist.ubah',$row->id_artist)}}" class="btn btn-sm btn-warning" style="color: black;"><i class="fa fa-edit"></i> Ubah</a>
                                    <a href="{{route('artist.hapus',$row->id_artist)}}" onclick="return confirm('Anda yakin?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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