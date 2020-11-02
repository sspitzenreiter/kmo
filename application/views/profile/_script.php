<script type="text/javascript">

var base_url = '<?php echo base_url();?>';

$(document).ready(function() {
    
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

});

function edit_profile($id){

    // var id = <?= $this->session->userdata('id')?>;
    
    $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled',false); //set button enable 
    $.ajax({
        
                    url : "<?php echo site_url('profile/ajax_edit/')?>/" + $id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('[name="id"]').val(data.id);
                        $('[name="nisn"]').val(data.nisn);                        
                        $('[name="fullname"]').val(data.fullname);
                        $('[name="gender"]').val(data.gender);
                        $('[name="school"]').val(data.school);
                        $('[name="address"]').val(data.address);
                        $('[name="email"]').val(data.email);
                        $('[name="phoneNumber"]').val(data.phoneNumber);
                        $('[name="dateOfBirth"]').datepicker('update',data.dateOfBirth);
                        
                        
                        $('#modal_profile').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Profile'); // Set title to Bootstrap modal title
                        $('#photo-preview').show(); // show photo preview modal
 
                        if(data.photo)
                        {
                            $('#label-photo').text('Change Photo'); // label photo upload
                            $('#photo-preview div').html('<img src="'+base_url+'public/photo/'+data.photo+'" class="img-responsive">'); // show photo
                            $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Remove photo when saving'); // remove photo
            
                        }
                        else
                        {
                            $('#label-photo').text('Upload Photo'); // label photo upload
                            $('#photo-preview div').text('(No photo)');
                        }
            
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
}
            function save()
            {
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;

                url = "<?php echo site_url('profile/ajax_update')?>";
                
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
                            $('#modal_profile').modal('hide');
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
</script> 
