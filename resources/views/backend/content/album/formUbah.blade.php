@extends('backend/layout/main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Ubah Data Album</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('album.prosesUbah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Album</label>
                    <input type="text" name="name_album" value="{{ $album->name_album }}" class="form-control @error('name_album') is-invalid  @enderror">
                    @error('name_album')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form label">Gambar Album</label>
                    <input type="file" name="gambar_album" class="form-control @error('gambar_album') is-invalid @enderror" accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                    @error('name_album')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span>
                    @enderror
                    <p></p>
                    <img id="tampilFoto" onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B05I005KABlN930GwaMQz.jpg';" src="{{route('storage',$album->gambar_album)}}" alt="" width="15%">
                </div>

                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" name="genre" value="{{ $album->genre }}" class="form-control @error('genre') is-invalid  @enderror">
                    @error('genre')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Barcode</label>
                    <input type="text" name="barcode" value="{{ $album->barcode }}" class="form-control @error('barcode') is-invalid  @enderror">
                    @error('barcode')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Artist</label>
                    <select name="id_artist" class="form-control @error('id_artist') is-invalid  @enderror">
                        @foreach ($artist as $row)
                        @php
                        $selected = $row->id_artist == $album->id_artist ? 'selected' : '';
                        @endphp
                        <option value="{{ $row->id_artist }}" {{ $selected }}>"{{ $row->nama_artist }}"
                        </option>
                        @endforeach
                    </select>

                    @error('id_artist')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Album</label>
                    <input type="number" name="price" value="{{ $album->price }}" class="form-control @error('price') is-invalid  @enderror">
                    @error('price')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" name="id_album" value="{{$album->id_album}}">

                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{ route('album.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection