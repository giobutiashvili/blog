@extends('admin/layout')
@section('title', 'ადმინისტრატორები')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">ადმინისტრატორის</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
        <a class="btn btn-sm btn-success" href="{{route('admins.create')}}">დამატება</a></li>
    </ol>
    <div class="row">
        @if(Session::has('result'))
            <div class="col-md-12">
                <div class="alert alert-{{Session::get('result') ? 'success' : 'danger' }}">
                    ოპერაცია {{Session::get('result') ? 'წარმატებით' : 'წარუმატებლად'}} დასრულდა
                </div>
            </div>
        @endif
        
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">სახელი</th>
                        <th scope="col">ელ_ფოსტა</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $key=>$item)
                        <tr>
                            <th scope="col">{{++$key}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" 
                                    style="float: left; margin: right 5px;"
                                    href="{{route('admins.edit', $item->id) }}">
                                <i class="fa fa-edit"></i>
                                 </a>
                            
                                @if($item->id !=1)
                                    <form action="{{route('admins.destroy', $item->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                        <a href="#!" class="btn btn-sm btn-danger btn-destroy">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </form>
                                @endif
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
 $(document).ready(function() {
    $('.btn-destroy').on('click', function() {
        if (confirm('დარწმუნებული ხართ ? ')) {
            $(this).closest('form').submit();
        }
    });
});
</script>
@endsection