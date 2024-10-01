@extends('site.master')

@section('title', 'My Blogs')

@section('content')
@include('site.partials.hero', ['title' => 'My Blogs']) 
  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
            @if (session('blog-deleted-success'))
                <div class="alert alert-success">
                    {{ session('blog-deleted-success') }}
                </div>
            @endif
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Blog Title</th>
                    <th scope="col" width="15%">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if(count($blogs) > 0)
                        @foreach ($blogs as $blog)    
                            <tr>
                                <td>
                                    <a href="{{ route('blogs.show', ['blog' => $blog]) }}" target="_blank">{{ $blog->name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('blogs.edit', ['blog' => $blog]) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                    <form action="{{ route('blogs.destroy', ['blog' => $blog]) }}" method="POST" class="d-inline" id="deleteForm">
                                        @csrf
                                        @method('delete')
                                        <a onclick="return confirm('Are you sure? \n Your Blog Will Be Deleted Permanently')"  href="javascript:$('form#deleteForm').submit()" class="btn btn-sm btn-danger mr-2">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
              </table>
              {{ $blogs->render("pagination::bootstrap-5") }}
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->

@endsection
