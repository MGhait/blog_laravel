@extends('site.master')

@section('title', 'Create Blog')

@section('content')
@include('site.partials.hero', ['title' => 'Add New Blog']) 
  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
            {{-- we will uplode images so we need to make add the enctype attr to the form with the value multipart/form-data --}}
            @if (session('blog-created-success'))
                <div class="alert alert-success">
                    {{ session('blog-created-success') }}
                </div>
            @endif
          <form action="{{ route('blogs.store') }}" class="form-contact contact_form" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <input class="form-control border" name="name" id="name" type="text" placeholder="Enter Your Blog Title" value="{{ old('name') }}">
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            
            <div class="form-group">
                <input class="form-control border" name="image" type="file">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

            <div class="form-group">
                <select class="form-control border" name="category_id"  value="{{ old('category_id') }}">
                    <option value="">Select Category</option>
                    @if(count($categories) > 0)
                    @foreach ($categories as $category )
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="form-group">
                <textarea class="w-100 border" rows="5" name="description" placeholder="Enter Your Blog Description" >
                    {{ old('description') }}
                </textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
                

            <div class="form-group text-center text-md-right mt-3">
              <button type="submit" class="button button--active button-contactForm">submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->

@endsection
