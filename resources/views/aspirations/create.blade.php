 @extends('templates.base')
 @section('title', 'Tambah Aspirasi')
 @section('content')
     @extends('templates.base')

 @section('title', 'Registrasi User')
 @section('content')
     <form method="post" class="col-md-4" enctype="multipart/form-data" action="{{ route('auth.registration') }}">
         <h1 class="my-4">Form aspirasi</h1>

         <div class="mb-3">
             <label for="title" class="form-label">Judul</label>
             <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required
                 autofocus>
         </div>

         <div class="mb-3">
             <label for="content_response" class="form-label">Isi Aspirasi</label>
             <textarea name="content_response" class="form-control" id="content_response" cols="30" rows="10">{{ old('content_response') }}</textarea>
         </div>

         <div class="mb-3">
             <label for="birth_date" class="form-label">Tanggal Lahir</label>
             <input type="date" class="form-control" name="birth_date" id="birth_date" required>
         </div>

         <div class="mb-3">
             <label for="gender" class="form-label">Jenis Kelamin</label>
             <select class="form-select" id="gender" name="gender" required>
                 <option value="0">Perempuan</option>
                 <option value="1">Laki - Laki</option>
             </select>
         </div>

         <div class="mb-3">
             <label for="image" class="form-label">Image</label>
             <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
         </div>

         <button type="submit" class="btn btn-primary">Submit</button>
     </form>
 @endsection

@endsection
