@extends('layouts.main')

@section('content')
{{-- <script type="text/javascript" src="/js/ajax_like.js"></script> --}}

<div class="posts-show">

    @can('update', $post)
    <div class="btns">
        <a href="{{ url('posts/' . $post->id . '/edit') }}" class="btn btn-outline-primary btn-edit">Edit</a>
        @component('components.delete-btn')
            @slot('controller', 'posts')
            @slot('id', $post->id)
            @slot('name', $post->title)
        @endcomponent
    </div>
    @endcan

    <div class="posts-show-header">
        <h1>{{ $post->title }}</h1>
        <p>by<a class="username" href="{{ url('users/' . $post->user->id) }}"> {{ $post->user->name }}</a></p>
        <p class="datetime">updated:{{ $post->updated_at->format('Y-m-d') }}</p>
    </div>
    <div class="posts-show-body">
        <p class="body">{!! nl2br(e($post->body)) !!}</p>

        @if ($post->image !== null)
        <div class="image">
            <img class="image-size" src="data:image/png;base64,{{ $post->image }}">
        </div>
        @endif
    </div>
    @if (Auth::user())
    {{-- <div class="likes-show"> --}}
        <div class="like-post">
            {{-- foreachで、ログイン中のユーザーがこの投稿をいいねしてないかチェック --}}
            @if ($like_or)
                <i class="fas fa-heart delete-like"></i>
                <span class="color-red">{{ $post->likes->count() }}</span>
            @else
                <i class="far fa-heart add-like"></i>
                <span class="color-black">{{ $post->likes->count() }}</span>
            @endif
        </div>
    @endif
    </div>
{{-- </div> --}}

<div class="comments-show">
    {{-- コメントが一つでもあれば表示 --}}
    @if (isset($post->comments[0]))
    <div class="comments-list">
        <table>
            <thead>
                <tr>
                    <th class="comment-top" colspan="4">Comments</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($post->comments as $comment)
                <tr>
                    <td>{{ $loop->iteration }}, </td>
                    <td class="body">{!! nl2br(e($comment->body)) !!}</td>
                    <td class="datetime">{{ $comment->created_at->format('Y-m-d') }}</td>

                    @can('update', $post)
                    <td class="delete-btn">
                        @component('components.delete-btn')
                            @slot('controller', 'comments')
                            @slot('id', $comment->id)
                            @slot('name', $comment->body)
                        @endcomponent
                    </td>
                    @endcan

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @endif

    <div class="comment-form">
        <form action="{{ url('comments') }}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                <button type="submit" class="btn btn-primary btn-submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>

// $(function() {
//     $('.like-post').on('click', '.add-like', function() {
//         $.ajaxSetup({
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
//         });
//         $.ajax({
//             url: "{{ action('PostController@like_add') }}",
//             type: 'POST',
//             data: 'post'
//         })
//         // Ajaxリクエストが成功した場合
//         .done(function(data) {
//             // console.log(data);
//             $('.add-like').remove();
//             $('.like-post').prepend('<i class="fas fa-heart delete-like"></i>');
//             $('span').removeClass('color-black');
//             $('span').addClass('color-red');
//             $('span').text(data);

//         })
//         // Ajaxリクエストが失敗した場合
//         .fail(function(data) {
//             console.log('ng');
//         });
//     });

//     $('.like-post').on('click', '.delete-like', function() {
//         $.ajaxSetup({
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
//         });
//         $.ajax({
//             url: "{{ action('PostController@like_destroy') }}",
//             type: 'POST',
//             data: 'post'
//         })
//         // Ajaxリクエストが成功した場合
//         .done(function(data) {
//             // console.log(data);
//             $('.delete-like').remove();
//             $('.like-post').prepend('<i class="far fa-heart add-like"></i>');
//             $('span').removeClass('color-red');
//             $('span').addClass('color-black');
//             $('span').text(data);

//         })
//         // Ajaxリクエストが失敗した場合
//         .fail(function(data) {
//             console.log('ng');
//         });
//     });
// });
</script>
@endsection
