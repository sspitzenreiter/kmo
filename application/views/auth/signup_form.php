<?php
  $this->load->view('templates/header.php');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>./assets/css/style.css">
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center mb-5">Sign Up to KMO</h5>
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
            <form class="form-signin" action="<?= site_url('auth/register');?>" method="POST" >
              <div class="form-label-group">
                <input type="text" id="inputNama" name ="fullname" class="form-control" placeholder="Nama Peserta" required >
                <label for="inputNama">Nama Peserta</label>
              </div>
              <div class="form-label-group">
                <input type="email" id="inputEmail"name="email" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>
              <fieldset class="form-group pl-4">
              <legend class="col-form-label pb-0">Jenis Kelamin</legend><br>
                  <div class="row pl-3">
                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="radio" name="gender" id="inputGenderPerempuan" value="P" checked>
                    <label class="form-check-label" for="inputGender">
                      Perempuan
                    </label>
                  </div>
                  <div class="form-check col-md-6">
                    <input class="form-check-input" type="radio" name="gender" id="inputGenderLakiLaki" value="L">
                    <label class="form-check-label" for="inputGender">
                      Laki Laki
                    </label>
                  </div>
                </div>
              </fieldset>
              <div class="form-label-group">
                <input type="text" id="inputNoHP" name="no_hp" class="form-control" placeholder="No Handphone" required >
                <label for="inputNoHP">No Handphone</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputPasswordSecond" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
                <label for="inputPasswordSecond">Konfirmasi Password</label>
              </div>
              <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-lg btn-primary signin-btn" type="submit">Sign Up</button>
              </div>
              </form>
              <div class="text-center mt-5">
                <p class="pw">Already have an account ?</p>
                <p class="uppercase"><a href="<?= site_url('auth');?>">SIGN IN</a></p>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div> 
<?php
  $this->load->view('templates/footer.php');
?>