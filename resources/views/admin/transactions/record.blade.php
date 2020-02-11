@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('page-header')
    <section class="content-header">
        <h1>
            Today's Records
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Transactions</a></li>
            <li class="active">Records</li>
        </ol>
        <hr style="border: solid 0.5px #a3a3a3">
    </section>
@endsection

@section('content')
    {{--Modal Section for Truck properties--}}

    <section class="content">
        <form action="{{route('record.store')}}" method="post" id="record_form">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-sm-12">
                    @include('includes.errors')

                    <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" id="employees" name="employee_driver">
                                        <option selected disabled value="">Select Driver</option>
                                        @if(!empty($employees))
                                            @foreach($employees as $employee)

                                                <option value="{{$employee->id}}">{{$employee->name}}</option>

                                            @endforeach
                                        @endif
                                    </select>
                                    <input type="hidden" id="employee_id" name="employee_id" value="">

                                    {{--Hidden: Truck dimenssions--}}
                                    <input type="hidden" name="lengths" id="lengths">
                                    <input type="hidden" name="heights" id="heights">
                                    <input type="hidden" name="widths" id="widths">
                                    <input type="hidden" name="pluses" id="pluses">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <button data-toggle="modal" data-target="#add_record" type="button" class="new_record btn btn-primary btn-sm" ><i class="fa fa-plus"> New Record</i></button>
                                <button type="button" data-toggle="modal" data-target="#truck_prop" class="truck_info btn btn-info btn-sm"><i class="fa fa-plus"> Truck's Prop.</i></button>
                            </div>

                        <div class="col-md-4 float-right" >
                            <label for="bags_remains" class="col-sm-7 control-label" style="text-align: right; vertical-align: text-bottom">Remaining Bags</label>
                            <div class="col-sm-5">
                                <input type="number" name="bags_remains" class="form-control" id="bags_remains" disabled value="0">
                            </div>

                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">A Trip Record</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>
                        </div>


                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="trip_record" class="table table-bordered table-striped">
                                        <tr>
                                            <th hidden>CustomerID</th>
                                            <th>Customer</th>
                                            <th>Bags</th>
                                            <th>Damages</th>
                                            <th>Amount Paid</th>
                                            <th>Description</th>
                                            <th></th>
                                            <th></th>
                                        </tr>


                                    </table>
                                </div>

                        </div>


                    </div>

                    <div class="text-center">
                        <button type="submit" id="submit_record" name="submit" class="btn btn-primary" >
                            <i class="fa fa-save"></i> Submit
                        </button>
                    </div>


                </div>
                <div class="col-lg-2"></div>
            </div>
        </form>

        <br>

        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-10 col-sm-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Today's record</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="record_list" class="table table-striped table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Driver</th>
                                    <th>Customer</th>
                                    <th>Bags</th>
                                    <th>Damages</th>
                                    <th>Amount Received</th>
                                    <th>Balance</th>
                                    <th>Time</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($bags)>0)
                                    @foreach($bags as $bag)
                                        <tr>
                                            <td>{{Auth::user()->name}}</td>
                                            <td>{{$bag->order->employee->name}}</td>
                                            <td>{{$bag->customer->name}}</td>
                                            <td>{{$bag->bags_sold}}</td>
                                            <td>{{$bag->damages}}</td>
                                            <td>{{$bag->amount_paid}}</td>
                                            <td>{{$bag->balance}}</td>
                                            <td>{{$bag->created_at->format('H:i A')}}</td>
                                            <td>{{$bag->description}}</td>


                                            {{--                                        <td><a href="{{route('customer.edit',['id'=>$customer->id])}}" class="btn btn-success btn-xs fa fa-edit text-success"> Edit</a></td>--}}
                                            {{--                                        <td><a href="{{route('customer.deactivate',['id'=>$customer->id])}}" class="btn btn-warning btn-xs fa fa-remove"> De-activate</a></td>--}}

                                        </tr>
                                    @endforeach
                                @else
                                    <td>
                                        No Customer added yet!
                                    </td>


                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-1"></div>
        </div>
    </section>




@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $('#record_list').DataTable()

        });


        $(document).ready(function() {
            $('.truck_info').hide();
            $('.new_record').hide();
            $('#submit_record').hide();

            var bags_remaining = parseFloat($('#bags_remains').val());
            var t_bags_remaining = [];
            var t_bags_remaining_new = [];
            var sum_bags = 0;
            var total_bags = 0;
            var fresh_record = false;
            var count = 0;

            $('#employees').on('change', function () {
                var selected_employee = $('#employees').val();
                if(selected_employee !== '')
                {
                    $('.truck_info').show();
                    fresh_record = true;
                }
            });

            $('.add-truck-prop').on('click', function () {

                var length = 0;
                var width = 0;
                var height = 0;
                var plus = 0;
                // var description = $('#descriptions').val();

                if ($('#length').val() == '')
                {
                    error_length = 'Length is required';
                    $('#error_length').text(error_length);
                    $('#length').css('border-color', '#cc0000');
                    length = '';

                }
                else
                {
                    error_length = '';
                    $('#error_length').text(error_length);
                    $('#length').css('border-color', '');
                    length = parseFloat($('#length').val());
                }

                if ($('#width').val() == '')
                {
                    error_width = 'Width is required';
                    $('#error_width').text(error_width);
                    $('#width').css('border-color', '#cc0000');
                    width = '';

                }
                else
                {
                    error_width = '';
                    $('#error_width').text(error_width);
                    $('#width').css('border-color', '');
                    width = parseFloat($('#width').val());
                }
                if ($('#height').val() == '')
                {
                    error_height = 'Height is required';
                    $('#error_height').text(error_height);
                    $('#height').css('border-color', '#cc0000');
                    height = '';

                }
                else
                {
                    error_height = '';
                    $('#error_height').text(error_height);
                    $('#height').css('border-color', '');
                    height = parseFloat($('#height').val());
                }
                if ($('#plus').val() == '')
                {
                    error_plus = 'Plus is required';
                    $('#error_plus').text(error_plus);
                    $('#plus').css('border-color', '#cc0000');
                    plus = '';

                }
                else
                {
                    error_plus = '';
                    $('#error_plus').text(error_plus);
                    $('#plus').css('border-color', '');
                    plus = parseFloat($('#plus').val());
                }
                if (error_length !=='' || error_width !== '' || error_height !== ''|| error_plus !== '')
                {
                    return false
                }else
                {
                    $('#lengths').val(length);
                    $('#widths').val(width);
                    $('#heights').val(height);
                    $('#pluses').val(plus);
                }


                bags_remaining = length * width * height +plus;
                total_bags =bags_remaining;
                $('#bags_remains').val(bags_remaining);

                if (bags_remaining > 0)
                {
                    $('.new_record').show();
                    $('#employees').attr("disabled", "disabled");

                }

                $('.modal#truck_prop').modal('toggle');

            });

            $('.add-record').click(function () {
                var customer = '';
                var customer_id = '';
                var bags = '';
                var damages = '';
                var amount = '';
                var descriptions = '';

                var error_customer = '';
                var error_bags = '';
                var error_damages = '';
                var error_amounts = '';

                $('.add-truck-prop').hide();

                if ($('select#customer').val() == null)
                {
                    error_customer = 'Customer is required, choose a Customer from the list';
                    $('#error_customer').text(error_customer);
                    $('select#customer').css('border-color', '#cc0000');
                    customer = '';

                }
                else
                {
                    error_customer = '';
                    $('#error_customer').text(error_customer);
                    $('select#customer').css('border-color', '');
                    customer = $('select#customer').val();
                }

                if ($('#bags').val() == '')
                {
                    error_bags = 'No. of bags is required.';
                    $('#error_bags').text(error_bags);
                    $('#bags').css('border-color', '#cc0000');
                    bags = '';

                }
                else
                {
                    error_bags = '';
                    $('#error_bags').text(error_bags);
                    $('#bags').css('border-color', '');
                    bags = $('#bags').val();
                }

                if ($('#damages').val() == '')
                {
                    error_damages = 'No. of damages is required.';
                    $('#error_damages').text(error_damages);
                    $('#damages').css('border-color', '#cc0000');
                    damages = '';

                }
                else
                {
                    error_damages = '';
                    $('#error_damages').text(error_damages);
                    $('#damages').css('border-color', '');
                    damages = $('#damages').val();
                }

                if ($('#amount').val() == '')
                {
                    error_amounts = 'Amount paid is required.';
                    $('#error_amounts').text(error_amounts);
                    $('#amount').css('border-color', '#cc0000');
                    amount = '';

                }
                else
                {
                    error_amounts = '';
                    $('#error_amounts').text(error_amounts);
                    $('#error_amounts').css('border-color', '');
                    amount = $('#amount').val();
                }

                customer_id = $('#customer_id').val();
                descriptions = $('#descriptions').val();



                if (error_customer !=='' || error_bags !== '' || error_damages !=='' || error_amounts !== '')
                {
                    return false
                }else
                {
                    if ($('.add-record').val() == 'Add')
                    { var i;
                        count = count +1;
                        console.log('row_'+count);
                        output = '<tr id="row_'+count+'">';
                        output += '<td hidden>'+customer+' <input type="hidden" name="hidden_customers[]" id="customer'+count+'" class="customer" value="'+customer+' "></td>';
                        output += '<td>'+customer_id+' <input type="hidden" name="hidden_customer_id[]" id="customer_id'+count+'" class="customer_id" value="'+customer_id+' "></td>';
                        output += '<td>'+bags+' <input type="hidden" name="hidden_bags[]" id="bags'+count+'" class="bags" value="'+bags +'"></td>';
                        output += '<td>'+damages+' <input type="hidden" name="hidden_damages[]" id="damages'+count+'" class="damages" value="'+damages +'"></td>';
                        output += '<td>'+amount+' <input type="hidden" name="hidden_amounts[]" id="amount'+count+'" class="amount" value="'+amount +'"></td>';
                        output += '<td>'+descriptions+' <input type="hidden" name="hidden_description[]" id="descriptions'+count+'" class="descriptions" value="'+descriptions +'"></td>';
                        // output += '<td>'+bags+' <input type="hidden" name="hidden_bags[]" id="bags'+count+'" class="bags" value="'+bags +'"></td>';
                        output += ' <td><button data-toggle="modal" data-target="#add_record" type="button" name="view_details" class="fa fa-edit btn btn-success btn-xs view_details" id="'+count+'"></button></td>';
                        output += '<td><button type="button" name="remove_details" class="fa fa-trash-o btn btn-danger btn-xs remove_details" id="'+count+'"></button></td>';
                        output += '</tr>';

                        sum_bags = (parseInt(bags) + parseInt(damages));
                        t_bags_remaining[count] = sum_bags;

                        t_bags_remaining = t_bags_remaining.map(Number);

                        //Sum the bags to get the total
                        bags_remaining = t_bags_remaining.reduce(function(a,b){  return a+b; },0);


                        $('#bags_remains').val(total_bags - bags_remaining);


                        $('#trip_record').append(output);
                    }
                    else
                    {

                        var row_id = $('#hidden_row_id').val();
                        output = '<td hidden>'+customer+' <input type="hidden" name="hidden_customer[]" id="customer'+row_id+'" class="customer" value="'+customer +'"></td>';
                        output += '<td>'+customer_id+' <input type="hidden" name="hidden_customer_id[]" id="customer_id'+count+'" class="customer_id" value="'+customer_id+' "></td>';
                        output += '<td>'+bags+' <input type="hidden" name="hidden_bags[]" id="bags'+row_id+'" class="bags" value="'+bags +'"></td>';
                        output += '<td>'+damages+' <input type="hidden" name="hidden_damages[]" id="damages'+row_id+'" class="damages" value="'+damages +'"></td>';
                        output += '<td>'+amount+' <input type="hidden" name="hidden_amounts[]" id="amount'+row_id+'" class="amount" value="'+amount +'"></td>';
                        output += '<td>'+descriptions+' <input type="hidden" name="hidden_description[]" id="descriptions'+row_id+'" class="descriptions" value="'+descriptions +'"></td>';
                        // output += '<td>'+bags+' <input type="hidden" name="hidden_bags[]" id="bags'+count+'" class="bags" value="'+bags +'"></td>';
                        output += ' <td><button data-toggle="modal" data-target="#add-record" type="button" name="view_details" class="fa fa-edit btn btn-success btn-xs view_details" id="'+row_id+'"></button></td>';
                        output += '<td><button type="button" name="remove_details" class="fa fa-trash-o btn btn-danger btn-xs remove_details" id="'+row_id+'"></button></td>';
                        var start_index = 1-parseInt(row_id);

                        sum_bags = (parseInt(bags) + parseInt(damages));

                        t_bags_remaining = t_bags_remaining.map(Number);

                        //Replace the old value by the new one
                        t_bags_remaining[row_id] = sum_bags;

                        //Sum the bags to get the total
                        bags_remaining = t_bags_remaining.reduce(function(a,b){  return a+b; },0);
                        console.log('my 2nd array is'+t_bags_remaining +'and the sum is '+ bags_remaining+ '');

                        $('#bags_remains').val(total_bags - bags_remaining);

                        $('#row_'+row_id+'').html(output);
                        // console.log('this row_'+row_id);
                        $('.add-record').val('Add');

                    }
                    $('#customer').val('');
                    $('#bags').val('');
                    $('#damages').val('');
                    $('#amount').val('');
                    $('#descriptions').val('');


                    if ( $('#bags_remains').val() == 0)
                    {
                        // console.log('Bag remaining is '+ $('#bags_remains').val());
                        $('.truck_info').hide();
                        $('.new_record').hide();
                        $('#submit_record').show();
                    }else
                    {
                        $('.truck_info').show();
                        $('.new_record').show();
                        $('#submit_record').hide();
                    }


                    $('.modal#add-record').modal('toggle');
                }




            });

            $(document).on('click', '.view_details', function () {
                var row_id = $(this).attr("id");

                var customer = $('#customer'+row_id+'').val();
                var customer_id = $('#customer_id'+row_id+'').val();
                var bags = $('#bags'+row_id+'').val();
                var damages = $('#damages'+row_id+'').val();
                var amount = $('#amount'+row_id+'').val();
                var descriptions = $('#descriptions'+row_id+'').val();
                $('#customer').val(customer);
                $('#customer_id').val(customer_id);
                $('#bags').val(bags);
                $('#damages').val(damages);
                $('#amount').val(amount);
                $('#descriptions').val(descriptions);
                $('.add-record').val('Save Changes');
                $('#hidden_row_id').val(row_id);
                // $('#user_dialog').dialog('option', 'title', 'Edit Data');
                // $('#user_dialog').dialog('open');


            });

            $(document).on('click','.remove_details', function () {
                var row_id = $(this).attr('id');
                if (confirm("Are you sure you want to remove this row data?"))
                {
                    $('#row_'+row_id+'').remove();
                }else
                {
                    return false;
                }
            });

            $('#record_form').on('submit', function (e) {
                // var token = $('#token').val();
                var lengths = $('#length').val();
                var widths = $('#width').val();
                var heights = $('#height').val();
                var pluss = $('#plus').val();
                // var selected_value=$("#sele").val();

                // console.log('token = '+token+ '');

                e.preventDefault();
                var count_data = 0;
                $('.customer').each(function () {
                    count_data = count_data + 1;
                });
                if (count_data>0)
                {
                    var record_data = $(this).serialize();
                    $.ajax({
                        url:"/admin/record/store",
                        method: "POST",
                        data: record_data,
                        success:function (data) {
                            $('#trip_record').find("tr:gt(0)").remove();
                            var response = jQuery.parseJSON(data);
                            $('.notification').html('<p>Data Inserted Successfully</p>');
                            $(".notification").css("display","block").addClass('alert alert-success').delay(4000).slideUp(300).html(response.success);

                            console.log('Am In.........................');
                        }

                    })
                }

                location.reload();

            });


        });



        $(document).ready(function () {
            $("#customer").on("change", function () {

                var customers = $("select[name='customer'] option:selected").text();

                $('#customer_id').val(customers);

            });
        });

        $(document).ready(function () {
            $("select[name='employee_driver']").change(function(){

                var driver = $(this).val();

                $('#employee_id').val(driver);

            });
        });


        $('.close_record').on('click', function (e) {

            var token = $(this).data('token');

            $('#confirm_close').on('click', '#close-btn', function () {

                $.ajax({
                    type: "POST",
                    url:"/customers/summary",
                    data: {token: token},
                    success: function (data) {
                        var response = jQuery.parseJSON(data);
                        $(".notification").css("display","block").addClass('alert alert-success').delay(4000).slideUp(300).html(response.success)
                    },
                    error: function (request, error) {
                        var errors = jQuery.parseJSON(request.responseText);
                        var ul = document.createElement('ul');

                        $.each(errors, function (key, value) {
                            var li = document.createElement('li');
                            li.appendChild(document.createTextNode(value));
                            ul.appendChild(li)
                        });

                        $(".notification").css("display","block").removeClass('success').addClass('alert alert-danger').delay(6000).slideUp(300).html(ul);
                    }

                });

                $('.modal#confirm_close').modal('toggle');
            });
            e.preventDefault();


        });

    </script>

    @include('includes.modal_add_truck_prop')
    @include('includes.modal_add_record')

@endsection
