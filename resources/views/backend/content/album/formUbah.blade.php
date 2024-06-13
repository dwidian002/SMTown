@extends('backend/layout/main')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Ubah Album</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('album.prosesUbah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_album" value="{{ $album->id_album }}">

                <div class="mb-3">
                    <label class="form-label">Nama Album</label>
                    <input type="text" name="name_album" value="{{ old('name_album', $album->name_album) }}" class="form-control @error('name_album') is-invalid @enderror">
                    @error('name_album')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Album</label>
                    <input type="file" name="gambar_album" class="form-control @error('gambar_album') is-invalid @enderror" accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                    @error('gambar_album')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                    <p></p>
                    <img id="tampilFoto" onerror="this.onerror=null;this.src='{{ asset('storage/'.$album->gambar_album) }}';" src="" alt="" width="15%">
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" name="genre" value="{{ old('genre', $album->genre) }}" class="form-control @error('genre') is-invalid @enderror">
                    @error('genre')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Artist</label>
                    <select name="id_artist" class="form-control @error('id_artist') is-invalid @enderror">
                        @foreach($artist as $row)
                            <option value="{{ $row->id_artist }}" @if($album->id_artist == $row->id_artist) selected @endif>{{ $row->nama_artist }}</option>
                        @endforeach
                    </select>
                    @error('id_artist')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="price" value="{{ old('price', $album->price) }}" class="form-control @error('price') is-invalid @enderror">
                    @error('price')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $album->stock) }}" class="form-control @error('stock') is-invalid @enderror">
                    @error('stock')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{ route('album.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
