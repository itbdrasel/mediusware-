
<!-- Modal -->
<style type="text/css">
    .alert{ padding:6px 10px; margin-top:10px}
    .alert-warning{display:none;}
    .alert-success{display:none;}
</style>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="m-0" style="margin: 0 !important; font-size: 19px; font-weight: bold" ><i class="fa fa-trash"></i> Delete </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning" role="alert">&nbsp;</div>
                <div class="alert alert-success" role="alert">&nbsp;</div>
                <div class="fbody">
                    <input type="hidden" name="id" id="deleteId" value="" >
                    <input type="hidden" id="deleteUrl" value="" >
                    <div class="form-group" >
                        <label class="col-sm-7 control-label" >Are you sure you want to permanently delete this item?  </label>
                        <div class='col-sm-5'>
                            <button type="submit" id="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Yes, Delete This</button>&nbsp;&nbsp;
                            &nbsp;<a class="btn btn-default" data-bs-dismiss="modal"><i class="fas fa-long-arrow-left"></i> <i class="fas fa-arrow-left"></i> No, Go Back </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
