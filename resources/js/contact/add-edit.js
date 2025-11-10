
import { tostMessage } from ".././helper";

var contactStoreForm = $('#contactStoreForm');
var contactCreateModal = $('#contactCreateModal');

var contactEditForm = $('#contactEditForm');
var contactEditModal = $('#contactEditModal');

contactStoreForm.on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
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

contactEditModal.on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var contact_id = button.data('contact_id');
    
    $.ajax({
        url: ROUTE_CONTACT_EDIT.replace(':id', contact_id),
        type: 'GET',
        success: function(response) {
            contactEditForm.trigger("reset");
            contactEditForm.find('input[name="name"]').val(response.name);
            contactEditForm.find('input[name="email"]').val(response.email);
            contactEditForm.find('input[name="phone"]').val(response.phone);
            contactEditForm.find('input[name="gender"]').val(response.gender);
            contactEditForm.attr('action', ROUTE_CONTACT_UPDATE.replace(':id', contact_id));
            contactEditModal.modal("show");
        },
        error: function(error) {
            tostMessage(error.responseJSON.message, 'error');
        }
    });
});

contactEditForm.on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            contactEditModal.modal("hide");
            tostMessage(response.message, 'success');
            fetchContacts()
            contactEditForm.trigger("reset");
            
        },
        error: function(error) {
            tostMessage(error.responseJSON.message, 'error');
        }
    });
});
