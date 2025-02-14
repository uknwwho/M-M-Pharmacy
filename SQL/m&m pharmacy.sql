-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 12:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m&m pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(3) NOT NULL,
  `admin_fname` varchar(20) NOT NULL,
  `admin_lname` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_pass`) VALUES
(101, 'Muntasir Mamun', 'Sakib', 'mamun.admin@gmail.com', 'admin'),
(102, 'Mahir', 'Khan', 'mahir.admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `browses`
--

CREATE TABLE `browses` (
  `order_id` int(5) NOT NULL,
  `pdt_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `complaint_subject` varchar(255) DEFAULT NULL,
  `complaint_details` text DEFAULT NULL,
  `complaint_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `user_id`, `complaint_subject`, `complaint_details`, `complaint_date`) VALUES
(1, 12, 'Medicine', 'Expired medicine was provided', '2024-09-22 19:41:51'),
(4, 12, 'Product not delivered', 'What the hell man?', '2024-09-22 19:51:22'),
(5, 12, 'Boycott', 'I will boycott this page!', '2024-09-22 20:04:06'),
(6, 2, 'Need Poision', 'Why dont you people sell poision?', '2024-09-22 20:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

CREATE TABLE `manage` (
  `pdt_id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `admin_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `pdt_id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `order_quantity` int(3) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` int(1) NOT NULL,
  `complain` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `pdt_id`, `user_id`, `order_quantity`, `order_date`, `order_status`, `complain`) VALUES
(1, 1, 1, 10, '2024-09-21', 0, NULL),
(2, 14, 1, 1, '2024-09-21', 1, NULL),
(3, 14, 1, 1, '2024-09-21', 1, NULL),
(4, 14, 1, 1, '2024-09-21', 1, NULL),
(5, 9, 1, 1, '2024-09-21', 1, NULL),
(6, 3, 3, 8, '2024-09-21', 0, NULL),
(7, 15, 3, 1, '2024-09-21', 0, NULL),
(8, 15, 3, 1, '2024-09-21', 1, NULL),
(9, 7, 3, 1, '2024-09-21', 0, NULL),
(10, 12, 12, 4, '2024-09-22', 0, NULL),
(11, 1, 10000, 10, '2024-09-23', 0, NULL),
(12, 17, 12, 1, '2024-09-23', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pdt_id` int(5) NOT NULL,
  `pdt_name` varchar(200) NOT NULL,
  `pdt_company` varchar(100) NOT NULL,
  `pdt_ctg` varchar(20) NOT NULL,
  `pdt_meterial` varchar(100) NOT NULL,
  `pdt_img` varchar(300) NOT NULL,
  `pdt_quantity` int(3) NOT NULL,
  `pdt_cost` int(10) NOT NULL,
  `pdt_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pdt_id`, `pdt_name`, `pdt_company`, `pdt_ctg`, `pdt_meterial`, `pdt_img`, `pdt_quantity`, `pdt_cost`, `pdt_details`) VALUES
(1, 'Napa 500mg Tablet', 'Beximco Pharmaceuticals Ltd.', 'medicine', 'Paracetamol', 'napa.png', 890, 2, '\r\nNapa 500 mg is indicated for fever, common cold and influenza, headache, toothache, earache, bodyache, myalgia, neuralgia, dysmenorrhoea, sprains, colic pain, back pain, post-operative pain, postpartum pain, inflammatory pain and post vaccination pain in children. It is also indicated for rheumatic & osteoarthritic pain and stiffness of joints.'),
(2, 'Serge l20mg Capsule', 'Healthcare Pharmacuticals Ltd.', 'medicine', 'Esomeprazole Magnesium Trihydrate', 'sergel.png', 900, 7, 'Sergel 20 mg is indicated: To alleviate GERD-related symptoms such as persistent heartburn and others. In order to treat erosive esophagitis. To maintain the erosive esophagitis\'s ability to recover. for the eradication of Helicobacter pylori infection in individuals with duodenal ulcer disease when used in conjunction with amoxicillin and clarithromycin. Syndrome of Zollinger-Ellison. Duodenal & gastric ulcers caused by acid dyspepsia.'),
(3, 'Ceevit 250mg Chewable Tablet', 'Square Pharmaceuticals PLC.', 'medicine', 'Vitamin C [Ascorbic acid]', 'cvit.png', 900, 2, 'Ascorbic Acid (Vitamin C) is indicated in- Prevents & treats scurvy Helps in healing wounds & broken bones Helps to form collagen in connective tissues Aids in iron absorption & helps to treat anemia Contributes in production of hemoglobin & red blood cell in bone marrow ... Read moreAscorbic Acid (Vitamin C) is indicated in- Prevents & treats scurvy Helps in healing wounds & broken bones Helps to form collagen in connective tissues Aids in iron absorption & helps to treat anemia Contributes in production of hemoglobin & red blood cell in bone marrow Aids in preventing many types of viral and bacterial infections and potentiates the immune system Aids in the treatment & prevention of the common cold Promotes healthy capillaries, gums & teeth'),
(4, 'Monas 10mg Tablet', 'ACME Laboratories Ltd.', 'medicine', 'Montelukast', 'monas10.png', 900, 18, 'Monas 10 mg is indicated for: Prophylaxis and chronic treatment of asthmaAcute prevention of Exercise-Induced Bronchoconstriction (EIB) Relief of symptoms of Allergic Rhinitis (AR): Seasonal & Perennial Allergic Rhinitis'),
(5, 'Pantonix 20mg Tablet', 'Incepta Pharmaceuticals Ltd.', 'medicine', 'Pantoprazole', 'pantonix.png', 900, 7, 'Pantonix 20 mg is recommended when inhibiting acid secretion is therapeutically beneficial, i.e. Stomach ulcer disorders. Illnesses caused by gastroesophageal reflux. Non-steroidal anti-inflammatory drug-induced ulcer (NSAIDs) Helicobacter pylori eradication (in combination with antibiotics) Syndrome of Zollinger-Ellison'),
(6, 'Sensodyne Fresh Gel 75gm', 'GSK', 'dental_care', 'Oral Paste', 'sensodyne.png', 50, 199, 'Sensodyne Fresh Gel 75 gm is known for its effectiveness in keeping teeth clean and healthy. It contains fluoride to prevent tooth decay and strengthens enamel. Sensodyne Fresh Gel 75 gm also has a refreshing mint flavor that leaves the mouth feeling clean and fresh.'),
(7, 'Orostar Plus 250ml Mouthwash', 'Square Pharmaceuticals PLC.', 'dental_care', 'Eucalyptol + Menthol + Methyl Salicylate + Thymol + Sodium Fluoride', 'orostar.png', 19, 169, 'Each 100 ml contains- Eucalyptol 92 mg Menthol 42 mg Methyl Salicylate 60 mg Thymol 64 mg Sodium Fluoride 20 mg'),
(8, 'Mediplus Toothbrush Toothbrush', 'Anfords', 'dental_care', 'Toothbrush', 'tothbrash.png', 50, 99, 'Made with soft and nylon bristles, the Mediplus Toothbrush is gentle on the gums. The bristles are also angled to reach all surfaces of the teeth, including the back teeth. The Mediplus Toothbrush has a comfortable handle that makes it easy to grip.'),
(9, 'Listacare Gold 120ml Mouthwash', 'General Pharmaceuticals Ltd.', 'dental_care', 'Menthol + Thymol + Eucalyptol + Methyl Salicylate', 'listacare.png', 10, 89, 'Each 100 ml mouthwash contains- Menthol 0.042 gm (0.042%) Thymol 0.064 gm (0.064%) Eucalyptol 0.092 gm (0.092%) Methyl Salicylate 0.060 gm (0.060%)'),
(10, 'Whisper Ultra Clean Sanitary Pads', 'Whisper', 'Womens_Care', 'Cotton, Gel', 'whisper_ultra_clean.png', 50, 200, 'Whisper Ultra Clean provides superior protection with its gel-based core and odor lock technology. Ideal for heavy flow days.'),
(11, 'VWash Plus', 'Glenmark Pharmaceuticals', 'Womens_Care', 'Lactic Acid, Sea Buckthorn Oil', 'vwash_plus.png', 30, 350, 'VWash Plus is a daily intimate wash for women that helps maintain the natural pH balance and protects against infections.'),
(12, 'Senora Sanitary Napkins', 'Square Toiletries Ltd.', 'Womens_Care', 'Cotton, Super Absorbent Polymer', 'senora_sanitary_napkins.png', 71, 180, 'Senora Sanitary Napkins offer maximum comfort with their soft cotton cover and super absorbent core. Suitable for day and night use.'),
(13, 'Fem Fairness Naturals Gold Bleach', 'Dabur', 'Womens_Care', 'Aloe Vera, Vitamin E, Gold Dust', 'fem_gold_bleach.png', 40, 220, 'Fem Fairness Naturals Gold Bleach provides instant fairness and glowing skin. It is gentle on the skin and ideal for women.'),
(14, 'Pampers Premium Care Diapers', 'Pampers', 'babycare', 'Cotton, Aloe Vera', 'pampers_premium_care.png', 40, 600, 'Pampers Premium Care Diapers are designed to provide the best comfort and protection for your baby with 5-star skin protection and a breathable cover.'),
(15, 'Johnson\'s Baby Shampoo', 'Johnson & Johnson', 'babycare', 'No Tears Formula, Natural Extracts', 'johnsons_baby_shampoo.png', 79, 150, 'Johnson\'s Baby Shampoo is gentle on the baby\'s eyes and cleanses the hair effectively. It is hypoallergenic and free from harmful chemicals.'),
(16, 'Huggies Baby Wipes', 'Huggies', 'babycare', 'Aloe Vera, Vitamin E', 'huggies_baby_wipes.png', 100, 120, 'Huggies Baby Wipes are soft, gentle, and ideal for cleaning your baby\'s delicate skin. They are enriched with Aloe Vera and Vitamin E to prevent rashes.'),
(17, 'Nestle Cerelac Wheat & Milk', 'Nestle', 'babycare', 'Wheat, Milk, Essential Vitamins', 'nestle_cerelac.png', 49, 400, 'Nestle Cerelac Wheat & Milk is a nutritious and delicious complementary food for babies from 6 months onwards. It is fortified with essential vitamins and minerals.'),
(18, 'Sebamed Baby Lotion', 'Sebamed', 'babycare', 'Chamomile Extract, Allantoin', 'sebamed_baby_lotion.png', 35, 700, 'Sebamed Baby Lotion soothes and moisturizes your baby\'s skin with its gentle, pH-balanced formula. It is dermatologically tested for sensitive skin.'),
(19, 'Durex Extra Safe Condoms', 'Durex', 'Sexual_wellness', 'Latex', 'durex_extra_safe.png', 100, 180, 'Durex Extra Safe Condoms are designed for extra confidence with a slightly thicker material while still providing high sensitivity. Pre-lubricated for ease of use.'),
(20, 'KY Jelly Personal Lubricant', 'Johnson & Johnson', 'Sexual_wellness', 'Water-based', 'ky_jelly.png', 60, 200, 'KY Jelly is a water-based personal lubricant that is gentle, safe, and effective for enhancing comfort during sexual activity. It is non-greasy and easy to wash off.'),
(21, 'Durex Play Massage 2-in-1 Gel', 'Durex', 'Sexual_wellness', 'Water-based, Aloe Vera', 'durex_play_massage_gel.png', 50, 350, 'Durex Play Massage 2-in-1 Gel doubles as a soothing massage gel and a lubricant. It is enriched with Aloe Vera for a gentle and sensual experience.'),
(22, 'Moods All-Night Condoms', 'Moods', 'Sexual_wellness', 'Latex, Benzocaine', 'moods_all_night.png', 100, 170, 'Moods All-Night Condoms are designed with a special lubricant containing Benzocaine that helps delay climax for longer-lasting pleasure.'),
(23, 'Pregnacare Conception Vitamins', 'Vitabiotics', 'Sexual_wellness', 'Folic Acid, Vitamins, Minerals', 'pregnacare_conception.png', 40, 800, 'Pregnacare Conception is specially formulated for women who are trying to conceive. It contains essential vitamins and minerals to support reproductive health.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `user_fname` varchar(25) NOT NULL,
  `user_lname` varchar(25) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_address` text NOT NULL,
  `user_prescription` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_password`, `user_address`, `user_prescription`) VALUES
(1, 'Rahim', 'Ahmed', 'rahim.ahmed@example.com', 'password123', 'Dhanmondi, Dhaka', NULL),
(2, 'Karim', 'Hossain', 'karim.hossain@example.com', 'pass456', 'Uttara, Dhaka', NULL),
(3, 'Jasim', 'Uddin', 'jasim.uddin@example.com', 'pass789', 'Mirpur, Dhaka', NULL),
(11, 'life', 'less', 'life@gmail.com', 'meow', 'idk,idk', NULL),
(12, 'kill', 'me', 'killmenow@gmail.com', 'death', 'graveward', 'C:xampphtdocsM&M PharmacyPrescriptionsNecc documents(3)_6.jpg'),
(9998, 'Muntasir', 'Mamun', 'mamun.admin@gmail.com', 'admin', 'Badda', NULL),
(9999, 'Mahir', 'Khan', 'khan.admin@gmail.com', 'admin', 'Mirpur-2', NULL),
(10000, 'Sumaiya', 'Muntasir', 'saba@gmail.com', 'saba', 'Ashulia,Dhaka', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `browses`
--
ALTER TABLE `browses`
  ADD PRIMARY KEY (`order_id`,`pdt_id`),
  ADD KEY `order_id` (`order_id`,`pdt_id`),
  ADD KEY `pdt_id` (`pdt_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `manage`
--
ALTER TABLE `manage`
  ADD PRIMARY KEY (`pdt_id`,`order_id`,`admin_id`),
  ADD KEY `pdt_id` (`pdt_id`,`order_id`,`admin_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pdt_id` (`pdt_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pdt_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pdt_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `browses`
--
ALTER TABLE `browses`
  ADD CONSTRAINT `browses_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `browses_ibfk_2` FOREIGN KEY (`pdt_id`) REFERENCES `product` (`pdt_id`);

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `manage`
--
ALTER TABLE `manage`
  ADD CONSTRAINT `manage_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `manage_ibfk_2` FOREIGN KEY (`pdt_id`) REFERENCES `product` (`pdt_id`),
  ADD CONSTRAINT `manage_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`pdt_id`) REFERENCES `product` (`pdt_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
