-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 May 2025, 22:56:27
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `library_system`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `category`, `stock`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Novel', 3),
(2, 'Dune', 'Frank Herbert', 1965, 'Science Fiction', 0),
(3, 'The Alchemist', 'Paulo Coelho', 1988, 'Novel', 1),
(4, 'The Little Prince', 'Antoine de Saint-Exupéry', 1943, 'Story', 3),
(5, 'The Hobbit', 'J.R.R. Tolkien', 1937, 'Fantastic', 1),
(6, '1984', 'George Orwell', 1949, 'Novel', 3),
(7, 'Pride and Prejudice', 'Jane Austen', 1813, 'Novel', 0),
(8, 'Foundation', 'Isaac Asimov', 1951, 'Science Fiction', 4),
(9, 'Crime and Punishment', 'Fyodor Dostoevsky', 1866, 'Novel', 4),
(10, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 1997, 'Fantastic', 3),
(11, 'Neuromancer', 'William Gibson', 1984, 'Science Fiction', 5),
(12, 'A Brief History of Time', 'Stephen Hawking', 1988, 'Popular Science', 5),
(14, 'The Selfish Gene', 'Richard Dawkins', 1976, 'Populer Science', 4),
(15, 'Cosmos', 'Carl Sagan', 1980, 'Populer Science', 4),
(16, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 2011, 'Biography', 7),
(17, 'The Elegant Universe', 'Brian Greene', 1999, 'Populer Science', 3),
(18, 'Atomic Habits', 'James Clear', 2018, 'Personal Development', 6),
(19, 'The Selfish Gene', 'Richard Dawkins', 1976, 'Populer Science', 4),
(20, 'Cosmos', 'Carl Sagan', 1980, 'Populer Science', 4),
(21, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 2011, 'Biography', 6),
(22, 'The Elegant Universe', 'Brian Greene', 1999, 'Populer Science', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(4, 'hello', 'hello@email.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2025-05-11 18:47:59'),
(7, 'hell', 'hell@email.com', 'e6757959da8eff84c42d4df125b44eb40143dff452afd56aea5cfa058f245028', '2025-05-12 10:38:36'),
(8, 'jack', 'jack@email.com', 'd92050d6bf4434dc336a99151af94e90f379a100364de9dafcfc5e12a15dbbe3', '2025-05-12 12:45:08'),
(9, 'mary', 'mary@email.com', 'f485d699d21b459aadd6db5ebc036ea4710bbe6eea1a0402a48cc74d06fb9bc1', '2025-05-12 12:51:41'),
(10, 'david', 'david@email.com', 'dfa306de6542d8c6411dc074e4f3b79ea5ac7898bec016cef428624be38252c0', '2025-05-15 07:41:22'),
(11, 'july', 'july@email.com', '84ad454a9130bc7718ccbb3758a3d2a0c4710befba72a5c0c997f406e70bc550', '2025-05-15 08:26:58'),
(12, 'alex', 'alex@email.com', '24f873f5cc7c4661b75b6564ff0c71c77a99b59255cc57927d8417eca984fc03', '2025-05-16 15:13:12');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_books`
--

CREATE TABLE `user_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user_books`
--

INSERT INTO `user_books` (`id`, `user_id`, `book_id`) VALUES
(6, 4, 1),
(11, 7, 7),
(12, 7, 1),
(13, 7, 2),
(14, 7, 4),
(15, 7, 3),
(16, 8, 5),
(21, 10, 4),
(22, 8, 4),
(24, 8, 2),
(26, 9, 5),
(27, 9, 1),
(29, 11, 3),
(30, 11, 4),
(32, 9, 10),
(33, 10, 17),
(34, 12, 7),
(35, 12, 10),
(36, 12, 21),
(37, 10, 5);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `user_books`
--
ALTER TABLE `user_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `user_books`
--
ALTER TABLE `user_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `user_books`
--
ALTER TABLE `user_books`
  ADD CONSTRAINT `user_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
