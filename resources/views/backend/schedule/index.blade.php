@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page)
@section('rightHeader')
  <a href="{{ url($role.'/'.$link.'/create') }}" class="btn btn-primary btn-sm d-flex align-items-center"><i class="mdi mdi-plus-circle-outline mr-2"></i> Tambah Data</a>
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
                <th>Hari</th>
                <th>Tanggal</th>
                <th width="15%">Status</th>
                <th width="10%">Action</th>
                <th width="20%">Nonaktifkan Jadwal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d => $value)
              <tr>
                <td>{{ $d+=1 }}</td>
                <td>{{ $value->day }}</td>
                <td>{{ getDateFormat($value->date) }}</td>
                <td>
                  @if($value->status == 0)
                    <div class="badge bg-danger">Tidak Aktif</div>
                  @else
                    <div class="badge bg-success">Aktif</div>
                  @endif
                </td>
                <td>
                  <a href="{{ url($role.'/'.$link.'/show/'.$value->id) }}" class="btn btn-primary btn-sm">Lihat Jadwal</a>
                </td>
                <td>
                  @if($value->status == 0)
                    <button class="btn btn-secondary btn-sm" disabled>Nonaktifkan</button>
                  @else
                    <a href="{{ url($role.'/'.$link.'/deactive/'.$value->id) }}" class="btn btn-danger btn-sm">Nonaktifkan</a>
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