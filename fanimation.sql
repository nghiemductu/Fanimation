-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2024 lúc 12:49 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fanimation`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `ten_danh_muc` varchar(100) NOT NULL,
  `hien_thi_dm` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `ten_danh_muc`, `hien_thi_dm`, `parent_id`) VALUES
(1, 'Ceiling Fan', 1, 0),
(2, 'Industrial fan', 1, 0),
(3, 'Steam fan', 1, 0),
(4, 'Bladeless fan', 1, 0),
(5, 'Tree fan', 1, 0),
(11, 'Kaiyokukan', 1, 1),
(12, 'KimThuanPhong', 1, 1),
(13, 'Panasonic', 1, 1),
(14, 'Vinawind', 1, 1),
(15, 'Caterpillar', 1, 2),
(16, 'Chinghai', 1, 2),
(17, 'Hawin', 1, 2),
(18, 'ifan', 1, 2),
(19, 'Sowun', 1, 2),
(20, 'Benny', 1, 4),
(21, 'Fujihome', 1, 4),
(22, 'Panworld', 1, 4),
(23, 'Shimono', 0, 4),
(24, 'Fred', 1, 3),
(25, 'Mitsuta', 1, 3),
(26, 'Niq', 1, 3),
(27, 'Soffnet', 0, 3),
(28, 'Asia', 1, 5),
(29, 'Hatari', 1, 5),
(30, 'Mitsubishi', 1, 5),
(31, 'Panasonic', 1, 5),
(32, 'Senko', 1, 5),
(33, 'Accessory', 1, 0),
(34, 'Accessories for fans', 1, 33),
(35, 'Fanimation', 0, 0),
(36, 'Fanimation ver2', 0, 35),
(37, 'Fanimation', 0, 0),
(38, 'Fanimation ver3', 0, 37),
(39, 'Panasonic', 0, 0),
(40, 'sunhouse', 0, 39),
(41, 'Panasonic123', 0, 0),
(42, 'sunhouse', 1, 41);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_orders`
--

CREATE TABLE `chi_tiet_orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `id_sp` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `tong_gia_tam_thoi` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_orders`
--

INSERT INTO `chi_tiet_orders` (`id`, `order_id`, `id_sp`, `so_luong`, `gia`, `tong_gia_tam_thoi`) VALUES
(1, 1, 1, 5, 225.00, 1125.00),
(2, 1, 3, 5, 58.00, 290.00),
(3, 2, 17, 9, 20000.00, 180000.00),
(4, 2, 19, 9, 365.00, 3285.00),
(5, 3, 7, 8, 22.00, 176.00),
(6, 3, 15, 7, 252.00, 1764.00),
(7, 3, 20, 8, 26000.00, 208000.00),
(8, 4, 9, 7, 125.00, 875.00),
(9, 4, 15, 7, 252.00, 1764.00),
(10, 5, 7, 6, 22.00, 132.00),
(11, 5, 1, 9, 225.00, 2025.00),
(12, 6, 7, 7, 22.00, 154.00),
(13, 6, 9, 13, 125.00, 1625.00),
(14, 7, 9, 10, 125.00, 1250.00),
(15, 7, 5, 7, 12.00, 84.00),
(16, 8, 6, 11, 32.00, 352.00),
(17, 8, 2, 8, 63.00, 504.00),
(18, 8, 8, 8, 20.00, 160.00),
(19, 8, 9, 9, 125.00, 1125.00),
(20, 9, 3, 10, 58.00, 580.00),
(21, 9, 6, 10, 32.00, 320.00),
(22, 9, 7, 8, 22.00, 176.00),
(23, 10, 7, 16, 22.00, 352.00),
(24, 10, 3, 8, 58.00, 464.00),
(25, 10, 9, 8, 125.00, 1000.00),
(26, 11, 15, 1, 252.00, 252.00),
(27, 11, 3, 5, 58.00, 290.00),
(28, 11, 5, 1, 12.00, 12.00),
(29, 11, 2, 7, 63.00, 441.00),
(30, 12, 8, 1, 20.00, 20.00),
(31, 12, 4, 1, 23.00, 23.00),
(32, 12, 1, 7, 225345.00, 1577415.00),
(33, 12, 2, 1, 63.00, 63.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_khach_hang` int(11) NOT NULL,
  `ngay_dat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tong_gia` decimal(10,2) NOT NULL,
  `ten_nguoi_nhan` varchar(20) NOT NULL,
  `so_dien_thoai` varchar(12) NOT NULL,
  `dia_chi` varchar(50) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `id_khach_hang`, `ngay_dat`, `tong_gia`, `ten_nguoi_nhan`, `so_dien_thoai`, `dia_chi`, `expiry_date`, `status`) VALUES
(1, 7, '2024-10-17 02:36:15', 1.00, 'Aptech', '0541513', 'Doi can ba dinh ha noi', '2024-11-16', 'Pending'),
(2, 7, '2024-10-17 05:52:33', 183.00, 'Tu nghiem', '86451526352', 'Doi Can ,Ba Dinh,Ha Noi', '2024-11-16', 'Pending'),
(3, 7, '2024-10-17 05:53:53', 209.00, 'Noname', '8545+65', 'hà nội', '2024-11-16', 'Pending'),
(4, 7, '2024-10-17 05:56:27', 2.00, 'jekw', '55555656', 'cat ba', '2024-11-16', 'Pending'),
(5, 11, '2024-10-17 05:58:55', 2.00, 'lili', '55555656', 'hà nội', '2024-11-16', 'Pending'),
(6, 11, '2024-10-17 05:59:41', 1.00, 'tu', '55555656', 'hà nội', '2024-11-16', 'Pending'),
(7, 11, '2024-10-17 06:00:22', 1.00, 'tu', '55555656', 'hà nội', '2024-11-16', 'Pending'),
(8, 11, '2024-10-17 06:01:06', 2.00, 'jekw', '565468854454', 'hà nội', '2024-11-16', 'Pending'),
(9, 11, '2024-10-17 06:01:51', 1.00, 'ádafdf', '565468854454', 'hà nội', '2024-11-16', 'Pending'),
(10, 11, '2024-10-17 06:02:24', 1.00, 'ádafdf', '565468854454', 'hà nội', '2024-11-16', 'Pending'),
(11, 11, '2024-10-17 09:16:51', 995.00, 'tu', '565468854454', 'hà nội', '2024-11-16', 'Pending'),
(12, 16, '2024-10-18 01:29:05', 1.00, 'tu', '564662645', 'hà nội', '2024-11-17', 'Pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `ten_sp` varchar(100) NOT NULL,
  `mo_ta_sp` text NOT NULL,
  `gia` decimal(9,0) NOT NULL,
  `so_luong_hang` int(11) NOT NULL,
  `id_danh_muc` int(11) NOT NULL,
  `images` varchar(200) NOT NULL,
  `hien_thi_sp` tinyint(4) NOT NULL DEFAULT 1,
  `cong_suat` varchar(50) NOT NULL,
  `cong_nghe` varchar(50) NOT NULL,
  `chat_lieu` varchar(50) NOT NULL,
  `chuc_nang` varchar(50) NOT NULL,
  `so_canh` varchar(50) NOT NULL,
  `toc_do` varchar(50) NOT NULL,
  `ngay_dang` timestamp NOT NULL DEFAULT current_timestamp(),
  `new_arrival` tinyint(1) DEFAULT 0,
  `featured` tinyint(1) DEFAULT 0,
  `best_seller` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `ten_sp`, `mo_ta_sp`, `gia`, `so_luong_hang`, `id_danh_muc`, `images`, `hien_thi_sp`, `cong_suat`, `cong_nghe`, `chat_lieu`, `chuc_nang`, `so_canh`, `toc_do`, `ngay_dang`, `new_arrival`, `featured`, `best_seller`) VALUES
(1, 'Kukan', 'Transform your living space with the perfect blend of style and comfort! Our ceiling fans offer powerful airflow while adding an elegant touch to any room. With energy-efficient motors and whisper-quiet operation, you can enjoy cool, refreshing air without disturbing the peace. Choose from a variety of designs and finishes to match your décor—whether you\'re updating your home or office, this ceiling fan is the ideal choice for year-round comfort.\r\n', 225345, 52, 11, '[\"..\\/upload\\/6710573db957e.jpg\",\"..\\/upload\\/6710573db96f8.jpg\",\"..\\/upload\\/6710573db9ad2.jpg\",\"..\\/upload\\/6710573db9bf7.jpg\",\"..\\/upload\\/6710573db9d21.jpg\",\"..\\/upload\\/6710573db9ee1.jpg\"]', 1, '150w', ' Inverter', 'Steal', 'Wind reversal function', '5 ', '2000 rounds per minute', '2024-10-17 00:15:57', 1, 1, 1),
(2, 'Kaiyo', 'Transform your living space with the perfect blend of style and comfort! Our ceiling fans offer powerful airflow while adding an elegant touch to any room. With energy-efficient motors and whisper-quiet operation, you can enjoy cool, refreshing air without disturbing the peace. Choose from a variety of designs and finishes to match your décor—whether you\'re updating your home or office, this ceiling fan is the ideal choice for year-round comfort.\r\n', 63, 5, 11, '[\"..\\/upload\\/6710665b3d61d.jpg\",\"..\\/upload\\/6710665b3d7bc.jpg\",\"..\\/upload\\/6710665b3d922.jpg\",\"..\\/upload\\/6710665b3da45.jpg\",\"..\\/upload\\/6710665b3db8c.jpg\",\"..\\/upload\\/6710665b3dc95.jpg\"]', 1, '120w', 'Inverter Technology', 'Metal (stainless steel, aluminum)', 'Reverse airflow function ,Timer function', '4', '2000 RPM in powerful fans', '2024-10-17 01:20:27', 1, 1, 1),
(3, 'Yama', 'Transform your living space with the perfect blend of style and comfort! Our ceiling fans offer powerful airflow while adding an elegant touch to any room. With energy-efficient motors and whisper-quiet operation, you can enjoy cool, refreshing air without disturbing the peace. Choose from a variety of designs and finishes to match your décor—whether you\'re updating your home or office, this ceiling fan is the ideal choice for year-round comfort.\r\n', 58, 69, 11, '[\"..\\/upload\\/671066be983a8.jpg\"]', 1, '15W - 50W', 'DC Motor Technology', 'Metal (stainless steel, aluminum)', 'Cooling mist function', '4', '2000 RPM in powerful fans', '2024-10-17 01:22:06', 1, 1, 1),
(4, 'Kaiyo Oka', 'Transform your living space with the perfect blend of style and comfort! Our ceiling fans offer powerful airflow while adding an elegant touch to any room. With energy-efficient motors and whisper-quiet operation, you can enjoy cool, refreshing air without disturbing the peace. Choose from a variety of designs and finishes to match your décor—whether you\'re updating your home or office, this ceiling fan is the ideal choice for year-round comfort.\r\n', 23, 2, 11, '[\"..\\/upload\\/67106720deaa1.jpg\"]', 1, 'Over 200W', 'Smart Technology (Smart Fans)', 'Wood', 'Air filter function', '5', '2500 RPM in powerful fans', '2024-10-17 01:23:44', 1, 1, 1),
(5, 'Kaiyo yama', '2. Industrial Fan\r\nNeed reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 34234, 25, 11, '[\"..\\/upload\\/671067ef7249e.jpg\"]', 1, ' 15W - 50W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', ' Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-17 01:27:11', 1, 1, 1),
(6, 'Kaiyo iwa', 'ransform your living space with the perfect blend of style and comfort! Our ceiling fans offer powerful airflow while adding an elegant touch to any room. With energy-efficient motors and whisper-quiet operation, you can enjoy cool, refreshing air without disturbing the peace. Choose from a variety of designs and finishes to match your décor—whether you\'re updating your home or office, this ceiling fan is the ideal choice for year-round comfort.\r\n\r\n', 32, 22, 11, '[\"..\\/upload\\/6710683734eda.jpg\",\"..\\/upload\\/6710683735104.jpg\"]', 1, '100W - 200W', 'Smart Technology (Smart Fans)', 'High-grade plastic (ABS, PP)', 'Cooling mist function', '5', ' 2000 RPM in powerful fans', '2024-10-17 01:28:23', 1, 1, 1),
(7, 'Kayo kiyo', 'Upgrade your cooling experience with our innovative steam fans. By combining powerful airflow with gentle misting, these fans offer an ultra-refreshing breeze perfect for hot days. Ideal for both indoor and outdoor use, they cool down your space quickly while adding moisture to the air, preventing dryness. Great for patios, greenhouses, or large rooms—experience the cooling power of a steam fan today!', 22, 14, 11, '[\"..\\/upload\\/6710688140485.jpg\"]', 1, '50W - 100W', 'Bladeless Fan Technology ,Remote Control Technolog', 'Wood', 'Sleep mode', '4', '2500 RPM in powerful fans', '2024-10-17 01:29:37', 1, 1, 1),
(8, 'Kaiyo yoko', 'Looking for a sleek, modern cooling solution? Our bladeless fans provide powerful airflow without the traditional spinning blades, making them safer for kids and pets. Their cutting-edge design not only looks stunning but also offers a quieter, more energy-efficient way to stay cool. Plus, with advanced air purification features, you can enjoy cleaner, fresher air in any room. Elevate your comfort with the next generation of cooling technology!\r\n', 20, 25, 11, '[\"..\\/upload\\/671068c6ce7ab.jpg\"]', 1, 'Over 200W', 'Smart Technology (Smart Fans)', 'Metal (stainless steel, aluminum)', 'Voice control', '4', '2000 RPM in powerful fans', '2024-10-17 01:30:46', 1, 1, 1),
(9, 'Kaiyo mika', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 125, 25, 11, '[\"..\\/upload\\/6710690d856aa.jpg\"]', 1, '100W - 200W', 'Temperature and Humidity Sensors', 'High-grade plastic (ABS, PP)', 'Sleep mode', '4', ' 2000 RPM in powerful fans', '2024-10-17 01:31:57', 1, 1, 1),
(10, 'Kaiyo ukan chib', 'Looking for a sleek, modern cooling solution? Our bladeless fans provide powerful airflow without the traditional spinning blades, making them safer for kids and pets. Their cutting-edge design not only looks stunning but also offers a quieter, more energy-efficient way to stay cool. Plus, with advanced air purification features, you can enjoy cleaner, fresher air in any room. Elevate your comfort with the next generation of cooling technology!\r\n', 45, 22, 11, '[\"..\\/upload\\/67106960e1c89.jpg\"]', 1, '50W - 100W', 'Smart Technology (Smart Fans)', 'High-grade plastic (ABS, PP)', 'Timer function', '4', '3000 RPM in powerful fans', '2024-10-17 01:33:20', 1, 1, 1),
(11, 'Kaiyi kiku', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 200, 52, 11, '[\"..\\/upload\\/67106a8dbfc3b.jpg\"]', 1, '50W - 100W', 'Temperature and Humidity Sensors', 'High-grade plastic (ABS, PP)', 'Timer function', '4', '2500 RPM in powerful fans', '2024-10-17 01:38:21', 1, 1, 1),
(12, 'Kaiyo ikik', 'Upgrade your cooling experience with our innovative steam fans. By combining powerful airflow with gentle misting, these fans offer an ultra-refreshing breeze perfect for hot days. Ideal for both indoor and outdoor use, they cool down your space quickly while adding moisture to the air, preventing dryness. Great for patios, greenhouses, or large rooms—experience the cooling power of a steam fan today!\r\n', 2000, 25, 11, '[\"..\\/upload\\/67106ba56f482.jpg\"]', 1, '50W - 100W', 'Temperature and Humidity Sensors', 'Wood', 'Reverse airflow function', '4', '3000 RPM in powerful fans', '2024-10-17 01:43:01', 1, 1, 1),
(13, 'Kaiyo okaa', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 62, 2, 11, '[\"..\\/upload\\/67106cce72c02.jpg\"]', 1, '100W - 200W', 'Cooling mist function', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '100W - 200W', '2024-10-17 01:47:58', 1, 1, 1),
(14, 'Kaiyo ADS', 'Upgrade your cooling experience with our innovative steam fans. By combining powerful airflow with gentle misting, these fans offer an ultra-refreshing breeze perfect for hot days. Ideal for both indoor and outdoor use, they cool down your space quickly while adding moisture to the air, preventing dryness. Great for patios, greenhouses, or large rooms—experience the cooling power of a steam fan today!\r\n\r\n', 2000, 25, 11, '[\"..\\/upload\\/67106d1845b70.jpg\"]', 1, '100W - 200W', 'Reverse airflow function', 'High-grade plastic (ABS, PP)', 'Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-17 01:49:12', 1, 1, 1),
(15, 'Benny SAD', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 252, 25, 20, '[\"..\\/upload\\/67106d7bf0763.jpg\",\"..\\/upload\\/67106d7bf0981.jpg\",\"..\\/upload\\/67106d7bf0c0f.jpg\",\"..\\/upload\\/67106d7bf0d7d.jpg\",\"..\\/upload\\/67106d7bf0ead.jpg\",\"..\\/upload\\/67106d7bf0fbb.jpg\"]', 1, '15W - 50W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '0', '2000 RPM in powerful fans', '2024-10-17 01:50:52', 1, 1, 1),
(16, 'Benny', 'Upgrade your cooling experience with our innovative steam fans. By combining powerful airflow with gentle misting, these fans offer an ultra-refreshing breeze perfect for hot days. Ideal for both indoor and outdoor use, they cool down your space quickly while adding moisture to the air, preventing dryness. Great for patios, greenhouses, or large rooms—experience the cooling power of a steam fan today!\r\n\r\n4. Bladeless Fan\r\n', 200000, 25, 20, '[\"..\\/upload\\/67106dd31fbca.jpg\",\"..\\/upload\\/67106dd31fe4f.jpg\",\"..\\/upload\\/67106dd32002d.jpg\",\"..\\/upload\\/67106dd32011f.jpg\",\"..\\/upload\\/67106dd3202b4.jpg\",\"..\\/upload\\/67106dd3203fd.jpg\"]', 1, '100W - 200W', 'Smart Technology (Smart Fans)', 'Metal (stainless steel, aluminum)', 'Air filter function', '4', '2000 RPM in powerful fans', '2024-10-17 01:52:19', 1, 1, 1),
(17, 'Kaiyi SDF', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 20000, 22, 11, '[\"..\\/upload\\/67106f2094cbb.jpg\"]', 1, '50W - 100W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '3000 RPM in powerful fans', '2024-10-17 01:57:52', 1, 1, 1),
(18, 'Kaiyo GFG', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 25665, 22, 11, '[\"..\\/upload\\/67106f41ae079.jpg\"]', 1, '100W - 200W', 'Temperature and Humidity Sensors', 'High-grade plastic (ABS, PP)', 'Reverse airflow function', '4', '2500 RPM in powerful fans', '2024-10-17 01:58:25', 1, 1, 1),
(19, 'Kaiyo Hi', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 365454, 3, 11, '[\"..\\/upload\\/67106f6ac1d1b.jpg\"]', 1, '50W - 100W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-17 01:59:06', 1, 1, 1),
(20, 'Kaiyo ẤGDFG', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 26000, 25, 11, '[\"..\\/upload\\/67106f8910823.jpg\"]', 1, '50W - 100W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '1120kmádas', '2024-10-17 01:59:37', 1, 1, 1),
(21, 'Kaiyo 434hf', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 2512, 25, 11, '[\"..\\/upload\\/67106fb05f9ba.jpg\"]', 1, '100W - 200W', 'Temperature and Humidity Sensors', 'High-grade plastic (ABS, PP)', 'Reverse airflow function', '5', '2000 RPM in powerful fans', '2024-10-17 02:00:16', 1, 1, 1),
(22, 'Kaiyo JNDNBV', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 256545, 2, 11, '[\"..\\/upload\\/67106fca5cdb8.jpg\"]', 1, '50W - 100W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-17 02:00:42', 1, 1, 1),
(23, 'Kaiyo blue', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 3621, 25, 11, '[\"..\\/upload\\/67106feb73126.jpg\"]', 1, '100W - 200W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-17 02:01:15', 1, 1, 1),
(24, 'Kaiyo', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 2055, 25, 11, '[\"..\\/upload\\/6710700ead66c.jpg\"]', 1, '100W - 200W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-17 02:01:50', 1, 1, 1),
(25, 'Kaiyo yama DF23', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!\r\n', 200000, 26, 14, '[\"..\\/upload\\/671078ef6d5a5.jpg\",\"..\\/upload\\/671078ef6d74f.jpg\",\"..\\/upload\\/671078ef6d99f.jpg\",\"..\\/upload\\/671078ef6dbb1.jpg\",\"..\\/upload\\/671078ef6dd8d.jpg\",\"..\\/upload\\/671078ef6dec4.jpg\"]', 0, '1000W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '43', '2000 RPM in powerful fans', '2024-10-17 02:39:06', 1, 1, 1),
(26, 'DFSD-asd', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!', 99954, 9, 11, '[\"..\\/upload\\/6711248e0b4e4.jpg\",\"..\\/upload\\/6711248e0b6ee.jpg\"]', 1, '100W - 200W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '1120kmádas', '2024-10-17 14:51:58', 1, 1, 1),
(27, 'Kaiyo GHG', 'Need reliable cooling for large spaces? Our industrial fans are built for durability and performance in tough environments. Whether you\'re working in a warehouse, factory, or outdoor event, these fans deliver maximum airflow to keep your space cool and ventilated. Designed to withstand heavy use, they\'re perfect for any commercial or industrial setting. Stay productive and comfortable even in the most demanding conditions!', 56456, 2, 3, '[\"..\\/upload\\/671125c41a5da.jpg\",\"..\\/upload\\/671125c41a838.jpg\"]', 1, '100W - 200W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-17 14:57:08', 1, 1, 1),
(28, 'Kaiyo 1106', 'aptech', 6441, 25, 11, '[\"..\\/upload\\/6711bb52b5793.jpg\",\"..\\/upload\\/6711bb52b5a27.jpg\",\"..\\/upload\\/6711bb52b5b7a.jpg\",\"..\\/upload\\/6711bb52b5c79.jpg\",\"..\\/upload\\/6711bb52b5d84.jpg\",\"..\\/upload\\/6711bb52b5f96.jpg\"]', 1, '100W - 200W', 'Temperature and Humidity Sensors', 'Metal (stainless steel, aluminum)', 'Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-18 01:34:38', 1, 1, 1),
(29, 'Sunhouse', 'hello aptech', 2625, 23, 16, '[\"..\\/upload\\/6711bdbe1126b.jpg\",\"..\\/upload\\/6711bdbe11696.jpg\",\"..\\/upload\\/6711bdbe11891.jpg\",\"..\\/upload\\/6711bdbe11a49.jpg\",\"..\\/upload\\/6711bdbe11bcb.jpg\",\"..\\/upload\\/6711bdbe11d20.jpg\"]', 0, '50W - 100W', 'Temperature and Humidity Sensors', 'High-grade plastic (ABS, PP)', 'Reverse airflow function', '4', '2000 RPM in powerful fans', '2024-10-18 01:44:55', 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `danh_gia` int(11) NOT NULL,
  `binh_luan` text NOT NULL,
  `ngay_bl` timestamp NOT NULL DEFAULT current_timestamp(),
  `hien_thi_bl` tinyint(4) NOT NULL DEFAULT 1,
  `id_san_pham` int(10) NOT NULL,
  `id_khach_hang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `review`
--

INSERT INTO `review` (`id`, `danh_gia`, `binh_luan`, `ngay_bl`, `hien_thi_bl`, `id_san_pham`, `id_khach_hang`) VALUES
(1, 5, 'Nice fan!!!', '2024-10-17 02:35:31', 1, 1, 7),
(2, 5, 'Great job !!!', '2024-10-17 05:07:10', 1, 6, 10),
(3, 2, 'The product shipped did not meet my expectations', '2024-10-17 05:08:15', 1, 16, 7),
(4, 5, 'Very good product', '2024-10-17 05:23:02', 1, 15, 7),
(5, 2, 'This fan was broken when it arrived to me', '2024-10-17 05:23:41', 1, 17, 7),
(6, 4, 'dgsfgsdfgsdfs', '2024-10-17 05:59:15', 0, 1, 11),
(7, 5, 'ghthrdgedfs', '2024-10-17 06:00:05', 1, 9, 11),
(8, 3, 'đfsbdvsdcádc', '2024-10-17 06:01:21', 1, 9, 11),
(9, 4, 'àadsfsdfsdf', '2024-10-17 09:07:23', 1, 8, 11),
(10, 5, 'exellent', '2024-10-17 22:24:08', 1, 2, 7),
(11, 5, 'exellent', '2024-10-17 22:24:12', 1, 2, 7),
(14, 5, 'Gread job!!!', '2024-10-18 01:27:40', 1, 1, 16);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `hien_thi_user` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `role`, `hien_thi_user`) VALUES
(2, 'admin', '$2y$10$2v7ZfHOYCjKoW/33eGdtved0pgRk5RtnrqcEETNUURrko0VctXY0S', 'tunghiem38@gmail.com', 1, 1),
(3, 'user', '$2y$10$n1AYTOvFBXAVBD4M7/Jw0O6If.Oh4sySo8EM2Ytzx1j3oXvVhTbAm', 'tunghiem43438@gmail.com', 0, 1),
(7, 'aptech', '$2y$10$eMb8V9ALgltbHAdJKBLv4.YNZariqQAbrW.5WFJpLt6zURC/7BC4.', 'Marketing@gmail.com', 0, 1),
(9, 'user123', '$2y$10$6rUs4Ksc08/mQzUZUFkP8ummrpPPZavLtY.q39odlRm6IZVxU2Zq6', 'Marketing23@gmail.com', 0, 1),
(10, 'user45', '$2y$10$mR0iTH/9EDAuxYlRCLobk.nzByFoJx6VHKvFlPlvNZg4dA6KAjSt6', 'tunghiem3843@gmail.com', 0, 1),
(11, 'lalala', '$2y$10$F1I6jIbDFDhUWS6AGxox3OsKSP2Jp.N64M3CwthwRP/c4.yZvTl8i', 'nghiemtugfg38@gmail.com', 0, 1),
(12, 'lafad', '$2y$10$fZe8ePvi0c19ngNktRZKkuXNZNZ1SUX6L.H9dMRAi/9GfLhRlQqrK', 'Marketing@gmail.com', 0, 1),
(13, 'aaaaaaaaaa', '$2y$10$51X.OSd.Q.Zps9sqiPyEaOI2riV9.SOfWr43Ve2fZeoC/KO3JFoxq', 'Marketing@gmail.com', 0, 0),
(14, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '$2y$10$men9qDLSeJcQDfD.s0/gt.1M5tnk0Ckbb687PhHtbqSnbzxbnHSye', 'tunghieddm38@gmail.com', 0, 0),
(16, 'today', '$2y$10$uhkCl0P8rOsDOQcIk46.le3Q19ScrNqWcKfBtNzdYzr63.BfjXn7m', 'tunghiem38@gmail.com', 0, 1),
(17, 'hello aptech', '$2y$10$NsFWdbfa..hhpVkkHJ/ePuwXbbXH.oc9m2BGZEEZR/jDAlgRHD4Lu', 'Marketin123g@gmail.com', 1, 1),
(18, 'hello aptech', '$2y$10$/ajFwPxE2SiGeTVdPmkV/OqXVsxprYf5iEAWh3uo9xLJivLLiOIC6', 'Marketin123g@gmail.com', 1, 1),
(19, 'hello', '$2y$10$rSLQul.08IEUVcuSKDtqNu9x8sDZv8BnraoFWd4FDOQZN81SNwDkm', 'Marke23ting@gmail.com', 0, 1),
(20, 'hello aptech', '$2y$10$rB4OWpkcn82xMRyYk0nihelF1MVjBCS1loesopeD/ntAApKGWw.oC', 'Marketing123@gmail.com', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chi_tiet_orders`
--
ALTER TABLE `chi_tiet_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `id_sp` (`id_sp`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_khach_hang` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_danh_muc` (`id_danh_muc`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_san_pham` (`id_san_pham`),
  ADD KEY `id_khach_hang` (`id_khach_hang`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_orders`
--
ALTER TABLE `chi_tiet_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chi_tiet_orders`
--
ALTER TABLE `chi_tiet_orders`
  ADD CONSTRAINT `chi_tiet_orders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `chi_tiet_orders_ibfk_2` FOREIGN KEY (`id_sp`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_san_pham`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_khach_hang`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
