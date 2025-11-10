import iziToast from 'izitoast';

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