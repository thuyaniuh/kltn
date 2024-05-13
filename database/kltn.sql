-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 13, 2024 lúc 03:38 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `kltn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(8) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`account_id`, `user_id`, `username`, `password`, `role_id`, `active_status`) VALUES
(1, 20018201, '20018201', 'b59c67bf196a4758191e42f76670ceba', 1, 1),
(7, 20028201, '20028201', 'b59c67bf196a4758191e42f76670ceba', 2, 1),
(8, 20054701, '20054701', 'b59c67bf196a4758191e42f76670ceba', 1, 0),
(9, 12345678, '12345678', 'b59c67bf196a4758191e42f76670ceba', 3, 1),
(10, 20031234, '20031234', 'b59c67bf196a4758191e42f76670ceba', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'Công nghệ thông tin'),
(2, 'CNTT');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `majors`
--

CREATE TABLE `majors` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`, `department_id`) VALUES
(1, 'Hệ thống thông tin', 1),
(2, 'Công nghệ thông tin', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `progress`
--

CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `report_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `registration`
--

CREATE TABLE `registration` (
  `registration_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `registration_date` datetime NOT NULL,
  `student_1` int(11) NOT NULL,
  `student_2` int(11) NOT NULL,
  `student_1_name` varchar(100) NOT NULL,
  `student_2_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `registration`
--

INSERT INTO `registration` (`registration_id`, `topic_id`, `registration_date`, `student_1`, `student_2`, `student_1_name`, `student_2_name`) VALUES
(5, 2, '2024-05-09 17:09:15', 20018201, 20054701, 'Nguyễn Thị Thúy An', 'Phương Lý Bảo Hân'),
(6, 2, '2024-05-09 17:12:51', 20018201, 20054701, 'Nguyễn Thị Thúy An', 'Phương Lý Bảo Hân'),
(7, 4, '2024-05-10 12:37:59', 20018201, 20054701, 'Nguyễn Thị Thúy An', 'Phương Lý Bảo Hân'),
(8, 10, '2024-05-10 12:40:27', 20018201, 20054701, 'Nguyễn Thị Thúy An', 'Phương Lý Bảo Hân'),
(9, 7, '2024-05-10 12:49:39', 20018201, 20054701, 'Nguyễn Thị Thúy An', 'Phương Lý Bảo Hân'),
(10, 11, '2024-05-10 12:51:48', 20018201, 20054701, 'Nguyễn Thị Thúy An', 'Phương Lý Bảo Hân'),
(12, 2, '2024-05-13 15:26:07', 20031234, 12345689, 'Nguyễn Thúy Duy', 'Trương Thị Hồng Nhung');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Sinh viên'),
(2, 'Giảng viên'),
(3, 'Chủ nhiệm bộ môn'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `scores`
--

CREATE TABLE `scores` (
  `score_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `score_value` float DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `topic_description` varchar(1000) DEFAULT NULL,
  `proposed_by` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `major_id` int(11) DEFAULT NULL,
  `results` varchar(500) DEFAULT NULL,
  `skill` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`, `topic_description`, `proposed_by`, `status`, `major_id`, `results`, `skill`) VALUES
(1, 'Ứng dụng blockchain trong kết nối giao dịch tài sản số trong quá trình đấu giá', 'Xây dựng ứng dụng đấu giá thời gian thực có kết nối với wallet thanh toán bằng tài sản số', 20028201, 'Chờ duyệt', 1, NULL, NULL),
(2, 'Ứng dụng blockchain trong quá trình xác thực avatar duy nhất trên mạng lưới mua bán thế hệ web 3.0', 'Xây dựng hệ thống kết nối xác thực tài sản số NFT', 20028201, 'Đã duyệt', 1, NULL, NULL),
(3, 'Trực quan hóa dữ liệu kinh tế số trên nền tảng Blockchain hỗ trợ tối ưu hóa lợi nhuận giao dịch tiền số', 'Xây dựng thuật toán tối ưu lợi nhuận trên các sàn giao dịch blockchain với tài sản số', 5, 'Chờ duyệt', 1, NULL, NULL),
(4, 'Xây dựng hệ thống quản lý công văn và tiến độ thực hiện công việc', '\"Hệ thống đáp ứng được các yêu cầu cơ bản sau: \r\n1.	Quản lý công văn đến và đi của đơn vị hành chính; \r\n2.	Kiểm soát quá trình thực hiện công việc theo các công văn đã ban hành:\r\na.	Công văn đến được gửi đến những phòng ban, cá nhân nào trong đơn vị hành chính? Công văn có cần phản hồi không? Ai là người phản hồi? Thời gian để phản hồi\r\nb.	Công văn đi được gửi đến đơn vị nào? Ai là người gửi? Đơn vị nhận có cần phản hồi công văn này không? \r\n\"\r\n', 20028201, 'Đã duyệt', 1, '\"Xây dựng hệ thống quản lý công văn', '\"Phân tích và thiết kế hệ thống; Xây dựng ứng dụng; Kỹ năng làm việc nhóm...\"'),
(5, 'Xây dựng hệ thống quản lý công văn và tiến độ thực hiện công việc', '\"Hệ thống đáp ứng được các yêu cầu cơ bản sau: \r\n1.	Quản lý công văn đến và đi của đơn vị hành chính; \r\n2.	Kiểm soát quá trình thực hiện công việc theo các công văn đã ban hành:\r\na.	Công văn đến được gửi đến những phòng ban, cá nhân nào trong đơn vị hành chính? Công văn có cần phản hồi không? Ai là người phản hồi? Thời gian để phản hồi\r\nb.	Công văn đi được gửi đến đơn vị nào? Ai là người gửi? Đơn vị nhận có cần phản hồi công văn này không? \r\n', 20028201, 'Đã duyệt', 1, '\"Xây dựng hệ thống quản lý công văn', '\"Phân tích và thiết kế hệ thống; Xây dựng ứng dụng; Kỹ năng làm việc nhóm...\"'),
(6, 'Xây dựng hệ thống quản lý công văn và tiến độ thực hiện công việc', '\"Phân tích và thiết kế hệ thống;\r\nXây dựng ứng dụng;\r\nKỹ năng làm việc nhóm...\"\r\n', 20028201, 'Chờ duyệt', 1, 'Xây dựng thành công hệ thống', '\"Phân tích và thiết kế hệ thống; Xây dựng ứng dụng; Kỹ năng làm việc nhóm...\"'),
(7, 'Phân tích quy trình nghiệp vụ   và triển khai hệ thống thương mại điện tử', 'Phân tích, so sánh các quy trình nghiệp vụ bán hàng và xây dựng hệ thống thương mại điện tử theo mô hình B2B hoặc B2C\r\n', 20028201, 'Đã duyệt', 1, 'Xác định được các yêu cầu của hệ thống, đưa ra các giải pháp, học hỏi/vận dụng kiến thức để thực hiện đề tài một cách kiên trì.', 'Chứng tỏ được khả năng tự học và vận dụng kiến thức; khả năng trình bày kết quả, viết báo cáo và email đúng quy chuẩn.'),
(9, 'Phân tích quy trình nghiệp vụ   và triển khai hệ thống thương mại điện tử', 'Phân tích, so sánh các quy trình nghiệp vụ bán hàng và xây dựng hệ thống thương mại điện tử theo mô hình B2B hoặc B2C\r\n', 20028201, 'Chờ duyệt', 1, 'Xác định được các yêu cầu của hệ thống, đưa ra các giải pháp, học hỏi/vận dụng kiến thức để thực hiện đề tài một cách kiên trì.', 'Chứng tỏ được khả năng tự học và vận dụng kiến thức; khả năng trình bày kết quả, viết báo cáo và email đúng quy chuẩn.'),
(10, 'Quản lý bán hàng cho siêu thị trên nền tảng Odoo', '\"- Tìm hiểu Odoo\r\n- Triển khai phân hệ quản lý bán  hàng áp dụng cho một siêu thị\"\r\n', 20028201, 'Đã duyệt', 1, '\"- nắm được các module và qui trình nghiệp vụ  của Odoo trong phân hệ qly bán hàng - PTTK đưa ra giải pháp phù hợp cho bài toán quản lý bán hàng của siêu thị - phát triển ứng dụng quản lý kho của siêu thị  dựa trên phân hệ qly bán hàng của Odoo\"', '- sử dụng được python, XML, postgreSQL'),
(11, 'Test nè', 'cũng test', 20028201, 'Đã duyệt', 1, 'sssss', 'sssss'),
(12, 'Test lại', 'aaaaa', 20028201, 'Đã duyệt', 1, 'aaaa', 'aaaa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birth` date NOT NULL,
  `gender` varchar(3) NOT NULL DEFAULT 'Nam',
  `image` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `major_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `name`, `birth`, `gender`, `image`, `email`, `address`, `major_id`) VALUES
(12345678, 'Trần Văn Cường', '1984-01-01', 'Nam', 'chunhiem.jpg', 'cuong@gmail.com', 'Gò Vấp', 1),
(20018201, 'Nguyễn Thị Thúy An', '2002-01-24', 'Nữ', 'thuyan.png', 'an@gmail.com', 'Gò Vấp,TPHCM', 1),
(20028201, 'Nguyễn Văn Bình', '1987-04-01', 'Nam', 'gv1.jpg', 'binh@gmail.com', 'Gò Vấp', 1),
(20031234, 'Nguyễn Thúy Duy', '2001-01-15', 'Nữ', 'thuyan.png', 'duy@gmail.com', 'Gò Vấp', 1),
(20054701, 'Phương Lý Bảo Hân', '2002-10-12', 'Nữ', 'hankhung.png', 'han@gmail.com', 'Thủ Đức', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Chỉ mục cho bảng `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Chỉ mục cho bảng `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`);

--
-- Chỉ mục cho bảng `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registration_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Chỉ mục cho bảng `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Chỉ mục cho bảng `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `major_id` (`major_id`),
  ADD KEY `proposed_by` (`proposed_by`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `major_id` (`major_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `registration`
--
ALTER TABLE `registration`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20058703;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
