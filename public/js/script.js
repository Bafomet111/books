var blockHtml;

//Изменение книги
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

//Добавление автора к форме
$(document).on('click', '#add_author',function (event) {
    event.preventDefault();

    let authors = $('.select_authors:first').clone();
    $(this).siblings('table').append(authors);
});

//Удаление автора из формы
$(document).on('click', '.delete_author',function (event) {
    event.preventDefault();
    $(this).parents('.select_authors').remove();
});

//Изменение автора
$(document).on('click', '#author_change',function (event) {
    event.preventDefault();
    blockHtml = $(this).parent('div').html();

    let lastName = $(this).siblings('.author_name').find('.last_name').text();
    let firstName = $(this).siblings('.author_name').find('.first_name').text();
    let middleName = $(this).siblings('.author_name').find(' .middle_name').text();
    let authorId = $(this).data('author_id');

    let form = $('#hidden_author_form form').clone();
    form.attr('data-author_id', authorId);
    form.find('.last_name').val(lastName);
    form.find('.first_name').val(firstName);
    form.find('.middle_name').val(middleName);
    $(this).parent('div').html(form);

    //делаем все ссылки неактивными
    $('a').not('.is_not_disabled').addClass('disabled');
});

//Добавление книги
$(document).on('click', '.book_add', function () {
    let form = $('#hidden_book_form form').clone();
    form.attr('id', 'book_add_form');
    form.find('.cansel').removeClass('cansel').addClass('reload_cansel');
    $('.lists').html(form);
})

//Добаление автора
$(document).on('click', '.author_add', function () {
    let form = $('#hidden_author_form form').clone();
    form.attr('id', 'author_add_form');
    form.find('.cansel').removeClass('cansel').addClass('reload_cansel');
    $('.lists').html(form);
})

$(document).on('click', '.cansel', function () {
    $(this).parents('.list_item').html(blockHtml)
    $('a').removeClass('disabled');
})

$(document).on('click', '.reload_cansel', function () {
    location.reload();
})
