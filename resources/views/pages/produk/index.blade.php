@extends('layout.app', ['navbar' => true])

@section('title', 'Produk')

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
                <h4 class="card-title">List Produk</h4>
            </div>
            <div class="col text-end">
                <button type="button" data-bs-toggle="modal" data-bs-target="#createProduk" class="btn btn-primary d-inline-flex btn-rounded btn-icon-text text-white">
                    <i class="ti-plus btn-icon-prepend me-0 me-md-1"></i>
                    <span class="d-none d-md-block">Tambah Produk</span>
                </button>
            </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                  Nama
                </th>
                <th>
                  Harga
                </th>
                <th>
                  Ketersediaan
                </th>
                <th class="text-center">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
                @forelse ($produk as $produk)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $produk->nama }}
                    </td>
                    <td>
                        Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                    </td>
                    <td>
                        @if ($produk->ketersediaan == 1)
                            <span class="badge badge-success">Tersedia</span>
                        @else
                            <span class="badge badge-danger">Tidak Tersedia</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button data-bs-toggle="modal" data-bs-target="#editProduk{{ $produk->id }}" type="button" class="btn btn-rounded btn-inverse-primary btn-icon">
                            <i class="ti-pencil"></i>
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#showProduk{{ $produk->id }}" type="button" class="btn btn-rounded btn-inverse-info btn-icon">
                            <i class="ti-search"></i>
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#deleteProduk{{ $produk->id }}" type="button" class="btn btn-rounded btn-inverse-danger btn-icon">
                            <i class="ti-trash"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Edit-->
                <div class="modal fade" id="editProduk{{ $produk->id }}" tabindex="-1" aria-labelledby="#editProduk{{ $produk->id }}Label" aria-hidden="true">
                    @include('pages.produk.modal.edit')
                </div>

                <!-- Modal Show-->
                <div class="modal fade" id="showProduk{{ $produk->id }}" tabindex="-1" aria-labelledby="#showProduk{{ $produk->id }}Label" aria-hidden="true">
                    @include('pages.produk.modal.show')
                </div>

                <!-- Modal Delete-->
                <div class="modal fade" id="deleteProduk{{ $produk->id }}" tabindex="-1" aria-labelledby="#deleteProduk{{ $produk->id }}Label" aria-hidden="true">
                    @include('pages.produk.modal.delete')
                </div>

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
    <div class="modal fade" id="createProduk" tabindex="-1" aria-labelledby="createProdukLabel" aria-hidden="true">
        @include('pages.produk.modal.create')
    </div>

@endsection
