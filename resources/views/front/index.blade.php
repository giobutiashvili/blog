@extends('front.layout')
@section('title', trans('menu.index'))
@section('content')
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            @forelse($articles as $article)
                <div class="post-preview">
                        <div class="d-flex">
                            <div style="margin-right: 15px">
                                <img  style="width: 100px; height:100px" src="{{$article->image}}" alt="{{asset('assets/front/No.png')}}">
                            </div>
                            <div>
                                 <a href="{{ route('article', $article->id) }}">
                                    <h2 class="card-title">{{ $article->title }}</h2>
                                    <h4 class="card-subtitle mb-2 text-muted">{{ $article->description }}</h4>
                                </a>
                            </div>
                        </div>
                    
                    <p class="post-meta">
                        @lang('site.author')
                         @if($users)
                         {{$users->name}}
                         @else
                            ""
                         @endif 
                       
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