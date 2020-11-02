<?php $this->load->view('templates/header_peserta'); ?>
<style>
    .welcome_message{
        font-family: "Jost", sans-serif;
        font-size: 20px;
        color: #3a638d !important;
    }
    
</style>
<div class="container bootstrap snippets bootdey">
    <div class="row well">
        <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked well">
            <li class="active"><a href="<?= site_url('dashboard_peserta');?>?>"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;Home</a></li>
            <li><a href="<?= site_url('profile');?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
            <li ><a href="<?= site_url('konfirmasi_pembayaran');?>"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Pembayaran</a></li>
            <li><a href="<?= site_url('lomba');?>"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;&nbsp;Lomba</a></li>
        </ul>
        </div>
        <!-- <div class="col-md-9"></div> -->
        <div class="col-md-8">
        <div class="panel">
            <div class="panel-body welcome_message">
                <center><h1><b> Selamat !!! </b></h1></center>
                Anda telah terdaftar dalam KMO (Kompetisi Matematika Online) yang diselenggarakan oleh Himpunan Mahasiswa Pendidikan Matematika (HIMAPTIKA) IKIP Siliwangi.
                Segera lengkapi data diri anda pada kolom “Profile” dan lengkapi persyaratan selanjutnya sehingga anda dapat melanjutkan perlombaan.
                Selamat berjuang, Semangat Berkompetisi, dan Salam Matematika !
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view("templates/footer_peserta"); ?>