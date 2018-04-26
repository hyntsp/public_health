<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}?v={{config('clientversion.css.main')}}">
    <link rel="stylesheet" href="{{asset('css/themes/default/easyui.css')}}?v={{config('clientversion.css.jquery-easy-ui')}}">
    <link rel="stylesheet" href="{{asset('css/themes/icon.css')}}">
    <link rel="stylesheet" href="{{asset('css/themes/color.css')}}">
    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easyui.min.js') }}?v={{config('clientversion.js.jquery-easy-ui')}}"></script>
    <script src="{{ asset('js/jquery.easyui.defaults.js') }}?v={{config('clientversion.js.jquery-easy-ui-defaults')}}"></script>
    <script src="{{ asset('js/main.js') }}?v={{config('clientversion.js.main')}}"></script>
    <title>{{config('app.name')}} - 登陆</title>
    <style>
        .banner{
            height:80px;
            background:url({{asset('images/header_bg.jpg')}}) no-repeat;
        }

        .footer{
            padding:15px 0;
            border-top:1px solid #d4d4d4;
            background:#f3f3f3;
        }

        .footer p{
            text-align: center;
        }

        .login{
            position: fixed;
            width:500px;
            top:20%;
            left:50%;
            margin-left:-250px;
            border:1px solid #bbb;
            background-color:#fff;
            overflow: hidden;
            box-shadow:0 0 50px 3px #bbb;
            text-align: center;
        }

        .login .title{
            position: relative;
            line-height:50px;
            background:#e9e9e9;
            border-bottom:1px solid #bbb;
            text-align: center;
            font-size:20px;
            font-weight: bold;
            margin-bottom:20px;
        }

        .login .wrapper{
            width:400px;
            margin:0 auto 15px auto;
        }
    </style>
</head>

<body class="easyui-layout">
    <div class="banner" data-options="region:'north',border:false"></div>

    <div data-options="region:'center',border:false">
        <div class="login">
            <form id="form_login" method="post" action="{{route('login')}}">
                {{csrf_field()}}
                @if ($errors->has('login_name'))
                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('login_name') }}</strong>
                                </span>
                @endif

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                @endif
                <p class="title">用户登录</p>
                <div class="wrapper">
                    <select id="login_name" name="login_name" class="easyui-combobox" data-options="
                            prompt:'请输入用户名',
                            buttonIcon:'icon-man',
                            buttonAlign:'left',
                            value:'{{old('login_name')}}',
                            required:true,
                            validateOnCreate:false,
                            iconWidth:30" style="width:100%;height:45px;">
                        <option>a</option>
                        <option>b</option>
                    </select>
                </div>

                <div class="wrapper">
                    <input id="password" name="password" class="easyui-passwordbox" data-options="
                            prompt:'请输入密码',
                            buttonIcon:'icon-lock',
                            buttonAlign:'left',
                            buttonWidth:50,
                            required:true,
                            validateOnCreate:false,
                            iconWidth:30" style="width:100%;height:45px;">
                </div>

                <div class="wrapper">
                    <input id="vcode" name="vcode" class="easyui-textbox" data-options="
                            prompt:'请输入右侧3位验证码，点击可更换',
                            required:true,
                            validateOnCreate:false" style="width:300px;height:45px;"><img
                            id="vcodeimg" src="data:image/png;base64,{{app()->make(App\Services\IndentifyingCodeService::class)->newIndentifyingCode(99, 43, 3)['image']}}" style="width:100px;height:45px;border-top:1px solid #d4d4d4;border-right:1px solid #d4d4d4;border-bottom:1px solid #d4d4d4;cursor:pointer;float:right;" onclick="newCode();">

                </div>

                <p style="border-top:1px solid #bbb;"></p>
                <div>
                    <button type="submit" class="easyui-linkbutton" style="width:400px;height:32px;margin:20px 50px;" onclick="test();">登&nbsp;&nbsp;陆</button>
                </div>
            </form>
        </div>
    </div>


    <div class="footer" data-options="region:'south',border:false">
        <p>版权所有 (C) 2011-{{@date('Y')}} 寿阳县卫生和计划生育局&nbsp;|&nbsp;技术支持：成都市盛世华旭科技有限公司</p>
        <p>地址：寿阳县朝阳街51号&nbsp;&nbsp;电话：0354-4622607&nbsp;&nbsp;<b>提示：正常使用本系统功能，必须开启浏览器cookie</b></p>
    </div>

    <script>
        $(function(){
            $('#login_name').textbox('textbox').attr('maxlength', 20);
            $('#password').textbox('textbox').attr('maxlength', 20);
            $('#vcode').textbox('textbox').attr('maxlength', 3);
        });

        function newCode()
        {
            $('#vcodeimg').attr('src', '');
            $.ajax({
                url: '{{url('request-new-vcode')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'post',
                success : function(result) {
                    $('#vcodeimg').attr('src', 'data:image/png;base64,' + result);
                }
            });
        }

        function test() {
            alert($('form_login').form('validate'));
        }
    </script>

</body>
</html>