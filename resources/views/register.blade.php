<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" href="<?=asset('icon.ico');?>" />
        <title>Register</title>
        <link rel="stylesheet" href="<?=asset('css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=asset('css/common.css');?>">
    </head>
    <body>
    <div class="container text-center" style="margin-top: 20vh">
        <label style="font-size: 40px; margin-bottom: 30px">Register</label><br>
        @if(isset($error))
            <p class="text-danger">{{$error}}</p>
        @endif
        <p class="text-warning" style="display: none">Password not match.</p>
        <form id="form-register" method="post" action="<?=url('/signup');?>">
            <div class="form-group">
                <label style="width: 100px">Email</label>
                <input class="form-control label-no-line-break" type="email" name="email" title="">
            </div>
            <div class="form-group">
                <label style="width: 100px">Password</label>
                <input class="form-control label-no-line-break" type="password" name="password" title="">
            </div>
            <div class="form-group">
                <label style="width: 100px"></label>
                <input class="form-control label-no-line-break" type="password" name="confirm_password" title="">
            </div>
        </form>
        <div>
            <button class="btn btn-danger" id="button-register" style="width: 350px">Register</button>
            <div style="margin-top: 10px">
                Already have an account? &nbsp;&nbsp;
                <a href="<?=url('/login');?>"> Login </a>
            </div>
        </div>
    </div>
    </body>
    <script src="<?=asset('/js/jquery-3.2.1.min.js');?>"></script>
    <script src="<?=asset('js/bootstrap.min.js');?>"></script>
    <script src="<?=asset('js/common.js');?>"></script>
    <script>

        jQuery(document).ready(function () {

            $("#button-register").on('click', function () {

                password = $("[name = password]").val();
                confirm_password = $("[name = confirm_password]").val();

                if (password == confirm_password) {
                    $("#form-register").submit();
                } else {
                    $(".text-warning").fadeIn().delay(1000).fadeOut();
                }

            });

        });

    </script>
</html>