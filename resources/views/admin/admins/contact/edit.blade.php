  
@extends('admin.layout')
@section('title','საკონტაქტო ინფორმაციის რედაქტირება')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">მთავარი</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
            <a href="" class="btn btn-sm btn-success">
                {{ Cache::has('contacts') ? 'ქეშის გასუფთავება' : 'ქეშირება' }}
            </a>
        </li>
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
    @if(Session::has('result'))
        <div class="col-md-12">
            <div class="alert alert-{{ Session::get('result') ? 'success' : 'danger'}}">
                ოპერაცია {{ Session::get('result') ? 'წარმატებით' : 'წარუმატებლად'}} დასრულდა
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 offser-3">
            <form action="{{ route('contacts.update', $item->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ტელეფონი</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="phone" value="{{ $item->phone }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ელ_ფოსტა</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="email" value="{{ $item->email }}">
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">განახლება</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    <div class="container mt-5">
        <h1>Contact Messages</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td >
                            <form class="d-flex form-control justify-content-between align-items-center"
                             action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                           <div>
                             {{ $contact->id }}
                            </div>
                            <button type="submit" class="btn btn-danger  ml-3" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</button>
                        </form>
                        </td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at }}</td>
                        <td>{{ $contact->updated_at }}</td>
                    </tr>
                    <td>
                  
                        
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
    
@endsection