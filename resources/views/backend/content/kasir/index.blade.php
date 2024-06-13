@extends('backend.layout.main')

@section('judul', 'Aplikasi Kasir')

@section('content')
    <div class="row">
        <div class="col-12">
            <input type="text" id="input-barcode" name="barcode" class="form-control" placeholder="Scan Barcode" />
        </div>
    </div>
    <form method="post" action="{{ route('kasir.insert') }}">
        @csrf
        <div class="row">
            <div class="col-8 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="table-cart">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Nama Album</th>
                                    <th>@</th>
                                    <th>Qty</th>
                                    <th>SubTotal</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-3">
                <div class="card">
                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td>
                                    <label for="subtotal">Sub Total</label>
                                    <input type="text" readonly name="subtotal" id="subtotal"
                                        class="form-control text-right">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="discount">Discount (%)</label>
                                    <input type="number" min="0" max="100" name="discount" id="discount"
                                        value="0" class="form-control text-right">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="total">Total</label>
                                    <input type="text" readonly name="total" id="total"
                                        class="form-control text-right">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
    $('#input-barcode').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault(); // Prevent form submission
            console.log('Enter di klik, barcode: ' + $(this).val());
            $.ajax({
                url: '{{ route('kasir.searchAlbum') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    barcode: $(this).val()
                },
                success: function(data) {
                    if (data.length === 0) {
                        toastr.error('Album yang dicari tidak ditemukan', 'Error');
                        $('#input-barcode').val('');
                        return;
                    }
                    addAlbumToTable(data);
                    toastr.success('Album Berhasil masuk ke keranjang belanja', 'Berhasil');
                    $('#input-barcode').val('');
                },
                error: function() {
                    toastr.error('Album yang dicari tidak ditemukan', 'Error');
                    $('#input-barcode').val('');
                }
            });
        }
    });

    function addAlbumToTable(album) {
        let rowExist = $('#table-cart tbody').find('.p-' + album.barcode);
        if (rowExist.length > 0) {
            let qty = parseInt(rowExist.find('.qty').eq(0).val());
            qty += 1;
            rowExist.find('.qty').eq(0).val(qty);
            rowExist.find('td').eq(3).text(qty);
            rowExist.find('td').eq(4).text(qty * album.price);
        } else {
            $('#table-cart tbody').append(
                '<tr class="p-' + album.barcode + '">' +
                '<td><input type="hidden" name="id_album[]" value="' + album.id + '">' + album.nama + '</td>' +
                '<td>' + album.artist.nama + '</td>' +
                '<td>' + album.price + '</td>' +
                '<td><input type="number" name="qty[]" class="qty" value="1" min="1"></td>' +
                '<td>' + album.price + '</td>' +
                '<td><button class="btn btn-danger remove-item">Remove</button></td>' +
                '</tr>'
            );
        }
        updateTotal();
    }

    function updateTotal() {
        let subtotal = 0;
        $('#table-cart tbody tr').each(function() {
            let price = parseFloat($(this).find('td').eq(2).text());
            let qty = parseInt($(this).find('.qty').val());
            let total = price * qty;
            $(this).find('td').eq(4).text(total);
            subtotal += total;
        });
        $('#subtotal').text(subtotal);
    }

    $(document).on('click', '.remove-item', function() {
        $(this).closest('tr').remove();
        updateTotal();
    });

    $(document).on('change', '.qty', function() {
        updateTotal();
    });
});

    </script>
@endpush
