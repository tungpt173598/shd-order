<!DOCTYPE html>
<!-- Coding by CodingNepal || www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
    <title>SHD Order</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('css')
</head>
<body>
<!-- navbar -->
<div class="navbar sticky">
    <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        SHD Order
    </div>
    <div>
        @if(\Illuminate\Support\Facades\Auth::check())
            <a href="/profile">Đổi mật khẩu</a>
        @else
            <a href="/login">Đăng nhập</a>
        @endif
    </div>
</div>
<div class="container">
    <!-- sidebar -->
    <div class="sidebar">
        <div class="menu_content">

            <ul class="menu_items">
                <li class="item">
                    <a href="/order" class="nav_link @if(request()->path() == 'order')active @endif">
                        <span class="navlink">Đơn</span>
                    </a>
                </li>
                <li class="item">
                    <a href="paper" class="nav_link @if(request()->path() == 'paper')active @endif">
                        <span>Giấy</span>
                    </a>
                </li>
                <li class="item">
                    <a href="print" class="nav_link @if(request()->path() == 'print')active @endif">
                        <span class="navlink">In</span>
                    </a>
                </li>
                <li class="item">
                    <a href="process" class="nav_link @if(request()->path() == 'process')active @endif">
                        <span class="navlink">Gia công</span>
                    </a>
                </li>
{{--                <li class="item">--}}
{{--                    <a href="pack" class="nav_link @if(request()->path() == 'pack')active @endif">--}}
{{--                        <span class="navlink">Đóng gói</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="item">
                    <a href="deliver" class="nav_link @if(request()->path() == 'deliver')active @endif">
                        <span class="navlink">Giao hàng</span>
                    </a>
                </li>
                <li class="item">
                    <div class="nav_link" id="price-toggle">
                        <span class="navlink">Tính giá</span>
                    </div>
                    <ul class="submenu d-none">
                        @php
                            $types = \App\Models\ProductType::all()
                        @endphp
                        @foreach($types as $type)
                            <div class="nav_link type-price" data-code="{{ $type->code }}">{{ $type->name }}</div>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    @yield('content')
    <div id="price-modal"></div>
</div>
<!-- JavaScript -->
<script>
    if (!String.prototype.splice) {
        String.prototype.splice = function (start, delCount, newSubStr) {
            return this.slice(0, start) + newSubStr + this.slice(start + Math.abs(delCount));
        };
    }

    function formatCurrency(amount) {
        amount = parseFloat(amount);
        if (isNaN(amount)) {
            return "";
        }
        var parts = amount.toFixed(2).toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        if (parts[1] === "00") {
            return parts[0] + 'đ';
        } else {
            return parts.join(".") + 'đ';
        }
    }

    $(document).ready(function () {
        $('#sidebarOpen').click(function () {
            $('.sidebar').toggleClass('close')
        })
        $('#price-toggle').click(function () {
            $('.submenu').toggleClass('d-none')
        })
        // $('#price-modal').modal('show')
        $('.type-price').click(function () {
            let type = $(this).data('code')
            let el = $('#price-modal')
            if (!el.is(':empty') && el.find('.modal').hasClass('price-' + type)) {
                el.find('.modal').modal('show')
                return
            }
            $.ajax({
                url: '/load-price-views?type=' + type,
                method: 'GET',
                success: function(response) {
                    el.empty()
                    el.html(response.views);
                    el.find('.modal').modal('show')
                },
                error: function(xhr) {
                }
            });
        })
        $('.close').click(function () {
            $(this).closest('.modal').modal('hide')
        })
    })

    const body = document.querySelector("body");
    const darkLight = document.querySelector("#darkLight");
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const sidebarClose = document.querySelector(".collapse_sidebar");
    const sidebarExpand = document.querySelector(".expand_sidebar");
    sidebar.addEventListener("mouseenter", () => {
        if (sidebar.classList.contains("hoverable")) {
            sidebar.classList.remove("close");
        }
    });
    sidebar.addEventListener("mouseleave", () => {
        if (sidebar.classList.contains("hoverable")) {
            sidebar.classList.add("close");
        }
    });

    if (window.innerWidth < 768) {
        sidebar.classList.add("close");
        $('.content-container').click(function () {
            if (!$('.sidebar').hasClass('close')) {
                $('.sidebar').toggleClass('close')
            }
        })
    } else {
        sidebar.classList.remove("close");
    }
</script>
@yield('js')
</body>
</html>
