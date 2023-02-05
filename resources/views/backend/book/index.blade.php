@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page)
@section('rightHeader')
 
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Produk</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Promo</th>
                <th>Penilaian</th>
                <th width="15%">Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d => $value)
              <tr>
                <td>{{ $d+=1 }}</td>
                <td>{{ $value->user_name }}</td>
                <td>{{ $value->product_name }}</td>
                <td>{{ $value->schedule_day }} {{ getDateFormat($value->schedule_date) }}</td>
                <td>{{ timeFormat($value->time_start) .'-'. timeFormat($value->time_end) }}</td>
                <td>
                  @if($value->is_promo == 'yes')
                    <div class="badge badge-outline-primary text-primary">Ya</div>
                  @endif
                </td>
                <td class="text-center">
                    @if($value->rate_status == '1')
                      <span class="text-danger">Sangat Buruk</span>
                    @elseif($value->rate_status == '2')
                      <span class="text-warning">Buruk</span>
                    @elseif($value->rate_status == '3')
                      <span class="text-secondary">Netral</span>
                    @elseif($value->rate_status == '4')
                      <span class="text-primary">Baik</span>
                    @elseif($value->rate_status == '5')
                      <span class="text-success">Sangat Baik</span>
                    @else
                      -
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
                <td class="text-center">
                  @if($value->payment_status == 0)
                    <button class="btn btn-secondary btn-sm" disabled>Konfirmasi Pembayaran</button>
                  @elseif($value->payment_status == 1)
                    <a href="javascript:void(0)" class="btn btn-success btn-sm confirm-payment"
                      data-id="{{ $value->book_id }}"
                      data-transfer_date="{{ $value->transfer_date }}"
                      data-account_number="{{ $value->account_number }}"
                      data-to_bank="{{ $value->to_bank }}"
                      data-on_behalf_of="{{ $value->on_behalf_of }}"
                      data-total_transfers="{{ $value->total_transfers }}"
                      data-remaining_payment="{{ $value->remaining_payment }}"
                      data-evidence_of_transfer="{{ $value->evidence_of_transfer }}"
                      data-payment_status="{{ $value->payment_status }}"
                    >Konfirmasi Pembayaran</a>
                  @else
                    <a href="{{ url($role.'/'.$link.'/show/'.$value->book_id) }}" class="btn btn-primary btn-sm">Detail</a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('modal')
  <div class="modal fade" id="modalPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('admin/booking/payment') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="" class="control-label">Bank Tujuan</label>
              <input type="text" name="to_bank" class="form-control" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="" class="control-label">Nomor Rekening</label>
              <input type="number" name="account_number" class="form-control" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="" class="control-label">Atas Nama</label>
              <input type="text" name="on_behalf_of" class="form-control" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="" class="control-label">Total Transfer</label>
              <input type="text" name="total_transfers" class="form-control" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="" class="control-label">Sisa Pembayaran</label>
              <input type="text" name="remaining_payment" class="form-control" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="" class="control-label">Bukti Transfer</label>
              <img src="" class="w-50 img-payment" alt="">
            </div>
            <input type="hidden" name="id">
            <div class="form-group py-2 mb-3">
              <label for="" class="control-label">Action</label>
              <select name="get_action" class="form-control" id="" placeholder="Konfirmasi/Tolak">
                <option value="1" selected>Konfirmasi</option>
                <option value="2">Tolak</option>
              </select>
            </div>
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

@push('script')
<script>
  $(document).on('click', '.confirm-payment', function() {
    let id = $(this).data('id')
    let price = $(this).data('price');
    let transfer_date = $(this).data('transfer_date')
    let account_number = $(this).data('account_number')
    let to_bank = $(this).data('to_bank')
    let on_behalf_of = $(this).data('on_behalf_of')
    let total_transfers = $(this).data('total_transfers')
    let remaining_payment = $(this).data('remaining_payment')
    let evidence_of_transfer =$(this).data('evidence_of_transfer')
    let payment_status = $(this).data('payment_status')
    $('#modalPayment .form-control').val('')
    $('#modalPayment input[name=id]').val(id)
    $('#modalPayment input[name=price]').val(price)
    $('#modalPayment input[name=transfer_date]').val(transfer_date)
    $('#modalPayment input[name=account_number]').val(account_number)
    $('#modalPayment input[name=to_bank]').val(to_bank)
    $('#modalPayment input[name=on_behalf_of]').val(on_behalf_of)
    $('#modalPayment input[name=total_transfers]').val('Rp. '+total_transfers)
    $('#modalPayment input[name=remaining_payment]').val('Rp. '+remaining_payment)
    $('#modalPayment .img-payment').attr('src',window.location.origin+'/img/payment/'+evidence_of_transfer)
    $('#modalPayment input[name=payment_status]').val(payment_status)
    $('#modalPayment').modal('show')
  })
</script>
@endpush