<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="showkategori{{ $kategori->id }}Label">Detail Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="kategori">Nama Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Nama Kategori" value="{{ $kategori->kategori }}" disabled>
            </div>
        </div>
        <div class="modal-footer flex-row">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
