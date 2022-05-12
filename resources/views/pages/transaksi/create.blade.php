@extends('layout.app', ['navbar' => false, 'cart' => true])

@section('title', 'Pesanan ' . $order->nama_customer)

@section('content')
<div class="row">
    <h4><strong>Pilih Menu</strong></h4>
    <p class="mb-0">Makanan:</p>
    <div class="row mt-2">
        @foreach ($produk as $data)
        @if ($data->kategori_id == 1)
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-primary card-rounded me-3">
                <div class="card-body d-flex justify-content-between align-items-center" style="padding: .8rem !important">
                    <div class="item">
                        <h4 class="card-title card-title-dash text-white">{{ $data->nama }}</h4>
                        <p class="status-summary-ight-white mb-1">Rp. {{ number_format($data->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="cta">
                        @if ($data->ketersediaan == 1)
                            <button id="modalBtn" data-bs-toggle="modal" data-bs-target="#addItem{{ $data->id }}"
                                type="button" class="btn btn-light m-0"><i class="ti-shopping-cart"></i></button>
                        @else
                            <button type="button" class="btn btn-light m-0" disabled><i class="ti-shopping-cart"></i></button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addItem{{ $data->id }}" tabindex="-1" aria-labelledby="addItem{{ $data->id }}Label" aria-hidden="true">
                @include('pages.transaksi.modal.item')
            </div>

        </div>
        @endif
        @endforeach
    </div>
    <p class="mb-0">Minuman:</p>
    <div class="row mt-2">
        @foreach ($produk as $data)
        @if ($data->kategori_id == 2)
        <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-primary card-rounded me-3">
                <div class="card-body d-flex justify-content-between align-items-center" style="padding: .8rem !important">
                    <div class="item">
                        <h4 class="card-title card-title-dash text-white">{{ $data->nama }}</h4>
                        <p class="status-summary-ight-white mb-1">Rp. {{ number_format($data->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="cta">
                        @if ($data->ketersediaan == 1)
                            <button id="modalBtn" data-bs-toggle="modal" data-bs-target="#addItem{{ $data->id }}"
                                type="button" class="btn btn-light m-0"><i class="ti-shopping-cart"></i></button>
                        @else
                            <button type="button" class="btn btn-light m-0" disabled><i class="ti-shopping-cart"></i></button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addItem{{ $data->id }}" tabindex="-1" aria-labelledby="addItem{{ $data->id }}Label" aria-hidden="true">
                @include('pages.transaksi.modal.item')
            </div>

        </div>
        @endif
        @endforeach
    </div>
  </div>

  <!-- Modal -->
    <div class="modal fade" id="checkout{{ $order->id }}" tabindex="-1" aria-labelledby="checkout{{ $order->id }}Label" aria-hidden="true">
        @include('pages.transaksi.modal.checkout')
    </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var notyf = new Notyf({
            duration: 3500,
            ripple: true,
            dismissible: true,
            position: {
                x: 'center',
                y: 'top',
            },
        });

        getOrder('{{ $order->id }}');

        function getOrder(id) {
            $.ajax({
                url: '/transaksi/' + id + '/get_order',
                type: 'GET',
                success: function(data) {
                    $('#selectedItem').html(data);
                }
            });
        }

        function storeItem(id) {
            var jumlah = $('#jumlah' + id).val();
            var produk_id = id;
            var order_id = '{{ $order->id }}';

            $("#AddButton"+id).html('please wait...').attr('disabled', true);

            $.ajax({
                url: '/transaksi/' + order_id + '/add_item',
                type: 'POST',
                data: {
                    jumlah: jumlah,
                    produk_id: produk_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    getOrder(order_id);
                    setTimeout(() => {
                        $("#AddButton"+id).html('Masukkan ke Keranjang').attr('disabled', false);
                    }, 1000);
                    $('#addItem' + id).modal('hide');
                    $('#jumlah' + id).val('');
                    notyf.success(data.message);
                },
                error: function(data) {
                    notyf.error(data.responseJSON.message);
                }
            });
        }

        $('#showCheckout{{ $order->id }}').click(function() {
            getOrderDetail('{{ $order->id }}');
            $('#checkout{{ $order->id }}').modal('show');
        });

        function moneyFormat(bilangan) {
            var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }

        function total(ar) {
            var sum = 0;
            for (var i = 0; i < ar.length; i++) {
                sum += ar[i];
            }
            return sum;
        }

        const loader = '<tr class="text-center"><td colspan="5"><div class="dots m-auto"></div></td></tr>';

        function getOrderDetail(id) {
            $('#tableBody').empty();
            $('#tableBody').append(loader);
            $.ajax({
                url: '/transaksi/' + id + '/get_order_detail',
                type: 'GET',
                success: function(data) {
                    $('#tableBody').empty();
                    if (data.length < 1) {
                        $('#tableBody').append('<tr><td colspan="5" class="text-center">Tidak ada item</td></tr>');
                    } else {

                        for (var i = 0; i < data.length; i++) {

                            (function(i) {
                                setTimeout(() => {
                                    var row = '<tr class="animate__animated animate__fadeInDown">' +
                                    '<td>' + (i+1) + '</td>' +
                                    '<td>' + data[i].produk.nama + '</td>' +
                                    '<td>' + data[i].jumlah + '</td>' +
                                    '<td>' + 'Rp. '+ moneyFormat(data[i].total_harga) + '</td>' +
                                    '<td>' + '<button id="deleteItemBtn" class="btn btn-danger" onclick="deleteItem(' + data[i].id + ')">Hapus</button>' + '</td>' +
                                    '</tr>';
                                $('#tableBody').append(row);
                                }, i * 200);
                            })(i);
                        }

                        if (data.length > 0) {
                            $('#total').html('Rp. ' + moneyFormat(total(data.map(item => item.total_harga))));
                            $('#prosesCheckoutBtn').attr('disabled', false);
                        } else {
                            $('#total').html('Rp. 0');
                            $('#prosesCheckoutBtn').attr('disabled', true);
                        }
                    }
                },
                error: function(data) {
                    if (data.status == 500) {
                        notyf.error(data.message);
                    } else if (data.status == 401) {
                        setTimeout(() => {
                            notyf.error('Anda tidak memiliki akses');
                            window.location.href = '/login';
                        }, 2500);
                    } else {
                        notyf.error('Terjadi kesalahan');
                    }
                }
            });
        }

        function deleteItem(id) {
            $('#deleteItemBtn').html('please wait...').attr('disabled', true);

            $.ajax({
                url: '/transaksi/' + id + '/delete_item',
                type: 'POST',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#tableBody').empty();
                    $('#prosesCheckoutBtn').attr('disabled', true);
                    setTimeout(() => {
                        $('#deleteItemBtn').html('Hapus').attr('disabled', false);
                        $('#tableBody').append('<tr><td colspan="5" class="text-center">Tidak ada item</td></tr>');
                        $('#total').html('Rp. 0');
                    }, 1000);
                    getOrder('{{ $order->id }}');
                    getOrderDetail('{{ $order->id }}');
                    notyf.success(data.message);

                },
                error: function(data) {
                    if (data.status == 500) {
                        notyf.error(data.error);
                    } else if (data.status == 401) {
                        notyf.error('Anda tidak memiliki akses');
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 2500);
                    } else {
                        notyf.error('Terjadi kesalahan');
                    }
                }
            });
        }

        $('#prosesCheckout').submit(function() {
            $('#prosesCheckoutBtn').html('please wait...').attr('disabled', true);

            setTimeout(() => {
                $('#prosesCheckoutBtn').html('Proses Checkout').attr('disabled', false);
                $('#checkout{{ $order->id }}').modal('hide');
            }, 4000);
        });
    </script>
@endsection
