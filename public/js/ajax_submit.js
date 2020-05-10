$(document).on('click', '#book_delete',function (event) {
    event.preventDefault();
    let bookId = $(this).data('book_id');
    let token = $('#token').val();

    $.ajax({
        type: 'POST',
        url: '/book/delete',
        dataType: 'json',
        data: {book_id: bookId, _token: token},
        success: function (data) {
            if(data.status == 'ok') {
                location.reload();
            }
        }
    })
});

$(document).on('click', '#author_delete',function (event) {
    event.preventDefault();
    let authorId = $(this).data('author_id');
    let token = $('#token').val();
    $.ajax({
        type: 'POST',
        url: '/author/delete',
        dataType: 'json',
        data: {author_id: authorId, _token: token},
        success: function (data) {
            if(data.status == 'ok') {
                location.reload();
            }
        }
    })
});

$(document).on('submit', '#book_change_form', function (event) {
    event.preventDefault();
    let bookName = $(this).find('.book_name').val();
    let bookId = $(this).find('.book_name').data('book_id');
    let authorIds = [];
    let token = $('#token').val();
    $(this).find('.select_authors option:selected').each(function () {
        authorIds.push($(this).data('author_id'));
    });

    $.ajax({
        type: 'POST',
        url: '/book/update',
        dataType: 'json',
        data: {book_id: bookId, book_name: bookName, authors: authorIds, _token: token},
        success: function (data) {
            location.reload();
        }
    })
})

$(document).on('submit', '#author_change_form', function (event) {
    event.preventDefault();
    let lastName = $(this).find('.last_name').val();
    let firstName = $(this).find('.first_name').val();
    let middleName = $(this).find('.middle_name').val();
    let authorId = $(this).data('author_id');
    let token = $('#token').val();

    $.ajax({
        type: 'POST',
        url: '/author/update',
        dataType: 'json',
        data: {last_name: lastName, first_name: firstName, middle_name: middleName, author_id: authorId, _token: token},
        success: function (data) {
            location.reload();
        }
    })
})

$(document).on('submit', '#book_add_form', function (event) {
    event.preventDefault();
    let authorIds = [];
    let bookName = $(this).find('.book_name').val();
    let token = $('#token').val();
    $(this).find('.select_authors option:selected').each(function () {
        authorIds.push($(this).data('author_id'));
    });
    $.ajax({
        type: 'POST',
        url: '/book/add',
        dataType: 'json',
        data: {authors: authorIds, name: bookName, _token: token},
        success: function (data) {
            location.reload();
        }
    })
});

$(document).on('submit', '#author_add_form', function (event) {
    event.preventDefault();
    let firstName = $(this).find('.first_name').val();
    let lastName = $(this).find('.last_name').val();
    let middleName = $(this).find('.middle_name').val();
    let token = $('#token').val();

    $.ajax({
        type: 'POST',
        url: '/author/add',
        dataType: 'json',
        data: {last_name: lastName, first_name: firstName, middle_name: middleName, _token: token},
        success: function (data) {
            location.reload();
        }
    })
});