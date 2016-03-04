-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2015 at 09:20 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gaminggalaxy`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `accountID` varchar(10) NOT NULL,
  `accountName` varchar(50) NOT NULL,
  `accountPassword` varchar(15) NOT NULL,
  `accountEmail` varchar(50) NOT NULL,
  `accountType` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountID`, `accountName`, `accountPassword`, `accountEmail`, `accountType`) VALUES
('100001', 'Admin', 'admin', 'admin@hotmail.com', 'Admin'),
('100002', 'vKongv', 'vien941106', ' kaweng456@hotmail.com', 'User'),
('100003', 'duduvien', 'hell44.', ' vien_pinkmoon@live.com', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentID` varchar(10) NOT NULL,
  `commentText` tinytext NOT NULL,
  `commentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewID` varchar(10) NOT NULL,
  `accountID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `commentText`, `commentDate`, `reviewID`, `accountID`) VALUES
('C100001', 'Nice!!!', '2015-01-16 05:01:16', '1000001', '100001'),
('C100002', 'Kong Commented here', '2015-01-16 05:14:49', '1000007', '100001'),
('C100003', 'Kong Commented 2nd Timesss', '2015-01-16 05:15:01', '1000007', '100001'),
('C100004', 'Dudu commented here!', '2015-01-20 18:21:34', '1000007', '100003');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE IF NOT EXISTS `complaint` (
  `complaintID` varchar(10) NOT NULL,
  `complaintName` varchar(70) NOT NULL,
  `complaintEmail` varchar(70) NOT NULL,
  `complaintType` varchar(20) NOT NULL,
  `complaintDetail` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `gameID` varchar(10) NOT NULL,
  `gameName` varchar(100) NOT NULL,
  `gameGenre` varchar(30) NOT NULL,
  `gameRating` decimal(4,1) NOT NULL,
  `gameDescription` longtext NOT NULL,
  `gameReleaseDate` date NOT NULL,
  `gameUserRating` decimal(4,1) NOT NULL,
  `gamePublisher` varchar(100) NOT NULL,
  `gameVideoURL` varchar(100) NOT NULL DEFAULT '-',
  `gameHit` int(11) NOT NULL DEFAULT '0',
  `reviewCount` int(11) NOT NULL DEFAULT '1',
  `reviewUserCount` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`gameID`, `gameName`, `gameGenre`, `gameRating`, `gameDescription`, `gameReleaseDate`, `gameUserRating`, `gamePublisher`, `gameVideoURL`, `gameHit`, `reviewCount`, `reviewUserCount`) VALUES
('G10001', 'Ryse: Son of Rome', 'Action', '4.8', 'Embark on a journey of <b>revenge, betrayal and divine intervention</b>:<br>\r\n<strong>Ryse: Son of Rome</strong> tells the story of Marius Titus, a young Roman soldier who witnesses the murder of his family at the hands of barbarian bandits, then travels with the Roman army to Britannia to seek revenge. Quickly rising through the ranks, Marius must become a leader of men and defender of the Empire on his quest to exact vengeance &ndash; a destiny he soon discovers can only be fulfilled much closer to home. ', '2014-10-10', '4.2', 'Deep Silver, Crytek, Microsoft Studios', 'kA8WGXcPtE4', 36, 2, 4),
('G10002', 'Assasins Creed Rogue', 'Action', '4.5', 'The main character of the game is Shay Patrick Cormac, a twenty-one year-old recruit to the Brotherhood of Assassins who grows disillusioned with their methods and their cause just as his career as an Assassin begins. He eventually betrays and abandons the Assassins after an assignment ends in disaster, and is later accepted into the Templar Order, offering his services as an Assassin Hunter after seeing some of the Assassins groups used as allies have taken to terrorizing New York. Given access to near-limitless resources, Cormac sets out against his former companions, with his actions having dire consequences for the future of the Brotherhood. Cormac has ties to the events that occur in Assassin''s Creed Unity. Appearances from previous Assassin''s Creed characters include: Haytham Kenway, the secondary antagonist of Assassin''s Creed III; Achilles Davenport, Ratonhnhake:ton''s mentor; and Adewale, Edward Kenway''s quartermaster in Black Flag, and protagonist of Freedom Cry.', '2014-11-11', '4.5', 'Ubisoft', 'xzCEdSKMkdU', 3, 1, 1),
('G10003', 'Middle-earth: Shadow of Mordor', 'Action', '4.5', 'Fight through Mordor and uncover the truth of the spirit that compels you, discover the origins of the Rings of Power, build your legend and ultimately confront the evil of Sauron in this new chronicle of Middle-earth. ', '2014-09-30', '4.5', 'WB Games', 'RBtno3ZAQEk', 5, 1, 1),
('G10004', 'Watch_Dogs', 'Action', '4.5', 'All it takes is the swipe of a finger. We connect with friends. We buy the latest gadgets and gear. We find out what is happening in the world. But with that same simple swipe, we cast an increasingly expansive shadow. With each connection, we leave a digital trail that tracks our every move and milestone, our every like and dislike. And it is not just people. Today, all major cities are networked. Urban infrastructures are monitored and controlled by complex operating systems.In Watch_Dogs, this system is called the Central Operating System (CTOS) and it controls almost every piece of the city’s technology and holds key information on all of the city’s residents.You play as Aiden Pearce, a brilliant hacker and former thug, whose criminal past led to a violent family tragedy. Now on the hunt for those who hurt your family, you''ll be able to monitor and hack all who surround you by manipulating everything connected to the city network. Access omnipresent security cameras, download personal information to locate a target, control traffic lights and public transportation to stop the enemy…and more.Use the city of Chicago as your ultimate weapon and exact your own style of revenge.', '2014-05-27', '4.5', 'Ubisoft', 'DqoQG_XYF-8', 4, 1, 1),
('G10005', 'Metal Gear Solid V: Ground Zeros', 'Action', '4.5', 'World-renowned Kojima Productions showcases another masterpiece in the Metal Gear Solid franchise with Metal Gear Solid V: Ground Zeroes. Metal Gear Solid V: Ground Zeroes is the first segment of the ‘Metal Gear Solid V Experience’ and prologue to the larger second segment, Metal Gear Solid V: The Phantom Pain launching thereafter.\r\n\r\n\r\nMGSV: GZ gives core fans the opportunity to get a taste of the world-class production’s unparalleled visual presentation and gameplay before the release of the main game. It also provides an opportunity for gamers who have never played a Kojima Productions game, and veterans alike, to gain familiarity with the radical new game design and unparalleled style of presentation.\r\n\r\n\r\nThe critically acclaimed Metal Gear Solid franchise has entertained fans for decades and revolutionized the gaming industry. Kojima Productions once again raises the bar with the FOX Engine offering incredible graphic fidelity and the introduction of open world game design in the Metal Gear Solid universe. This is the experience that core gamers have been waiting for.', '2014-12-18', '4.5', 'Konami Digital Entertainment', 'ltH1eWxZutE', 5, 1, 1),
('G10006', 'The Crew', 'Racing', '4.5', 'Your car is your avatar - fine tune your ride as you level up and progress through 5 unique and richly detailed regions of a massive open-world US. Maneuver through the bustling streets of New York City and Los Angeles, cruise down sunny Miami Beach or trek through the breathtaking plateaus of Monument Valley. Each locale comes with its own set of surprises and driving challenges to master. On your journey you will encounter other players on the road – all potentially worthy companions to crew up with, or future rivals to compete against. This is driving at its most exciting, varied and open. ', '2014-12-01', '4.5', 'Ubisoft', '_CUg3Eb3DFw', 1, 1, 1),
('G10007', 'Need for Speed: Most Unwanted', 'Racing', '4.5', 'Need for Speed: Most Wanted is a 2012 open world racing game with nonlinear gameplay, developed by Criterion Games and published by Electronic Arts. Announced on 4 June 2012, during EA''s E3 press conference, Most Wanted is the nineteenth title in the long-running Need for Speed series and was released worldwide for Microsoft Windows, PlayStation 3, Xbox 360, PlayStation Vita, iOS and Android, beginning in North America on 30 October 2012, with a Wii U version following on 14 March 2013 under the title Need for Speed: Most Wanted U.', '2013-03-22', '4.5', 'Electronic Arts', 'Z90m9yKaT1M', 1, 1, 1),
('G10008', 'Call Of Duty: Advance Warfare', 'Shooting', '4.9', 'Call of Duty®: Advanced Warfare, developed by Sledgehammer Games (co-developers of Call of Duty®: Modern Warfare® 3), harnesses the first three-year, all next-gen development cycle in franchise history. Call of Duty®: Advanced Warfare envisions a powerful future, where both technology and tactics have evolved to usher in a new era of combat for the franchise. Delivering a stunning performance, Academy Award® winning actor Kevin Spacey stars as Jonathan Irons - one of the most powerful men in the world - shaping this chilling vision of the future of war.\r\n<br>\r\nAll digital purchases of Call of Duty: Advanced Warfare include the bonus Digital Edition Personalization Pack with a custom weapon camo, reticle set and playercard.\r\n<br>\r\nPower Changes Everything.', '2014-11-03', '4.5', 'Activision	', 'sFu5qXMuaJU', 2, 7, 1),
('G10009', 'Battlefield Hardline', 'Shooting', '4.5', 'Battlefield Hardline is an upcoming first-person shooter video game developed by Visceral Games in collaboration with EA Digital Illusions CE and published by Electronic Arts. It is due for release on March 17, 2015.', '2015-03-15', '4.5', 'Electronic Arts', 'ZBN0IsspHlg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imagegame`
--

CREATE TABLE IF NOT EXISTS `imagegame` (
  `imageID` varchar(10) NOT NULL,
  `imageURL` varchar(100) NOT NULL,
  `gameID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagegame`
--

INSERT INTO `imagegame` (`imageID`, `imageURL`, `gameID`) VALUES
('I10001', 'image/ryse.jpg', 'G10001'),
('I10002', 'image/ryse1.jpg', 'G10001'),
('I10003', 'image/ryse2.jpg', 'G10001'),
('I10004', 'image/ryse3.jpg', 'G10001'),
('I10005', 'image/ryse4.jpg', 'G10001'),
('I10006', 'image/ryse5.jpg', 'G10001'),
('I10007', 'image/som.jpg', 'G10003'),
('I10008', 'image/assasin.jpg', 'G10002'),
('I10009', 'image/watchdog.jpg', 'G10004'),
('I10010', 'image/MGSV2.jpg', 'G10005'),
('I10011', 'image/tc2.jpg', 'G10006'),
('I10012', 'image/n4s.jpg', 'G10007'),
('I10013', 'image/codaw.png', 'G10008'),
('I10014', 'image/battle.jpg', 'G10009');

-- --------------------------------------------------------

--
-- Table structure for table `imagenews`
--

CREATE TABLE IF NOT EXISTS `imagenews` (
  `imageID` varchar(10) NOT NULL,
  `imageURL` varchar(100) NOT NULL,
  `newsID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagenews`
--

INSERT INTO `imagenews` (`imageID`, `imageURL`, `newsID`) VALUES
('1000002', 'newsimage/som.jpg', '1000001'),
('1000003', 'newsimage/codaw.png', '1000002');

-- --------------------------------------------------------

--
-- Table structure for table `imagereview`
--

CREATE TABLE IF NOT EXISTS `imagereview` (
  `imageID` varchar(10) NOT NULL,
  `imageURL` varchar(100) NOT NULL,
  `reviewID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagereview`
--

INSERT INTO `imagereview` (`imageID`, `imageURL`, `reviewID`) VALUES
('1000001', 'sysimage/noimg.jpg', '1000001'),
('1000003', 'reviewimage/som.jpg', '1000007'),
('1000004', 'reviewimage/assasin.jpg', '1000008'),
('1000005', 'sysimage/noimg.jpg', '1000009'),
('1000006', 'sysimage/noimg.jpg', '1000010');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `newsID` varchar(10) NOT NULL,
  `newsTitle` tinytext NOT NULL,
  `newsDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `newsText` longtext NOT NULL,
  `accountID` varchar(10) NOT NULL,
  `gameID` varchar(10) NOT NULL,
  `newsHit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsID`, `newsTitle`, `newsDate`, `newsText`, `accountID`, `gameID`, `newsHit`) VALUES
('1000001', '[News] Sons of Rome Release!', '2015-01-16 04:55:34', 'Finally, Sons of Rome had released by today and this is a very good news for all gamer.', '100001', 'G10001', 0),
('1000002', '[News] Call Of Duty : Advance Warfare serious bug that allow user to have unlimited bug', '2015-01-20 20:05:50', 'You had been cheated by this post, no such bug exist! Hahahahahahahahaha!', '100001', 'G10008', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `reviewID` varchar(10) NOT NULL,
  `reviewTitle` tinytext NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewText` longtext NOT NULL,
  `accountID` varchar(10) NOT NULL,
  `gameID` varchar(10) NOT NULL,
  `reviewHit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `reviewTitle`, `reviewDate`, `reviewText`, `accountID`, `gameID`, `reviewHit`) VALUES
('1000001', '[Review] Sons of Roms 5 STARS!', '2015-01-16 05:00:42', 'Very nice to play! Love it!', '100001', 'G10001', 6),
('1000002', '[Review] Sons of Roms!! The Best game ever!', '2015-01-16 05:05:37', 'The best game ever!!!', '100001', 'G10001', 3),
('1000003', '[Review] Sons of Roms!! The Best game ever!!!!!', '2015-01-16 05:08:39', 'The best game ever!!!!', '100001', 'G10001', 1),
('1000004', '[Review] Sons of Roms!! The Best game ever!!!!!', '2015-01-16 05:09:20', 'The best game ever!!!!', '100001', 'G10001', 2),
('1000005', 'KOng', '2015-01-16 05:11:55', 'Testing', '100001', 'G10001', 1),
('1000006', 'Kong Testing', '2015-01-16 05:13:24', 'oKogndfdd', '100001', 'G10001', 0),
('1000007', 'Kong Testing', '2015-01-16 05:14:34', 'oKogndfdd', '100001', 'G10001', 9),
('1000008', '[Review] Son of BIIIIIIIII', '2015-01-20 18:28:02', 'This game is totally nice ! You should have it now !!!! Dont wait till late!', '100001', 'G10001', 2),
('1000009', 'dsdsds', '2015-01-20 20:01:49', 'Hwlllpdal dko momf amdoa mdoad maodm oadm oadm oamd aodm oamd oamd ad a', '100001', 'G10008', 2),
('1000010', '[Review] Call of Duty: Advance Warfare review; A must have game!', '2015-01-20 20:03:08', 'Hello Im a reviewer to review this stupid game !!!! asdao ka', '100001', 'G10008', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`commentID`), ADD KEY `accountID` (`accountID`), ADD KEY `reviewID` (`reviewID`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
 ADD PRIMARY KEY (`complaintID`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
 ADD PRIMARY KEY (`gameID`);

--
-- Indexes for table `imagegame`
--
ALTER TABLE `imagegame`
 ADD PRIMARY KEY (`imageID`), ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `imagenews`
--
ALTER TABLE `imagenews`
 ADD PRIMARY KEY (`imageID`), ADD KEY `newsID` (`newsID`);

--
-- Indexes for table `imagereview`
--
ALTER TABLE `imagereview`
 ADD PRIMARY KEY (`imageID`), ADD KEY `reviewID` (`reviewID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`newsID`), ADD KEY `accountID` (`accountID`), ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
 ADD PRIMARY KEY (`reviewID`), ADD KEY `accountID` (`accountID`), ADD KEY `gameID` (`gameID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`),
ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`reviewID`) REFERENCES `review` (`reviewID`);

--
-- Constraints for table `imagegame`
--
ALTER TABLE `imagegame`
ADD CONSTRAINT `imagegame_ibfk_1` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`);

--
-- Constraints for table `imagenews`
--
ALTER TABLE `imagenews`
ADD CONSTRAINT `imagenews_ibfk_1` FOREIGN KEY (`newsID`) REFERENCES `news` (`newsID`);

--
-- Constraints for table `imagereview`
--
ALTER TABLE `imagereview`
ADD CONSTRAINT `imagereview_ibfk_1` FOREIGN KEY (`reviewID`) REFERENCES `review` (`reviewID`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`),
ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`),
ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`gameID`) REFERENCES `game` (`gameID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
