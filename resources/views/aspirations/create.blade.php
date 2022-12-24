 @extends('templates.base')
 @section('title', 'Tambah Aspirasi')
 @section('content')
     <h1 class="my-4">Form aspirasi</h1>
     <form method="post" class="col-md-4" enctype="multipart/form-data" action="#" id="aspiration_form">
         @csrf
         <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">

         <div class="mb-3">
             <label for="title" class="form-label">Judul</label>
             <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required
                 autofocus>
         </div>

         <div class="mb-3">
             <label for="content" class="form-label">Isi Aspirasi</label>
             <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{ old('content_response') }}</textarea>
         </div>

         <div class="mb-3">
             <label for="image" class="form-label">Image</label>
             <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
         </div>

         <button type="submit" class="btn btn-primary mb-4">Submit</button>
     </form>
     <script>
         document.addEventListener('DOMContentLoaded', () => {
             $("#aspiration_form").on('submit', (e) => {
                 e.preventDefault();
                 const title = $('#title').val();
                 const content = $('#content').val()
                 const user_id = $('#user_id').val()
                 const image = $("#image").prop('files')[0]
                 const fd = new FormData();
                 fd.append('title', title);
                 fd.append('image', image);
                 fd.append('user_id', user_id);
                 fd.append('content', content);
                 fetch('http://127.0.0.1:8000/api/aspiration/create', {
                         method: 'POST',
                         body: fd
                     })
                     .then(res => res.json())
                     .then(res => {
                         if (!res.status) {
                             alert(res.message);
                             return;
                         }
                         alert(res.message)
                         location.href = "http://127.0.0.1:8000/aspiration/create"
                     })

             })

         })
     </script>
 @endsection
