-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2023 a las 02:08:18
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `educae`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admon` int(11) NOT NULL,
  `nombre_adm` varchar(30) NOT NULL,
  `apePat_adm` varchar(30) NOT NULL,
  `apeMa_adm` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(8) NOT NULL,
  `estatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admon`, `nombre_adm`, `apePat_adm`, `apeMa_adm`, `correo`, `pass`, `estatus`) VALUES
(3, 'Julio', 'prueba', 'prueba', '2', '2', 'prueba'),
(6, 'Julio', 'Antonio', 'Sanchez', 'bonsai_87@hotmail.com', 'Julio-j1', 'registrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_matricula` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apePat` varchar(20) NOT NULL,
  `apeMat` varchar(20) NOT NULL,
  `estatus` varchar(15) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_matricula`, `nombre`, `apePat`, `apeMat`, `estatus`, `correo`, `pass`, `matricula`) VALUES
(1, 'Francisco', 'Rodriguez', 'Alvarez', 'registrado', 'gendia12@gmail.com', 'prueba', 'AE123'),
(2, 'Rosario', 'Rodriguez', 'Zavaleta', 'registrado', 'peritoalbert@hotmail.com', 'prueba2', 'AE124'),
(3, 'Julio', 'Sesai', 'Antonio', 'registrado', 'Sanchez', 'Julio-j2', 'AE11195'),
(4, 'prueba Alumno', 'prueba', 'prueba', 'prueba', '2', '2', 'AE100'),
(5, 'Ernesto', 'Perez', 'Aguilar', 'registrado', 'ernest1234@gmail.com', 'Julio-j3', 'AE98107'),
(6, 'Maximo Eduardo ', 'Antonio ', 'Zavaleta', 'registrado', 'maximo88@hotmail.com', 'Julio-j1', 'AE82158'),
(7, 'Juan', 'Hernandez', 'Porras', 'registrado', 'popo@gmail.com', 'Julio-j1', 'AE37156'),
(8, 'Juan', 'Hernandez', 'Porras', 'registrado', 'popo@gmail.com', 'Julio-j1', 'AE24149'),
(9, 'Juan', 'Hernandez', 'Perez', 'registrado', 'perez@gmail.com', 'Julio-j1', 'AE91185'),
(11, 'Julio', 'Antonio', 'Perez', 'registrado', 'rodi1237@gmail.com', 'Julio-j2', 'AE11109'),
(12, 'Julio', 'Sesai', 'Hernandez', 'registrado', 'antony.sesai@gmail.com', 'Julio-j1', 'AE14118'),
(13, 'Julio Sesai ', 'Antonio ', 'Sanchez ', 'registrado', 'felipe@hotmail.com', 'Julio-j1', 'AE18114'),
(14, 'Juan Cárlo', 'Rodriguez ', 'Gónzalez', 'registrado', 'pruebasta@hotail.com', 'Julio-j1', 'AE40145'),
(32, 'julio', 'sesasi', 'sesasi', 'registrado', 'antonio.sesai@gmail.com', '108857343803141580444', 'AE47142');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_solicitud`
--

CREATE TABLE `alumno_solicitud` (
  `solicitud_alumno` int(11) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `estatus` varchar(20) NOT NULL,
  `fecha_sol` date NOT NULL,
  `id_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_escolar`
--

CREATE TABLE `control_escolar` (
  `id_cont_esc` int(11) NOT NULL,
  `nom_cont_esc` varchar(30) NOT NULL,
  `apePat_comt_esc` varchar(30) NOT NULL,
  `apeMat_cont_esc` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `estatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `control_escolar`
--

INSERT INTO `control_escolar` (`id_cont_esc`, `nom_cont_esc`, `apePat_comt_esc`, `apeMat_cont_esc`, `correo`, `pass`, `estatus`) VALUES
(100, 'Miguel', 'Rios', 'Paredes', '', '', 'activo'),
(101, 'Julio', 'Sesai', 'Antonio', 'Sanchez', 'Julio-j1', 'registrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credencial`
--

CREATE TABLE `credencial` (
  `id_credencial` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `fecha_vigencia` date NOT NULL,
  `estatus` varchar(10) NOT NULL,
  `id_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(10) NOT NULL,
  `nombre_curso` varchar(30) NOT NULL,
  `descripcion_curso` varchar(255) NOT NULL,
  `valor` int(4) NOT NULL,
  `imgCurso` text NOT NULL,
  `estatusCurso` varchar(10) NOT NULL,
  `id_admon` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_curso`, `nombre_curso`, `descripcion_curso`, `valor`, `imgCurso`, `estatusCurso`, `id_admon`, `id_categoria`) VALUES
(1061, 'ALGEBRA 2', 'Curso de algebra, en este curso aprenderas los cimientos del algebra, conceptos basicos y una entrad', 300, 'algebra.jpg', 'activo', 3, 3),
(1062, 'English I (Inglés I)', 'Los estudiantes de English I (Inglés I) desarrollan y perfeccionan sus habilidades\r\nde alfabetizació', 255, 'cursoIngles.jpg', 'activo', 3, 4),
(1063, 'Fisica 1', 'Curso de fisica para alumnos de primero de secundaria', 200, 'fisica.jpg', 'activo', 3, 3),
(1064, 'Geometria', 'Curso Basico de Geometria ', 100, 'geometria.png', 'activo', 3, 3),
(1065, 'Frances Basico', 'Curso basico de frances.', 120, 'cursoFrances.jpg', 'activo', 3, 4),
(1066, 'Redacción ', 'Curso de Redaccion.', 100, 'fisica.jpg', 'activo', 6, 5),
(1067, 'Como ser un Josephe', 'En este curso aprenderas desde sero hasta ser un Josepe.', 5000, 'WhatsApp Image 2022-10-18 at 3.45.43 PM.jpeg', 'inactivo', 3, 1),
(1078, 'Calculo Integral Avanzado', 'sdkñsakdñaskdaksñdksaldkñaskdñlaskñld', 300, 'geometria.png', 'activo', 3, 3),
(1079, 'Calculo Integral Avanzado', 'cassadasds', 255, 'geometria.png', 'activo', 3, 3),
(1080, 'sdasdassdsad', 'dsaasdasd', 255, 'redaccion.jpg', 'activo', 3, 1),
(1088, 'Curso Actualizado', 'Curso de prueba actualizado. ', 100, '152325326_3510574679064955_2704687163038419458_n.jpg', 'activo', 3, 1),
(1089, 'Curso de Prueba 1', 'Curso de prueba', 1, 'IMG-20211001-WA0174.jpg', 'activo', 3, 1),
(1091, 'Curso de domingo', 'Curso de domingo, pensando si valdra la pena todo esto, a lo mejor solo necesitaba poner un puesto de tacos, o retomar mi idea de los super dogos, creo que podria triunfar en eso, lo mas cercano ahora es terminar la carrera esperando que sea asi y todo sa', 1, 'IMG-20211001-WA0174.jpg', 'activo', 3, 4),
(1092, 'Curso de Minecraft', 'En este curso Eduardo te enseñara a como hacer los mejores Hacks. ', 222, 'tema2.jpg', 'activo', 6, 1),
(1098, 'Buena musica', 'Esta es mi lista de reproducción con los mejores temas de indi', 2, 'tema2.jpg', 'activo', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_alumno`
--

CREATE TABLE `curso_alumno` (
  `id_curso_alumno` int(10) NOT NULL,
  `dateStart` date NOT NULL,
  `datEnd` date DEFAULT NULL,
  `estatus` varchar(15) NOT NULL,
  `id_curso` int(10) NOT NULL,
  `id_matricula` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `curso_alumno`
--

INSERT INTO `curso_alumno` (`id_curso_alumno`, `dateStart`, `datEnd`, `estatus`, `id_curso`, `id_matricula`) VALUES
(1, '2022-11-02', '0000-00-00', 'activo', 1091, 4),
(2, '2022-11-02', NULL, 'agregado', 1062, 4),
(3, '2022-11-02', NULL, 'agregado', 1064, 4),
(19, '2022-11-03', NULL, 'activo', 1061, 3),
(20, '2022-11-03', NULL, 'agregado', 1088, 4),
(21, '2022-11-03', NULL, 'agregado', 1078, 4),
(22, '2022-11-03', NULL, 'agregado', 1079, 4),
(23, '2022-11-03', NULL, 'agregado', 1088, 4),
(24, '2022-11-03', NULL, 'agregado', 1088, 4),
(25, '2022-11-03', NULL, 'agregado', 1088, 5),
(26, '2022-11-03', NULL, 'agregado', 1066, 5),
(27, '2022-11-03', NULL, 'agregado', 1064, 4),
(37, '2023-01-23', NULL, 'agregado', 1063, 6),
(38, '2023-01-23', NULL, 'agregado', 1061, 6),
(39, '2023-01-23', NULL, 'agregado', 1091, 6),
(40, '2023-01-23', NULL, 'agregado', 1065, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_categoria`
--

CREATE TABLE `curso_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `curso_categoria`
--

INSERT INTO `curso_categoria` (`id_categoria`, `nombre_cat`) VALUES
(1, 'Tecnologia'),
(2, 'Ciencias Naturales'),
(3, 'Matematicas'),
(4, 'Idiomas'),
(5, 'Redaccion ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datcont_al`
--

CREATE TABLE `datcont_al` (
  `id_ datcont_al` int(11) NOT NULL,
  `tel_casa` int(11) NOT NULL,
  `celular` int(11) NOT NULL,
  `cel_recados` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datcont_dir`
--

CREATE TABLE `datcont_dir` (
  `id_datcont_dir` int(10) NOT NULL,
  `celular` int(10) NOT NULL,
  `tel_casa` int(10) NOT NULL,
  `cel_recados` int(10) NOT NULL,
  `id_directivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datcont_doct`
--

CREATE TABLE `datcont_doct` (
  `id_datcont_doct` int(11) NOT NULL,
  `tel_casa` int(10) NOT NULL,
  `celular` int(10) NOT NULL,
  `cel_recados` int(10) NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datcont_tut`
--

CREATE TABLE `datcont_tut` (
  `id_datcont_tut` int(11) NOT NULL,
  `tel_casa` int(10) NOT NULL,
  `celular` int(10) NOT NULL,
  `id_tutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datdom_al`
--

CREATE TABLE `datdom_al` (
  `id_datdom_al` int(11) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `colonia` varchar(30) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `id_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datdom_doct`
--

CREATE TABLE `datdom_doct` (
  `id_datdom_doct` int(11) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datper_admin`
--

CREATE TABLE `datper_admin` (
  `datper_admin` int(11) NOT NULL,
  `alergia_admin` varchar(50) NOT NULL,
  `curp_admin` varchar(18) NOT NULL,
  `edad_admin` int(2) NOT NULL,
  `fnac_admin` date NOT NULL,
  `sexo_admin` varchar(12) NOT NULL,
  `foto_admin` varchar(250) NOT NULL,
  `id_admon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datper_al`
--

CREATE TABLE `datper_al` (
  `id_datper_al` int(11) NOT NULL,
  `edad` int(2) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `fecha_nac` int(11) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `enf_cronica` varchar(50) NOT NULL,
  `alergia` varchar(50) NOT NULL,
  `id_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datper_al`
--

INSERT INTO `datper_al` (`id_datper_al`, `edad`, `sexo`, `foto`, `fecha_nac`, `curp`, `enf_cronica`, `alergia`, `id_matricula`) VALUES
(0, 0, '', 'https://lh3.googleusercontent.com/a/AEdFTp4g7wen_bt9vfCNuULdK4HOLM3HnSK8govJ6TNgwq0=s96-c', 0, '', '', '', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datper_dir`
--

CREATE TABLE `datper_dir` (
  `id_datper_dir` int(11) NOT NULL,
  `foto` blob NOT NULL,
  `fecha_nac` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `id_directivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datper_doct`
--

CREATE TABLE `datper_doct` (
  `id_datper_doct` int(11) NOT NULL,
  `foto` blob NOT NULL,
  `fecha_nac` date NOT NULL,
  `curp` varchar(18) NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directivo`
--

CREATE TABLE `directivo` (
  `id_directivo` int(11) NOT NULL,
  `nombre_dir` varchar(30) NOT NULL,
  `apePat_dir` varchar(30) NOT NULL,
  `apeMa_dir` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `estatus_directivo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `directivo`
--

INSERT INTO `directivo` (`id_directivo`, `nombre_dir`, `apePat_dir`, `apeMa_dir`, `correo`, `pass`, `estatus_directivo`) VALUES
(1, 'Sesai', 'Antonio', 'Sanchez', 'bonsai_87@hotmail.com', 'Julio-j1', 'activo'),
(2, 'ñldfsk', 'dlñks', 'dlñak', 'registrado', 'fslak', 'dsla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `nombre_doc` varchar(30) NOT NULL,
  `apePat_doc` varchar(30) NOT NULL,
  `apeMa_doc` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `estatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id_docente`, `nombre_doc`, `apePat_doc`, `apeMa_doc`, `correo`, `pass`, `estatus`) VALUES
(200, 'Ana Elena', 'Martinez', 'Mendoza', '', '', 'activo'),
(201, 'Julio', 'Antonio', 'Sanchez', 'bonsai_87@hotmail.com', 'Julio-j1', 'registrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_solicitud`
--

CREATE TABLE `docente_solicitud` (
  `solicitud_docente` int(11) NOT NULL,
  `asunto` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `fecha_sol` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(10) NOT NULL,
  `nombreGrupo` varchar(20) NOT NULL,
  `estatus` varchar(20) NOT NULL,
  `id_matricula` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa_ayuda`
--

CREATE TABLE `mesa_ayuda` (
  `id_folio` int(11) NOT NULL,
  `fecha_atencion` date NOT NULL,
  `solicitud_docente` int(11) NOT NULL,
  `solicitud_alumno` int(11) NOT NULL,
  `id_cont_esc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebafinal`
--

CREATE TABLE `pruebafinal` (
  `id_pruebaFinal` int(11) NOT NULL,
  `pregunta` varchar(150) NOT NULL,
  `respCorrecta` varchar(10) NOT NULL,
  `respSelec` varchar(10) NOT NULL,
  `califPfin` double NOT NULL,
  `id_curso` int(11) NOT NULL,
  `estatusPfin` varchar(10) NOT NULL,
  `id_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebarapida`
--

CREATE TABLE `pruebarapida` (
  `id_pruebaRapida` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pruebarapida`
--

INSERT INTO `pruebarapida` (`id_pruebaRapida`, `id_tema`) VALUES
(192, 8),
(276, 10),
(277, 11),
(278, 12),
(272, 13),
(270, 15),
(285, 16),
(287, 20),
(286, 21),
(284, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `nombre_tarea` varchar(50) NOT NULL,
  `instrucciones` varchar(255) NOT NULL,
  `estatus_tarea` varchar(10) NOT NULL,
  `date_tarea` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_alumno`
--

CREATE TABLE `tareas_alumno` (
  `id_tareasAlum` int(10) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `estatus_entrega` varchar(10) NOT NULL,
  `comenta_tarea` int(11) NOT NULL,
  `archivo_tarea` blob NOT NULL,
  `calificacion_tarea` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `nombre_tema` varchar(150) NOT NULL,
  `img_tema` varchar(50) NOT NULL,
  `vCont_tema` varchar(50) NOT NULL,
  `estatus_tema` varchar(10) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`id_tema`, `nombre_tema`, `img_tema`, `vCont_tema`, `estatus_tema`, `id_curso`) VALUES
(7, 'Constantes', 'constante.jpg', '2022-10-15 02-08-34.mp4', 'activo', 1061),
(8, 'Variables', 'variables.jpg', '2022-10-15 11-51-43.mp4', 'activo', 1061),
(10, 'Capivara 2', 'tema2.jpg', 'video de prueba 2.mp4', 'activo', 1088),
(11, 'Capivara tres', 'tema3.jpg', '2022-11-03 19-05-20.mp4', 'activo', 1088),
(12, 'Capivara 4', 'tema1.jpg', 'video de prueba 2.mp4', 'activo', 1088),
(13, 'Capivara 5', 'tema2.jpg', 'video de prueba 3.mp4', 'activo', 1088),
(14, 'Tema actualizado', 'tema2.jpg', 'video de prueba 3.mp4', 'activo', 1088),
(15, 'Prueba 2', 'cursoIngles.jpg', 'video de prueba 3.mp4', 'activo', 1088),
(16, 'Nuevo video', 'tema2.jpg', 'sesai1.mp4', 'activo', 1088),
(19, 'chafa', 'tema2.jpg', 'avanceForms.mp4', 'activo', 1091),
(20, 'chafa', 'tema3.jpg', 'video de prueba 2.mp4', 'activo', 1091),
(21, 'chafa', 'tema3.jpg', 'avancePT.mp4', 'activo', 1091),
(22, 'xd', 'tema2.jpg', 'avanceForms.mp4', 'activo', 1091),
(23, 'xd1', 'cursoFrances.jpg', 'avancePT.mp4', 'activo', 1091),
(24, 'Prueba1', 'tema3.jpg', 'avanceForms.mp4', 'activo', 1091),
(25, 'prueba233', 'tema2.jpg', 'avancePT.mp4', 'activo', 1091),
(26, 'pesado', 'Recibo-Ene.pdf', '5 formas de centrar con CSS.mp4', 'activo', 1091),
(27, 'rola 1', '152325326_3510574679064955_2704687163038419458_n.j', 'planEspectacula.mp4', 'activo', 1098),
(28, 'rola 2', 'WhatsApp Image 2022-01-16 at 8.09.22 PM.jpeg', 'noMehablesyback.mp4', 'activo', 1098);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test_preguntas`
--

CREATE TABLE `test_preguntas` (
  `id_test_pregunta` int(11) NOT NULL,
  `pregunta` varchar(250) NOT NULL,
  `respuesta_ok` varchar(250) NOT NULL,
  `respuesta_opc1` varchar(250) NOT NULL,
  `respuesta_opc2` varchar(250) NOT NULL,
  `respuesta_opc3` varchar(250) NOT NULL,
  `id_pruebaRapida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `test_preguntas`
--

INSERT INTO `test_preguntas` (`id_test_pregunta`, `pregunta`, `respuesta_ok`, `respuesta_opc1`, `respuesta_opc2`, `respuesta_opc3`, `id_pruebaRapida`) VALUES
(78, 'Prueba de medio dia', 'Es lo mejor de lo mejor :)', 'No porque mañana hay que trabajar temprano', 'Abandona todo', 'Has lo que quieras', 272),
(88, 'Estas funcionando 3', 'si', 'nose', 'busca error', 'metodos mal estructurados', 272),
(94, 'Prueba repetida', 'clñsld', 'ldska', 'ñdskañ', 'ñlksda', 272),
(95, 'Prueba 6', 'sdakj', 'lkjsda', 'dskaj', 'lksdaj', 272),
(96, 'Prueba 7', 'dsadakl', 'dañslkd', 'dslak', 'dlsak', 272),
(97, 'prueba 8', 'sdjkan', 'dksja', 'djksallkj', 'dsjadlasl', 272),
(103, 'Una nueva oportunidada', 'sda', 'dsak', 'dsa', 'dsa', 272),
(104, 'Apoyame por favor', 'skda', 'dsak', 'sdlakj', 'dslk', 272),
(106, 'Prueba 9', 'sdja', 'dksja', 'dslkaj', 'dslakj', 272),
(107, 'Set time out', 'es para establecer un cierto tiempo de ejecucion', 'no lo se ', 'no me interesa', 'eso es muy random', 272),
(113, 'dfsf', 'sfs', 'fsds', 'dsdfs', 'sdf', 284),
(115, 'Vemos turbo?', 'si', 'no', 'talvez', 'no lo se', 192),
(116, 'dlskaldak', 'lsak', 'sdalk', 'sasdñl', 'sladk', 192),
(118, 'Prueba para dormir', 'si ', 'no', 'ldks', 'ldkjsa', 272),
(119, 'Pregunta nueva', 'Es una pregunta no hecha anteriormente', 'ya preguntaste mucho', 'Deja de preguntar tanto', 'Jajajaja', 272),
(120, 'Codeando con Ivan', 'sdak', 'dsalkaj', 'dskja', 'dslkja', 192),
(121, 'que es el hoisting en js', 'Es la capacidad de subir scope las var ', 'es un servidor', 'es un punto de inflexion', 'jaja', 192),
(123, 'sadkj', 'ñdlska', 'dsñlak', 'ñdslka', 'dslñak', 270),
(124, 'Que es hoisting', 'Permite usar funciones y variables antes de que se hayan declarado.', 'es el servidor web', 'es la renta de un espacio para almacenar tu sitio web', 'ninguna de las anteriores', 272),
(125, 'Mejor edicion', 'dslkaj', 'dlskja', 'ldksja', 'dslka', 272),
(127, 'pregunta 1', 'ñsañ', 'dskñal', 'lñksa', 'dsaklñ', 277),
(129, 'Prueba numero 233', 'No funciona este codigo', 'slakj', 'dlskja', 'dlksja', 192),
(130, 'Prueba numero 234', 'No funciona este codigo', 'kldsaj', 'lsakj', 'dklaj', 192),
(143, 'sdmalk', 'dslkaj', 'ldkja', 'ldska', 'dslkaj', 192),
(144, 'dsma', 'ñlkds', 'lkdsa', 'dlska', 'dskla', 276),
(146, 'prueba candelaria', 'djkas', 'dsjka', 'dsajk', 'dsa', 272);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `id_tutor` int(10) NOT NULL,
  `nomTut` varchar(20) NOT NULL,
  `apePaTut` varchar(20) NOT NULL,
  `apeMaTu` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `pass` varchar(8) NOT NULL,
  `estatus` varchar(10) NOT NULL,
  `id_matricula` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admon`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_matricula`);

--
-- Indices de la tabla `alumno_solicitud`
--
ALTER TABLE `alumno_solicitud`
  ADD PRIMARY KEY (`solicitud_alumno`),
  ADD KEY `fk_id_matricula` (`id_matricula`);

--
-- Indices de la tabla `control_escolar`
--
ALTER TABLE `control_escolar`
  ADD PRIMARY KEY (`id_cont_esc`);

--
-- Indices de la tabla `credencial`
--
ALTER TABLE `credencial`
  ADD PRIMARY KEY (`id_credencial`),
  ADD KEY `fk_id_matricula` (`id_matricula`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fk_id_admon` (`id_admon`),
  ADD KEY `fk_id_categoria` (`id_categoria`);

--
-- Indices de la tabla `curso_alumno`
--
ALTER TABLE `curso_alumno`
  ADD PRIMARY KEY (`id_curso_alumno`),
  ADD KEY `fk_id_matricula` (`id_curso`),
  ADD KEY `fk_id_matricula_curso` (`id_matricula`),
  ADD KEY `fk_id_curso` (`id_curso`);

--
-- Indices de la tabla `curso_categoria`
--
ALTER TABLE `curso_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `datcont_al`
--
ALTER TABLE `datcont_al`
  ADD PRIMARY KEY (`id_ datcont_al`),
  ADD KEY `fk_id_matricula` (`id_matricula`);

--
-- Indices de la tabla `datcont_dir`
--
ALTER TABLE `datcont_dir`
  ADD PRIMARY KEY (`id_datcont_dir`),
  ADD KEY `fk_id_directivo` (`id_directivo`);

--
-- Indices de la tabla `datcont_doct`
--
ALTER TABLE `datcont_doct`
  ADD KEY `fk_id_docente` (`id_docente`);

--
-- Indices de la tabla `datcont_tut`
--
ALTER TABLE `datcont_tut`
  ADD PRIMARY KEY (`id_datcont_tut`),
  ADD KEY `fk_id_tutor` (`id_tutor`);

--
-- Indices de la tabla `datdom_al`
--
ALTER TABLE `datdom_al`
  ADD PRIMARY KEY (`id_datdom_al`),
  ADD KEY `fk_id_matricula` (`id_matricula`);

--
-- Indices de la tabla `datdom_doct`
--
ALTER TABLE `datdom_doct`
  ADD PRIMARY KEY (`id_datdom_doct`),
  ADD KEY `fk_id_docente` (`id_docente`);

--
-- Indices de la tabla `datper_admin`
--
ALTER TABLE `datper_admin`
  ADD PRIMARY KEY (`datper_admin`),
  ADD KEY `fk_id_admon` (`id_admon`);

--
-- Indices de la tabla `datper_al`
--
ALTER TABLE `datper_al`
  ADD KEY `fk_id_matricula` (`id_matricula`);

--
-- Indices de la tabla `datper_dir`
--
ALTER TABLE `datper_dir`
  ADD PRIMARY KEY (`id_datper_dir`),
  ADD KEY `fk_id_directivo` (`id_directivo`);

--
-- Indices de la tabla `datper_doct`
--
ALTER TABLE `datper_doct`
  ADD PRIMARY KEY (`id_datper_doct`),
  ADD KEY `fk_id_docente` (`id_docente`);

--
-- Indices de la tabla `directivo`
--
ALTER TABLE `directivo`
  ADD PRIMARY KEY (`id_directivo`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `docente_solicitud`
--
ALTER TABLE `docente_solicitud`
  ADD PRIMARY KEY (`solicitud_docente`),
  ADD KEY `FK_id_docente` (`id_docente`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `fk_id_matricula` (`id_matricula`);

--
-- Indices de la tabla `mesa_ayuda`
--
ALTER TABLE `mesa_ayuda`
  ADD PRIMARY KEY (`id_folio`),
  ADD KEY `FK_solicitud_docente` (`solicitud_docente`),
  ADD KEY `FK_solicitud_alumno` (`solicitud_alumno`),
  ADD KEY `FK_id_cont_esc` (`id_cont_esc`);

--
-- Indices de la tabla `pruebafinal`
--
ALTER TABLE `pruebafinal`
  ADD PRIMARY KEY (`id_pruebaFinal`),
  ADD KEY `fk_id_curso` (`id_curso`),
  ADD KEY `fk_id_matricula` (`id_matricula`);

--
-- Indices de la tabla `pruebarapida`
--
ALTER TABLE `pruebarapida`
  ADD PRIMARY KEY (`id_pruebaRapida`),
  ADD KEY `fk_id_tema` (`id_tema`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`);

--
-- Indices de la tabla `tareas_alumno`
--
ALTER TABLE `tareas_alumno`
  ADD PRIMARY KEY (`id_tareasAlum`),
  ADD KEY `fk_id_matricula` (`id_matricula`),
  ADD KEY `fk_id_tarea` (`id_tarea`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `fk_id_curso` (`id_curso`);

--
-- Indices de la tabla `test_preguntas`
--
ALTER TABLE `test_preguntas`
  ADD PRIMARY KEY (`id_test_pregunta`),
  ADD KEY `id_pruebaRapida` (`id_pruebaRapida`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id_tutor`),
  ADD KEY `fk_id_matricula` (`id_matricula`),
  ADD KEY `id_matricula` (`id_matricula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_matricula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `alumno_solicitud`
--
ALTER TABLE `alumno_solicitud`
  MODIFY `solicitud_alumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_escolar`
--
ALTER TABLE `control_escolar`
  MODIFY `id_cont_esc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `credencial`
--
ALTER TABLE `credencial`
  MODIFY `id_credencial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1099;

--
-- AUTO_INCREMENT de la tabla `curso_alumno`
--
ALTER TABLE `curso_alumno`
  MODIFY `id_curso_alumno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `curso_categoria`
--
ALTER TABLE `curso_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `datcont_al`
--
ALTER TABLE `datcont_al`
  MODIFY `id_ datcont_al` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datcont_dir`
--
ALTER TABLE `datcont_dir`
  MODIFY `id_datcont_dir` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datcont_tut`
--
ALTER TABLE `datcont_tut`
  MODIFY `id_datcont_tut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datdom_al`
--
ALTER TABLE `datdom_al`
  MODIFY `id_datdom_al` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datdom_doct`
--
ALTER TABLE `datdom_doct`
  MODIFY `id_datdom_doct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datper_admin`
--
ALTER TABLE `datper_admin`
  MODIFY `datper_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datper_dir`
--
ALTER TABLE `datper_dir`
  MODIFY `id_datper_dir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datper_doct`
--
ALTER TABLE `datper_doct`
  MODIFY `id_datper_doct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `directivo`
--
ALTER TABLE `directivo`
  MODIFY `id_directivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT de la tabla `docente_solicitud`
--
ALTER TABLE `docente_solicitud`
  MODIFY `solicitud_docente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa_ayuda`
--
ALTER TABLE `mesa_ayuda`
  MODIFY `id_folio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pruebafinal`
--
ALTER TABLE `pruebafinal`
  MODIFY `id_pruebaFinal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pruebarapida`
--
ALTER TABLE `pruebarapida`
  MODIFY `id_pruebaRapida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tareas_alumno`
--
ALTER TABLE `tareas_alumno`
  MODIFY `id_tareasAlum` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `test_preguntas`
--
ALTER TABLE `test_preguntas`
  MODIFY `id_test_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id_tutor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno_solicitud`
--
ALTER TABLE `alumno_solicitud`
  ADD CONSTRAINT `alumno_solicitud_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `credencial`
--
ALTER TABLE `credencial`
  ADD CONSTRAINT `credencial_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_admon`) REFERENCES `administrador` (`id_admon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `curso_categoria` (`id_categoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `curso_alumno`
--
ALTER TABLE `curso_alumno`
  ADD CONSTRAINT `curso_alumno_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `curso_alumno_ibfk_2` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datcont_al`
--
ALTER TABLE `datcont_al`
  ADD CONSTRAINT `datcont_al_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datcont_dir`
--
ALTER TABLE `datcont_dir`
  ADD CONSTRAINT `datcont_dir_ibfk_1` FOREIGN KEY (`id_directivo`) REFERENCES `directivo` (`id_directivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datcont_doct`
--
ALTER TABLE `datcont_doct`
  ADD CONSTRAINT `datcont_doct_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datcont_tut`
--
ALTER TABLE `datcont_tut`
  ADD CONSTRAINT `datcont_tut_ibfk_1` FOREIGN KEY (`id_tutor`) REFERENCES `tutor` (`id_tutor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datdom_al`
--
ALTER TABLE `datdom_al`
  ADD CONSTRAINT `datdom_al_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datdom_doct`
--
ALTER TABLE `datdom_doct`
  ADD CONSTRAINT `datdom_doct_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datper_admin`
--
ALTER TABLE `datper_admin`
  ADD CONSTRAINT `datper_admin_ibfk_1` FOREIGN KEY (`id_admon`) REFERENCES `administrador` (`id_admon`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `datper_al`
--
ALTER TABLE `datper_al`
  ADD CONSTRAINT `datper_al_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datper_dir`
--
ALTER TABLE `datper_dir`
  ADD CONSTRAINT `datper_dir_ibfk_1` FOREIGN KEY (`id_directivo`) REFERENCES `directivo` (`id_directivo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datper_doct`
--
ALTER TABLE `datper_doct`
  ADD CONSTRAINT `datper_doct_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docente_solicitud`
--
ALTER TABLE `docente_solicitud`
  ADD CONSTRAINT `docente_solicitud_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa_ayuda`
--
ALTER TABLE `mesa_ayuda`
  ADD CONSTRAINT `mesa_ayuda_ibfk_2` FOREIGN KEY (`solicitud_docente`) REFERENCES `docente_solicitud` (`solicitud_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mesa_ayuda_ibfk_3` FOREIGN KEY (`solicitud_alumno`) REFERENCES `alumno_solicitud` (`solicitud_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mesa_ayuda_ibfk_4` FOREIGN KEY (`id_cont_esc`) REFERENCES `control_escolar` (`id_cont_esc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pruebafinal`
--
ALTER TABLE `pruebafinal`
  ADD CONSTRAINT `pruebafinal_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pruebafinal_ibfk_2` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pruebarapida`
--
ALTER TABLE `pruebarapida`
  ADD CONSTRAINT `pruebarapida_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tareas_alumno`
--
ALTER TABLE `tareas_alumno`
  ADD CONSTRAINT `tareas_alumno_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tareas_alumno_ibfk_2` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `test_preguntas`
--
ALTER TABLE `test_preguntas`
  ADD CONSTRAINT `test_preguntas_ibfk_1` FOREIGN KEY (`id_pruebaRapida`) REFERENCES `pruebarapida` (`id_pruebaRapida`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`id_matricula`) REFERENCES `alumno` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
