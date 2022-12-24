 @extends('templates.base')
 @section('title', 'Tambah Aspirasi')
 @section('content')
     <h1 class="my-4">Form aspirasi</h1>
     <form method="post" class="col-md-4" enctype="multipart/form-data" action="{{ route('aspiration.store') }}">
         @csrf

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
 @endsection

@endsection
