<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <title>{{config('app.name')}} - @yield('title')</title>
</head>

<body>

    <div id="debug_info_box" class="debug-info-box">
    </div>

    <!-- top frame -->
    <div class="page-header">
        @auth
            <div class="user-info-panel">
                <p>已登录</p>
            </div>
        @endauth
    </div>

    <!-- client-area -->
    <div class="client-area">

        <!-- navi menu -->
        <div class="resize-area">
            <div class="menu-wrapper">
            </div>
        </div><!-- page content --><div class="content-wrapper">
            @section('content')
            @show
        </div>
    </div>


    <script>
        $('.menu-wrapper').accordion({
            heightStyle : 'fill',
            animate : 200
        });

        $('.resize-area').resizable({
            helper : 'ui-resizable-helper',
            maxWidth : $(window).width() * 0.4,
            minWidth : 50,
            handles: 'e, w',
            stop : resizeContent
        });

        resizeContent();

        function resizeContent() {
            $('.client-area').outerHeight($(window).height() - $('.page-header').outerHeight(true));
            $('.resize-area').outerHeight($('.client-area').height());
            $('.content-wrapper').outerWidth($('.client-area').width() - $('.menu-wrapper').outerWidth(true) - 10);
            $('.content-wrapper').outerHeight($('.client-area').height());
            $('.menu-wrapper').accordion('refresh');
        }
    </script>
</body>

</html>