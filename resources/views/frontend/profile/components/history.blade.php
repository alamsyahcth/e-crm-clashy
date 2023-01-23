
@foreach ($checked as $value)
  @php
    $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->book_created_at);
    $date = $date->addDays('10');
    $dateNow = Carbon\Carbon::now();
  @endphp

  @if($date->format('Y-m-d') == $dateNow->format('Y-m-d'))
    <div class="card bg-warning mb-2">
      <div class="card-body">
        Hai, Hari ini kamu harus retouch lanjutan untuk treatment {{ $value->product_name }}
      </div>
    </div>
  @endif

@endforeach

<div class="table-responsive">
  <table class="table datatable">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th>Produk</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Promo</th>
        <th width="15%">Status</th>
        <th width="20%">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d => $value)
      <tr style="vertical-align: middle;">
        <td>{{ $d+=1 }}</td>
        <td>{{ $value->product_name }}</td>
        <td>{{ $value->schedule_day }} {{ getDateFormat($value->schedule_date) }}</td>
        <td>{{ timeFormat($value->time_start) .'-'. timeFormat($value->time_end) }}</td>
        <td>
          @if($value->is_promo == 'yes')
          <div class="badge badge-outline-primary text-primary">Ya</div>
          @endif
        </td>
        <td>
          @if($value->book_status == 0)
            @if($value->payment_status == 0)
              <div class="badge bg-danger">Belum Bayar</div>
            @elseif($value->payment_status == 1)
              <div class="badge bg-warning">Menunggu Konfirmasi</div>
            @elseif($value->payment_status == 2)
              <div class="badge bg-primary">Sudah Bayar DP/Lunas</div>
            @endif
          @elseif($value->book_status == 1)
          <div class="badge bg-success">Selesai</div>
          @elseif($value->book_status == 2)
          <div class="badge bg-secondary">Batal</div>
          @endif
        </td>
        <td>
          @if($value->book_status == 0)
            <a href="{{ url('profil/history-booking/'.$value->book_id) }}" class="btn btn-primary btn-sm">Batal</a>
            @if($value->payment_status == 0)
              <a href="javascript:void(0)" class="btn btn-secondary btn-sm my-2 confirm-payment" data-id="{{ $value->book_id }}" data-price="{{ $value->product_price }}">Konfirmasi Pembayaran</a>
            @endif
          @else
            <button class="btn btn-primary btn-sm" disabled>Batal</button>
          @endif
          <a href="{{ url('book/print/'.Crypt::encryptString($value->book_id)) }}" class="btn btn-dark btn-sm">Cetak PDF</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@push('script')
<script>
$('.datatable').DataTable();

$(document).on('click', '.confirm-payment', function() {
  let id = $(this).data('id')
  let price = $(this).data('price');
  $('#modalPayment .form-control').val('')
  $('#modalPayment input[name=id]').val(id)
  $('#modalPayment').modal('show')
  handlePayment(price)
})

function handlePayment(price) {
  $('#modalPayment input[name=total_transfers]').on('input keyup', function() {
    let dataTransfer = $(this).val()
    let result = Number(price) - Number(dataTransfer)
    let resultDecision;
    if (result < 0) {
      resultDecision = 0
    } else {
      resultDecision = result
    }

    $('.remaining-transfer').html('Jumlah Sisa: Rp '+resultDecision)
    $('#modalPayment input[name=remaining_payment]').val(resultDecision)
  });
}

</script>
@endpush

@push('modal')
<div class="modal fade" id="modalPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ url('book/payment') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="" class="control-label">Pilih Bank Tujuan</label>
            <select name="to_bank" id="" class="form-control">
              <option value="Bank BCA">Bank BCA</option>
              <option value="Bank Mandiri">Bank Mandiri</option>
              <option value="Bank BNI">Bank BNI</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="" class="control-label">Nomor Rekening</label>
            <input type="number" name="account_number" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="" class="control-label">Atas Nama</label>
            <input type="text" name="on_behalf_of" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="" class="control-label">Total Transfer</label>
            <input type="number" name="total_transfers" class="form-control">
            <span class="remaining-transfer text-success"></span>
          </div>
          <div class="form-group mb-3">
            <label for="" class="control-label">Bukti Transfer</label>
            <input type="file" name="evidence_of_transfer" class="form-control">
            <span class="text-secondary text-10"><i>*bukti transfer dalam bentuk file (jpg/jpeg/png)</i></span>
          </div>
          <input type="hidden" name="id">
          <input type="hidden" name="remaining_payment" class="form-control">
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="Submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endpush