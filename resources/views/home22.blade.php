@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($posts as $post)
        <div class="row justify-content-center py-3">
            <div class="col-sm-11 col-md-10 col-lg-9 py-2 shadow">
                <h5 class="text-seconday">{{ $post->title }}</h5>
                <span>{{ $post->created_at }}</span>
                <p class="text-secondary">{{ !empty($post->user->name) ? $post->user->name: "UnKnown Author" }}</p>
                <div class="post-img">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="" srcset="" style="width:100%">
                </div>
                <div class="text-body pt-3">
                    <p class="text-justify">
                        {{ $post->body }}
                    </p>
                </div>
                <div class="float-left">
                    <form action="{{ Route('post.destroy',$post->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#post-delete-modal">
                            Launch demo modal
                          </button>
                    </form>
                </div>
                <div class="float-right">
                    <a href="{{ Route('post.edit',$post->id) }}" class="btn btn-info">Edit</a>
                </div>
            </div>
        </div>
    @endforeach
</div>



<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#post-delete-modal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="post-delete-modal" tabindex="-1" role="dialog" aria-labelledby="post-delete-modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="post-delete-modalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


@endsection



