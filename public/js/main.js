$(document).ready(function () {

    function deleteSupplier()
    {
        let link = $('.js-supplier-delete');
        link.on('click', function (e) {
            let $this = $(this);
            let href = $this.attr('href');
            $.ajax({
                type: 'delete',
                url: href
            })
                .done(function (count) {
                    $this.closest('#supplier').fadeOut(1000);
                    $('.js-count-suppliers').html(count);
                })
                .fail(function () {
                    console.warn('wystąpił błąd');
                })
            ;

            e.preventDefault();
        });
    }

    deleteSupplier();

});