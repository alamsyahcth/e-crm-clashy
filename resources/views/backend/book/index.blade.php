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
                <td>
                  @if($value->book_status == 0)
                    <div class="badge bg-danger">Belum Datang</div>
                  @elseif($value->book_status == 1)
                    <div class="badge bg-success">Selesai</div>
                  @elseif($value->book_status == 2)
                    <div class="badge bg-secondary">Batal</div>
                  @endif
                </td>
                <td>
                  <a href="{{ url($role.'/'.$link.'/show/'.$value->book_id) }}" class="btn btn-primary btn-sm">Detail</a>
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