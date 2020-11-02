
<?php
  $this->load->view('templates/header.php');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>./assets/css/style.css">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center mb-5">Login to Your Account</h5>
            <?php
                $errors = $this->session->flashdata('errors');
                if(!empty($errors)){
                ?>
                <div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger text-center">
                        <?php foreach($errors as $key=>$error){ ?>
                        <?php echo "$error<br>"; ?>
                        <?php } ?>
                        
                    </div>
                    </div>
                </div>
            <?php } ?>
            <form class="form-signin" action ="<?= site_url('auth/login');?>" method ="POST">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name = "email" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name = "password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="row mt-3">
              <!-- <div class="col-md-7 custom-control custom-checkbox pw pl-5">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div> -->
              <div class="col-md-12 pl-5 pw">
                <p><a href="#">Forgot Password ?</a></p>
              </div>
              <!-- 09 -->
              </div>
              <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-lg btn-primary signin-btn" type="submit">Sign In</button>
              </div>
              </form>
              <div class="text-center mt-5">
                <p class="pw">Don't have account ?</p>
                <p class="uppercase"><a href="<?= site_url('auth/daftar');?>">SIGN UP</a></p>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
<?php
  $this->load->view('templates/footer.php');
?>