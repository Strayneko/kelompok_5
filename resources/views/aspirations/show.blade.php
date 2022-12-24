 @extends('templates.base')
 @section('title', 'Detail Aspirasi')
 @section('content')
     <h1 class="my-4">Detail aspirasi</h1>
     <form method="post" class="col-md-4">
         @csrf

         <div class="mb-3">
             <label for="sender_name" class="form-label">Nama Pengirim</label>
             <input type="text" class="form-control" id="sender_name" disabled required autofocus>
         </div>

         <div class="mb-3">
             <label for="title" class="form-label">Judul</label>
             <input type="text" class="form-control" name="title" id="title" disabled required autofocus>
         </div>

         <div class="mb-3">
             <label for="content" class="form-label">Isi Aspirasi</label>
             <textarea name="content" class="form-control" id="content" cols="30" disabled rows="10"></textarea>
         </div>

         <div class="mb-3">
             <label for="image" class="form-label">Lampiran Gambar</label>
             <img src="..." id="image" class="img-thumbnail" alt="...">
         </div>

         <button type="submit" class="btn btn-primary mb-4">Submit</button>
         <a href="{{ route('aspiration.index') }}" class="btn btn-warning mb-4">Kembali</a>
     </form>

     <script>
         document.addEventListener('DOMContentLoaded', () => {
             let id = location.href.split('/')
             id = id[id.length - 1]
             fetch(`http://127.0.0.1:8000/api/aspiration/${id}`)
                 .then(res => res.json())
                 .then(res => {
                     // check request status
                     if (!res.status) {
                         alert(res.message)
                         return;
                     }
                     //  set form value if request status true
                     $('#sender_name').val(res.data.user_id)
                     $('#title').val(res.data.title)
                     $("#content").text(res.data.content)
                     $("#image").attr('src', res.data.image)
                 });

         })
     </script>
 @endsection
