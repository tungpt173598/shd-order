<!DOCTYPE html>
<!-- Coding by CodingNepal || www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>    <title>SHD Order</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('css')
</head>
<body>
<!-- navbar -->
<div class="navbar">
    <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        SHD Order
    </div>
</div>
<div class="container">
<!-- sidebar -->
    <div class="sidebar">
        <div class="menu_content">

            <ul class="menu_items">
                <li class="item">
                    <a href="/" class="nav_link @if(request()->path() == '/')active @endif">
                        <span class="navlink">Đơn</span>
                    </a>
                </li>
                <li class="item">
                    <a href="paper" class="nav_link @if(request()->path() == 'paper')active @endif">
                        <span>Giấy</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink">In</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink">Gia công</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink">Đóng gói</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink">Giao hàng</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @yield('content')
</div>
<!-- JavaScript -->
<script>
    const body = document.querySelector("body");
    const darkLight = document.querySelector("#darkLight");
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const sidebarClose = document.querySelector(".collapse_sidebar");
    const sidebarExpand = document.querySelector(".expand_sidebar");
    $(document).ready(function () {
        $('#sidebarOpen').click(function () {
            $('.sidebar').toggleClass('close')
        })
        $('.content-container').click(function () {
            if (!$('.sidebar').hasClass('close')) {
                $('.sidebar').toggleClass('close')
            }
        })
    })


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
    } else {
        sidebar.classList.remove("close");
    }
</script>
@yield('js')
</body>
</html>
