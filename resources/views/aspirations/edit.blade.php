 @extends('templates.base')
 @section('title', 'Edit Aspirasi')
 @section('content')
     <h1 class="my-4">Edit aspirasi</h1>
     <form method="post" class="col-md-4" enctype="multipart/form-data" action="{{ route('aspiration.store') }}">
         @csrf

         <div class="mb-3">
             <label for="title" class="form-label">Judul</label>
             <input type="text" class="form-control" name="title" id="title"
                 value="{{ old('title', $aspirasi->title) }}" required autofocus>
         </div>

         <div class="mb-3">
             <label for="content" class="form-label">Isi Aspirasi</label>
             <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{ old('content_response', $aspirasi->content) }}</textarea>
         </div>

         <div class="mb-3">
             <label for="image" class="form-label">Image</label>
             <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
         </div>

         <button type="submit" onclick="update()" class="btn btn-primary mb-4">Submit</button>
     </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
             let id = location.href.split('/')
             id = id[id.length - 1]

            function update(){
                let title = $("#title").val()
                let content = $("#content").val()
                let image = $("#image").prop('files')[0]

                let fd = new FormData();
                fd.append("title", title);
                fd.append("content", content);
                fd.append("image", image);

                $.ajax({
                    url : "http://127.0.0.1:8000/api/${id}/update",
                    method: "POST",
                    data: fd,
                    processData:false,
                    contentType:false,
                    success: _ =>{
                    window.location.href = "http://127.0.0.1:8000/dashboard"
                    }
                })
            }
        
        })
    </script>


 @endsection
