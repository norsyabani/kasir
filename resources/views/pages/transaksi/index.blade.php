@extends('layout.app', ['navbar' => true])

@section('title', 'Transaksi')

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row flex-row">
            <div class="col">
                <h4 class="card-title">List Transaksi</h4>
            </div>
            <div class="col text-end">
                <button type="button" data-bs-toggle="modal" data-bs-target="#createkategori" class="btn btn-primary d-inline-flex btn-rounded btn-icon-text text-white">
                    <i class="ti-plus btn-icon-prepend me-0 me-md-1"></i>
                    <span class="d-none d-md-block">Tambah Pesanan</span>
                </button>
            </div>
        </div>
        <div class="table-responsive mt-4">
          <table class="table table-striped" id="myTable">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                  Nama Pemesan
                </th>
                <th>
                    Total Harga
                </th>
                <th class="text-center">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
                @forelse ($order as $order)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $order->nama_customer }}
                        </td>
                        <td>
                            Rp. {{ number_format($order->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            @if ($order->total_harga == 0)
                                <a href="/transaksi/{{ $order->id }}/detail" class="btn btn-rounded btn-inverse-warning btn-icon py-2 mb-0 me-0">
                                    Checkout Pesanan
                                </a>
                            @else
                                <a href="/transaksi/{{ $order->id }}" class="btn btn-rounded btn-inverse-primary btn-icon py-2 mb-0 me-0">
                                    Lihat Detail Pesanan
                                </a>

                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <h4>Tidak ada data</h4>
                        </td>
                    </tr>
                @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="createkategori" tabindex="-1" aria-labelledby="createkategorilabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createkategorilabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('transaksi.add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_customer">Nama Pemesan</label>
                            <input type="text" class="form-control" id="nama_customer" name="nama_customer" placeholder="Nama Pemesan" required>
                        </div>
                    </div>
                    <div class="modal-footer flex-row">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>

@endsection
