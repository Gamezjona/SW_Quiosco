-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: MYSQL5035.site4now.net
-- Generation Time: Nov 21, 2024 at 02:29 PM
-- Server version: 5.6.26-log
-- PHP Version: 8.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aaf49d_quiosco`
--

-- --------------------------------------------------------

--
-- Table structure for table `contenido`
--

CREATE TABLE `contenido` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `enlace` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contenido`
--

INSERT INTO `contenido` (`id`, `titulo`, `categoria`, `descripcion`, `imagen`, `enlace`) VALUES
(2, 'Jujutsu Kaisen', 'Manga', ' narra la historia de Yuji Itadori, un estudiante de secundaria que se ve envuelto en el mundo de la brujería tras ser atacado por una maldición en su escuela', 'https://tiendapanini.com.mx/media/catalog/product/Q/J/QJUJU001.jpg?optimize=medium&bg-color=255,255,255&fit=bounds&height=897&width=960&canvas=960:897', '2wCEAAkGBxMTEhUSExMWFhUXFxcYGBcYGB0aHRgaIBoYGhoZHRsaHSggGBomHRcYITEhJSkrLjEuGiAzODMtNygtLisBCgoKDg0OGxAQGzUlICUtLS0vLS0tLi0vLy4tLy0tLS0vMC0tLS0tLy01LS01LS0tLS0tLS0tLS8vLS0vLS0tLf'),
(3, 'Monster', 'Manga', ' narra la historia de un neurocirujano japonés que se ve envuelto en una serie de asesinatos relacionados con un paciente al que salvó la vida', 'https://m.media-amazon.com/images/I/815xJbtOVfL.AC_UF894,1000_QL80.jpg', 'http://link-al-articulo.com');

-- --------------------------------------------------------

--
-- Table structure for table `contenido_user`
--

CREATE TABLE `contenido_user` (
  `usuario_id` int(11) NOT NULL,
  `sub_status` tinyint(1) NOT NULL,
  `show_cont` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patrocinadores`
--

CREATE TABLE `patrocinadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `giro` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patrocinadores`
--

INSERT INTO `patrocinadores` (`id`, `nombre`, `giro`) VALUES
(1, 'Poliworks', 'Tecnología'),
(2, 'Banamex', 'Finanzas'),
(3, 'Nat Geo Education', 'Educación');

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE `planes` (
  `sub` varchar(100) NOT NULL,
  `costo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`sub`, `costo`) VALUES
('Free', 0),
('Premium', 19.99);

-- --------------------------------------------------------

--
-- Table structure for table `subscripciones`
--

CREATE TABLE `subscripciones` (
  `id` int(11) NOT NULL,
  `sub` varchar(100) NOT NULL,
  `estatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscripciones`
--

INSERT INTO `subscripciones` (`id`, `sub`, `estatus`) VALUES
(2, 'premium', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `password`) VALUES
(1, 'Kevin', 'Valero', 'eduardo-cofe@hotmail.com', '12345678a'),
(2, 'Mariana', 'Alvarez', 'mariana.alvareze@alumno.buap.mx', '12345678a'),
(3, 'Angel', 'Sanchez', 'mariana21607@gmail.com', '$2y$10$.u2YO/pqPiiFD2i37fhf/O3P1gqN5diJFGZYya6mX4tgrgsjwSAl6'),
(4, 'kevin', 'camaño', 'kavinpuebla@gmail.com', 'siera252'),
(5, 'Juan', 'Juarez', 'juan23@gmail.com', '6513');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contenido_user`
--
ALTER TABLE `contenido_user`
  ADD PRIMARY KEY (`usuario_id`,`sub_status`),
  ADD KEY `sub_status` (`sub_status`);

--
-- Indexes for table `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`sub`);

--
-- Indexes for table `subscripciones`
--
ALTER TABLE `subscripciones`
  ADD PRIMARY KEY (`id`,`sub`),
  ADD KEY `estatus` (`estatus`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contenido_user`
--
ALTER TABLE `contenido_user`
  ADD CONSTRAINT `contenido_user_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `contenido_user_ibfk_2` FOREIGN KEY (`sub_status`) REFERENCES `subscripciones` (`estatus`);

--
-- Constraints for table `subscripciones`
--
ALTER TABLE `subscripciones`
  ADD CONSTRAINT `subscripciones_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
