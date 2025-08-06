<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>آپلود تصویر</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
  
    <div class="container">
          @if (session('create'))
    <p class="alert alert-success text-center alert">{{session('create')}}</p>
    @endif
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="upload-card">
                    <h2 class="title">آپلود تصویر</h2>
                    <form action="{{route('UploadCenter.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="file-upload-wrapper">
                            <label for="image" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                <span class="file-upload-text">برای آپلود تصویر کلیک کنید یا آن را اینجا رها کنید</span>
                                <input type="file" name="image" id="image" class="file-upload-input">
                            </label>
                            @error('image')
                                <p class="error-message">{{$message}}</p>
                            @enderror
                            <div class="preview-container" id="previewContainer">
                                <img id="previewImage" class="preview-image" src="#" alt="پیش نمایش تصویر">
                            </div>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-upload w-100 mt-4">
                            <i class="fas fa-upload me-2"></i> آپلود تصویر
                        </button>
                         <div class="form-group text-center mt-4">
                       <a href="{{route('UploadCenter.index')}}" class="btn btn-info form-control">نمایش عکس</a>
                     </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('jquery-3.7.1.min.js')}}"></script>
    <script>
    $(document).ready(function() {
      
        setTimeout(function() {
            $('.alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 2000); 
        
        $('#image').change(function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                    $('#previewContainer').fadeIn();
                }
                reader.readAsDataURL(file);
            }
        });
        
        const fileUploadLabel = $('.file-upload-label');
        
        fileUploadLabel.on('dragover', function(e) {
            e.preventDefault();
            $(this).addClass('dragover');
        });
        
        fileUploadLabel.on('dragleave', function(e) {
            e.preventDefault();
            $(this).removeClass('dragover');
        });
        
        fileUploadLabel.on('drop', function(e) {
            e.preventDefault();
            $(this).removeClass('dragover');
            const file = e.originalEvent.dataTransfer.files[0];
            if (file) {
                $('#image')[0].files = e.originalEvent.dataTransfer.files;
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result);
                    $('#previewContainer').fadeIn();
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>

</body>
</html>