$(function() {
    $('.like-post').on('click', '.add-like', function() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: '/posts/like_add',
            type: 'POST',
        })
        // Ajaxリクエストが成功した場合
        .done(function(data) {
            // console.log(data);
            $('.add-like').remove();
            $('.like-post').prepend('<i class="fas fa-heart delete-like"></i>');
            $('span').removeClass('color-black');
            $('span').addClass('color-red');
            $('span').text(data);

        })
        // Ajaxリクエストが失敗した場合
        .fail(function(data) {
            console.log('ng');
        });
    });

    $('.like-post').on('click', '.delete-like', function() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: '/posts/like_destroy',
            type: 'POST',
        })
        // Ajaxリクエストが成功した場合
        .done(function(data) {
            // console.log(data);
            $('.delete-like').remove();
            $('.like-post').prepend('<i class="far fa-heart add-like"></i>');
            $('span').removeClass('color-red');
            $('span').addClass('color-black');
            $('span').text(data);

        })
        // Ajaxリクエストが失敗した場合
        .fail(function(data) {
            console.log('ng');
        });
    });
});