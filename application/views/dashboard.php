<?php $this->load->view("templates/header");?>
<style>

.panel {
  box-shadow: 0 2px 0 rgba(0,0,0,0.05);
  border-radius: 0;
  border: 0;
  margin-bottom: 24px;
}

.panel-dark.panel-colorful {
  background-color: #3b4146;
  border-color: #3b4146;
  color: #fff !important;
}

.panel-danger.panel-colorful {
  background-color: #f76c51;
  border-color: #f76c51;
  color: #fff !important;
}

.panel-primary.panel-colorful {
  background-color: #5fa2dd;
  border-color: #5fa2dd;
  color: #fff  !important;
}

.panel-info.panel-colorful {
  background-color: #4ebcda;
  border-color: #4ebcda;
  color: #fff !important;
}

.panel-body {
  padding: 25px 20px;
}

.panel hr {
  border-color: rgba(0,0,0,0.1);
}

.mar-btm {
  margin-bottom: 15px;
}

h2, .h2 {
  font-size: 28px;
}
p{
    color : #fff !important;
}
.small, small {
  font-size: 85%;
}

.text-sm {
  font-size: .9em;
}

.text-thin {
  font-weight: 300;
}

.text-semibold {
  font-weight: 600;
}
</style>
<body>
       <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= site_url('dashboard');?>"><i class="menu-icon fa fa-laptop"></i>Dashboard </a></li>
                    <li><a href="<?= site_url('peserta');?>"><i class="menu-icon fa fa-group"></i>Peserta</a></li>
                    <li><a href="<?= site_url('pembayaran');?>"><i class="menu-icon fa fa-money"></i>Pembayaran</a></li>
                    <li><a href="<?= site_url('soal');?>"><i class="menu-icon fa fa-puzzle-piece"></i>Soal</a></li>
                    <li><a href="<?= site_url('jawaban');?>"><i class="menu-icon fa fa-id-badge"></i>Jawaban Peserta</a></li>
                    <li><a href="<?= site_url('pengumuman');?>"><i class="menu-icon fa fa-bullhorn"></i>Pengumuman</a></li>
                    <li><a href="<?= site_url('auth/signout');?>"><i class="menu-icon fa fa-sign-out"></i>Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>./assets/img/logo.png" alt="Logo">&nbsp;&nbsp;&nbsp;KMO</a>
                    <a class="navbar-brand hidden" href="#"><img src="<?php echo base_url(); ?>./assets/img/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?= "Selamat datang,".$this->session->userdata('fullname');?>&nbsp;&nbsp;&nbsp;<img class="user-avatar rounded-circle" src="<?php echo base_url(); ?>./assets/img/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="<?= site_url('auth/signout');?>"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        
        <div class="content">
            <div class="animated fadeIn">
            <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel panel-dark panel-colorful">
                <div class="panel-body text-center">
                	<p class="text-uppercase mar-btm text-sm">Panitia</p>
                	<i class="fa fa-users fa-5x"></i>
                	<hr>
                	<p class="h2 text-thin"><?= $panitia?></p>
                	<!-- <small><span class="text-semibold">7%</span> Higher than yesterday</small> -->
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<div class="panel panel-danger panel-colorful">
        		<div class="panel-body text-center">
        			<p class="text-uppercase mar-btm text-sm">Peserta</p>
        			<i class="fa fa-address-card-o fa-5x"></i>
        			<hr>
        			<p class="h2 text-thin"><?= $peserta?></p>
        			<!-- <small><span class="text-semibold"><i class="fa fa-unlock-alt fa-fw"></i> 154</span> Unapproved comments</small> -->
        		</div>
        	</div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<div class="panel panel-primary panel-colorful">
        		<div class="panel-body text-center">
        			<p class="text-uppercase mar-btm text-sm">Pembayaran</p>
        			<i class="fa fa-dollar fa-5x"></i>
        			<hr>
        			<p class="h2 text-thin"><?= $pembayaran ?></p>
        			<!-- <small><span class="text-semibold"><i class="fa fa-shopping-cart fa-fw"></i> 954</span> Sales in this month</small> -->
        		</div>
        	</div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        	<div class="panel panel-info panel-colorful">
        		<div class="panel-body text-center">
        			<p class="text-uppercase mar-btm text-sm">Hasil Lomba</p>
        			<i class="fa fa-file fa-5x"></i>
        			<hr>
        			<p class="h2 text-thin"><?= $jawaban ?></p>
        			<!-- <small><span class="text-semibold"><i class="fa fa-dollar fa-fw"></i> 22,675</span> Total Earning</small> -->
        		</div>
        	</div>
        </div>        
            </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    <?php
        $this->load->view("templates/footer");
    ?>
    
</body>
</html>