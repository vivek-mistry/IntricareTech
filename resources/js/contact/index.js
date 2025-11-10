import _ from 'lodash';
import { showConfirmationModal, tostMessage, fetchWrapper } from ".././helper";

fetchContacts();

var CONTACT_BODY = $('#contact_datatable_body');
var PAGINATION = $('#pagination');
var SEARCH = $("#contact_input_search");

window.fetchContacts = fetchContacts;

async function ajaxRequest(url) {
    var formData = {};
    formData.search = $("#contact_input_search").val();
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            console.log(response);
            CONTACT_BODY.html(response.html);
            PAGINATION.html(response.pagination);
            loadPaginationLink(); 
        },
        error: function (error) {
            console.log(error);
        }
    });
}

async function fetchContacts() {
    await ajaxRequest(ROUTE_CONTACT_LIST);
}

function loadPaginationLink() {
    $('nav a').off('click').on('click', async function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        await ajaxRequest(url);
    });
}

const debouncedSearch = _.debounce(async function (val) {    
    console.log(val);
    await fetchContacts();
}, 300);

$(document).on("keyup", "#contact_input_search", debouncedSearch);


$(document).on('click', '.remove_contact', async function() {
    let contact = $(this).data('contact_id');
    
    showConfirmationModal({
        title: 'Delete Contact',
        message: 'Are you sure you want to delete this contact?',
        confirmText: 'Delete',
        cancelText: 'Cancel',
        onConfirm: async function() {
            $.ajax({
                url: ROUTE_CONTACT_DELETE.replace(':id', contact),
                type: 'DELETE',
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    tostMessage(response.message, 'success');
                    fetchContacts();
                    
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    });
});