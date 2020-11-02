<?php $this->load->view('templates/header_peserta'); ?>
<div class="container bootstrap snippets bootdey">
    <div class="row well">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked well">
                <li><a href="<?= site_url('dashboard_peserta');?>?>"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;Home</a></li>
                <li><a href="<?= site_url('profile');?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
                <li><a href="<?= site_url('konfirmasi_pembayaran');?>"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Pembayaran</a></li>
                <li class="active"><a href="<?= site_url('lomba');?>"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;&nbsp;Lomba</a></li>
            </ul>
        </div>
        <div class="col-md-9 ">
            
            <div class="title">
                <?= $soal->examtitle; ?>
            </div>
            <ul class="nav nav-tabs" id="myTab" >
                <li class="nav-item active">
                    <a class="" data-toggle="tab" href="#soal">Soal</a>
                </li>
                <li class="nav-item">
                    <a class="" data-toggle="tab" href="#submission">Submission</a>
                </li>
            </ul>
            <div class="tab-content"> 
                <div class="tab-pane active" id="soal">
                    <div class="panel panel-default" style="margin-top:20px;    ">
                        <div class="panel-body">
                            <p><?= $soal->description; ?></p>
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <a class="btn btn-sm btn-success" href="<?= base_url().'index.php/lomba/ajax_download/'.$soal->id;?>"><i class="fa fa-download"></i> Download soal</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" style="margin-top:20px;">
                        <div class="panel-body">
                            <div><b>Available from&nbsp;&nbsp;&nbsp;</b> <?=$soal->examdate.', '. $soal->starttime.' s.d '.$soal->endtime.' WIB'; ?></div> 
                        </div>
                    </div>
                </div>     
                <div class="tab-pane" id="submission">
                    <?php if( $jawaban['filepath'] == NULL){; ?>
                    <div class="panel panel-defaultt" id="panel-submit" style="margin-top:20px;">
                        <div class="panel-body">
                            <form action="#" id="form" class="form-horizontal">
                                <div class="col-md-12" style="margin-bottom:20px;"><b>Upload jawaban</b></div>  
                                <input type="hidden" name="userid" value="<?= $this->session->userdata('id'); ?>">
                                <input type="hidden" name="examid" value="<?= $soal->id; ?>">
                                <div class="col-md-10">
                                    <input id="files" type="file" name="filepath">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" id="btnSave" onclick="save()" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>  
                    </div>
                    <?php }else{ ?>
                    <div class="panel panel-default" id="panel-show"  style="margin-top:20px;">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <label>User Id</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $jawaban->fullname ?></p>
                            </div>
                            <div class="col-md-6">
                                <label>Filepath</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $jawaban->filepath ?></p>
                            </div>
                            <div class="col-md-6">
                                <label>Waktu Pengumpulan</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $jawaban->collecttime ?></p>
                            </div>      
                            <div class="col-md-6">
                                <label>Status</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $jawaban->resultstatus ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function save()
            {
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;

                url = "<?php echo site_url('lomba/ajax_add')?>";
                
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
                            // $('#btnSave').hide(); //change button text
                            // $('#files').hide();
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
</script>

<?php 
// $this->load->view("lomba/_script");
$this->load->view("templates/footer_peserta"); ?>