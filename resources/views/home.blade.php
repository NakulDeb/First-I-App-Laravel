@extends('layouts.app')

@section('content')
<div class="container">

    @if (!empty($posts))

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
                </div>
            </div>
        @endforeach
        {{-- <div class="text-center" style="">
            <div class="dropdown show">
                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="paginate-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Select Page Items
                </a>

                <div class="dropdown-menu" aria-labelledby="paginate-dropdown">
                  <a class="dropdown-item" href="{{ url('home')."?page={$page}". "&item=1" }}" onclick="return confirm('Are you sure ?')">2</a>
                  <a class="dropdown-item" href="#">5</a>
                  <a class="dropdown-item" href="#">10</a>
                  <a class="dropdown-item" href="#">20</a>
                  <a class="dropdown-item" href="#">50</a>
                  <a class="dropdown-item" href="#">100</a>
                </div>
              </div>
        </div> --}}


        <form action="{{ Route('home') }}" method="get">
            <div class="row justify-content-center">
                    <div class="col-md-5 col-lg-4">
                        <select name="items" id="items" class="form-control">
                            <option>Select Page Items</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" value="Set items" class="btn btn-sm btn-primary">
                    </div>
            </div>
        </form>


        <div class="text-center">Show {{ $posts->perPage() * $posts->currentPage() - $posts->perPage() +1  }} to {{ $posts->perPage() * $posts->currentPage() - $posts->perPage() + count($posts->items()) }} of {{ $totalpost }}</div>
        <div class="pagination justify-content-center py-3">

            @php
                $itemsArray = [
                    'items' => request()->query('items'),
                ];
            @endphp
            <div class="">{{ $posts->appends($itemsArray)->links() }}</div>
        </div>
    @else
        <h4 class="text-center text-secondary">Empty</h4>
    @endif





</div>

@endsection



