<?php
include('incs/hd.php');

$add= new Administrator;
$utility= new Utility;


if(isset($_POST['send'])){
  if($_POST['stafid']!=''){
    if(ctype_alnum($_POST['uname'])!=''){
try{
     $send= $add->AddAdmin($_POST['stafid'],$_POST['uname']);
}catch(Exception $e){$er= $e->getMessage();}
     }else{$er='Username is Required (Alphanumeric Only)';}
  }else{$er='Staff ID is Required';}

} 


?>

<style>
#Searchplay{
  background-color: #F0F0F0;
  margin: 1px;
}
#Searchplay ul{
  margin: 2px;
  padding: 2px;
}
#Searchplay li{
  color: #FFF;
  background-color: #CCC;
  list-style-type: none;
  margin-bottom: 2px;
  padding-top: 4px;
  padding-right: 10px;
  padding-bottom: 4px;
  padding-left: 10px;
  cursor:pointer;
}
#Searchplay li:hover{
  background-color: #999;
}
</style>

<div class="page-heading">
  <h1 class="page-title"></h1>
</div>
            
            
<div class="row">
<div class="col-md-8">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title">
  <i class="fa fa-exclamation-triangle text-danger"></i> 
Your Username provided in the textfield below is your default password</div>                                                            
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-plus-square"></i> Add Admin</div>                                                            
</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="admin";},2000);});</script>';} 
?>                                
</div> 
      
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="ibox-body">

<div class="form-group">
    <label>Staff ID</label>
    <input class="form-control" id="search" name="stafid" type="text" placeholder="Enter Staff ID" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['stafid'];} ?>">
    <div id="Searchplay"></div>
</div>

<div class="form-group">
    <label>Staff Name</label>
    <input class="form-control" id="vname" type="text" placeholder="Enter Staff Name" autocomplete="off" readonly style="background:#fff" value="<?php if(isset($_POST['send'])){ echo $_POST['sname'];} ?>">
</div>

<div class="form-group">
    <label>Username</label>
    <input class="form-control" name="uname" type="text" placeholder="Enter Username" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['uname'];} ?>">
</div>

<div class="form-group">
    <button class="btn btn-success" type="submit" name="send" style="cursor:pointer;width:135px;font-weight:bolder;"> SUBMIT </button>
</div>
</div>
  </form>
 </div>
    </div>
</div>

<script type="text/javascript">

function fill(Value) {
   $('#vname').val(Value);
   $('#Searchplay').hide();
}

$(document).ready(function() {

   $("#search").keyup(function() {
      var name = $('#search').val();
       if (name == "") {
        $("#Searchplay").html("");
       }else{
        $.ajax({
          type: "POST",
          url: "incs/fetcher.php",
          data: { search: name },
          success: function(html) {
          $("#Searchplay").html(html).show();
           }
         });
      }
    });
 });



</script>

<?php
include('incs/ft.php');

?>