@extends('front.layout')
@section('title', trans('menu.index'))
@section('content')
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            @forelse($articles as $article)
                <div class="post-preview">
                    <a href="{{ route('article', $article->id) }}">
                        <h2 class="post-title">{{ $article->title }}</h2>
                        <h3 class="post-subtitle">{{ $article->description }}</h3>
                    </a>
                    <p class="post-meta">
                        @lang('site.author') 
                        <a href="{{ route('article', $article->id) }}">
                            @if($users)
                                {{ $users->name }}
                             @endif
                            
                        </a>
                        @lang('site.date') : {{ $article->created_at }}
                    </p>
                </div>
                @if(!$loop->last)
                    <!-- დიზაინში არსებული გამყოფი ხაზი აღარაა საჭირო ბოლო სიახლის შემდეგ -->
                    <hr class="my-4" />
                @endif  
            @empty
                <div class="alert alert-danger">@lang('site.no_data')</div>
            @endforelse           
        </div>
    </div>
</div>
@endsection