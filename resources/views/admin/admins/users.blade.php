@extends('admin/layout')
@section('title', 'მომხმარებლები')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">მომხმარებლები</h1>
    
    <div class="row">
        <div class="col-md-6 ">
            <h2>მომხმარებლები</h2>
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
                    @foreach($users as $key=>$user)
                        <tr>
                            <th scope="col">{{++$key}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
