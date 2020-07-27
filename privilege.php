<?php
include('incs/hd.php');

$add= new Administrator;
$utility= new Utility;
$acex= new Accex;


if(isset($_POST['go'])){  
  try{
    $acex->UnsetPrivilege($_POST['uid']);

if(isset($_POST['admin'])){
  foreach($_POST['admin'] as $a){
    $send= $acex->SetPrivilege($a,$_POST['uid']);
  }}

if(isset($_POST['estate'])){
  foreach($_POST['estate'] as $a){
    $send= $acex->SetPrivilege($a,$_POST['uid']);
  }}

if(isset($_POST['account'])){
  foreach($_POST['account'] as $a){
    $send= $acex->SetPrivilege($a,$_POST['uid']);
}}

if(isset($_POST['menus'])){
  foreach($_POST['menus'] as $a){
    $send= $acex->SetPrivilege($a,$_POST['uid']);
}}
  

  }catch(Exception $e){$er= $e->getMessage(); }

}




?>



<div class="page-heading">
<h1 class="page-title"></h1>             
</div>
            
            
<div class="row">

<?php if(!isset($_GET['set'])){  ?>

<div class="col-sm-10">
     
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-check-square-o"></i> Assign Privilege</div>   

</div>
                            
                 
    <div class="ibox-body">
        <div class="table-responsive">
  <table class="table table-striped table-bordered" id="example-table" cellspacing="0">
  <thead>
  <tr>
  <th width="20px">SN</th>
  <th>Staff ID</th>
  <th>Username</th>
  <th>Name</th>
  <th></th>
  </tr>
  </thead>
    <tbody>
  <?php $ab= $utility->PullRecord("admin WHERE status=1 ORDER BY uname"); if($ab){
      $a=1; foreach($ab as $key => $val){ ?>      
  <tr>
  <td><?php echo $a++; ?></td>
  <td><?php echo $val->stafid; ?></td>
  <td><?php echo $val->uname; ?></td>
  <td><?php $ax=$utility->Changer("staff WHERE stafid='{$val->stafid}'"); echo $ax->sname.' '.$ax->fname.' '.$ax->oname; ?></td>
  <td>

<a href="?set=<?php echo $val->stafid; ?>&&sn=<?php echo uniqid(); ?>"><button class="btn btn-primary btn-xs m-r-3" data-toggle="tooltip" data-original-title="Set Privilege" style="cursor:pointer"><i class="fa fa-gear font-12"></i> Set Privilege</button></a>
      </td>
      </tr>
   <?php } } ?>         
      </tbody>
  </table>
    </div>
        </div>         
</div>


</div>


<?php } if(isset($_GET['set'])){ $d= $_GET['set']; ?>


<div class="col-md-12">

     
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-check-square-o"></i> Set/ Unset Privilege</div>   

</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="privilege";},2000);});</script>';} 
?>                                
</div>                            
                 
<div class="ibox-body">
<div class="table-responsive">

<form id="form1" name="form1" method="post" action="">

<div class="row">  
    <div class="col-sm-12">
    <b><i class="fa fa-gear fa-spin"></i> Menu Settings</b><br/><br/>
<table class="table table-bordered" cellspacing="0">
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="menus[]" value="m1" <?php $c='m1'; $zk=$acex->CP($c,$d); if($zk>0){echo 'checked';} ?>>
    <span class="input-span"></span> <b> Estate</b></label>
    </td>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="menus[]" value="m2" <?php $c='m2'; $zk=$acex->CP($c,$d); if($zk>0){echo 'checked';} ?>>
    <span class="input-span"></span> <b> Client Record</b></label>
    </td>

    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="menus[]" value="m3" <?php $c='m3'; $zk=$acex->CP($c,$d); if($zk>0){echo 'checked';} ?>>
    <span class="input-span"></span> <b> Account Dept</b></label>
    </td>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="menus[]" value="m4" <?php $c='m4'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Ground Rent</b></label>
    </td>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="menus[]" value="m5" <?php $c='m5'; $zk=$acex->CP($c,$d); if($zk>0){echo 'checked';} ?>>
    <span class="input-span"></span> <b> Property</b></label>
    </td>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="menus[]" value="m6" <?php $c='m6'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Administrator</b></label>
    </td>
  </tr>
</table>
</div>

</div>

<hr/>
<br/>  

<div class="row">
  <div class="col-sm-4">
    <b><i class="fa fa-user-circle"></i> Administrator</b>
<table class="table table-bordered" cellspacing="0">
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="admin[]" value="des" <?php $c='des'; $zk=$acex->CP($c,$d); if($zk>0){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Designation</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="admin[]" value="asf" <?php $c='asf'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Add Staff</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox"name="admin[]" value="mas" <?php $c='mas'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Staff</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="admin[]" value="adm" <?php $c='adm'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Add Admin</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="admin[]" value="mad" <?php $c='mad'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Admin</b></label>
    </td>
  </tr> 
    <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="admin[]" value="upd" <?php $c='upd'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Upload Document</b></label>
    </td>
  </tr>
    <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="admin[]" value="mud" <?php $c='mud'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Uploaded Document</b></label>
    </td>
  </tr> 
</table>
</div>

  <div class="col-sm-4">
    <b><i class="fa fa-home"></i> Estate Management</b>
<table class="table table-bordered" cellspacing="0">
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="estate[]" value="aes" <?php $c='aes'; $zk=$acex->CP($c,$d); if($zk>0){echo 'checked';} ?>>
    <span class="input-span"></span> <b> Add Estate</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="estate[]" value="mae" <?php $c='mae'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Estate</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox"name="estate[]" value="adc" <?php $c='adc'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Add Client</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="estate[]" value="mac" <?php $c='mac'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Client</b></label>
    </td>
  </tr>
    <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="estate[]" value="mcp" <?php $c='mcp'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Client Property</b></label>
    </td>
  </tr> 
</table>
</div>

  <div class="col-sm-4">
    <b><i class="fa fa-calculator"></i> Account Management</b>
<table class="table table-bordered" cellspacing="0">
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="account[]" value="asl" <?php $c='asl'; $zk=$acex->CP($c,$d); if($zk>0){echo 'checked';} ?>>
    <span class="input-span"></span> <b> Add Ledger</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="account[]" value="mal" <?php $c='mal'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Ledger</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox"name="account[]" value="pay" <?php $c='pay'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Payment Record</b></label>
    </td>
  </tr>
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="account[]" value="agr" <?php $c='agr'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b> Add Ground Rent</b></label>
    </td>
  </tr>
    <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="account[]" value="mgr" <?php $c='mgr'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Ground Rent</b></label>
    </td>
  </tr> 
  <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="account[]" value="trp" <?php $c='trp'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b> Transfer Property</b></label>
    </td>
  </tr>
    <tr>
    <td>
    <label class="ui-checkbox ui-checkbox-gray">
    <input type="checkbox" name="account[]" value="mpt" <?php $c='mpt'; $zk=$acex->CP($c,$d); if($zk==1){echo 'checked';} ?>>
    <span class="input-span"></span> <b>Manage Property Transfer</b></label>
    </td>
  </tr> 
</table>
</div>
</div>

<hr/>
<br/>

<div class="form-group row">
<div class="col-sm-10">
  <input type="hidden" name="uid" value="<?php echo $_GET['set']; ?>">
<button class="btn btn-info" type="submit" name="go" style="cursor:pointer"> SET PRIVILEGE</button>

<a href="privilege" class="btn btn-warning pull-right" style="cursor:pointer">Back</a>
</div>
</div>

</form>
 </div>
</div>         
</div>


</div>


<?php } ?>

</div>



<?php
include('incs/ft.php');

?>