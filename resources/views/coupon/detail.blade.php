@extends('layouts.main')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Coupon Detail</h3>
        </div>
        <table class="table table-bordered table-hover table-striped">
            <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $coupon->name }}</td>
            </tr>
            <tr>
                <td>Start date</td>
                <td>{{ date('Y-m-d', strtotime($coupon->start_date)) }}</td>
            </tr>
            <tr>
                <td>End date</td>
                <td>{{ date('Y-m-d', strtotime($coupon->end_date)) }}</td>
            </tr>
            <tr>
                <td>Product</td>
                <td>
                    @foreach($coupon->products as $productSelect)
                        {{ $productSelect->name }},
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Created date</td>
                <td>{{ date('Y-m-d H:i:s', strtotime($coupon->created_at)) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection('content')
