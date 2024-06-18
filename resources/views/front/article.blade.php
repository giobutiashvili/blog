@extends('front.layout')
@section('title', $article->title)
@section('content')
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            
            <!-- სიახლის ტექსტი --> 
            <div class="col-md-10 col-lg-8 col-xl-7">
                {!! $article->text !!}
            </div>
            
            <!-- კომენტარების არე --> 
            <div class="col-md-10 col-lg-8 col-xl-7 mt-3">
                
                
                <!-- კომენტარების მთვლელი -->
                <h4 class="mt-5">@lang('site.comments') ({{ $article->comments->where('confirmed')->count() }})</h4>
                <hr class="mt-3">
                
                <!-- თუ გავილი გვაქვს ავტორიზაცია გამოვიტანოთ დასამატებელი ფორმა -->
                @auth
                    <form method="POST" action="{{ route('comment',$article->id) }}">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>                            
                        @endif  
                        @if(Session::has('inserting_results'))
                            <div class="alert alert-{{ Session::get('inserting_results')['class'] }}">
                                {{ Session::get('inserting_results')['message'] }}
                            </div>
                        @endif  
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="5" placeholder="@lang('site.comment')"></textarea>
                        </div>
                        <div class="form-group mt-1">
                            <input type="submit" value="@lang('site.add')" class="form-control btn btn-success">
                        </div>
                    </form>
                @else
                    <div class="alert alert-warning text-center">
                        <small>@lang('site.login_to_comment')</small>
                    </div>
                @endauth
                
                <!-- კომენტარები -->
                <hr class="mt-3">
                @forelse($article->comments->where('confirmed',1)->reverse() as $comment)
                    <div class="alert alert-primary">
                        
                        <h4>{{ $comment->comment }}</h4>
                        <span> @lang('site.author') : {{ $comment->user->email }}</span>
                        <p>@lang('site.date') : {{ $comment->created_at }}</p>
                    </div>
                @empty
                    <div class="alert alert-warning text-center">
                        <small>@lang('site.no_comment')</small>
                    </div>
                @endforelse
                
                
            </div>
            
        </div>
    </div>
</article>
@endsection
                