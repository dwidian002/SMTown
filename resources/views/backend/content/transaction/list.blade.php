@extends('backend.layout.main')
@section('judul','Data Transaksi')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 style="margin-left: 15px;">List Transakasi</h2>
        <div class="card" style="margin-left: 15px;">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($counter = 1)
                        @foreach($rows as $row)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$row->code}}</td>
                                <td>{{$row->date}}</td>
                                <td class="text-right">Rp {{$row->total}}</td>
                                <td>
                                    <a href="{{route('transaksi.printPDF',$row->id_transaction)}}"
                                       target="_blank"
                                       class="btn btn-sm btn-danger">
                                        <i class="fas fa-file-pdf"></i>
                                        Print
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
