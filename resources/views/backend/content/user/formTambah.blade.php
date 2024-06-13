@extends('backend/layout/main')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Form Tambah Data Kasir</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('user.prosesTambah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Kasir</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span style="color: red; font-weight: 600; font-size: 9pt">{{ $message }}</span><br>
                    @enderror
                </div>

                <input type="hidden" name="password" value="123456">

                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="{{ route('user.list') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection
