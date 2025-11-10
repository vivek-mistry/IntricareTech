fetchContacts();

var CONTACT_BODY = $('#contact_datatable_body');
var PAGINATION = $('#pagination');

window.fetchContacts = fetchContacts;

function ajaxRequest(url) {
    $.ajax({
        url: url,
        type: 'POST',
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

function fetchContacts() {
    ajaxRequest(ROUTE_CONTACT_LIST);
}

function loadPaginationLink() {
    $('nav a').off('click').on('click', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        ajaxRequest(url);
    });
}