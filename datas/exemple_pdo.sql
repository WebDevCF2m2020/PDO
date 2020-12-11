-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 déc. 2020 à 07:41
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `exemple_pdo`
--
CREATE DATABASE IF NOT EXISTS `exemple_pdo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `exemple_pdo`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
                                          `idarticles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                          `thetitle` varchar(120) NOT NULL,
                                          `thetext` text NOT NULL,
                                          `thedate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                                          `users_idusers` int(10) UNSIGNED NOT NULL,
                                          PRIMARY KEY (`idarticles`),
                                          KEY `fk_articles_users_idx` (`users_idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idarticles`, `thetitle`, `thetext`, `thedate`, `users_idusers`) VALUES
(1, 'La course au vaccin contre le coronavirus s\'accélère: comment l\'expliquer? Faut-il s\'en méfier?', 'Comment expliquer une telle rapidité dans la recherche? \r\n\r\nCeci s\'explique grâce au financement. Développer et élaborer un nouveau vaccin, cela coûte cher aux entreprises pharmaceutiques. Mais dans ce cas-ci, l\'argent n\'est pas un frein comme l\'explique Jean-François Saluzzo, virologue et expert auprès de l\'Organisation Mondiale de la Santé. \"Les laboratoires pharmaceutiques ont reçu d\'importantes subventions des Etats, ce qui leur a évité le risque financier. Une phase 3 coûte entre 300 à 500 millions. Dans le cas présent, le risque financier n\'existant pas, les laboratoires ont pu franchir toutes les étapes pour arriver à la phase 3 de façon extrêmement rapide\", indique-t-il. \r\n\r\nCes vaccins élaborés dans un temps record, sont-ils fiables?\r\n\r\n\"Oui\" selon Jean-François Saluzzo. \"L\'étude de phase 3 est parfaitement réalisée, on ne peut pas dire qu\'il y a une accélération quelconque\", explique-t-il. Le vaccin développé par Moderna a été testé sur 30.000 personnes et il est considéré comme \"efficace\" à 94.5%.', '2020-11-17 08:18:23', 1),
(2, 'Bientôt cotée, Airbnb montre la résistance de son modèle à la pandémie', 'La plateforme de location de logements entre particuliers Airbnb a dégagé 219 millions de dollars de bénéfice net de juillet à septembre, un signe que l\'entreprise, qui s\'apprête à entrer en Bourse, semble avoir la capacité de bien résister à la pandémie, un fléau sans fin pour ses concurrents.\r\n\r\n\r\nLa société née à San Francisco il y a 13 ans a créé un concept qui a bouleversé l\'industrie des voyages professionnels et du tourisme, avec 4 millions d\'hôtes à son compteur.\r\n\r\nMais elle a été heurtée de plein fouet par les mesures sanitaires imposées dans le monde à l\'hiver et au printemps dernier: son chiffre d\'affaires des 9 premiers mois de 2020 a plongé de 32% sur un an, à 2,5 milliards de dollars.\r\n\r\nLe Covid-19 \"va continuer d\'avoir un impact négatif sur nos résultats opérationnels et financiers sur le long terme\", reconnaît le groupe californien, qui a publié lundi son dossier officiel pour son arrivée prochaine à Wall Street.\r\n\r\nLe quatrième trimestre, notamment, est mal parti, alors que la résurgence actuelle de la maladie entraîne de nouveaux confinements, notamment en Europe.', '2020-11-17 08:19:11', 2),
(3, 'Le Pérou a un nouveau président après une semaine de chaos politique', 'Le Parlement péruvien a élu lundi le député centriste Francisco Sagasti président par intérim, après une semaine de chaos politique qui a vu la destitution du président Martin Vizcarra puis la démission de son successeur Manuel Merino.\r\n\r\n\r\nFrancisco Sagasti, un novice en politique âgé de 76 ans, a été élu président du Parlement par les députés et devient automatiquement chef de l\'Etat.\r\n\r\nNormalement, quand le président du Pérou est destitué, c\'est le vice-président qui assure l\'intérim. Mais le pays n\'a plus de vice-président depuis une précédente crise politique survenue il y a un an, et dans ce cas c\'est le président du Parlement qui devient chef de l\'Etat par intérim, selon les dispositions de la Constitution.\r\n\r\n\"Ce qui manque à notre pays en ce moment, c\'est la confiance. Faites-nous confiance, nous agirons comme nous le disons\", a déclaré devant le Parlement M. Sagasti, qui sera officiellement investi mardi.\r\n\r\nFrancisco Sagasti a mentionné dans son intervention les deux manifestants morts samedi au cours d\'une manifestation réprimée par la police. \"Quand un Péruvien meurt, et plus encore s\'il est jeune, c\'est tout le Pérou qui est en deuil. Et s\'il meurt en défendant la démocratie, le deuil est aggravé par l\'indignation\", a-t-il déclaré.', '2020-11-17 08:20:01', 1),
(4, 'Handicap: Castex et une vingtaine de ministres annoncent de nouvelles mesures', 'De nouvelles aides pour mieux concilier handicap et parentalité, un soutien prolongé aux embauches, une communication officielle plus accessible: le gouvernement a présenté lundi de nouvelles mesures en faveur des personnes handicapées, voulant montrer qu\'il ne \"ralentit pas\" les réformes, malgré la crise sanitaire.\r\n\r\n\r\nUn \"comité interministériel du handicap\" (CIH), organisé à Matignon dans la matinée autour de Jean Castex et de sa secrétaire d\'État au Handicap Sophie Cluzel, a réuni en visioconférence 18 ministres, dont Jean-Michel Blanquer (Éducation), Élisabeth Borne (Travail) et Gérald Darmanin (Intérieur) mais également des représentants d\'associations.\r\n\r\nCe rendez-vous a été \"l\'occasion pour chacun des ministres d\'avoir un aiguillon qui nous rappelle la réalité de la vie quotidienne de toutes les personnes en situation de handicap\", a déclaré à la presse le Premier ministre à l\'issue de la réunion.\r\n\r\nAinsi, le gouvernement a annoncé l\'extension du dispositif de la prestation de compensation du handicap (PCH) pour couvrir des aides à la parentalité, ce qui pourrait bientôt concerner quelque 17.000 parents en situation de handicap.', '2020-11-17 08:21:12', 2),
(5, 'Bélarus: plus de 700 personnes détenues après la manifestation de l\'opposition', '\"Au total, plus de 700 personnes ont été placées en détention pour violation de la législation sur les événements de masse et avant l\'examen de leurs infractions devant les tribunaux\", a indiqué dans un communiqué la porte-parole du ministère de l\'Intérieur, Olga Tchemodanova.\r\n\r\nSelon l\'organisation bélarusse de défense des droits humains Viasna, au moins 1.200 personnes avaient été interpellées lors de la manifestation dominicale de l\'opposition, quasi immédiatement dispersée par la police qui a usé de grenades assourdissantes et de gaz lacrymogène.\r\n\r\nLundi, la figure de proue de l\'opposition Svetlana Tikhanovskaïa a indiqué avoir rencontré les ambassadeurs de l\'UE et appelé à de nouvelles sanctions économiques contre des entreprises publiques bélarusses et des banques liées à l\'Etat.\r\n\r\nLes Européens ont déjà sanctionné Alexandre Loukachenko, son fils Viktor et plusieurs dizaines de membres de leur entourage et hauts responsables bélarusses. Ils ont brandi la menace de nouvelles sanctions après la mort d\'un opposant, décédé après son interpellation.\r\n\r\nMme Tikhanovskaïa est réfugiée à l\'étranger, comme la quasi totalité des figures de l\'opposition qui n\'ont pas été emprisonnées.\r\n\r\nC\'est également à l\'étranger, en Pologne, que résident actuellement deux blogueurs bélarusses, Stépan Poutilo et Roman Protassevitch, qui animent la chaîne Telegram NEXTA Live, qui coordonne en partie la protestation contre Alexandre Loukachenko.\r\n\r\nLundi, le ministère bélarusse des Affaires étrangères a annoncé avoir convoqué le chargé d\'affaires polonais à Minsk pour l\'informer que le Bélarus avait demandé l\'extradition de ces deux blogueurs accusés par les autorités bélarusses d\'activités \"extrémistes\".\r\n\r\nFin octobre, la justice bélarusse avait déjà placé cette chaîne Telegram sur la liste de ressources \"extrémistes\", l\'accusant d\'\"organisation et des appels publics à la mise en oeuvre de troubles massifs\".\r\n\r\nDepuis le début de la contestation visant Alexandre Loukachenko, 66 ans et au pouvoir depuis 1994, des milliers de personnes ont été arrêtées, au moins quatre sont mortes et dizaines d\'autres ont dénoncé des tortures et violences durant leur détention.\r\n\r\nSoutenu par Moscou, Alexandre Loukachenko refuse de quitter le pouvoir et n\'a évoqué que de vagues réformes constitutionnelles pour tenter de calmer la protestation.\r\n\r\nLundi, M. Loukachenko a assuré avoir convenu de \"transférer 70 à 80% des pouvoirs du président au Parlement, au gouvernement et à d\'autres structures\" à la faveur d\'hypothétiques réformes dont on ne connaît rien.', '2020-11-17 08:21:57', 1),
(33, 'pdaoibcef', 'veniam do veniam ex minim ullamco sed nisi sit quis veniam Ut ea nisi veniam magna tempor sed magna nostrud\r\nexercitation amet\r\nconsectetur sed dolor ut\r\nlabore dolore et ullamco tempor incididunt Ut Lorem tempor ut elit ', '2020-12-10 14:51:41', 3),
(34, 'iobpdacfe', 'veniam aliquip elit dolore nostrud\r\nexercitation incididunt Lorem ut nostrud\r\nexercitation quis commodo\r\nconsequat dolore ut\r\nlabore tempor veniam aliquip laboris Lorem sit veniam nisi sed laboris aliqua ea ullamco sed ', '2020-12-10 14:51:43', 3),
(35, 'Pecobafdi', 'nostrud\r\nexercitation ut\r\nlabore quis amet\r\nconsectetur ut\r\nlabore sit ad eiusmod aliquip elit ea Ut sed ea dolore dolore ut do elit enim do enim aliqua ut\r\nlabore aliquip ut\r\nlabore Ut nisi ipsum ad ipsum adipisicing quis magna quis ', '2020-12-10 14:53:27', 1),
(36, 'Abdoficep', 'veniam sit Ut magna ut\r\nlabore magna ipsum incididunt incididunt adipisicing nisi tempor aliquip Lorem laboris adipisicing do ut\r\nlabore nisi dolore incididunt Ut adipisicing magna ipsum do ', '2020-12-10 14:53:28', 1),
(37, 'Bdafcpioe', 'Ut ut\r\nlabore ad ex ea laboris aliqua nisi aliquip sed ad enim aliqua dolor ea tempor do dolore adipisicing aliquip dolore ipsum elit et commodo\r\nconsequat aliquip quis et commodo\r\nconsequat minim ', '2020-12-10 15:00:25', 2),
(38, 'Piodfaceb', 'amet\r\nconsectetur sit quis laboris elit amet\r\nconsectetur et laboris ullamco ipsum eiusmod aliqua aliquip nostrud\r\nexercitation ut ullamco ex nostrud\r\nexercitation minim aliquip tempor ipsum incididunt dolore sit ullamco incididunt enim do magna ', '2020-12-10 15:00:25', 1),
(39, 'Paceiofdb', 'magna veniam eiusmod Ut sit et ad ullamco enim quis et adipisicing et aliqua laboris quis ea dolore magna ut do ad adipisicing quis ut\r\nlabore ullamco ex incididunt amet\r\nconsectetur ', '2020-12-10 15:01:50', 2),
(40, 'Piceobadf', 'ut\r\nlabore sit tempor dolor sed tempor nisi ullamco eiusmod incididunt minim aliqua ad tempor adipisicing adipisicing ullamco ad laboris tempor ullamco do quis quis incididunt ut commodo\r\nconsequat tempor ut dolor ipsum commodo\r\nconsequat et ', '2020-12-10 15:01:50', 2),
(41, 'Daibepfoc', 'Ut ex tempor eiusmod magna amet\r\nconsectetur sit amet\r\nconsectetur sit ullamco laboris commodo\r\nconsequat commodo\r\nconsequat tempor nisi enim laboris ex quis ex do ', '2020-12-10 15:02:23', 3),
(42, 'Ocaipfbde', 'ex incididunt ad commodo\r\nconsequat Lorem ut\r\nlabore Lorem ullamco minim laboris nostrud\r\nexercitation tempor amet\r\nconsectetur sit ', '2020-12-10 15:02:23', 1),
(43, 'Acdibofpe', 'veniam nisi enim elit ipsum Ut ut et elit magna tempor tempor sit laboris nostrud\r\nexercitation dolore dolor veniam sit commodo\r\nconsequat ad dolore enim quis dolor do amet\r\nconsectetur laboris enim ', '2020-12-10 15:02:59', 1),
(44, 'Baopdiecf', 'do et sed adipisicing dolore dolor nisi dolor aliqua magna dolor dolore sit veniam laboris elit dolor aliqua commodo\r\nconsequat et minim laboris dolore incididunt sed dolor laboris commodo\r\nconsequat incididunt et minim eiusmod ', '2020-12-10 15:03:59', 3),
(45, 'Fibopeacd', 'sit aliquip tempor aliqua nostrud\r\nexercitation minim ut\r\nlabore elit dolore enim sed ullamco Ut ex aliqua ex tempor do ipsum amet\r\nconsectetur et Ut sit aliquip nisi ut\r\nlabore quis ea aliqua dolor dolore nostrud\r\nexercitation dolor ut ', '2020-12-10 15:13:37', 2),
(46, 'Ibpdecofa', 'ipsum ut\r\nlabore Lorem aliqua laboris sit do magna elit commodo\r\nconsequat commodo\r\nconsequat eiusmod ut\r\nlabore Ut ullamco dolor elit et Ut aliqua veniam elit amet\r\nconsectetur Ut ', '2020-12-10 15:13:37', 3),
(47, 'Cdbifopae', 'minim aliquip magna nostrud\r\nexercitation ea minim ad ex enim et ', '2020-12-10 15:13:41', 3),
(48, 'Odbfceaip', 'Lorem ullamco commodo\r\nconsequat magna tempor ipsum ea quis elit ad magna commodo\r\nconsequat sed magna tempor dolore elit tempor ', '2020-12-10 15:13:42', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
                                       `idusers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                       `thelogin` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
                                       `thepwd` char(64) NOT NULL,
                                       `thename` varchar(120) NOT NULL,
                                       PRIMARY KEY (`idusers`),
                                       UNIQUE KEY `thelogin_UNIQUE` (`thelogin`),
                                       UNIQUE KEY `thename_UNIQUE` (`thename`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idusers`, `thelogin`, `thepwd`, `thename`) VALUES
(1, 'Juliette', 'Juliette', 'Grecko Juliette'),
(2, 'Prince', 'Prince', 'Prince Philippe'),
(3, 'edr', 'edr', 'edr'),
(5, 'dtgtry', 'dtgtry', 'dtgtry'),
(26, 'fdsyheuy', 'fdsyheuy', 'fdsyheuy'),
(28, 'rftyr&#039;y', 'stru-(tyu', 'ujtyuijruyk'),
(29, 'Aide-au-projet', 'fgjhg', 'gfgjttj'),
(30, 'aaa', 'bbb', 'cccc'),
(31, 'ezgtf', 'rqegh', 'ryh'),
(32, 'tryhtr', 'gsrjh', 'struj');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
    ADD CONSTRAINT `fk_articles_users` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
