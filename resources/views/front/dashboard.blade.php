@extends('front.layout')
@section('title', trans('site.dashboard'))
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
    @if(Session::has('updating_results'))
        <div class="row">
            <div class="col-md-4 offset-4">
                <div class="alert alert-{{ Session::get('updating_results')['class'] }}">
                    {{ Session::get('updating_results')['message'] }}
                </div>
            </div>
        </div>
    @endif  
      
    <div class="row">
        <div class="col-md-4 offset-md-4">
            
            <h2>@lang('site.personal_data')</h2>
            <form method="POST" action="{{ route('update_data') }}">
                 @csrf
                <div class="form-group">
                    <label>@lang('site.name')</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('site.email')</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-3" style="width: 100%;">
                    @lang('site.update')
                </button>
            </form>
            
            <h2>@lang('site.change_password')</h2>
            <form method="POST" action="{{ route('update_password') }}">
                @csrf
                <div class="form-group">
                    <label>@lang('site.old_password')</label>
                    <input type="password" name="old_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('site.new_password')</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('site.re_new_password')</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-3" style="width: 100%;">
                    @lang('site.update')
                </button>
            </form>
            
        </div>
    </div>
</div>
@endsection
                