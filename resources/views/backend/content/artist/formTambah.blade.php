@extends('backend/layout/main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Artist</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('artist.prosesTambah') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form label">Nama artist</label>
                        <input type="text" name="nama_artist" value="{{old('nama_artist')}}" class="form-control @error('nama_artist') is-invalid @enderror">
                        @error('nama_artist')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Kategori</label>
                        <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror">
                            @foreach($kategori as $row)
                                <option value="{{$row->id_kategori}}">{{$row->nama_kategori}} </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Gambar</label>
                        <input type="file" name="gambar_artist" class="form-control @error('gambar_artist') is-invalid @enderror"
                               accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                        @error('gambar_artist')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                        <p></p>
                        <img id="tampilFoto" onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B05I005KABlN930GwaMQz.jpg';" src="" alt="" width="15%">
                    </div>

                    <div class="mb-3">
                        <label class="form label">Description</label>
                        <textarea id="editor" name="description" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                        @error('description')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('artist.index') }}" class="btn btn-success">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection