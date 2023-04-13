-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2023 a las 23:51:03
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `user_id`) VALUES
(1, 'Bootstrap', 0),
(2, 'Javascript', 0),
(3, 'PHP', 0),
(4, 'JavaScript', 0),
(18, 'Pythoner', 0),
(20, 'Brandoncete', 0),
(21, 'C++', 0),
(35, 'ruby', 24),
(36, 'CSharp', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(42, 95, 'Revellyon', 'brandoneldestructor@gmail.com', 'pROBANDO COSITAS', 'Approved', '2022-06-23'),
(43, 96, 'Muriel', 'doval@gmail.com', 'asasd', 'Approved', '2022-06-23'),
(44, 97, 'Revellyon', 'brandoneldestructor@gmail.com', 'uyerhrwehhre', 'Unapproved', '2022-06-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(16, 21, 94);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(94, 20, 'Brandon fin de año', '', 'Brandon', '2022-06-22', 'elegante.jpg', 'J. R. R. Tolkien planned The Lord of the Rings as a sequel to his earlier novel The Hobbit, but it ended up becoming a much more far-reaching and lengthy story which, written in stages between 1937 and 1949, was first published in the UK. between 1954 and 1955 in three volumes. Since then it has been reprinted numerous times and translated into many languages,2 becoming one of the most popular works of 20th century literature.3 In addition, it has been adapted several times for radio, theater and film. , mainly highlighting the film trilogy created by the New Zealand filmmaker Peter JacksonJ. R. R. Tolkien planned The Lord of the Rings as a sequel to his earlier novel The Hobbit, but it ended up becoming a much more far-reaching and lengthy story which, written in stages between 1937 and 1949, was first published in the UK. between 1954 and 1955 in three volumes. Since then it has been reprinted numerous times and translated into many languages,2 becoming one of the most popular works of 20th century literature.3 In addition, it has been adapted several times for radio, theater and film. , mainly highlighting the film trilogy created by the New Zealand filmmaker Peter Jacksonsdfsdfsdfsdfsdfsdfsdffsd', 'java, php, brandon, elegante', 0, 'Published', 176, 1),
(95, 18, 'Parkour en el bosque', '', 'Revellyon', '2022-06-22', 'brandonBosque.jpg', 'Corriendo y saltando obstáculos por el bosquecscasfasf', 'java, php, brandon, elegante', -2, 'Published', 11, 0),
(96, 2, 'Perro meme', '', 'Muriel', '2022-06-22', 'brandonmeme.jpg', 'Me estás diciendo que tiras los huesos después de comerte la carne?', 'java, php, brandon, elegante', 0, 'Published', 11, 0),
(97, 21, 'Saco sin fondo', '', 'Currupio', '2022-06-22', 'barriga.jpg', 'Primer paté de buey degustado, poco faltó para reventar esa panza', 'java, php, brandon, elegante', 0, 'Published', 5, 0),
(111, 18, 'Desgustacion de palo', '', 'Limoncio', '2022-06-22', 'IMG_20150713_205320961.jpg', 'Palo reseco al fino cesped', 'java, php, brandon, elegante', 0, 'Published', 2, 0),
(112, 21, 'Batería muerrta', '', 'Cacafuti', '2022-06-22', 'IMG_20170428_012211.jpg', 'sfsafas', 'java, php, brandon, elegante', 0, 'Published', 16, 0),
(149, 1, 'Probando Likes', '', 'Muriel', '2022-06-22', '', 'dasdasdasd', 'java, php, brandon, elegante', 0, 'Published', 13, 0),
(150, 1, 'Porbando author', '', 'Revellyon', '2022-06-23', 'Screenshot_1.png', 'asdasd', 'java, php, brandon, elegante', 0, 'Draft', 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(21, 'Muriel', '$2y$10$Z0K9bvP.Ej2/xRWGyTtIbeyavFzu7tNLQmjLegxXb6G0W.sQo3ZHK', 'Carlos', 'Nieto', 'doval@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22', '76f8001806833fed0d0818f4614866b69eced0d7f359aed8e04cba7bf9e6c22e5a01546e8bedc2a64b6173074ef5784b0806'),
(24, 'Revellyon', '$2y$10$iusesomecrazystrings2uGtDpLi/sz8giU0Qqyz0jXbOCxzug3S6', 'Martin', 'Conde', 'brandoneldestructor@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(40, 'MartinCG', '$2y$12$MnLnTzoG69sQp9kLEx4qSuo5wcPv9NfL3jBOxWHrdTOWaWu.G4pYC', '', '', 'martincondegrande90@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22', 'bbe4179f5f80c6a0e380cab182f8afb83ebfdeb596bb9ee1a0c3cdc4086fbeaead979c3575652e3cae987e058be11e3baaef');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'et58s68b10q9vutvav2aq2mbiq', 1655222177),
(2, 'rqu3e140cn0pcsslk73qfql83p', 1655208409),
(3, 'mttq05hg61qqf1nkoh7q9m5a36', 1655213213),
(4, '3858bbvk3qabl1avuffm4k6jmn', 1655216174),
(5, 'akm4e1r9rl84iu7m3kgp57tngp', 1655309017),
(6, 'r9jhuaik7s72s97j4rdjn4cmi8', 1655322269),
(7, 'ke7arm8575lt6c9vphaamd6qeg', 1655414049),
(8, 'affbk9apk5s8vjqh0jjgkp292s', 1655505708),
(9, '98r8k7k7jfo8oerto7ir7i1rnp', 1655752045),
(10, 'qu494nfiso3n7hkhaftqtg0ka2', 1655848848),
(11, 'fu06fim3g0eak5m79btcgdnt32', 1655914279),
(12, 'apme1g07pqb3l35m1uj3mlqg56', 1656016401),
(13, 'oeeb8qdq4kj82au0d96b7tgh6k', 1671751356),
(14, 'uv8sdh2uv54fm7lfl8vta1ml19', 1681413036),
(15, 'krlj8rvt6hficbufinismoes6v', 1681419601);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indices de la tabla `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
