@extends('backend/layout/main')
@section('judul', 'Aplikasi Kasir')
@section('content')

<style>
    .form-control {
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #5e72e4;
        border-color: #5e72e4;
    }

    .btn-primary:hover {
        background-color: #324cdd;
        border-color: #324cdd;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .card-body {
        padding: 1.25rem;
    }

    .card-footer {
        background-color: #f0f2f5;
        border-top: 1px solid #dee2e6;
        border-bottom-left-radius: calc(0.25rem - 1px);
        border-bottom-right-radius: calc(0.25rem - 1px);
        padding: 0.75rem 1.25rem;
    }

    .card-footer .btn-primary {
        width: 100%;
        border-radius: 5px;
    }

    .card-footer .btn-primary:hover {
        background-color: #324cdd;
        border-color: #324cdd;
    }

    .card-footer .btn-primary i {
        margin-right: 8px;
    }
</style>

<div class="row">
    <div class="col-12">
        <input type="text" id="input-barcode" name="barcode" class="form-control" placeholder="Scan Barcode" />
    </div>
</div>
<form method="post" action="{{ route('kasir.insert') }}">
    <div class="row mt-3">
        @csrf
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table-cart">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Nama Album</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cart items will be appended here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td>
                                <label for="subtotal">Subtotal</label>
                                <input type="text" readonly name="subtotal" id="subtotal" class="form-control text-right">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="discount">Discount (%)</label>
                                <input type="number" min="0" max="100" name="discount" id="discount" value="0" class="form-control text-right">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="total">Total</label>
                                <input type="text" readonly name="total" id="total" class="form-control text-right">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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
                e.preventDefault(); // Prevent form submission on Enter
                $.ajax({
                    url: "{{ route('kasir.searchBarcode') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        barcode: $(this).val()
                    },
                    success: function(data) {
                        addProductToTable(data);
                        toastr.success('Album berhasil ditambahkan ke keranjang belanja', 'Berhasil');
                        $('#input-barcode').val('');
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Album yang dicari tidak ditemukan', 'Error');
                        $('#input-barcode').val('');
                    }
                });
            }
        });

        function addProductToTable(album) {
            let rowExist = $('#table-cart tbody').find('#p-' + album.barcode);
            if (rowExist.length > 0) {
                let qty = parseInt(rowExist.find('.qty').eq(0).val());
                qty += 1;
                rowExist.find('.qty').eq(0).val(qty);
                rowExist.find('td').eq(3).text(qty);
                rowExist.find('td').eq(4).text(qty * album.price);
            } else {
                let row = '';
                row += `<tr id='p-${album.barcode}'>`;
                row += `<td>${album.barcode}</td>`;
                row += `<td>${album.name_album}</td>`;
                row += `<td>${album.price}</td>`;
                row += `<input type='hidden' name='price[]' class='price' value="${album.price}" />`;
                row += `<input type='hidden' name='qty[]' class='qty' value="1" />`;
                row += `<input type='hidden' name='id_album[]' value="${album.id_album}" />`;
                row += `<td>1</td>`;
                row += `<td>${album.price}</td>`;
                row += `</tr>`;
                $('#table-cart tbody').append(row);
            }
            hitungTotalBelanja();
        }

        function hitungTotalBelanja() {
            let subtotal = 0;
            $.each($('.price'), function(index, obj) {
                let price = $(this).val();
                let qty = $('.qty').eq(index).val();
                subtotal += parseInt(price) * parseInt(qty);
            });
            let discount = parseInt($('#discount').val());
            let total = subtotal - (subtotal * discount / 100);
            $('#subtotal').val(subtotal);
            $('#total').val(total);
        }

        $('#discount').on('input', function() {
            hitungTotalBelanja();
        });
    });
</script>
@endpush
