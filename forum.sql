-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 16 Mai 2017 à 16:31
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `forum_post`
--

CREATE TABLE `forum_post` (
  `Id_forum_post` int(11) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `post` text NOT NULL,
  `date_post` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `forum_post`
--

INSERT INTO `forum_post` (`Id_forum_post`, `Id_user`, `post`, `date_post`) VALUES
(1, 3, 'My first post is about the inherent pain in the ass that web dev can be.\r\nI guess many here have been into the path of computer studies. Who could blame you. There is not, to this day, I thinmore blatant display of awesomeness than what the internet provides. Nevertheless, one who spend to much time stuck between two lines of codes might indeed lose sight of life itself. \r\nI think Imma go fishing. It\'s soothes me.', '2017-04-27 17:50:17'),
(2, 6, 'I cannot but  feel compelled to answer the cry for help that escaped from our brother PapaBear. \r\nGreatness comes with a price and what I ask could be greater than being a tireless architect of our God the Internet?\r\nI am struck with the outmost terror when I venture to imagine a life without my coding.\r\nSo I implore you brother, come tou your senses and let\'s watch the last episode of Rick and Morty together. Fishing is for the normies. You are not a plebian.', '2017-04-27 18:38:32'),
(3, 4, 'What is this nonsens about normies and plebians? One cannot go to the gents without you scoudrel tarnishing our forum? If PapaBear wants to go fishing breathe the fresh air and talk to actual people it is none of our business.\r\nThou the new Rick and Morty is bananas!', '2017-04-27 18:41:22'),
(4, 6, 'It pleases me to see that you are not immune to the innate beauty of Rick and Morty. But alas your brain seem to be acquin to one of an insect since you can\'t stop yourself from spurting the purest form of idiocy. The normies would have us all confined into the etriqueness of their comfortable world. This is no place for the timids and the cowards. This is the Third Wave where the future of the internet is woven by our combine uniqueness. PapaBear deserves that we fight for the purity of his soul. We all made a vow of no-life. Such vow cannot be broken.', '2017-04-27 20:46:33'),
(5, 7, 'So much gravita is unbecoming of a member of our distinguished club. Perhaps the brother Henry would be so kind as to enlight us all with a more detailed exposé of this so called &quot;vow of no-life&quot;?', '2017-04-27 22:19:47'),
(6, 9, 'Ask your non-existant girlfriend.', '2017-05-12 18:39:35'),
(7, 10, 'Since no one will be desperate enough to assisit you in the matter, the non-existant girlfreind wants you to go fuck yourself @Belzunce.\r\n\r\n\r\n\r\n\r\n\r\n\r\n, ', '2017-05-13 01:32:26');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_registration` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`Id_user`, `username`, `email`, `password`, `date_registration`, `gender`, `description`, `birthday`) VALUES
(2, 'Snowden', 'snowden@mail.com', 'nsarules', '2017-04-26 16:25:57', '', '', '0000-00-00'),
(3, 'PapaBear', 'notPedo@darknet.ac', 'c34dc1f92f9a74ca2ea256ad9b3aa8ef670d01ed', '2017-04-26 16:42:45', 'You\'ll have to ask me', 'The young and the inncocent are a mirror to our regrets.', '0000-00-00'),
(4, 'JamalSmith', 'jamalSmith@mail.com', 'a0eb9a3a31a41867a49085b448679217d74f06e9', '2017-04-26 18:29:42', 'male', 'Whatever is it that you have to do in life, do it with style.\r\n', '0000-00-00'),
(5, 'cutyPie57', 'cuty_cuty@kawaii.ja', 'b3b54ea8fff8877ecda89555f79b86b3bab34afe', '2017-04-26 18:41:53', '', '', '0000-00-00'),
(6, 'Henry The Fourth', 'king_henryIV@yourmajesty.com', 'd0013670c0fc33e803fb5725c5ca7fa3fa627824', '2017-04-27 18:33:40', 'You\'ll have to ask me', 'We are who we chose to be. I am Power', '0000-00-00'),
(7, 'crocodileD', 'crocD@yahoo.net', 'c1673dcace5268cf115e28db8e84920dd5bb38ab', '2017-04-27 20:49:12', 'female', '', '0000-00-00'),
(8, 'Heater68', 'heater68@mail.com', 'bb21158c733229347bd4e681891e213d94c685be', '2017-04-27 23:10:51', '', '', '0000-00-00'),
(9, 'Belzunce', 'belzunce_breakdown@mail.com', '4e6ea189dfead6b1390bf170b94f3e1f23eaedb3', '2017-05-05 11:57:31', 'male', 'Life is about bullshit and really long texts. \r\nIn the end it doesn\'t really matter.\r\nNothing else matters.\r\n', '0000-00-00'),
(10, 'Anon_Kek', 'anon_kek@email.fr', '0a92fab3230134cca6eadd9898325b9b2ae67998', '2017-05-13 01:27:40', 'female', 'Everything is going according to plan.', '2002-02-19');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `forum_post`
--
ALTER TABLE `forum_post`
  ADD PRIMARY KEY (`Id_forum_post`),
  ADD KEY `Id_user` (`Id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_user`),
  ADD KEY `Id_user` (`Id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `forum_post`
--
ALTER TABLE `forum_post`
  MODIFY `Id_forum_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `forum_post`
--
ALTER TABLE `forum_post`
  ADD CONSTRAINT `forum_post_ibfk_1` FOREIGN KEY (`Id_user`) REFERENCES `users` (`Id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
