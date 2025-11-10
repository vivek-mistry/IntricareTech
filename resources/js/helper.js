// import { hideLoader, showLoader } from "./main";
import axios from "./axios";
import iziToast from 'izitoast';

export const fetchWrapper = {
    get: request("GET"),
    post: request("POST"),
    put: request("PUT"),
    delete: request("DELETE"),
    patch: request("PATCH"),
};

function request(method) {
    return async (url, body, type = "json", is_blob = false) => {
        // showLoader();
        if (method === "PUT" && type === "form") {
            body["_method"] = "PUT";
        }
        const requestOptions = {
            method: method === "PUT" && type === "form" ? "POST" : method,
            headers: authHeader(url, type),
        };
        if (body) {
            if (method === "GET") {
                requestOptions.params = body;
            } else {
                requestOptions.data =
                    type == "form" ? body : JSON.stringify(body);
            }
        }
        if (is_blob) {
            requestOptions.responseType = "blob";
        }
        return axios(url, requestOptions)
            .then(handleResponse)
            .catch(handleError);
    };
}

// header function handle
function authHeader(url, type) {
    let header = {
        "Content-Type":
            type == "form" ? "multipart/form-data" : "application/json",
    };
    return header;
}

async function handleResponse(response) {
    // hideLoader();
    if (response) {
        return response?.data;
    } else {
        return Promise.reject("something went wrong");
    }
}

async function handleError(error) {
    // hideLoader();
    if (error === null)
        return Promise.reject("Unrecoverable error!! Error is null!");
    const response = error?.response;
    if (error.code === "ERR_NETWORK") {
        return Promise.reject("connection problems..");
    } else if (error.code === "ERR_CANCELED") {
        return Promise.reject("connection canceled..");
    }
    if (response) {
        const statusCode = response?.status;
        const data = response?.data;
        if (statusCode === 404) {
            return Promise.reject(
                "The requested resource does not exist or has been deleted"
            );
        } else if (statusCode === 401) {
            return Promise.reject(data.message);
        } else if (data) {
            const errorData = (data && data.message) || response.status;
            return Promise.reject(errorData);
        } else {
            return Promise.reject("something went wrong");
        }
    }
}

export const tostMessage = (message, type = "success") => {
    const toastTypes = ["success", "error", "warning", "info"];
    const toastTitle = {
        success: "Success",
        error: "Error",
        warning: "Warning",
        info: "Info"
    };

    const showType = toastTypes.includes(type) ? type : "success";

    iziToast[showType]({
        title: toastTitle[showType],
        message,
        position: 'topRight'
    });
    
};

let confirmModalInstance = null;

export const showConfirmationModal = function({
    title = "Confirm Action",
    message = "Are you sure?",
    confirmText = "Yes",
    cancelText = "Cancel",
    onConfirm = function () {}
}) {
    // Set modal content using jQuery
    $('#confirmationModalTitle').text(title);
    $('#confirmationModalMessage').text(message);
    $('#confirmModalBtn').text(confirmText);
    $('#cancelModalBtn').text(cancelText);

    const modalElement = document.getElementById("confirmationModal");

    // Create modal instance if not already created
    if (!confirmModalInstance) {
        alert("23")
        confirmModalInstance = new bootstrap.Modal(modalElement);
    }

    // Remove previous click handler to avoid stacking
    $('#confirmModalBtn').off('click').on('click', function () {
        alert(45);
        onConfirm();
        confirmModalInstance.hide();
    });

    // Show modal
    confirmModalInstance.show();
};

export function refreshDataTable(dataTableObject)
{
    var currentPage = dataTableObject.DataTable().page.info().page;
    // dataTableObject.DataTable().ajax.reload(null, false);  
    dataTableObject.DataTable().page(currentPage).draw(false);
}
