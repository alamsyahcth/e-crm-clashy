<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <style>
    * {
      font-family: sans-serif;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    tr,
    td,
    th {
      border: 0px solid #29292900;
      padding: 10px 0px;
      border-collapse: collapse;
      font-size: 12px;
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

    .bg-success {
      background-color: #00d284 !important;
    }

    .bg-secondary {
      background-color: #a0a0a0 !important;
    }

    .bg-danger {
      background-color: #ce0c0c !important;
    }

    .badge-outline-primary {
      border: 1px solid #C58176;
      color: #C58176 !important;
    }
    .d-flex{
      display: flex;
      margin-bottom: 10px;
      font-size: 10px;
    }
    .justify-content-between{
      justify-content: space-between;
    }
  </style>
</head>

<body style="border: 2px solid #C58176; padding: 10px;">
  <div style="text-align: center">
    <img src="{{ public_path("img/logo.jpg") }}" width="150px" alt="">
    <h1 style="text-transform: uppercase">Bukti Booking</h1>
    <span>Kode Booking : <strong>{{ $data->invoice }}</strong></span>
  </div>
  <div style="margin-top: 30px;">
    <table width="100%">
      <tr style="border-top: 1px solid #e0e0e0">
        <td colspan="4" style="padding-top: 10px !important; padding-bottom: 0px !important;">
          <h4>Data Booking</h4>
        </td>
      </tr>
      <tr style="margin-bottom: 30px;">
        <td width="25%">Hari dan Tanggal</td>
        <td width="35%">: <strong>{{ $data->schedule_day.' '.getDateFormat($data->schedule_date) }}</strong></td>
        <td width="25%">Waktu</td>
        <td width="35%">: <strong>{{ timeFormat($data->time_start) .'-'. timeFormat($data->time_end) }}</strong></td>
      </tr>
      <tr style="border-bottom: 1px solid #e0e0e0;">
        <td width="25%" style="padding-bottom: 30px;">Nama Therapist</td>
        <td colspan="3" style="padding-bottom: 30px;">: <strong>{{ $data->employee_name.' ('.$data->employee_phone.')' }}</strong></td>
      </tr>
      <tr>
        <td colspan="4" style="padding-top: 10px !important; padding-bottom: 0px !important;"><h4>Data Customer</h4></td>
      </tr>
      <tr>
        <td width="25%">Nama Customer</td>
        <td width="35%">: <strong>{{ $data->user_name }}</strong></td>
        <td width="25%">Email</td>
        <td width="35%">: <strong>{{ $data->user_email }}</strong></td>
      </tr>
      <tr>
        <td width="25%" style="padding-bottom: 30px;">Nomor Handphone</td>
        <td width="35%" style="padding-bottom: 30px;">: <strong>{{ $data->user_phone }}</strong></td>
        <td width="25%" style="padding-bottom: 30px;">Promo</td>
        <td width="35%" style="padding-bottom: 30px;">: <strong>{{ $data->is_promo }}</strong></td>
      </tr>
      <tr style="border-top: 1px solid #e0e0e0">
        <td colspan="4" style="padding-top: 10px !important; padding-bottom: 0px !important;">
          <h4>Data Customer</h4>
        </td>
      </tr>
      <tr>
        <td width="25%">Nama Produk</td>
        <td width="35%">: <strong>{{ $data->product_name }}</strong></td>
        <td width="25%">Harga</td>
        <td width="35%">: <strong>{{ currency($data->product_price) }}</strong></td>
      </tr>
    </table>
  </div>
</body>

</html>