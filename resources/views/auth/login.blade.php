@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card border-0">
				<div class="card-header border-0 bg-transparent text-center"><h1 class="text-primary">{{ __('Login') }}</h1></div>

				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf

						<div class="row mb-3">
							<label for="email" class="col-md-12 col-form-label">{{ __('Email Address') }}</label>

							<div class="col-md-12">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
									value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Input Your Email">

								@error('email')
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
									name="password" required autocomplete="current-password" placeholder="Input Your Password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-12">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
										? 'checked' : '' }}>

									<label class="form-check-label" for="remember">
										{{ __('Remember Me') }}
									</label>
								</div>
							</div>
						</div>

						<div class="row mb-0">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary w-100">
									{{ __('Login') }}
								</button>
								<div class="py-4">
									<span class="text-center my-4">Atau</span>
								</div>
								@if (Route::has('password.request'))
								<a class="btn btn-outline-primary w-100 mt-2" href="{{ route('register') }}">
									{{ __('Register') }}
								</a>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('style')
.
@endpush