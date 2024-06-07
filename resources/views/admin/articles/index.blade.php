@extends('admin.layout')
@section('title','სიახლეები')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">სიახლეები</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
            <a href="{{ route('articles.create') }}" class="btn btn-sm btn-success">დამატება</a>
        </li>
    </ol>
    <div class="row">
        
        @if(Session::has('result'))
        <div class="col-md-12">
            <div class="alert alert-{{ Session::get('result') ? 'success' : 'danger'}}">
                ოპერაცია {{ Session::get('result') ? 'წარმატებით' : 'წარუმატებლად'}} დასრულდა
            </div>
        </div>
        @endif
        
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">სათაური</th>
                        <th scope="col">ფოტო</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $key => $item)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $item->title }}</td>
                            <td>
                                <img src="{{ $item->image }}" style="width: 50px; height: 50px;">                                
                            </td>
                            <td>
                                <a href="{{ route('articles.edit', $item->id) }}" class="btn btn-sm btn-primary" style="float: left; margin-right: 5px">
                                    <i class="fa fa-edit"></i> 
                                </a>
                                <form action="{{ route('articles.destroy', $item->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <a href="#!" class="btn btn-sm btn-danger btn-destroy">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
    $('.btn-destroy').on('click', function(){
        
        if(confirm('დარწმუნებული ხართ ?'))
        {
            $(this).parent('form').submit();         
        }
        
    });
    
</script>
@endsection

                