@extends('layouts.main')

@section('content')
    <form>
        <div class="form-group row">
            <label class="col-md-2 col-form-label" for="coupon-name">Coupon name</label>
            <div class="col-md-4">
                <input name="Coupon[name]" value="{{ empty(Request('Coupon')['name']) ? '' : Request('Coupon')['name'] }}" type="text"
                    class="form-control" id="coupon-name" placeholder="please input name">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <div class="col-md-2 text-right">
                <a href="{{ url('coupon/create') }}" class="btn btn-primary">Add Coupon</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>start date</th>
            <th>end date</th>
            <th width="280">created date</th>
            <th width="235">Operate</th>
        </tr>
    </thead>
    <tbody>
            @foreach($coupons as $coupon)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{ $coupon->name }}</td>
                <td>{{ date('Y-m-d', strtotime($coupon->start_date)) }}</td>
                <td>{{ date('Y-m-d', strtotime($coupon->end_date)) }}</td>
                <td>{{ date('Y-m-d H:i:s', strtotime($coupon->updated_at)) }}</td>
                <td>
                    <a href="{{ url('coupon/detail', ['id' => $coupon->coupon_id]) }}" class="btn btn-primary">detail</a>
                    <a href="{{ url('coupon/update', ['id' => $coupon->coupon_id]) }}" class="btn btn-primary">update</a>
                    <a href="{{ url('coupon/delete', ['id' => $coupon->coupon_id]) }}" class="btn btn-primary"
                            onclick="if (confirm('You sure you want to delete it？') == false) return false;">delete</a>
                </td>
            </tr>
            @endforeach
    </tbody>
    </table>

    <!-- 分页  -->
    <div>
        <div style="float:right">
            {{ $coupons->appends(Request::input())->render() }}
        </div>
    </div>
@endsection
