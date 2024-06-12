@extends('front.layout')
@section('title', $article->title)
@section('content')
<article class="mb-4">
    <div class="container px-4 px-lg-4">
        <div class="justify-content-center row gx-4 gx-lg-5">
            <div class="col-md-10 col-md-8 col-xl-7">
                {!! $article->text !!}
            </div>
            <div class="col-md-10 col-md-8 col-xl-7">
                {!! $article->description !!}
            </div>
        </div>
    </div>
</article>
@endsection