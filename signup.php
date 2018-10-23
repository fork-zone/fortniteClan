<?php include('header.php');?>

<main class="container-fluid justify-content-center mt-2 mb-2 minh-72">
    <div class="row col-11 col-sm-7 m-auto justify-content-center">
        <form>
            <div class="form-group">
                <label>Choose a Username</label>
                <i class="fas fa-user" style="left: -125px;"></i>
                <input type="text" class="form-control pl-4" />
                <small class="form-text text-muted">This will be the alias that is associated with your account.</small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <i class="fas fa-unlock-alt"></i>
                <input type="password" class="form-control pl-4" />
                <small class="form-text text-muted">Select a password that you will not forget!</small>
                
                
            </div>
            <div class="form-group">
                <label>Verify Password</label>
                <i class="fas fa-unlock-alt" style="left: -95px;"></i>
                <input type="password" class="form-control pl-4" />
                <small class="form-text text-muted">Type your password again so we know you got it right!</small>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <i class="fas fa-envelope" style="left: -85px;"></i>
                <input type="email" class="form-control pl-4" />
                <small class="form-text text-muted">Enter your Email Address. This will be useful if you forget your account details.</small>
            </div>
            <button class="btn btn-primary btn-lg">Sign Up!</button>
        </form>
    </div>
</main>

<?php include('footer.php');?>