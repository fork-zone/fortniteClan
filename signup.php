<?php 
include('header.php');

if(isset($_POST['g-recaptcha-response'])) {
    // RECAPTCHA SETTINGS
    $captcha = $_POST['g-recaptcha-response'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
  
    // RECAPTCH RESPONSE
    $recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
    $data = json_decode($recaptcha_response);
  
    if(isset($data->success) &&  $data->success === true) {
        if (isset($_POST['username'])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        
            if (isset($row['username'])) {
                echo '<div class="alert alert-danger col-3 col-sm-11 m-auto">Username is not available.</div>';
            } else {
                $password1 = mysqli_real_escape_string($conn, md5($_POST['password1']));
                $password2 = mysqli_real_escape_string($conn, md5($_POST['password2']));
        
                if ($password1 != $password2) {
                        echo '<div class="alert alert-danger col-3 col-sm-11 m-auto">Passwords do not match.</div>';
                } else {
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $insert = "INSERT INTO users (username, password, email) VALUES ('$username', '$password1', '$email')";
                    $conn->query($insert);
                    echo '<div class="alert alert-success col-3 col-sm-11 m-auto">Account Successfully Created!</div>';
                }
            }
        }
    }
    else {
        echo '<div class="alert alert-danger col-5 m-auto">Failure to solve CAPTCHA.</div>';
    }
 }

?>

<main class="container-fluid justify-content-center mt-2 mb-2 minh-72">
    <div class="row col-11 col-sm-7 m-auto justify-content-center">
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label>Choose a Username</label>
                <i class="fas fa-user" style="left: -125px;"></i>
                <input type="text" name="username" class="form-control pl-4" />
                <small class="form-text text-muted">This will be the alias that is associated with your account.</small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <i class="fas fa-unlock-alt"></i>
                <input type="password" name="password1" class="form-control pl-4" />
                <small class="form-text text-muted">Select a password that you will not forget!</small>
                
                
            </div>
            <div class="form-group">
                <label>Verify Password</label>
                <i class="fas fa-unlock-alt" style="left: -95px;"></i>
                <input type="password" name="password2" class="form-control pl-4" />
                <small class="form-text text-muted">Type your password again so we know you got it right!</small>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <i class="fas fa-envelope" style="left: -85px;"></i>
                <input type="email" name="email" class="form-control pl-4" />
                <small class="form-text text-muted">Enter your Email Address. This will be useful if you forget your account details.</small>
            </div>
            <div class="form-group d-flex flex-column align-items-center" >
                <div class="g-recaptcha" data-sitekey="6Ld_H3cUAAAAAJYGGI2FNecamtLe7bYIR5Khcmj_"></div>
                <button type ="submit" class="btn btn-primary btn-lg mt-2">Sign Up!</button>
            </div>
            
        </form>
    </div>
</main>

<?php include('footer.php');?>