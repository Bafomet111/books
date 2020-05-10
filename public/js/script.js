var blockHtml;

$(document).on('click', '#book_change',function (event) {
    event.preventDefault();

    let name = $(this).siblings('.book_name').text();
    name = name.trim();

    let bookId = $(this).data('book_id');

    blockHtml = $(this).parent('div').html();

    // получаем и вставляем форму для изменения
    let form = $('#hidden_book_form form').clone();
    form.find('.book_name').val(name);
    form.find('.book_name').data('book_id', bookId);

    let authorId = $(this).siblings('.author:first').data('author_id');
    form.find('select #author_'+authorId).attr('selected', true);

    //Если авторов больше 1
    if($(this).siblings('.author').length > 1) {

        $(this).siblings('.author').not(':first').each(function () {

            let authorId = $(this).data('author_id');

            let select = form.find('.select_authors').clone();
            select.find('#author_' + authorId).attr('selected', true);
            form.find('#add_author').before(select)

        })

    }

    $(this).parent('.list__book').html(form);

    //делаем все ссылки неактивными
    $('a').not('.is_not_disabled').addClass('disabled');

});


$(document).on('click', '#cansel', function () {
    $(this).parents('.list_item').html(blockHtml)
    $('a').removeClass('disabled');
})


$(document).on('click', '#add_author',function (event) {
    event.preventDefault();

    let authors = $('.select_authors:first').clone();
    $(this).before(authors);
});

$(document).on('click', '.delete_author',function (event) {
    event.preventDefault();
    $(this).parent('.select_authors').remove();
});