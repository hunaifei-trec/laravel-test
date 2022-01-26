@extends('layouts.main')
@section('style')
<style type="text/css">
    .table-image {
        width: 8% !important;
    }
    table tr td img {
        width:150px;
        transition: 500ms;
        -webkit-transition: 500ms;
        -moz-transition: 500ms;
    }
    table tr td img:hover {
        -moz-transform:scale(2);
        -webkit-transform:scale(2);
        -o-transform:scale(2);
    }
</style>
@endsection

@section('content')
    <form>
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="product-name">Product name</label>
            <div class="col-md-4">
                <input name="Product[name]" value="{{ empty(Request('Product')['name']) ? '' : Request('Product')['name'] }}" type="text"
                    class="form-control" id="product-name" placeholder="please input name">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <div class="col-md-2 text-right">
                <a href="{{ url('product/create') }}" class="btn btn-primary">Add Product</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>sku</th>
            <th>image</th>
            <th width="280">created date</th>
            <th width="235">Operate</th>
        </tr>
    </thead>
    <tbody>
            @foreach($products as $product)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td class="table-image"><img src="/{{ $product->image_url }}" class="img-fluid" /></td>
                <td>{{ date('Y-m-d H:i:s', strtotime($product->updated_at)) }}</td>
                <td>
                    <a href="{{ url('product/detail', ['id' => $product->product_id]) }}" class="btn btn-primary">detail</a>
                    <a href="{{ url('product/update', ['id' => $product->product_id]) }}" class="btn btn-primary">update</a>
                    <a href="{{ url('product/delete', ['id' => $product->product_id]) }}" class="btn btn-primary"
                            onclick="if (confirm('You sure you want to delete it？') == false) return false;">delete</a>
                </td>
            </tr>
            @endforeach
    </tbody>
    </table>

    <!-- 分页  -->
    <div>
        <div style="float:right">
            {{ $products->appends(Request::input())->render() }}
        </div>
    </div>
@endsection
