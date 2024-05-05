<?php
session_start();
// Establish database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'db';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password_1 = $_POST['password'];

    // Prepare and execute the SQL statement using prepared statements
    $sql = "INSERT INTO users (username, email, password_1) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password_1);
        
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "New record created successfully";
            header('Location: public.html'); // Redirect after successful signup
            exit();
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt); // Close the prepared statement
}

if (isset($_POST['login'])) {
    // Receive input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    // Form validation
    if (empty($email)) { 
      array_push($errors, "Email is required"); 
    }
    if (empty($password)) { 
      array_push($errors, "Password is required"); 
    }
  
    // If no errors, log user in
    if (count($errors) == 0) {
      $query = "SELECT * FROM users WHERE email='$email'";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($results) == 1) {
        $user = mysqli_fetch_assoc($results);
        if (password_verify($password_1, $user['password'])) {
          $_SESSION['email'] = $email;
          $_SESSION['success'] = "You are now logged in";
          header('location: public.html');
        } else {
          array_push($errors, "Wrong email/password combination");
        }
      } else {
        array_push($errors, "No user found with that email");
      }
    }
  }

mysqli_close($conn);
