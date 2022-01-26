@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Product Detail</h3>
        </div>
        <table class="table table-bordered table-hover table-striped">
            <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>SKU</td>
                <td>{{ $product->sku }}</td>
            </tr>
            <tr>
                <td>Image</td>
                <td><img src="/{{ $product->image_url }}" style="width:100px;" class="img-fluid" /></td>
            </tr>
            <tr>
                <td>Created date</td>
                <td>{{ date('Y-m-d H:i:s', strtotime($product->created_at)) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection('content')
