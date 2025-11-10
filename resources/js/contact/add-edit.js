
import { showToast } from ".././helper";

var contactFormSave = $('#contact_form');

contactFormSave.on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    console.log(formData)
    $.ajax({
        url: ROUTE_CONTACT_STORE,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $("#contact_model").attr("style", "display:none");
            $(".background_overlay").attr("style", "display:none");
            showToast(response.message, 'info');
            fetchContacts()
        },
        error: function(error) {
            
        }
    });
    
    
});