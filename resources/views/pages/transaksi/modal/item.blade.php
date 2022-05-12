<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $data->nama }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" class="form-control" name="jumlah" id="jumlah{{ $data->id }}" placeholder="Masukkan jumlah pesanan">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="AddButton{{ $data->id }}" onclick="storeItem({{ $data->id }})" class="btn btn-primary text-white">Masukkan ke Keranjang</button>
            </div>
    </div>
    </div>
