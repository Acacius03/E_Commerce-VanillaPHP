<?php 
    session_start();
    if (isset($_SESSION['admin']) || isset($_SESSION['customer'])){
        header('Location: /Site1/');
    }
?>
<?php include 'register.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
    <link rel="stylesheet" href="../default.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="./validation.js" defer></script>
</head>
<body>
    <div class="main-container">
        <section class="section left-section">
            <img src="loginLogo.jpg" alt="" />
        </section>
        <section class="section right-section">
            <div action="" class="form-container">
                <h1>Signup</h1>
                <p>Hello There! Create an account and join Us!.</p>

                <form method="POST" id="signup-form" novalidate>
                    <div class="main-form">
                        <div class="input-field" >
                            <label class="label" for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" autocomplete='off'>
                        </div>
                        <div class="input-field" >
                            <label class="label" for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" autocomplete='off'>
                        </div>
                        <div class="input-field" >
                            <label class="label" for="email">Email</label>
                            <input type="email" id="email" name="email" autocomplete='off'>
                        </div>
                        <div class="input-field" >
                            <label class="label" for="password">Password</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <div class="input-field" >
                            <label class="label" for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    <input id="loginBtn" type="submit" name="submit" value="Submit">
                </form>
                

                <div class="signup">
                    <span>Already have an account? </span><a href="../login/">Login</a>
                </div>
            </div>
        </section>
    </div>
    
</body>
</html>