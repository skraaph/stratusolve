SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `task6db`
-- Table structure for table `person`

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `Surname` varchar(40) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Age` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`DateOfBirth`,curdate())) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Indexes for table `person`

ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);
  
-- AUTO_INCREMENT for table `person`

ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;