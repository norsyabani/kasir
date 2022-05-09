@extends('layout.app', ['navbar' => true])

@section('title', 'Detail Pendapatan')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row flex-row">
            <div class="col">
                <h4 class="card-title">List Pendapatan - {{ $displayDate }}</h4>
            </div>
        </div>
        <div class="table-responsive pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Nama Pemesan
                    </th>
                    <th>
                        Tanggal Transaksi
                    </th>
                    <th>
                        Total Harga
                    </th>
                    <th class="text-center">
                        Aksi
                    </th>
                </tr>
              </thead>
              <tbody id="tBody">
                  @forelse ($data as $d)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $d->nama_customer }}
                        </td>
                        <td>
                            {{ $d->created_at }}
                        </td>
                        <td>
                            Rp. {{ number_format($d->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <a href="/transaksi/{{ $d->id }}" class="btn btn-rounded btn-inverse-primary btn-icon">
                                Lihat Detail Pesanan
                            </a>
                        </td>
                    </tr>
                  @empty

                  @endforelse
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
  <div class="text-center">
    <a href="/pendapatan" class="btn btn-primary btn-icon-text text-white">
        <i class="ti-arrow-left btn-icon-prepend"></i>
        Kembali
    </a>
</div>
@endsection
