var elem_title = $('.modal .modal-title');
var elem_body = $('.modal .modal-body');
var elem_modal = $('.modal');
var elem_btn_ok = $('.modal .btn-ok');
var elem_btn_close = $('.modal .btn-close');


var modal = {
    confirm: function (data, callback) {
        elem_modal.show();
        elem_title.text(data.title);
        elem_body.text(data.body);

        elem_btn_close.unbind();
        elem_btn_ok.unbind();

        elem_btn_close.on('click', function () {
            elem_modal.hide();
        });

        elem_btn_ok.on('click', function () {
            !!callback ? callback() : false;
            elem_modal.hide();
        });
    }
};