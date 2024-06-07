@extends('admin.layout')
@section('title','სიახლის დამატება')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">მთავარი</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">სიახლის დამატება</li>
    </ol>
    
    @if($errors->any())
        <div class="row">
            <div class="col-md-5 offset-4">
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
        <div class="col-md-6 offset-3">
            <form method="post" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                @csrf
                @foreach($locales as $key => $locale)
                    <div class="form-group row mt-4">
                        <label class="col-sm-2 col-form-label">სათაური ({{ $key }})</label>
                        <div class="col-sm-10">
                            <input type="text" name="translates[{{ $key }}][title]" value="{{ old('translates.'.$key.'.title') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-sm-2 col-form-label">აღწერა ({{ $key }})</label>
                        <div class="col-sm-10">
                            <textarea rows="5" name="translates[{{ $key }}][description]" class="form-control">{{ old('translates.'.$key.'.description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-sm-2 col-form-label">ტექსტი ({{ $key }})</label>
                        <div class="col-sm-10">
                            <textarea rows="10" name="translates[{{ $key }}][text]" class="form-control">{{ old('translates.'.$key.'.text') }}</textarea>
                        </div>
                    </div>
                @endforeach
                <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label">ფოტო</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10 mb-4">
                        <button type="submit" class="btn btn-success">დამატება</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
</div>
@endsection