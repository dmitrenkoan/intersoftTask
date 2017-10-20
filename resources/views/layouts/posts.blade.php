@extends('publicTemplate');
@section('content')
    @if(!empty($posts))
        @foreach($posts as $post)
            <div class="container posts">
                <h3 >{{$post->title}}</h3>
                <p class="date">{{$post->publication_date->format('d/m/Y')}}</p>
                @if(!empty($post->picture->path))
                <p class="image">
                    <img src="{{$post->picture->path}}">
                </p>
                @endif
                <p class="detal-text">
                    {{$post->detail_text}}
                </p>
            </div>
        @endforeach
        <div class="container center">
            {{$posts->links()}}
        </div>
    @endif
@endsection