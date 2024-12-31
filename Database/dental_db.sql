-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 09:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image`) VALUES
('lETbdcSVVBehpDG8D3p9', 'Muktadir', 'm@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '7AOcZ63qeKl4fUrtKe78.jpg'),
('OwpcuntOIFL6LVxyMBeZ', 'Md. Rohan Islam', 'rr@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '7SVWw9t2cVmKBX6hvfoW.jpg'),
('tFhQB4mSJLNQInsIljrW', 'Rohan Ruhso', 'r@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 'IqxrqgZz2pUKY5jHen9v.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'booked',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `name`, `number`, `email`, `service_id`, `employee_id`, `date`, `time`, `price`, `status`, `payment_status`) VALUES
(1, 'cgPGQ8FSNrKvOgBmNnXo', 'New User', '14686514', 'er@hotmal.omc', 'lYRa465lJuxiiRVmM85i', 'PAPqGYelyQLEpq1QfEjP', '2025-01-01', '3:00pm', '0', 'pending', 'unpaid'),
(2, 'cgPGQ8FSNrKvOgBmNnXo', 'New User', '14686514', 'er@hotmal.omc', 'lYRa465lJuxiiRVmM85i', 'xljnMkGINWYUktIy1Ven', '2025-01-01', '2:00pm', '0', 'pending', 'unpaid'),
(3, 'T1wITdAFLxgV2GfBwFC7', 'Rohan Rusho', '765476', 'xodahi2018@nongnue.com', 'd3vnOi2wiSUsdJ6y9zfJ', 'FYLqdu4w8Z55gXph2JRW', '2025-01-03', '12:00pm', '0', 'pending', 'unpaid'),
(4, 'cgPGQ8FSNrKvOgBmNnXo', 'New User', '56767', 'r@hotmal.omc', 'lYRa465lJuxiiRVmM85i', 'MtztEBjv0qZ7UTMJvAEw', '2024-12-31', '5:00pm', '0', 'pending', 'unpaid'),
(5, 'cgPGQ8FSNrKvOgBmNnXo', 'ykyk 789', '658', 'kisicon817@pixdd.com', 'lYRa465lJuxiiRVmM85i', 'bx7fZ3SZVJcEF2D66INx', '2024-12-31', '11:00am', '0', 'pending', 'unpaid'),
(6, 'cgPGQ8FSNrKvOgBmNnXo', 'New User', '67567', 'er@hotmal.omc', 'lYRa465lJuxiiRVmM85i', 'Awrv85xtJ4KMrhV7JTlz', '2024-12-31', '6:00pm', '0', 'pending', 'unpaid'),
(7, 'cgPGQ8FSNrKvOgBmNnXo', 'New User', '67567', 'r@hotmal.omc', 'lYRa465lJuxiiRVmM85i', 'Awrv85xtJ4KMrhV7JTlz', '2024-12-31', '6:00pm', '0', 'pending', 'unpaid'),
(8, 'iAjR3oqY2NpzNMQ0epz8', 'New User', '567', 'r@hotmal.omc', 'MBwMdXNvD5is2xHM2Maj', 'MtztEBjv0qZ7UTMJvAEw', '2025-01-01', '3:00pm', '0', 'pending', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `profile_dec` text NOT NULL,
  `profile` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `profession`, `email`, `number`, `profile_dec`, `profile`, `status`) VALUES
('Awrv85xtJ4KMrhV7JTlz', 'Dr. Olivia Johnson', 'Dentist (Periodontist)', 'olivia.johnson@dentalcare.com', '65555678901', 'Dr. Johnson specializes in gum disease treatment and implant-supported prosthetics. She has a reputation for delivering exceptional care and long-term oral health solutions.', 'hero-img.png', 'active'),
('bx7fZ3SZVJcEF2D66INx', 'Morshed Niaz', 'Oral Surgeon', 'niaz@gmail.com', '01846484667', '', 'WhatsApp Image 2024-11-24 at 03.06.20_dd460540.jpg', 'active'),
('FYLqdu4w8Z55gXph2JRW', 'Tasnia Tahsin Fateha', 'lazy', 'lazy.tas@gmail.com', '01745433454', '', 'WhatsApp Image 2024-11-24 at 03.11.24_512cc585.jpg', 'active'),
('MtztEBjv0qZ7UTMJvAEw', 'Rohan', 'Sargent', 'rusho.rohan@gmail.com', '01719688186', 'Details:....', 'formal.jpg', 'active'),
('PAPqGYelyQLEpq1QfEjP', 'Abdullah Al Mahmud Joy', 'psyco', 'psyco@joy.com', '01682068401', 'oneeeeeeeeeeeeeeeekkkk psycooooooooooooooo', 'WhatsApp Image 2024-11-24 at 03.04.48_a514d0b9.jpg', 'active'),
('xljnMkGINWYUktIy1Ven', 'Rohan Ruhso', 'Dentist (Cosmetic Specialist)', 'rusho.rohan@gmail.com', '07179688186', 'oneeeeeeeekkkk  clean;', 'replicate-prediction-ctam67rqzhrge0cjb0384rzsyw.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `subject`, `message`) VALUES
('2', '124', 'Jane Smith', 'janesmith@example.com', 'Request for an Appointment', 'I would like to book an appointment for a routine check-up. Please let me know the available slots.'),
('3', '128', 'আরিফ হোসেন', 'arif.hossain@example.com', 'চমৎকার সেবা!', 'ক্লিনিকে এসে আমি অত্যন্ত সন্তুষ্ট। চিকিৎসক ও স্টাফের আচরণ ছিল খুব ভালো। চিকিৎসাও অনেক কার্যকর ছিল। ধন্যবাদ!'),
('5', '130', 'সাব্বির রহমান', 'sabbir.rahman@example.com', 'দাঁতের চিকিৎসা নিয়ে প্রশ্ন', 'আমি দাঁতের ক্যাভিটি নিয়ে সমস্যায় আছি। দয়া করে আমাকে চিকিৎসার বিস্তারিত জানাবেন।'),
('67740cddc68b6', 'cgPGQ8FSNrKvOgBmNnXo', 'New User', 'r@hotmal.omc', 'tt', 'Hiii');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `service_details` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `image`, `service_details`, `status`) VALUES
('d3vnOi2wiSUsdJ6y9zfJ', 'Teeth Whiting', 150, 'service1.png', 'A professional cleaning to remove plaque, tartar, and stains from teeth. Helps prevent cavities and gum disease.\r\nPrice Range: $50–$150 per session.', 'active'),
('fTl7X3O2aozFCbIRhr6l', 'Root Canal Treatment', 340, 'service5.png', 'A procedure to remove infected pulp inside the tooth, clean the canals, and seal them to save the natural tooth.\r\nPrice Range: $500–$1,500 per tooth', 'deactive'),
('lYRa465lJuxiiRVmM85i', 'Teeth Change', 599, 'service2.png', 'Its a great ', 'active'),
('MBwMdXNvD5is2xHM2Maj', 'Dental Fillings', 300, 'services-4.webp', 'Used to restore decayed or damaged teeth by filling cavities with materials like composite resin, amalgam, or porcelain.\r\nPrice Range: $50–$300 per tooth, depending on the material used.', 'active'),
('mgq3HtLvnlAwBaagbxAR', 'Kids Service', 100, 'service4.png', 'New  scsd', 'active'),
('Pj1xmmzl7ntMtKzN31sq', 'Teeth Whitening', 220, 'services-9.webp', 'A cosmetic procedure to brighten teeth and remove stains caused by coffee, smoking, or aging. Includes in-office whitening or take-home kits.\r\nPrice Range: $200–$500 per treatment.', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('123', 'John Doe', 'johndoe@example.com', '', ''),
('124', 'Jane Smith', 'janesmith@example.com', '', ''),
('128', 'আরিফ হোসেন', 'arif.hossain@example.com', '', ''),
('129', 'মিতা সাহা', 'mita.saha@example.com', '', ''),
('130', 'সাব্বির রহমান', 'sabbir.rahman@example.com', '', ''),
('131', 'রাহেলা পারভিন', 'rahela.parvin@example.com', '', ''),
('132', 'নাহিদ আলম', 'nahid.alam@example.com', '', ''),
('cgPGQ8FSNrKvOgBmNnXo', 'New User', 'er@hotmal.omc', '8aefb06c426e07a0a671a1e2488b4858d694a730', 'FLWyjezFRRcFOTda4X2S.JPG'),
('ecoNIefVwg2UXzXiBN2H', 'Abdullah Al Mahmud Joy', 'abd@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 'QxiHWKCpnlXdULUa1hjF.png'),
('fKno3F1In1p7t9uPKrDQ', 'Limon', 'r@gmail.com', '8bd7954c40c1e59a900f71ea3a266732609915b1', 'vl8Ndu08JTtoKdRL7IFi.webp'),
('iAjR3oqY2NpzNMQ0epz8', 'Limon', 'l@gmail.com', '8aefb06c426e07a0a671a1e2488b4858d694a730', 'VZe7rEGjWeortAzSicn9.JPG'),
('T1wITdAFLxgV2GfBwFC7', 'Rohan Ruhso', 'rr1@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 'aP2AIlqavuS37AVwL9sB.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointments_employee_id` (`employee_id`),
  ADD KEY `fk_appointments_service_id` (`service_id`),
  ADD KEY `fk_appointments_user_id` (`user_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointments_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
