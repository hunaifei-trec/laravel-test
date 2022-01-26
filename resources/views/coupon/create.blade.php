@extends('layouts.main')



@section('content')
    @include('layouts.validator')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Coupon') }}</div>

                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input type="text" id="name" name="Coupon[name]" autofocus class="form-control"
                                    value="{{ !empty(old('Coupon')['name']) ? old('Coupon')['name'] : '' }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">Start Date</label>

                            <div class="col-md-6">
                                <input class="date form-control" type="text" name="Coupon[start_date]" id="start_date" autocomplete = "off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">End Date</label>
                            <div class="col-md-6">
                                <input class="date form-control" type="text" name="Coupon[end_date]" id="end_date" autocomplete = "off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product" class="col-md-4 col-form-label text-md-right">Select Product</label>
                            <div class="col-md-6">
                            <select id="product_ids" name="product_ids" multiple="multiple">
                                @foreach($products as $product)
                                    <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <input type='hidden' id="product_ids_select" name="Coupon[product_ids]" value="" />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')

@section('javascript')
<script type="text/javascript">
    $('#product_ids').multiselect({
        enableFiltering: true,
        maxHeight: 400,
        dropUp: true,
        onChange: function(element, checked) {
            var products = $('#product_ids option:selected');
            var selected = [];
            $(products).each(function(index, brand){
                selected.push($(this).val());
            });
            $('#product_ids_select').val(selected);
        }
    });

    $('#start_date').datepicker({
       dateFormat: 'yy-mm-dd',
       onSelect:function(dateText,inst){
            $('.ui-datepicker-div').css("display","none");
        }
     });

     $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect:function(dateText,inst){
            $('.ui-datepicker-div').css("display","none");
        }
    });
</script>

@endsection('javascript')
