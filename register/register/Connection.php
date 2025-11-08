<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Tech_hub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
else{
    echo "Connected successfully";
}

//  $table = "
//  CREATE TABLE teachers (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     teacher_name VARCHAR(255) NOT NULL,
//     gender VARCHAR(10) NOT NULL,
//     teacher_address TEXT NOT NULL,
//     teacher_birthdate DATE NOT NULL,
//     marital_status VARCHAR(10) NOT NULL,
//     teacher_phone VARCHAR(15) NOT NULL,
//     teacher_email VARCHAR(255) NOT NULL,
//     teaching_experience VARCHAR(255),
//     teacher_education VARCHAR(255) NOT NULL
// );
 
//  ";

//    $run=$conn->query($table);

//     if($run==true){
//         echo "table is creared";
//     }

?>
 <!-- gender ENUM('Male', 'Female', 'Other') NOT NULL,
 experience TEXT,
    education TEXT,
    address VARCHAR(250) NOT NULL,
    birthdate DATE,
    marital_status ENUM('Single', 'Married', 'Divorced', 'Widowed'),
      
    phone VARCHAR(15), -->