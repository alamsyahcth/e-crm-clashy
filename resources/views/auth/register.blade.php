@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card border-0">
				<div class="card-header border-0 bg-transparent text-center">
					<h1 class="text-primary">{{ __('Register') }}</h1>
				</div>

				<div class="card-body">
					<form method="POST" action="{{ route('register') }}">
						@csrf

						<div class="row mb-3">
							<label for="name" class="col-md-12 col-form-label">{{ __('Name') }}</label>

							<div class="col-md-12">
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
									value="{{ old('name') }}" required autocomplete="name" autofocus>

								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="email" class="col-md-12 col-form-label">{{ __('Email Address') }}</label>

							<div class="col-md-12">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
									value="{{ old('email') }}" required autocomplete="email">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="phone" class="col-md-12 col-form-label">{{ __('Nomor Handphone') }}</label>
						
							<div class="col-md-12">
								<input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
									value="{{ old('phone') }}" required autocomplete="phone">
						
								@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

							<div class="col-md-12">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
									name="password" required autocomplete="new-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirm Password')
								}}</label>

							<div class="col-md-12">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
									autocomplete="new-password">
							</div>
						</div>

						<div class="row mb-0 mt-5">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary w-100">
									{{ __('Register') }}
								</button>
								<div class="py-4">
									<span class="text-center my-4">Atau</span>
								</div>
								<a class="btn btn-outline-primary w-100" href="{{ route('login') }}">
									{{ __('Login') }}
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection