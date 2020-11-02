<?php $this->load->view('templates/header_peserta'); ?>

<div class="container bootstrap snippets bootdey">
    <div class="row well">
        <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked well">
            <li><a href="<?= site_url('dashboard_peserta');?>?>"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;Home</a></li>
            <li class="active"><a href="<?= site_url('profile');?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
            <li><a href="<?= site_url('Konfirmasi_Pembayaran');?>"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Pembayaran</a></li>
            <li ><a href="<?= site_url('lomba');?>"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;&nbsp;Lomba</a></li>
        </ul>
        </div>
        
        <div class="col-md-9 emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                        <?php
                            $foto = $peserta->photo; 
                            if (!empty($peserta->photo)){
                                $foto = base_url().'/public/photo/'.$peserta->photo;
                                
                            } else{
                                $foto = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog";
                            }
                        ?>
                            <img src="<?= $foto ?>"  alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h3>Profile Peserta</h3>
                            <h6>Peserta Kompetisi Matematika Online HIMAMPTIKA</h6>
                            <hr>
                        </div>
                        <div class="row">
                                            <div class="col-md-6">
                                                <label>NISN</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $peserta->nisn; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nama Lengkap</label>
                                            </div>
                                            <div class="col-md-6">
                                            <p><?= (!empty($peserta->fullname)) ? $peserta->fullname : "-" ; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Alamat Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $peserta->email; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>No HP</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= (!empty($peserta->phoneNumber)) ? $peserta->phoneNumber : "-" ; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Jenis kelamin</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= (!empty($peserta->gender)) ? $peserta->gender : "-" ; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Sekolah</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= (!empty($peserta->school)) ? $peserta->school : "-" ; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= (!empty($peserta->address)) ? $peserta->address : "-" ; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tanggal lahir</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= (!empty($peserta->dateOfBirth)) ? $peserta->dateOfBirth : "-" ; ?></p>
                                            </div>
                                        </div>
                 
                    </div>
                    <div class="col-md-2">
                        <?php  
                            if($payment != NULL ){
                                if( $payment->paymentstatus == "Confirmed"){ ?>
                            <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Edit" onclick="edit_profile(<?=$peserta->id;?>)" ><i class="fa fa-edit"></i> Edit</a>        
                        <?php } }else{ ?>
                            
                                <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Pembayaran belum terkonfimasi" onclick="edit_profile(<?=$peserta->id;?>)"  disabled><i class="fa fa-edit"></i> Edit</a>
                        <?php  } ?>
                    </div>
                </div>     
            </form>           
        
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>./assets/jquery/jquery-3.5.1.min.js"></script>
<?php
    $this->load->view("profile/_form");
    $this->load->view("profile/_script");
    
    $this->load->view("templates/footer_peserta");
?>