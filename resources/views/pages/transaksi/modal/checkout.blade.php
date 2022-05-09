<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">List pesanan <strong>{{ $order->nama_customer }}</strong></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Produk</th>
                      <th>Jumlah</th>
                      <th>Total Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="tableBody">
                  </tbody>
                </table>
              </div>
        </div>
        <div class="modal-footer d-flex justify-content-between align-items-center">
            <h4>Total Biaya: <strong><span id="total">0</span></strong></h4>
            <div class="cta d-inline-flex">
                <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                <form id="prosesCheckout" action="{{ route('transaksi.checkout', $order->id) }}" method="POST">
                    @csrf
                    <button id="prosesCheckoutBtn" type="submit" class="btn btn-primary text-white m-0"  disabled>Proses</button>
                </form>
            </div>
        </div>
    </div>
</div>
