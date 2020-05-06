
var blockHtml;

$(document).on('click', '#book_change',function (event) {
    event.preventDefault();
    let name = $(this).siblings('.book_name').text();
    name = name.trim();

    blockHtml = $(this).parent('div').html();

    $('.book_name').val(name)
    let form = $('#hidden_book_form').html();

    $(this).parent('.list__book').html(form)

    $('a').addClass('disabled');
});

$(document).on('click', '#cansel', function () {
    $(this).parents('.list_item').html(blockHtml)
    $('a').removeClass('disabled');
})
