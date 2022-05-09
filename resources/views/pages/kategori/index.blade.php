@extends('layout.app', ['navbar' => true])

@section('title', 'Kategori')

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
                <h4 class="card-title">List Kategori</h4>
            </div>
            <div class="col text-end">
                <button type="button" data-bs-toggle="modal" data-bs-target="#createkategori" class="btn btn-primary d-inline-flex btn-rounded btn-icon-text text-white">
                    <i class="ti-plus btn-icon-prepend me-0 me-md-1"></i>
                    <span class="d-none d-md-block">Tambah Kategori</span>
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
                  Kategori
                </th>
                <th class="text-center">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $kategori)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $kategori->kategori }}
                    </td>
                    <td class="text-center">
                        <button data-bs-toggle="modal" data-bs-target="#editkategori{{ $kategori->id }}" type="button" class="btn btn-rounded btn-inverse-primary btn-icon">
                            <i class="ti-pencil"></i>
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#showkategori{{ $kategori->id }}" type="button" class="btn btn-rounded btn-inverse-info btn-icon">
                            <i class="ti-search"></i>
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#deletekategori{{ $kategori->id }}" type="button" class="btn btn-rounded btn-inverse-danger btn-icon">
                            <i class="ti-trash"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal Edit-->
                <div class="modal fade" id="editkategori{{ $kategori->id }}" tabindex="-1" aria-labelledby="#editkategori{{ $kategori->id }}Label" aria-hidden="true">
                    @include('pages.kategori.modal.edit')
                </div>

                <!-- Modal Show-->
                <div class="modal fade" id="showkategori{{ $kategori->id }}" tabindex="-1" aria-labelledby="#showkategori{{ $kategori->id }}Label" aria-hidden="true">
                    @include('pages.kategori.modal.show')
                </div>

                <!-- Modal Delete-->
                <div class="modal fade" id="deletekategori{{ $kategori->id }}" tabindex="-1" aria-labelledby="#deletekategori{{ $kategori->id }}Label" aria-hidden="true">
                    @include('pages.kategori.modal.delete')
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
    <div class="modal fade" id="createkategori" tabindex="-1" aria-labelledby="createkategorilabel" aria-hidden="true">
        @include('pages.kategori.modal.create')
    </div>

@endsection
