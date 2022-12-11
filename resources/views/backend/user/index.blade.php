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
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor Handphone</th>
                <th width="5%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d => $value)
              <tr>
                <td>{{ $d+=1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->phone }}</td>
                <td>
                  <a href="{{ url($role.'/'.$link.'/destroy/'.$value->id) }}" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-delete"></i></a>
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