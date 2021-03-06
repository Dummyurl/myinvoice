<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="<?php echo $this->config->item('images_url'); ?>favicon.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo MY_SITE_NAME; ?></title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>font-awesome.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>animate.min.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>custom.css"/>
        <link rel="stylesheet" href="<?php echo $this->config->item('css_url'); ?>green.css"/>


        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom.js"></script>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>jquery.validate.min.js"></script>

        <style type="text/css">
            .form-control
            {
                border-radius:-0.5px;
                border-color: blue;
                border-width: 1px;
            }
            p
            {
                float: left;font-size: 12px;color: #FFFFFF;line-height:10px;letter-spacing:1.5px;
            }

            html{
                height:100%;
                background: -webkit-linear-gradient(#5D87B1 , #374A5D); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(#5D87B1, #374A5D); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(#5D87B1, #374A5D); /* For Firefox 3.6 to 15 */
                background: linear-gradient(#5D87B1, #374A5D); 
            }
            .footer {
                position: absolute;
                right: 0;
                bottom: 0;
                left: 0;
                padding: 1rem;
                background-color: #efefef;
                text-align: center;
                font-size: 12px;
                color: #9097A0;
                letter-spacing: 0;
            }
        </style>

    </head>
    <body>
        <?php include APPPATH . '/modules/views/notification_message.php'; //footer file     ?>

        <div class="">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>

            <div id="wrapper">

                <div id="login" class="animate form col-xs-12">
                    <section class="login_content" style="margin-top:4px;">
                        <div class= "logo">
                            <?php
                            $img_name = get_logo();
                            if ($img_name != '') {
                                $img = 'images/' . $img_name;
                                $img_path = $this->config->item('upload_url') . $img;
                                $img_url = $this->config->item('upload_url') . $img;
                            } else {
                                $img_url = $this->config->item('upload_url') . 'no-image.png';
                            }
                            ?>
                            <a href="javascript:void(0)" class=""> <span> 
                                    <img src="<?php echo $img_url; ?>" >
                                </span>
                            </a>
                        </div>
                        <form id="login_form" action="<?php echo $this->config->item("site_url") . "admin-login-action"; ?>" method="post" >
                            <div>
                                <p>USERNAME</p>
                                <input type="text" placeholder="Username" class="form-control" name="email" value="admin" id="email" style="margin-top:-10px;" />
                            </div>

                            <div>
                                <p>PASSWORD</p>      
                                <input type="password" placeholder="Password" class="form-control" value="admin" name="password" id="password" />
                            </div>
                            <div>
                                <input type="submit" class="btn btn-default submit" value="SIGN IN" style="background-color:#689DFB;letter-spacing:2px;" />                                
                                <a class="reset_pass" href="<?php echo $this->config->item("site_url") . "admin-forgotpassword"; ?>" style="margin-top:15px;">Forgot Password</a>
                            </div>
                            <div class="clearfix"></div>

                        </form>
                        <!-- form -->
                    </section>
                    <!-- content -->
                </div>

            </div>
        </div>
        <div class="footer">Copyright @ <?php echo date('Y') . "  " . MY_SITE_NAME; ?></div>
        <script type="text/javascript" src="<?php echo $this->config->item('js_url'); ?>custom/login.js"></script>
    </body>
</html>
