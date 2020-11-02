
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_jawaban" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Jawaban Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                         <div class="form-group row">
                            <label class="control-label col-md-3">Peserta</label>
                            <div class="col-md-9">
                                <input name="userid" class="form-control" type="text" disabled>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Ujian</label>
                            <div class="col-md-9">
                                <input name="examid" class="form-control" type="text" disabled>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Waktu pengumpulan</label>
                            <div class="col-md-9">
                                <input name="collecttime" class="form-control" type="text" disabled>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row" id="jawaban">
                            <label class="control-label col-md-3">Hasil ujian</label>
                            <div class="col-md-9">
                                (No File)
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nilai</label>
                            <div class="col-md-9">
                                <input name="score" class="form-control" type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>                   
                        <div class="form-group row" id="status">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="resultstatus" class="form-control">
                                    <option value="">--Select status--</option>
                                    <option value="checked">Checked</option>
                                    <option value="unchecked">Unchecked</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->