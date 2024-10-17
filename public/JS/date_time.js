
    // Cập nhật ngày và giờ hiện tại
    function updateTimeAndLocation() {
        const date = new Date();
        const formattedDate = date.toLocaleDateString();
        const formattedTime = date.toLocaleTimeString();
        
        // Kiểm tra và lấy vị trí địa lý
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                const locationInfo = `Date: ${formattedDate}, Time: ${formattedTime}, Location: (${latitude}, ${longitude})`;
                document.getElementById('scrolling-text').textContent = locationInfo;
            });
        } else {
            document.getElementById('scrolling-text').textContent = "Geolocation is not supported by this browser.";
        }
    }

    // Gọi hàm cập nhật thời gian và vị trí ngay khi trang tải
    updateTimeAndLocation();

    // Cập nhật thời gian và vị trí mỗi 1 giây
    setInterval(updateTimeAndLocation, 1000);
