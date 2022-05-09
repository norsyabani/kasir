<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editProduk{{ $produk->id }}Label">Edit Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/produk/{{ $produk->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori_id" required>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" @if ($produk->kategori_id == $item->id) selected @endif>{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" value="{{ $produk->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga Produk</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Produk" value="{{ $produk->harga }}" required>
                </div>
                <div class="form-group">
                    <label for="ketersediaan">Ketersediaan</label>
                    <select class="form-control" id="ketersediaan" name="ketersediaan" required>
                        <option value="1" @if ($produk->ketersediaan == 1) selected @endif>Tersedia</option>
                        <option value="0" @if ($produk->ketersediaan == 0) selected @endif>Tidak Tersedia</option>
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
