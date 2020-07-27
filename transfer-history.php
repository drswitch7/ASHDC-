<?php
include('incs/hd.php');

$add= new EstateManagement;
$acc= new AccountantDepartment;
$utility= new Utility;

$client= $utility->PullRecord('client_transfer WHERE status=1');


if(isset($_POST['find'])){
  if($_POST['estate']!='0'){
    $_GET['find']= $_POST['estate'];
  }else{$er= 'ESTATE NAME NOT SELECTED';}
}

?>

<style type="text/css">
label{font-weight:bolder;}
.drp{cursor:pointer;padding:3px 6px;}
.undaline{border:none;border-radius:0;border-bottom:1px #ccc solid;background-color:#fff !important;}
</style>

<div class="page-heading">
  <h1 class="page-title"></h1>
</div>
            
            
  <div class="row">

<?php if(!isset($_GET['edit']))if(!isset($_GET['search'])){ ?>
  <div class="col-md-12">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Manage of Transfer</div>    
<div class="ibox-tools">
  <a href="?search" class="btn btn-link" style="text-decoration:none;font-weight:bolder;"><i class="fa fa-search" title="Search by Estate"></i> Search by Estate </a>
  <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
  </div>                                     
</div>
                            

                 
    <div class="ibox-body">
        <div class="table-responsive">
  <table class="table table-striped table-bordered" id="example-table" cellspacing="0">
    <thead>
      <tr>
      <th width="20px">SN</th>
      <th>Estate</th>
      <th>Plot No</th>
      <th>Plot Size</th>
      <th>Allotee Name</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>
  <?php if($client){
      $a=1; foreach($client as $key => $val){ ?>      
    <tr>
    <td><?php echo $a++; ?></td>
    <td><?php echo $utility->Changer("estates WHERE id='$val->eid'")->name; ?></td>
    <td><?php echo $val->plot; ?></td>
    <td><?php echo $val->plotsize; ?></td>
    <td><?php echo $val->fname2.' '.$val->lname2; ?></td>
    <td>
<?php if($val->sold!=1){ ?>
    <button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Owner" style="cursor:pointer"><i class="fa fa-check-square-o font-13"></i></button>
  <?php }else{ ?>
<button class="btn btn-default btn-xs m-r-3" data-toggle="tooltip" data-original-title="SOLD" style="cursor:pointer"><i class="fa fa-check-square font-13"></i></button>
  <?php } ?>
      </td>
      </tr>
   <?php } } ?>         
      </tbody>
  </table>
    </div>
        </div>
  </div>
</div>  

<?php } if(isset($_GET['search'])){ ?>

<div class="<?php if(isset($_GET['find'])){echo 'col-sm-12';}else{echo 'col-md-6';} ?>">       
  <div class="ibox">
    <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i><?php if(!isset($_GET['find'])){echo ' Search';}else{echo' Property History';} ?></div> 
  <div class="ibox-tools"><?php if(isset($_GET['find'])){ ?>
  <a href="?search" class="btn btn-link" style="text-decoration:none;font-weight:bolder;color:red;"><i class="fa fa-times-circle" title="Back"></i> Back</a><?php } ?>
  <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
  </div>                                         
  </div>

<?php if(!isset($_GET['find'])){ ?>
  <div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['find']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';} ?></div>

<form method="POST" name="formsearch">
<div class="ibox-body">
<div class="form-group">
    <label>Select Estate</label>
    <select class="form-control" name="estate" title="Select Estate" style="cursor:pointer;">
      <?php echo $utility->Dropdown('name','estates WHERE status=1','name'); ?>
    </select>
</div>

<div class="form-group">
    <button class="btn btn-success" type="submit" name="find" style="cursor:pointer;width:135px">SEARCH</button>
</div>
</div>
</form>





<!-- SEARCH AREANA -->

<?php } if(isset($_GET['find'])){  $efind= $utility->PullRecord("client_transfer WHERE eid='{$_GET['find']}' AND status=1"); ?> 
<div class="ibox-body">

<div class="table-responsive">
  <table class="table table-striped table-bordered" id="example-table" cellspacing="0">
    <thead>
      <tr>
      <th width="20px">SN</th>
      <th>Estate</th>
      <th>Plot No</th>
      <th>Plot Size</th>
      <th>Allotee Name</th>
      <th></th>
      </tr>
    </thead>
    <tbody>
  <?php if($efind){
      $a=1; foreach($efind as $key => $vala){ ?>      
    <tr>
    <td><?php echo $a++; ?></td>
    <td><?php echo $utility->Changer("estates WHERE id='$vala->eid'")->name; ?></td>
    <td><?php echo $vala->plot; ?></td>
    <td><?php echo $vala->plotsize; ?></td>
    <td><?php echo $vala->fname2.' '.$vala->lname2; ?></td>
    <td>

<?php if($vala->sold!=1){ ?>
    <button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Owner" style="cursor:pointer"><i class="fa fa-check-square-o font-13"></i></button>
  <?php }else{ ?>
<button class="btn btn-default btn-xs m-r-3" data-toggle="tooltip" data-original-title="SOLD" style="cursor:pointer"><i class="fa fa-check-square font-13"></i></button>
  <?php } ?>

      </td>
      </tr>
   <?php } } ?>         
      </tbody>
  </table>
    </div>
</div>

<?php } ?>

</div>

</div>

        
<?php } if(isset($_GET['edit'])){ $data= $utility->Changer("client_transfer WHERE cid2='{$_GET['edit']}'"); ?>

 <div class="col-md-8">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Transfer Property From</div>                                         
  </div>    

    <div class="ibox-body">
<div class="form-group">
  <label>Passport</label><br/>
  <img src="<?php echo $utility->Changer("client WHERE cid='$data->cid'")->img; ?>" width="90" style="margin:4px;padding:4px;border:2px #ccc solid;">
</div>

      <label><i class="fa fa-home"></i> Estate Name: <span style="color:green"><?php echo ucwords($utility->Changer("estates WHERE id='$data->eid'")->name); ?></span></label><br/>
      <label><i class="fa fa-map"></i> Plot Number: <span style="color:green"><?php echo $data->plot; ?></span></label><br/>
      <label><i class="fa fa-clone"></i> Plot Size: <span style="color:green"><?php echo $data->plotsize; ?></span></label><br/>
      <label><i class="fa fa-user"></i> Allotee Name: <span style="color:green"><?php echo ucwords($data->fname.' '.$data->lname); ?></span></label>
</div>


  </div>
</div>

<div class="col-md-10">       
  <div class="ibox">




<div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-triangle text-danger"></i> Transfer Information</div>                                         
  </div>


<div class="ibox-body">
  <div class="form-group col-sm-12 text-center">
  <label>Passport</label><br/>
  <img src="<?php echo $data->img; ?>" width="90" style="margin:4px;padding:4px;border:2px #ccc solid;">
</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="manage-transfer";},2000);});</script>';} 
?>                                
</div>
  <form action="" method="POST" enctype="multipart/form-data">

<div class="row">
<div class="col-sm-6 form-group">
<label>Allotee First Name</label>
<input class="form-control" type="text" name="fname" placeholder="Enter Allotee First Name" autocomplete="off" required value="<?php echo $data->fname2; ?>">
</div>
<div class="col-sm-6 form-group">
<label>Allotee Last Name</label>
<input class="form-control" type="text" name="lname" placeholder="Enter Allotee Last Name" autocomplete="off" required value="<?php echo $data->lname2; ?>">
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
    <label>Date of Birth</label>
    <input class="form-control" name="dob" type="date" placeholder="Enter Date of Birth" autocomplete="off" required value="<?php echo $data->dob; ?>">
</div>

<div class="col-sm-6 form-group">
    <label>Nationality</label>
    <select class="form-control" name="national" title="Select Nationality" style="cursor:pointer;">
<option value="<?php echo $data->national; ?>"><?php if($data->national==1){echo 'Non Nigerian';}else{echo 'Nigerian';} ?></option>      
      <option value="0">- Select -</option>
        <option value="1">Non Nigerian</option>
        <option value="2">Nigerian</option>
    </select>
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>State</label>
  <select class="form-control" id="state" name="state" title="Select State" style="cursor:pointer;">
<option value="<?php echo $data->state; ?>"><?php echo $utility->Changer("state WHERE id=$data->state")->state; ?></option>
    <?php echo $utility->Dropdown('state','state','state'); ?>
  </select>
</div>
<div class="col-sm-6 form-group">
<label>Local Government</label>
  <select class="form-control" id="lga" name="lga" title="Select Local Government" style="cursor:pointer;">
   <option value="<?php echo $data->lga; ?>"><?php echo $utility->Changer("lga WHERE id=$data->lga")->lganame; ?></option>   
  </select>
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>Home Town</label>
<input class="form-control" type="text" name="home" placeholder="Enter Home Town" autocomplete="off" required value="<?php echo $data->home; ?>">
</div>
<div class="col-sm-6 form-group">
<label>Home Town Address</label>
<input class="form-control" type="text" name="town" placeholder="Enter Home Town Address" autocomplete="off" required value="<?php echo $data->town; ?>">
</div>
</div>

<div class="form-group">
    <label>Residential Address</label>
    <textarea class="form-control" name="adrex" type="text" placeholder="Enter Residential Address" autocomplete="off" required><?php echo $data->adrex; ?></textarea>
</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>Mobile Number</label>
<input class="form-control" type="text" name="fone" placeholder="Enter Mobile Number" autocomplete="off" required value="<?php echo $data->fone; ?>">
</div>
<div class="col-sm-6 form-group">
<label>Phone Number</label>
<input class="form-control" type="text" name="fone2" placeholder="Enter Phone Number" autocomplete="off" value="<?php echo $data->fone2; ?>">
</div>
</div>

<div class="row">

<div class="col-sm-3 form-group">
    <label>Date Transfer</label>
    <input class="form-control" name="date" type="date" placeholder="Enter Date Transfer" autocomplete="off" required value="<?php echo $data->tdated; ?>">
</div>

<div class="col-sm-3 form-group">
    <label>Amount Paid</label>
    <input class="form-control" name="amt" type="number" placeholder="Enter Amount Paid" autocomplete="off" value="<?php echo $data->amt; ?>">
</div>

<div class="col-sm-3 form-group">
    <label>Receipt No</label>
    <input class="form-control" name="receipt" type="text" placeholder="Enter Receipt No" autocomplete="off" value="<?php echo $data->receipt; ?>">
</div>

<div class="col-sm-3 form-group">
  <label>Upload Passport</label><br/>
  <img src="" alt="" width="80" id="tim" style="margin-top:5px;margin-bottom: 4px;" class="img-rounded lop">
  <input type="file" name="img" id="imginp" class="form-control" onchange="readURL(this)" style="border:none; cursor:pointer;padding: 4px;">
</div>

</div>

<div class="form-group">
  <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" value="1" name="tl" title="Transfer Letter" required <?php if($data->tl==1){echo 'checked';} ?>>
  <span class="input-span"></span> <b>Transfer Letter/ Paper </b></label>
</div>
<div class="form-group">
  <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" title="Confirm Transfer" required>
  <span class="input-span"></span> <b>Confirm Information before Transfer</b></label>
</div>
<br/>

<div class="form-group">
  <input type="hidden" name="eimg" value="<?php echo  $data->img; ?>">
  <input type="hidden" name="cid" value="<?php echo $_GET['edit']; ?>">
    <button class="btn btn-success" type="submit" name="send" style="cursor:pointer;font-weight:bolder;"> UPDATE TRANSFER</button>
</div>

    </form>

    </div>
      </div>
  </div>
<?php } ?>
  
</div>



<?php
include('incs/ft.php');

?>