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
        <form action="{{ url($role.'/'.$link.'/store') }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="form-group mb-3">
            <label for="date">Pilih Tanggal</label>
            <input type="text" class="form-control datepicker @error('date') is-invalid @enderror" name="date" id="date" value="{{ old('date') }}" placeholder="Pilih Tanggal" autocomplete="off">
            @error('date')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <h6 class="text-muted mt-4">Atur Jadwal Pegawai</h6>
          <div class="accordion" id="accordionExample">
            @foreach($employee as $e => $value)
              <div class="card">
                <div class="card-header" id="heading-{{ $e }}">
                  <h2 class="mb-0">
                    <button class="btn btn-accordion btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-{{ $e }}"
                      aria-expanded="true" aria-controls="collapse-{{ $e }}">
                      <i class="mdi mdi-account-box-outline"></i> {{ $value->name }}
                    </button>
                  </h2>
                </div>
              
                <div id="collapse-{{ $e }}" class="collapse @if($e == 0) show @endif" aria-labelledby="heading-{{ $e }}" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <input type="hidden" name="dataUser[]" value="{{ $value->id }}">
                        @for($i=7; $i<17; $i++)
                        <div class="d-flex align-items-center mb-2">
                          <label class="switch" for="checkbox-{{ $e }}-{{ $i }}">
                            <input type="checkbox" value="{{ $i }}" id="checkbox-{{ $e }}-{{ $i }}" name="time-{{ $e }}[]" checked />
                            <div class="slider round"></div>
                          </label>
                          <label for="" class="mb-0 ml-3">{{ $i }}.00 - {{ $i+1 }}.00</label>
                        </div>
                        @endfor
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <div class="form-group d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('style')
<style>
  .btn-accordion{
    font-size: 18px;
  }
  .switch {
    display: inline-block;
    height: 34px;
    position: relative;
    width: 60px;
  }

  .switch input {
    display:none;
  }

  .slider {
    background-color: #ccc;
    bottom: 0;
    cursor: pointer;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    transition: .4s;
  }

  .slider:before {
    background-color: #fff;
    bottom: 4px;
    content: "";
    height: 26px;
    left: 4px;
    position: absolute;
    transition: .4s;
    width: 26px;
  }

  input:checked + .slider {
    background-color: #C58176;
  }

  input:checked + .slider:before {
    transform: translateX(26px);
  }

  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
@endpush

@push('script')
<script>

</script>
@endpush