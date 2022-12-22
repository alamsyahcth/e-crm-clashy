@extends('backend.layouts.app')
@php $link = str_replace(' ', '-', strtolower($page)) @endphp
@section('titlePage', $page.' - '.$product->name)
@section('rightHeader')

@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        @foreach($data as $value)
          <div class="p-3 bg-light rounded mb-3">
            <div class="d-flex align-items-center mb-3 p-3">
              <div class="flex-shrink-0 discussion-avatar mr-3">
                {{ substr($value->name, 0, 1); }}
              </div>
              <div class="ms-3 flex-shrink-1">
                <div class="d-flex justify-content-start align-items-center mb-2">
                  <h6 class="mb-0 text-uppercase me-2 align-items-center mr-2">{{ $value->name }}</h6>
                  <p class="small-2 text-muted mb-0">{{ getDateFormat(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('Y-m-d')) }}</p>
                </div>
                <p class="text-sm mb-0 text-muted">{{ $value->message }}</p>
              </div>
            </div>
            @if($value->status == 0)
            <div class="col-md-12 py-3 border-top">
              <form action="{{ url('admin/diskusi/store/'.$value->id) }}" method="post">
                @csrf
                <div class="form-group">
                  <textarea name="message" id="message" class="form-control" rows="3" placeholder="Masukkan pesan anda" required></textarea>
                </div>
                <div class="form-group d-flex justify-content-end mt-3">
                  <button type="submit" class="btn btn-dark">Kirim</button>
                </div>
              </form>
            </div>
            @endif

            @foreach ($replies as $dataReply)
              @if($value->id == $dataReply->discussion_id)
                <div class="bg-product p-3 border-top">
                  <p class="small-2 mb-2 text-muted"><i>Balasan Oleh Admin</i></p>
                  <p class="text-muted mb-0">{{ $dataReply->disscussion_replies_message }}</p>
                </div>
              @endif
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection

@push('style')
<style>
.discussion-avatar{
  width: 50px;
  height: 50px;
  border-radius: 100px;
  background: #e1d0d0;
  color: #261414;
  display: flex;
  justify-content: center;
  align-items: center;
  text-transform: uppercase;
}
.small-2{
  font-size: 10px;
}
</style>
@endpush