<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
    <title>Guest PDF</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;900&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            height: 1286px;
            width: 909px;
            background: url('../public/images/pdf-background.png');
            /*background-image: url('/public/images/pdf/1.svg');*/
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            z-index: 0;
        }

        p {margin: 0; padding: 0;}
        .ft10{
            font-size:28px;
            font-family: "Titillium Web", sans-serif;
            color:#63c13d;
        }
        .ft11{font-size:35px;font-family:Times;color:#63c13d;}
        .ft12{
            font-size:22px;
            font-family: "Titillium Web", sans-serif;
            color:#69218b;
        }
        .ft13{
            font-size:45px;
            color:#6a2283;
            font-family: TitilliumWeb-Black_23;
            font-weight: 900;
        }
        .ft14{
            font-size:22px;
            color:#63c13d;
            font-family: "Titillium Web", sans-serif;
        }
        .ft16{
            font-size:22px;
            color:#69218b;
            font-family: "Titillium Web", sans-serif;
        }
        .ft17{
            font-size:40px;
            font-family:Times;
            color:#ffffff;
            z-index: 10;
            position:relative;
            top:1025px;
            margin: 0 auto;
            text-align: center;
            white-space:nowrap;
        }
        .ft18{font-size:34px;font-family:"Titillium Web", sans-serif;color:#231f20;}
        .footer-banner {
            position: absolute;
            top: 1004px;
            /*background: #e83b4c;*/
            height: 100px;
            width: 100%;
        }

        @font-face {
            font-family: TitilliumWeb-Black_23;
            src: url("../public/fonts/TitilliumWeb-Black_23.woff") format("woff");
        }

        @font-face {
            font-family: TitilliumWeb-Bold_24;
            src: url("../public/fonts/TitilliumWeb-Bold_24.woff") format("woff");
        }

        @font-face {
            font-family: TitilliumWeb-Regular_1q;
            src: url("../public/fonts/TitilliumWeb-Regular_1q.woff") format("woff");
        }

        @font-face {
            font-family: TitilliumWeb-SemiBold_22;
            src: url("../public/fonts/TitilliumWeb-SemiBold_22.woff") format("woff");
        }
    </style>
</head>
{{--Roles: Speaker: Red(#e83b4c), Directors of Energy: Orange(#ee8a22), EELA FP: Purple(#93579e), UNIDO Kenya: Blue(#00add8), Delegate: Navy Blue(#015570)--}}
@php($roles = ['Speaker' => '#e83b4c', 'Directors of Energy' => '#ee8a22', 'EELA Focal Points' => '#93579e', 'UNIDO Kenya' => '#00add8', 'Attendee' => '#015570'])
@php($role_color = 'Attendee')
@foreach($roles as $user_role => $color)
    @if(Str::contains($visitor->category, $user_role))
        @php($role_color = $color)
    @endif
@endforeach
<body bgcolor="#A0A0A0" vlink="blue" link="blue">
    <div class="container">
        <p style="position:absolute;top:171px;left:33px;white-space:nowrap" class="ft10"><b>EELA Stakeholder Forum</b></p>
        <p style="position:absolute;top:163px;left:353px;white-space:nowrap" class="ft11"><b>&#160;</b></p>
        <p style="position:absolute;top:190px;left:33px;white-space:nowrap;" class="ft12">EmPowering Efficient Appliances for greater livelihoods in EAC and SADC</p>
        <p style="position:absolute;top:310px;left:42px;max-width: 710px" class="ft13"><b>{{$visitor->name}}</b></p>
        <p style="position:absolute;top:420px;left:38px;white-space:nowrap;" class="ft14">Country:<b>&#160; &#160;&#160;</b></p>
        <p style="position:absolute;top:434px;left:130px;white-space:nowrap;" class="ft16"><b>{{$visitor->Country}}</b></p>
        <p style="position:absolute;top:470px;left:38px;white-space:nowrap;" class="ft14">Category:<b>&#160;&#160;</b></p>
        <p style="position:absolute;top:485px;left:130px;white-space:nowrap;" class="ft16"><b>{{$visitor->category}}</b></p>
        <p style="position:absolute;top:520px;left:38px;white-space:nowrap;" class="ft14">Title:<b>&#160; &#160; &#160; &#160; &#160; &#160;</b></p>
        <p style="position:absolute;top:535px;left:130px;" class="ft16"><b>{{$visitor->Role}}</b></p>
        <p style="position:absolute;top:660px;left:310px;white-space:nowrap" class="ft18">
            <img class="qrcodeImg" src="data:image/png;base64,{!! DNS2D::getBarcodePNG((string) $visitor->id, 'QRCODE', 14, 14) !!}" />
        </p>
        <p class="ft17"><b>{{Str::upper($visitor->category)}}</b></p>
        <div class="footer-banner" style="background: {{$role_color}}">
        </div>
    </div>
</body>
</html>
