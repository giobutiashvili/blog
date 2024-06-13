@extends('admin.layout')
@section('title','კომენტარები')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">კომენტარები</h1>
    
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
                        <th scope="col">გამოქვეყნდეს</th>
                        <th scope="col">ავტორი</th>
                        <th scope="col">კომენტარი</th>
                        <th scope="col">სიახლე</th>
                        <th scope="col">თარიღი</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($items as $key => $item)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>
                                <input type="checkbox" class="confirm-checkbox" data-id="{{ $item->id }}" {{ $item->confirmed ? 'checked' : '' }}>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->comment }}</td>
                            <td>{{ $item->article }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                
                                <form action="{{ route('comments.destroy', $item->id) }}" method="post">
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
    $(document).ready(function(){
        console.log('Document is ready');

        $('.confirm-checkbox').change(function() {
            let id = $(this).data('id');
            console.log('Checkbox changed', id);

            $.ajax({
                url: "/admin/comments/confirm", // მარშრუტის შესაბამისი ბმული
                type: 'post',
                dataType: 'json',
                data: {id: id, _token : '{{ csrf_token() }}'} // კომენტარის id და POST მეთოდისათვის საჭირო თოქენი
            }).done(function (data){
                console.log('AJAX done', data);
                alert(data.message);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX failed', textStatus, errorThrown);
            });
        });

        $('.btn-destroy').on('click', function(){
            console.log('Destroy button clicked');

            if(confirm('დარწმუნებული ხართ ?')) {
                console.log('Form will be submitted');
                $(this).parent('form').submit();         
            } else {
                console.log('Form submission canceled');
            }
        });
    });
</script>
@endsection


                