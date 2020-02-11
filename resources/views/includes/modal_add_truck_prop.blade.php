<div class="modal" id="truck_prop" tabindex="-1" role="dialog" aria-labelledby="truck-prop">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="truck-prop">Vehicle Diemsions</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-md-3" >
                            <input type="number" id="length" name="length" class="form-control" placeholder="Length">
                            <span id="error_length" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3" >
                            <input type="number" id="width" name="width" class="form-control" placeholder="Width">
                            <span id="error_width" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3" >
                            <input type="number" id="height" name="height" class="form-control" placeholder="Height">
                            <span id="error_height" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3" >
                            <input type="number" id="plus" name="plus" class="form-control" placeholder="Plus" value="0">
                            <span id="error_plus" class="text-danger"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div>
                    <input type="button" class="btn btn-primary btn-sm add-truck-prop"  value="Add">

                    <a class="btn btn-default btn-sm" data-dismiss="modal" role="button" href="" >
                        <span aria-hidden="true">Close</span>
                    </a>


                </div>
            </div>
        </div>
    </div>
</div>
