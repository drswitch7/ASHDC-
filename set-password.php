<?php

include 'incs/libs.php';

if(!isset($_SESSION['userid'])){ die(header('Location:logout'));}

$login=new Accex;
$data= $login->Changer("staff WHERE stafid='{$_SESSION['user']}'");

if(isset($_POST['send'])){
	if($_POST['acex']!=''){
		if($_POST['acexx']!=''){
            if($_POST['acex']==$_POST['acexx']){
			try{
			$send= $login->AdminLoginUpdate($_SESSION['userid'],$_POST['acex']);
  }catch(Exception $e){$er=$e->getMessage();}
            }else{$er= 'CONFIRM PASSWORD DO NOT MATCH WITH PASSWORD';}
		}else{$er= 'CONFIRM PASSWORD IS REQUIRED';}
	}else{$er= 'PASSWORD IS REQUIRED';}
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title> <?php echo SITENAME ?> | Confirm Password </title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo SHORTNAME; ?>"/>
<meta name="author" content="<?php echo AUTHOR; ?>" />

<link href="<?php echo SERVERPAT; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/themify-icons.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/main.min.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/auth-light.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/login.css" rel="stylesheet" />
<script src="<?php echo SERVERPAT; ?>assets/js/jquery.min.js" type="text/javascript"></script>
<link rel="shortcut icon" title="image" href="<?php echo SERVERPAT; ?>assets/img/logos/logo.jpeg"/>

</head>
<body >

<br/>
<br/>



  <div class="content">
        <div class="brand">
            <!-- <a class="link" href="javascript:void();">ASHDC PANEL</a> -->
        </div>
        <form id="login-form" action="" method="post">
            <h5 style="padding:0;text-align:center;text-transform:uppercase;color:#fff;">Change Password</h5>
            <div class="text-center"><img src="<?php echo $data->img; ?>" style="width:100px;border-bottom:4px solid #ccc;padding-bottom:0px;border-radius:100px" alt="ASHDC" draggable="false"></div><br/>
    <div class="form-group text-center">
    <label style="font-weight:bolder;color:#fff;"><i class="fa fa-user-circle"></i> Welcome<br/><span style="color:#069; text-transform:uppercase;"><?php echo $data->sname.' '.$data->fname.' '.$data->oname; ?></span></label>
            </div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="logout";},2000);});</script>';} 
?>                                      
</div>      

            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock"></i></div>
                    <input class="form-control" type="password" name="acex" placeholder="Enter Your Password" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="acexx" placeholder="Enter Your Confirm Password">
                </div>
            </div>
            <br/>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" name="send" style="cursor:pointer;">
                  <i class="fa fa-check-square"></i> SET PASSWORD
                </button>
            </div>

            <br/>
            <br/>

            <div class="text-center">
                <a class="color-blue" href="<?php echo SERVERPAT; ?>">ASHDC Portal. v0.1</a>
            </div>
        </form>
    </div>


<script src="<?php echo SERVERPAT; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SERVERPAT; ?>assets/js/metronic.js"></script> 
</body>
</html>
