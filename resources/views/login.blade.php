<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" href="<?=asset('icon.ico');?>" />
        <title>Login</title>
        <link rel="stylesheet" href="<?=asset('css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=asset('css/common.css');?>">
    </head>
    <body>
        <div class="container text-center" style="margin-top: 20vh">
            <label style="font-size: 40px; margin-bottom: 20px">Login</label><br>
            <p>Please enter email and password</p>
            <form method="post" action="<?=url('/signin');?>">
                <div class="form-group">
                    <label style="width: 100px">Email</label>
                    <input class="form-control label-no-line-break" type="email" name="email" title="">
                </div>
                <div class="form-group">
                    <label style="width: 100px">Password</label>
                    <input class="form-control label-no-line-break" type="password" name="password" title="">
                </div>
                <button class="btn btn-danger" type="submit" style="width: 350px">Login</button>
                <div style="margin-top: 10px">
                    Have you no account? &nbsp;&nbsp;
                    <a href="<?=url('/register');?>"> Create a new account </a>
                </div>
            </form>
        </div>
    </body>
    <script src="<?=asset('/js/jquery-3.2.1.min.js');?>"></script>
    <script src="<?=asset('js/bootstrap.min.js');?>"></script>
    <script src="<?=asset('js/common.js');?>"></script>
</html>