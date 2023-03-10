@extends('templates.base')

@section('title', 'Login User')
@section('content')
    <form method="post" class="col-md-4" action="{{ route('auth.authenticate') }}">
      @csrf
      @if(session()->has('message'))
        <p>{{ session()->get('message') }}</p>
      @endif
      @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
      @endforeach
        <h1 class="my-4">Login User</h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('auth.register') }}" class="btn btn-success">Register</a>

    </form>
@endsection