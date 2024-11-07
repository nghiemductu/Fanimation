<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fanimation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link href="http://localhost/fanimation/public/css/body.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const productId = this.dataset.id;
                    const productName = this.dataset.name;
                    const productPrice = this.dataset.price;
                    const productImage = this.dataset.image;
                    console.log(productImage);

                    fetch('/fanimation/front/view/cart_handler.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                action: 'add_to_cart',
                                product_id: productId,
                                product_name: productName,
                                product_price: productPrice,
                                product_image: productImage
                            })
                        })

                        .then(response => response.json()) // Phân tích phản hồi dưới dạng JSON
                        .then(data => {
                            if (data.status === 'success') {
                                alert(data.message); // Hiển thị thông báo tiếng Việt chính xác
                            } else {
                                alert('An error occurred while adding to cart!');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</head>

<body>
    <div class="First-img">
        <img src="http://localhost/fanimation/img/banner.jpg" alt="pic2">

    </div>

    

    <div class="container main-container">
        <div class="New-arrival">
            <div class="title-arrival">
                <h1 class="display-4">New Arrivals</h1>
                <p class="lead">Explore our collection of modern, luxurious and energy-efficient electric fans and ceiling fans today!</p>
        
            </div>
        </div>

        <div class="container my-5">
            <div class="row">
                <?php if (is_array($new_arrivals)): ?>
                    <?php foreach (array_slice($new_arrivals, 0, 20) as $product): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <?php
                                $images = isset($product['images']) ? json_decode($product['images'], true) : [];
                                $first_image = $images[0] ?? '/img/default-product.jpg';
                                
                                ?>
                                <a href="index.php?act=pd_detail&product_id=<?php echo $product['id']; ?>">
                                    <img src="<?php echo $first_image; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['ten_sp']); ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['ten_sp']); ?></h5>
                                    <p class="card-text"><?php echo number_format($product['gia'], 0, ',', '.'); ?>$</p>
                                    <a href="#" class="market-button add-to-cart"
                                        data-id="<?php echo $product['id']; ?>"
                                        data-name="<?php echo htmlspecialchars($product['ten_sp']); ?>"
                                        data-price="<?php echo $product['gia']; ?>"
                                        data-image="<?php echo $first_image; ?>">
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="container section-wrapper">
        <div class="row">
            <div class="col-lg-3 col-md-12 text-section-1">
                <h2 class="section-title-1">What is Fanimation?</h2>
                <div class="zigzag-line"></div>
            </div>

            <div class="col-lg-5 col-md-12 text-section-2 ">
                <h2 class="section-title-2">A Window Connecting Fanimation People to the World</h2>
                <br>
                <div class="underline"></div>
                <p>Welcome to Fanimation, the largest platform for buying and selling fan equipment in the world.</p>
                <p>
                We operate as a commercial bridge for manufacturers and retailers worldwide to access the global market. All of our stores are owned by Fanimation. We aim to work together to provide products for everyone, from retail customers to wholesale merchants. Meet the manufacturers of Fanimation.
                </p>
            </div>

            <div class="col-lg-4 col-md-12 image-section">
                <img src="http://localhost/fanimation/img/img_bd_1.jpg" alt="pic2">
            </div>
        </div>
    </div>

    <div class="New-arrival mt-5 ">
        <div class="container title-product">
            <h1>Featured Products</h1>
        
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <!-- Featured Products -->
            <?php if (is_array($featured_products)): ?>

                <?php foreach (array_slice($featured_products, 0, 20) as $product): ?> <!-- Hiển thị tối đa 20 sản phẩm -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <?php
                            // Giải mã JSON nếu cần
                            $images = isset($product['images']) ? json_decode($product['images'], true) : [];
                            // Lấy ảnh đầu tiên hoặc ảnh mặc định
                            $first_image = $images[0] ?? '/img/default-product.jpg';
                            ?>
                            <a href="index.php?act=pd_detail&product_id=<?php echo $product['id']; ?>">
                                <img src="<?php echo $first_image; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['ten_sp']); ?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['ten_sp']); ?></h5>
                                <p class="card-text"><?php echo number_format($product['gia'], 0, ',', '.'); ?>$</p>
                                <a href="#" class="market-button add-to-cart"
                                    data-id="<?php echo $product['id']; ?>"
                                    data-name="<?php echo htmlspecialchars($product['ten_sp']); ?>"
                                    data-price="<?php echo $product['gia']; ?>"
                                    data-image="<?php echo $first_image; ?>">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="advantages-section">
        <div class="advantages-overlay" style="background-image: url('http://localhost/fanimation/img/img_bd_2.jpg');background-repeat: no-repeat; width:100%; height: 600px;background-size: cover;
    background-position: center;"></div>
        <div class="advantages-content">
            <h2 class="advantages-title">The Advantages of Buying at Fanimation</h2>
            <div class="zigzag-unique">
                <svg width="200" height="10" viewBox="0 0 200 10" xmlns="http://www.w3.org/2000/svg">
                    <polyline points="0,5 10,0 20,5 30,0 40,5 50,0 60,5 70,0 80,5 90,0 100,5 110,0 120,5 130,0 140,5 150,0 160,5 170,0 180,5 190,0 200,5" fill="none" stroke="white" stroke-width="2" />
                </svg>
            </div>
            <h4 class="advantages-text">
                You get local pricing from the artisans no matter what and fast and inexpensive shipping. Retail buyers can acquire Fanimation items at a discount. However, the trick for wholesale buyers to get lower shipping costs per item is to buy more products. We have worked hard to get the lowest processing prices and shipping discounts to get you the best price possible while still respecting the artisan’s fees. <a href="#">Read more about how it works.</a>
            </h4>
        </div>
    </div>

    <div class="New-arrival mt-5">
        <div class="container title-sellers">
            <h1>Best Sellers</h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <!-- Best Sellers -->
            <?php if (is_array($best_sellers)): ?>

                <?php foreach (array_slice($best_sellers, 0, 20) as $product): ?> <!-- Hiển thị tối đa 20 sản phẩm -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <?php
                            $images = isset($product['images']) ? json_decode($product['images'], true) : [];
                            $first_image = $images[0] ?? '/img/default-product.jpg';
                            ?>
                            <a href="index.php?act=pd_detail&product_id=<?php echo $product['id']; ?>">
                                <img src="<?php echo $first_image; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['ten_sp']); ?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['ten_sp']); ?></h5>
                                <p class="card-text"><?php echo number_format($product['gia'], 0, ',', '.'); ?>$</p>
                                <a href="#" class="market-button add-to-cart"
                                    data-id="<?php echo $product['id']; ?>"
                                    data-name="<?php echo htmlspecialchars($product['ten_sp']); ?>"
                                    data-price="<?php echo $product['gia']; ?>"
                                    data-image="<?php echo $first_image; ?>">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>


    <div class="container my-5">
    <div class="row">
        <div class="col-md-3 mb-4">
            <a href="http://localhost/fanimation/front/view/bai_viet1.html">
                <img src="http://localhost/fanimation/img/bai_viet/bai_viet1.jpg" alt="Bài viết 1" class="img-fluid article-image">
                <h8>Sải cánh quạt trần phù hợp với không gian</h8>
            </a>
            <p>Khi chọn quạt trần chúng ta rất hay không để ý tới những chi tiết như chiều dài sải cánh quạt</p>
        </div>
        <div class="col-md-3 mb-4">
            <a href="http://localhost/fanimation/front/view/bai_viet2.html">
                <img src="http://localhost/fanimation/img/bai_viet/bai_viet2.jpg" alt="Bài viết 2" class="img-fluid article-image">
                <h8>Bí quyết chọn Quạt trần phù hợp nhất cho ngôi nhà của mình.</h8>
            </a>
            <p>Quạt trần là gì? Quạt trần là một thiết bị treo trên trần của một căn phòng, với các cánh</p>
        </div>
        <div class="col-md-3 mb-4">
            <a href="http://localhost/fanimation/front/view/bai_viet3.html">
                <img src="http://localhost/fanimation/img/bai_viet/bai_viet3.jpg" alt="Bài viết 3" class="img-fluid article-image">
                <h8>Cách chọn Quạt Trần dựa theo những tiêu chí nào?</h8>
            </a>
            <p>Bạn đang cần mua cho gia đình mình một sản phẩm quạt trần với chất lượng hàng đầu chưa từng có</p>
        </div>
        <div class="col-md-3 mb-4">
            <a href="http://localhost/fanimation/front/view/bai_viet4.html">
                <img src="http://localhost/fanimation/img/bai_viet/bai_viet4.jpg" alt="Bài viết 4" class="img-fluid article-image">
                <h8>Những lợi ích tuyệt vời khi sử dụng Quạt Trần</h8>
            </a>
            <p>Quạt trần là sự lựa chọn không thể thiếu trong mỗi gia đình trong những ngày hè nóng nực</p>
        </div>
    </div>
</div>


    <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const productId = this.dataset.id;
                const productName = this.dataset.name;
                const productPrice = this.dataset.price;
                const productImage = this.dataset.image;
               
                
                fetch(window.location.href, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            action: 'add_to_cart',
                            product_id: productId,
                            product_name: productName,
                            product_price: productPrice,
                            product_image: productImage
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message);
                        } else {
                            alert('Có lỗi xảy ra khi thêm vào giỏ hàng!');
                        }
                    })
                    .catch(error => console.error('Lỗi:', error));
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>