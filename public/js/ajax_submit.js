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
