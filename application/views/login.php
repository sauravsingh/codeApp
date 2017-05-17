<!Doctype>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/custom.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/bootstrap.min.css"/>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/custom.js"></script>
</head>
<body>
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card text-info"><?php echo $this->session->flashdata('msg');?></p>
            <?php echo form_open('authenticate', 'class=form-signin');?>            
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" name="username" placeholder="Email address" required autofocus autocomplete="off">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            
            <?php echo form_close();?>
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>