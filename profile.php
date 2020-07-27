<?php
include('incs/hd.php');

$utl= new Utility;
$login=new Accex;
$data= $utl->Changer("staff WHERE sid='{$_SESSION['userid']}'"); 

if(isset($_POST['go'])){
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


<div class="page-heading">
<h1 class="page-title"></h1>             
</div>
            
            
<div class="row">
<div class="col-md-12">

     
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-user-circle-o"></i> Personal Profile <small style="margin-left:20px;font-style:italic;">You can only change you PASSWORD</small></div>   

</div>

                            
                 
<div class="ibox-body">
<div class="table-responsive">

<form id="form1" name="form1" method="post" action="">

<div class="row">
  <div class="col-sm-6">
<table class="table table-bordered" cellspacing="0">
  <tr>
    <td>
    <label><b>Name: </b> <span style="font-size:17px;margin-left:15px;"><?php echo $data->sname.' '.$data->fname.' '.$data->oname; ?></span></label>
    </td>
  </tr>
  <tr>
    <td>
    <label><b>Email: </b> <span style="font-size:17px;margin-left:15px;"><?php echo $data->email; ?></span></label>
    </td>
  </tr> 
    <tr>
    <td>
    <label><b style="color:#069"><i class="fa fa-lock"></i> Change Password</b></label><br/>
    <div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['go']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="logout";},2000);});</script>';} 
?>                                      
</div>
    </td>
  </tr>
    <tr>
    <td>
    <input type="Password" name="acex" class="form-control" required placeholder="Enter New Password">
    </td>
  </tr>  
    <tr>
    <td>
    <input type="Password" name="acexx" class="form-control" required placeholder="Enter Confirm Password">
    </td>
  </tr>    
    <tr>
    <td>
    	<button type="submit" name="go" class="btn btn-primary" style="cursor:pointer;">UPDATE PASSWORD</button>
    </td>
  </tr>  
</table>
</div>

</div>

</form>
</div>
</div>

</div>

</div>

</div>

<?php include('incs/ft.php'); ?>