<?php
include('incs/hd.php');
if(!isset($_GET['info'])){ echo '<script>$(document).ready(function(){ window.location="manage-client"});</script>'; }

$add= new EstateManagement;
$utility= new Utility;

$data= $utility->Changer("client WHERE cid='".$_GET['info']."'");


?>
<style type="text/css">label{font-weight:bolder;}</style>

<div class="page-heading">
  <h1 class="page-title"></h1>
</div>
            
            
<div class="row">

<div class="col-md-8">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-bars"></i> Client Record Detail</div>                                                            
</div>
     

<div class="ibox-body">
<div class="form-group col-sm-12">
  <label>Passport</label><br/>
  <img src="<?php echo $data->img; ?>" width="90" style="margin:3px;padding:3px;border:2px #ccc solid">
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Registration Mode:</label>
    <div class="col-sm-8"><?php if($data->mode==1){echo 'Non Transfer';}else{echo 'Transfer';} ?></div>
</div>


<div class="form-group row">
    <label class="col-sm-3 col-form-label">Estate Name:</label>
    <div class="col-sm-8"><?php echo $utility->Changer("estates WHERE id=$data->eid")->name; ?></div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Plot Number:</label>
    <div class="col-sm-9"><?php echo $data->plot; ?></div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Plot Size:</label>
  <div class="col-sm-9"><?php echo $data->plotsize; ?></div>
</div>

<div class="form-group row">
<label class="col-sm-3 col-form-label">Allotee Full Name:</label>
<div class="col-sm-9"><?php echo $data->fname.' '.$data->lname; ?></div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Date of Birth:</label>
    <div class="col-sm-9"><?php echo date('d M, Y',strtotime($data->dob)); ?></div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Nationality:</label>
    <div class="col-sm-6"><?php if($data->national==1){echo 'Non- Nigerian';}elseif($data->national==2){echo 'Nigerian';} ?></div>
</div>

<div class="form-group row">
<label class="col-sm-3 col-form-label">State:</label>
  <div class="col-sm-9"><?php echo $utility->Changer("state WHERE id=$data->state")->state; ?> </div>
</div>

<div class="form-group row">
<label class="col-sm-3 col-form-label">Local Government:</label>
  <div class="col-sm-9"><?php echo $utility->Changer("lga WHERE id=$data->lga")->lganame; ?></div>
</div>

<div class="form-group row">
<label class="col-sm-3 col-form-label">Home Town:</label>
<div class="col-sm-9"><?php echo $data->home; ?></div>
</div>

<div class="form-group row">
<label class="col-sm-3 col-form-label">Home Town Address:</label>
<div class="col-sm-9"><?php echo $data->town; ?></div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Residential Address:</label>
    <div class="col-sm-9"><?php echo $data->adrex; ?></div>
</div>

<div class="form-group row">
<label class="col-sm-3 col-form-label">Mobile Number:</label>
<div class="col-sm-9"><?php echo $data->fone; ?></div>
</div>

<div class="form-group row">
<label class="col-sm-3 col-form-label">Phone Number:</label>
<div class="col-sm-9"><?php echo $data->fone2; ?></div>
</div>

<hr/>

<div class="row">
<div class="col-sm-6">
<label class="col-sm-12 col-form-label">Registered By</label>
<div class="col-sm-12"><?php echo $data->admin; ?></div>
</div>

<div class="col-sm-6">
<label class="col-sm-12 col-form-label">Registered Date</label>
<div class="col-sm-12"><?php echo date('D jS F, Y - h:ia',strtotime($data->dated)); ?></div>
</div>
</div>

<?php if(!empty($data->admin2)){ ?>
<hr/>

<div class="row">
<div class="col-sm-6">
<label class="col-sm-12 col-form-label">Updated By</label>
<div class="col-sm-12"><?php echo $data->admin2; ?></div>
</div>
<div class="col-sm-6">
<label class="col-sm-12 col-form-label">Updated Date</label>
<div class="col-sm-12"><?php echo date('D jS F, Y - h:ia',strtotime($data->updated)); ?></div>
</div>
</div>
<?php } ?>
<br/>
<div class="form-group col-sm-12">
  <a href="manage-client" class="btn btn-success" style="cursor:pointer;"> BACK </a>
</div>



    </div>
    </div>
    </div>
</div>



<?php
include('incs/ft.php');

?>