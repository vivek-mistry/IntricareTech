
import { tostMessage } from ".././helper";

var contactStoreForm = $('#contactStoreForm');

contactStoreForm.on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    console.log(formData)
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $("#contact_model").attr("style", "display:none");
            $(".background_overlay").attr("style", "display:none");
            tostMessage(response.message, 'info');
            fetchContacts()
        },
        error: function(error) {
            tostMessage(error.responseJSON.message, 'error');
        }
    });
    
    
});