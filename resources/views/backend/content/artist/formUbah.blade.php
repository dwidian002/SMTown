@extends('backend/layout/main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Ubah Artist</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('artist.prosesUbah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Artist</label>
                    <input type="text" name="nama_artist" value="{{ $artist->nama_artist }}" class="form-control @error('nama_artist') is-invalid  @enderror">
                    @error('nama_artist')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori Artist</label>
                    <select name="id_kategori" class="form-control @error('id_kategori') is-invalid  @enderror">
                        @foreach ($kategori as $row)
                        @php
                        $selected = $row->id_kategori == $artist->id_kategori ? 'selected' : '';
                        @endphp
                        <option value="{{ $row->id_kategori }}" {{ $selected }}>"{{ $row->nama_kategori }}"
                        </option>
                        @endforeach
                    </select>

                    @error('id_kategori')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="gambar_artist" class="form-control @error('gambar_artist') is-invalid  @enderror" accept="gambar_artist/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                    @error('nama_artist')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                    <p></p>
                    <img id="tampilFoto" onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B05I005KABlN930GwaMQz.jpg'; " src="{{route('storage', $artist->gambar_artist)}}" alt="" width="15%">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="editor" class="form-control @error('description') is-invalid  @enderror">{{$artist->description}}</textarea>
                    @error('description')
                    <span style="color:red; font-weight:600; font-size:9pt">{{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" name="id_artist" value="{{$artist->id_artist}}">

                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{ route('artist.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection