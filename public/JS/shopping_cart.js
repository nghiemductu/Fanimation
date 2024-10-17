// shopping_cart.js

function displayCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const cartTotal = document.getElementById('cart-total');
    const summaryCount = document.getElementById('summary-count');
    const summaryTotal = document.getElementById('summary-total');
    const finalTotal = document.getElementById('final-total');

    // Xóa nội dung hiện tại
    cartItemsContainer.innerHTML = '';

    let total = 0;

    cart.forEach((item, index) => {
        const imagePath = `http://localhost/fanimation/upload/${item.image}`; 
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        cartItemsContainer.innerHTML += `
            <div class="card mb-4">
                <div class="row g-0">
                    <div class="col-md-4" style="padding: 10px;"> 
                        <img src="${imagePath}" class="img-fluid rounded-image" alt="Sản phẩm"> <!-- Thêm margin cho hình ảnh -->
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">${item.name}</h5>
                            <p class="card-text">Giá: ${item.price.toLocaleString()}₫</p>
                            <div class="d-flex align-items-center">
                                <span>Số lượng:</span>
                                <input type="number" class="form-control w-auto ms-2" aria-label="Số lượng sản phẩm" data-index="${index}" value="${item.quantity}" min="1" >
                                <button class="remove-item ms-2" data-index="${index}">X</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    // Cập nhật số lượng và tổng tiền
    cartCount.textContent = cart.length;
    cartTotal.textContent = total.toLocaleString() + '₫';
    summaryCount.textContent = cart.length + ' sản phẩm';
    summaryTotal.textContent = total.toLocaleString() + '₫';
    finalTotal.textContent = total.toLocaleString() + '₫';

    // Thêm sự kiện cho nút xóa
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            removeItemFromCart(index);
        });
    });

    // Thêm sự kiện cho thay đổi số lượng
    document.querySelectorAll('input[type="number"][data-index]').forEach(input => {
        input.addEventListener('change', function() {
            const index = this.getAttribute('data-index');
            const newQuantity = parseInt(this.value);
            updateItemQuantity(index, newQuantity);
        });
    });
}

// Hàm để xóa sản phẩm khỏi giỏ hàng
function removeItemFromCart(index) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1); // Xóa sản phẩm tại vị trí index
    localStorage.setItem('cart', JSON.stringify(cart)); // Cập nhật localStorage
    displayCart(); // Hiển thị lại giỏ hàng
}

// Hàm để cập nhật số lượng sản phẩm
function updateItemQuantity(index, newQuantity) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (newQuantity > 0) {
        cart[index].quantity = newQuantity; // Cập nhật số lượng
    } else {
        removeItemFromCart(index); // Nếu số lượng là 0, xóa sản phẩm
    }
    localStorage.setItem('cart', JSON.stringify(cart)); // Cập nhật localStorage
    displayCart(); // Hiển thị lại giỏ hàng
}

// Hàm để xóa tất cả sản phẩm (nếu cần)
function removeAllItems() {
    localStorage.removeItem('cart'); // Xóa giỏ hàng trong localStorage
    displayCart(); // Hiển thị lại giỏ hàng
}

// Gọi hàm để hiển thị giỏ hàng khi trang được tải
displayCart();