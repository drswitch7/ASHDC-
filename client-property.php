<?php
include('incs/hd.php');

$est= new EstateManagement;
$utility= new Utility;

$client= $utility->PullRecord('client WHERE status=1');


 if(isset($_POST['send'])){
  if(isset($_POST['alocate'])){ $alo= $_POST['alocate'];}else{$alo='0';}
    if(isset($_POST['lease'])){ $lease= $_POST['lease'];}else{$lease='0';}
      if(isset($_POST['dev'])){ $dev= $_POST['dev'];}else{$dev='0';}
    try{
     $send= $est->UpdateClientReceipt($_POST['receipt'],$_POST['sale'],$_POST['paid'],$_POST['paid2'],$_POST['anexfee'],$_POST['anexpaid'],$_POST['anexbal'],$_POST['refund'],$_POST['infra'],$_POST['main'],$_POST['survey'],$_POST['legal'],$_POST['build'],$_POST['fence'],$_POST['nonrefund'],$_POST['anexrept'],$_POST['infrarept'],$_POST['mainrept'],$_POST['surrept'],$_POST['legrept'],$_POST['buildrept'],$_POST['fencerept'],$_POST['nonrept'],
     $alo,$lease,$dev,$_POST['cid']);
    }catch(Exception $e){$er= $e->getMessage(); }
 }

if(isset($_POST['find'])){
  if($_POST['estate']!='0'){
    $_GET['find']= $_POST['estate'];
  }else{$er= 'ESTATE NAME NOT SELECTED';}
}


?>

<style type="text/css">
label{font-weight:bolder;} 
.undaline{border:none;border-radius:0;border-bottom:1px #ccc solid;background-color:#fff !important;}
</style>

			<div class="page-heading">
      <h1 class="page-title"></h1>
      </div>
            
            
  <div class="row">

<?php if(!isset($_GET['Cross-check'])) if(!isset($_GET['search'])){ ?>
  <div class="col-md-12">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Manage Client Property</div>    

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
      <th>Mobile No</th>
      <th>Date</th>
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
    <td><?php echo $val->fname.' '.$val->lname; ?></td>
    <td><?php echo $val->fone; ?></td>
    <td><?php echo date('d M, Y',strtotime($val->dated)); ?></td>
    <td>

<a href="?Cross-check=<?php echo $val->cid; ?>">
  <button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Cross-Check Client Receipts" style="cursor:pointer"><i class="fa fa-check-square font-12"></i></button></a>

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
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> Search Property</div> 
  <div class="ibox-tools">
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

<?php } if(isset($_GET['find'])){  $efind= $utility->PullRecord("client WHERE eid='{$_GET['find']}' AND status=1"); ?> 
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
      <th>Mobile No</th>
      <th>Date</th>
      <th>Action</th>
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
    <td><?php echo $vala->fname.' '.$vala->lname; ?></td>
    <td><?php echo $vala->fone; ?></td>
    <td><?php echo date('d M, Y',strtotime($vala->dated)); ?></td>
    <td>

<a href="?Cross-check=<?php echo $vala->cid; ?>">
  <button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Cross-Check Client Receipts" style="cursor:pointer"><i class="fa fa-check-square font-12"></i></button></a>

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
        
<?php } if(isset($_GET['Cross-check'])){ 
  $data= $utility->Changer("ledger WHERE cid='{$_GET['Cross-check']}'");
  $dat= $utility->Changer("client_receipt WHERE cid='{$_GET['Cross-check']}'");
  $data2= $utility->Changer("client WHERE cid='{$_GET['Cross-check']}'")
  ?>


<div class="col-md-10">       
  <div class="ibox">
    <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> Client Information <small style="color:red">(Not Editable)</small></div><div class="ibox-tools">
  <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
  </div>                                           
  </div>


<div class="ibox-body">
<div class="form-group">
    <label>Estate Name</label>
    <input class="form-control undaline" name="estate" type="text" value="<?php if($data){echo $utility->Changer("estates WHERE id='{$data->eid}'")->name;}else{echo $utility->Changer("estates WHERE id='{$data2->eid}'")->name;} ?>" readonly>
</div>

<div class="row">

<div class="col-sm-6 form-group">
    <label>Plot Number</label>
    <input class="form-control undaline" name="plot" type="text" value="<?php if($data){echo $data->plot;}else{echo $data2->plot;} ?>" readonly>
</div>

<div class="col-sm-6 form-group">
    <label>Plot Size</label>
    <input class="form-control undaline" name="size" type="text" value="<?php if($data){echo $data->plotsize;}else{echo $data2->plotsize;} ?>" readonly>
</div>

</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>First Name of Allotee</label>
<input class="form-control undaline" type="text" name="fname" value="<?php if($data){echo $data->fname;}else{echo $data2->fname;} ?>" readonly>
</div>
<div class="col-sm-6 form-group">
<label>Last Name of Allotee</label>
<input class="form-control undaline" type="text" name="lname" value="<?php if($data){echo $data->lname;}else{echo $data2->lname;} ?>" readonly>
</div>
</div>
</div>

<hr/>
<div class="ibox-head">
  <div class="ibox-title">
    <?php if($data){ echo '<i class="fa fa-bars"></i> Cross Check Client Receipts</div>';}else{echo '<i class="fa fa-exclamation-circle text-danger"></i> <span class="text-danger">Client Receipts not Available</span> </div>';} ?>
   <?php if(empty($data)){ echo '<a href="client-property" class="btn btn-primary pull-right">CANCEL</a>';} ?>   
  </div>


<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="client-property";},2000);});</script>';} 
?>                                
</div>

<div class="ibox-body">

<?php if($data){ ?>

  <form action="" method="POST">
<div class="row">

<div class="col-sm-3 form-group">
    <label>Selling Price</label>
    <input class="form-control undaline" name="sale" value="<?php echo $data->sale; ?>" readonly>
</div>

<div class="col-sm-3 form-group">
<label>Amount Paid</label>
  <input class="form-control undaline" name="paid" value="<?php echo $data->paid; ?>" readonly>
</div>
<div class="col-sm-3 form-group">
<label>Available Balance</label>
  <input class="form-control undaline" name="paid2" readonly value="<?php echo $data->paid2; ?>">
</div>

<div class="col-sm-3 form-group">
    <label>Paid Receipt No</label>
    <input class="form-control undaline" name="receipt" type="text" value="<?php echo $data->receipt; ?>" readonly>
</div>
</div>

<div class="row">
<div class="col-sm-3 form-group">
<label>Annexation Fee</label>
<input class="form-control undaline" name="anexfee" readonly value="<?php echo $data->anexfee; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Annexation Paid</label>
<input class="form-control undaline" name="anexpaid" readonly value="<?php echo $data->anexpaid; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Annexation Balance</label>
<input class="form-control undaline" name="anexbal" readonly value="<?php echo $data->anexbal; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Annexation Receipt No</label>
<input class="form-control undaline" name="anexrept" type="text" value="<?php echo $data->anexrept; ?>" readonly>
</div>
</div>

<div class="row">
<div class="col-sm-3 form-group">
<label>Infrastructural Fee</label>
<input class="form-control undaline" name="infra" readonly value="<?php echo $data->infra; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Infrastructural Receipt No</label>
<input class="form-control undaline" name="infrarept" type="text" value="<?php echo $data->infrarept; ?>" readonly>
</div>
<div class="col-sm-3 form-group">
<label>Maintenance fee</label>
<input class="form-control undaline" name="main" readonly value="<?php echo $data->main; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Maintenance Receipt No</label>
<input class="form-control undaline" name="mainrept" type="text" value="<?php echo $data->mainrept; ?>" readonly>
</div>
</div>

<div class="row">
<div class="col-sm-3 form-group">
<label>Survey Fee</label>
<input class="form-control undaline" type="number" name="survey" readonly value="<?php echo $data->survey; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Survey Receipt No</label>
<input class="form-control undaline" name="surrept" type="text" value="<?php echo $data->surrept; ?>" readonly>
</div>
<div class="col-sm-3 form-group">
<label>Legal Fee</label>
<input class="form-control undaline" type="number" name="legal" readonly value="<?php echo $data->legal; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Legal Receipt No</label>
<input class="form-control undaline" name="legrept" type="text" value="<?php echo $data->legrept; ?>" readonly>
</div>
</div>

<div class="row">
<div class="col-sm-3 form-group">
<label>Building Fee</label>
<input class="form-control undaline" type="number" name="build" readonly value="<?php echo $data->build; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Building Receipt No</label>
<input class="form-control undaline" name="buildrept" type="text" value="<?php echo $data->buildrept; ?>" readonly>
</div>
<div class="col-sm-3 form-group">
<label>Fencing Fee</label>
<input class="form-control undaline" type="number" name="fence" readonly value="<?php echo $data->fence; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Fencing Receipt No</label>
<input class="form-control undaline" name="fencerept" type="text" value="<?php echo $data->fencerept; ?>" readonly>
</div>
</div>

<div class="row">

<div class="col-sm-4 form-group">
<label>Non Refundable Fee</label>
<input class="form-control undaline" type="number" name="nonrefund" readonly value="<?php echo $data->nonrefund; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Non Refundable Receipt No</label>
<input class="form-control undaline" name="nonrept" type="text" value="<?php echo $data->nonrept; ?>" readonly>
</div>
<div class="col-sm-4 form-group">
<label>Refundable Amount</label>
<input class="form-control undaline" name="refund" readonly value="<?php echo $data->refund; ?>">
</div>
</div>


<div class="row">
  <div class="col-sm-6 form-group">
    <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" value="1" name="alocate" <?php if($dat){if($dat->alocate==1){echo 'checked';}} ?>>
  <span class="input-span"></span> <b>Allocation Paper</b></label>
  </div>

  <div class="col-sm-6 form-group">
    <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" value="1" name="lease" <?php if($dat){if($dat->lease==1){echo 'checked';}} ?>>
  <span class="input-span"></span> <b>Legal/ Lease Agreement</b> </label>
  </div>
</div>

<div class="row">

  <div class="col-sm-6 form-group">
    <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" value="1" name="dev" <?php if($dat){if($dat->dev==1){echo 'checked';}} ?>>
  <span class="input-span"></span> <b>Development Approval Paper</b> </label>
  </div>

</div>

<div class="form-group">
  <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" required>
  <span class="input-span"></span> <b> Confirm Receipt before updating client record</b></label>
</div>

<div class="form-group">
  <input type="hidden" name="cid" value="<?php echo $_GET['Cross-check']; ?>">
    <button class="btn btn-success" type="submit" name="send" style="cursor:pointer;width:135px"> UPDATE RECORD</button>

    <a href="client-property" class="btn btn-primary pull-right"> CANCEL</a>
</div>

    </form>
<?php } ?>

    </div>
      </div>
  </div>



<?php }  ?>

   
</div>




<?php
include('incs/ft.php');

?>