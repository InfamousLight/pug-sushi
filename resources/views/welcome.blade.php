@extends('layouts.blog-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($posts as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">{{$post->title}}</div>
                    <div class="panel-body">
                        {!! $post->body !!}
                    </div>
                </div>
                @endforeach
                    test {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
