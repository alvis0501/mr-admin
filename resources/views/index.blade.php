<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" href="<?=asset('icon.ico');?>" />
        <title>Admin Panel</title>
        <link rel="stylesheet" href="<?=asset('css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?=asset('css/font-awesome.min.css');?>">
        <link rel="stylesheet" href="<?=asset('css/common.css');?>">
        <link rel="stylesheet" href="<?=asset('css/toastr.min.css');?>">
    </head>
    <body>
        <div class="container text-center">
            <div style="margin-top: 10px;float: right" >
                <a href="<?=url('logout');?>" style="text-decoration: none">
                    <i class="fa fa-sign-out"></i> &nbsp;Logout
                </a>
            </div>
            <label style="font-size: 40px; margin-top: 50px">Admin Panel</label>
            <div style="margin-top: 60px">
                <div class="form-group">
                    <label style="width: 100px">App Name</label>
                    <input class="form-control main-input" type="text" id="app-name" title="" value="<?=$app_name;?>">
                </div>
                <div class="form-group">
                    <label style="width: 100px">Link</label>
                    <input class="form-control main-input" type="url" id="link" title=""  value="<?=$link;?>">
                </div>
                <div class="form-group">
                    <label style="width: 100px; vertical-align: top">Notification</label>
                    <textarea class="form-control main-input" id="notification" title=""><?=$notification;?></textarea>
                </div>
                <div class="form-group">
                    <label style="width: 100px; vertical-align: top">About us</label>
                    <textarea class="form-control main-input" id="about_us" title=""><?=$about_us;?></textarea>
                </div>
                <div class="form-group">
                    <label style="width: 100px; vertical-align: top">Contact us</label>
                    <textarea class="form-control main-input" id="contact_us" title=""><?=$contact_us;?></textarea>
                </div>
                <div style="margin-top: 20px">
                    <button class="btn btn-danger" id="button-save" style="width: 100px">Save</button>
                </div>
            </div>
        </div>
    </body>
    <script src="<?=asset('/js/jquery-3.2.1.min.js');?>"></script>
    <script src="<?=asset('js/bootstrap.min.js');?>"></script>
    <script src="<?=asset('js/toastr.min.js');?>"></script>
    <script src="<?=asset('js/common.js');?>"></script>
    <script>

        jQuery(document).ready(function () {

            $("#button-save").on('click', function () {

                app_name = $("#app-name").val();
                link = $("#link").val();
                notification = $("#notification").val();
                about_us = $("#about_us").val();
                contact_us = $("#contact_us").val();

                if (app_name == undefined || app_name == '' ||
                    link == undefined || link == '' ||
                    notification == undefined || notification == '' ||
                    about_us == undefined || about_us == '' ||
                    contact_us == undefined || contact_us == '') {
                    toastr.error( 'Parameter invalid', 'Error');
                    return;
                }

                if (!isUrlValid(link)) {
                    toastr.error( 'Link format invalid', 'Error');
                    return;
                }

                $.ajax({
                    url: "<?=url('/set-data');?>",
                    method: 'post',
                    data : {
                        'app_name' : app_name,
                        'link' : link,
                        'notification' : notification,
                        'about_us' : about_us,
                        'contact_us' : contact_us
                    },
                    success: function(resp) {
                        showToastMsg(resp);
                    }
                });

            });

        });

    </script>
</html>