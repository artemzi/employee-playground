require('./bootstrap');

$(function() {
    $('#delete__action').mouseenter(function() {
        $( "#delete__action" )
            .parent()
            .append( "<div class='row' id='message__warning'><div class='col-12 alert alert-warning text-center'>" +
                "Please reassign child's before remove parent node. Node wil be removed completely with ALL current descendants." +
                "</div></div>" );
    });
    $('#delete__action').mouseleave(function() {
        $( "#message__warning" ).remove();
    });
});