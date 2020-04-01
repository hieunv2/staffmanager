<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{mix('eel/css/app.css')}}">

    <title></title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <style>
        .action span {
            color: white;
        }

        .logo img {
            margin: 0 auto;
            padding: 170px 0px 40px 0px;
            display: block;
        }

        .btn-login b {
            display: block;
            line-height: 47px;
        }

        .btn-register b {
            display: block;
            line-height: 47px;
        }

        .kaopiz-description {
            background-color: #ff3388;
            padding: 40px 0 30px;
            margin: 0 auto;
            color: #fff;
            text-align: center;
            font-family: sans-serif;
        }

        .kaopiz-description .kaopiz-register {
            display: inline-block;
            border: 2px solid #fff;
            padding: 5px 20px;
            font-weight: bold;
            font-size: 25px;
        }

        .kaopiz-description .kaopiz-club {
            font-weight: bold;
            font-size: 40px;
            display: block;
            padding: 10px;
        }

        .kaopiz-description p {
            font-size: 14px;
            padding: 0 10px;
        }

        @media (max-width: 768px) {

            .btn-block p {
                height: 0;
            }
        }

        .block-hyper-link div a {
            color: #ae335c;
            font-weight: bold;
            font-size: 20px;
        }

        .block-hyper-link a {
            text-decoration: underline;
            text-decoration-color: #d88da4;
            text-underline-position: under;
        }

        .block-hyper-link div a:hover {
            color: rgba(174, 51, 92, 0.8);
        }

        .block-hyper-link div {
            padding: 0 2px;
            text-align: left;
        }

        @media (max-width: 768px) {
            .block-hyper-link div a {
                font-size: 18px;
            }
        }
        .mypage-header .text-logo {
            font-size: 33px;
            font-weight: normal;
        }

        .mypage-header .btn {
            margin-top: 7px;
            float: right;
            background-color: #ae335c;
        }

        .sp-btn {
            margin-top: 17px;
            height: 25px;
        }
    </style>
</head>
<body>
<main>
    <div class="app-container">

        <div>
            <div class="row mypage-header mb-3 pt-3 header-container">
                <div class="col-12 px-0">
                    <div class="row pc-top-header">
                        <div class="col-9 px-0">
                            <div class="text-logo"><a href="/"
                                                      class="logo-link router-link-exact-active router-link-active">フェニックスクラブ </a>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="row mx-0">
                                <div class="col-6 px-0"></div>
                                <div class="col-6 px-0"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <div class="col-12 px-0">
                            <div class="row mx-0 app-sp-menu">
                                <div class="col-11 px-0 text-logo"><a href="/"
                                                                      class="logo-link router-link-exact-active router-link-active">フェニックスクラブ </a>
                                </div>
                                <div class="col-1 px-0"><img
                                            src="/images/sp_menu.png"
                                            class="sp-btn"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sp-menu-container">
                <div class="sp-menu container-fluid">


                    <div class="row top">
                        <div class=" logo"><span class="text-logo"><a
                                        href="/"
                                        class="logo-link router-link-exact-active router-link-active">フェニックスクラブ </a></span>
                        </div>
                        <div class="close">
                            <div><img src="images/close_sp_meu.png"></div>
                        </div>
                    </div>
                    <div>
                        <div class="row"><a href="/register" class="">
                                <div>

                                </div>
                            </a></div>
                        <div class="row"><a href="/login" class="">
                                <div>
                                    ログイン
                                </div>
                            </a></div>
                    </div>
                </div>
            </div>
            <div>
                <div class="kaopiz-description"><span class="kaopiz-register">メンテナンス</span>
                    <span class="kaopiz-club">フェニックスクラブ</span>
                    <p>サーバーのメンテナンスです。<br>
                        メンテナンスまでしばらくおちください。<br>
                        メンテナンスは1/3() 20:30をしております。</p>

                </div>
            </div>
            <div class="footer">
                <div class="policy"><a href="/privacy" class="">
                        Privacy policy
                    </a></div>
                <div class="copyright">© 2018 kaopiz.com</div>
            </div>
        </div>
    </div>
    <span></span></main>
</body>
</html>
