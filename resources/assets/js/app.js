require('./bootstrap');

$(function() {
    action = $('#delete__action');
    action.mouseenter(function() {
        action
            .parent()
            .append( "<div class='row' id='message__warning'><div class='col-12 alert alert-warning text-center'>" +
                "Please reassign child's before remove parent node. Node will be removed completely with ALL current descendants." +
                "</div></div>" );
    });
    action.mouseleave(function() {
        $( "#message__warning" ).remove();
    });

    // image upload
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $('.form-control-file').html(fileName);
    });

    // input search parent action
    $('.parent').select2({
        ajax: {
            minimumInputLength: 2,
            placeholder: "Choose parent...",
            url: '/admin/employees/search',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });

    // choose new parent checkbox
    let chShipBlock = $('#nparent');
    $('#descendants').on('click', function() {
        if($(this).is(':checked')) {
          chShipBlock.show();
          chShipBlock.find('input').attr('required', true);
        } else {
          chShipBlock.hide();
          chShipBlock.find('input').attr('required', false);
        }
    });

    // input search new parent action
    $('#new__parent').select2({
        ajax: {
            minimumInputLength: 2,
            placeholder: "Choose parent...",
            url: '/admin/employees/search',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });
});