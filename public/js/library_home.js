$(function() {
    $('#borrow-model').on("show.bs.modal", function (e) {
        $("#borrowModalLabel").html("Borrow Confirmation");
        $("#book-title").html($(e.relatedTarget).data('title'));
        $("#book_id").val($(e.relatedTarget).data('book_id'))
    });
});
