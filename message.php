<?php  

include "./register/register/Connection.php";

if (isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validate form data
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>
                alert('All fields are required.');
                window.location.href = './index.html'; // Redirect back to the form
              </script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email format
        echo "<script>
                alert('Please enter a valid email address.');
                window.location.href = './index.html'; // Redirect back to the form
              </script>";
    } else {
        // Prepare and execute the query
        $query = "INSERT INTO `messages` (name, email, message) VALUES ('$name', '$email', '$message')";
        $run = $conn->query($query);

        if ($run) {
            // Data inserted successfully
            echo "<script>
                    alert('Your message has been sent successfully!');
                    window.location.href = './index.html'; // Redirect to your target page
                  </script>";
        } else {
            // Data insertion failed
            echo "<script>
                    alert('There was an error sending your message.');
                    window.location.href = './index.html'; // Redirect back to the form
                  </script>";
        }
    }
}
?>
