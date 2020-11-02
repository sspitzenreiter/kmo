
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_soal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Soal Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                         <div class="form-group row">
                            <label class="control-label col-md-3">Judul Ujian</label>
                            <div class="col-md-9">
                                <input name="examtitle" placeholder="Nama / judul ujian" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3" id="label-photo">Upload Soal</label>
                            <div class="col-md-9">
                                <input name="filepath" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Tanggal Ujian</label>
                            <div class="col-md-9">
                                <input name="examdate" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Start Time</label>
                            <div class="col-md-9">
                                <input name="starttime" placeholder="" class="form-control" type="time">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">End Time</label>
                            <div class="col-md-9">
                                <input name="endtime" placeholder="" class="form-control" type="time">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 ">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" placeholder="Deskripsi .. " class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group row" id="status">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="examstatus" class="form-control">
                                    <option value="">--Select status--</option>
                                    <option value="queue">Queue</option>
                                    <option value="onprogress">On Progress</option>
                                    <option value="succsess">Succsess</option>
                                    <option value="failed">Failed</option>
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