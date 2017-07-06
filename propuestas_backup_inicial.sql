-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2017 at 09:32 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propuestas`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `certificationsReport` ()  NO SQL
SELECT Proyect.id, Proyect.codigo, Proyect.tipo, Departament.name, Payment.nombre_banco, Payment.numero_cuenta, Payment.tipo_cuenta, Payment.fecha_solicitud, Payment.fecha_desembolso, Payment.calificacion_final, Certification.cdp, Certification.rp, Certification.poblacion, Certification.valor
FROM certifications Certification
LEFT JOIN payments Payment ON Payment.id = Certification.payment_id
LEFT JOIN proyects Proyect ON Proyect.id = Payment.proyect_id
LEFT JOIN departaments Departament ON Departament.id = Proyect.departament_id
WHERE 1
ORDER BY Proyect.codigo ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proyectsReport` ()  NO SQL
select 
proyect.codigo, proyect.tipo, proyect.id, 
evaluation.fecha_concepto_final, evaluation.contrapartida, evaluation.cofinanciacion, evaluation.otras_fuentes, evaluation.cofinanciador,
resolution.numero, resolution.fecha, resolution.tipo, resolution.id,
payment.fecha_solicitud, payment.fecha_desembolso, payment.asociation_id, payment.id, payment.numero_cuenta, payment.nombre_banco,
branch.nombre,
beneficiary.nombres, beneficiary.primer_apellido, beneficiary.segundo_apellido, beneficiary.numero_identificacion,
asociation.nombre, asociation.nit
from proyects proyect 
left join evaluations evaluation on evaluation.proyect_id = proyect.id 
left join resolutions resolution on resolution.proyect_id = proyect.id 
left join payments payment on payment.proyect_id = proyect.id 
left join branches branch on proyect.branch_id = branch.id
left join asociations asociation on asociation.id = payment.asociation_id
left join beneficiaries beneficiary on beneficiary.id = payment.beneficiary_id
where evaluation.id = (
select max(e.id) from evaluations e where e.proyect_id = proyect.id group by e.proyect_id ) 
and resolution.id = (select max(r.id) from resolutions r where r.proyect_id = proyect.id and r.tipo = "ADJUDICACIÓN" group by r.proyect_id)
and payment.id = (select max(p.id) from payments p where p.proyect_id = proyect.id group by p.proyect_id)
order by branch.nombre ASC, proyect.codigo ASC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `entity_id`, `name`) VALUES
(8, 9, 'edit'),
(7, 9, 'add'),
(6, 9, 'index'),
(9, 9, 'delete'),
(10, 10, 'edit'),
(11, 11, 'add'),
(12, 11, 'delete'),
(13, 11, 'edit'),
(14, 11, 'index'),
(15, 12, 'add'),
(16, 12, 'delete'),
(17, 12, 'edit'),
(18, 12, 'index'),
(19, 13, 'add'),
(20, 13, 'delete'),
(21, 13, 'edit'),
(22, 13, 'index'),
(23, 13, 'add_conyuge'),
(24, 13, 'view'),
(25, 14, 'delete'),
(26, 14, 'edit'),
(27, 14, 'index'),
(28, 15, 'add'),
(29, 15, 'edit'),
(30, 15, 'index'),
(31, 16, 'add'),
(32, 16, 'edit'),
(33, 16, 'index'),
(34, 16, 'requirements_index'),
(35, 17, 'add'),
(36, 17, 'edit'),
(37, 17, 'index'),
(38, 18, 'add'),
(39, 18, 'delete'),
(40, 18, 'index'),
(41, 18, 'edit'),
(42, 18, 'select'),
(43, 19, 'add'),
(44, 19, 'edit'),
(45, 19, 'index'),
(171, 20, 'add'),
(170, 20, 'index'),
(48, 21, 'add'),
(49, 21, 'edit'),
(50, 21, 'index'),
(51, 22, 'add'),
(52, 22, 'delete'),
(53, 22, 'edit'),
(54, 22, 'index'),
(55, 23, 'add'),
(56, 23, 'delete'),
(57, 23, 'edit'),
(58, 23, 'index'),
(59, 23, 'concepto_final'),
(60, 24, 'add'),
(61, 24, 'delete'),
(62, 24, 'edit'),
(63, 24, 'index'),
(64, 24, 'baseline_index'),
(65, 24, 'poll_index'),
(66, 24, 'view'),
(67, 25, 'add'),
(68, 25, 'delete'),
(69, 25, 'edit'),
(70, 25, 'index'),
(71, 26, 'edit'),
(72, 27, 'edit'),
(73, 28, 'add'),
(74, 28, 'delete'),
(75, 28, 'edit'),
(76, 28, 'index'),
(77, 29, 'add'),
(78, 29, 'delete'),
(79, 29, 'edit'),
(80, 29, 'index'),
(81, 29, 'admin_ver'),
(82, 29, 'logout'),
(83, 29, 'ver'),
(84, 31, 'add'),
(85, 31, 'delete'),
(86, 31, 'edit'),
(87, 31, 'index'),
(88, 32, 'admin_index'),
(89, 32, 'denied'),
(90, 32, 'display'),
(91, 32, 'home'),
(92, 33, 'add'),
(93, 33, 'delete'),
(94, 33, 'edit'),
(95, 33, 'index'),
(96, 34, 'add_property'),
(97, 34, 'delete'),
(98, 34, 'edit_property'),
(99, 34, 'index'),
(100, 34, 'select'),
(101, 34, 'upload_files'),
(102, 34, 'view'),
(103, 34, 'view_files'),
(104, 35, 'add'),
(105, 35, 'edit'),
(106, 35, 'index'),
(107, 35, 'search'),
(108, 35, 'select'),
(109, 35, 'select_proyect'),
(110, 35, 'select_proyect2'),
(111, 36, 'add'),
(112, 36, 'delete'),
(113, 36, 'edit'),
(114, 36, 'index'),
(115, 37, 'add'),
(116, 37, 'edit'),
(117, 37, 'index'),
(118, 38, 'add'),
(119, 38, 'comunication_letter'),
(120, 38, 'delete'),
(121, 38, 'edit'),
(122, 38, 'index'),
(123, 38, 'print_letter'),
(124, 39, 'add'),
(125, 39, 'delete'),
(126, 39, 'edit'),
(127, 39, 'index'),
(128, 40, 'add'),
(129, 40, 'delete'),
(130, 40, 'edit'),
(131, 40, 'index'),
(132, 40, 'view'),
(133, 41, 'add'),
(134, 41, 'delete'),
(135, 41, 'edit'),
(136, 41, 'index'),
(137, 42, 'add'),
(138, 42, 'delete'),
(139, 42, 'edit'),
(140, 42, 'index'),
(141, 43, 'add'),
(142, 43, 'delete'),
(143, 43, 'index'),
(144, 44, 'add'),
(145, 44, 'add_users'),
(146, 44, 'admin_login'),
(147, 44, 'beforeFilter'),
(148, 44, 'delete'),
(149, 44, 'edit'),
(150, 44, 'edit_user'),
(151, 44, 'index'),
(152, 44, 'list_users'),
(153, 44, 'login'),
(154, 44, 'logout'),
(155, 44, 'send'),
(156, 45, 'index'),
(157, 45, 'add'),
(158, 45, 'view'),
(159, 45, 'delete'),
(160, 45, 'edit'),
(161, 46, 'index'),
(162, 46, 'add'),
(163, 46, 'delete'),
(164, 47, 'add'),
(165, 47, 'edit'),
(166, 47, 'delete'),
(167, 47, 'pdf'),
(168, 47, 'index'),
(169, 32, 'error'),
(172, 20, 'edit'),
(173, 20, 'delete'),
(174, 13, 'select'),
(175, 32, 'reports'),
(176, 34, 'report'),
(177, 13, 'report'),
(178, 35, 'report'),
(179, 32, 'message'),
(180, 45, 'dates'),
(181, 48, 'index'),
(182, 48, 'delete'),
(183, 48, 'add'),
(184, 48, 'edit'),
(185, 13, 'delete_file'),
(186, 34, 'delete_file'),
(187, 47, 'report'),
(188, 52, 'add'),
(189, 52, 'edit'),
(190, 52, 'index'),
(191, 52, 'delete'),
(192, 50, 'add'),
(193, 50, 'edit'),
(194, 50, 'index'),
(195, 50, 'delete'),
(196, 49, 'add'),
(197, 49, 'edit'),
(198, 49, 'index'),
(199, 49, 'delete'),
(200, 53, 'add'),
(201, 53, 'edit'),
(202, 53, 'index'),
(203, 53, 'delete'),
(204, 51, 'add'),
(205, 51, 'edit'),
(206, 51, 'index'),
(207, 51, 'delete'),
(208, 35, 'view'),
(209, 12, 'select'),
(210, 54, 'add'),
(211, 54, 'delete'),
(212, 54, 'index'),
(213, 55, 'index'),
(214, 55, 'add'),
(215, 55, 'edit'),
(216, 55, 'delete'),
(217, 56, 'index'),
(218, 56, 'add'),
(219, 56, 'delete'),
(220, 12, 'socio_organizacional'),
(221, 35, 'componente_tecnico'),
(222, 35, 'condiciones_biofisicas'),
(223, 35, 'componente_comercial'),
(224, 35, 'componente_ambiental'),
(225, 35, 'indicadores_organizacion'),
(226, 12, 'representante'),
(227, 20, 'select');

-- --------------------------------------------------------

--
-- Table structure for table `actions_groups`
--

CREATE TABLE `actions_groups` (
  `action_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions_groups`
--

INSERT INTO `actions_groups` (`action_id`, `group_id`, `id`) VALUES
(226, 1, 12134),
(225, 1, 12133),
(224, 1, 12132),
(223, 1, 12131),
(222, 1, 12130),
(221, 1, 12129),
(220, 1, 12128),
(219, 1, 12127),
(218, 1, 12126),
(217, 1, 12125),
(216, 1, 12124),
(215, 1, 12123),
(214, 1, 12122),
(213, 1, 12121),
(212, 1, 12120),
(211, 1, 12119),
(210, 1, 12118),
(209, 1, 12117),
(208, 1, 12116),
(207, 1, 12115),
(206, 1, 12114),
(205, 1, 12113),
(204, 1, 12112),
(203, 1, 12111),
(202, 1, 12110),
(201, 1, 12109),
(200, 1, 12108),
(199, 1, 12107),
(198, 1, 12106),
(197, 1, 12105),
(196, 1, 12104),
(195, 1, 12103),
(194, 1, 12102),
(193, 1, 12101),
(192, 1, 12100),
(191, 1, 12099),
(190, 1, 12098),
(189, 1, 12097),
(188, 1, 12096),
(187, 1, 12095),
(186, 1, 12094),
(185, 1, 12093),
(184, 1, 12092),
(183, 1, 12091),
(182, 1, 12090),
(181, 1, 12089),
(180, 1, 12088),
(179, 1, 12087),
(178, 1, 12086),
(177, 1, 12085),
(176, 1, 12084),
(175, 1, 12083),
(174, 1, 12082),
(173, 1, 12081),
(172, 1, 12080),
(169, 1, 12079),
(168, 1, 12078),
(167, 1, 12077),
(166, 1, 12076),
(165, 1, 12075),
(164, 1, 12074),
(163, 1, 12073),
(162, 1, 12072),
(161, 1, 12071),
(160, 1, 12070),
(159, 1, 12069),
(158, 1, 12068),
(157, 1, 12067),
(156, 1, 12066),
(155, 1, 12065),
(154, 1, 12064),
(153, 1, 12063),
(152, 1, 12062),
(151, 1, 12061),
(150, 1, 12060),
(149, 1, 12059),
(148, 1, 12058),
(147, 1, 12057),
(146, 1, 12056),
(145, 1, 12055),
(144, 1, 12054),
(143, 1, 12053),
(142, 1, 12052),
(141, 1, 12051),
(140, 1, 12050),
(139, 1, 12049),
(138, 1, 12048),
(137, 1, 12047),
(136, 1, 12046),
(135, 1, 12045),
(134, 1, 12044),
(133, 1, 12043),
(132, 1, 12042),
(131, 1, 12041),
(130, 1, 12040),
(129, 1, 12039),
(128, 1, 12038),
(127, 1, 12037),
(126, 1, 12036),
(125, 1, 12035),
(124, 1, 12034),
(123, 1, 12033),
(122, 1, 12032),
(121, 1, 12031),
(120, 1, 12030),
(119, 1, 12029),
(118, 1, 12028),
(117, 1, 12027),
(116, 1, 12026),
(115, 1, 12025),
(114, 1, 12024),
(113, 1, 12023),
(112, 1, 12022),
(111, 1, 12021),
(110, 1, 12020),
(109, 1, 12019),
(108, 1, 12018),
(107, 1, 12017),
(106, 1, 12016),
(105, 1, 12015),
(104, 1, 12014),
(103, 1, 12013),
(102, 1, 12012),
(101, 1, 12011),
(100, 1, 12010),
(99, 1, 12009),
(98, 1, 12008),
(97, 1, 12007),
(96, 1, 12006),
(95, 1, 12005),
(94, 1, 12004),
(93, 1, 12003),
(92, 1, 12002),
(91, 1, 12001),
(90, 1, 12000),
(89, 1, 11999),
(88, 1, 11998),
(87, 1, 11997),
(86, 1, 11996),
(85, 1, 11995),
(84, 1, 11994),
(83, 1, 11993),
(82, 1, 11992),
(81, 1, 11991),
(80, 1, 11990),
(79, 1, 11989),
(78, 1, 11988),
(77, 1, 11987),
(76, 1, 11986),
(75, 1, 11985),
(181, 17, 8592),
(187, 16, 9223),
(180, 17, 8591),
(179, 17, 8590),
(178, 17, 8589),
(177, 17, 8588),
(176, 17, 8587),
(175, 17, 8586),
(174, 17, 8585),
(169, 17, 8584),
(168, 17, 8583),
(167, 17, 8582),
(166, 17, 8581),
(165, 17, 8580),
(164, 17, 8579),
(160, 17, 8578),
(158, 17, 8577),
(157, 17, 8576),
(156, 17, 8575),
(155, 17, 8574),
(154, 17, 8573),
(153, 17, 8572),
(179, 16, 9222),
(178, 16, 9221),
(177, 16, 9220),
(176, 16, 9219),
(175, 16, 9218),
(174, 16, 9217),
(169, 16, 9216),
(168, 16, 9215),
(167, 16, 9214),
(158, 16, 9213),
(156, 16, 9212),
(155, 16, 9211),
(154, 16, 9210),
(153, 16, 9209),
(151, 16, 9208),
(150, 16, 9207),
(140, 16, 9206),
(136, 16, 9205),
(127, 16, 9204),
(179, 15, 9151),
(123, 16, 9203),
(122, 16, 9202),
(119, 16, 9201),
(114, 16, 9200),
(110, 16, 9199),
(174, 15, 9150),
(173, 15, 9149),
(172, 15, 9148),
(169, 15, 9147),
(160, 15, 9146),
(158, 15, 9145),
(157, 15, 9144),
(156, 15, 9143),
(155, 15, 9142),
(154, 15, 9141),
(153, 15, 9140),
(150, 15, 9139),
(147, 15, 9138),
(143, 15, 9137),
(142, 15, 9136),
(141, 15, 9135),
(140, 15, 9134),
(139, 15, 9133),
(138, 15, 9132),
(137, 15, 9131),
(136, 15, 9130),
(135, 15, 9129),
(134, 15, 9128),
(133, 15, 9127),
(127, 15, 9126),
(126, 15, 9125),
(125, 15, 9124),
(124, 15, 9123),
(123, 15, 9122),
(122, 15, 9121),
(121, 15, 9120),
(120, 15, 9119),
(119, 15, 9118),
(118, 15, 9117),
(117, 15, 9116),
(116, 15, 9115),
(115, 15, 9114),
(114, 15, 9113),
(113, 15, 9112),
(112, 15, 9111),
(111, 15, 9110),
(110, 15, 9109),
(109, 15, 9108),
(108, 15, 9107),
(107, 15, 9106),
(106, 15, 9105),
(105, 15, 9104),
(104, 15, 9103),
(103, 15, 9102),
(102, 15, 9101),
(101, 15, 9100),
(100, 15, 9099),
(99, 15, 9098),
(98, 15, 9097),
(97, 15, 9096),
(96, 15, 9095),
(95, 15, 9094),
(94, 15, 9093),
(93, 15, 9092),
(92, 15, 9091),
(91, 15, 9090),
(90, 15, 9089),
(89, 15, 9088),
(88, 15, 9087),
(87, 15, 9086),
(86, 15, 9085),
(85, 15, 9084),
(84, 15, 9083),
(66, 15, 9082),
(65, 15, 9081),
(64, 15, 9080),
(63, 15, 9079),
(62, 15, 9078),
(61, 15, 9077),
(60, 15, 9076),
(59, 15, 9075),
(58, 15, 9074),
(57, 15, 9073),
(56, 15, 9072),
(55, 15, 9071),
(50, 15, 9070),
(74, 1, 11984),
(49, 15, 9069),
(48, 15, 9068),
(170, 15, 9067),
(171, 15, 9066),
(42, 15, 9065),
(41, 15, 9064),
(40, 15, 9063),
(39, 15, 9062),
(38, 15, 9061),
(34, 15, 9060),
(33, 15, 9059),
(27, 15, 9058),
(26, 15, 9057),
(25, 15, 9056),
(24, 15, 9055),
(23, 15, 9054),
(22, 15, 9053),
(21, 15, 9052),
(20, 15, 9051),
(187, 18, 9354),
(109, 16, 9198),
(108, 16, 9197),
(107, 16, 9196),
(186, 18, 9353),
(185, 18, 9352),
(184, 18, 9351),
(183, 18, 9350),
(182, 18, 9349),
(181, 18, 9348),
(180, 18, 9347),
(179, 18, 9346),
(178, 18, 9345),
(177, 18, 9344),
(176, 18, 9343),
(175, 18, 9342),
(174, 18, 9341),
(173, 18, 9340),
(172, 18, 9339),
(169, 18, 9338),
(168, 18, 9337),
(167, 18, 9336),
(166, 18, 9335),
(165, 18, 9334),
(164, 18, 9333),
(163, 18, 9332),
(162, 18, 9331),
(161, 18, 9330),
(160, 18, 9329),
(158, 18, 9328),
(157, 18, 9327),
(156, 18, 9326),
(155, 18, 9325),
(154, 18, 9324),
(153, 18, 9323),
(151, 18, 9322),
(150, 18, 9321),
(143, 18, 9320),
(142, 18, 9319),
(141, 18, 9318),
(140, 18, 9317),
(139, 18, 9316),
(138, 18, 9315),
(137, 18, 9314),
(136, 18, 9313),
(135, 18, 9312),
(134, 18, 9311),
(133, 18, 9310),
(127, 18, 9309),
(126, 18, 9308),
(125, 18, 9307),
(124, 18, 9306),
(123, 18, 9305),
(122, 18, 9304),
(121, 18, 9303),
(120, 18, 9302),
(119, 18, 9301),
(118, 18, 9300),
(114, 18, 9299),
(113, 18, 9298),
(112, 18, 9297),
(111, 18, 9296),
(110, 18, 9295),
(109, 18, 9294),
(108, 18, 9293),
(107, 18, 9292),
(106, 18, 9291),
(105, 18, 9290),
(104, 18, 9289),
(103, 18, 9288),
(102, 18, 9287),
(101, 18, 9286),
(100, 18, 9285),
(99, 18, 9284),
(98, 18, 9283),
(97, 18, 9282),
(96, 18, 9281),
(95, 18, 9280),
(94, 18, 9279),
(93, 18, 9278),
(92, 18, 9277),
(19, 15, 9050),
(73, 1, 11983),
(91, 18, 9276),
(90, 18, 9275),
(89, 18, 9274),
(88, 18, 9273),
(87, 18, 9272),
(86, 18, 9271),
(85, 18, 9270),
(84, 18, 9269),
(66, 18, 9268),
(65, 18, 9267),
(151, 17, 8571),
(150, 17, 8570),
(149, 17, 8569),
(64, 18, 9266),
(63, 18, 9265),
(62, 18, 9264),
(72, 1, 11982),
(71, 1, 11981),
(70, 1, 11980),
(69, 1, 11979),
(18, 15, 9049),
(68, 1, 11978),
(140, 17, 8568),
(61, 18, 9263),
(67, 1, 11977),
(66, 1, 11976),
(65, 1, 11975),
(60, 18, 9262),
(59, 18, 9261),
(58, 18, 9260),
(57, 18, 9259),
(136, 17, 8567),
(127, 17, 8566),
(122, 17, 8565),
(114, 17, 8564),
(110, 17, 8563),
(109, 17, 8562),
(108, 17, 8561),
(107, 17, 8560),
(106, 17, 8559),
(103, 17, 8558),
(102, 17, 8557),
(17, 15, 9048),
(16, 15, 9047),
(15, 15, 9046),
(64, 1, 11974),
(63, 1, 11973),
(62, 1, 11972),
(61, 1, 11971),
(60, 1, 11970),
(106, 16, 9195),
(103, 16, 9194),
(14, 15, 9045),
(99, 17, 8556),
(98, 17, 8555),
(91, 17, 8554),
(90, 17, 8553),
(56, 18, 9258),
(55, 18, 9257),
(50, 18, 9256),
(49, 18, 9255),
(59, 1, 11969),
(13, 15, 9044),
(102, 16, 9193),
(89, 17, 8552),
(48, 18, 9254),
(99, 16, 9192),
(170, 18, 9253),
(171, 18, 9252),
(42, 18, 9251),
(41, 18, 9250),
(95, 16, 9191),
(91, 16, 9190),
(90, 16, 9189),
(58, 1, 11968),
(12, 15, 9043),
(89, 16, 9188),
(87, 17, 8551),
(40, 18, 9249),
(87, 16, 9187),
(57, 1, 11967),
(56, 1, 11966),
(66, 16, 9186),
(63, 16, 9185),
(63, 17, 8550),
(58, 17, 8549),
(39, 18, 9248),
(38, 18, 9247),
(55, 1, 11965),
(176, 20, 6667),
(175, 20, 6666),
(174, 20, 6665),
(173, 20, 6664),
(172, 20, 6663),
(155, 20, 6662),
(154, 20, 6661),
(153, 20, 6660),
(150, 20, 6659),
(110, 20, 6658),
(109, 20, 6657),
(108, 20, 6656),
(107, 20, 6655),
(106, 20, 6654),
(105, 20, 6653),
(104, 20, 6652),
(103, 20, 6651),
(102, 20, 6650),
(101, 20, 6649),
(100, 20, 6648),
(99, 20, 6647),
(98, 20, 6646),
(97, 20, 6645),
(96, 20, 6644),
(95, 20, 6643),
(94, 20, 6642),
(93, 20, 6641),
(92, 20, 6640),
(91, 20, 6639),
(90, 20, 6638),
(89, 20, 6637),
(24, 20, 6636),
(23, 20, 6635),
(22, 20, 6634),
(21, 20, 6633),
(20, 20, 6632),
(19, 20, 6631),
(18, 20, 6630),
(17, 20, 6629),
(16, 20, 6628),
(54, 1, 11964),
(58, 16, 9184),
(54, 17, 8548),
(30, 18, 9246),
(15, 20, 6627),
(50, 17, 8547),
(45, 17, 8546),
(27, 18, 9245),
(26, 18, 9244),
(25, 18, 9243),
(54, 16, 9183),
(50, 16, 9182),
(170, 16, 9181),
(53, 1, 11963),
(11, 15, 9042),
(45, 16, 9180),
(40, 17, 8545),
(24, 18, 9242),
(89, 19, 6669),
(179, 20, 6668),
(90, 19, 6670),
(91, 19, 6671),
(179, 19, 6672),
(40, 16, 9179),
(37, 16, 9178),
(30, 16, 9177),
(27, 16, 9176),
(24, 16, 9175),
(22, 16, 9174),
(18, 16, 9173),
(23, 18, 9241),
(52, 1, 11962),
(22, 17, 8544),
(22, 18, 9240),
(21, 17, 8543),
(18, 17, 8542),
(21, 18, 9239),
(20, 18, 9238),
(19, 18, 9237),
(18, 18, 9236),
(51, 1, 11961),
(50, 1, 11960),
(49, 1, 11959),
(48, 1, 11958),
(17, 17, 8541),
(170, 1, 11957),
(171, 1, 11956),
(45, 1, 11955),
(17, 18, 9235),
(14, 16, 9172),
(187, 17, 8593),
(16, 18, 9234),
(15, 18, 9233),
(14, 18, 9232),
(13, 18, 9231),
(12, 18, 9230),
(11, 18, 9229),
(44, 1, 11954),
(43, 1, 11953),
(42, 1, 11952),
(41, 1, 11951),
(40, 1, 11950),
(39, 1, 11949),
(38, 1, 11948),
(37, 1, 11947),
(36, 1, 11946),
(35, 1, 11945),
(34, 1, 11944),
(33, 1, 11943),
(32, 1, 11942),
(31, 1, 11941),
(30, 1, 11940),
(29, 1, 11939),
(28, 1, 11938),
(27, 1, 11937),
(26, 1, 11936),
(25, 1, 11935),
(188, 15, 9152),
(189, 15, 9153),
(190, 15, 9154),
(191, 15, 9155),
(192, 15, 9156),
(193, 15, 9157),
(194, 15, 9158),
(195, 15, 9159),
(196, 15, 9160),
(197, 15, 9161),
(198, 15, 9162),
(199, 15, 9163),
(200, 15, 9164),
(201, 15, 9165),
(202, 15, 9166),
(203, 15, 9167),
(204, 15, 9168),
(205, 15, 9169),
(206, 15, 9170),
(207, 15, 9171),
(190, 16, 9224),
(194, 16, 9225),
(198, 16, 9226),
(202, 16, 9227),
(206, 16, 9228),
(188, 18, 9355),
(189, 18, 9356),
(190, 18, 9357),
(191, 18, 9358),
(192, 18, 9359),
(193, 18, 9360),
(194, 18, 9361),
(195, 18, 9362),
(196, 18, 9363),
(197, 18, 9364),
(198, 18, 9365),
(199, 18, 9366),
(200, 18, 9367),
(201, 18, 9368),
(202, 18, 9369),
(203, 18, 9370),
(204, 18, 9371),
(205, 18, 9372),
(206, 18, 9373),
(207, 18, 9374),
(24, 1, 11934),
(23, 1, 11933),
(22, 1, 11932),
(21, 1, 11931),
(20, 1, 11930),
(19, 1, 11929),
(18, 1, 11928),
(17, 1, 11927),
(16, 1, 11926),
(15, 1, 11925),
(14, 1, 11924),
(13, 1, 11923),
(12, 1, 11922),
(11, 1, 11921),
(10, 1, 11920),
(9, 1, 11919),
(6, 1, 11918),
(7, 1, 11917),
(8, 1, 11916),
(227, 1, 12135);

-- --------------------------------------------------------

--
-- Table structure for table `agreements`
--

CREATE TABLE `agreements` (
  `id` int(11) NOT NULL,
  `valor_incoder` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `suscriptor` varchar(70) DEFAULT NULL,
  `comentario` text,
  `valor_suscriptor` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `annotations`
--

CREATE TABLE `annotations` (
  `id` int(11) NOT NULL,
  `tipo_principal` varchar(50) DEFAULT NULL,
  `observacion` text,
  `anotacion` int(11) DEFAULT NULL,
  `tipo_secundario` varchar(80) DEFAULT NULL,
  `limita_ejecucion` varchar(2) DEFAULT NULL,
  `title_study_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asociations`
--

CREATE TABLE `asociations` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL COMMENT '6.1 Nombre de la organizaci?n',
  `nit` varchar(20) DEFAULT NULL,
  `observacion` text,
  `direccion` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `cedula_rep` varchar(15) DEFAULT NULL,
  `nombre_rep` varchar(30) DEFAULT NULL,
  `primer_apellido_rep` varchar(30) DEFAULT NULL,
  `segundo_apellido_rep` varchar(30) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `vereda` varchar(60) DEFAULT NULL,
  `tiempo_experiencia` int(11) DEFAULT NULL,
  `total_socios` int(11) DEFAULT NULL,
  `mujeres` int(11) DEFAULT NULL,
  `hombres` int(11) DEFAULT NULL,
  `jovenes` int(11) DEFAULT NULL,
  `adulto_mayor` int(11) DEFAULT NULL,
  `afros` int(11) DEFAULT NULL,
  `indigenas` int(11) DEFAULT NULL,
  `campesinos` int(11) DEFAULT NULL,
  `retornados` int(11) DEFAULT NULL,
  `victimas` int(11) DEFAULT NULL,
  `sustitucion` int(11) DEFAULT NULL,
  `ilicitos` int(11) DEFAULT NULL,
  `reinsertados` int(11) DEFAULT NULL,
  `medianos` int(11) DEFAULT NULL,
  `directos` int(11) DEFAULT NULL,
  `indirectos` int(11) DEFAULT NULL,
  `relacion_predio` varchar(60) DEFAULT NULL,
  `fecha_censo` date DEFAULT NULL,
  `apoyo_tipo` varchar(60) DEFAULT NULL,
  `apoyo_institucion` varchar(60) DEFAULT NULL,
  `apoyo_fecha` date DEFAULT NULL,
  `credito_tipo` varchar(60) DEFAULT NULL,
  `credito_otro` varchar(60) DEFAULT NULL,
  `credito_valor` double DEFAULT NULL,
  `credito_plazo` text,
  `raizal` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` int(11) NOT NULL,
  `tipo_identificacion` varchar(5) DEFAULT NULL,
  `numero_identificacion` varchar(80) DEFAULT NULL,
  `nombres` varchar(80) DEFAULT NULL,
  `primer_apellido` varchar(45) DEFAULT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `genero` enum('Masculino','Femenino') DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `beneficiary_id` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `proyect_id` int(11) NOT NULL,
  `sisben_area` int(11) DEFAULT NULL,
  `sisben_puntaje` double DEFAULT NULL,
  `rup` varchar(10) DEFAULT NULL,
  `property_id` int(11) DEFAULT '0',
  `asociation_id` int(11) DEFAULT '0',
  `city_id` int(11) DEFAULT NULL,
  `grupo` enum('Indigena','Rom','Negritudes','Mujer cabeza de familia') DEFAULT NULL,
  `personas_a_cargo` int(11) DEFAULT NULL,
  `nivel_escolaridad` varchar(30) DEFAULT NULL,
  `numero_identificacion_victima` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `director` varchar(45) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `capital` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `nombre`, `codigo`, `director`, `direccion`, `telefono`, `email`, `capital`) VALUES
(1, 'Antioquia', 'ANT', 'RAMON DARIO TORRADO QUIÑONEZ', 'Cll. 48 B No. 80-53   Barrio Calazans', '(094) 2647380 -  Fax 2646375', 'antioquia@antioquia.com', 'Medellin'),
(2, 'Bolivar', 'BOL', 'Gabriel Enrique Saenz Sanchez', 'La Matuna. Edificio Concasa Piso 13 / Bocagrande calle 4 No 3-204', '(095) 6645563 / 6552615 / 6644163', 'gsaenz@incoder.gov.co', 'Cartagena'),
(3, 'Boyaca', 'BOY', 'GLORIA INELDA GUTIERREZ', 'Cra 11 No. 20 41 Piso 4 Edificio del Café Tunja', '(098) 7427921 / 7431123', 'ggutierrez@incoder.gov.co', 'Tunja'),
(4, 'Cesar', 'CES', 'EDUARDO OLIVER MENA', 'Calle 12  No. 8-46 esquina, Centro de negocios Orbe Plaza Of. 308', '(095) 574 7534  / 095 574 4992 / 3162851024 silvana', 'emena@incoder.gov.co', 'Valledupar'),
(5, 'Cordoba', 'COR', 'ADOLFO LEÓN BEDOYA CANO', 'Cra 3 No. 5-34 Barrio La Coquera.', '(094) 782 24 90  – 783 67 75 / 3163103547 / Dilma Rita', 'abedoya@incoder.gov.co', 'Moteria'),
(6, 'Cundinamarca', 'CUN', 'ADIELA ROCIO BOTIA  SANCHEZ (E)', 'Calle 43 No. 57 - 41 Av. Eldorado CAN Edificio INCODER', '(091) 3830444 Ext.1360 1407 1463- 1458', 'abotia@incoder.gov.co', 'Bogota'),
(7, 'Huila', 'HUI', 'ARNULFO POLANCO RAMIREZ', 'Cll 7 No. 6-27,  Piso 15 Edificio Caja Agraria.', '(098) 8722460/8722275/3134317527', 'apolanco@incoder.gov.co', 'Neiva'),
(8, 'Meta', 'MET', 'DIANA MARIA DEL MAR PINO HUMANEZ', 'Cll. 38 No. 31-58 Piso 8', '(098) 6623303 / 6626300 fax 6623783 6624205 ext. 11-29', 'dpino@incoder.gov.co', 'Villavicencio'),
(9, 'Nariño', 'NAR', 'EDUARDO ENRIQUE CHAMORRO', 'Cll. 16 No. 23 - 57 Edificio Abraham Delgado Piso 2', '(092) 7291256 / 7228350', 'echamorro@incoder.gov.co', 'PASTO'),
(10, 'Tolima', 'TOL', 'GONZALO SEGURA OTALORA', 'Carrera 5 # 44-19. Barrio Piedra Pintada, Parte Alta', '(098) 2656520 - 2642204 - fax 2665516 / 3103202054', NULL, NULL),
(11, 'Valle', 'VAL', ' HUMBERTO VILLANI PECHENE', 'Calle 9 No. 4 - 50 Beneficencia Valle', '(092) 8810034 / 8858303 / 8830187 / 8880974', 'hvillani@incoder.gov.c', 'Santiago de Cali'),
(12, 'Cauca', 'CAU', 'Pablo Santiago Rosero Balcazar', 'Carrera 5 No. 2-28', '(092) 8240235 –8240237 -8242299/fax 8318190', 'prosero@incoder.gov.co', 'Popayan'),
(13, 'Caldas', 'CAL', 'JAIRO SALAZAR ARISTIZABAL', 'Calle 23 No. 21-23 Altos Plaza de Bolívar', '(096) 8852142 / 8823133 / 8823120', 'jsalazar@incoder.gov.co', 'Manizales'),
(14, 'Caqueta', 'CAQ', 'RAFAEL LOSADA', 'Km. 2 Vía Morelia Antiguo INCORA', '(098) 4353366 fax 435 65 57', 'rlosada@incoder.gov.co', 'Florencia'),
(15, 'Magdalena', 'MAG', 'GERMAN HIGINIO DE LA HOZ RANGEL (E)', 'Carrera 1 C No. 22-58 edificio Bahia Centro', '(095) 4213567 Fax 4212852/ 4210205 ', 'gdelahoz@incoder.gov.co', 'Santa Marta'),
(16, 'Norte Santander', 'NOR', 'GERMAN GOMEZ GARCIA', 'Avenida 5a. No. 11 - 20 , piso 7 - Edificio Antiguo Banco de la República', '(097) 5730744, 57145 11, 57141 11, 57145 13', NULL, NULL),
(17, 'Putumayo', 'PUT', 'Hector Orlando Dulce Moreno (E)', 'Cra 7a No. 15-51 Barrio Ciudad Jardín', '(098) 429 65 56 - 429 54 88  4200985', 'hdulcem@incoder.gov.co', NULL),
(18, 'Santander', 'SAN', 'SOLANGE MONTOYA SILVA', 'Av. Quebrada Seca No. 30-12 Piso 3', '(097) 6452460 / 6346187 / 6346537 / 6453038 ', NULL, NULL),
(19, 'Sucre', 'SUC', 'DAVID ANDRES GOMESCASSERES ACUÑA', 'Cra 18 No. 22-35', '(095)  2821221 / 2826297 / 2821549', NULL, NULL),
(20, 'Atlantico', 'ATL', 'FELIPE REYES PADILLA (E)', 'Cra. 60 No. 75-107', '(095) 368 83 92 -3688424', 'freyes@incoder.gov.co', 'Barranqulla'),
(21, 'Arauca', 'ARA', 'LUIS FELIPE GUZMAN DIAZ', 'Calle 20 No. 22-44 oficina 202 - 207', '(097) 8851052 / 8850368', 'lguzman@incoder.gov.c', 'Arauca'),
(22, 'Casanare', 'CAS', 'ANTONIO EVERTH COPETE MORENO', 'Calle 13 con 19 Antiguo Ed. TELECOM', '(098) 6357358', 'acopete@incoder.gov.co', 'Yopal'),
(23, 'Choco', 'CHO', 'ALBA PATRICIA OSORIO DUALIBY', 'Carrera  7a. No. 26 - 45 Barrio Alameda Reye', '(4) 6711417 (4) 6711466 ', 'aosorio@incoder.gov.co', 'Quibdo'),
(24, 'Guajira', 'GUA', 'ZORAIDA SALCEDO MENDOZA', 'Calle 7 No. 6-20 Riohacha', '(095) 727 02 63 - 7283721', 'zsalcedo@incoder.gov.co', 'Riohacha'),
(25, 'Quindio', 'QUI', 'JULIO CESAR CORTES PULIDO', 'Cra 15 No. 7-30 Barrio Galán', '(096) 7458876 / 7458879', 'jcortes@incoder.gov.co', 'ARMENIA'),
(26, 'Risaralda', 'RIS', 'JAIRO VELEZ DAVILA ', 'Calle 48 No. 9-36 Barrio Maraya', '(096) 326 78 11 / 3360169/ 336 05 98', 'jvelez@incoder.gov.co', 'Pereira'),
(27, 'Amazonas', 'AMA', 'JUAN CARLOS BERNAL LEAL', 'Calle 9 No.10-90 Piso 2', '(098) 5923959   098 5927296', 'jcbernal@incoder.gov.co', 'leticia'),
(28, 'Guaviare', 'GUV', 'WILMAN JOSE MORENO PEREA', 'Cra. 23 No. 10 - 40', '(098) 5840064 / 90 / 5849618', 'wmoreno@incoder.gov.co', 'San Jose del Guaviare'),
(29, 'Guainia', 'GUN', 'JESUS GÓMEZ MESA (E)', 'Calle 20 No. 9-43 Barrio Comuneros', '(098) 5657184', 'jegomez@incoder.gov.co', 'Inirida'),
(30, 'Vaupes', 'VAU', 'ANGEL SIMON CRUZ HERRERA', 'Cra 12 No. 15-85 Piso 2 Centro A Mitú', '(098) 564 25 74', 'acruz@incoder.gov.co', NULL),
(31, 'Vichada', 'VIC', 'GONZALO BERMUDEZ MELENDEZ (E)', 'Av. Orinoco No. 3-140', '(098) 5654487', 'gbermudezmelendez@incoder.gov.co', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch_users`
--

CREATE TABLE `branch_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`id`, `nombre`) VALUES
(4, '2015'),
(5, '2016'),
(6, '2017');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `cdp` int(11) DEFAULT NULL,
  `rp` varchar(20) DEFAULT NULL,
  `poblacion` varchar(20) DEFAULT NULL,
  `supervisor` varchar(60) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `dependencia` varchar(70) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL COMMENT 'Tabla usada en varios preguntas y modulos. Está relacionada con las tablas departaments, family_polls, properties',
  `departament_id` int(11) NOT NULL,
  `divipol` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `departament_id`, `divipol`) VALUES
(1, 'MEDELLIN', 1, 5001),
(2, 'ABEJORRAL', 1, 5002),
(3, 'ABRIAQUI', 1, 5004),
(4, 'ALEJANDRIA', 1, 5021),
(5, 'AMAGA', 1, 5030),
(6, 'AMALFI', 1, 5031),
(7, 'ANDES', 1, 5034),
(8, 'ANGELOPOLIS', 1, 5036),
(9, 'ANGOSTURA', 1, 5038),
(10, 'ANORI', 1, 5040),
(11, 'SANTAFE DE ANTIOQUIA', 1, 5042),
(12, 'ANZA', 1, 5044),
(13, 'APARTADO', 1, 5045),
(14, 'ARBOLETES', 1, 5051),
(15, 'ARGELIA', 1, 5055),
(16, 'ARMENIA', 1, 5059),
(17, 'BARBOSA', 1, 5079),
(18, 'BELMIRA', 1, 5086),
(19, 'BELLO', 1, 5088),
(20, 'BETANIA', 1, 5091),
(21, 'BETULIA', 1, 5093),
(22, 'BOLIVAR', 1, 5101),
(23, 'BRICEÑO', 1, 5107),
(24, 'BURITICA', 1, 5113),
(25, 'CACERES', 1, 5120),
(26, 'CAICEDO', 1, 5125),
(27, 'CALDAS', 1, 5129),
(28, 'CAMPAMENTO', 1, 5134),
(29, 'CAÑASGORDAS', 1, 5138),
(30, 'CARACOLI', 1, 5142),
(31, 'CARAMANTA', 1, 5145),
(32, 'CAREPA', 1, 5147),
(33, 'CARMEN DE VIBORAL', 1, 5148),
(34, 'CAROLINA', 1, 5150),
(35, 'CAUCASIA', 1, 5154),
(36, 'CHIGORODO', 1, 5172),
(37, 'CISNEROS', 1, 5190),
(38, 'COCORNA', 1, 5197),
(39, 'CONCEPCION', 1, 5206),
(40, 'CONCORDIA', 1, 5209),
(41, 'COPACABANA', 1, 5212),
(42, 'CURRULAO-ANTIOQUIA', 1, 5837),
(43, 'DABEIBA', 1, 5234),
(44, 'DON MATIAS', 1, 5237),
(45, 'EBEJICO', 1, 5240),
(46, 'EL BAGRE', 1, 5250),
(47, 'ENTRERRIOS', 1, 5264),
(48, 'ENVIGADO', 1, 5266),
(49, 'FREDONIA', 1, 5282),
(50, 'FRONTINO', 1, 5284),
(51, 'GIRALDO', 1, 5306),
(52, 'GIRARDOTA', 1, 5308),
(53, 'GOMEZ PLATA', 1, 5310),
(54, 'GRANADA', 1, 5313),
(55, 'GUADALUPE', 1, 5315),
(56, 'GUARNE', 1, 5318),
(57, 'GUATAPE', 1, 5321),
(58, 'HELICONIA', 1, 5347),
(59, 'HISPANIA', 1, 5353),
(60, 'ITAGUI', 1, 5360),
(61, 'ITUANGO', 1, 5361),
(62, 'JARDIN', 1, 5364),
(63, 'JERICO', 1, 5368),
(64, 'LA CEJA', 1, 5376),
(65, 'LA ESTRELLA', 1, 5380),
(66, 'LA PINTADA', 1, 5390),
(67, 'LA UNION', 1, 5400),
(68, 'BELEN - ANTIOQUIA', 18, 5001),
(69, 'LIBORINA', 1, 5411),
(70, 'MACEO', 1, 5425),
(71, 'MARINILLA', 1, 5440),
(72, 'MONTEBELLO', 1, 5467),
(73, 'MURINDO', 1, 5475),
(74, 'MUTATA', 1, 5480),
(75, 'NARIÑO', 1, 5483),
(76, 'NECOCLI', 1, 5490),
(77, 'NECHI', 1, 5495),
(78, 'OLAYA', 1, 5501),
(79, 'EL BAGRE-ANTIOQUIA', 1, 5250),
(80, 'PEÑOL', 1, 5541),
(81, 'PEQUE', 1, 5543),
(82, 'PUEBLORRICO', 1, 5576),
(83, 'PUERTO BERRIO', 1, 5579),
(84, 'PUERTO NARE', 1, 5585),
(85, 'PUERTO TRIUNFO', 1, 5591),
(86, 'REMEDIOS', 1, 5604),
(87, 'RETIRO', 1, 5607),
(88, 'RIONEGRO', 1, 5615),
(89, 'SABANALARGA', 1, 5628),
(90, 'SABANETA', 1, 5631),
(91, 'SALGAR', 1, 5642),
(92, 'SAN ANDRES', 1, 5647),
(93, 'SAN CARLOS', 1, 5649),
(94, 'SAN FRANCISCO', 1, 5652),
(95, 'SAN JERONIMO', 1, 5656),
(96, 'SAN JOSE DE LA MONTA', 1, 5658),
(97, 'SAN JUAN DE URABA', 1, 5659),
(98, 'SAN LUIS', 1, 5660),
(99, 'SAN PEDRO', 1, 5664),
(100, 'SAN PEDRO DE URABA', 1, 5665),
(101, 'SAN RAFAEL', 1, 5667),
(102, 'SAN ROQUE', 1, 5670),
(103, 'SAN VICENTE', 1, 5674),
(104, 'SANTA BARBARA', 1, 5679),
(105, 'SANTA ROSA DE OSOS', 1, 5686),
(106, 'SANTO DOMINGO', 1, 5690),
(107, 'SANTUARIO', 1, 5697),
(108, 'SEGOVIA', 1, 5736),
(109, 'SONSON', 1, 5756),
(110, 'SOPETRAN', 1, 5761),
(111, 'TAMESIS', 1, 5789),
(112, 'TARAZA', 1, 5790),
(113, 'TARSO', 1, 5792),
(114, 'TITIRIBI', 1, 5809),
(115, 'TOLEDO', 1, 5819),
(116, 'TURBO', 1, 5837),
(117, 'URAMITA', 1, 5842),
(118, 'URRAO', 1, 5847),
(119, 'VALDIVIA', 1, 5854),
(120, 'VALPARAISO', 1, 5856),
(121, 'VEGACHI', 1, 5858),
(122, 'VENECIA', 1, 5861),
(123, 'VIGIA DEL FUERTE', 1, 5873),
(124, 'YALI', 1, 5885),
(125, 'YARUMAL', 1, 5887),
(126, 'YOLOMBO', 1, 5890),
(127, 'YONDO', 1, 5893),
(128, 'ZARAGOZA', 1, 5895),
(129, 'ALTAMIRA', 1, 5093),
(130, 'SAN CRISTOBAL', 1, 5001),
(131, 'ATLANTICO', 2, 8001),
(132, 'BARRANQUILLA', 2, 8001),
(133, 'BARANOA', 2, 8078),
(134, 'CAMPECHE-ATLANTICO', 2, 8078),
(135, 'CAMPO D LA CRUZ', 2, 8137),
(136, 'CANDELARIA', 2, 8141),
(137, 'GALAPA', 2, 8296),
(138, 'JUAN DE ACOSTA', 2, 8372),
(139, 'LA PLAYA-ATLANTICO', 2, 8001),
(140, 'LURUACO', 2, 8421),
(141, 'MALAMBO', 2, 8433),
(142, 'MANATI', 2, 8436),
(143, 'PALMAR DDE VARELA', 2, 8520),
(144, 'PIOJO', 2, 8549),
(145, 'POLONUEVO', 2, 8558),
(146, 'PONEDERA', 2, 8560),
(147, 'PUERTO COLOMBIA', 2, 8573),
(148, 'REPELON', 2, 8606),
(149, 'SABANAGRANDE', 2, 8634),
(150, 'SABANALARGA', 2, 8638),
(151, 'SANTA LUCIA', 2, 8675),
(152, 'SANTO TOMAS', 2, 8685),
(153, 'SOLEDAD', 2, 8758),
(154, 'SUAN', 2, 8770),
(155, 'TUBARÁ', 2, 8832),
(156, 'USIACURI', 2, 8849),
(157, 'BOGOTA D.C.', 3, 11001),
(158, 'BOSA-BOGOTA D.C.', 3, 11001),
(159, 'ENGATIVA-BOGOTA D.C.', 3, 11001),
(160, 'FONTIBON-BOGOTA D.C.', 3, 11001),
(161, 'SUBA-BOGOTA D.C.', 3, 11001),
(162, 'USAQUEN-BOGOTA D.C.', 3, 11001),
(163, 'USME-BOGOTA D.C.', 3, 11001),
(164, 'CARTAGENA', 4, 13001),
(165, 'ACHI', 4, 13006),
(166, 'ALTOS DEL ROSARIO', 4, 13030),
(167, 'ARENAL', 4, 13042),
(168, 'ARJONA', 4, 13052),
(169, 'ARROYOHONDO', 4, 13062),
(170, 'BARRANCO DE LOBA', 4, 13074),
(171, 'CALAMAR', 4, 13140),
(172, 'CANTAGALLO', 4, 13160),
(173, 'CICUCO', 4, 13188),
(174, 'CORDOBA', 4, 13212),
(175, 'CLEMENCIA', 4, 13222),
(176, 'EL CARMEN DE BOLIVAR', 4, 13244),
(177, 'EL GUAMO', 4, 13248),
(178, 'EL PEÑON', 4, 13268),
(179, 'HATILLO DE LOBA', 4, 13300),
(180, 'MAGANGUE', 4, 13430),
(181, 'MAHATES', 4, 13433),
(182, 'MARGARITA', 4, 13440),
(183, 'MARIA LA BAJA', 4, 13442),
(184, 'REGIDOR', 4, 13580),
(185, 'MONTECRISTO', 4, 13458),
(186, 'VILLA RICA - VALLE', 4, 13001),
(187, 'MOMPOS', 4, 13468),
(188, 'MORALES', 4, 13473),
(189, 'PINILLOS', 4, 13549),
(190, 'REGIDOR', 4, 13580),
(191, 'RIO VIEJO', 4, 13600),
(192, 'SANCRISTOBAL', 4, 13620),
(193, 'SAN ESTANISLAO', 4, 13647),
(194, 'SAN FERNANDO', 4, 13650),
(195, 'SAN JACINTO', 4, 13654),
(196, 'SANJACINTO DEL CAUCA', 4, 13655),
(197, 'SAN JUAN NEPOMUCENO', 4, 13657),
(198, 'SAN MARTIN DE LOBA', 4, 13667),
(199, 'SAN PABLO', 4, 13670),
(200, 'SANTA CATALINA', 4, 13673),
(201, 'SANTA ROSA', 4, 13683),
(202, 'SANTA ROSA DEL SUR', 4, 13688),
(203, 'SIMITI', 4, 13744),
(204, 'SOPLAVIENTO', 4, 13760),
(205, 'TALAIGUA NUEVO', 4, 13780),
(206, 'PUERTO RICO', 4, 13810),
(207, 'TURBACO', 4, 13836),
(208, 'TURBANA', 4, 13838),
(209, 'VILLANUEVA', 4, 13873),
(210, 'ZAMBRANO', 4, 13894),
(211, 'TUNJA', 5, 15001),
(212, 'ALMEIDA', 5, 15022),
(213, 'AQUITANIA', 5, 15047),
(214, 'ARCABUCO', 5, 15051),
(215, 'BELEN', 5, 15087),
(216, 'BERBEO', 5, 15090),
(217, 'BETEITIVA', 5, 15092),
(218, 'BOAVITA', 5, 15097),
(219, 'BOYACA', 5, 15104),
(220, 'BRICENO', 5, 15106),
(221, 'BUENAVISTA', 5, 15109),
(222, 'BUSBANZA', 5, 15114),
(223, 'CALDAS', 5, 15131),
(224, 'CAMPOHERMOSO', 5, 15135),
(225, 'CERINZA', 5, 15162),
(226, 'CHINAVITA', 5, 15172),
(227, 'CHIQUINQUIRA', 5, 15176),
(228, 'CHISCAS', 5, 15180),
(229, 'CHITA', 5, 15183),
(230, 'CHITARAQUE', 5, 15185),
(231, 'CHIVATA', 5, 15187),
(232, 'CIENEGA', 5, 15189),
(233, 'COMBITA', 5, 15204),
(234, 'COPER', 5, 15212),
(235, 'CORRALES', 5, 15215),
(236, 'COVARACHIA', 5, 15218),
(237, 'CUBARA', 5, 15223),
(238, 'CUCAITA', 5, 15224),
(239, 'CUITIVA', 5, 15226),
(240, 'CHIQUIZA', 5, 15232),
(241, 'CHIVOR', 5, 15236),
(242, 'DUITAMA', 5, 15238),
(243, 'EL COCUY', 5, 15244),
(244, 'EL ESPINO', 5, 15248),
(245, 'FIRAVITOBA', 5, 15272),
(246, 'FLORESTA', 5, 15276),
(247, 'GACHANTIVA', 5, 15293),
(248, 'GAMEZA', 5, 15296),
(249, 'GARAGOA', 5, 15299),
(250, 'GUACAMAYAS', 5, 15317),
(251, 'GUATEQUE', 5, 15322),
(252, 'GUAYATA', 5, 15325),
(253, 'GUICAN', 5, 15332),
(254, 'IZA', 5, 15362),
(255, 'JENESANO', 5, 15367),
(256, 'JERICO', 5, 15368),
(257, 'LABRANZAGRANDE', 5, 15377),
(258, 'LA CAPILLA', 5, 15380),
(259, 'LA VICTORIA', 5, 15401),
(260, 'LA UVITA', 5, 15403),
(261, 'VILLA DE LEYVA', 5, 15407),
(262, 'MACANAL', 5, 15425),
(263, 'MARIPI', 5, 15442),
(264, 'MIRAFLORES', 5, 15455),
(265, 'MONGUA', 5, 15464),
(266, 'MONGUI', 5, 15466),
(267, 'MONIQUIRA', 5, 15469),
(268, 'MOTAVITA', 5, 15476),
(269, 'MUZO', 5, 15480),
(270, 'NOBSA', 5, 15491),
(271, 'NUEVO COLON', 5, 15494),
(272, 'OICATA', 5, 15500),
(273, 'OTANCHE', 5, 15507),
(274, 'PACHAVITA', 5, 15511),
(275, 'PAEZ', 5, 15514),
(276, 'PAIPA', 5, 15516),
(277, 'PAJARITO', 5, 15518),
(278, 'PANQUEBA', 5, 15522),
(279, 'PAUNA', 5, 15531),
(280, 'PAYA', 5, 15533),
(281, 'PAZ DE RIO', 5, 15537),
(282, 'PESCA', 5, 15542),
(283, 'PISVA', 5, 15550),
(284, 'PUERTO BOYACA', 5, 15572),
(285, 'QUIPAMA', 5, 15580),
(286, 'RAMIRIQUI', 5, 15599),
(287, 'RAQUIRA', 5, 15600),
(288, 'RONDON', 5, 15621),
(289, 'SABOYA', 5, 15632),
(290, 'SACHICA', 5, 15638),
(291, 'SAMACA', 5, 15646),
(292, 'SAN EDUARDO', 5, 15660),
(293, 'SAN JOSE DE PARE', 5, 15664),
(294, 'SAN LUIS DE GACENO', 5, 15667),
(295, 'SAN MATEO', 5, 15673),
(296, 'SAN MIGUEL DE SEMA', 5, 15676),
(297, 'SAN PABLO DE BORBUR', 5, 15681),
(298, 'SANTANA', 5, 15686),
(299, 'BELENCITO', 5, 15491),
(300, 'SANTA MARIA', 5, 15690),
(301, 'SANTA ROSA DE VITERB', 5, 15693),
(302, 'SANTA SOFIA', 5, 15696),
(303, 'SATIVANORTE', 5, 15720),
(304, 'SATIVASUR', 5, 15723),
(305, 'SIACHOQUE', 5, 15740),
(306, 'SOATA', 5, 15753),
(307, 'SOCOTA', 5, 15755),
(308, 'SOCHA', 5, 15757),
(309, 'SOGAMOSO', 5, 15759),
(310, 'SOMONDOCO', 5, 15761),
(311, 'SORA', 5, 15762),
(312, 'SOTAQUIRA', 5, 15763),
(313, 'SORACA', 5, 15764),
(314, 'SUSACON', 5, 15774),
(315, 'SUTAMARCHAN', 5, 15776),
(316, 'SUTATENZA', 5, 15778),
(317, 'TASCO', 5, 15790),
(318, 'TENZA', 5, 15798),
(319, 'TIBANA', 5, 15804),
(320, 'TIBASOSA', 5, 15806),
(321, 'TINJACA', 5, 15808),
(322, 'TIPACOQUE', 5, 15810),
(323, 'TOCA', 5, 15814),
(324, 'TOGUI', 5, 15816),
(325, 'TOPAGA', 5, 15820),
(326, 'TOTA', 5, 15822),
(327, 'TUNUNGUA', 5, 15832),
(328, 'TURMEQUE', 5, 15835),
(329, 'TUTA', 5, 15837),
(330, 'TUTASA', 5, 15839),
(331, 'UMBITA', 5, 15842),
(332, 'VENTAQUEMADA', 5, 15861),
(333, 'VIRACACHA', 5, 15879),
(334, 'ZETAQUIRA', 5, 15897),
(335, 'MANIZALES', 6, 17001),
(336, 'AGUADAS', 6, 17013),
(337, 'ANSERMA', 6, 17042),
(338, 'ARANZAZU', 6, 17050),
(339, 'BELALCAZAR', 6, 17088),
(340, 'CHINCHINA', 6, 17174),
(341, 'FILADELFIA', 6, 17272),
(342, 'LA DORADA', 6, 17380),
(343, 'LA MERCED', 6, 17388),
(344, 'MANZANARES', 6, 17433),
(345, 'MARMATO', 6, 17442),
(346, 'MARQUETALIA', 6, 17444),
(347, 'MARULANDA', 6, 17446),
(348, 'NEIRA', 6, 17486),
(349, 'NORCASIA', 6, 17495),
(350, 'PACORA', 6, 17513),
(351, 'PALESTINA', 6, 17524),
(352, 'PENSILVANIA', 6, 17541),
(353, 'RIOSUCIO', 6, 17614),
(354, 'RISARALDA', 6, 17616),
(355, 'SALAMINA', 6, 17653),
(356, 'SAN JOSE', 6, 17665),
(357, 'SAMANA', 6, 17662),
(358, 'SAN JOSE', 6, 17665),
(359, 'SUPIA', 6, 17777),
(360, 'VICTORIA', 6, 17867),
(361, 'VILLAMARIA', 6, 17873),
(362, 'VITERBO', 6, 17877),
(363, 'NORCASIA', 6, 17495),
(364, 'ARBOLEDA', 6, 17541),
(365, 'ARAUCA', 6, 17524),
(366, 'BOLIVIA', 6, 17541),
(367, 'FLORENCIA', 6, 17662),
(368, 'MONTEBONITO', 6, 17446),
(369, 'SAN FELIX', 6, 17653),
(370, 'SAN JOSE DE RISARALDA', 6, 17665),
(371, 'FLORENCIA', 7, 18001),
(372, 'ALBANIA', 7, 18029),
(373, 'BELEN DE LOS ANDAQUI', 7, 18094),
(374, 'CARTAGENA DEL CHAIRA', 7, 18150),
(375, 'CURILLO', 7, 18205),
(376, 'EL DONCELLO', 7, 18247),
(377, 'EL PAUJIL', 7, 18256),
(378, 'LA MONTAÑITA', 7, 18410),
(379, 'MATICURO', 7, 18460),
(380, 'MILAN', 7, 18460),
(381, 'MORELIA', 7, 18479),
(382, 'PUERTO RICO', 7, 18592),
(383, 'SAN JOSE DE FRAGUA', 7, 18610),
(384, 'SAN VICENTE DEL CAGUÁN', 7, 18753),
(385, 'SOLANO', 7, 18756),
(386, 'SOLANO', 7, 18756),
(387, 'SOLITA', 7, 18785),
(388, 'VALPARAISO', 7, 18860),
(389, 'GUACAMAYAS', 7, 18479),
(390, 'POPAYAN', 8, 19001),
(391, 'ALMAGUER', 8, 19022),
(392, 'VILLA RICA (Cauca)', 8, 19845),
(393, 'ARGELIA', 8, 19050),
(394, 'BALBOA', 8, 19075),
(395, 'BOLIVAR', 8, 19100),
(396, 'BUENOS AIRES', 8, 19110),
(397, 'CAJIBIO', 8, 19130),
(398, 'CALDONO', 8, 19137),
(399, 'CALOTO', 8, 19142),
(400, 'CORINTO', 8, 19212),
(401, 'EL BORDO-CAUCA', 8, 19532),
(402, 'EL TAMBO', 8, 19256),
(403, 'FLORENCIA', 8, 19290),
(404, 'GUAPI', 8, 19318),
(405, 'INZA', 8, 19355),
(406, 'JAMBALO', 8, 19364),
(407, 'LA SIERRA', 8, 19392),
(408, 'LA VEGA', 8, 19397),
(409, 'LOPEZ', 8, 19418),
(410, 'MERCADERES', 8, 19450),
(411, 'MIRANDA', 8, 19455),
(412, 'MORALES', 8, 19473),
(413, 'PADILLA', 8, 19513),
(414, 'PAEZ', 8, 19517),
(415, 'PATÍA', 8, 19532),
(416, 'PIAMONTE', 8, 19533),
(417, 'PIENDAMO', 8, 19548),
(418, 'PUERTO TEJADA', 8, 19573),
(419, 'PURACE', 8, 19585),
(420, 'ROSAS', 8, 19622),
(421, 'SAN SEBASTIAN', 8, 19693),
(422, 'SANTANDER DE QUILICHAO', 8, 19698),
(423, 'SANTA ROSA', 8, 19701),
(424, 'SANTANDER', 8, 19698),
(425, 'SILVIA', 8, 19743),
(426, 'SOTARA', 8, 19760),
(427, 'SUAREZ', 8, 19780),
(428, 'SUCRE', 8, 19785),
(429, 'TIMBIO', 8, 19807),
(430, 'TIMBIQUI', 8, 19809),
(431, 'TORIBIO', 8, 19821),
(432, 'TOTORO', 8, 19824),
(433, 'VILLA RICA (Tol)', 23, 73873),
(434, 'SIBERIA', 8, 19137),
(435, 'VALLEDUPAR', 9, 20001),
(436, 'AGUACHICA', 9, 20011),
(437, 'AGUSTIN CODAZZI', 9, 20013),
(438, 'ASTREA', 9, 20032),
(439, 'BECERRIL', 9, 20045),
(440, 'BOSCONIA', 9, 20060),
(441, 'CASACARA-CESAR', 9, 20013),
(442, 'CHIMICHAGUA', 9, 20175),
(443, 'CHIRIGUANA', 9, 20178),
(444, 'CURUMANI', 9, 20228),
(445, 'EL COPEY', 9, 20238),
(446, 'EL PASO', 9, 20250),
(447, 'GAMARRA', 9, 20295),
(448, 'GONZALEZ', 9, 20310),
(449, 'LA GLORIA', 9, 20383),
(450, 'LA JAGUA DE IBIRICO', 9, 20400),
(451, 'MANAURE BALCON DEL CESAR', 9, 20443),
(452, 'PAILITAS', 9, 20517),
(453, 'PELAYA', 9, 20550),
(454, 'PUEBLO BELLO', 9, 20570),
(455, 'RIO DE ORO', 9, 20614),
(456, 'LA PAZ', 9, 20621),
(457, 'SAN ALBERTO', 9, 20710),
(458, 'SAN DIEGO', 9, 20750),
(459, 'SAN MARTIN', 9, 20770),
(460, 'TAMALAMEQUE', 9, 20787),
(461, 'LA LOMA CESAR', 9, 20250),
(462, 'MONTERIA', 10, 23001),
(463, 'AYAPEL', 10, 23068),
(464, 'BUENAVISTA', 10, 23079),
(465, 'CANALETE', 10, 23090),
(466, 'CERETE', 10, 23162),
(467, 'MONTELIBANO', 10, 23466),
(468, 'CHIMA', 10, 23168),
(469, 'CHINU', 10, 23182),
(470, 'CIENAGA DE ORO', 10, 23189),
(471, 'CORDOBA', 10, 23419),
(472, 'COTORRA', 10, 23300),
(473, 'LA APARTADA', 10, 23350),
(474, 'LORICA', 10, 23417),
(475, 'LOS CORDOBAS', 10, 23419),
(476, 'MOMIL', 10, 23464),
(477, 'MONTELIBANO', 10, 23466),
(478, 'MOÑITOS', 10, 23500),
(479, 'PLANETA RICA', 10, 23555),
(480, 'PUEBLO NUEVO', 10, 23570),
(481, 'PUERTO ESCONDIDO', 10, 23574),
(482, 'PUERTO LIBERTADOR', 10, 23580),
(483, 'PURISIMA', 10, 23586),
(484, 'SAHAGUN', 10, 23660),
(485, 'SAN ANDRES SOTAVENTO', 10, 23670),
(486, 'SAN ANTERO', 10, 23672),
(487, 'SAN BERNARDO DEL VIE', 10, 23675),
(488, 'SAN CARLOS', 10, 23678),
(489, 'SAN PELAYO', 10, 23686),
(490, 'TIERRALTA', 10, 23807),
(491, 'VALENCIA', 10, 23855),
(492, 'AGUA DE DIOS', 11, 25001),
(493, 'SANTANDERCITO', 11, 25645),
(494, 'ALBAN', 11, 25019),
(495, 'ANAPOIMA', 11, 25035),
(496, 'ANOLAIMA', 11, 25040),
(497, 'APULO-CUNDINAMARCA', 11, 25599),
(498, 'ARBELAEZ', 11, 25053),
(499, 'BELTRAN', 11, 25086),
(500, 'BITUIMA', 11, 25095),
(501, 'BOJACA', 11, 25099),
(502, 'CABRERA', 11, 25120),
(503, 'CACHIPAY', 11, 25123),
(504, 'CAJICA', 11, 25126),
(505, 'CUNDAY', 11, 73226),
(506, 'CAPARRAPI', 11, 25148),
(507, 'CAQUEZA', 11, 25151),
(508, 'CARMEN DE CARUPA', 11, 25154),
(509, 'CHAGUANI', 11, 25168),
(510, 'CHIA', 11, 25175),
(511, 'CHIPAQUE', 11, 25178),
(512, 'CHOACHI', 11, 25181),
(513, 'CHOCONTA', 11, 25183),
(514, 'COGUA', 11, 25200),
(515, 'COTA', 11, 25214),
(516, 'CUCUNUBA', 11, 25224),
(517, 'EL COLEGIO', 11, 25245),
(518, 'LA LOMA', 11, 0),
(519, 'EL PENON', 11, 25258),
(520, 'EL ROSAL', 11, 25260),
(521, 'EL ROSAL', 11, 25260),
(522, 'FACATATIVA', 11, 25269),
(523, 'FOMEQUE', 11, 25279),
(524, 'FOSCA', 11, 25281),
(525, 'FUNZA', 11, 25286),
(526, 'FUQUENE', 11, 25288),
(527, 'FUSAGASUGA', 11, 25290),
(528, 'GACHALA', 11, 25293),
(529, 'GACHANCIPA', 11, 25295),
(530, 'GACHETA', 11, 25297),
(531, 'GAMA', 11, 25299),
(532, 'GIRARDOT', 11, 25307),
(533, 'GRANADA', 11, 25312),
(534, 'GUACHETA', 11, 25317),
(535, 'GUADUAS', 11, 25320),
(536, 'GUASCA', 11, 25322),
(537, 'GUATAQUI', 11, 25324),
(538, 'GUATAVITA', 11, 25326),
(539, 'GUAYABAL DE SIQUIMA', 11, 25328),
(540, 'GUAYABETAL', 11, 25335),
(541, 'GUTIERREZ', 11, 25339),
(542, 'JERUSALEN', 11, 25368),
(543, 'JERUSALEN-CUNDINAMARCA', 11, 25368),
(544, 'JUNIN', 11, 25372),
(545, 'LA CALERA', 11, 25377),
(546, 'LA MESA', 11, 25386),
(547, 'LA PALMA', 11, 25394),
(548, 'LA PEÑA', 11, 25398),
(549, 'LA VEGA', 11, 25402),
(550, 'LENGUAZAQUE', 11, 25407),
(551, 'MACHETA', 11, 25426),
(552, 'MADRID', 11, 25430),
(553, 'MANTA', 11, 25436),
(554, 'MEDINA', 11, 25438),
(555, 'MOSQUERA', 11, 25473),
(556, 'NARIÑO', 11, 25483),
(557, 'NEMOCON', 11, 25486),
(558, 'NILO', 11, 25488),
(559, 'NIMAIMA', 11, 25489),
(560, 'NOCAIMA', 11, 25491),
(561, 'VENECIA', 11, 25506),
(562, 'PACHO', 11, 25513),
(563, 'PAIME', 11, 25518),
(564, 'PANDI', 11, 25524),
(565, 'PARATEBUENO', 11, 25530),
(566, 'PASCA', 11, 25535),
(567, 'PUERTO SALGAR', 11, 25572),
(568, 'PULI', 11, 25580),
(569, 'QUEBRADANEGRA', 11, 25592),
(570, 'QUETAME', 11, 25594),
(571, 'QUIPILE', 11, 25596),
(572, 'APULO', 11, 25599),
(573, 'RICAURTE', 11, 25612),
(574, 'S.ANTONIO TEQUENDAMA', 11, 25645),
(575, 'SAN BERNARDO', 11, 25649),
(576, 'SAN CAYETANO', 11, 25653),
(577, 'SAN FRANCISCO', 11, 25658),
(578, 'SAN JUAN DE RIO SECO', 11, 25662),
(579, 'SASAIMA', 11, 25718),
(580, 'SESQUILE', 11, 25736),
(581, 'SIBATE', 11, 25740),
(582, 'SILVANIA', 11, 25743),
(583, 'SIMIJACA', 11, 25745),
(584, 'SOACHA', 11, 25754),
(585, 'SOPO', 11, 25758),
(586, 'SUBACHOQUE', 11, 25769),
(587, 'SUESCA', 11, 25772),
(588, 'SUPATA', 11, 25777),
(589, 'SUSA', 11, 25779),
(590, 'SUTATAUSA', 11, 25781),
(591, 'TABIO', 11, 25785),
(592, 'TAUSA', 11, 25793),
(593, 'TENA', 11, 25797),
(594, 'TENJO', 11, 25799),
(595, 'TIBACUY', 11, 25805),
(596, 'TIBITO-CUNDINAMARCA', 11, 25817),
(597, 'TIBIRITA', 11, 25807),
(598, 'TOCAIMA', 11, 25815),
(599, 'TOCANCIPA', 11, 25817),
(600, 'TOPAIPI', 11, 25823),
(601, 'UBALA', 11, 25839),
(602, 'UBAQUE', 11, 25841),
(603, 'UBATE', 11, 25843),
(604, 'UNE', 11, 25845),
(605, 'UTICA', 11, 25851),
(606, 'VERGARA', 11, 25862),
(607, 'VIANI', 11, 25867),
(608, 'VILLAGOMEZ', 11, 25871),
(609, 'VILLAPINZON', 11, 25873),
(610, 'VILLETA', 11, 25875),
(611, 'VIOTA', 11, 25878),
(612, 'YACOPI', 11, 25885),
(613, 'ZIPACON', 11, 25898),
(614, 'ZIPACON', 11, 25898),
(615, 'ZIPAQUIRA', 11, 25899),
(616, 'CUMACA', 11, 25805),
(617, 'QUIBDO', 12, 27001),
(618, 'ACANDI', 12, 27006),
(619, 'ALTO BAUDO', 12, 27025),
(620, 'ANDAGOYA-CHOCO', 12, 27450),
(621, 'ATRATO', 12, 27050),
(622, 'BAGADO', 12, 27073),
(623, 'BAHIA SOLANO', 12, 27075),
(624, 'BAJO BAUDO', 12, 27077),
(625, 'BAJO SAN JUAN-CHOCO', 12, 27361),
(626, 'BELEN DE BAJIRA', 12, 27086),
(627, 'BOJAYA', 12, 27099),
(628, 'CANTON DEL SAN PABLO', 12, 27135),
(629, 'CARMEN DEL DARIEN', 12, 27150),
(630, 'CERTEGUI', 12, 27160),
(631, 'CONDOTO', 12, 27205),
(632, 'EL CARMEN DE ATRATO', 12, 27245),
(633, 'EL LITORAL DEL SAN J', 12, 27250),
(634, 'ITSMINA', 12, 27361),
(635, 'JURADO', 12, 27372),
(636, 'LLORO', 12, 27413),
(637, 'MEDIO ATRATO', 12, 27425),
(638, 'MEDIO BAUDO', 12, 27430),
(639, 'MEDIO SAN JUAN', 12, 27450),
(640, 'NOVITA', 12, 27491),
(641, 'NUQUI', 12, 27495),
(642, 'RIO IRO', 12, 27580),
(643, 'RIO QUITO', 12, 27600),
(644, 'RIOSUCIO', 12, 27615),
(645, 'SAN JOSE DEL PALMAR', 12, 27660),
(646, 'SIPI', 12, 27745),
(647, 'TADO', 12, 27787),
(648, 'UNGUIA', 12, 27800),
(649, 'UNION PANAMERICANA', 12, 27810),
(650, 'NEIVA', 13, 41001),
(651, 'ACEVEDO', 13, 41006),
(652, 'AGRADO', 13, 41013),
(653, 'AIPE', 13, 41016),
(654, 'ALGECIRAS', 13, 41020),
(655, 'ALTAMIRA', 13, 41026),
(656, 'BARAYA', 13, 41078),
(657, 'CAMPOALEGRE', 13, 41132),
(658, 'COLOMBIA', 13, 41206),
(659, 'ELIAS', 13, 41244),
(660, 'GARZON', 13, 41298),
(661, 'GIGANTE', 13, 41306),
(662, 'GUADALUPE', 13, 41319),
(663, 'HOBO', 13, 41349),
(664, 'IQUIRA', 13, 41357),
(665, 'ISNOS', 13, 41359),
(666, 'LA ARGENTINA', 13, 41378),
(667, 'LA PLATA', 13, 41396),
(668, 'NATAGA', 13, 41483),
(669, 'OPORAPA', 13, 41503),
(670, 'PAICOL', 13, 41518),
(671, 'PALERMO', 13, 41524),
(672, 'PALESTINA', 13, 41530),
(673, 'PITAL', 13, 41548),
(674, 'PITALITO', 13, 41551),
(675, 'RIVERA', 13, 41615),
(676, 'SALADOBLANCO', 13, 41660),
(677, 'SAN AGUSTIN', 13, 41668),
(678, 'SANTA MARIA', 13, 41676),
(679, 'SUAZA', 13, 41770),
(680, 'TARQUI', 13, 41791),
(681, 'TESALIA', 13, 41797),
(682, 'TELLO', 13, 41799),
(683, 'TERUEL', 13, 41801),
(684, 'TIMANA', 13, 41807),
(685, 'VILLAVIEJA', 13, 41872),
(686, 'YAGUARA', 13, 41885),
(687, 'VEGA LARGA', 13, 41001),
(688, 'RIOHACHA', 14, 44001),
(689, 'ALBANIA', 14, 44035),
(690, 'BARRANCAS', 14, 44078),
(691, 'DIBULLA', 14, 44090),
(692, 'DISTRACCION', 14, 44098),
(693, 'EL MOLINO', 14, 44110),
(694, 'DIBULLA-GUAJIRA', 14, 44090),
(695, 'FONSECA', 14, 44279),
(696, 'HATONUEVO', 14, 44378),
(697, 'LA JAGUA DEL PILAR', 14, 44420),
(698, 'MAICAO', 14, 44430),
(699, 'MANAURE', 14, 44560),
(700, 'SAN JUAN DEL CESAR', 14, 44650),
(701, 'URIBIA', 14, 44847),
(702, 'URUMITA', 14, 44855),
(703, 'VILLANUEVA', 14, 44874),
(704, 'PUERTO BOLIVAR', 14, 44847),
(705, 'SANTA MARTA', 15, 47001),
(706, 'ALGARROBO', 15, 47030),
(707, 'ARACATACA', 15, 47053),
(708, 'ARIGUANI', 15, 47058),
(709, 'CERRO SAN ANTONIO', 15, 47161),
(710, 'CHIVOLO', 15, 47170),
(711, 'CIENAGA', 15, 47189),
(712, 'CONCORDIA', 15, 47205),
(713, 'EL BANCO', 15, 47245),
(714, 'EL RODADERO-MAGDALENA', 15, 47001),
(715, 'EL PIÑON', 15, 47258),
(716, 'EL RETEN', 15, 47268),
(717, 'FUNDACION', 15, 47288),
(718, 'GUAMAL', 15, 47318),
(719, 'LA GAIRA-MAGDALENA', 15, 47001),
(720, 'NUEVA GRANADA', 15, 47460),
(721, 'PEDRAZA', 15, 47541),
(722, 'PIJIÑO', 15, 47545),
(723, 'PIVIJAY', 15, 47551),
(724, 'PLATO', 15, 47555),
(725, 'PUEBLOVIEJO', 15, 47570),
(726, 'REMOLINO', 15, 47605),
(727, 'SABANAS DE SAN ANGEL', 15, 47660),
(728, 'SALAMINA', 15, 47675),
(729, 'BOLIVIA - CALDAS', 15, 0),
(730, 'SAN SEBASTIAN BUENAV', 15, 47692),
(731, 'SAN ZENON', 15, 47703),
(732, 'SANTA ANA', 15, 47707),
(733, 'SANTA BARBARA DE PINTO', 15, 47720),
(734, 'SITIONUEVO', 15, 47745),
(735, 'TENERIFE', 15, 47798),
(736, 'ZAPAYAN', 15, 47960),
(737, 'ZONA BANANERA', 15, 47980),
(738, 'VILLAVICENCIO', 16, 50001),
(739, 'ACACIAS', 16, 50006),
(740, 'APIARI-META', 16, 50001),
(741, 'BARRANCA DE UPIA', 16, 50110),
(742, 'CABUYARO', 16, 50124),
(743, 'CASTILLA LA NUEVA', 16, 50150),
(744, 'CUBARRAL', 16, 50223),
(745, 'CUMARAL', 16, 50226),
(746, 'EL CALVARIO', 16, 50245),
(747, 'EL CASTILLO', 16, 50251),
(748, 'EL DORADO', 16, 50270),
(749, 'FUENTE DE ORO', 16, 50287),
(750, 'GRANADA', 16, 50313),
(751, 'GUAMAL', 16, 50318),
(752, 'MAPIRIPAN', 16, 50325),
(753, 'MESETAS', 16, 50330),
(754, 'LA MACARENA', 16, 50350),
(755, 'LA URIBE', 16, 50370),
(756, 'LEJANIAS', 16, 50400),
(757, 'MEDINA', 16, 0),
(758, 'PUERTO CONCORDIA', 16, 50450),
(759, 'MESETAS-META', 16, 50330),
(760, 'PUERTO GAITAN', 16, 50568),
(761, 'PUERTO LOPEZ', 16, 50573),
(762, 'PUERTO LLERAS', 16, 50577),
(763, 'PUERTO RICO', 16, 50590),
(764, 'RESTREPO', 16, 50606),
(765, 'SAN CARLOS GUAROA', 16, 50680),
(766, 'SAN JUAN DE ARAMA', 16, 50683),
(767, 'SAN JUANITO', 16, 50686),
(768, 'SAN MARTIN', 16, 50689),
(769, 'SURIMENA-META', 16, 50680),
(770, 'VISTA HERMOSA', 16, 50711),
(771, 'MEDELLIN DE ARIARI', 16, 50251),
(772, 'PASTO', 17, 52001),
(773, 'ALBAN', 17, 52019),
(774, 'ALDANA', 17, 52022),
(775, 'ANCUYA', 17, 52036),
(776, 'ARBOLEDA', 17, 52051),
(777, 'BARBACOAS', 17, 52079),
(778, 'BELEN', 17, 52083),
(779, 'BOCA DE SATINGA-NARIÑO', 17, 52490),
(780, 'BUESACO', 17, 52110),
(781, 'COLON', 17, 52203),
(782, 'CONSACA', 17, 52207),
(783, 'CONTADERO', 17, 52210),
(784, 'CORDOBA', 17, 52215),
(785, 'CUASPUD', 17, 52224),
(786, 'CUMBAL', 17, 52227),
(787, 'CUMBITARA', 17, 52233),
(788, 'CHACHAGUI', 17, 52240),
(789, 'EL CHARCO', 17, 52250),
(790, 'EL PEÑOL', 17, 52254),
(791, 'EL ROSARIO', 17, 52256),
(792, 'EL TABLON', 17, 52258),
(793, 'EL TAMBO', 17, 52260),
(794, 'FUNES', 17, 52287),
(795, 'GUACHUCAL', 17, 52317),
(796, 'GUAITARILLA', 17, 52320),
(797, 'GUALMATAN', 17, 52323),
(798, 'ILES', 17, 52352),
(799, 'IMUES', 17, 52354),
(800, 'IPIALES', 17, 52356),
(801, 'LA CRUZ', 17, 52378),
(802, 'LA FLORIDA', 17, 52381),
(803, 'LA LLANADA', 17, 52385),
(804, 'LA TOLA', 17, 52390),
(805, 'LA UNION', 17, 52399),
(806, 'LEIVA', 17, 52405),
(807, 'LINARES', 17, 52411),
(808, 'LOS ANDES', 17, 52418),
(809, 'MAGUI', 17, 52427),
(810, 'MALLAMA', 17, 52435),
(811, 'MOSQUERA', 17, 52473),
(812, 'NARIÑO', 17, 52480),
(813, 'OLAYA HERRERA', 17, 52490),
(814, 'OSPINA', 17, 52506),
(815, 'FRANCIS PIZARRO', 17, 52520),
(816, 'POLICARPA', 17, 52540),
(817, 'POTOSI', 17, 52560),
(818, 'PROVIDENCIA', 17, 52565),
(819, 'PUERRES', 17, 52573),
(820, 'PUPIALES', 17, 52585),
(821, 'RICAURTE', 17, 52612),
(822, 'ROBERTO PAYAN', 17, 52621),
(823, 'SAMANIEGO', 17, 52678),
(824, 'SANDONA', 17, 52683),
(825, 'SAN BERNARDO', 17, 52685),
(826, 'SAN LORENZO', 17, 52687),
(827, 'SAN PABLO', 17, 52693),
(828, 'SAN PEDRO DE CARTAGO', 17, 52694),
(829, 'SANTA BARBARA', 17, 52696),
(830, 'SANTACRUZ', 17, 52699),
(831, 'SAPUYES', 17, 52720),
(832, 'TAMINANGO', 17, 52786),
(833, 'TANGUA', 17, 52788),
(834, 'TUMACO', 17, 52835),
(835, 'TUQUERRES', 17, 52838),
(836, 'YACUANQUER', 17, 52885),
(837, 'CUCUTA', 18, 54001),
(838, 'ABREGO', 18, 54003),
(839, 'ARBOLEDAS', 18, 54051),
(840, 'BOCHALEMA', 18, 54099),
(841, 'BUCARASICA', 18, 54109),
(842, 'CACOTA', 18, 54125),
(843, 'CACHIRA', 18, 54128),
(844, 'CHINACOTA', 18, 54172),
(845, 'CHITAGA', 18, 54174),
(846, 'CONVENCION', 18, 54206),
(847, 'CUCUTILLA', 18, 54223),
(848, 'DURANIA', 18, 54239),
(849, 'EL CARMEN', 18, 54245),
(850, 'EL TARRA', 18, 54250),
(851, 'EL ZULIA', 18, 54261),
(852, 'GRAMALOTE', 18, 54313),
(853, 'HACARI', 18, 54344),
(854, 'HERRAN', 18, 54347),
(855, 'LABATECA', 18, 54377),
(856, 'LA ESPERANZA', 18, 54385),
(857, 'LA PLAYA', 18, 54398),
(858, 'LOS PATIOS', 18, 54405),
(859, 'LOURDES', 18, 54418),
(860, 'MUTISCUA', 18, 54480),
(861, 'OCAÑA', 18, 54498),
(862, 'PAMPLONA', 18, 54518),
(863, 'PAMPLONITA', 18, 54520),
(864, 'PUERTO SANTANDER', 18, 54553),
(865, 'RAGONVALIA', 18, 54599),
(866, 'SALAZAR', 18, 54660),
(867, 'SAN CALIXTO', 18, 54670),
(868, 'SAN CAYETANO', 18, 54673),
(869, 'SANTIAGO', 18, 54680),
(870, 'SARDINATA', 18, 54720),
(871, 'SILOS', 18, 54743),
(872, 'TEORAMA', 18, 54800),
(873, 'TIBU', 18, 54810),
(874, 'TOLEDO', 18, 54820),
(875, 'VILLA CARO', 18, 54871),
(876, 'VILLA DEL ROSARIO', 18, 54874),
(877, 'GIBRALTAR', 18, 54820),
(878, 'LA GABARRA', 18, 54810),
(879, 'LA VEGA', 18, 54128),
(880, 'LAS MERCEDES', 18, 54720),
(881, 'ARMENIA', 19, 63001),
(882, 'BARCELONA-QUINDIO', 19, 63130),
(883, 'BUENAVISTA', 19, 63111),
(884, 'CALARCA', 19, 63130),
(885, 'CIRCASIA', 19, 63190),
(886, 'CORDOBA', 19, 63212),
(887, 'FILANDIA', 19, 63272),
(888, 'GENOVA', 19, 63302),
(889, 'LA TEBAIDA', 19, 63401),
(890, 'MONTENEGRO', 19, 63470),
(891, 'PIJAO', 19, 63548),
(892, 'QUIMBAYA', 19, 63594),
(893, 'SALENTO', 19, 63690),
(894, 'PEREIRA', 20, 66001),
(895, 'APIA', 20, 66045),
(896, 'BALBOA', 20, 66075),
(897, 'BELEN DE UMBRIA', 20, 66088),
(898, 'DOS QUEBRADAS', 20, 66170),
(899, 'GUATICA', 20, 66318),
(900, 'IRRA-RISARALDA', 20, 66594),
(901, 'LA CELIA', 20, 66383),
(902, 'LA VIRGINIA', 20, 66400),
(903, 'MARSELLA', 20, 66440),
(904, 'MISTRATO', 20, 66456),
(905, 'PUEBLO RICO', 20, 66572),
(906, 'QUINCHIA', 20, 66594),
(907, 'SANTA ROSA DE CABAL', 20, 66682),
(908, 'SANTUARIO', 20, 66687),
(909, 'BUCARAMANGA', 21, 68001),
(910, 'AGUA CLARA', 21, 0),
(911, 'AGUADA', 21, 68013),
(912, 'ALBANIA', 21, 68020),
(913, 'ARATOCA', 21, 68051),
(914, 'BARBOSA', 21, 68077),
(915, 'BARICHARA', 21, 68079),
(916, 'BARRANCABERMEJA', 21, 68081),
(917, 'BETULIA', 21, 68092),
(918, 'BOLIVAR', 21, 68101),
(919, 'CABRERA', 21, 68121),
(920, 'CALIFORNIA', 21, 68132),
(921, 'CAPITANEJO', 21, 68147),
(922, 'CARCASI', 21, 68152),
(923, 'CEPITA', 21, 68160),
(924, 'CERRITO', 21, 68162),
(925, 'CHARALA', 21, 68167),
(926, 'CHARTA', 21, 68169),
(927, 'CHIMA', 21, 68176),
(928, 'CHIPATA', 21, 68179),
(929, 'CIMITARRA', 21, 68190),
(930, 'CONCEPCION', 21, 68207),
(931, 'CONFINES', 21, 68209),
(932, 'CONTRATACION', 21, 68211),
(933, 'COROMORO', 21, 68217),
(934, 'CURITI', 21, 68229),
(935, 'EL CARMEN DE CHUCURÍ', 21, 68235),
(936, 'EL GUACAMAYO', 21, 68245),
(937, 'EL PEÑON', 21, 68250),
(938, 'EL PLAYON', 21, 68255),
(939, 'ENCINO', 21, 68264),
(940, 'ENCISO', 21, 68266),
(941, 'FLORIAN', 21, 68271),
(942, 'FLORIDABLANCA', 21, 68276),
(943, 'GALAN', 21, 68296),
(944, 'GAMBITA', 21, 68298),
(945, 'GIRON', 21, 68307),
(946, 'GUACA', 21, 68318),
(947, 'GUADALUPE', 21, 68320),
(948, 'GUAPOTA', 21, 68322),
(949, 'GUAVATA', 21, 68324),
(950, 'GUEPSA', 21, 68327),
(951, 'HATO', 21, 68344),
(952, 'JESUS MARIA', 21, 68368),
(953, 'JORDAN', 21, 68370),
(954, 'LA BELLEZA', 21, 68377),
(955, 'LANDAZURI', 21, 68385),
(956, 'LA PAZ', 21, 68397),
(957, 'LEBRIJA', 21, 68406),
(958, 'LOS SANTOS', 21, 68418),
(959, 'MACARAVITA', 21, 68425),
(960, 'MALAGA', 21, 68432),
(961, 'MATANZA', 21, 68444),
(962, 'MOGOTES', 21, 68464),
(963, 'MOLAGAVITA', 21, 68468),
(964, 'OCAMONTE', 21, 68498),
(965, 'OIBA', 21, 68500),
(966, 'ONZAGA', 21, 68502),
(967, 'PALMAR', 21, 68522),
(968, 'PALMAS SOCORRO', 21, 68524),
(969, 'PARAMO', 21, 68533),
(970, 'PIEDECUESTA', 21, 68547),
(971, 'PINCHOTE', 21, 68549),
(972, 'PUENTE NACIONAL', 21, 68572),
(973, 'PUERTO PARRA', 21, 68573),
(974, 'PUERTO WILCHES', 21, 68575),
(975, 'RIONEGRO', 21, 68615),
(976, 'SABANA DE TORRES', 21, 68655),
(977, 'SAN ANDRES', 21, 68669),
(978, 'SAN BENITO', 21, 68673),
(979, 'SAN GIL', 21, 68679),
(980, 'SAN JOAQUIN', 21, 68682),
(981, 'SAN JOSE DE MIRANDA', 21, 68684),
(982, 'SAN MIGUEL', 21, 68686),
(983, 'SAN VICENTE DE CHUCURÍ', 21, 68689),
(984, 'SANTA BARBARA', 21, 68705),
(985, 'SANTA HELENA DEL OPO', 21, 68720),
(986, 'SIMACOTA', 21, 68745),
(987, 'SOCORRO', 21, 68755),
(988, 'SUAITA', 21, 68770),
(989, 'SUCRE', 21, 68773),
(990, 'SURATA', 21, 68780),
(991, 'TONA', 21, 68820),
(992, 'VALLE DE SAN JOSE', 21, 68855),
(993, 'VELEZ', 21, 68861),
(994, 'VETAS', 21, 68867),
(995, 'VILLANUEVA', 21, 68872),
(996, 'ZAPATOCA', 21, 68895),
(997, 'SAN FRANCISCO', 21, 68322),
(998, 'EL CENTRO', 21, 68081),
(999, 'SAN JOSE DE SUAVITA', 21, 68770),
(1000, 'SINCELEJO', 22, 70001),
(1001, 'BUENAVISTA', 22, 70110),
(1002, 'CAIMITO', 22, 70124),
(1003, 'COLOSO', 22, 70204),
(1004, 'COROZAL', 22, 70215),
(1005, 'COVEÑAS', 22, 70221),
(1006, 'CHALAN', 22, 70230),
(1007, 'COVEÑAS-SUCRE', 22, 70221),
(1008, 'EL ROBLE', 22, 70233),
(1009, 'GALERAS', 22, 70235),
(1010, 'GUARANDA', 22, 70265),
(1011, 'HATO NUEVO-SUCRE', 22, 70215),
(1012, 'LA UNION', 22, 70400),
(1013, 'LOS PALMITOS', 22, 70418),
(1014, 'MAJAGUAL', 22, 70429),
(1015, 'MORROA', 22, 70473),
(1016, 'OVEJAS', 22, 70508),
(1017, 'PALMITO', 22, 70523),
(1018, 'SAMPUES', 22, 70670),
(1019, 'SAN BENITO ABAD', 22, 70678),
(1020, 'SAN JUAN DE BETULIA', 22, 70702),
(1021, 'SAN MARCOS', 22, 70708),
(1022, 'SAN ONOFRE', 22, 70713),
(1023, 'SAN PEDRO', 22, 70717),
(1024, 'SINCE', 22, 70742),
(1025, 'SUCRE', 22, 70771),
(1026, 'TOLÚ VIEJO', 22, 70820),
(1027, 'TOLUVIEJO', 22, 70823),
(1028, 'IBAGUE', 23, 73001),
(1029, 'ALPUJARRA', 23, 73024),
(1030, 'ALVARADO', 23, 73026),
(1031, 'AMBALEMA', 23, 73030),
(1032, 'ANZOATEGUI', 23, 73043),
(1033, 'ARMERO', 23, 73055),
(1034, 'ATACO', 23, 73067),
(1035, 'CAJAMARCA', 23, 73124),
(1036, 'CARMEN DE APICALA', 23, 73148),
(1037, 'CASABIANCA', 23, 73152),
(1038, 'CHAPARRAL', 23, 73168),
(1039, 'COELLO', 23, 73200),
(1040, 'COYAIMA', 23, 73217),
(1041, 'CUNDAY', 23, 73226),
(1042, 'DOLORES', 23, 73236),
(1043, 'ESPINAL', 23, 73268),
(1044, 'FALAN', 23, 73270),
(1045, 'FLANDES', 23, 73275),
(1046, 'FRESNO', 23, 73283),
(1047, 'GUAMO', 23, 73319),
(1048, 'HERVEO', 23, 73347),
(1049, 'HONDA', 23, 73349),
(1050, 'ICONONZO', 23, 73352),
(1051, 'GUAYABAL', 23, 73055),
(1052, 'LERIDA', 23, 73408),
(1053, 'LIBANO', 23, 73411),
(1054, 'MARIQUITA', 23, 73443),
(1055, 'MELGAR', 23, 73449),
(1056, 'MURILLO', 23, 73461),
(1057, 'NATAGAIMA', 23, 73483),
(1058, 'ORTEGA', 23, 73504),
(1059, 'PALOCABILDO', 23, 73520),
(1060, 'PIEDRAS', 23, 73547),
(1061, 'PLANADAS', 23, 73555),
(1062, 'PRADO', 23, 73563),
(1063, 'PURIFICACION', 23, 73585),
(1064, 'RIOBLANCO', 23, 73616),
(1065, 'RONCESVALLES', 23, 73622),
(1066, 'ROVIRA', 23, 73624),
(1067, 'SALDAÑA', 23, 73671),
(1068, 'SAN ANTONIO', 23, 73675),
(1069, 'SAN LUIS', 23, 73678),
(1070, 'SANTA ISABEL', 23, 73686),
(1071, 'SUAREZ', 23, 73770),
(1072, 'VALLE DE SAN JUAN', 23, 73854),
(1073, 'VENADILLO', 23, 73861),
(1074, 'VILLAHERMOSA', 23, 73870),
(1075, 'VILLARRICA', 23, 73873),
(1076, 'CHICORAL-TOLIMA', 23, 73268),
(1077, 'JUNIN', 23, 73411),
(1078, 'CADIZ', 23, 73168),
(1079, 'HERRERA', 23, 73616),
(1081, 'GAITANA', 23, 73555),
(1082, 'PLAYA RICA', 23, 73675),
(1083, 'SANTIAGO PEREZ', 23, 73067),
(1084, 'SANTA TERESA', 23, 73411),
(1085, 'TRES ESQUINAS', 23, 73226),
(1086, 'CALI', 24, 76001),
(1087, 'ALCALA', 24, 76020),
(1088, 'ANDALUCIA', 24, 76036),
(1089, 'ANSERMANUEVO', 24, 76041),
(1090, 'ARGELIA', 24, 76054),
(1091, 'BOLIVAR', 24, 76100),
(1092, 'BUENAVENTURA', 24, 76109),
(1093, 'GUADALAJARA DE BUGA', 24, 76111),
(1094, 'BUGALAGRANDE', 24, 76113),
(1095, 'CAICEDONIA', 24, 76122),
(1096, 'CALIMA', 24, 76126),
(1097, 'CANDELARIA', 24, 76130),
(1098, 'CARTAGO', 24, 76147),
(1099, 'DAGUA', 24, 76233),
(1100, 'DARIEN-VALLE', 24, 76126),
(1101, 'EL AGUILA', 24, 76243),
(1102, 'EL CAIRO', 24, 76246),
(1103, 'EL CERRITO', 24, 76248),
(1104, 'EL DOVIO', 24, 76250),
(1105, 'FLORIDA', 24, 76275),
(1106, 'GINEBRA', 24, 76306),
(1107, 'GUACARI', 24, 76318),
(1108, 'JAMUNDI', 24, 76364),
(1109, 'LA CUMBRE', 24, 76377),
(1110, 'LA PAILA', 24, 76895),
(1111, 'LA UNION', 24, 76400),
(1112, 'LA VICTORIA', 24, 76403),
(1113, 'OBANDO', 24, 76497),
(1114, 'PALMIRA', 24, 76520),
(1115, 'PRADERA', 24, 76563),
(1116, 'RESTREPO', 24, 76606),
(1117, 'RIOFRIO', 24, 76616),
(1118, 'ROLDANILLO', 24, 76622),
(1119, 'SAN PEDRO', 24, 76670),
(1120, 'SEVILLA', 24, 76736),
(1121, 'TORO', 24, 76823),
(1122, 'TRUJILLO', 24, 76828),
(1123, 'TULUA', 24, 76834),
(1124, 'ULLOA', 24, 76845),
(1125, 'VERSALLES', 24, 76863),
(1126, 'VIJES', 24, 76869),
(1127, 'YOTOCO', 24, 76890),
(1128, 'YUMBO', 24, 76892),
(1129, 'ZARZAL', 24, 76895),
(1130, 'ARAUCA', 25, 81001),
(1131, 'ARAUQUITA', 25, 81065),
(1132, 'CRAVO NORTE', 25, 81220),
(1133, 'FORTUL', 25, 81300),
(1134, 'PUERTO RONDON', 25, 81591),
(1135, 'SARAVENA', 25, 81736),
(1136, 'TAME', 25, 81794),
(1137, 'YOPAL', 26, 85001),
(1138, 'AGUAZUL', 26, 85010),
(1139, 'CHAMEZA', 26, 85015),
(1140, 'HATO COROZAL', 26, 85125),
(1141, 'LA SALINA', 26, 85136),
(1142, 'MANI', 26, 85139),
(1143, 'MONTERREY', 26, 85162),
(1144, 'NUNCHIA', 26, 85225),
(1145, 'OROCUE', 26, 85230),
(1146, 'PAZ DE ARIPORO', 26, 85250),
(1147, 'PORE', 26, 85263),
(1148, 'RECETOR', 26, 85279),
(1149, 'SABANALARGA', 26, 85300),
(1150, 'SACAMA', 26, 85315),
(1151, 'SAN LUIS DE PALENQUE', 26, 85325),
(1152, 'TAMARA', 26, 85400),
(1153, 'TAURAMENA', 26, 85410),
(1154, 'TRINIDAD', 26, 85430),
(1155, 'VILLANUEVA', 26, 85440),
(1156, 'MOCOA', 27, 86001),
(1157, 'COLON', 27, 86219),
(1158, 'ORITO', 27, 86320),
(1159, 'PUERTO ASIS', 27, 86568),
(1160, 'PUERTO CAICEDO', 27, 86569),
(1161, 'PUERTO GUZMAN', 27, 86571),
(1162, 'PUERTO  LEGUIZAMO', 27, 86573),
(1163, 'SIBUNDOY', 27, 86749),
(1164, 'SAN FRANCISCO', 27, 86755),
(1165, 'SAN MIGUEL', 27, 86757),
(1166, 'SANTIAGO', 27, 86760),
(1167, 'VALLE GUAMUEZ', 27, 86865),
(1168, 'LA HORMIGA-PUTUMAYO', 27, 86865),
(1169, 'VILLAGARZON', 27, 86885),
(1170, 'SAN ANDRES', 28, 88001),
(1171, 'PROVIDENCIA', 28, 88564),
(1172, 'LETICIA', 29, 91001),
(1173, 'EL ENCANTO', 29, 91263),
(1174, 'LA CHORRERA', 29, 91405),
(1175, 'LA PEDRERA', 29, 91407),
(1176, 'LA VICTORIA', 29, 91430),
(1177, 'MIRITI-PARANA', 29, 91460),
(1178, 'PUERTO ALEGRIA', 29, 91530),
(1179, 'PUERTO ALEGRIA', 29, 91530),
(1180, 'PUERTO NARIÑO', 29, 91540),
(1181, 'PTO SANTANDER', 29, 91669),
(1182, 'TARAPACA', 29, 91798),
(1183, 'INIRIDA', 30, 94001),
(1184, 'GUAVIARE', 30, 0),
(1185, 'MAPIRIPANA', 30, 94663),
(1186, 'SAN FELIPE', 30, 94883),
(1187, 'PUERTO COLOMBIA', 30, 94884),
(1188, 'LA GUADALUPE', 30, 94885),
(1189, 'CACAHUAL', 30, 94886),
(1190, 'PANA PANA', 30, 94887),
(1191, 'MORICHAL NUEVO', 30, 94888),
(1192, 'MIRAFLORES', 30, 0),
(1193, 'SAN JOSE DEL GUAVIARE', 31, 95001),
(1194, 'CALAMAR', 31, 95015),
(1195, 'EL RETORNO', 31, 95025),
(1196, 'MIRAFLORES', 31, 95200),
(1197, 'MORICHAL', 31, 95025),
(1198, 'MITU', 32, 97001),
(1199, 'CARURU', 32, 97161),
(1200, 'PACOA', 32, 97511),
(1201, 'TARAIRA', 32, 97666),
(1202, 'PAPUNAUA', 32, 97777),
(1203, 'YAVARATE', 32, 97889),
(1204, 'PUERTO CARRENO', 33, 99001),
(1205, 'NUEVA ANTIOQUIA', 33, 99524),
(1206, 'LA PRIMAVERA', 33, 99524),
(1207, 'SANTA RITA', 33, 99773),
(1208, 'SANTA ROSALIA', 33, 99624),
(1209, 'SAN JOSE DE OCUNE', 33, 99773),
(1210, 'CUMARIBO', 33, 99773),
(1211, 'SIN INFORMACION', 33, 0),
(1212, 'SAN JOSÉ DE URÉ', 10, 23682),
(1213, 'TIQUISIO', 4, 13810);

-- --------------------------------------------------------

--
-- Table structure for table `city_proyects`
--

CREATE TABLE `city_proyects` (
  `id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` int(11) NOT NULL,
  `fecha` varchar(60) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `observaciones` text,
  `proyect_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departaments`
--

CREATE TABLE `departaments` (
  `id` smallint(5) NOT NULL,
  `code` varchar(5) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `capital` varchar(50) NOT NULL,
  `index` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departaments`
--

INSERT INTO `departaments` (`id`, `code`, `name`, `capital`, `index`) VALUES
(1, 'ANT', 'ANTIOQUIA', 'MEDELLIN', 19),
(2, 'ATL', 'ATLANTICO', 'BARRANQUILLA', 7),
(3, 'BOG', 'BOGOTA', 'BOGOTA', 1),
(4, 'BOL', 'BOLIVAR', 'CARTAGENA', 9),
(5, 'BOY', 'BOYACA', 'TUNJA', 14),
(6, 'CAL', 'CALDAS', 'MANIZALES', 18),
(7, 'CAQ', 'CAQUETA', 'FLORENCIA', 4),
(8, 'CAU', 'CAUCA', 'POPAYAN', 33),
(9, 'CES', 'CESAR', 'VALLEDUPAR', 6),
(10, 'COR', 'CORDOBA', 'MONTERIA', 7),
(11, 'CUN', 'CUNDINAMARCA', 'BOGOTA', 31),
(12, 'CHO', 'CHOCÓ', 'QUIBDO', 3),
(13, 'HUI', 'HUILA', 'NEIVA', 19),
(14, 'GUAJ', 'LA GUAJIRA', 'RIOHACHA', 2),
(15, 'MAG', 'MAGDALENA', 'SANTA MARTA', 8),
(16, 'MET', 'META', 'VILLAVICENCIO', 6),
(17, 'NAR', 'NARINO', 'PASTO', 21),
(18, 'NOR', 'NORTE DE SANTANDER', 'CUCUTA', 7),
(19, 'QUI', 'QUINDIO', 'ARMENIA', 7),
(20, 'RIS', 'RISARALDA', 'PEREIRA', 12),
(21, 'SAN', 'SANTANDER', 'BUCARAMANGA', 8),
(22, 'SUC', 'SUCRE', 'SINCELEJO', 6),
(23, 'TOL', 'TOLIMA', 'IBAGUE', 9),
(24, 'VAL', 'VALLE DEL CAUCA', 'CALI', 9),
(25, 'ARA', 'ARAUCA', 'ARAUCA', 5),
(26, 'CAS', 'CASANARE', 'YOPAL', 6),
(27, 'PUT', 'PUTUMAYO', 'MOCOA', 3),
(28, 'SNA', 'SAN ANDRES', 'SAN ANDRES', 4),
(29, 'AMA', 'AMAZONAS', 'LETICIA', 6),
(30, 'GUAI', 'GUAINIA', 'INIRIDA', 8),
(31, 'GUAV', 'GUAVIARE', '', 4),
(32, 'VAU', 'VAUPES', '', 6),
(33, 'VIC', 'VICHADA', '', 8),
(37, '0', '', '', 1),
(38, '0', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `document_type_id` int(11) NOT NULL,
  `comentario` text,
  `entity_id` int(11) NOT NULL,
  `foreign_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `entity_id` int(11) NOT NULL,
  `enable` int(11) NOT NULL DEFAULT '1',
  `extension` varchar(60) DEFAULT NULL,
  `accept` varchar(120) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`id`, `nombre`, `entity_id`, `enable`, `extension`, `accept`) VALUES
(1, 'Certificado de tradición y libertad', 34, 1, 'pdf', 'application/pdf'),
(2, 'Impuestos', 34, 1, 'pdf', 'application/pdf'),
(3, 'Servicios publicos', 34, 1, 'pdf', 'application/pdf'),
(4, 'Facturas', 34, 1, 'pdf', 'application/pdf'),
(5, 'Contratos', 34, 1, 'pdf', 'application/pdf'),
(6, 'Documentos publicos', 34, 1, 'pdf', 'application/pdf'),
(7, 'Declaraciones de terceros', 34, 1, 'pdf', 'application/pdf'),
(8, 'Declaración de parte', 34, 1, 'pdf', 'application/pdf'),
(9, 'Dictamen pericial', 34, 1, 'pdf', 'application/pdf'),
(10, 'Inspección judicial', 34, 1, 'pdf', 'application/pdf'),
(11, 'Sana posesión', 34, 1, 'pdf', 'application/pdf'),
(12, 'Carta de alianza comercial', 23, 1, 'pdf', 'application/pdf'),
(13, 'Carta de intención de compra', 23, 1, 'pdf', 'application/pdf'),
(14, 'Modelo técnico financiero', 23, 1, 'xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
(15, 'Marco lógico', 23, 1, 'pdf', 'application/pdf'),
(16, 'Estudios adicionales (de mercado)', 23, 1, 'pdf', 'application/pdf'),
(17, 'Usos del suelo', 23, 1, 'pdf', 'application/pdf'),
(18, 'Licencias, concesiones y permisos ambientales', 23, 1, 'pdf', 'application/pdf'),
(19, 'Formato VIP-F4 cruce ambiental', 23, 1, 'pdf', 'application/pdf'),
(20, 'Formato VIP-F5 verificación jurídica del pred', 23, 1, 'pdf', 'application/pdf'),
(21, 'Formato VIP-F2 de caracterización de població', 23, 1, 'pdf', 'application/pdf'),
(22, 'Formato VIP-F8 perfil de proyecto', 23, 1, 'pdf', 'application/pdf'),
(23, 'Formato VIP-F6 registro de iniciativa product', 23, 1, 'pdf', 'application/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE `entities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`id`, `name`) VALUES
(10, 'ActionsGroups'),
(9, 'Actions'),
(11, 'Annotations'),
(12, 'Asociations'),
(13, 'Beneficiaries'),
(14, 'BeneficiaryRequirements'),
(15, 'Branches'),
(16, 'Calls'),
(17, 'Cities'),
(18, 'CityProyects'),
(19, 'Departaments'),
(20, 'Documents'),
(21, 'DocumentTypes'),
(22, 'Entities'),
(23, 'Evaluations'),
(24, 'Families'),
(25, 'Groups'),
(26, 'GroupsItems'),
(27, 'GroupsTabs'),
(28, 'Items'),
(29, 'Menus'),
(30, 'ObjectCreators'),
(31, 'Observations'),
(32, 'Pages'),
(33, 'Points'),
(34, 'Properties'),
(35, 'Proyects'),
(36, 'Relatives'),
(37, 'Requirements'),
(38, 'Resolutions'),
(39, 'Revisions'),
(40, 'Tabs'),
(41, 'TitleStudies'),
(42, 'TitleStudyDocuments'),
(43, 'UserProyects'),
(44, 'Users'),
(45, 'Payments'),
(46, 'BranchUsers'),
(47, 'Certifications'),
(48, 'Agreements'),
(49, 'Visits'),
(50, 'Committees'),
(51, 'Photographies'),
(52, 'Follows'),
(53, 'Extracts'),
(54, 'PlineProyects'),
(55, 'Services'),
(56, 'ProductProyects');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `observaciones` text,
  `fecha_concepto_final` date DEFAULT NULL,
  `observacion_concepto_final` text,
  `calificacion_concepto_final` varchar(30) DEFAULT NULL,
  `user_concepto_final` int(11) NOT NULL,
  `cofinanciacion` bigint(13) DEFAULT NULL,
  `contrapartida` bigint(20) DEFAULT NULL,
  `otras_fuentes` bigint(13) DEFAULT NULL,
  `cofinanciador` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `extracts`
--

CREATE TABLE `extracts` (
  `id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `observaciones` text,
  `saldo` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `id` int(11) NOT NULL,
  `tipo_identificacion` varchar(10) DEFAULT NULL,
  `numero_identificacion` varchar(80) DEFAULT NULL,
  `nombres` varchar(80) DEFAULT NULL,
  `primer_apellido` varchar(45) DEFAULT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `genero` varchar(30) DEFAULT NULL,
  `parentesco` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `sincronizado` tinyint(1) DEFAULT '0',
  `remote_id` int(11) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `beneficiary_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `observaciones` text,
  `proyect_id` int(11) NOT NULL,
  `tipo` varchar(25) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrador', NULL, NULL),
(15, 'fase 1', '2015-05-20 16:14:08', '2015-05-20 16:14:08'),
(16, 'Consulta', '2015-08-19 14:02:23', '2015-08-19 14:02:23'),
(17, 'Desembolsos', '2015-08-19 14:11:24', '2015-08-19 14:11:24'),
(18, 'Administrador2', '2015-08-20 21:31:22', '2015-08-20 21:31:22'),
(19, 'Inactivo', '2015-09-30 15:38:45', '2015-09-30 15:38:45'),
(20, 'Secretaria agricultura', '2015-10-02 14:59:13', '2015-10-02 14:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `groups_items`
--

CREATE TABLE `groups_items` (
  `item_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_items`
--

INSERT INTO `groups_items` (`item_id`, `group_id`) VALUES
(1, 1),
(4, 1),
(5, 1),
(6, 1),
(6, 2),
(6, 6),
(6, 18),
(10, 1),
(11, 1),
(25, 1),
(25, 2),
(25, 3),
(25, 4),
(25, 5),
(25, 6),
(25, 7),
(25, 8),
(25, 9),
(25, 11),
(25, 12),
(25, 13),
(25, 18),
(29, 1),
(29, 5),
(55, 1),
(55, 18),
(56, 1),
(56, 18),
(57, 1),
(57, 18),
(58, 1),
(58, 18),
(59, 1),
(59, 18),
(66, 1),
(66, 18),
(67, 1),
(68, 1),
(69, 1),
(69, 18),
(70, 1),
(70, 18),
(71, 1),
(71, 18),
(72, 1),
(72, 18),
(73, 1),
(73, 18),
(74, 1),
(74, 18),
(75, 1),
(75, 18);

-- --------------------------------------------------------

--
-- Table structure for table `groups_tabs`
--

CREATE TABLE `groups_tabs` (
  `tab_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_tabs`
--

INSERT INTO `groups_tabs` (`tab_id`, `group_id`) VALUES
(1, 1),
(1, 6),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(7, 8),
(7, 11),
(7, 12),
(7, 13),
(8, 4),
(8, 5),
(8, 6),
(8, 8),
(8, 9),
(8, 11),
(8, 12),
(8, 13),
(9, 4),
(9, 5),
(9, 6);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `nombre` varchar(55) DEFAULT NULL,
  `controlador` varchar(45) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `alias`, `nombre`, `controlador`, `accion`, `menu_id`, `orden`) VALUES
(1, '', 'Listar menus', 'Menus', 'index', 1, 1),
(4, '', 'Listar Items', 'Items', 'index', 1, 2),
(5, '', 'Listar grupos', 'groups', 'index', 28, 3),
(6, '', 'Listar usuarios', 'Users', 'index', 4, 0),
(10, '', 'Departamentos', 'Departaments', 'index', 7, 4),
(11, '', 'Municipios', 'Cities', 'index', 7, 3),
(57, '', 'Listado', 'branches', 'index', 24, 1),
(25, '', 'Listar propuestas', 'Proyects', 'index', 11, 1),
(29, 'listado de convocatorias', 'Listar convocatorias', 'Calls', 'index', 13, 0),
(69, '', 'Documentos', 'Payments', 'index', 29, 1),
(58, '', 'Predios', 'properties', 'index', 14, 3),
(59, '', 'Resoluciones', 'resolutions', 'index', 25, 1),
(55, '', 'Listado familias', 'Beneficiaries', 'index', 8, 2),
(56, '', 'Asociaciones', 'asociations', 'index', 23, 3),
(66, '', 'Estructuración del proyecto', 'Evaluations', 'index', 27, 1),
(67, '', 'Controladores', 'entities', 'index', 28, 1),
(68, '', 'Acciones', 'actions', 'index', 28, 2),
(70, '', 'Reportes', 'Pages', 'reports', 31, 2),
(71, '', 'Convenios', 'agreements', 'index', 24, 2),
(72, '', 'Plan inversión', 'Follows', 'index', 30, 1),
(73, '', 'Extractos', 'Extracts', 'index', 30, 2),
(74, '', 'Comités de compra', 'Committees', 'index', 30, 3),
(75, '', 'Visitas seguimiento', 'Visits', 'index', 30, 4);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `model_id` varchar(45) DEFAULT NULL,
  `action` varchar(45) DEFAULT NULL,
  `change` text,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `icono` varchar(25) DEFAULT NULL,
  `tab_id` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `alias` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `nombre`, `url`, `icono`, `tab_id`, `orden`, `alias`) VALUES
(1, 'Menus', '', 'sitemap', 1, 8, ''),
(2, 'Items', '', 'items.png', 1, 1000, ''),
(4, 'Usuarios', '', 'users', 1, 1000, ''),
(7, 'Parametros', '', 'tools_32.png', 2, 1000, ''),
(8, 'Familias', '', 'home', 3, 4, ''),
(24, 'Territoriales', '', 'suitcase', 1, 1000, NULL),
(11, 'Propuestas', '', 'book', 3, 2, ''),
(13, 'Convocatorias', '', '', 1, 1000, ''),
(14, 'Predios', '', 'tree', 3, 3, ''),
(25, 'Resoluciones', '', 'file-pdf-o', 10, 6, NULL),
(29, 'Desembolsos', '', 'money', 0, 9, NULL),
(21, 'Asignar  proyectos', '', '', 2, 1000, ''),
(23, 'Asociaciones', '', 'building-o', 3, 1, NULL),
(27, 'Estructuración del proyecto', '', 'tachometer', 0, 5, NULL),
(28, 'Permisos', '', 'key', 0, 10, NULL),
(30, 'Seguimiento', NULL, 'search', 0, 7, NULL),
(31, 'Reportes', NULL, 'table ', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `observations`
--

CREATE TABLE `observations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `observacion` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL,
  `asociation_id` int(11) DEFAULT NULL,
  `beneficiary_id` int(11) DEFAULT NULL,
  `nombre_banco` varchar(30) DEFAULT NULL,
  `numero_cuenta` varchar(30) DEFAULT NULL,
  `tipo_cuenta` varchar(15) DEFAULT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `fecha_desembolso` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `asignacion_recursos` varchar(10) DEFAULT NULL,
  `cedulas` varchar(10) DEFAULT NULL,
  `certificacion_requisitos` varchar(10) DEFAULT NULL,
  `verificacion_juridica` varchar(10) DEFAULT NULL,
  `certificacion_proyecto` varchar(10) DEFAULT NULL,
  `certificacion_rep_legal` varchar(10) DEFAULT NULL,
  `autorizaciones_especiales` varchar(10) DEFAULT NULL,
  `contrapartidas` varchar(10) DEFAULT NULL,
  `evaluacion_pp` varchar(10) DEFAULT NULL,
  `poliza_aprobacion` varchar(10) DEFAULT NULL,
  `certificacion_bancaria_cal` varchar(10) DEFAULT NULL,
  `observacion_calificacion` text,
  `calificacion_final` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photographies`
--

CREATE TABLE `photographies` (
  `id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `comentario` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plines`
--

CREATE TABLE `plines` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `abreviatura` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pline_proyects`
--

CREATE TABLE `pline_proyects` (
  `id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL,
  `pline_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `grados_latitud` int(11) DEFAULT NULL,
  `minutos_latitud` int(11) DEFAULT NULL,
  `segundos_latitud` double DEFAULT NULL,
  `grados_longitud` int(11) DEFAULT NULL,
  `minutos_longitud` int(11) DEFAULT NULL,
  `segundos_longitud` double DEFAULT NULL,
  `altitud` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nombre`, `descripcion`) VALUES
(5, 'ABONO SÓLIDO TIPO BOCASHI', ''),
(6, 'ABONOS VERDES', ''),
(7, 'ACHOTE', ''),
(8, 'AGROFORESTAL', ''),
(9, 'AGROINDUSTRIA LÁCTEA', ''),
(10, 'AGUACATE', ''),
(11, 'AHUYAMA ', ''),
(12, 'AJI', ''),
(13, 'AJONJOLI', ''),
(14, 'AJOS', ''),
(15, 'ALCAPARRAS', ''),
(16, 'APICULTURA', ''),
(17, 'ARAZA', ''),
(18, 'ARRACACHA', ''),
(19, 'ARROZ', ''),
(20, 'ARROZ SECANO', ''),
(21, 'ARVEJA', ''),
(22, 'AVENA', ''),
(23, 'AVICULTURA', ''),
(24, 'BANANO', ''),
(25, 'BANCO DE FORRAJERAS', ''),
(26, 'BANCO DE PROTEINA', ''),
(27, 'BANCO ENERGETICO PROTEINICO', ''),
(28, 'BERENJENA', ''),
(29, 'BIJAO ', ''),
(30, 'BOROJO', ''),
(31, 'BREVA', ''),
(32, 'BROCOLI', ''),
(33, 'BUFALOS', ''),
(34, 'CACAO', ''),
(35, 'CAFE', ''),
(36, 'CALABACIN', ''),
(37, 'CANELA', ''),
(38, 'CAÑA', ''),
(39, 'CAÑA  FORRAJERA', ''),
(40, 'CAÑA  PANELERA', ''),
(41, 'CAÑA DE AZUCAR', ''),
(42, 'CAPRINOS', ''),
(43, 'CARACOL', ''),
(44, 'CAUCHO', ''),
(45, 'CEBA DE CERDOS', ''),
(46, 'CEBADA', ''),
(47, 'CEBOLLA', ''),
(48, 'CEDRO', ''),
(49, 'CEBOLLA JUNCA', ''),
(50, 'CENTENO', ''),
(51, 'CHOLUPA', ''),
(52, 'CHONTADURO', ''),
(53, 'CILANTRO', ''),
(54, 'CIRUELA', ''),
(55, 'CITRICOS ', ''),
(56, 'CLAVOS DE OLOR', ''),
(57, 'COCO', ''),
(58, 'CORTEZAS MEDICINALES', ''),
(59, 'CUARTOS FRÍOS PARA MANEJO POSTCOSECHA', ''),
(60, 'CUNICULTURA', ''),
(61, 'CURIES', ''),
(62, 'CURUBA', ''),
(63, 'DURAZNO', ''),
(64, 'EQUINOS', ''),
(65, 'ESPARRAGO', ''),
(66, 'ESPECIES MENORES', ''),
(67, 'ESTROPAJO', ''),
(68, 'FLORES ', ''),
(69, 'FEIJOA ', ''),
(70, 'FOLLAJES', ''),
(71, 'FRESA', ''),
(72, 'FRIJOL', ''),
(73, 'FRUTALES', ''),
(74, 'GALLINAS PONEDORAS', ''),
(75, 'GANADERIA', ''),
(76, 'GANADERIA DE LECHE', ''),
(77, 'GANADERIA DOBLE PROPOSITO', ''),
(78, 'GANADO DE  LEVANTE', ''),
(79, 'GANDERIA DE CEBA', ''),
(80, 'GARBANZO', ''),
(81, 'GENGIBRE', ''),
(82, 'GERBERAS', ''),
(83, 'GIRASOL', ''),
(84, 'GRAMINEA', ''),
(85, 'GRANADILLA', ''),
(86, 'GUAMA', ''),
(87, 'GUANABANA', ''),
(88, 'GUANDUL ', ''),
(89, 'GUAYABA', ''),
(90, 'GUINEO', ''),
(91, 'GULUPA', ''),
(92, 'HABICHUELA', ''),
(93, 'HENO', ''),
(94, 'HIERBAS MEDICINALES', ''),
(95, 'HOJA DE FIQUE ', ''),
(96, 'HORTALIZAS Y LEGUMBRES', ''),
(97, 'HUERTA CASERA', ''),
(98, 'LECHUGA', ''),
(99, 'LEGUMINOSAS SECAS', ''),
(100, 'LICHIGO', ''),
(101, 'LIMON', ''),
(102, 'LINAZA', ''),
(103, 'LOMBRICULTIVO', ''),
(104, 'LULO', ''),
(105, 'MADERABLES', ''),
(106, 'MAIZ ', ''),
(107, 'MALANGA', ''),
(108, 'MANDARINA', ''),
(109, 'MANGO', ''),
(110, 'MANI', ''),
(111, 'MANZANA', ''),
(112, 'MARACUYA', ''),
(113, 'MARAÑON', ''),
(114, 'MEJORAMIENTO PRADERAS', ''),
(115, 'MELON', ''),
(116, 'MILLO SORGO', ''),
(117, 'MIMBRE-CAÑA ', ''),
(118, 'MORA', ''),
(119, 'NARANJA', ''),
(120, 'ÑAME', ''),
(121, 'OVINOS', ''),
(122, 'PALMA AFRICANA', ''),
(123, 'PALMA DE ACEITE', ''),
(124, 'PALMITOS', ''),
(125, 'PANCOGER', ''),
(126, 'PAPA', ''),
(127, 'PAPAYA', ''),
(128, 'PASTO ANGLETON', ''),
(129, 'PASTO CLIMACUNA', ''),
(130, 'PASTOS DE CORTE', ''),
(131, 'PASTOS MEJORADOS', ''),
(132, 'PASTOS NATURALES', ''),
(133, 'PATILLA', ''),
(134, 'PATOS', ''),
(135, 'PAVOS', ''),
(136, 'PEPINO', ''),
(137, 'PERAS', ''),
(138, 'PIMENTON', ''),
(139, 'PIMIENTA', ''),
(140, 'PIÑA', ''),
(141, 'PISCICULTURA', ''),
(142, 'PLANTAS ORNAMENTALES', ''),
(143, 'PLATANO', ''),
(144, 'POLLOS DE ENGORDE', ''),
(145, 'POMPONES', ''),
(146, 'PORCINOS', ''),
(147, 'QUINUA', ''),
(148, 'REMOLACHA', ''),
(149, 'REPOLLO', ''),
(150, 'RUSCUS', ''),
(151, 'SABILA', ''),
(152, 'SAGU', ''),
(153, 'SILVOPASTORIL', ''),
(154, 'SOSTENIMIENTO DE CAFÉ', ''),
(155, 'SOSTENIMIENTO DE PASTOS', ''),
(156, 'SOSTENIMIENTO DE PRADERAS', ''),
(157, 'SOYA', ''),
(158, 'TABACO', ''),
(159, 'TECA', ''),
(160, 'TOMATE DE ARBOL', ''),
(161, 'TOMATE EN INVERNADERO', ''),
(162, 'TRIGO EN GRANO', ''),
(163, 'UCHUVA', ''),
(164, 'UVAS', ''),
(165, 'YUCA ', ''),
(166, 'ZANAHORIA', ''),
(167, 'ZAPOTE', ''),
(168, 'ZOOCRIA', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_proyects`
--

CREATE TABLE `product_proyects` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL,
  `area_h` int(11) DEFAULT NULL,
  `area_m` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `nombre` varchar(90) DEFAULT NULL,
  `cedula_catastral` varchar(45) DEFAULT NULL,
  `vereda` varchar(60) DEFAULT NULL,
  `corregimiento` varchar(60) DEFAULT NULL,
  `area_total_ha` int(11) DEFAULT '0',
  `area_total_m` int(11) DEFAULT '0',
  `proyect_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `tipo_tenencia` varchar(30) DEFAULT NULL,
  `oficina_matricula` varchar(3) DEFAULT NULL,
  `numero_matricula` int(11) DEFAULT NULL,
  `requiere_permisos_ambientales` tinyint(1) DEFAULT NULL,
  `departament_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `proyects`
--

CREATE TABLE `proyects` (
  `id` int(11) NOT NULL,
  `codigo` varchar(60) DEFAULT NULL,
  `call_id` int(11) NOT NULL,
  `departament_id` int(11) NOT NULL,
  `tipo` enum('F','A','T','R') DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cerrado` tinyint(1) DEFAULT '0',
  `branch_id` int(11) NOT NULL,
  `nombre` text,
  `agreement_id` int(11) DEFAULT NULL,
  `asociation_id` int(11) NOT NULL,
  `valor_solicitado` double DEFAULT NULL,
  `objetivo` text,
  `fuentes_hidricas` text,
  `macroeconomica` text,
  `geografia` text,
  `economia` text,
  `fecha_radicacion` date DEFAULT NULL,
  `sistema_productivo` text,
  `produccion` text,
  `rendimiento` text,
  `costos` text,
  `infraestructura` text,
  `temperatura_promedio_p` double DEFAULT NULL,
  `temperatura_promedio_r` double DEFAULT NULL,
  `altitud_p` double DEFAULT NULL,
  `altitud_r` double DEFAULT NULL,
  `suelos_p` text,
  `suelos_r` text,
  `topografia_p` text,
  `topografia_r` text,
  `disponibilidad_hidrica_p` text,
  `disponibilidad_hidrica_r` text,
  `precipitacion_anual_p` text,
  `precipitacion_anual_r` text,
  `plagas` text,
  `control_plagas` text,
  `cosecha` text,
  `post_cosecha` text,
  `compradores_actuales` text,
  `ubicacion_comprador` text,
  `potencial_compradores` text,
  `valor_agregado` text,
  `porcentaje_ventas` text,
  `valor_ventas` text,
  `red_distribucion` text,
  `flete_interno` text,
  `flete_externo` text,
  `empaque` text,
  `oferta` text,
  `demanda` text,
  `canal_distribucion` text,
  `otro_distribucion` text,
  `precio_producto` double DEFAULT NULL,
  `competidores` text,
  `bpa_tiempo` varchar(60) DEFAULT NULL,
  `bpa_inversion` varchar(60) DEFAULT NULL,
  `bpg_tiempo` varchar(60) DEFAULT NULL,
  `bpg_inversion` varchar(60) DEFAULT NULL,
  `bpm_tiempo` varchar(60) DEFAULT NULL,
  `bpm_inversion` varchar(60) DEFAULT NULL,
  `organica_tiempo` varchar(60) DEFAULT NULL,
  `organica_inversion` varchar(60) DEFAULT NULL,
  `rainforest_tiempo` varchar(60) DEFAULT NULL,
  `rainforest_inversion` varchar(60) DEFAULT NULL,
  `otra_cert_tiempo` varchar(60) DEFAULT NULL,
  `otra_cert_inversion` varchar(60) DEFAULT NULL,
  `componente_ambiental` text,
  `uso_potencial_suelo` text,
  `valor_total` double DEFAULT NULL,
  `beneficiarios_definitivos` int(11) DEFAULT NULL,
  `ventas_mensuales` double DEFAULT NULL,
  `utilidades` double DEFAULT NULL,
  `area_ampliacion` double DEFAULT NULL,
  `area_acceso` double DEFAULT NULL,
  `valor_acceso` double DEFAULT NULL,
  `acceso_credito` text,
  `empleo_directo` text,
  `empleo_indirecto` text,
  `destinacion` text,
  `transformacion` text,
  `presentacion` text,
  `incremento_proyectado` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `proyects_asociations`
--

CREATE TABLE `proyects_asociations` (
  `id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL,
  `asociation_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `relatives`
--

CREATE TABLE `relatives` (
  `id` int(11) NOT NULL,
  `primer_nombre` varchar(45) DEFAULT NULL COMMENT '3.1.1 Primer Nombre',
  `segundo_nombre` varchar(45) DEFAULT NULL COMMENT '3.1.1 Segundo Nombre',
  `primer_apelllido` varchar(45) DEFAULT NULL COMMENT '3.1.1 Primer Apellido',
  `segundo_apellido` varchar(45) DEFAULT NULL COMMENT '3.1.1 Segundo apellido',
  `genero` enum('','Hombre','Mujer') DEFAULT NULL COMMENT '3.1 Composici?n de la familia. 3.1.2 Sexo ',
  `estado_civil` enum('Soltero','Casado','Union libre','Viudo','Divorciado') DEFAULT NULL COMMENT '3.1 Composici?n de la familia. 3.1.5 Estado civil ',
  `escolaridad` enum('Ninguna','Primaria','Secundaria','Técnico','Tecnólogo','Universitario') DEFAULT NULL COMMENT '3.1 Composici',
  `seguridad_social` enum('Cotizante regimen contributivo','Beneficiario regimen contributivo','Sisben','Otro','Ninguno','') DEFAULT NULL COMMENT '3.1 Composici',
  `ocupacion` enum('Agricultor','Ganadero','Comerciante','Artesano','Ama de casa','Estudiante','Desempleado','Pensionado','Sin dato','otro') DEFAULT NULL COMMENT '3.1 Composici',
  `nivel_sisben` int(11) DEFAULT NULL COMMENT '3.1 Composici?n de la familia. 3.1.9 Nivel Sisben ',
  `prestadora_salud` varchar(50) DEFAULT NULL COMMENT '3.1 Composici?n de la familia. 3.1.10 EPS o ARP ',
  `discapacidad` text COMMENT '3.1 Composici?n de la familia. 3.1.11 Enfermedad o Discapacidad ',
  `fecha_nacimiento` date DEFAULT NULL,
  `parentesco` enum('Jefe de hogar','Esposo(a)/Compañero(a)','Padres','Abuelo(a)','Hijo(a)','Hermano(a)','Nieto(a)','Tio(a)','Sobrino(a)','Ahijado(a)','Cuñado(a)','Primo(a)','Otro') DEFAULT NULL COMMENT '3.1 Composici',
  `edad` int(11) DEFAULT NULL COMMENT '3.1 Composici?n de la familia. 3.1.3 Edad',
  `candidate_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

CREATE TABLE `requirements` (
  `id` int(11) NOT NULL,
  `nombre` text,
  `texto_ayuda` text,
  `tipo` varchar(50) DEFAULT NULL,
  `puntaje_maximo` int(11) DEFAULT NULL,
  `call_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resolutions`
--

CREATE TABLE `resolutions` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `proyect_id` int(11) NOT NULL,
  `reviso` varchar(60) DEFAULT NULL,
  `comentario` text,
  `tipo` varchar(30) DEFAULT NULL,
  `proyecto` varchar(60) DEFAULT NULL,
  `numero_acta` int(11) DEFAULT NULL,
  `fecha_acta` date DEFAULT NULL,
  `fecha_convenio` date DEFAULT NULL,
  `numero_convenio` int(11) DEFAULT NULL,
  `visto_bueno` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
--

CREATE TABLE `revisions` (
  `id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `calificacion` varchar(30) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `valor` double DEFAULT NULL,
  `descripcion` text,
  `tipo` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE `tabs` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `icono` varchar(45) DEFAULT NULL,
  `orden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `title_studies`
--

CREATE TABLE `title_studies` (
  `id` int(11) NOT NULL,
  `pleno_dominio` varchar(2) DEFAULT NULL,
  `modo_adquisicion` varchar(50) DEFAULT NULL,
  `titulo_tipo` varchar(50) DEFAULT NULL,
  `titulo_numero` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `property_id` int(11) NOT NULL,
  `quien_expide_titulo` varchar(50) DEFAULT NULL,
  `aplica_excepcion` varchar(2) DEFAULT NULL,
  `excepcion` varchar(50) DEFAULT NULL,
  `concepto_final` text,
  `calificacion` varchar(50) DEFAULT NULL,
  `titulo_fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `title_study_documents`
--

CREATE TABLE `title_study_documents` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `entidad_expide` varchar(50) DEFAULT NULL,
  `title_study_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nombre` varchar(35) DEFAULT NULL,
  `primer_apellido` varchar(25) DEFAULT NULL,
  `segundo_apellido` varchar(25) DEFAULT NULL,
  `cedula` varchar(25) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `nombre`, `primer_apellido`, `segundo_apellido`, `cedula`, `telefono`, `group_id`, `branch_id`, `tipo`) VALUES
(385, 'fbejarano', '850404ce0b647e86932c3fde817eef9f70d9dcf0', 'vejaranov@gmail.com', 'Fredy Alexander', 'Bejarano', 'Gamboa', '80199501', '3208210633', 1, 6, 'Global');

-- --------------------------------------------------------

--
-- Table structure for table `user_proyects`
--

CREATE TABLE `user_proyects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `proyect_id` int(11) NOT NULL,
  `deforestacion` tinyint(1) DEFAULT NULL,
  `concesion_aguas` tinyint(1) DEFAULT NULL,
  `erosivo` tinyint(1) DEFAULT NULL,
  `remocion` tinyint(1) DEFAULT NULL,
  `contaminacion_hidrica` tinyint(1) DEFAULT NULL,
  `invasion_hidrica` tinyint(1) DEFAULT NULL,
  `residuo_solido` text,
  `obtiene_agua` enum('Acueducto veredal','Quebrada','Rio','Pozo','Aljibe','Agua lluvia') DEFAULT NULL,
  `observaciones` text,
  `fecha` date DEFAULT NULL,
  `modificacion` tinyint(1) DEFAULT NULL,
  `problemas_ambientales` text,
  `recomendaciones` text,
  `problemas_juridicos` text,
  `problemas_sociales` text,
  `problemas_comercializacion` text,
  `porcentaje_ejecucion` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `actions_groups`
--
ALTER TABLE `actions_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agreements`
--
ALTER TABLE `agreements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annotations`
--
ALTER TABLE `annotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asociations`
--
ALTER TABLE `asociations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nit` (`nit`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_beneficiaries_properties1_idx` (`proyect_id`),
  ADD KEY `identificacion` (`numero_identificacion`),
  ADD KEY `conyugue` (`beneficiary_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_users`
--
ALTER TABLE `branch_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cities_departaments1` (`departament_id`);

--
-- Indexes for table `city_proyects`
--
ALTER TABLE `city_proyects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departaments`
--
ALTER TABLE `departaments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extracts`
--
ALTER TABLE `extracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_beneficiaries_copy1_beneficiaries1_idx` (`beneficiary_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_follows_initial_evaluations1_idx` (`proyect_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_items`
--
ALTER TABLE `groups_items`
  ADD PRIMARY KEY (`item_id`,`group_id`);

--
-- Indexes for table `groups_tabs`
--
ALTER TABLE `groups_tabs`
  ADD PRIMARY KEY (`tab_id`,`group_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observations`
--
ALTER TABLE `observations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographies`
--
ALTER TABLE `photographies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plines`
--
ALTER TABLE `plines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pline_proyects`
--
ALTER TABLE `pline_proyects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_proyects`
--
ALTER TABLE `product_proyects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_properties_cities1_idx` (`city_id`),
  ADD KEY `fk_properties_proyects1_idx` (`proyect_id`),
  ADD KEY `nombre` (`nombre`);

--
-- Indexes for table `proyects`
--
ALTER TABLE `proyects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proyects_departaments1` (`departament_id`),
  ADD KEY `fk_proyects_calls1_idx` (`call_id`);

--
-- Indexes for table `proyects_asociations`
--
ALTER TABLE `proyects_asociations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relatives`
--
ALTER TABLE `relatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_relatives_candidates1` (`candidate_id`);

--
-- Indexes for table `requirements`
--
ALTER TABLE `requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resolutions`
--
ALTER TABLE `resolutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabs`
--
ALTER TABLE `tabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title_studies`
--
ALTER TABLE `title_studies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title_study_documents`
--
ALTER TABLE `title_study_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_users` (`username`,`password`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `fk_users_groups` (`group_id`),
  ADD KEY `fk_users_branches1` (`branch_id`);

--
-- Indexes for table `user_proyects`
--
ALTER TABLE `user_proyects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_proyects_polls1` (`user_id`),
  ADD KEY `fk_user_proyects_proyects1` (`proyect_id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `actions_groups`
--
ALTER TABLE `actions_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12136;
--
-- AUTO_INCREMENT for table `agreements`
--
ALTER TABLE `agreements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `annotations`
--
ALTER TABLE `annotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asociations`
--
ALTER TABLE `asociations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `branch_users`
--
ALTER TABLE `branch_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1214;
--
-- AUTO_INCREMENT for table `city_proyects`
--
ALTER TABLE `city_proyects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departaments`
--
ALTER TABLE `departaments`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `extracts`
--
ALTER TABLE `extracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `observations`
--
ALTER TABLE `observations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photographies`
--
ALTER TABLE `photographies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plines`
--
ALTER TABLE `plines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pline_proyects`
--
ALTER TABLE `pline_proyects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `product_proyects`
--
ALTER TABLE `product_proyects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proyects`
--
ALTER TABLE `proyects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proyects_asociations`
--
ALTER TABLE `proyects_asociations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `relatives`
--
ALTER TABLE `relatives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requirements`
--
ALTER TABLE `requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resolutions`
--
ALTER TABLE `resolutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tabs`
--
ALTER TABLE `tabs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `title_studies`
--
ALTER TABLE `title_studies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `title_study_documents`
--
ALTER TABLE `title_study_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=715;
--
-- AUTO_INCREMENT for table `user_proyects`
--
ALTER TABLE `user_proyects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
