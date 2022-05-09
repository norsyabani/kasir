<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editkategori{{ $kategori->id }}Label">Edit kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/kategori/{{ $kategori->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="kategori">Nama kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Nama kategori" value="{{ $kategori->kategori }}" required>
                </div>
            </div>
            <div class="modal-footer flex-row">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-white">Simpan</button>
            </div>
        </form>
    </div>
</div>
