<?php include('server1.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website with Login & Registration Form</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  </head>
  <body>
  <header class="header" style="background-color:#555;">
    <nav class="nav">
        

        <ul class="nav_items">
            <li class="nav_item">
                <a href="#" class="nav_link">Home</a>
                <a href="#" class="nav_link">Blogs</a>
                <a href="contact.html" class="nav_link">Contact Us</a>
            </li>
        </ul>

        <button class="button" id="form-open" style="color: #ffffff;">Login/Signup</button>
    </nav>
</header>

    <section class="home" style="background-image: url(background.jpg);">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <div class="form login_form">
          <form action="#">
            <h2 style="color:white">Login</h2>

            <div class="input_box">
              <input type="email" placeholder="Enter your email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Enter your password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check" style="color:white;">Remember me</label>
              </span>
              <a href="#" class="forgot_pw" style="color:white;">Forgot password?</a>
            </div>

            <button class="button" href="legal.html">Login Now</button>

            <div class="login_signup" style="color:white;">Don't have an account? <a href="#" id="signup">Signup</a></div>
          </form>
        </div>
        <div class="form signup_form">
  <form action="server1.php" method="POST" id="signup-form">
    <h2>Signup</h2>
    <div class="input_box">
      <input type="text" name="name" placeholder="Enter your name" required />
      <i class="uil uil-user-circle user_icon"></i>
    </div>
    <div class="input_box">
      <input type="text" name="valid_id" placeholder="Enter your valid ID" required />
      <i class="uil uil-user id_icon"></i>
    </div>
    <div class="input_box">
      <input type="email" name="email" placeholder="Enter your email" required />
      <i class="uil uil-envelope-alt email"></i>
    </div>
    <div class="input_box">
      <input type="password" name="password" placeholder="Create password" required />
      <i class="uil uil-lock password"></i>
      <i class="uil uil-eye-slash pw_hide"></i>
    </div>
    <div class="input_box">
      <input type="password" name="confirm_password" placeholder="Confirm password" required />
      <i class="uil uil-lock password"></i>
      <i class="uil uil-eye-slash pw_hide"></i>
    </div>
    <button type="submit" class="button" name="signup">Signup Now</button>
    <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
  </form>
</div>

      </div>
    </section>

    <script src="script.js"></script>
  </body>
</html>
