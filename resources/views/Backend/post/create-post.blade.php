@extends('layouts.backendApp')

@section('content')
    <section>
        <div class="container py-5">
            <div class="row justify-content-between">
                <div class="col-12">
                    @if (Session::has('success-message'))
                        <div class=" shadow">
                            <p class="text-center text-success font-weight-bold p-2">{{ Session::get('success-message') }}</p>
                        </div>

                    @endif


                    <h5 class="text-center pb-5">{{ empty($post) ? "CREATE POST" : "EDIT POST" }}</h5>
                    <form action="{{ empty($post) ? Route('post.store') : Route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                        @if (empty($post))
                            @method('POST')
                        @else
                            @method('PUT')
                        @endif

                        @csrf

                        <div class="form-group">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ !empty($post) ? $post->title : "" }}">
                        </div>
                        <div class="form-group">
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Body Content">{{ !empty($post) ? $post->body : "" }}</textarea>
                        </div>
                        <div class="form-group">
                            @if (!empty($post))
                            <img src="{{ asset('storage/'.$post->image) }}" class="py-2" alt="" srcset="" style="width:100px"> Old Image
                            @endif
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <input type="submit" value="{{ empty($post) ? "CREATE POST" : "UPDATE POST" }}" class="btn btn-primary btn-block">
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
