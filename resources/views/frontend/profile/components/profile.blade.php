<form action="{{ url('profil/edit-profil/update') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group mb-3">
    <label for="name">Nama</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $data->name }}" placeholder="Nama">
    @error('name')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group mb-3">
    <label for="email">Email</label>
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $data->email }}" placeholder="Email">
    @error('email')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group mb-3">
    <label for="phone">Nomor Handphone</label>
    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $data->phone }}" placeholder="Nomor Handphone">
    @error('phone')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group d-flex justify-content-end">
    <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
  </div>

</form>