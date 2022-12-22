<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $reportName }} {{ getDateFormat($firstDate).' - '.getDateFormat($lastDate) }}</title>
  <style>
    *{
      font-family: sans-serif;
    }
    table{
      border-collapse: collapse;
      border-spacing:0;
    }
    tr,td,th{
      border: 1px solid #292929;
      padding: 5px;
      border-collapse:collapse;
    }
    .badge {
      border-radius: 4px;
      font-size: 14px;
      font-weight: initial;
      line-height: 1;
      padding: .375rem .5625rem;
      font-weight: 600;
      color: #ffffff;
      font-family: sans-serif !important;
    }
    .bg-success{
      background-color: #00d284 !important;
    }
    .bg-secondary{
      background-color: #a0a0a0 !important;
    }
    .bg-danger{
      background-color: #ce0c0c !important;
    }
    .badge-outline-primary{
      border: 1px solid #C58176;
      color: #C58176 !important;
    }
  </style>
</head>
<body style="border: 2px solid #C58176; padding: 20px;">
  <div style="text-align: center">
    <img src="{{ public_path("img/logo.jpg") }}" width="150px" alt="">
    <h1 style="text-transform: uppercase">{{ $reportName }}</h1>
    <span>Tanggal : <strong>{{ getDateFormat($firstDate).' - '.getDateFormat($lastDate) }}</strong></span>
  </div>
  <div style="margin-top: 15px">

    @if($slug == 'register')
    <table class="table" width="100%">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Nama Customer</th>
          <th>Email</th>
          <th>No Handphone</th>
          <th width="15%">Point</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $d => $value)
        <tr>
          <td style="text-align: center;">{{ $d+=1 }}</td>
          <td>{{ $value->name }}</td>
          <td>{{ $value->email }}</td>
          <td>{{ $value->phone }}</td>
          <td>{{ $value->point }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif

    @if($slug == 'review')
    <table class="table" width="100%">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Nama Produk</th>
          <th width="15%">Total di Review</th>
          <th width="15%">Rata-rata Penilaian</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $d => $value)
        <tr>
          <td style="text-align: center;">{{ $d+=1 }}</td>
          <td>{{ $value->name }}</td>
          <td>{{ $value->count_stars }}</td>
          <td>{{ sprintf("%.1f", $value->average_stars) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif

    @if($slug == 'booking')
    <table class="table datatable" width="100%">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Nama</th>
          <th>Produk</th>
          <th>Tanggal</th>
          <th>Waktu</th>
          <th width="10%">Promo</th>
          <th width="10%">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $d => $value)
        <tr>
          <td style="text-align: center;">{{ $d+=1 }}</td>
          <td>{{ $value->user_name }}</td>
          <td>{{ $value->product_name }}</td>
          <td>{{ $value->schedule_day }} {{ getDateFormat($value->schedule_date) }}</td>
          <td>{{ timeFormat($value->time_start) .'-'. timeFormat($value->time_end) }}</td>
          <td style="text-align: center;">
            @if($value->is_promo == 'yes')
            <div class="badge badge-outline-primary text-primary">Ya</div>
            @endif
          </td>
          <td style="text-align: center;">
            @if($value->book_status == 0)
              <div class="badge bg-danger">Belum Datang</div>
            @elseif($value->book_status == 1)
              <div class="badge bg-success">Selesai</div>
            @elseif($value->book_status == 2)
              <div class="badge bg-secondary">Batal</div>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif

  </div>
</body>
</html>