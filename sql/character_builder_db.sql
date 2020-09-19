-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2020 at 09:50 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `character_builder`
--

-- --------------------------------------------------------

--
-- Table structure for table `character_archive`
--

CREATE TABLE `character_archive` (
  `character_archive_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `character_archive`
--

INSERT INTO `character_archive` (`character_archive_id`, `name`, `age`, `gender`, `description`, `userid`) VALUES
(48, 'Elron', 22, 'Male', 'The Pest', 8),
(49, 'Elron', 22, 'Male', 'The Pest', 8),
(50, 'Acer', 23, 'yes', 'Smart Lady', 8),
(51, 'Acer', 23, 'yes', 'Smart', 8),
(52, 'Noah', 20, 'Male', 'Rock Climber', 8),
(53, 'Elron', 22, 'What', 'The Pest', 8),
(54, 'Elron', 34, 'Male', 'Musk', 8),
(63, '', 0, '', '', 12),
(64, '', 0, '', '', 12);

-- --------------------------------------------------------

--
-- Table structure for table `character_builder_character`
--

CREATE TABLE `character_builder_character` (
  `character_id` int(11) NOT NULL,
  `character_name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `character_builder_character`
--

INSERT INTO `character_builder_character` (`character_id`, `character_name`, `age`, `gender`, `description`, `userid`) VALUES
(42, 'Elon', 69, 'yes', 'Musk', 4),
(43, 'Max Besner', 25, '???', 'That Bitch', 4),
(44, 'Swark', 44, 'Male', 'The Pest', 5),
(45, 'Partridge', 25, 'M', 'Slight, crooked neck, bad eyesight', 6),
(46, 'Elon', 24, 'Male', 'Inventor', 7),
(47, 'Acer', 34, 'M', 'okay', 7),
(55, 'Elron', 22, 'Male', 'Nice Guy', 11),
(56, 'Elron', 22, 'Male', 'Nice', 11),
(57, 'Jimmay', 79, 'Never', 'How', 11),
(58, 'Jon', 22, 'Male', 'That', 11),
(59, 'don', 22, 'Male', 'Musk', 11),
(60, 'Jasonk', 22, 'Male', 'The', 11),
(61, 'Jasonk', 22, 'Male', 'The', 11),
(62, '', 0, '', '', 11);

-- --------------------------------------------------------

--
-- Table structure for table `character_builder_user`
--

CREATE TABLE `character_builder_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `character_builder_user`
--

INSERT INTO `character_builder_user` (`user_id`, `username`, `password_hash`) VALUES
(3, 'Johhn', '$2y$10$xj3RHbZB9kueTg0fXfOmeehirfGcKiEMFHOpHRWc7VKzAmdKBpeU2'),
(4, 'kevan', '$2y$10$GHwfILeB2F3fv7Gy/exv1.aqN/ENHZXJgSX61rgOw2AoJali4NI3i'),
(5, 'Branles', '$2y$10$J46e8MlAwpP9V.Edemfj.eeXVIBLq9tTvrqCVR6pCnEVC226Zy0VG'),
(6, 'soren', '$2y$10$AtQswjjjIfFY8TJMW/dPcOXnJp7nV5LuP2OZr60M/dfLh7EpDudGa'),
(7, 'me', '$2y$10$gN8baSGKbzJJ8/zN9B2mDOpK3mUFD8R.5dku/B.ZnNiRIyuG//tBm'),
(11, 'Max', '$2y$10$bvt/jQTdYaeEOvtWt12SYuzCybFE3.ch/3086QDgz.y/LFBlbZT56');

-- --------------------------------------------------------

--
-- Table structure for table `character_trait`
--

CREATE TABLE `character_trait` (
  `id` int(11) NOT NULL,
  `trait` varchar(30) NOT NULL,
  `element` varchar(11) NOT NULL,
  `characterid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `character_trait`
--

INSERT INTO `character_trait` (`id`, `trait`, `element`, `characterid`) VALUES
(76, 'Charismatic', 'Gold', 42),
(77, 'Rash', 'Copper', 42),
(78, 'Inconsistent', 'Mercury', 42),
(79, 'Diligent', 'Iron', 42),
(80, 'Energetic', 'Copper', 42),
(81, 'Materialistic', 'Gold', 42),
(82, 'Inconsistent', 'Mercury', 43),
(83, 'Rash', 'Copper', 43),
(84, 'Curious', 'Mercury', 43),
(85, 'Cautious', 'Lead', 43),
(86, 'Kind', 'Calcium', 43),
(87, 'Anxious', 'Lead', 43),
(88, 'Inconsistent', 'Mercury', 44),
(89, 'Anxious', 'Lead', 44),
(90, 'Curious', 'Mercury', 44),
(91, 'Energetic', 'Copper', 44),
(92, 'Co-dependent', 'Calcium', 45),
(93, 'Energetic', 'Copper', 45),
(94, 'Anxious', 'Lead', 45),
(95, 'Rash', 'Copper', 45),
(96, 'Curious', 'Mercury', 45),
(97, 'Inconsistent', 'Mercury', 45),
(98, 'Rash', 'Copper', 46),
(99, 'Materialistic', 'Gold', 46),
(100, 'Diligent', 'Iron', 46),
(101, 'Charismatic', 'Gold', 46),
(102, 'Curious', 'Mercury', 46),
(103, 'Inconsistent', 'Mercury', 46),
(104, 'Diligent', 'Iron', 47),
(105, 'Callous', 'Iron', 47),
(106, 'Cautious', 'Lead', 47),
(107, 'Anxious', 'Lead', 47),
(128, 'Materialistic', 'Gold', 55),
(129, 'Rash', 'Copper', 55),
(130, 'Inconsistent', 'Mercury', 55),
(131, 'Diligent', 'Iron', 55),
(132, 'Diligent', 'Iron', 56),
(133, 'Materialistic', 'Gold', 56),
(134, 'Rash', 'Copper', 56),
(135, 'Inconsistent', 'Mercury', 56),
(180, 'Kind', 'Calcium', 59);

-- --------------------------------------------------------

--
-- Table structure for table `slider_answer`
--

CREATE TABLE `slider_answer` (
  `slider_answer_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `element` varchar(10) NOT NULL,
  `answer` int(11) NOT NULL,
  `characterid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider_answer`
--

INSERT INTO `slider_answer` (`slider_answer_id`, `text`, `element`, `answer`, `characterid`) VALUES
(271, 'I am always thinking many steps ahead', 'Lead', 10, 42),
(272, 'I am athletically gifted', 'Copper', 8, 42),
(273, 'It is more important to be kind than to be powerful', 'Calcium', 1, 42),
(274, 'I am often suspicious of my friends', 'Lead', 10, 42),
(275, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 8, 42),
(276, 'People accuse me of being manipulative', 'Gold', 8, 42),
(277, 'Friends rely on me for emotional support', 'Calcium', 1, 42),
(278, 'I have a wide circle of friends and acquaintances', 'Gold', 10, 42),
(279, 'I am rarely complacent', 'Lead', 10, 42),
(280, 'I am a trickster', 'Mercury', 9, 42),
(281, 'I am considered to be reliable', 'Iron', 5, 42),
(282, 'People often tell me to calm down', 'Copper', 10, 42),
(283, 'I am a morning person', 'Copper', 10, 42),
(284, 'It is more important to be adaptable than to plan ahead', 'Mercury', 7, 42),
(285, 'I believe people should do as they are told', 'Iron', 3, 42),
(286, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 10, 42),
(287, 'I appreciate obscure and eclectic art', 'Mercury', 2, 42),
(288, 'I will do something just because my friends are doing it', 'Calcium', 1, 42),
(289, 'Friends rely on me for emotional support', 'Calcium', 4, 43),
(290, 'I am athletically gifted', 'Copper', 6, 43),
(291, 'I am considered to be reliable', 'Iron', 4, 43),
(292, 'It is more important to be adaptable than to plan ahead', 'Mercury', 7, 43),
(293, 'I am a morning person', 'Copper', 4, 43),
(294, 'I believe people should do as they are told', 'Iron', 3, 43),
(295, 'I appreciate obscure and eclectic art', 'Mercury', 9, 43),
(296, 'I am always thinking many steps ahead', 'Lead', 8, 43),
(297, 'People accuse me of being manipulative', 'Gold', 2, 43),
(298, 'I will do something just because my friends are doing it', 'Calcium', 5, 43),
(299, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 5, 43),
(300, 'It is more important to be kind than to be powerful', 'Calcium', 9, 43),
(301, 'I am often suspicious of my friends', 'Lead', 6, 43),
(302, 'I am rarely complacent', 'Lead', 3, 43),
(303, 'People often tell me to calm down', 'Copper', 7, 43),
(304, 'I am a trickster', 'Mercury', 9, 43),
(305, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 43),
(306, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 43),
(307, 'I will do something just because my friends are doing it', 'Calcium', 2, 44),
(308, 'I am a morning person', 'Copper', 9, 44),
(309, 'People accuse me of being manipulative', 'Gold', 4, 44),
(310, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 10, 44),
(311, 'People often tell me to calm down', 'Copper', 9, 44),
(312, 'I appreciate obscure and eclectic art', 'Mercury', 7, 44),
(313, 'It is more important to be adaptable than to plan ahead', 'Mercury', 10, 44),
(314, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 2, 44),
(315, 'I am athletically gifted', 'Copper', 4, 44),
(316, 'I am considered to be reliable', 'Iron', 1, 44),
(317, 'I am rarely complacent', 'Lead', 9, 44),
(318, 'It is more important to be kind than to be powerful', 'Calcium', 2, 44),
(319, 'I have a wide circle of friends and acquaintances', 'Gold', 1, 44),
(320, 'I am often suspicious of my friends', 'Lead', 9, 44),
(321, 'I am always thinking many steps ahead', 'Lead', 10, 44),
(322, 'Friends rely on me for emotional support', 'Calcium', 2, 44),
(323, 'I am a trickster', 'Mercury', 6, 44),
(324, 'I believe people should do as they are told', 'Iron', 2, 44),
(325, 'I am athletically gifted', 'Copper', 1, 45),
(326, 'People often tell me to calm down', 'Copper', 8, 45),
(327, 'It is more important to be adaptable than to plan ahead', 'Mercury', 9, 45),
(328, 'I appreciate obscure and eclectic art', 'Mercury', 9, 45),
(329, 'It is more important to be kind than to be powerful', 'Calcium', 3, 45),
(330, 'I am a trickster', 'Mercury', 6, 45),
(331, 'I have a wide circle of friends and acquaintances', 'Gold', 4, 45),
(332, 'I believe people should do as they are told', 'Iron', 1, 45),
(333, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 5, 45),
(334, 'I am considered to be reliable', 'Iron', 3, 45),
(335, 'I am often suspicious of my friends', 'Lead', 7, 45),
(336, 'I am a morning person', 'Copper', 3, 45),
(337, 'Friends rely on me for emotional support', 'Calcium', 6, 45),
(338, 'I am rarely complacent', 'Lead', 8, 45),
(339, 'People accuse me of being manipulative', 'Gold', 5, 45),
(340, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 7, 45),
(341, 'I will do something just because my friends are doing it', 'Calcium', 3, 45),
(342, 'I am always thinking many steps ahead', 'Lead', 8, 45),
(343, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 7, 46),
(344, 'I am athletically gifted', 'Copper', 7, 46),
(345, 'It is more important to be adaptable than to plan ahead', 'Mercury', 5, 46),
(346, 'I am a morning person', 'Copper', 10, 46),
(347, 'I am considered to be reliable', 'Iron', 3, 46),
(348, 'I will do something just because my friends are doing it', 'Calcium', 4, 46),
(349, 'I am a trickster', 'Mercury', 9, 46),
(350, 'People accuse me of being manipulative', 'Gold', 8, 46),
(351, 'I appreciate obscure and eclectic art', 'Mercury', 1, 46),
(352, 'People often tell me to calm down', 'Copper', 8, 46),
(353, 'Friends rely on me for emotional support', 'Calcium', 1, 46),
(354, 'I believe people should do as they are told', 'Iron', 7, 46),
(355, 'I am rarely complacent', 'Lead', 10, 46),
(356, 'I am often suspicious of my friends', 'Lead', 8, 46),
(357, 'I have a wide circle of friends and acquaintances', 'Gold', 9, 46),
(358, 'I am always thinking many steps ahead', 'Lead', 8, 46),
(359, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 10, 46),
(360, 'It is more important to be kind than to be powerful', 'Calcium', 1, 46),
(361, 'I appreciate obscure and eclectic art', 'Mercury', 10, 47),
(362, 'I am always thinking many steps ahead', 'Lead', 9, 47),
(363, 'I will do something just because my friends are doing it', 'Calcium', 2, 47),
(364, 'People often tell me to calm down', 'Copper', 9, 47),
(365, 'People accuse me of being manipulative', 'Gold', 2, 47),
(366, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 9, 47),
(367, 'It is more important to be adaptable than to plan ahead', 'Mercury', 2, 47),
(368, 'It is more important to be kind than to be powerful', 'Calcium', 2, 47),
(369, 'I am a morning person', 'Copper', 9, 47),
(370, 'I am often suspicious of my friends', 'Lead', 2, 47),
(371, 'I am rarely complacent', 'Lead', 9, 47),
(372, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 1, 47),
(373, 'I am a trickster', 'Mercury', 2, 47),
(374, 'I believe people should do as they are told', 'Iron', 9, 47),
(375, 'Friends rely on me for emotional support', 'Calcium', 1, 47),
(376, 'I am considered to be reliable', 'Iron', 10, 47),
(377, 'I am athletically gifted', 'Copper', 1, 47),
(378, 'I have a wide circle of friends and acquaintances', 'Gold', 1, 47),
(505, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 10, 55),
(506, 'I appreciate obscure and eclectic art', 'Mercury', 10, 55),
(507, 'I am a morning person', 'Copper', 10, 55),
(508, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 10, 55),
(509, 'Friends rely on me for emotional support', 'Calcium', 10, 55),
(510, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 55),
(511, 'I am always thinking many steps ahead', 'Lead', 6, 55),
(512, 'I will do something just because my friends are doing it', 'Calcium', 6, 55),
(513, 'I am athletically gifted', 'Copper', 6, 55),
(514, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 55),
(515, 'People often tell me to calm down', 'Copper', 6, 55),
(516, 'People accuse me of being manipulative', 'Gold', 6, 55),
(517, 'It is more important to be kind than to be powerful', 'Calcium', 6, 55),
(518, 'I am a trickster', 'Mercury', 6, 55),
(519, 'I am rarely complacent', 'Lead', 6, 55),
(520, 'I believe people should do as they are told', 'Iron', 6, 55),
(521, 'I am considered to be reliable', 'Iron', 6, 55),
(522, 'I am often suspicious of my friends', 'Lead', 6, 55),
(523, 'I am always thinking many steps ahead', 'Lead', 6, 56),
(524, 'I am a trickster', 'Mercury', 6, 56),
(525, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 10, 56),
(526, 'I believe people should do as they are told', 'Iron', 6, 56),
(527, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 56),
(528, 'I appreciate obscure and eclectic art', 'Mercury', 10, 56),
(529, 'People often tell me to calm down', 'Copper', 6, 56),
(530, 'I am a morning person', 'Copper', 10, 56),
(531, 'I am athletically gifted', 'Copper', 6, 56),
(532, 'People accuse me of being manipulative', 'Gold', 6, 56),
(533, 'I am often suspicious of my friends', 'Lead', 6, 56),
(534, 'I am considered to be reliable', 'Iron', 6, 56),
(535, 'I am rarely complacent', 'Lead', 6, 56),
(536, 'Friends rely on me for emotional support', 'Calcium', 10, 56),
(537, 'It is more important to be kind than to be powerful', 'Calcium', 6, 56),
(538, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 56),
(539, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 10, 56),
(540, 'I will do something just because my friends are doing it', 'Calcium', 6, 56),
(541, 'I am rarely complacent', 'Lead', 6, 57),
(542, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 57),
(543, 'I am athletically gifted', 'Copper', 6, 57),
(544, 'I appreciate obscure and eclectic art', 'Mercury', 6, 57),
(545, 'People often tell me to calm down', 'Copper', 6, 57),
(546, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 57),
(547, 'People accuse me of being manipulative', 'Gold', 6, 57),
(548, 'Friends rely on me for emotional support', 'Calcium', 6, 57),
(549, 'I will do something just because my friends are doing it', 'Calcium', 6, 57),
(550, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 57),
(551, 'I am often suspicious of my friends', 'Lead', 6, 57),
(552, 'I am always thinking many steps ahead', 'Lead', 6, 57),
(553, 'I am a morning person', 'Copper', 6, 57),
(554, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 1, 57),
(555, 'I am considered to be reliable', 'Iron', 6, 57),
(556, 'I am a trickster', 'Mercury', 1, 57),
(557, 'I believe people should do as they are told', 'Iron', 6, 57),
(558, 'It is more important to be kind than to be powerful', 'Calcium', 6, 57),
(559, 'I am athletically gifted', 'Copper', 6, 58),
(560, 'People accuse me of being manipulative', 'Gold', 6, 58),
(561, 'I am always thinking many steps ahead', 'Lead', 6, 58),
(562, 'Friends rely on me for emotional support', 'Calcium', 6, 58),
(563, 'I will do something just because my friends are doing it', 'Calcium', 6, 58),
(564, 'People often tell me to calm down', 'Copper', 6, 58),
(565, 'It is more important to be adaptable than to plan ahead', 'Mercury', 10, 58),
(566, 'I believe people should do as they are told', 'Iron', 6, 58),
(567, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 58),
(568, 'I am a trickster', 'Mercury', 6, 58),
(569, 'I am a morning person', 'Copper', 6, 58),
(570, 'I am often suspicious of my friends', 'Lead', 6, 58),
(571, 'I am rarely complacent', 'Lead', 6, 58),
(572, 'I am considered to be reliable', 'Iron', 6, 58),
(573, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 58),
(574, 'It is more important to be kind than to be powerful', 'Calcium', 6, 58),
(575, 'I appreciate obscure and eclectic art', 'Mercury', 6, 58),
(576, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 58),
(577, 'People accuse me of being manipulative', 'Gold', 6, 59),
(578, 'Friends rely on me for emotional support', 'Calcium', 6, 59),
(579, 'I will do something just because my friends are doing it', 'Calcium', 6, 59),
(580, 'It is more important to be kind than to be powerful', 'Calcium', 6, 59),
(581, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 59),
(582, 'I am always thinking many steps ahead', 'Lead', 6, 59),
(583, 'I am considered to be reliable', 'Iron', 6, 59),
(584, 'I appreciate obscure and eclectic art', 'Mercury', 6, 59),
(585, 'I believe people should do as they are told', 'Iron', 6, 59),
(586, 'People often tell me to calm down', 'Copper', 6, 59),
(587, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 59),
(588, 'I am a trickster', 'Mercury', 6, 59),
(589, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 59),
(590, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 59),
(591, 'I am athletically gifted', 'Copper', 6, 59),
(592, 'I am a morning person', 'Copper', 6, 59),
(593, 'I am rarely complacent', 'Lead', 6, 59),
(594, 'I am often suspicious of my friends', 'Lead', 6, 59),
(595, 'I am often suspicious of my friends', 'Lead', 1, 60),
(596, 'I am always thinking many steps ahead', 'Lead', 6, 60),
(597, 'Friends rely on me for emotional support', 'Calcium', 6, 60),
(598, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 60),
(599, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 60),
(600, 'I am rarely complacent', 'Lead', 6, 60),
(601, 'People accuse me of being manipulative', 'Gold', 6, 60),
(602, 'I am athletically gifted', 'Copper', 6, 60),
(603, 'I am considered to be reliable', 'Iron', 6, 60),
(604, 'I believe people should do as they are told', 'Iron', 6, 60),
(605, 'People often tell me to calm down', 'Copper', 6, 60),
(606, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 60),
(607, 'It is more important to be kind than to be powerful', 'Calcium', 6, 60),
(608, 'I will do something just because my friends are doing it', 'Calcium', 6, 60),
(609, 'I am a trickster', 'Mercury', 6, 60),
(610, 'I am a morning person', 'Copper', 6, 60),
(611, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 60),
(612, 'I appreciate obscure and eclectic art', 'Mercury', 6, 60),
(613, 'I am rarely complacent', 'Lead', 6, 61),
(614, 'I am a trickster', 'Mercury', 6, 61),
(615, 'I am often suspicious of my friends', 'Lead', 1, 61),
(616, 'I am always thinking many steps ahead', 'Lead', 6, 61),
(617, 'Friends rely on me for emotional support', 'Calcium', 6, 61),
(618, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 61),
(619, 'I believe people should do as they are told', 'Iron', 6, 61),
(620, 'I am considered to be reliable', 'Iron', 6, 61),
(621, 'People accuse me of being manipulative', 'Gold', 6, 61),
(622, 'People often tell me to calm down', 'Copper', 6, 61),
(623, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 61),
(624, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 61),
(625, 'It is more important to be kind than to be powerful', 'Calcium', 6, 61),
(626, 'I appreciate obscure and eclectic art', 'Mercury', 6, 61),
(627, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 61),
(628, 'I am athletically gifted', 'Copper', 6, 61),
(629, 'I will do something just because my friends are doing it', 'Calcium', 6, 61),
(630, 'I am a morning person', 'Copper', 6, 61),
(631, 'People often tell me to calm down', 'Copper', 6, 62),
(632, 'I am rarely complacent', 'Lead', 6, 62),
(633, 'I am always thinking many steps ahead', 'Lead', 6, 62),
(634, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 62),
(635, 'Friends rely on me for emotional support', 'Calcium', 6, 62),
(636, 'I am athletically gifted', 'Copper', 6, 62),
(637, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 62),
(638, 'I am a morning person', 'Copper', 6, 62),
(639, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 62),
(640, 'I am considered to be reliable', 'Iron', 6, 62),
(641, 'People accuse me of being manipulative', 'Gold', 6, 62),
(642, 'I appreciate obscure and eclectic art', 'Mercury', 6, 62),
(643, 'I will do something just because my friends are doing it', 'Calcium', 6, 62),
(644, 'I believe people should do as they are told', 'Iron', 6, 62),
(645, 'I am often suspicious of my friends', 'Lead', 6, 62),
(646, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 62),
(647, 'It is more important to be kind than to be powerful', 'Calcium', 6, 62),
(648, 'I am a trickster', 'Mercury', 6, 62);

-- --------------------------------------------------------

--
-- Table structure for table `slider_archive`
--

CREATE TABLE `slider_archive` (
  `slider_archive_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `element` varchar(10) NOT NULL,
  `answer` int(11) NOT NULL,
  `characterid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider_archive`
--

INSERT INTO `slider_archive` (`slider_archive_id`, `text`, `element`, `answer`, `characterid`) VALUES
(379, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 48),
(380, 'I believe people should do as they are told', 'Iron', 6, 48),
(381, 'I am often suspicious of my friends', 'Lead', 6, 48),
(382, 'I am a trickster', 'Mercury', 10, 48),
(383, 'People accuse me of being manipulative', 'Gold', 10, 48),
(384, 'I am a morning person', 'Copper', 6, 48),
(385, 'I am always thinking many steps ahead', 'Lead', 6, 48),
(386, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 48),
(387, 'I am athletically gifted', 'Copper', 6, 48),
(388, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 48),
(389, 'People often tell me to calm down', 'Copper', 6, 48),
(390, 'I will do something just because my friends are doing it', 'Calcium', 6, 48),
(391, 'I appreciate obscure and eclectic art', 'Mercury', 6, 48),
(392, 'I am considered to be reliable', 'Iron', 6, 48),
(393, 'It is more important to be kind than to be powerful', 'Calcium', 6, 48),
(394, 'Friends rely on me for emotional support', 'Calcium', 6, 48),
(395, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 48),
(396, 'I am rarely complacent', 'Lead', 6, 48),
(397, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 49),
(398, 'I believe people should do as they are told', 'Iron', 6, 49),
(399, 'I am often suspicious of my friends', 'Lead', 6, 49),
(400, 'I am a trickster', 'Mercury', 10, 49),
(401, 'People accuse me of being manipulative', 'Gold', 10, 49),
(402, 'I am a morning person', 'Copper', 6, 49),
(403, 'I am always thinking many steps ahead', 'Lead', 6, 49),
(404, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 49),
(405, 'I am athletically gifted', 'Copper', 6, 49),
(406, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 49),
(407, 'People often tell me to calm down', 'Copper', 6, 49),
(408, 'I will do something just because my friends are doing it', 'Calcium', 6, 49),
(409, 'I appreciate obscure and eclectic art', 'Mercury', 6, 49),
(410, 'I am considered to be reliable', 'Iron', 6, 49),
(411, 'It is more important to be kind than to be powerful', 'Calcium', 6, 49),
(412, 'Friends rely on me for emotional support', 'Calcium', 6, 49),
(413, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 49),
(414, 'I am rarely complacent', 'Lead', 6, 49),
(415, 'I am always thinking many steps ahead', 'Lead', 6, 50),
(416, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 50),
(417, 'I believe people should do as they are told', 'Iron', 6, 50),
(418, 'I am considered to be reliable', 'Iron', 6, 50),
(419, 'It is more important to be kind than to be powerful', 'Calcium', 6, 50),
(420, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 50),
(421, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 50),
(422, 'I will do something just because my friends are doing it', 'Calcium', 6, 50),
(423, 'Friends rely on me for emotional support', 'Calcium', 6, 50),
(424, 'I am a morning person', 'Copper', 6, 50),
(425, 'I am rarely complacent', 'Lead', 6, 50),
(426, 'I appreciate obscure and eclectic art', 'Mercury', 6, 50),
(427, 'I am athletically gifted', 'Copper', 6, 50),
(428, 'People often tell me to calm down', 'Copper', 10, 50),
(429, 'I am often suspicious of my friends', 'Lead', 10, 50),
(430, 'I am a trickster', 'Mercury', 6, 50),
(431, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 50),
(432, 'People accuse me of being manipulative', 'Gold', 6, 50),
(433, 'I am rarely complacent', 'Lead', 6, 51),
(434, 'I appreciate obscure and eclectic art', 'Mercury', 6, 51),
(435, 'I believe people should do as they are told', 'Iron', 6, 51),
(436, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 51),
(437, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 51),
(438, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 51),
(439, 'I am athletically gifted', 'Copper', 6, 51),
(440, 'Friends rely on me for emotional support', 'Calcium', 6, 51),
(441, 'I am considered to be reliable', 'Iron', 6, 51),
(442, 'People accuse me of being manipulative', 'Gold', 6, 51),
(443, 'I am always thinking many steps ahead', 'Lead', 6, 51),
(444, 'I am a morning person', 'Copper', 6, 51),
(445, 'I am often suspicious of my friends', 'Lead', 10, 51),
(446, 'People often tell me to calm down', 'Copper', 10, 51),
(447, 'I am a trickster', 'Mercury', 6, 51),
(448, 'I will do something just because my friends are doing it', 'Calcium', 6, 51),
(449, 'It is more important to be kind than to be powerful', 'Calcium', 6, 51),
(450, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 51),
(451, 'I have a wide circle of friends and acquaintances', 'Gold', 2, 52),
(452, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 8, 52),
(453, 'I will do something just because my friends are doing it', 'Calcium', 2, 52),
(454, 'I believe people should do as they are told', 'Iron', 8, 52),
(455, 'I am always thinking many steps ahead', 'Lead', 7, 52),
(456, 'People often tell me to calm down', 'Copper', 3, 52),
(457, 'I am rarely complacent', 'Lead', 1, 52),
(458, 'I appreciate obscure and eclectic art', 'Mercury', 7, 52),
(459, 'Friends rely on me for emotional support', 'Calcium', 2, 52),
(460, 'It is more important to be kind than to be powerful', 'Calcium', 2, 52),
(461, 'I am athletically gifted', 'Copper', 2, 52),
(462, 'People accuse me of being manipulative', 'Gold', 2, 52),
(463, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 52),
(464, 'I am a trickster', 'Mercury', 2, 52),
(465, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 2, 52),
(466, 'I am often suspicious of my friends', 'Lead', 5, 52),
(467, 'I am considered to be reliable', 'Iron', 4, 52),
(468, 'I am a morning person', 'Copper', 3, 52),
(469, 'People accuse me of being manipulative', 'Gold', 6, 53),
(470, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 53),
(471, 'I will do something just because my friends are doing it', 'Calcium', 6, 53),
(472, 'It is more important to be kind than to be powerful', 'Calcium', 6, 53),
(473, 'Friends rely on me for emotional support', 'Calcium', 6, 53),
(474, 'I appreciate obscure and eclectic art', 'Mercury', 6, 53),
(475, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 53),
(476, 'I am rarely complacent', 'Lead', 6, 53),
(477, 'I am a trickster', 'Mercury', 6, 53),
(478, 'I am often suspicious of my friends', 'Lead', 6, 53),
(479, 'I am considered to be reliable', 'Iron', 6, 53),
(480, 'I am a morning person', 'Copper', 6, 53),
(481, 'People often tell me to calm down', 'Copper', 6, 53),
(482, 'I believe people should do as they are told', 'Iron', 6, 53),
(483, 'I am athletically gifted', 'Copper', 6, 53),
(484, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 53),
(485, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 53),
(486, 'I am always thinking many steps ahead', 'Lead', 6, 53),
(487, 'I am athletically gifted', 'Copper', 6, 54),
(488, 'I will do something just because my friends are doing it', 'Calcium', 6, 54),
(489, 'I am considered to be reliable', 'Iron', 10, 54),
(490, 'Friends rely on me for emotional support', 'Calcium', 10, 54),
(491, 'I am a morning person', 'Copper', 6, 54),
(492, 'I am always thinking many steps ahead', 'Lead', 10, 54),
(493, 'It is more important to be kind than to be powerful', 'Calcium', 6, 54),
(494, 'People often tell me to calm down', 'Copper', 6, 54),
(495, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 54),
(496, 'People accuse me of being manipulative', 'Gold', 6, 54),
(497, 'I am a trickster', 'Mercury', 6, 54),
(498, 'I am often suspicious of my friends', 'Lead', 6, 54),
(499, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 54),
(500, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 54),
(501, 'I appreciate obscure and eclectic art', 'Mercury', 6, 54),
(502, 'I believe people should do as they are told', 'Iron', 6, 54),
(503, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 54),
(504, 'I am rarely complacent', 'Lead', 6, 54),
(649, 'I am always thinking many steps ahead', 'Lead', 6, 63),
(650, 'I am rarely complacent', 'Lead', 6, 63),
(651, 'People often tell me to calm down', 'Copper', 6, 63),
(652, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 63),
(653, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 63),
(654, 'I appreciate obscure and eclectic art', 'Mercury', 6, 63),
(655, 'I am a trickster', 'Mercury', 6, 63),
(656, 'It is more important to be kind than to be powerful', 'Calcium', 6, 63),
(657, 'Friends rely on me for emotional support', 'Calcium', 6, 63),
(658, 'I am often suspicious of my friends', 'Lead', 6, 63),
(659, 'I am athletically gifted', 'Copper', 6, 63),
(660, 'People accuse me of being manipulative', 'Gold', 6, 63),
(661, 'I am considered to be reliable', 'Iron', 6, 63),
(662, 'I believe people should do as they are told', 'Iron', 6, 63),
(663, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 63),
(664, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 63),
(665, 'I am a morning person', 'Copper', 6, 63),
(666, 'I will do something just because my friends are doing it', 'Calcium', 6, 63),
(667, 'I am always thinking many steps ahead', 'Lead', 6, 64),
(668, 'I am rarely complacent', 'Lead', 6, 64),
(669, 'People often tell me to calm down', 'Copper', 6, 64),
(670, 'It is more important to be adaptable than to plan ahead', 'Mercury', 6, 64),
(671, 'If I wanted something from someone, I would flatter them and laugh at their jokes', 'Gold', 6, 64),
(672, 'I appreciate obscure and eclectic art', 'Mercury', 6, 64),
(673, 'I am a trickster', 'Mercury', 6, 64),
(674, 'It is more important to be kind than to be powerful', 'Calcium', 6, 64),
(675, 'Friends rely on me for emotional support', 'Calcium', 6, 64),
(676, 'I am often suspicious of my friends', 'Lead', 6, 64),
(677, 'I am athletically gifted', 'Copper', 6, 64),
(678, 'People accuse me of being manipulative', 'Gold', 6, 64),
(679, 'I am considered to be reliable', 'Iron', 6, 64),
(680, 'I believe people should do as they are told', 'Iron', 6, 64),
(681, 'Once I\'ve made up my mind, there is no telling me otherwise', 'Iron', 6, 64),
(682, 'I have a wide circle of friends and acquaintances', 'Gold', 6, 64),
(683, 'I am a morning person', 'Copper', 6, 64),
(684, 'I will do something just because my friends are doing it', 'Calcium', 6, 64);

-- --------------------------------------------------------

--
-- Table structure for table `trait_archive`
--

CREATE TABLE `trait_archive` (
  `trait_archive_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `element` varchar(10) NOT NULL,
  `characterid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trait_archive`
--

INSERT INTO `trait_archive` (`trait_archive_id`, `text`, `element`, `characterid`) VALUES
(108, 'Inconsistent', 'Mercury', 48),
(109, 'Cautious', 'Lead', 48),
(110, 'Curious', 'Mercury', 48),
(111, 'Callous', 'Iron', 48),
(112, 'Inconsistent', 'Mercury', 49),
(113, 'Cautious', 'Lead', 49),
(114, 'Curious', 'Mercury', 49),
(115, 'Callous', 'Iron', 49),
(116, 'Materialistic', 'Gold', 50),
(117, 'Charismatic', 'Gold', 50),
(118, 'Inconsistent', 'Mercury', 50),
(119, 'Inconsistent', 'Mercury', 51),
(120, 'Materialistic', 'Gold', 51),
(121, 'Charismatic', 'Gold', 51),
(122, 'Curious', 'Mercury', 52),
(123, 'Cautious', 'Lead', 52),
(124, 'Anxious', 'Lead', 52),
(125, 'Cautious', 'Lead', 54),
(126, 'Materialistic', 'Gold', 54),
(127, 'Energetic', 'Copper', 54);

-- --------------------------------------------------------

--
-- Table structure for table `user_archive`
--

CREATE TABLE `user_archive` (
  `user_archive_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_archive`
--

INSERT INTO `user_archive` (`user_archive_id`, `username`, `password_hash`) VALUES
(8, 'Max', '$2y$10$oc732aiVTNlxq.wzssuDQ./t4yHJ8klJozPhQJy9mYRWeWlPU786a'),
(9, 'Max', '$2y$10$clTvEA2LxKn0eFPeAtQgyeM1FsAVQHsoW1jU4M9ukLZGebm2NgJgy'),
(10, 'Max', '$2y$10$cCKFIdhsw.yeExsIrZyja.H4JS4YfGtRv8PdgMT.GYB1ftnp74bG6'),
(12, 'ji', '$2y$10$1No1qV2gzKkT6ofbeQTKa.cR.TUbeAE6PG0QAfbzTISXerJDc4I7m');

-- --------------------------------------------------------

--
-- Table structure for table `yes_no_answer`
--

CREATE TABLE `yes_no_answer` (
  `yes_no_answer_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `element` int(10) NOT NULL,
  `answered_yes` tinyint(1) NOT NULL,
  `characterid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `yes_no_archive`
--

CREATE TABLE `yes_no_archive` (
  `yes_no_archive_id` int(11) NOT NULL,
  `text` varchar(100) NOT NULL,
  `element` varchar(10) NOT NULL,
  `answered_yes` tinyint(1) NOT NULL,
  `characterid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `character_archive`
--
ALTER TABLE `character_archive`
  ADD PRIMARY KEY (`character_archive_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `character_builder_character`
--
ALTER TABLE `character_builder_character`
  ADD PRIMARY KEY (`character_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `character_builder_user`
--
ALTER TABLE `character_builder_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `character_trait`
--
ALTER TABLE `character_trait`
  ADD PRIMARY KEY (`id`),
  ADD KEY `characterid` (`characterid`);

--
-- Indexes for table `slider_answer`
--
ALTER TABLE `slider_answer`
  ADD PRIMARY KEY (`slider_answer_id`),
  ADD KEY `characterid` (`characterid`);

--
-- Indexes for table `slider_archive`
--
ALTER TABLE `slider_archive`
  ADD PRIMARY KEY (`slider_archive_id`),
  ADD KEY `characterid` (`characterid`);

--
-- Indexes for table `trait_archive`
--
ALTER TABLE `trait_archive`
  ADD PRIMARY KEY (`trait_archive_id`),
  ADD KEY `characterid` (`characterid`);

--
-- Indexes for table `user_archive`
--
ALTER TABLE `user_archive`
  ADD PRIMARY KEY (`user_archive_id`);

--
-- Indexes for table `yes_no_answer`
--
ALTER TABLE `yes_no_answer`
  ADD PRIMARY KEY (`yes_no_answer_id`),
  ADD KEY `characterid` (`characterid`);

--
-- Indexes for table `yes_no_archive`
--
ALTER TABLE `yes_no_archive`
  ADD PRIMARY KEY (`yes_no_archive_id`),
  ADD KEY `characterid` (`characterid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `character_builder_character`
--
ALTER TABLE `character_builder_character`
  MODIFY `character_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `character_builder_user`
--
ALTER TABLE `character_builder_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `character_trait`
--
ALTER TABLE `character_trait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `slider_answer`
--
ALTER TABLE `slider_answer`
  MODIFY `slider_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=685;

--
-- AUTO_INCREMENT for table `yes_no_answer`
--
ALTER TABLE `yes_no_answer`
  MODIFY `yes_no_answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `character_archive`
--
ALTER TABLE `character_archive`
  ADD CONSTRAINT `character_archive_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user_archive` (`user_archive_id`);

--
-- Constraints for table `character_builder_character`
--
ALTER TABLE `character_builder_character`
  ADD CONSTRAINT `character_builder_character_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `character_builder_user` (`user_id`);

--
-- Constraints for table `character_trait`
--
ALTER TABLE `character_trait`
  ADD CONSTRAINT `character_trait_ibfk_1` FOREIGN KEY (`characterid`) REFERENCES `character_builder_character` (`character_id`);

--
-- Constraints for table `slider_answer`
--
ALTER TABLE `slider_answer`
  ADD CONSTRAINT `slider_answer_ibfk_1` FOREIGN KEY (`characterid`) REFERENCES `character_builder_character` (`character_id`);

--
-- Constraints for table `slider_archive`
--
ALTER TABLE `slider_archive`
  ADD CONSTRAINT `slider_archive_ibfk_1` FOREIGN KEY (`characterid`) REFERENCES `character_archive` (`character_archive_id`);

--
-- Constraints for table `trait_archive`
--
ALTER TABLE `trait_archive`
  ADD CONSTRAINT `trait_archive_ibfk_1` FOREIGN KEY (`characterid`) REFERENCES `character_archive` (`character_archive_id`);

--
-- Constraints for table `yes_no_answer`
--
ALTER TABLE `yes_no_answer`
  ADD CONSTRAINT `yes_no_answer_ibfk_1` FOREIGN KEY (`characterid`) REFERENCES `character_builder_character` (`character_id`);

--
-- Constraints for table `yes_no_archive`
--
ALTER TABLE `yes_no_archive`
  ADD CONSTRAINT `yes_no_archive_ibfk_1` FOREIGN KEY (`characterid`) REFERENCES `character_archive` (`character_archive_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
