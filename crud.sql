CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `joining_date` date NOT NULL,
  PRIMARY KEY (`id`)
);

-- Dumping data for table `employees`
INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `age`, `gender`, `designation`, `joining_date`) VALUES
(9, 'Omar', 'El Khatib', 'omar.khatib@test.com', 29, 'Male', 'PHP Developer', '2022-09-24'),
(10, 'Youssef', 'Bennani', 'youssef.bennani@test.com', 31, 'Male', 'UI Designer', '2022-08-06'),
(11, 'Hassan', 'El Amrani', 'hassan.amrani@test.com', 34, 'Male', 'Android Developer', '2022-11-04'),
(12, 'Fatima', 'Alaoui', 'fatima.alaoui@test.com', 26, 'Female', 'UI Designer', '2022-11-13'),
(13, 'Salma', 'El Idrissi', 'salma.idrissi@test.com', 28, 'Female', 'Android Developer', '2022-08-31'),
(14, 'Kenza', 'Boukili', 'kenza.boukili@test.com', 27, 'Female', 'Frontend Developer', '2022-05-29'),
(15, 'Anas', 'Mansouri', 'anas.mansouri@test.com', 34, 'Male', 'PHP Developer', '2022-11-12'),
(16, 'Nadia', 'Chakiri', 'nadia.chakiri@test.com', 31, 'Female', 'Frontend Developer', '2022-11-04'),
(17, 'Mehdi', 'Rachidi', 'mehdi.rachidi@test.com', 33, 'Male', 'Android Developer', '2022-09-10'),
(18, 'Samira', 'Toumi', 'samira.toumi@test.com', 37, 'Female', 'UI Designer', '2021-12-04');

-- AUTO_INCREMENT for table `employees`
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

COMMIT;
