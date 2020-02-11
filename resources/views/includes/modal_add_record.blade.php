<div class="modal fade" id="add_record" tabindex="-1" role="dialog" aria-labelledby="add-records">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="add-records">Add record</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">

                            <select class="form-control customer" id="customer" name="customer" >
                                <option selected disabled >Select Customer</option>
                                @if(!empty($customers))
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                @endif

                            </select>
                            <input type="hidden" name="customer_id" id="customer_id">
                            <span id="error_customer" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4" >
                            <input type="number" id="bags" name="bags" class="form-control" placeholder="No. of Bags">
                            <span id="error_bags" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4" >
                            <input type="number" id="damages" name="damages" class="form-control" placeholder="No. of damages">
                            <span id="error_damages" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4" >
                            <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount Paid">
                            <span id="error_amounts" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-8" >
                            <textarea name="descriptions" id="descriptions" cols="30" rows="4" class="form-control" placeholder="Comments"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer ">
                    <div>
                        <input type="hidden" name="row_id" id="hidden_row_id">
                        <input type="button" class="btn btn-primary btn-sm add-record"
                               {{--                               name="token" data-token="{{\App\Classes\CSRFToken::_token()}}" --}}
                               value="Add">

                        <a class="btn btn-default btn-sm" data-dismiss="modal" role="button" href={{"/customers"}} >
                            <span aria-hidden="true">Close</span>
                        </a>


                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
