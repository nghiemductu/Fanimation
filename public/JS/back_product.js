// san_pham.php
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('productForm');
    var fileInput = form.querySelector('input[type="file"]');

    form.addEventListener('submit', function(e) {
        if (fileInput.files.length > 6) {
            e.preventDefault();
            alert('You can only choose a maximum of 6 photos.');
        }
    });

    fileInput.addEventListener('change', function() {
        if (this.files.length > 6) {
            alert('You can only choose a maximum of 6 photos.');
            this.value = ''; // Reset input
            return;
        }

        // Kiểm tra định dạng file
        var validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        for (var i = 0; i < this.files.length; i++) {
            if (!validTypes.includes(this.files[i].type)) {
                alert('Only accept image files in jpg, jpeg, png or gif format.');
                this.value = ''; // Reset input
                break;
            }
        }
    });
});



// update_san_pham.php
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('updateProductForm');
    var fileInput = form.querySelector('input[type="file"]');

    form.addEventListener('submit', function(e) {
        if (fileInput.files.length > 6) {
            e.preventDefault();
            alert('You can only choose a maximum of 6 photos.');
        }
    });

    fileInput.addEventListener('change', function() {
        if (this.files.length > 6) {
            alert('You can only choose a maximum of 6 photos.');
            this.value = ''; // Reset input
            return;
        }

        // Kiểm tra định dạng file
        var validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        for (var i = 0; i < this.files.length; i++) {
            if (!validTypes.includes(this.files[i].type)) {
                alert('Only accept image files in jpg, jpeg, png or gif format.');
                this.value = ''; // Reset input
                break;
            }
        }
    });
});
