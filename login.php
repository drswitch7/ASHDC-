<?php

include 'incs/libs.php';

if(isset($_SESSIONP['userid'])){header('Location:index');}

$login=new Accex;

if(isset($_POST['go'])){
	if($_POST['uname']!=''){
		if($_POST['acex']!=''){
			try{
			$login->AdminLogin($_POST['uname'],$_POST['acex']);
  }catch(Exception $e){$er=$e->getMessage();}
		}else{$er= 'PASSWORD IS REQUIRED';}
	}else{$er= 'USERNAME IS REQUIRED';}
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo SITENAME ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="<?php echo SHORTNAME; ?>"/>
<meta name="author" content="<?php echo AUTHOR; ?>" />

<link href="<?php echo SERVERPAT; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/themify-icons.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/main.min.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/auth-light.css" rel="stylesheet" />
<link href="<?php echo SERVERPAT; ?>assets/css/login.css" rel="stylesheet" />

<link rel="shortcut icon" title="image" href="img/icon.png"/>
<!-- <style type="text/css">
.navbar {
    background-color:transparent;
    border-bottom:solid 1px rgba(255,255,255,1);
    margin-bottom: 25px;
}
.navbar-inverse {
  display: inline-block;
  float: none;
  font-size: 18px;
  height: 100%;
  padding:0px;
  vertical-align: middle;
  width: 100% !important;
}
.container,.nav-header,.row,.col-sm-12{width:100% !important;}
.container .col-sm-2{
    width:250px !important;
}
.container.col-md-8{width:700px !important;}


.navbar img{
    width:235px;
    height:75px;
}

</style> -->
<style type="text/css">
.heada {
    padding: 0px;
    margin-bottom:28px;
    height: 80px;
    width: 100%;
    display: inline-block;
    margin-top:2px;
    border-bottom:solid 1px rgba(255,255,255,1);
}
.heada img{
    width:235px;
    height:75px;
}
.imgholder {
    width: 250px;
    float:left;
    margin-right: 5px;
    margin-left: 60px;
}
.imgholder2 {
    width: 250px;
    float:right;
    margin-right: 60px;
    margin-left: 5px;
}
.name {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 33px;
    font-weight: 600;
    text-transform: capitalize;
    color: #FFF;
    text-align: center;
    float: left;
    width: auto;
    margin-top: 20px;
}
</style>
</head>
<body >
<!-- 
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="nav-header">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">


            <div class="col-md-2">
              <a class="navbar-brand">
                <img alt="Brand" id="brand2" src="<?php echo SERVERPAT; ?>assets/img/logos/logo.jpeg" class="img img-responsive">
              </a>
            </div>


            <div class="col-md-8 text-center" style="font-size:32px;color:#fff;padding-top:20px;">ANAMBRA STATE HOUSING ESTATE AGENCY</div>

            <div class="col-md-2">
              <a class="navbar-brand">
                <img class="img img-responsive" src="<?php echo SERVERPAT; ?>assets/img/logos/logo.jpeg">
              </a>
            </div>

          </div>

        </div>

      </div>
    </div>
</nav> -->

<div class="heada">
  <div class="imgholder"><img class="img img-responsive" src="<?php echo SERVERPAT; ?>assets/img/logos/logo.jpeg"></div>
  <div class="name">ANAMBRA STATE HOUSING ESTATE AGENCY</div>
  <div class="imgholder2"><img class="img img-responsive" src="<?php echo SERVERPAT; ?>assets/img/logos/logo.jpeg"></div>
</div>

  <div class="content">
        <div class="brand">
            <!-- <a class="link" href="javascript:void();">ASHDC PANEL</a> -->
        </div>
        <form id="login-form" action="" method="post">
            <div class="text-center"><img src="<?php echo SERVERPAT; ?>assets/img/logos/logo.jpeg" style="width:103px;border-bottom:4px solid #ccc;padding-bottom:5px;border-radius:50%" alt="ASHDC" draggable="false"></div><br/>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['go']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';} ?> </div> 

            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                    <input class="form-control" type="text" name="uname" placeholder="Enter Your Username" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="acex" placeholder="Enter Your Password">
                </div>
            </div>
            <br/>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" name="go" style="cursor:pointer;">
                  <i class="fa fa-sign-in"></i> Login
                </button>
            </div>

            <br/>
            <br/>

            <div class="text-center">
                <a class="color-blue" href="<?php echo SERVERPAT; ?>">ASHDC Portal. v0.1</a>
            </div>
        </form>
    </div>

<script src="<?php echo SERVERPAT; ?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo SERVERPAT; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SERVERPAT; ?>assets/js/metronic.js"></script> 
</body>
</html>
