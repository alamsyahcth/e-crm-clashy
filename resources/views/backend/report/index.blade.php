@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page.' '.$data)
@section('rightHeader')

@endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <form action="{{ url($role.'/'.$link.'/pdf/'.$data) }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="first_date">Pilih Tanggal Awal</label>
                <input type="text" class="form-control datepickerAll @error('first_date') is-invalid @enderror" name="first_date" id="first_date"
                  value="{{ old('first_date') }}" placeholder="Pilih Tanggal Awal">
                @error('first_date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="last_date">Pilih Tanggal Awal</label>
                <input type="text" class="form-control datepickerAll @error('last_date') is-invalid @enderror" name="last_date" id="last_date"
                  value="{{ old('last_date') }}" placeholder="Pilih Tanggal Akhir">
                @error('last_date')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group d-flex justify-content-end">
            <button type="submit" target="_blank" class="btn btn-primary btn-lg">Cetak Laporan</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection