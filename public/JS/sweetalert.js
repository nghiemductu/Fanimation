function showSuccessAlert(title, text) {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: title,
        text: text,
        showConfirmButton: false,
        timer: 1500
    });
}

// public/JS/sweetalert.js

function confirmDelete(callback) {
    Swal.fire({
        title: "Are you sure?",
        text: "Please go to the hidden section if you change your mind !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            callback(); 
        }
    });
}

function confirmHide(url) {
    if (confirm("Are you sure you want to hide this comment?")) {
        window.location.href = url;
    }
}

function confirmRestore(url) {
    if (confirm("Are you sure you want to restore this data?")) {
        window.location.href = url;
    }
}

// Xác nhận ẩn người dùng
function confirmHideUser(userId) {
    Swal.fire({
        title: "Are you sure you want to hide this user?",
        showCancelButton: true,
        confirmButtonText: "Hide",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            // Nếu xác nhận, chuyển hướng đến URL ẩn người dùng
            window.location.href = "index.php?act=hide_user&id=" + userId;
        }
    });
    
}