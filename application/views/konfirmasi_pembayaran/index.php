<?php $this->load->view('templates/header_peserta'); ?>
<div class="container bootstrap snippets bootdey">
    <div class="row well">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked well">
                <li><a href="<?= site_url('dashboard_peserta');?>?>"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;Home</a></li>
                <li><a href="<?= site_url('lomba');?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
                <li class="active"><a href="<?= site_url('konfirmasi_pembayaran');?>"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Pembayaran</a></li>
                <li><a href="<?= site_url('lomba');?>"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;&nbsp;Lomba</a></li>
            </ul>
        </div>
        <!-- <div class="col-md-1"></div> -->
        <div class="col-md-9">
            <!-- <div class="panel panel-default">    -->
            <?php 
                if($confirm_payment == NULL){
                 ?>
                <div class="panel-heading title">Konfirmasi pembayaran</div>
                <div class="panel-body"> 
                    
                    <form action="#" id="form">
                        
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nama akun</label>
                            <div class="col-md-9">
                                <input name="accountname" placeholder="Nama akun" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">No Rekening</label>
                            <div class="col-md-9">
                                <input name="accountno" placeholder="No Rekening" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Bank</label>
                            <div class="col-md-9">
                                <input name="bank" placeholder="Bank" class="form-control"type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row" id="photo-preview">
                            <label class="control-label col-md-3">Slip Pembayaran</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3" id="label-photo">Upload Slip</label>
                            <div class="col-md-9">
                                <input name="paymentslip" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <input type ="hidden" name="paymentstatus" value="Unconfirmed">
                        <input type="hidden" value="<?= $this->session->userdata('id');?>" name="userid"/> 
                        
                        <div class="form-group row">
                            <div class="col-sm-12 text-right" >
                                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Konfirmasi</button>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
            <?php } else {?>
                <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-3">
                                <label>Peserta</label>
                            </div>
                            <div class="col-md-9">
                                <p><?= $confirm_payment->fullname ?></p>
                            </div>
                            <div class="col-md-3">
                                <label>Atas nama</label>
                            </div>
                            <div class="col-md-9">
                                <p><?= ($confirm_payment->accountname==NULL)? "-" : $confirm_payment->accountname ?></p>
                            </div>
                            <!-- <div class="col-md-6">
                                <label>No Rekening</label>
                            </div>
                            <div class="col-md-6">
                                <p $confirm_payment->norekening ?></p>
                            </div> -->
                            <div class="col-md-3">
                                <label>Bank</label>
                            </div>
                            <div class="col-md-9">
                                <p><?= ($confirm_payment->bank==NULL)? "-" : $confirm_payment->bank ?></p>
                            </div>
                            <div class="col-md-3">
                                <label>Status Pembayaran</label>
                            </div>
                            <div class="col-md-9">
                                <p><?= $confirm_payment->paymentstatus ?></p>
                            </div>
                            <div class="col-md-3">
                                <label>Slip pembayaran</label>
                            </div>
                            <div class="col-md-9">
                                <?php base_url().'public/payment_slip/'.$confirm_payment->paymentslip; ?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {
 
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
});
            function add_pembayaran()
            {
                save_method = 'add';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                
                $('#photo-preview').hide(); // hide photo preview modal
 
                $('#label-photo').text('Upload Slip'); // label photo upload
            }


            function save()
            {
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;
                
                url = "<?php echo site_url('konfirmasi_pembayaran/ajax_add')?>";
                
                var formData = new FormData($('#form')[0]);
                $.ajax({
                    url : url,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(data)
                    {
            
                        if(data.status) //if success close modal and reload ajax table
                        {
                            $('#btnSave').text('save'); //change button text
                            reload_table();
                        }
                        else
                        {
                            for (var i = 0; i < data.inputerror.length; i++) 
                            {
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                            }
                        }
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 
            
            
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 
            
                    }
                });
            }

        </script>|       
<?php 
// $this->load->view("konfirmasi_pembayaran/_script");
$this->load->view("templates/footer_peserta"); ?>