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
});