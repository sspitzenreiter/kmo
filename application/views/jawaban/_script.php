<script type="text/javascript">

var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';

$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('jawaban/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
        ],
 
    });
 
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
 
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
            

            function edit_jawaban(id)
            {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string

                //Ajax Load data from ajax
                $.ajax({
                    url : "<?php echo site_url('jawaban/ajax_edit/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $('[name="id"]').val(data.id);
                        $('[name="userid"]').val(data.fullname);
                        $('[name="examid"]').val(data.examtitle);
                        $('[name="score"]').val(data.score);
                        $('[name="collecttime"]').val(data.collecttime);
                        $('[name="resultstatus"]').val(data.resultstatus);
                        
                        $('#modal_jawaban').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit jawaban'); // Set title to Bootstrap modal title
              
 
                        if(data.filepath)
                        {
                            $('#jawaban div').html('<input class="form-control mb-2" type="text" value="'+data.filepath+'" disabled/>'); // show photo
                            $('#jawaban div').append('<a class="btn btn-sm btn-success" href="'+base_url+'public/jawaban/'+data.filepath+'" target="_blank" >View</a> '); 
            
                        }
                        else
                        {
                            $('#jawaban div').text('(No file)');
                        }
            
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }

            function reload_table()
            {
                table.ajax.reload(null,false); //reload datatable ajax 
            }

            function save()
            {
                $('#btnSave').text('saving...'); //change button text
                $('#btnSave').attr('disabled',true); //set button disable 
                var url;

                url = "<?php echo site_url('jawaban/ajax_update')?>";
                
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
                            $('#modal_jawaban').modal('hide');
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