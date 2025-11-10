
import { tostMessage } from ".././helper";

var contactStoreForm = $('#contactStoreForm');
var contactCreateModal = $('#contactCreateModal');

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
            contactCreateModal.modal("hide");
            tostMessage(response.message, 'success');
            fetchContacts()
            contactStoreForm.trigger("reset");
            
        },
        error: function(error) {
            tostMessage(error.responseJSON.message, 'error');
        }
    });
});