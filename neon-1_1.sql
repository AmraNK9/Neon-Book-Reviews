-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2023 at 03:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neon-1.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `auther`
--

CREATE TABLE `auther` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auther`
--

INSERT INTO `auther` (`id`, `name`, `profile`, `image`) VALUES
(12, 'Casper Zaw', 'နိမ့်ချမနေပါနဲ့ ခင်ဗျားက အဲ့လောက် လဲ ကြီးမြတ်မနေပါဘူး', 'IMG_20230413_122929.jpg'),
(13, 'ဖေမြင့်', 'အစိုးရနဲ့ ပုဂ္ဂလိက meda တွေ ယှဉ်ပြိုင်ခြင်း မရှိစေရ', 'ဖေမြင့်.jpeg'),
(14, 'ညီနောင်', 'Humanist, Skeptic, Anti-Religious, Militant Atheist, Bright, Non-Believer, De-bunker', '315062205_139425535520009_2698365813960835358_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `auther_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `preview` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `auther_id`, `date`, `image`, `pdf_file`, `preview`) VALUES
(15, 'The Art Of Good Life', 12, '1970-01-01', 'TheArtOfGoodLife.jpeg', 'The art of the good life.pdf', ''),
(16, 'You Are Not So Smart', 12, '1970-01-01', 'you-are-not-so-smart.jpeg', 'you are not so smart.pdf', ''),
(17, 'The Art Of Thinking Clearly', 12, '1970-01-01', 'The Art Of Thinking Clearly.jpeg', 'The Art of Thinking Clearly.pdf', ''),
(18, '36 strategies', 12, '1970-01-01', '36.jpeg', '36 strategies.pdf', ''),
(19, 'ဆေပီယာန်စ်', 14, '1970-01-01', 'humoSapien.jpeg', 'ဆေပီယာန်စ်.pdf', ''),
(20, 'ဉီးနှောက်တွင်ရင်းနှီးမြုပ်နှံပါ', 13, '1970-01-01', 'ဦးနှောက်တွင်ရင်းနှီးမြုပ်နှံပါ.jpg', 'ဦးနှောက်တွင်ရင်းနှီးမြုပ်နှံပါ.pdf', ''),
(21, 'ဂျီးနီးရပ်စ်', 13, '1970-01-01', 'ဂျီးနီးရပ်စ်.jpg', 'ဂျီးနီးရပ်းစ်.pdf', ''),
(22, 'စိတ်၏စွမ်းအားသတ္တိများ', 13, '1970-01-01', 'စိတ်၏စွမ်းအားသတ္တိများ.jpg', 'စိတ်၏စွမ်းအားသတ္တိများ.pdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`id`, `book_id`, `category_id`) VALUES
(20, 16, 1),
(21, 15, 1),
(22, 17, 1),
(23, 18, 1),
(27, 20, 1),
(28, 19, 1),
(29, 19, 5),
(30, 21, 1),
(31, 22, 1),
(32, 22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `book_comment`
--

CREATE TABLE `book_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_mark`
--

CREATE TABLE `book_mark` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_mark`
--

INSERT INTO `book_mark` (`id`, `book_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 1, 3),
(6, 3, 3),
(7, 2, 4),
(8, 4, 4),
(9, 1, 5),
(10, 3, 5),
(11, 3, 11),
(12, 2, 11),
(13, 9, 12),
(14, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `book_rating`
--

CREATE TABLE `book_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_rating`
--

INSERT INTO `book_rating` (`id`, `user_id`, `book_id`, `rating`) VALUES
(2, 1, 1, 4),
(3, 2, 1, 3),
(4, 3, 2, 5),
(5, 1, 3, 4),
(6, 4, 2, 4),
(7, 2, 3, 4),
(8, 3, 1, 5),
(9, 4, 3, 3),
(10, 1, 2, 4),
(11, 2, 2, 3),
(12, 13, 18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Philosophy'),
(4, 'Psychology'),
(5, 'History'),
(9, 'Technology\r\n'),
(10, 'Poetry');

-- --------------------------------------------------------

--
-- Table structure for table `editor_choice`
--

CREATE TABLE `editor_choice` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `editor_choice`
--

INSERT INTO `editor_choice` (`id`, `book_id`) VALUES
(15, 15),
(14, 16),
(13, 17),
(12, 18),
(11, 19);

-- --------------------------------------------------------

--
-- Table structure for table `love_auther`
--

CREATE TABLE `love_auther` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `auther_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_book`
--

CREATE TABLE `review_book` (
  `id` int(11) NOT NULL,
  `user_review_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_book`
--

INSERT INTO `review_book` (`id`, `user_review_id`, `book_id`) VALUES
(25, 2, 15),
(26, 2, 16),
(27, 2, 19);

-- --------------------------------------------------------

--
-- Table structure for table `review_comment`
--

CREATE TABLE `review_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_book_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_react`
--

CREATE TABLE `review_react` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_book_id` int(11) NOT NULL,
  `love` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `image`, `bio`) VALUES
(1, 'John Doe', 'john@example.com', 'password123', 'john_profile.jpg', 'I am John Doe.'),
(2, 'Jane Smith', 'jane@example.com', 'password456', 'jane_profile.jpg', 'Hello, I am Jane Smith.'),
(8, 'Olivia Thomas', 'olivia@example.com', 'passwordmno', 'olivia_profile.jpg', 'Bio information for Olivia Thomas.'),
(9, 'William Anderson', 'william@example.com', 'passwordpqr', 'william_profile.jpg', 'About William Anderson.'),
(11, 'Nay Myo Thant', 'ny437myo@gmail.com', 'asdfasdf', '', ''),
(12, 'Nay Myo Thant', 'Aye@gmail.com', 'asdfasdf', '', ''),
(13, 'Nay Myo Thant', 'naymyo1310mdy@gmail.com', 'NayMyo1234', 'user.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

CREATE TABLE `user_review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`id`, `user_id`, `content`, `date`) VALUES
(2, 13, '      ဒီနှစ်ဖတ် ဖြစ်တဲ့ အထဲ မှာ သဘော အတွေ့ ဆုံး ၃ အုပ်', '2023-09-12 17:56:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auther`
--
ALTER TABLE `auther`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auther_id` (`auther_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `book_comment`
--
ALTER TABLE `book_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `book_mark`
--
ALTER TABLE `book_mark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `book_rating`
--
ALTER TABLE `book_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `editor_choice`
--
ALTER TABLE `editor_choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `love_auther`
--
ALTER TABLE `love_auther`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `auther_id` (`auther_id`);

--
-- Indexes for table `review_book`
--
ALTER TABLE `review_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_review_id` (`user_review_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `review_comment`
--
ALTER TABLE `review_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `review_book_id` (`review_book_id`);

--
-- Indexes for table `review_react`
--
ALTER TABLE `review_react`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_book_id` (`review_book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_review`
--
ALTER TABLE `user_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auther`
--
ALTER TABLE `auther`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `book_comment`
--
ALTER TABLE `book_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `book_mark`
--
ALTER TABLE `book_mark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `book_rating`
--
ALTER TABLE `book_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `editor_choice`
--
ALTER TABLE `editor_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `love_auther`
--
ALTER TABLE `love_auther`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `review_book`
--
ALTER TABLE `review_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `review_comment`
--
ALTER TABLE `review_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `review_react`
--
ALTER TABLE `review_react`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_review`
--
ALTER TABLE `user_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_comment`
--
ALTER TABLE `book_comment`
  ADD CONSTRAINT `book_comment_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `editor_choice`
--
ALTER TABLE `editor_choice`
  ADD CONSTRAINT `editor_choice_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `love_auther`
--
ALTER TABLE `love_auther`
  ADD CONSTRAINT `love_auther_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `love_auther_ibfk_2` FOREIGN KEY (`auther_id`) REFERENCES `auther` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_react`
--
ALTER TABLE `review_react`
  ADD CONSTRAINT `review_react_ibfk_1` FOREIGN KEY (`review_book_id`) REFERENCES `review_book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_react_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
