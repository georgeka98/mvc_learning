-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 04, 2018 at 06:44 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techpocketDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `ID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `date-posted` date NOT NULL,
  `teaser_paragraph` varchar(256) NOT NULL,
  `post` varchar(16384) CHARACTER SET utf8 NOT NULL,
  `authorID` int(9) NOT NULL,
  `cover-photo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`ID`, `title`, `date-posted`, `teaser_paragraph`, `post`, `authorID`, `cover-photo`) VALUES
(1, 'Greeks urged to leave homes as wildfires near Athens rage out of control', '2018-07-24', 'The wildfires caused nearby villages in the region of Attica to vanish. Everything has been turned black from green. Who caused this scandal? Investigation teams are still in progress.', 'Forest fires raged uncontrolled in several parts of Greece on Monday, destroying homes, disrupting major transport links and sending people fleeing for their lives.\r\n\r\nGreek authorities urged residents of a coastal region near Athens to abandon their homes as a wildfire spread on Monday, closing one of Greece?s busiest motorways, halting trains and sending plumes of smoke over the capital.\r\n\r\nBy the late afternoon, a large fire had also broken out north and east of Athens. A local mayor said he saw at least 100 homes and 200 cars engulfed in flames.\r\n\r\nThe Greek prime minister, Alexis Tsipras, cut short an official visit in Bosnia, and said the government would do ?whatever is humanly possible? to control the fires.\r\n\r\nAuthorities deployed firefighters and equipment from across Greece to deal with the blaze at Kineta, a small resort town about 54km (35 miles) west of Athens on a route used by tens of thousands of drivers daily to reach the Peloponnese peninsula. \r\n\r\nA senior fire chief went on state TV to appeal to people to leave the area after some tried to stay at their properties.\r\n\r\n?People should leave, close up their homes and just leave. People cannot tolerate so much smoke for so many hours,? Achilleas Tzouvaras said. ?This is an extreme situation.?\r\n\r\nStrong winds fanned towering walls of flames stretching as wide as four miles (6km) near Kineta, local officials said. Dozens of homes were thought to have been damaged or destroyed by the blaze. Some householders used hosepipes to try to put out the fires while police assisted with the evacuation of some areas.\r\n\r\nThe main Athens to Corinth motorway, one of two road routes to the Peloponnese peninsula, was shut and train services were cancelled.\r\n\r\nRaging around the Saronicos gulf, the blaze ravaged tracts of pine forest and was visible for miles. An cloud of black and orange smoke hung over the Acropolis hill and the Parthenon temple in Athens on Monday afternoon.\r\n\r\nThe inferno was thought to have started in a ravine in mountains overlooking Kineta, which is a popular resort town among Athenians.\r\n\r\nEast of Athens, live footage showed thick plumes of smoke hanging low over Rafina, which has a population of at least 20,000 and dense vegetation.\r\n\r\n?I personally saw at least 100 homes in flames,? said Evangelos Bournous, mayor of the Rafina-Pikermi area. ?I saw it with my eyes, it is a real total catastrophe.?\r\n\r\nWildfires are common in Greece in summer, but a dry winter has created tinderbox conditions.\r\n\r\nDozens of people died when fires raged for days across the Peloponnese in 2007. Last November, more than 20 people were killed in flash flooding in the area of Mandra near Kineta.', 86, 'cover-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_angry`
--

CREATE TABLE `blog_angry` (
  `ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `angryBy` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_feedback`
--

CREATE TABLE `blog_feedback` (
  `ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `love` int(11) DEFAULT '0',
  `wow` int(11) DEFAULT '0',
  `happy` int(11) DEFAULT '0',
  `funny` int(11) DEFAULT '0',
  `neutral` int(11) DEFAULT '0',
  `sad` int(11) DEFAULT '0',
  `angry` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_feedback`
--

INSERT INTO `blog_feedback` (`ID`, `blog_ID`, `love`, `wow`, `happy`, `funny`, `neutral`, `sad`, `angry`) VALUES
(1, 1, 16, 9, 5, 2, 4, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `blog_funny`
--

CREATE TABLE `blog_funny` (
  `ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `funnyBy` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_happy`
--

CREATE TABLE `blog_happy` (
  `ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `happyBy` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_love`
--

CREATE TABLE `blog_love` (
  `ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `loveBy` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_neutral`
--

CREATE TABLE `blog_neutral` (
  `ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `neutralBy` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_sad`
--

CREATE TABLE `blog_sad` (
  `ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `sadBy` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_sad`
--

INSERT INTO `blog_sad` (`ID`, `blog_ID`, `sadBy`) VALUES
(1, 1, 94);

-- --------------------------------------------------------

--
-- Table structure for table `blog_wow`
--

CREATE TABLE `blog_wow` (
  `ID` int(11) NOT NULL,
  `blog_ID` int(11) NOT NULL,
  `wowBy` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commentreports`
--

CREATE TABLE `commentreports` (
  `ID` int(11) NOT NULL,
  `commID` int(11) NOT NULL,
  `report` varchar(256) NOT NULL,
  `userID` int(11) NOT NULL,
  `IPaddress` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentreports`
--

INSERT INTO `commentreports` (`ID`, `commID`, `report`, `userID`, `IPaddress`) VALUES
(3, 8, 'It\'s spam', 86, NULL),
(7, 1, 'It shows someone harming themself or planning to harm themself', 0, NULL),
(8, 1, 'It\'s a fake comment', 0, '::1'),
(9, 1, 'I just hate it ðŸ˜¡ðŸ˜¡ðŸ˜¡', 0, '192.168.0.16'),
(10, 4, 'It goes against my views', 86, '::1'),
(11, 103, 'It\'s spam', 94, '192.168.64.1');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` varchar(512) NOT NULL,
  `articleID` int(11) NOT NULL,
  `postDate` datetime NOT NULL DEFAULT '2017-12-31 00:00:00',
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `rootCommentId` int(11) NOT NULL,
  `repliedToCommentId` int(11) NOT NULL,
  `repliedToUserId` int(11) NOT NULL,
  `edited` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ID`, `userID`, `comment`, `articleID`, `postDate`, `likes`, `dislikes`, `score`, `rootCommentId`, `repliedToCommentId`, `repliedToUserId`, `edited`) VALUES
(1, 85, 'Please withdraw this irresponsible article. This is primary research, uncorroborated, and risks considerable harm if people stop courses early as a result of reading this. Antibiotic resistance is not a matter to be taken lightly.', 1, '2017-07-27 23:04:37', 4, 2, 2, -1, -1, -1, 0),
(2, 86, 'Disagree. The basic theme of the article is that, far from the study showing conclusively that stopping early is better, the premise that you should continue to completion does not have sufficient scientific weight or supporting data behind it.Perhaps the headline is somewhat premature in its conclusion but the article is less so.', 1, '2017-07-27 23:07:12', 0, 0, 0, 1, 1, 85, 0),
(3, 87, 'There is a genuine debate about this. Don\'t you think they should report it, so we can stay informed?', 1, '2017-07-27 23:10:49', 0, 0, 0, 1, 1, 85, 0),
(4, 87, 'These authors may be right, but they are very irresponsible by undermining their colleagues, before the correct policy has been established based on evidence. The urge to publish overrules common sense, apparently.', 1, '2017-07-27 23:27:53', 1, 0, 1, -1, -1, -1, 0),
(5, 86, 'I suspect it is less irresponsible researchers and more irresponsible press that takes a study from a medical journal and creates a simplistic headline.', 1, '2017-07-27 23:29:08', 0, 0, 0, 4, 4, 87, 0),
(6, 85, 'It\'s a publication that discusses the evidence in a medical journal intended for other doctors and researchers, which is an entirely appropriate place to start a conversation between colleagues. How this sort of thing gets reported in the popular press is another matter...', 1, '2017-07-27 23:37:00', 0, 0, 0, 4, 5, 86, 0),
(7, 88, 'The mushroom theory of medicine (keep them in the dark ...) Whatever happens, act as if you know what you\'re doing, make sure patients trust your mystical aura of infallibility. All science (including medicine) progresses by trial and error; there\'s no permanent truth, just the theory that stands up best as of today. Some decades ago people who objected to prefrontal leucotomy (lobotomy; literally an ice-pick through the eye socket into the brain and wiggled around, popular in the 1950s AFAIR) were probably', 1, '2017-07-27 23:54:19', 0, 0, 0, 4, 6, 85, 0),
(8, 87, 'The headline of the article is misleading and is not a reflection of the content of the actual paper. The paper in the BMJ provides no mountain of evidence that supports the headline and is littered with \"more research is needed\" quotes - which I thought the BMJ had banned some time ago. I feel the headline is irresponsible reporting and sensationalises at the expense of fact.', 1, '2017-07-28 00:03:33', 0, 0, 0, -1, -1, -1, 0),
(9, 87, 'Sorry, wrong comment. Don\'t know how to remove it :/', 1, '2017-07-28 00:03:50', 0, 0, 0, 1, 4, 87, 0),
(10, 86, 'George Capstic, I disagree with you.', 1, '2017-07-29 09:57:19', 0, 0, 0, 1, 1, 85, 0),
(12, 86, 'Test!!! (checking whether my profile icon shows up when I post a comment)', 1, '2017-08-07 19:51:59', 0, 0, 0, -1, -1, -1, 0),
(13, 86, 'Test 2!!! (checking whether my profile icon shows up when I post a comment, again).', 1, '2017-08-07 19:52:37', 0, 0, 0, -1, -1, -1, 0),
(40, 86, '\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;\'<script>alert(\'hello world\')</script>&lt;', 1, '2017-08-10 02:53:59', 0, 0, 0, -1, -1, -1, 0),
(41, 91, 'I walk around 4 miles through Central London every day, and this article bears absolutely no relationship with reality. People are way more courteous and respectful of personal space than the author suggests, in my experience. There are, of course, exceptions, and everyone has an anecdote.', 1, '2017-08-10 21:47:25', 5, 0, 5, -1, -1, -1, 0),
(42, 86, 'Agreed this article doesn\'t tally with my experience at all.', 1, '2017-08-10 21:52:44', 0, 0, 0, 41, 41, 91, 0),
(43, 90, 'I couldnt agree more, sometimes a group of people loitering together might annoy me but its no biggie.', 1, '2017-08-10 21:56:35', 2, 0, 1, 41, 41, 91, 0),
(44, 85, 'Thank you for that, Malcolm. I am surprised this article doesn\'t count as hate speech - it may think it\'s beeing subtle and humourous, but the trick it\'s playing fro the get-go is to incite separation, dislike for our fellow humans and that confirmation bias (the world\'s out to get me) that is the foundation of type-a personality disorder. Look how the first few comments it gets are fantasies about \"If only I could taser people\" or \"The cyclists are the greatest threat\". It is classic hate speech, encouragi', 1, '2017-08-10 22:00:02', 0, 0, 0, 41, 41, 91, 0),
(45, 88, 'I\'m a walker in London myself, and I tend to agree that most people are fairly courteous, but...\n\n-Iâ€™m a 6ft tall, fairly large bloke. Smaller/older people may be more likely to get barged out of the way. A friend of mine who is a 4 ft 5in, less than 100lb woman regularly complains about being barged into.\n\n-Whilst most people can be polite and considerate, it only takes one arsehole to ruin your day/push you under a bus', 1, '2017-08-10 22:03:47', 2, 1, 2, 41, 41, 91, 0),
(46, 87, 'This tallies with my experience as well. I\'m fine but when my 70 yo 5\'2\" mum comes to London I have to run block block to stop her from getting trampled', 1, '2017-08-10 22:04:50', 0, 0, 0, 41, 45, 88, 0),
(47, 92, '\"I am surprised this article doesn\'t count as hate speech\"\n\nThis may be over-egging things a little don\'t you think?', 1, '2017-08-10 22:13:36', 0, 0, 0, 41, 44, 85, 0),
(48, 92, 'test 1', 1, '2017-08-10 22:19:51', 0, 0, 0, -1, -1, -1, 0),
(49, 86, 'test reply 1', 1, '2017-08-10 22:24:28', 0, 0, 0, 48, 48, 92, 0),
(50, 92, 'test reply 2', 1, '2017-08-10 23:24:34', 0, 0, 0, 48, 49, 86, 0),
(51, 87, 'test reply 3', 1, '2017-08-10 23:25:46', 0, 0, 0, 48, 50, 92, 0),
(52, 87, 'test reply 4', 1, '2017-08-10 23:27:06', 1, 0, 1, 48, 48, 92, 0),
(53, 87, 'test reply 5\n', 1, '2017-08-10 23:27:33', 0, 0, 0, 48, 49, 86, 0),
(54, 86, 'testing the new comment section design.', 1, '2017-08-12 20:30:56', 0, 0, 0, -1, -1, -1, 0),
(74, 94, 'I don\'t agree with this article. I agree to remove it 2!!', 1, '2018-08-14 14:55:45', 0, 0, 0, -1, -1, -1, 1),
(96, 94, 'Hahahah, lol!', 1, '2018-08-14 15:32:14', 0, 0, 0, 41, 45, 88, 1),
(103, 94, 'OOps!!', 1, '2018-08-14 17:04:30', 0, 0, 0, 74, 74, 94, 1),
(116, 94, 'Hello All! 2', 1, '2018-08-14 20:47:07', 0, 0, 0, -1, -1, -1, 1),
(117, 94, 'test', 1, '2018-08-17 22:33:45', 0, 0, 0, -1, -1, -1, 0),
(118, 94, 'Yeah, I agree lol1.', 1, '2018-08-20 23:35:14', 0, 0, 0, 41, 46, 87, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `ID` int(11) NOT NULL,
  `commID` int(11) NOT NULL,
  `dislikedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`ID`, `commID`, `dislikedBy`) VALUES
(1, 1, 86),
(2, 1, 91),
(34, 45, 94);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `ID` int(11) NOT NULL,
  `commID` int(11) NOT NULL,
  `likedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`ID`, `commID`, `likedBy`) VALUES
(32, 1, 87),
(37, 1, 88),
(82, 4, 86),
(83, 41, 86),
(84, 43, 85),
(85, 41, 85),
(86, 41, 88),
(87, 45, 87),
(88, 41, 87),
(89, 41, 92),
(90, 45, 92),
(91, 1, 92),
(92, 52, 92),
(139, 1, 94),
(142, 43, 94);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `date_joined` date NOT NULL,
  `title` varchar(4) DEFAULT NULL,
  `firstname` varchar(32) NOT NULL,
  `middlename` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `pwd` varchar(256) NOT NULL,
  `role` varchar(16) DEFAULT 'member',
  `gender` varchar(16) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `location` varchar(32) DEFAULT NULL,
  `about_me` varchar(256) DEFAULT NULL,
  `interests` varchar(256) DEFAULT NULL,
  `main_website` varchar(64) DEFAULT NULL,
  `country_telephone_code` varchar(4) DEFAULT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `address_1` varchar(32) DEFAULT NULL,
  `address_2` varchar(32) DEFAULT NULL,
  `town` varchar(32) DEFAULT NULL,
  `state` varchar(32) DEFAULT NULL,
  `postcode_or_zipcode` varchar(32) DEFAULT NULL,
  `country` varchar(32) DEFAULT NULL,
  `confirmCode` varchar(64) NOT NULL,
  `confirmed` int(1) DEFAULT '1',
  `profilesetupstatus` int(1) NOT NULL,
  `profile_icon` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `date_joined`, `title`, `firstname`, `middlename`, `lastname`, `username`, `email`, `pwd`, `role`, `gender`, `birthday`, `location`, `about_me`, `interests`, `main_website`, `country_telephone_code`, `phone_number`, `address_1`, `address_2`, `town`, `state`, `postcode_or_zipcode`, `country`, `confirmCode`, `confirmed`, `profilesetupstatus`, `profile_icon`) VALUES
(0, '2017-07-05', NULL, 'non', 'logged', 'user', 'nonLoggedUser', 'nonLoggedUser@me.com', 'RandomPwdYvJ2U8jxvc33hmioGSwBvsEQtmW6GxgDrFTE7BX9YJka5xHxXLuNq7GoYmyZQiNm', 'Ghost', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bangladesh', '', 0, 3, NULL),
(2, '2017-07-05', NULL, 'George', '', 'Capstic', 'geo1', 'georgek931@yahoo.com', '$2y$10$.TMhVEEAvSUgBsSnIVo5.ORoZMLogjy20MXuUPKv1fFrZN/vTmvHi', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'England', '', 0, 1, NULL),
(3, '2017-07-05', NULL, 'George', '', 'Capstic', 'geo2', 'georgek91@yahoo.com', '$2y$10$//9AMxCW.wJN95onGDn1l.rsD48VRuPrk0sujSXIEmTzfvhkop31G', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'England', '', 0, 1, NULL),
(31, '2017-07-06', NULL, 'Jack', 'Alexander', 'Raynolds', 'jray18', 'jackray1998@gmail.com', '$2y$10$iL1fzCNJLzYQlbMBMLoiW.6gQsQ1QDAvk1UDNDpdTTXGoRBfuT2vC', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USA', '', 0, 1, NULL),
(85, '2017-07-07', NULL, 'George', '', 'Capstic', 'geo221', 'georgek981@yahoo.com', '$2y$10$AhIcT8eaTAYVr2qwPAO1iuUiixGuap7L8wzYvTr9qiV7hxWUSUZ0y', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Scotland', 'se94YwGlT3PlmxcFppIXWU3kvyvFJkTnBNsE6G3jZ2d6gJErkL5puNDOCQwaRDJD', 0, 1, NULL),
(86, '2017-07-08', 'Mr', 'George', '', 'Karabassis', 'geo12', 'georgek98@yahoo.com', '$2y$10$WOtrGFkzxShJHkUJ/AnBzOs9cHaF3K2cu8BUDw.Xy9yD/VnDR9oXC', 'admin', 'male', '0000-00-00', 'Athens, Greece', 'Admin & owner of TechPocket | Student @ Edinburgh', 'Electric guitar, animation, graphic design, youtube', 'www.georgekarabassis.com', '', NULL, '', '', '', '', '', 'Greece', 'PTwm11N7sOim5Ykc3J692byl6FgeAH54jxlNSs5zd9MK1VkogdNnbGiJ0Iqaf2Zd', 0, 4, '86-prof-img.png'),
(87, '2017-07-14', NULL, 'Harry', '', 'Moyles', 'harryM21', 'harryMoy996@gmail.com', '$2y$10$tMaMrYISTI3LdMTDxwNb0eRjiBbdq2DjyhKxN/PZ9hirM2co50/Om', 'Editor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'England', 'bw21ZgpCnDjMe601oMaPzLKu1tRxzZW5tAYZe8HjEI9ueY009KzWpXQ9u1TdwR79', 0, 1, '87-prof-img.png'),
(88, '2017-07-14', NULL, 'Peter', '', 'Russell', 'peterRus1', 'p.russell1992@gmail.com', '$2y$10$brUlQtpNLWokD/heG6jEuezGz9klf00WkvrdA3nTl5SWW55/OWRxO', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USA', 'YvJ2U8jxvc33hmioESRBvsEQtmW6GxgrZFTEkBX9YJka5xHxXcuNq7GoYuyZQiNm', 0, 1, NULL),
(89, '2017-08-11', NULL, 'Joshg', '', 'Yung', 'ad', 'asdf', '$2y$10$fTxHnGlcSEe.CFFEecQpce4XC4bAQkhAmE6EUkNh92IyhBFc0IVda', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Wales', '4OjZaJfkB1H6acE09z6jVwwRdNvYJnpdDoUkR7nFu9o6MgUkxaOMgWADRs4yQ2LC', 0, 0, NULL),
(90, '2017-08-11', NULL, 'Cassidy', '', 'Colt', 'theVirgs1', 'cassColt1995@gmail.com', '$2y$10$XzsxC/eXFqPBX9/Ra4MtR.x4/WPxhMDhre4oONp3PgzrYeyh00/66', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'United-Kingdom', 'iQSpM02TVdASAGzmmWEKh1vxVOCe6WyUz1gaxhGSTD1i84zCt86z5PrW79Nvb4Z0', 0, 0, NULL),
(91, '2017-08-11', NULL, 'Victor', '', 'Mikhailov', 'v1ct0R', 'victormikh881@hotmail.com', '$2y$10$7o9XG72S73u4xaTV/o.DeuFilyzia/zuYM4px8LJbSwdYBe2FOhZS', 'member', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Russia', '58SYAFVH9z1ZSaapmBLAp6NQf83aQlBONcU03ltOxqrwGrdEQAPHwVnps5jYfAK0', 0, 0, NULL),
(92, '2017-08-11', NULL, 'Muhammed', '', 'Antar', 'jackTheRipper', 'muhammedAnt77@otenet.com', '$2y$10$kQppR0S.GAHQvEI5p0Ct6ulObmD9hfDLE2xvw1qkCBaYxm3ymtpHm', 'member', NULL, NULL, 'Dubai, UAE', 'I am a human', 'I have no interests!!!', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'United-Arab-Emirates', 'qKJlvEYDwvo8Lpji15HEdnxsTKtLRzAua76GV4wqqAPyfb50h9llHnu9LBmV6jvE', 0, 4, '92-prof-img.png'),
(93, '2018-07-20', '', 'Barsha', 'Noi', 'Rafi', 'braf22', 'barsha.rafi90@gmail.com', '$2y$10$ootsjKcZxIpjozDskqpmzORct7tDq7cANptXqiv3GxURwwgCNr/3a', 'member', 'Male', '2008-07-08', NULL, '', '', '', NULL, NULL, '', '', '', '', '', 'Angola', 'FYerBtEGlT5Rdm7cQYojoqaUISt3uCceIlBs3e2MPbMF1buTzgWrwzINiqmIOc3r', 0, 4, NULL),
(94, '2018-08-11', NULL, 'Hafsa', '', 'Farooq', 'hfrooq89', 'hafsa.farooq1989@gmail.com', '$2y$10$F7AStzXckzV1qy/PzaM.xet/3QLctUsqGxxHyw6UHqOH9AKA52Swm', 'member', 'Male', '1989-04-08', NULL, 'Nothing', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pakistan', 'ZrQ7IDx1Z1M1K9cAiiI3ScqPOtWUiAXicA43fV15XdHFbJZRO41yiBG7NzMEjXCx', 0, 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blog_angry`
--
ALTER TABLE `blog_angry`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `angryBy` (`angryBy`);

--
-- Indexes for table `blog_feedback`
--
ALTER TABLE `blog_feedback`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `blog_ID` (`blog_ID`);

--
-- Indexes for table `blog_funny`
--
ALTER TABLE `blog_funny`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `funnyBy` (`funnyBy`);

--
-- Indexes for table `blog_happy`
--
ALTER TABLE `blog_happy`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `happyBy` (`happyBy`);

--
-- Indexes for table `blog_love`
--
ALTER TABLE `blog_love`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `loveBy` (`loveBy`);

--
-- Indexes for table `blog_neutral`
--
ALTER TABLE `blog_neutral`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `neutralBy` (`neutralBy`);

--
-- Indexes for table `blog_sad`
--
ALTER TABLE `blog_sad`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `sadBy` (`sadBy`);

--
-- Indexes for table `blog_wow`
--
ALTER TABLE `blog_wow`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `wowBy` (`wowBy`);

--
-- Indexes for table `commentreports`
--
ALTER TABLE `commentreports`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `commID` (`commID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `articleID` (`articleID`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `commID` (`commID`),
  ADD KEY `dislikedBy` (`dislikedBy`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `commID` (`commID`),
  ADD KEY `likedBy` (`likedBy`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_angry`
--
ALTER TABLE `blog_angry`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_feedback`
--
ALTER TABLE `blog_feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_funny`
--
ALTER TABLE `blog_funny`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_happy`
--
ALTER TABLE `blog_happy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_love`
--
ALTER TABLE `blog_love`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_neutral`
--
ALTER TABLE `blog_neutral`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_sad`
--
ALTER TABLE `blog_sad`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_wow`
--
ALTER TABLE `blog_wow`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commentreports`
--
ALTER TABLE `commentreports`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_angry`
--
ALTER TABLE `blog_angry`
  ADD CONSTRAINT `blog_angry_ibfk_1` FOREIGN KEY (`angryBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `blog_feedback`
--
ALTER TABLE `blog_feedback`
  ADD CONSTRAINT `blog_feedback_ibfk_1` FOREIGN KEY (`blog_ID`) REFERENCES `blog` (`ID`);

--
-- Constraints for table `blog_funny`
--
ALTER TABLE `blog_funny`
  ADD CONSTRAINT `blog_funny_ibfk_1` FOREIGN KEY (`funnyBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `blog_happy`
--
ALTER TABLE `blog_happy`
  ADD CONSTRAINT `blog_happy_ibfk_1` FOREIGN KEY (`happyBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `blog_love`
--
ALTER TABLE `blog_love`
  ADD CONSTRAINT `blog_love_ibfk_1` FOREIGN KEY (`loveBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `blog_neutral`
--
ALTER TABLE `blog_neutral`
  ADD CONSTRAINT `blog_neutral_ibfk_1` FOREIGN KEY (`neutralBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `blog_sad`
--
ALTER TABLE `blog_sad`
  ADD CONSTRAINT `blog_sad_ibfk_1` FOREIGN KEY (`sadBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `blog_wow`
--
ALTER TABLE `blog_wow`
  ADD CONSTRAINT `blog_wow_ibfk_1` FOREIGN KEY (`wowBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `commentreports`
--
ALTER TABLE `commentreports`
  ADD CONSTRAINT `commentreports_ibfk_1` FOREIGN KEY (`commID`) REFERENCES `comments` (`ID`),
  ADD CONSTRAINT `commentreports_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`articleID`) REFERENCES `blog` (`ID`);

--
-- Constraints for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD CONSTRAINT `dislikes_ibfk_1` FOREIGN KEY (`commID`) REFERENCES `comments` (`ID`),
  ADD CONSTRAINT `dislikes_ibfk_2` FOREIGN KEY (`dislikedBy`) REFERENCES `users` (`ID`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`commID`) REFERENCES `comments` (`ID`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`likedBy`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
