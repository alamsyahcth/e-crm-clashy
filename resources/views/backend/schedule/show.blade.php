@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page)
@section('rightHeader')
  {{-- <a href="{{ url($role.'/'.$link.'/create') }}" class="btn btn-primary btn-sm d-flex align-items-center"><i class="mdi mdi-plus-circle-outline mr-2"></i> Tambah Data</a> --}}
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Tanggal: <span class="text-primary">{{getDateFormat($schedule->date)}}</span></h5>
      </div>
      <div class="card-body">

        <h6 class="text-muted mt-4">Data Jadwal Pegawai</h6>
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
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th width="5%">No</th>
                              <th>Waktu</th>
                              <th>Oleh</th>
                              <th width="15%">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($scheduleDetails as $s => $scheduleDetailsValue)
                              @if($value->id == $scheduleDetailsValue->employee_id)
                              <tr>
                                <td>{{ $s+=1 }}</td>
                                <td>{{ timeFormat($scheduleDetailsValue->time_start) }} - {{ timeFormat($scheduleDetailsValue->time_end) }}</td>
                                <td>
                                  @foreach ($getUser as $users)
                                    @if($users->schedule_detail_id == $scheduleDetailsValue->id)
                                      <a href="{{ url('admin/booking/show/'.$users->book_id) }}" class="btn btn-link">{{ $users->name }}</a>
                                    @endif
                                  @endforeach
                                </td>
                                <td>
                                  @if($scheduleDetailsValue->status == 0)
                                    <div class="badge bg-danger">Kosong</div>
                                  @elseif($scheduleDetailsValue->status == 1)
                                    <div class="badge bg-warning">Terisi</div>
                                  @elseif($scheduleDetailsValue->status == 2)
                                    <div class="badge bg-success">Selesai</div>
                                  @elseif($scheduleDetailsValue->status == 3)
                                    <div class="badge bg-secondary">Dibatalkan</div>
                                  @endif
                                </td>
                              </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('style')
<style>
  .btn-accordion {
    font-size: 18px;
  }
</style>
@endpush