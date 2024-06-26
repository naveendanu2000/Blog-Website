-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 05:56 AM
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
-- Database: `blog_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `a_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `article` text NOT NULL,
  `image` text NOT NULL,
  `category` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`a_id`, `title`, `author`, `description`, `article`, `image`, `category`, `status`) VALUES
(1, 'When PM Narendra Modi met India’s top gamers', 'naveenwarrio@gmail.com', 'The meeting on Thursday saw roundtable conversations about the issues facing the esports and gaming industry and ended with the 73-year-old Modi trying his hand at VR (virtual reality) and mobile games.', 'Some of India’s top gaming influencers recently met Prime Minister Narendra Modi, the man wielding the most influence in the world’s most populous country. The meeting saw roundtable conversations about the issues facing the esports and gaming industry and ended with the 73-year-old Modi trying his hand at VR (virtual reality) and mobile games.\r\n\r\nThe seven Indian gamers who were invited to meet the Prime Minister are some of the most popular names in the esports and gaming industry. Take, for example, Naman Mathur, who goes by his gaming name of Mortal. With 5.3 million followers on Instagram, besides seven million subscribers on YouTube, his social media fame puts into shade that of ‘mainstream’ athletes like India cricketer Ravichandran Ashwin (who has 4.7 million Instagram followers and 14 lakh subscribers on YouTube) or PV Sindhu, who has 3.7 million followers on Instagram. Mortal’s YouTube videos have aggregated over 131 crore views, most of them from Gen-Z viewers.\r\n\r\nWhen David Beckham visited India last year, Mortal was one of those who got an audience with the superstar, as he not only chatted about football but also got to explain to the former England football captain why he should try Mumbai’s vada pav.Mortal was one of the first big superstars in the Indian esports ecosystem, finding viral fame in 2018 with a YouTube video titled “Every PUBG player will watch this ending”, which has 20 million views so far.\r\n\r\nMortal made his name in PlayerUnknown’s Battlegrounds Mobile. When PUBG Mobile was banned in India, a new variant Battlegrounds Mobile India (BGMI) took its place. BGMI is said to have over 100 million users in the country. Mortal, like many other OG (original gangster) stars of that period, has gone on to become one of the biggest content creators on social media, commanding top dollar for link-ups with mainstream brands. Just like former cricketers find gigs as analysts and commentators, esports athletes earn lakhs of rupees on a monthly basis as “content creators” by streaming their games on platforms.\r\n\r\n“The top esports players in India could make anywhere between $4,000 to $15,000 (approx. Rs 3 lakh to Rs 12 lakh) a month. But of course, there’s a huge income disparity in the industry, where someone finishing 10th in an event could be making just $700 a month. On the other hand, someone like a Mortal could make as much as a million dollars a year (approximately Rs 8 crore). That’s what the top gamers make. It must be noted that gamers are not esports athletes. Mortal is a retired athlete, who represented India multiple times at events, but is now into gaming,” Animesh Agarwal, who was also among the seven who met Modi, had told The Indian Express in an interview in July last year.', './includes/images/pm_with_gamers.jpg', 'politics', 'published'),
(2, 'Indian D Gukesh, the silent killer, keeps winning', 'akshaykumar@gmail.com', 'Candidates Chess 2024: There was drama in the womens event as well as leader Tan Zhongyi was handed a defeat by compatriot Lei Tingjie. This means there are three joint leaders in the womens section.', 'Candidates Chess 2024: Gukesh rose to to the top of the Candidates 2024 standings in the open section once more after defeating compatriot Vidit Gujrathi in a Round 8 encounter. The 17-year-old prodigy from Chennai is joined at the top of the table by Ian Nepomniachtchi, who was held to a draw by Nijat Abasov.\r\n\r\nThere are six more rounds left at the Candidates. The winner of the open event gets to take on Ding Liren in the World Chess Championship next year. The winner of the women’s event gets to face off against China’s Ju Wenjun in the Women’s World Chess Championship.\r\n\r\nOn an incredible day in Toronto, Gukesh’s victory was sealed almost at the same time that World No 2 Fabiano Caruana resigned against American compatriot World No 3 Hikaru Nakamura. Gukesh and Caruana were joint second in the standings along with Praggnanandhaa after seven rounds in the Candidates 2024 tournament, which marked the halfway point of the double round robin tournament. Praggnanandhaa also agreed to a draw against French grandmaster Alireza Firouzja, who had inflicted that heartbreaking defeat on Gukesh in Round 7. Meanwhile, there was drama in the women’s event as well as leader Tan Zhongyi was handed a defeat by compatriot Lei Tingjie. In the battle of the two Indians, Humpy squandered her early advantage against Vaishali. But just when it looked like Vaishali would escape, she made a blunder which eventually led to her losing.', './includes/images/candidates_round_8.webp', 'sports', 'drafted');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'politics'),
(2, 'medical'),
(5, 'sports');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `account_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`name`, `email`, `password`, `account_type`) VALUES
('Akshay Kumar', 'akshaykumar@gmail.com', 'akshay', 'user'),
('Naveen Danu', 'naveenwarrio@gmail.com', 'naveen', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
