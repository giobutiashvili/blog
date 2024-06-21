@extends('front.layout')
@section('title', trans('site.contact'))
@section('content')
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div style="background-image:url({{asset('assets/front/img.jpg')}});">
						<div class="row">
							<div class="col-md-9 col-lg-7">
								<div class="contact-wrap w-100 p-md-5 p-4">
									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									<h3 class="mb-4">@lang('site.get_in_touch')</h3>
									<div id="form-message-warning" class="mb-4"></div> 
									<form method="POST" action="{{ route('contact.index') }}" id="contactForm" name="contactForm" class="contactForm">
										@csrf
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="name">@lang('site.name')</label>
													<input type="text" class="form-control" name="name" id="name" placeholder="@lang('site.name')">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label class="label" for="email">@lang('site.email')</label>
													<input type="email" class="form-control" name="email" id="email" placeholder="@lang('site.email')">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="subject">@lang('site.subject')</label>
													<input type="text" class="form-control" name="subject" id="subject" placeholder="@lang('site.subject')">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="#">@lang('site.message')</label>
													<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="@lang('site.message')"></textarea>
												</div>
											</div>
											<div class="col-md-12 mt-3">
												<div class="form-group">
													<button type="submit" class="btn btn-primary">@lang('site.send_message')</button>
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection
