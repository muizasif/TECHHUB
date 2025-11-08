<?php
include "./connection.php";

// Extracting all form field values

if (isset($_POST['submit'])) {
    $fullName = $_POST['c_name'];
    $fatherName = $_POST['f_name'];
    $cnic = $_POST['cnic'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $contactNumber = $_POST['c_number'];
    $alterContactNumber = $_POST['alter_c_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $firstPreference = $_POST['firstPreference'];
    $secondPreference = $_POST['secondPreference'];

    // Process file uploads
    $pic_upload = isset($_FILES['pic_upload']['tmp_name']) && is_uploaded_file($_FILES['pic_upload']['tmp_name']) ? file_get_contents($_FILES['pic_upload']['tmp_name']) : NULL;
    $cnic_upload = isset($_FILES['cnic_upload']['tmp_name']) && is_uploaded_file($_FILES['cnic_upload']['tmp_name']) ? file_get_contents($_FILES['cnic_upload']['tmp_name']) : NULL;

    $query2 = "SELECT * FROM full_stack_dev WHERE cnic='$cnic'";
    $result2 = mysqli_query($conn, $query2);

    if ($result2 == true) {
        if ($result2->num_rows > 0) {
            echo "<script>alert('CNIC already exists');</script>";
        } else {
            // Prepare the SQL query
            $sql = "INSERT INTO full_stack_dev (c_name, f_name, cnic, password, dob, c_number, alter_c_number, email, address, qualification, specialization, first_preference, second_preference, pic_upload, cnic_upload) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Prepare and bind the statement
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssssssss", $fullName, $fatherName, $cnic, $password, $dob, $contactNumber, $alterContactNumber, $email, $address, $qualification, $specialization, $firstPreference, $secondPreference, $pic_upload, $cnic_upload);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the statement
            $stmt->close();
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // echo "Form not submitted!";
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Hub Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="card mt-4 narrow-card">
            <div class="card-header">
                <h3 class="card-title mb-0">Tech Hub System <span id="city" style="font-size: 15px;">(Faisalabad)</span></h3>
                <h6>(03 Months Free Training Courses In Computer, Hi-Tech Field)</h6>
                <h6>Student Registration Form</h6>
                <h5>NATTC(PMSDP)</h5>
            </div>
            <div class="card-body">
                <form id="registrationForm" action="register.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="c_name">Candidate Name (According to CNIC)</label>
                            <input type="text" class="form-control rounded-input" id="c_name" name="c_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="f_name">Father Name</label>
                            <input type="text" class="form-control rounded-input" id="f_name" name="f_name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cnic">CNIC/B-Form (Without Dashes)</label>
                            <input type="text" class="form-control rounded-input" id="cnic" name="cnic" required>
                            <span class="error-message" id="cnicError"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="text" class="form-control rounded-input" id="password" name="password" required>
                            <span class="error-message" id="passwordError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control rounded-input" id="dob" name="dob" required>
                            <span class="error-message" id="dobError"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="c_number">Students Phone Number</label>
                            <input type="tel" class="form-control rounded-input" id="c_number" name="c_number" required>
                            <span class="error-message" id="contactNumberError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="alter_c_number">Alternative Phone Number</label>
                            <input type="tel" class="form-control rounded-input" id="alter_c_number" name="alter_c_number" required>
                            <span class="error-message" id="parentsContactNumberError"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-Mail</label>
                            <input type="email" class="form-control rounded-input" id="email" name="email" required>
                            <span class="error-message" id="emailError"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="domicile">Domicile</label>
                            <input type="text" class="form-control rounded-input" id="domicile" name="domicile">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Complete Address</label>
                            <input type="text" class="form-control rounded-input" id="address" name="address" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="qualification">Education</label>
                            <select class="form-control rounded-input" id="qualification" name="qualification" required>
                                <option value="">Select Qualification</option>
                                <option value="FA/FSc/ICS/I.Com">Intermediate</option>
                                <option value="BA/BSc/B.Com">Bachelor's</option>
                                <option value="BS/MSc/M.Com">Master's</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="specialization">Other Education</label>
                            <input type="text" class="form-control rounded-input" id="specialization" name="specialization">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstPreference">First Preference</label>
                            <select class="form-control rounded-input" id="firstPreference" name="firstPreference" required>
                               <option value="web"> web </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="secondPreference">Second Preference</label>
                            <select class="form-control rounded-input" id="secondPreference" name="secondPreference" required>
                            <option value="web"> web </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pic_upload">Upload Your Picture</label>
                            <input type="file" class="form-control-file" id="pic_upload" name="pic_upload">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cnic_upload">Upload Your CNIC</label>
                            <input type="file" class="form-control-file" id="cnic_upload" name="cnic_upload">
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            var cnic = document.getElementById('cnic').value;
            var dob = new Date(document.getElementById('dob').value);
            var age = calculateAge(dob);
            var contactNumber = document.getElementById('c_number').value;
            var parentsContactNumber = document.getElementById('alter_c_number').value;
            var email = document.getElementById('email').value;

            var cnicPattern = /^[0-9]{13}$/;
            var contactPattern = /^[0-9]{11}$/;
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            var cnicError = document.getElementById('cnicError');
            var dobError = document.getElementById('dobError');
            var contactNumberError = document.getElementById('contactNumberError');
            var parentsContactNumberError = document.getElementById('parentsContactNumberError');
            var emailError = document.getElementById('emailError');

            var isValid = true;

            if (!cnicPattern.test(cnic)) {
                cnicError.textContent = 'CNIC/B-Form must be a 13-digit numeric value.';
                isValid = false;
            } else {
                cnicError.textContent = '';
            }

            if (age < 18) {
                dobError.textContent = 'You must be at least 18 years old.';
                isValid = false;
            } else {
                dobError.textContent = '';
            }

            if (!contactPattern.test(contactNumber)) {
                contactNumberError.textContent = 'Contact Number must be an 11-digit numeric value.';
                isValid = false;
            } else {
                contactNumberError.textContent = '';
            }

            if (!contactPattern.test(parentsContactNumber)) {
                parentsContactNumberError.textContent = 'Parents Contact Number must be an 11-digit numeric value.';
                isValid = false;
            } else {
                parentsContactNumberError.textContent = '';
            }

            if (!emailPattern.test(email)) {
                emailError.textContent = 'Invalid email address.';
                isValid = false;
            } else {
                emailError.textContent = '';
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        function calculateAge(birthDate) {
            var currentDate = new Date();
            var age = currentDate.getFullYear() - birthDate.getFullYear();
            var m = currentDate.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && currentDate.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        window.onload = function() {
            var popup = window.open('', '_blank', 'width=700,height=700');
            if (popup) {
                popup.document.write('<html><head><title>Pop-up</title></head><body style="margin: 0; display: flex; justify-content: center; align-items: center;"><img src="popup.jpg" style="max-width: 100%; max-height: 100%;"></body></html>');
                setTimeout(function() {
                    popup.close();
                }, 5000);
            } else {
                alert('Pop-up blocked! Please allow pop-ups for this site to see the image.');
            }
        };

        function validateImageSize(input) {
            const file = input.files[0];
            const maxSize = 250 * 1024; // 250 KB
            if (file.size > maxSize) {
                alert('File size must be less than 250 KB');
                input.value = ''; // Clear the input field
                return false;
            }
            return true;
        }

        document.getElementById('pic_upload').addEventListener('change', function() {
            validateImageSize(this);
        });
        document.getElementById('cnic_upload').addEventListener('change', function() {
            validateImageSize(this);
        });
    </script>
</body>

</html>
