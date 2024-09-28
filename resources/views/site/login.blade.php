@extends('site.master')

@section('title', 'Login')

@section('content')
@include('site.partials.hero', ['title' => 'Login']) 
  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <form method="POST" action="{{ route('login') }}" class="form-contact contact_form" novalidate="novalidate">
            @csrf
            <div class="form-group">
              <input class="form-control border" name="email" type="email" placeholder="Enter email address" value="{{ old('email') }}">
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="form-group">
              <input class="form-control border" name="password" type="password" placeholder="Enter your password">
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="form-group text-center text-md-right mt-3">
              <a href="{{ route('register') }}" class="mx-3">Signup Insted ? </a>
              <button type="submit" class="button button--active button-contactForm">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->

@endsection
