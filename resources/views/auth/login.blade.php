@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 col-xl-9 mx-auto"></div>
      <div class="col-md-12">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-4 mx-auto">
                
                <div class="text-center mx-auto mb-2">
                    <h1 class="font-weight-light">The Macondo Time</h1>
                </div>
                <form method="POST"  {{ route('login') }}>
                @csrf
                  <div class="form-group mb-1">
                    <label class="text-muted" for="inputEmail"></label>
                    <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Type your email" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
  
                  <div class="form-group mb-4">
                    <label class="text-muted" for="inputPassword"></label>
                    <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Type your password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
  
                  <button class="btn  btn-primary btn-block rounded" type="submit">Log in</button>
                  <div class="text-center">
                    @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}">Forgot password?</a>
                    
                    @endif
                    <a  class="small" href="/register">Sign Up</a>
                    </div>
                    <hr class="my-4"> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
