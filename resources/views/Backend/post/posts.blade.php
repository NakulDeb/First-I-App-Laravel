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

                    <h5 class="text-center py-2">All Post</h5>


                    <table class="table table-striped table-hover border">
                        <thead>
                          <tr>
                            <th >Id</th>
                            <th >Author</th>
                            <th >Image</th>
                            <th >Title</th>
                            <th >Body</th>
                            <th >Created Date</th>
                            <th >Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->user->name }}</td>
                                    <td><img src="{{ asset('storage/'.$post->image) }}" alt="" srcset="" style="width:100px"></td>
                                    <td class=" text-truncate" style="max-width: 120px">{{ $post->title }}</td>
                                    <td class=" text-truncate" style="max-width: 150px" >{{ $post->body }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <div class="float-right">
                                            <form action="{{ Route('post.update.status',$post->id) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <input type="submit" value="{{ $post->status ? "Block" : "Unblock" }}" class="btn {{ $post->status ? 'btn-secondary' : 'btn-primary' }}">
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <a href="{{ Route('post.edit',$post->id) }}" class="btn btn-info">Edit</a>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ Route('post.destroy',$post->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this post?')">
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </section>
@endsection
