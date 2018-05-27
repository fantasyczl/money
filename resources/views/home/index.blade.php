@extends('layouts.app')

@section ('css')
    <style>
        .card-date {
            margin-left: 30px;
        }
        .amount {
            width: 150px;
        }
    </style>
@stop

@section ('js')
    <script>
        function addLineItem() {
            var productId = $('#product').val();
            var amount = $('#amount').val();

            if (! productId) {
                alert("请选择项目");
                return false;
            }

            if (! amount) {
                alert("请输入金额");
                return false;
            }

            $.ajax({
                url: '/lineitems/ajax/addlineitem',
                dataType: 'json',
                type: 'POST',
                data: {product_id: productId, amount: amount},
                success: function (res) {
                    if (res.err_code !== 0) {
                        alert("发生错误: " + res.message);
                        return false;
                    }

                    location.reload();
                },
                fail: function (res) {
                    alert(res);
                }
            });
        }
    </script>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('今天') }}

                    <span class="card-date">
                        {{ $today }} - {{ $weekday }}
                    </span>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('home') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="product" class="col-sm-4 col-form-label text-md-right">{{ __('项目') }}</label>

                            <div class="col-md-6">
                                <select id="product" name="product">
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>

                                <a href="/products/create">
                                    创建新项目
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('金额') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }} amount" name="amount" required>

                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- <button type="submit" class="btn btn-primary">
                                    {{ __('提交') }}
                                </button> -->
                                <a class="btn btn-primary" href="javascript:void(0);" onclick="addLineItem();">
                                    {{ __('提交') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    历史
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>项目</th>
                            <th>金额</th>
                            <th>日期</th>
                        </tr>

                        @foreach ($lineItems as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->product->name}}</td>
                                <td>{{$item->amount}} (元)</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
