@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 col-xl-9 mx-auto"></div>
        <div class="col-md-12 d-flex align-items-center py-5" >
          <div class="col-md-9 col-lg-4 mx-auto">
             <!-- Background image for card set in CSS! -->
          
           <div class="text-center mx-auto mb-5">
             <h1 class="font-weight-light">The Macondo Time</h1>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
              <div class="form-group mb-4">
                <input type="text" id="inputUserame" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Type your username" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group mb-4">
                <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Type your email" required autocomplete="email">
                
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group mb-4">
                <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Type your password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              
              <div class="form-group mb-4">
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Type your confirm password" name="password_confirmation" required autocomplete="new-password">

              </div>

              <button class="btn btn-primary btn-block rounded" type="submit">Register</button>
              <a class="d-block text-center mt-2 small" href="/login">Log In</a>
              <hr class="my-4">   

            </form>
          </div>
        </div>
    </div>
  </div>
@endsection
