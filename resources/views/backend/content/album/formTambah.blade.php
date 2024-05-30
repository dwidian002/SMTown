@extends('backend/layout/main')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Form Tambah Album</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('album.prosesTambah') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form label">Nama Album</label>
                        <input type="text" name="name_album" value="{{old('name_album')}}" class="form-control @error('name_album') is-invalid @enderror">
                        @error('name_album')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Gambar Album</label>
                        <input type="file" name="gambar_album" class="form-control @error('gambar_album') is-invalid @enderror"
                               accept="image/*" onchange="tampilkanPreview(this, 'tampilFoto')">
                        @error('gambar_album')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                        <p></p>
                        <img id="tampilFoto" onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly70B05I005KABlN930GwaMQz.jpg';" src="" alt="" width="15%">
                    </div>

                    <div class="mb-3">
                        <label class="form label">Genre</label>
                        <input type="text" name="genre" value="{{old('genre')}}" class="form-control @error('genre') is-invalid @enderror">
                        @error('genre')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Barcode</label>
                        <input type="text" name="barcode" value="{{old('barcode')}}" class="form-control @error('barcode') is-invalid @enderror">
                        @error('barcode')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Artist</label>
                        <select name="id_artist" class="form-control @error('id_artist') is-invalid @enderror">
                            @foreach($artist as $row)
                                <option value="{{$row->id_artist}}">{{$row->nama_artist}} </option>
                            @endforeach
                        </select>
                        @error('id_artist')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form label">Harga</label>
                        <input type="number" name="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                        <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('artist.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection