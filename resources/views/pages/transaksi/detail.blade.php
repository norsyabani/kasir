@extends('layout.app', ['navbar' => false])

@section('title', 'Detail Transaksi')

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
        <div class="row">
            <div class="col d-flex d-inline-flex">
                <h4 class="card-title">Detail Transaksi {{ $order->nama_customer }}</h4>
                <span class="badge text-success">{{ $order->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Produk</th>
                  <th>Jumlah</th>
                  <th>Total Harga</th>
                </tr>
              </thead>
              <tbody id="tableBody">
                    @forelse ($orderDetail as $order)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $order->produk->nama }}
                        </td>
                        <td>
                            {{ $order->jumlah }}
                        </td>
                        <td>
                            Rp. {{ number_format($order->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
              </tbody>
            </table>
          </div>
      </div>
    </div>
</div>
<div class="text-center">
    <a href="{{ URL::previous() }}" class="btn btn-primary btn-icon-text text-white">
        <i class="ti-arrow-left btn-icon-prepend"></i>
        Kembali
    </a>
</div>
@endsection
