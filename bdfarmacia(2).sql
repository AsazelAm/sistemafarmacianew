-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 28-09-2025 a las 23:31:00
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdfarmacia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `ci` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nit` varchar(20) DEFAULT NULL,
  `razon_social` varchar(200) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `numero_factura` varchar(100) DEFAULT NULL,
  `fecha_compra` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_entrega` date DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `descuento` decimal(12,2) DEFAULT 0.00,
  `impuestos` decimal(12,2) DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL,
  `Estado` enum('pendiente','recibida','parcial','cancelada') DEFAULT 'pendiente',
  `observaciones` text DEFAULT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle_compra` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `nombre`, `avatar`, `Estado`, `fecha_creacion`) VALUES
(1, 'Farmacia La Esperanza', '68d99c961c459-CamScanner 03-02-2024 11.03.jpg', 1, '2025-09-28 13:10:38'),
(2, 'Industrial Farmacéutica (IFA)', 'ifa.png', 1, '2025-09-28 13:10:38'),
(3, 'Droguería INTI S.R.L.', 'inti.png', 1, '2025-09-28 13:10:38'),
(4, 'Laboratorio Vijosa', 'vijosa.png', 1, '2025-09-28 13:10:38'),
(5, 'Farmacorp S.A.', 'farmacorp.png', 1, '2025-09-28 13:10:38'),
(6, 'Laboratorios Alcos S.R.L.', 'alcos.png', 1, '2025-09-28 13:10:38'),
(7, 'Laboratorio Crespal', 'crespal.png', 1, '2025-09-28 13:10:38'),
(8, 'Laboratorios Beta S.A.', 'beta.png', 1, '2025-09-28 13:10:38'),
(9, 'Droguería Santa Cruz', 'drogueria_sc.png', 1, '2025-09-28 13:10:38'),
(10, 'Laboratorios Genfar Bolivia', 'genfar.png', 1, '2025-09-28 13:10:38'),
(11, 'Bayer S.A.', 'bayer.png', 1, '2025-09-28 13:10:38'),
(12, 'Pfizer', 'pfizer.png', 1, '2025-09-28 13:10:38'),
(13, 'Novartis', 'novartis.png', 1, '2025-09-28 13:10:38'),
(14, 'Roche', 'roche.png', 1, '2025-09-28 13:10:38'),
(15, 'Johnson & Johnson', 'jj.png', 1, '2025-09-28 13:10:38'),
(16, 'Abbott', 'abbott.png', 1, '2025-09-28 13:10:38'),
(17, 'Merck', 'merck.png', 1, '2025-09-28 13:10:38'),
(18, 'Sanofi', 'sanofi.png', 1, '2025-09-28 13:10:38'),
(19, 'GSK (GlaxoSmithKline)', 'gsk.png', 1, '2025-09-28 13:10:38'),
(20, 'Boehringer Ingelheim', 'boehringer.png', 1, '2025-09-28 13:10:38'),
(21, 'Teva Pharmaceutical', 'teva.png', 1, '2025-09-28 13:10:38'),
(22, 'Sandoz', 'sandoz.png', 1, '2025-09-28 13:10:38'),
(23, 'Medley', 'medley.png', 1, '2025-09-28 13:10:38'),
(24, 'Tecnoquímicas', 'tecnoquimicas.png', 1, '2025-09-28 13:10:38'),
(25, 'Lafrancol', 'lafrancol.png', 1, '2025-09-28 13:10:38'),
(26, 'Laboratorios Bagó de Bolivia S.A', 'lab-default.jpg', 1, '2025-09-28 16:40:06'),
(27, 'prueba', 'lab-default.jpg', 1, '2025-09-28 16:42:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `numero_lote` varchar(100) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `fecha_ingreso` date DEFAULT curdate(),
  `fecha_fabricacion` date DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id_presentacion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `Estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id_presentacion`, `nombre`, `Estado`) VALUES
(1, 'Tabletas', 1),
(2, 'Cápsulas', 1),
(3, 'Jarabe', 1),
(4, 'Suspensión', 1),
(5, 'Inyectable', 1),
(6, 'Crema', 1),
(7, 'Pomada', 1),
(8, 'Gel', 1),
(9, 'Gotas', 1),
(10, 'Spray', 1),
(11, 'Supositorio', 1),
(12, 'Óvulos', 1),
(13, 'Parche', 1),
(14, 'Inhalador', 1),
(15, 'Polvo', 1),
(16, 'Granulado', 1),
(17, 'Solución', 1),
(18, 'Emulsión', 1),
(19, 'Loción', 1),
(20, 'Shampoo', 1),
(21, 'Colirio', 1),
(22, 'Ungüento', 1),
(23, 'Sobres', 1),
(24, 'Ampolla', 1),
(25, 'Vial', 1),
(26, 'prueba1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `codigo_barra` varchar(50) DEFAULT NULL,
  `nombre_generico` varchar(150) NOT NULL,
  `nombre_comercial` varchar(150) NOT NULL,
  `concentracion` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `requiere_receta` tinyint(1) DEFAULT 0,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `contraindicaciones` text DEFAULT NULL,
  `via_administracion` varchar(200) DEFAULT NULL,
  `stock_minimo` int(11) DEFAULT 10,
  `Estado` tinyint(1) DEFAULT 1,
  `id_laboratorio` int(11) NOT NULL,
  `id_tipo_producto` int(11) NOT NULL,
  `id_presentacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo_barra`, `nombre_generico`, `nombre_comercial`, `concentracion`, `descripcion`, `precio`, `requiere_receta`, `fecha_creacion`, `contraindicaciones`, `via_administracion`, `stock_minimo`, `Estado`, `id_laboratorio`, `id_tipo_producto`, `id_presentacion`) VALUES
(1, '7501234567890', 'Paracetamol', 'Acetaminofén IFA', '500mg', 'Analgésico y antipirético para dolor leve a moderado', '8.50', 0, '2025-09-28 13:13:05', 'Hipersensibilidad al paracetamol, insuficiencia hepática grave', 'Oral', 50, 1, 2, 1, 1),
(2, '7501234567891', 'Ibuprofeno', 'Ibuprofeno Bagó', '400mg', 'Antiinflamatorio no esteroideo', '12.00', 0, '2025-09-28 13:13:05', 'Úlcera péptica, insuficiencia renal grave', 'Oral', 40, 1, 1, 1, 1),
(3, '7501234567892', 'Aspirina', 'AAS Bayer', '500mg', 'Analgésico, antipirético y antiinflamatorio', '15.00', 0, '2025-09-28 13:13:05', 'Hemofilia, úlcera péptica activa', 'Oral', 30, 1, 11, 1, 1),
(4, '7501234567893', 'Diclofenaco', 'Voltaren', '50mg', 'Antiinflamatorio no esteroideo', '18.50', 0, '2025-09-28 13:13:05', 'Úlcera péptica, insuficiencia cardiaca grave', 'Oral', 35, 1, 13, 1, 1),
(5, '7501234567894', 'Amoxicilina', 'Amoxil', '500mg', 'Antibiótico betalactámico', '25.00', 1, '2025-09-28 13:13:05', 'Alergia a penicilinas', 'Oral', 25, 1, 15, 1, 2),
(6, '7501234567895', 'Azitromicina', 'Zitromax', '500mg', 'Antibiótico macrólido', '35.00', 1, '2025-09-28 13:13:05', 'Hipersensibilidad a macrólidos', 'Oral', 20, 1, 12, 1, 1),
(7, '7501234567896', 'Ciprofloxacino', 'Cipro', '500mg', 'Antibiótico fluoroquinolona', '28.00', 1, '2025-09-28 13:13:05', 'Menores de 18 años, embarazo', 'Oral', 20, 1, 11, 1, 1),
(8, '7501234567897', 'Cefalexina', 'Keflex', '500mg', 'Antibiótico cefalosporina', '32.00', 1, '2025-09-28 13:13:05', 'Alergia a cefalosporinas', 'Oral', 18, 1, 1, 1, 2),
(9, '7501234567898', 'Loratadina', 'Clarityne', '10mg', 'Antihistamínico no sedante', '22.00', 0, '2025-09-28 13:13:05', 'Hipersensibilidad a loratadina', 'Oral', 30, 1, 19, 1, 1),
(10, '7501234567899', 'Cetirizina', 'Zyrtec', '10mg', 'Antihistamínico de segunda generación', '24.00', 0, '2025-09-28 13:13:05', 'Insuficiencia renal grave', 'Oral', 25, 1, 15, 1, 1),
(11, '7501234567900', 'Difenhidramina', 'Benadryl', '25mg', 'Antihistamínico sedante', '18.00', 0, '2025-09-28 13:13:05', 'Glaucoma, hipertrofia prostática', 'Oral', 20, 1, 15, 1, 1),
(12, '7501234567901', 'Omeprazol', 'Losec', '20mg', 'Inhibidor de bomba de protones', '28.00', 0, '2025-09-28 13:13:05', 'Hipersensibilidad al omeprazol', 'Oral', 40, 1, 16, 1, 2),
(13, '7501234567902', 'Ranitidina', 'Zantac', '150mg', 'Antagonista H2', '20.00', 0, '2025-09-28 13:13:05', 'Hipersensibilidad a ranitidina', 'Oral', 30, 1, 19, 1, 1),
(14, '7501234567903', 'Loperamida', 'Imodium', '2mg', 'Antidiarreico', '16.00', 0, '2025-09-28 13:13:05', 'Colitis ulcerosa, megacolon tóxico', 'Oral', 25, 1, 15, 1, 2),
(15, '7501234567904', 'Simeticona', 'Espumisan', '40mg', 'Antiflatulento', '14.00', 0, '2025-09-28 13:13:05', 'Obstrucción intestinal', 'Oral', 35, 1, 11, 1, 2),
(16, '7501234567905', 'Complejo B', 'Bedoyecta', '1ml', 'Suplemento vitamínico del complejo B', '45.00', 0, '2025-09-28 13:13:05', 'Hipersensibilidad a componentes', 'Intramuscular', 15, 1, 1, 2, 5),
(17, '7501234567906', 'Ácido Fólico', 'Folacin', '5mg', 'Vitamina B9 para prevenir anemia', '12.00', 0, '2025-09-28 13:13:05', 'Anemia megaloblástica por B12', 'Oral', 40, 1, 16, 2, 1),
(18, '7501234567907', 'Vitamina C', 'Cevalin', '500mg', 'Antioxidante y refuerzo inmunológico', '18.00', 0, '2025-09-28 13:13:05', 'Cálculos renales oxálicos', 'Oral', 50, 1, 11, 2, 1),
(19, '7501234567908', 'Calcio + Vitamina D', 'Caltrate', '600mg+400UI', 'Suplemento para huesos', '35.00', 0, '2025-09-28 13:13:05', 'Hipercalcemia, sarcoidosis', 'Oral', 20, 1, 12, 2, 1),
(20, '7501234567909', 'Diclofenaco tópico', 'Voltaren Emulgel', '1%', 'Antiinflamatorio tópico', '25.00', 0, '2025-09-28 13:13:05', 'Dermatitis alérgica', 'Tópica', 20, 1, 13, 1, 8),
(21, '7501234567910', 'Hidrocortisona', 'Cortisón', '1%', 'Corticoide tópico antiinflamatorio', '22.00', 0, '2025-09-28 13:13:05', 'Infecciones cutáneas bacterianas', 'Tópica', 25, 1, 1, 1, 6),
(22, '7501234567911', 'Clotrimazol', 'Canesten', '1%', 'Antifúngico tópico', '28.00', 0, '2025-09-28 13:13:05', 'Hipersensibilidad al clotrimazol', 'Tópica', 18, 1, 11, 1, 6),
(23, '7501234567912', 'Alcohol en gel', 'Alcohol Gel Bagó', '70%', 'Desinfectante de manos', '12.00', 0, '2025-09-28 13:13:05', 'Heridas abiertas', 'Tópica', 60, 1, 1, 3, 8),
(24, '7501234567913', 'Agua oxigenada', 'Peróxido', '3%', 'Antiséptico y desinfectante', '8.00', 0, '2025-09-28 13:13:05', 'Heridas profundas cerradas', 'Tópica', 40, 1, 2, 3, 17),
(25, '7501234567914', 'Yodo', 'Yodopovidona', '10%', 'Antiséptico yodado', '15.00', 0, '2025-09-28 13:13:05', 'Alergia al yodo, hipertiroidismo', 'Tópica', 30, 1, 1, 3, 17),
(26, '7501234567915', 'Dextrometorfano', 'Robitussin', '15mg/5ml', 'Antitusivo para tos seca', '24.00', 0, '2025-09-28 13:13:05', 'Depresión respiratoria', 'Oral', 25, 1, 15, 1, 3),
(27, '7501234567916', 'Guaifenesina', 'Mucinex', '100mg/5ml', 'Expectorante para tos productiva', '28.00', 0, '2025-09-28 13:13:05', 'Hipersensibilidad a guaifenesina', 'Oral', 20, 1, 16, 1, 3),
(28, '7501234567917', 'Ambroxol', 'Mucosolvan', '15mg/5ml', 'Mucolítico y expectorante', '32.00', 0, '2025-09-28 13:13:05', 'Úlcera péptica', 'Oral', 30, 1, 11, 1, 3),
(29, '7501234567918', 'Lágrimas artificiales', 'Systane', '0.5%', 'Lubricante ocular', '35.00', 0, '2025-09-28 13:13:05', 'Hipersensibilidad a componentes', 'Oftálmica', 15, 1, 16, 5, 21),
(30, '7501234567919', 'Tobramicina', 'Tobrex', '0.3%', 'Antibiótico oftálmico', '42.00', 1, '2025-09-28 13:13:05', 'Infecciones virales oculares', 'Oftálmica', 12, 1, 13, 1, 21),
(31, '7501234567920', 'Maleato de timolol', 'Timoptol', '0.5%', 'Tratamiento del glaucoma', '85.00', 1, '2025-09-28 13:13:05', 'Asma, bradicardia', 'Oftálmica', 8, 1, 17, 1, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `contacto_principal` varchar(100) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `fechar_registro` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `codigo`, `nombre`, `telefono`, `email`, `direccion`, `contacto_principal`, `Estado`, `fechar_registro`) VALUES
(1, 'PROV001', 'Distribuidora Farmacéutica La Paz', '+591-2-2441234', 'ventas@distfarm-lp.com', 'Av. Buenos Aires 1234, La Paz', 'Carlos Mendoza', 1, '2025-09-28'),
(2, 'PROV002', 'DIFARE Santa Cruz', '+591-3-3351234', 'comercial@difare.com.bo', 'Av. Cristo Redentor 567, Santa Cruz', 'María González', 1, '2025-09-28'),
(3, 'PROV003', 'Droguería Boliviana S.A.', '+591-4-4251234', 'info@drogbol.com', 'Calle Jordán 890, Cochabamba', 'Juan Pérez', 1, '2025-09-28'),
(4, 'PROV004', 'Farmacorp Distribuidora', '+591-2-2771234', 'distribuidora@farmacorp.bo', 'Zona Sur, Calle 21 #456, La Paz', 'Ana Rodríguez', 1, '2025-09-28'),
(5, 'PROV005', 'Cofarma Bolivia', '+591-3-3421234', 'pedidos@cofarma.bo', 'Barrio Equipetrol, Santa Cruz', 'Roberto Silva', 1, '2025-09-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id_sucursal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `fecha_apertura` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`id_sucursal`, `nombre`, `direccion`, `fecha_apertura`) VALUES
(1, 'Farmacia Dr Osvaldo Monte Cristo', 'Calle Central #123', '2025-09-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo_prod` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `Estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo_prod`, `nombre`, `Estado`) VALUES
(1, 'Medicamentos', 1),
(2, 'Suplementos Nutricionales', 1),
(3, 'Productos de Higiene', 1),
(4, 'Cosmética y Belleza', 1),
(5, 'Material Médico', 1),
(6, 'Productos Naturales', 1),
(7, 'Bebé y Maternidad', 1),
(8, 'Primeros Auxilios', 1),
(9, 'Productos Veterinarios', 1),
(10, 'Dispositivos Médicos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_us`
--

CREATE TABLE `tipo_us` (
  `id_tipo_us` int(11) NOT NULL,
  `nombre_tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_us`
--

INSERT INTO `tipo_us` (`id_tipo_us`, `nombre_tipo`) VALUES
(2, 'AdministradorFarmacia'),
(5, 'Cajero'),
(3, 'Farmaceutico'),
(1, 'Root'),
(4, 'Supervisor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `codigo_empleado` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `ci` varchar(20) NOT NULL,
  `constrasena` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `ultimo_acceso` datetime DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `id_tipo_us` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT 'default.jpg',
  `residencia` varchar(255) DEFAULT NULL,
  `sexo` enum('Masculino','Femenino','Otro') DEFAULT NULL,
  `adicional` text DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `codigo_empleado`, `nombre`, `apellido`, `ci`, `constrasena`, `telefono`, `email`, `Estado`, `ultimo_acceso`, `fecha_creacion`, `id_tipo_us`, `id_sucursal`, `avatar`, `residencia`, `sexo`, `adicional`, `fecha_nacimiento`) VALUES
(4, 'EMP001', 'Juan', 'Perez', '1234567', '1234567', '73189038', 'juan.perez@farmacia.com', 1, NULL, '2025-09-28 13:23:31', 1, 1, 'default.jpg', 'Santa Cruz de la Sierra', 'Masculino', 'Administrado del Sistema', '2015-09-02'),
(5, 'EMP002', 'Maria', 'Gomez', '2345678', 'password2', '700445566', 'maria.gomez@farmacia.com', 1, NULL, '2025-09-28 13:23:31', 2, 1, 'default.jpg', NULL, NULL, NULL, NULL),
(6, 'EMP003', 'Carlos', 'Ruiz', '3456789', 'password3', '700778899', 'carlos.ruiz@farmacia.com', 1, NULL, '2025-09-28 13:23:31', 3, 1, 'default.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `numero_factura` varchar(100) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `subtotal` decimal(12,2) NOT NULL,
  `descuento_total` decimal(12,2) DEFAULT 0.00,
  `impuestos` decimal(12,2) DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL,
  `Estado` enum('pendiente','completa','cancelada') DEFAULT 'pendiente',
  `tipo_pago` enum('efectivo','tarjeta','transferencia','mixto') DEFAULT 'efectivo',
  `observaciones` text DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `ci` (`ci`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_cliente_ci` (`ci`),
  ADD KEY `idx_cliente_nombre` (`nombre`),
  ADD KEY `idx_cliente_Estado` (`Estado`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD UNIQUE KEY `numero_factura` (`numero_factura`),
  ADD KEY `fk_compra_proveedor` (`id_proveedor`),
  ADD KEY `fk_compra_usuario` (`id_usuario`),
  ADD KEY `idx_compra_fecha` (`fecha_compra`),
  ADD KEY `idx_compra_Estado` (`Estado`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle_compra`),
  ADD KEY `fk_detalle_compra_compra` (`id_compra`),
  ADD KEY `fk_detalle_compra_lote` (`id_lote`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `fk_detalle_venta_venta` (`id_venta`),
  ADD KEY `fk_detalle_venta_producto` (`id_producto`),
  ADD KEY `fk_detalle_venta_lote` (`id_lote`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`),
  ADD UNIQUE KEY `uk_codigo_lote` (`codigo`,`id_producto`),
  ADD KEY `fk_lote_producto` (`id_producto`),
  ADD KEY `fk_lote_proveedor` (`id_proveedor`),
  ADD KEY `idx_lote_fecha_vencimiento` (`fecha_vencimiento`),
  ADD KEY `idx_lote_codigo` (`codigo`),
  ADD KEY `idx_lote_stock` (`stock`),
  ADD KEY `idx_lote_Estado` (`Estado`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id_presentacion`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_barra` (`codigo_barra`),
  ADD KEY `fk_producto_laboratorio` (`id_laboratorio`),
  ADD KEY `fk_producto_tipo` (`id_tipo_producto`),
  ADD KEY `fk_producto_presentacion` (`id_presentacion`),
  ADD KEY `idx_producto_nombre_comercial` (`nombre_comercial`),
  ADD KEY `idx_producto_nombre_generico` (`nombre_generico`),
  ADD KEY `idx_producto_codigo_barra` (`codigo_barra`),
  ADD KEY `idx_producto_Estado` (`Estado`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_sucursal`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo_prod`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tipo_us`
--
ALTER TABLE `tipo_us`
  ADD PRIMARY KEY (`id_tipo_us`),
  ADD UNIQUE KEY `nombre_tipo` (`nombre_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `ci` (`ci`),
  ADD UNIQUE KEY `codigo_empleado` (`codigo_empleado`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_tipo` (`id_tipo_us`),
  ADD KEY `fk_usuario_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD UNIQUE KEY `numero_factura` (`numero_factura`),
  ADD KEY `fk_venta_cliente` (`id_cliente`),
  ADD KEY `fk_venta_usuario` (`id_usuario`),
  ADD KEY `fk_venta_sucursal` (`id_sucursal`),
  ADD KEY `idx_venta_fecha` (`fecha`),
  ADD KEY `idx_venta_Estado` (`Estado`),
  ADD KEY `idx_venta_numero_factura` (`numero_factura`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id_presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipo_us`
--
ALTER TABLE `tipo_us`
  MODIFY `id_tipo_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_compra_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_detalle_compra_compra` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_compra_lote` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_lote` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_venta_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `fk_lote_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lote_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_laboratorio` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_presentacion` FOREIGN KEY (`id_presentacion`) REFERENCES `presentacion` (`id_presentacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_tipo` FOREIGN KEY (`id_tipo_producto`) REFERENCES `tipo_producto` (`id_tipo_prod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_sucursal` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_tipo` FOREIGN KEY (`id_tipo_us`) REFERENCES `tipo_us` (`id_tipo_us`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_venta_sucursal` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_venta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
