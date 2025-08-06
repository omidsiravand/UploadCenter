<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background-color:rgb(17,27,54)">
    <div class="container-fluid">
    @if(session('create'))
        <div class="alert alert-success text-center">
            {{ session('create') }}
        </div>
    @endif
    
    @if(session('delete'))
        <div class="alert alert-danger text-center">
            {{ session('delete') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-white">گالری عکس‌ها</h2>
            <table class="table table-bordered table-dark table-hover">
                <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>لینک مستقیم</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploads as $upload)
                    <tr>
                        <td>
                            <img src="{{ asset('images/upload/'.$upload->image) }}" width="100">
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="link-{{$upload->id}}" 
                                       value="{{ asset('images/upload/'.$upload->image) }}" readonly>
                                <button class="btn btn-outline-secondary" onclick="copyLink('link-{{ $upload->id }}')">
                                    کپی لینک
                                </button>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('UploadCenter.destroy', $upload->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
 <div class="form-group text-center mt-4">
                       <a href="{{route('UploadCenter.create')}}" class="btn btn-info ">ایجاد عکس</a>
                     </div>
            {{ $uploads->links() }}
        </div>
    </div>
</div>
<script src="{{asset('jquery-3.7.1.min.js')}}"></script>
<script>
function copyLink(id) {
    var copyText = document.getElementById(id);
    copyText.select();
    document.execCommand("copy");
    alert("لینک با موفقیت کپی شد: " + copyText.value);
}
</script>
 <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 1000);
        });
    </script>
</body>
</html>