@extends('layouts.main')

@section('content')
    @include('layouts.validator')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Product') }}</div>

                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input type="text" id="name" name="Product[name]" autofocus class="form-control"
                                    value="{{ !empty(old('Product')['name']) ? old('Product')['name'] : $product->name }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sku" class="col-md-4 col-form-label text-md-right">SKU</label>

                            <div class="col-md-6">
                                <input type="text" id="name" name="Product[sku]" autofocus class="form-control"
                                    value="{{ !empty(old('Product')['sku']) ? old('Product')['sku'] : $product->sku }}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image"  class="col-md-4 col-form-label text-md-right">Product Image</label>
                            <div class="col-md-6">
                                <img src="/{{ !empty(old('Product')['image_url']) ? old('Product')['image_url'] : $product->image_url }}" style="width:100px;" class="img-fluid" />
                                <input type="file" class="form-control-file" id="image" name="image" accept=".jpg,.gif,.png">
                                <input type="hidden" name="Product[image_url]" value="{{ !empty(old('Product')['image_url']) ? old('Product')['image_url'] : $product->image_url }}" />
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
