@extends('front.layout')
@section('title', trans('site.register'))
@section('content')
<div class="container">
    
    @if($errors->any())
        <div class="row">
            <div class="col-md-4 offset-4">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label>@lang('site.name')</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('site.email')</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('site.password')</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('site.re_password')</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-3" style="width: 100%;">
                    @lang('site.register')
                </button>
            </form>
        </div>
    </div>
</div>
@endsection