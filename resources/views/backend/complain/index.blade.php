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
                <th>Nama Produk</th>
                <th width="20%">Gambar</th>
                <th width="15%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $d => $value)
              <tr>
                <td>{{ $d+=1 }}</td>
                <td>{{ $value->name }}</td>
                <td><img src="{{ asset('img/product/'.$value->image) }}" class="img-fluid" alt=""></td>
                <td>
                  <a href="{{ url($role.'/'.$link.'/'.$value->id) }}" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-message-draw"></i></a>
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