
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createProdukLabel">Tambah Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/produk" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori_id" required>
                        <option value="">Pilih Kategori</option>
                        @forelse ($kategori as $data)
                            <option value="{{ $data->id }}">{{ $data->kategori }}</option>
                        @empty
                            <option value="">Tidak ada kategori</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga Produk</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Produk" required>
                </div>
                <div class="form-group">
                    <label for="ketersediaan">Ketersediaan</label>
                    <select class="form-control" id="ketersediaan" name="ketersediaan" required>
                        <option value="">Pilih Status</option>
                        <option value="1">Tersedia</option>
                        <option value="0">Tidak Tersedia</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer flex-row">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
