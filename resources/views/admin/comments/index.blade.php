@extends('admin.layout')
@section('title','კომენტარები')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">კომენტარები</h1>
    
    <div class="row">
        
        
        @if(Session::has('message'))
        <div class="alert alert-{{ Session::get('success') ? 'success' : 'danger' }}">
            {{ Session::get('message') }}
        </div>
    @endif
        
        
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><button type="button" class="btn btn-success" id="select-all-confirm">გამოქვეყნდეს  ყველა</button></th>
                             
                        <th scope="col">ავტორი</th>
                        <th scope="col">კომენტარი</th>
                        <th scope="col">თარიღი</th>
                        <th scope="col">   <button type="button" class="btn btn-danger" id="select-all-delete">წაიშალოს ყველა</button></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($comments as $key => $comment)
                        <tr>
                            <th scope="col">{{ $key + 1 }}</th>
                            
                            <td>
                                <form action="{{ route('comments.confirm', $comment->id) }}" method="POST">
                                    @csrf
                                    <input type="checkbox" class="confirm-checkbox" name="confirm" onchange="this.form.submit()"
                                           {{ $comment->confirmed ? 'checked' : '' }}>
                                </form>
                            </td>
                            <td>{{ $comment->user_id }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('დარწმუნებული ხართ?')">წაშლა</button>
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
    $('#select-all-confirm').click(function() {
    $('.confirm-checkbox').prop('checked', true);
    });

    $('#select-all-delete').click(function() {
        $('.delete-checkbox').prop('checked', true);
    });
        
   
</script>
@endsection

                