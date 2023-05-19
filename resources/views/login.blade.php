@extends('layouts.frontend')

@section('content')

<!-- Login Modal -->

		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body pt-0">
					<div class="col-12">
						<div class="main_title text-center">
							<h2>Sign In</h2>
						</div>
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<div class="form-group mb-3">
								<label for="email">Email</label>
								<input class="form-control" type="email" placeholder="Enter Your Email" id="email"
									name="email">
								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group mb-5">
								<label for="password">Password</label>
								<input class="form-control" type="password" placeholder="Enter Your Password" id="password"
									name="password">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group mb-2">
								<input class="btn_1 full-width" type="submit" value="LogIn" id="submit-contact">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

@endsection
