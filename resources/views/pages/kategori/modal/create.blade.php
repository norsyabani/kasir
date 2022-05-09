
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createkategorilabel">Tambah Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/kategori" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="kategori">Nama Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Nama Kategori" required>
                </div>
            </div>
            <div class="modal-footer flex-row">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
