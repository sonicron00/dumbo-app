@extends('master')

@section('content')
    <div class="row">

        <!-- Post Content Column -->
        <form class="col-lg-8" action="/doCreate" method="GET" role="create">
        {{ csrf_field() }}
            <div class="input-group">
            <!-- Title -->
            <h1 class="mt-4">
                <input type="text" class="form-control" placeholder="Enter post title..." name="post-title">
            </h1>

            <!-- Author -->
            <p class="lead">
                by
                <a href="#">admin</a>
            </p>

            <hr>

            <!-- Post Content -->
                <input type="text" class="form-control" placeholder="Write post here..." name="post-content">
            <hr>

                <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Create Post</button>
          </span>
            </div>
        </form>


        @include('widgets.sidebar')

    </div>
@endsection