-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 11, 2022 lúc 11:49 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `yengji`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `amount` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`user_id`, `product_id`, `amount`, `updated_at`, `created_at`) VALUES
(2, 16, 3, '2022-11-09 05:46:15', '2022-11-09 05:46:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `amount` int UNSIGNED NOT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `unit_price` double UNSIGNED DEFAULT NULL,
  `phone_number` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `amount`, `delivery_address`, `unit_price`, `phone_number`, `created_at`, `updated_at`) VALUES
(7, 2, 16, 2, 'gr5', 922000, 43, '2022-11-07 23:41:13', '2022-11-07 23:41:13'),
(8, 2, 2, 2, 'rg', 220000, 23, '2022-11-07 23:43:29', '2022-11-07 23:43:29'),
(9, 2, 17, 3, '4', 89000, 3, '2022-11-07 23:45:04', '2022-11-07 23:45:04'),
(10, 2, 2, 2, 'fr', 220000, 54, '2022-11-07 23:45:54', '2022-11-07 23:45:54'),
(11, 2, 16, 16, '3f3', 922000, 65, '2022-11-07 23:46:28', '2022-11-07 23:46:28'),
(12, 2, 16, 4, 'f', 922000, 3, '2022-11-07 23:47:05', '2022-11-07 23:47:05'),
(13, 2, 17, 3, 'gr', 89000, 43, '2022-11-07 23:48:03', '2022-11-07 23:48:03'),
(14, 2, 17, 3, '23', 89000, 26, '2022-11-07 23:52:44', '2022-11-07 23:52:44'),
(15, 2, 16, 3, 'ht56', 922000, 351, '2022-11-07 23:54:15', '2022-11-07 23:54:15'),
(16, 2, 18, 16, 'f', 256500, 4, '2022-11-07 23:54:57', '2022-11-07 23:54:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` double(15,0) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold` int UNSIGNED NOT NULL DEFAULT '0',
  `remaining` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` int UNSIGNED NOT NULL DEFAULT '0',
  `description` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `unit_price`, `image`, `sold`, `remaining`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Balo Laptop công sở nam nữ cao cấp, đựng máy tính, laptop, macbook 15.6 inch chống sốc, chống nước – BEE GEE BLLT9017', 401500, 'https://cf.shopee.vn/file/1f7bf379476244213eca2a7364aedf64_tn', 5, 95, 100, 'Kích thước : rộng 28m X cao 45.5cm X dày 15.7cm\r\n\r\nPhương pháp sản xuất: công nghệ cao\r\n\r\nChất liệu : Vải Canvas cao cấp mã hóa siêu chống nước\r\n\r\nChức năng: thoáng khí, chống mài mòn, dễ làm sáng, chống sốc\r\n\r\nThiết kế : trẻ trung ,sang trọng', '2022-11-03 04:12:38', '2022-11-07 11:31:21'),
(2, 'Sơ Mi Flannel Authentic 2Hand Tuyển Chọn', 220000, 'https://cf.shopee.vn/file/d1c51a6f7a1535ca21c3c56751f16294_tn', 5, 194, 199, '—Flannel Cotton Shirt Street & Casual Wear—\r\n\r\nChiếc áo Flannel trường tồn theo năm tháng, không bao giờ lỗi mốt bởi nó là một trong những item truyền nguồn cảm hứng tạo nên nhiều phong cách đối với thời trang hiện tại.\r\n\r\n———————\r\n🚩72T.Road - Vintage Street & Casual Wear\r\n📞Hotline: 0983.99.1994\r\nℹ️Instagram: 72t.road\r\n.\r\n#somikeflannel #somikeda #vintageflannelshirt', '2022-11-04 09:21:08', '2022-11-07 23:45:55'),
(16, 'Giày Bitis Hunter X Festive Frosty White DSWH03500TRG/DSMH03500TRG', 922000, '/uploads/d0ee245f823575bcfb5e85dd923532eb_tn.jpeg', 3, 107, 110, '👟Thiết kế đế mới cao hơn, êm hơn, \"chất\" hơn trên từng trải nghiệm. Thiết kế đế LiteFlex 2.0 chắc chắn sẽ khiến các bạn trẻ \"đổ gục\" với những màu sắc tươi mới hơn, hứa hẹn một đôi giày cực kỳ \"hot\" cuối năm 2020 này.\r\n\r\n👟Bộ đế LiteFlex 2.0\r\n- Chất liệu IP \"nhẹ như bay\" chỉ từ 204g\r\n- Chiều cao đế đạt tới 5 cm\r\n- Độ đàn hồi > 40%\r\n- Lớp cao su tăng ma sát\r\n\r\n👟Đế lót kháng khuẩn cùng công nghệ 6 điểm giúp Massage lòng bàn chân\r\n\r\n👟Mũ quai vải dệt cải tiến co giãn và thoáng khí\r\n\r\n**** Điều kiện và thời gian bảo hành:\r\n\r\nThời gian hỗ trợ bảo hành kể từ ngày mua hàng: 3 tháng kể từ ngày mua hàng.\r\n\r\nĐiều kiện áp dụng:\r\n\r\nKhách hàng mua sản phẩm Biti’s sẽ được bảo hành miễn phí đối với các trường hợp sau: Hở keo, dứt chỉ, gãy móc khoá, bung hoạ tiết trang trí (nơ, nút, hoa, …)\r\nKhi bảo hành khách hàng phải cung cấp hóa đơn (phiếu xuất hàng) và phiếu bảo hành của sản phẩm.\r\nThời gian xử lý bảo hành: Từ 1 đến 20 ngày làm việc kể từ ngày nhà máy nhận được sản phẩm tùy mức độ hư hỏng của giày dép.\r\nKhông hỗ trợ đối với những sản phẩm có thông báo: không áp dụng đổi trả - bảo hành.\r\nĐịa điểm tiếp nhận bảo hành:\r\n\r\nTại tất cả các cửa hàng tiếp thị của Biti’s trên toàn quốc. Danh sách cửa hàng tiếp thị tại đây\r\nKho online của Biti’s tại địa chỉ: 95/6 Trần Văn Kiểu, P.10, Q.6\r\nLưu ý:\r\n\r\nTrường hợp hết thời gian bảo hành, giày dép hư hỏng do hao mòn tự nhiên hoặc bị tác động mạnh từ bên ngoài CHTT tiếp nhận bảo hành tuy nhiên chi phí sửa chữa và vận chuyển khách hàng thanh toán.\r\nHàng chậm, Xu hướng chậm không được bảo hành.', '2022-11-07 07:01:37', '2022-11-07 23:54:15'),
(17, 'Áo Thun Polo Nam cổ bẻ WCBC vải Cá Sấu Cotton cao cấp – LEGEND', 89000, '/uploads/588ce397d07a35002e5d72782ea53563_tn.jpeg', 3, 12216, 12219, 'Áo thun Polo nam cổ dệt bo đang là sản phẩm Top 1 Polo Bán Chạy - Sự lựa chọn hoàn hảo cho phái mạnh với sự đơn giản, tiện lợi, lịch thiệp, khỏe khoắn và tinh tế\r\n+ LEG cam kết sản phẩm 100% thuộc bản quyền tự chụp ảnh thật tại Studio của Shop \r\n+ Sản phẩm được LEG phân phối độc quyền từ thương hiệu Chính Hãng cao cấp\r\n* Thông tin Sản phẩm Áo thun Polo nam cổ dệt :\r\n   - Chât liệu vải CVC Cotton pha Spandex cho độ dày dặn, co giãn tốt, giữ dáng khi mặc\r\n   - Bề mặt vải dệt mắt to vải cá sấu tạo sự dầy dặn lịch sự cho sản phẩm \r\n   - Công nghệ dệt sợi tiêu chuẩn được xử lý giúp chống tia UV và kháng khuẩn.\r\n   - Form áo thiết kế tiêu chuẩn lên form đẹp tạo sự thoải mái khi vận động\r\n   - Thương hiệu:  ( LEG phân phối độc quyền )\r\n   - Xuất xứ: Việt Nam\r\n* Màu sắc & kích cỡ  Áo thun Polo nam cổ dệt :\r\n   - Màu sắc : bộ 7 màu theo ảnh ( trắng - đen - be - nâu - xanh than - xám - rêu đậm )\r\n   - Kích thước : \r\n   + M : Chiều cao: dưới 1m70, Cân nặng: dưới 62kg.\r\n   + L : Chiều cao: 1m65-1m75, Cân nặng: 63~68kg.\r\n   + XL : Chiều cao: 1m70-1m80, Cân nặng: 69~76kg.\r\n   + XXL : Chiều cao: 1m73-1m85, Cân nặng: 77~85kg\r\n   (Gợi ý:Mẫu 1m76 - 65kg fit đẹp size L) \r\n   Liên hệ ngay với team CSKH của LEG để được hỗ trợ tư vấn size khi cần bạn nhé\r\n* Hướng dẫn sử dụng và bảo quản Áo thun Polo nam cổ dệt :\r\n   - Giặt ở nhiệt độ bình thường với chu kì ngắn\r\n   - Không được dùng hóa chất tẩy.\r\n   - Hạn chế sử dụng máy sấy ,ủi ở nhiệt độ thích hợp.\r\n   - Lộn mặt trái khi phơi tránh bị phai màu\r\nLEG CAM KẾT:\r\n   - Cam kết Áo thun Polo nam cổ dệt là sản phẩm chính hãng 100% giống mô tả. Hình ảnh sản độc quyền tự chụp \r\n   - Cam kết 100% đổi size nếu sản phẩm khách đặt không vừa ( khách hàng giữ nguyên Tem mác và chưa sử dụng)\r\n   - Cam kết hỗ trợ 100% chi phí nếu shop gửi sai sản phẩm tới khách hàng \r\n   - Cam kết hỗ trợ đổi sang sản phẩm khác cùng giá hoặc cao hơn nếu khách có nhu cầu đổi mẫu khác.\r\n   - Nếu có bất kì khiếu nại cần Shop hỗ trợ về sản phẩm, khi mở sản phẩm các Chị vui lòng quay lại video quá trình mở sản phẩm để được đảm bảo 100% đổi lại sản phẩm mới nếu Shop giao bị lỗi.\r\n   - Sản phẩm của LEG đầy đủ tem, mác, đóng gói bằng túi Zip thương hiệu đẹp có thể làm quà tặng\r\nLEG luôn có rất nhiều ƯU ĐÃI - bạn hãy Áp dụng đủ các mã để mua sản phẩm với giá tốt nhất nhé :\r\n   - Giá tốt hơn khi mua từ 2 sản phẩm\r\n   - Voucher của Shop \r\n   - Mua kèm Deal shock các sản phẩm HOT khác \r\n   - Freeship Extra toàn quốc\r\n   - Hoàn Xu Extra mọi đơn hàng\r\n 📌 LƯU Ý:  Khi bạn gặp bất kì vấn đề gì về sản phẩm đừng vội đánh giá mà hãy liên hệ Shop để đc hỗ trợ 1 cách tốt nhất nhé\r\n LEG xin cảm ơn bạn và mong bạn có trải nghiệm tốt nhất khi mua hàng tại Shop ạ.\r\n#aopolonam #aothunpolo #aothuncoco #aothunnam #LeoVatino #aothuncotton #aothun #aopolo #polo #cotton #nam #formrong #hanquoc #aodep #Galvin #thoitrang #freeship', '2022-11-07 18:01:10', '2022-11-07 23:52:44'),
(18, 'Áo sweater dệt kim cổ V dáng rộng dài tay thêu hình thời trang cổ điển 2021 cho nam nữ', 256500, '/uploads/edc4e8ce0181aaee5a053ea66550ae29.jpeg', 16, 11694, 11710, 'Nguồn hàng:\r\nMàu sắc: xanh nước biển, be\r\nDanh mục sản phẩm: Quần áo dệt kim\r\nHàm lượng thành phần vải chính: 90\r\nHàng có sẵn: Có\r\nPhù hợp với đám đông: thanh niên\r\nKích thước: S, M, L, XL, XXL, XXXL\r\nPhiên bản: Loose\r\nDanh mục mua hàng: Thanh niên bình dân (18-40 tuổi)\r\nLoại cổ áo: Cổ chữ V\r\nNguồn hàng xuyên biên giới: Có\r\nPhong cách: Thời trang\r\nĐộ dày: Bình thường\r\nMã số: SY Sweater 01#\r\nThương hiệu: Shengxing Horse\r\nTên vải: Cotton\r\nPhù hợp cho: giải trí\r\nĐối tượng áp dụng: thanh thiếu niên\r\nThành phần vải chính: cotton\r\n\r\nThương hiệu riêng với ủy quyền được cấp phép: Có\r\nDành cho: nam\r\nLoại hàng tồn kho: Toàn bộ đơn\r\nNhóm tuổi áp dụng: người lớn\r\nNăm / mùa niêm yết: Mùa thu 2020\r\nChiều dài tay áo: dài tay\r\nMùa phù hợp: Mùa đông\r\nChi tiết về chi tiết kiểu dáng: viền dưới có gân\r\nPhong cách: Phiên bản Hàn Quốc\r\nKhu vực bán hàng chính: Châu Phi, Châu Âu, Nam Mỹ, Đông Nam Á, Bắc Mỹ, Đông Bắc Á, Trung Đông\r\nQuy trình: xử lý không dùng sắt', '2022-11-07 18:04:25', '2022-11-07 23:54:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissionLevel` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `permissionLevel`, `updated_at`, `created_at`) VALUES
(1, 'Kha Minh Tran', 'abc@gmail.com', '$2y$10$cDezUJdXANxTtYCHBQxMM.8EuGXynAutPSNciGazaOV8RE9XAowC2', 2, '2022-11-02 11:04:24', '2022-11-02 11:04:24'),
(2, 'Hua Xuan Minh', 'hxm@gmail.com', '$2y$10$.pXmW48ugmw8qYvUyPdxleb0CzliQ9lStxmLmz2VuXx3jITLnc95a', 1, '2022-11-04 01:54:46', '2022-11-04 01:54:46'),
(3, 'b1909881', 'baob1909881@student.ctu.edu.vn', '$2y$10$ezcU5Ndqv3dxst6MsvaSD.Sj7T7EsrfK4WGHWWC7Vg0cu6phAuaCu', 1, '2022-11-10 00:55:42', '2022-11-10 00:55:42');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
