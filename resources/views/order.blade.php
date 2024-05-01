@extends('index')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <div class="content-container">
        <div class="head d-flex">
            <div class="title">Nhà cung cấp giấy</div>
            <button type="button" class="add btn btn-primary" data-toggle="modal" data-target="#add">Thêm +</button>
        </div>
        <div class="content">
            <div class="item-container">
                @foreach($data as $item)
                    <div class="item d-flex">
                        <div class="item-content">
                            <div class="item-head">Tên: {{ $item->name }}</div>
                            <div>SĐT: {{ $item->phone }}</div>
                            <div>Địa chỉ: {{ $item->address }}</div>
                        </div>
                        <div class="action">
                            <div class="action-item">
                            <span class="material-symbols-outlined item-icon">
                                edit
                            </span>
                            </div>
                            <div class="action-item">
                            <span class="material-symbols-outlined item-icon" style="color: red; padding-top: 10px">
                                delete
                            </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
