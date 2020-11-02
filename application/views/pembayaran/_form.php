
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_pembayaran" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Payment Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="control-label col-md-3">Peserta</label>
                            <div class="col-md-9">
                                <input name="userid" placeholder="Peserta" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nama akun</label>
                            <div class="col-md-9">
                                <input name="accountname" placeholder="Nama akun" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="control-label col-md-3">Gender</label>
                            <div class="col-md-9">
                                <select name="gender" class="form-control">
                                    <option value="">--Select Gender--</option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div> -->
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
                        <div class="form-group row">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="paymentstatus" class="form-control">
                                    <option value="">--Select Status--</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="UnconfirmedP">Unconfirmed</option>
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