CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_code` varchar(5) NOT NULL,
  `department_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_code`, `department_name`) VALUES
(1, 'ICT', 'INFORMATION COMMUNICATION AND '),
(2, 'MEC', 'mechanical'),
(3, 'AUT', 'automobile'),
(4, 'FOT', 'food '),
(5, 'CON', 'consruction');
