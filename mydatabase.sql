-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2022 at 08:45 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`product_id`, `product_name`, `product_price`) VALUES
('Wine-100', 'Four Cousins Sweet Red', 10.99),
('Wine-100', 'Four Cousins Sweet Red', 10.99),
('Wine-100', 'Four Cousins Sweet Red', 10.99),
('Wine-100', 'Four Cousins Sweet Red', 10.99),
('Wine-100', 'Four Cousins Sweet Red', 10.99),
('Wine-100', 'Four Cousins Sweet Red', 10.99),
('Wine-100', 'Four Cousins Sweet Red', 10.99),
('Wine-100', 'Four Cousins Sweet Red', 10.99);

-- --------------------------------------------------------

--
-- Table structure for table `catalogue`
--

CREATE TABLE `catalogue` (
  `product_id` varchar(40) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_description` longtext,
  `product_price` float DEFAULT NULL,
  `product_category` varchar(25) DEFAULT NULL,
  `product_quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `catalogue`
--

INSERT INTO `catalogue` (`product_id`, `product_name`, `product_description`, `product_price`, `product_category`, `product_quantity`) VALUES
('Lager100', 'Heinekien', 'Popularly known as The Chairman, Heineken is popularly known around the world for its unique, great taste, rich tradition, and superior quality. Brewed using the unrivaled recipe invented three generations ago by the Heineken family in Amsterdam since 1873', 5.66, 'Beer', 0),
('Stout100', 'Guniess Stout', 'Guinness Foreign Extra Stout is a beer born of a thirst for adventure, tracing its origins back to a recipe for our West India Porter, first set out by Arthur Guinness II in 1801.', 6.35, 'Beer', 26),
('Lager200', 'Budwiser', 'A premium imported American-style Lager. The Beechwood aging process used to brew Budweiser produces a taste, smoothness, and drinkability which results in a beer that is crisp, clean, and refreshing. It was first introduced by Adolphus Busch in 1876 and still brewed with the same high standards today.', 5.22, 'Beer', 2),
('Lager300', 'Star Lger Beer', 'For over 7 decades, Star Lager Beer has continued to be the beer of choice to celebrate key moments in everyday life, especially in Nigeria. It is perfectly brewed with 100% natural ingredients, high-quality hops, the best quality water, and the finest malted barley in the country.', 5.77, 'Beer', 20),
('Stout200', 'Legend Etra Stout', 'Produced by Nigerian Breweries PLC since 1961, Legend Extra Stout is one of the favourite beer brands consumed in Nigeria. Legend Extra Stout is a unique bitter-tasting premium stout, fully brewed from the finest natural ingredients to the best of international quality standards by Nigerian Breweries Plc.', 5.36, 'Beer', 17),
('Whisky100', 'Johnnie Walker Red-Label', 'Johnnie Walker Red Label was launched in 1909 as a kind of whisky more appropriate for mixing with soda than the older types of whiskies. It was named after the manufacturer\'s grandfather and has now become one of the most popular whisky brands in the world today. Crafted in Scotland, its smoky flavours are enticing enough for you to order a second bottle.', 30.55, 'Whisky', 18),
('Whisky200', 'Johnnie Walker Black-Label', 'Johnnie Walker Black Label has an unmistakably smooth, deep, and opulent character, and this is why its the most widely distributed blended Scotch Whisky in the world. Full of dark fruits, sweet vanilla, and signature smokiness, the blend of mature whiskies over 12 years old dances on your tongue.', 29.99, 'Whisky', 13),
('Whisky300', 'Jameson', 'Currently selling at around 4 million cases per year, Jameson is the world\'s bestselling and favourite Irish whiskey. Founded in 1780 in Dublin, Ireland, the Midleton Distillery by John Jameson and Son produces some of the finest Irish whiskeys in the world. John Jameson pioneered the art of Triple Distillation, which is the tradition that to this day gives Jameson whiskeys their exceptionally smooth taste.', 22.99, 'Whisky', 19),
('Whisky400', 'Jack Daniels Old', 'MJack Daniel\'s Black Label (also popularly called Old No 7, or more commonly as JD or simply Jack) is one of the bestselling whiskeys in the world. Jack Daniels is made in the Tennessee sour mash style. It is very similar to bourbon with the additional step of charcoal filtering the unaged whiskey.', 32.89, 'Whisky', 12),
('Whisky500', 'Henessy VS', 'Hennessy VS Cognac is medium amber with fine aromas of sweet fruit, honey, caramel, cloves, nuts, and oaky notes. The palate is round with smooth fruity flavours of orange peel, prune, and vanilla on a long lingering finish.', 32.99, 'Whisky', 11),
('Wine100', 'Four Cousins Sweet Red', 'Made in South Africa, the Four Cousins Natural Sweet Red is a fragrant, ruby-red wine made for everyday enjoyment. This exotic wine has a rich, soft rose petal perfume that delights the senses. It\'s elegantly endowed with flavours of ripe plums, strawberries, and exotic spices, and a soft, lingering finish. This sweet red wine is blended from noble cultivars and grape juice.', 10.99, 'Wine', 9),
('Wine200', 'Declan Red Wine', 'The Declan red wine is bold, slightly tannic, dry, and slightly acidic. It is also easy-drinking, fruity, rich in taste, and full-bodied with notes of berry and jam. It is a great addition to a gathering of friends with the profound blend of sweetness and sophistication in fruity taste that it offers.', 10.33, 'Wine', 11),
('Wine300', 'Carlo Rossi Red', 'Carlo Rossi Red wines are made from the most delicious grapes from the Central Valley of California. The characteristics of those grapes evolve from year to year but Carlo Rossi wine has always been served in a sturdy glass jug. With Carlo Rossi wines, we can always count on quality and value', 22.82, 'Wine', 14),
('Wine400', 'Agor Red Wine', 'The Agor Red Wine is formerly known as the Kagor Red wine, it has the same taste and is produced from Cabernet Sauvignon grapes. There is no difference between the Agor and Kagor red wine for those wondering. It has a delicate taste with chocolate shades, a ruby colour, and a wonderful aroma. The wine is made using classical technology. Agor wine has a distinct blackcurrant aroma which is in perfect harmony with the sweetish taste of forest fruits and is specially packaged in a one of kind bottle design.', 20.5, 'Wine', 17),
('Wine500', '4th Street Sweet Red', '4th Street Sweet Red Wine is low alcohol, rare blend of sweet red wine made in the Western Cape, South Africa. It is easy to drink and has a fruity sweetness that emanates from the preservation of fresh grape juice which does not allow fermentation. It has a dark red color and combines its fruity taste with its sophistication.', 10.78, 'Wine', 12);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` varchar(64) DEFAULT NULL,
  `session_data` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
