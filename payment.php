<?php
include('incs/hd.php');

$acc= new AccountantDepartment;
$utility= new Utility;

$client= $utility->PullRecord('ledger WHERE status=1');

if(isset($_POST['find'])){
  if($_POST['estate']!='0'){
    $_GET['find']= $_POST['estate'];
  }else{$er= 'ESTATE NAME NOT SELECTED';}
}



?>

<style type="text/css">
label{font-weight:bolder;} 
.undaline{border:none;border-radius:0;border-bottom:1px #ccc solid;background-color:#fff !important;}
.listed{border-bottom:1px #ccc solid;font-weight:bolder;margin-bottom:4px;}
.val{color:green;margin-left:25px;}
</style>

      <div class="page-heading">
                <h1 class="page-title"></h1>
                
              </div>
            
            
  <div class="row">

<?php if(!isset($_GET['Summary']))if(!isset($_GET['search'])){ ?>
  <div class="col-md-12">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Payment Record</div> 
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
      <th>Plot Number</th>
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
    <td><?php echo $val->fname.' '.$val->lname; ?></td>
    <td>
 <a href="?Summary=<?php echo $val->cid; ?>">
  <button class="btn btn-info btn-sm m-r-3" data-toggle="tooltip" data-original-title="Payment Summary" style="cursor:pointer"><i class="fa fa-bars font-14"></i> View Summary</button></a>
      </td>
      </tr>
   <?php }} ?>         
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
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i><?php if(!isset($_GET['find'])){echo 'Search';}else{echo' Payment Record List';} ?></div> 
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

<?php } if(isset($_GET['find'])){  $efind= $utility->PullRecord("ledger WHERE eid='{$_GET['find']}' AND status=1"); ?> 
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
    <td><?php echo $vala->fname.' '.$vala->lname; ?></td>
    <td>

<a href="?Summary=<?php echo $vala->cid; ?>">
  <button class="btn btn-info btn-sm m-r-3" data-toggle="tooltip" data-original-title="Payment Summary" style="cursor:pointer"><i class="fa fa-bars font-14"></i> View Summary</button></a>

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
        
        
<?php }  
 if(isset($_GET['Summary'])){ $data= $utility->Changer("ledger WHERE cid='{$_GET['Summary']}'"); ?>


<div class="col-md-10" id="PrintAgent">       
  <div class="ibox">
    <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> Payment Record Information</div>                                         
  </div>

<div class="ibox-body">
  <div class="col-sm-12 listed">
    <label><i class="fa fa-home"></i> Estate Name: <span class="val"><?php echo $utility->Changer("estates WHERE id='{$data->eid}'")->name; ?></span></label>
  </div>
<div class="col-sm-12 listed">
  <label><i class="fa fa-map"></i> Plot Number: <span class="val"><?php echo $data->plot; ?></span></label>
</div>
<div class="col-sm-12 listed">
  <label><i class="fa fa-object-ungroup"></i> Plot Size: <span class="val"><?php echo $data->plotsize; ?></span></label>
</div>
<div class="col-sm-12 listed">
  <label><i class="fa fa-user-circle"></i> Allotee Name: <span class="val"><?php echo $data->fname.' '.$data->lname; ?></span></label>
</div>
</div>

<div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> First Payment (Land)</div> 
   <div class="ibox-title pull-right"><i class="fa fa-exclamation-circle"></i> First Payment (Annexation)</div>  
</div>
<!-- Payment Summary -->
<div class="ibox-body">

<div class="row">
<div class="col-sm-6">
  <div class="col-sm-12 listed">
    <label><i class="fa fa-money"></i> Sale : <span class="val"><?php echo '&#8358; '.number_format($data->sale,2); ?></span></label>
  </div>
    <div class="col-sm-12 listed">
    <label><i class="fa fa-money"></i> Paid: <span class="val"><?php echo '&#8358; '.number_format($data->paid,2); ?></span></label>
  </div>
    <div class="col-sm-12 listed">
    <label><i class="fa fa-money"></i> Balance: <span class="val"><?php echo '&#8358; '.number_format($data->paid2,2); ?></span></label>
  </div>
</div>
<?php if($data->anexfee>0){?>
  <div class="col-sm-6">
  <div class="col-sm-12 listed">
    <label><i class="fa fa-money"></i> Price: <span class="val"><?php echo '&#8358; '.number_format($data->anexfee,2); ?></span></label>
  </div>
    <div class="col-sm-12 listed">
    <label><i class="fa fa-money"></i> Paid: <span class="val"><?php echo '&#8358; '.number_format($data->anexpaid,2); ?></span></label>
  </div>
    <div class="col-sm-12 listed">
    <label><i class="fa fa-money"></i> Balance: <span class="val"><?php echo '&#8358; '.number_format($data->anexbal,2); ?></span></label>
  </div>
</div>
<?php } ?>
</div>

</div>

<!-- Payment Summary -->
<div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> Installment Payment</div>  
</div>

<div class="ibox-body">


<div class="row">
<div class="col-sm-6">
<label style="border-bottom:1px #ccc solid;"><i class="fa fa-bars"></i> Land History</label>  
  <div class="table-responsive">
  <table class="table table-striped" cellspacing="0">
    <thead>
      <tr style="padding:3px !important;font-size:13px;text-transform:uppercase;">
      <th width="10px">SN</th>
      <th>Date</th>
      <th>Payment</th>
      </tr>
    </thead>
    <tbody>
  <?php $sale= $utility->PullRecord("ledger_balance WHERE cid='{$data->cid}'"); if($sale){
      $a=1; foreach($sale as $key => $vala){ ?>      
    <tr style="padding:3px !important;font-size:12px;">
    <td><?php echo $a++; ?></td>
    <td><?php echo date('d M Y',strtotime($vala->dated)); ?></td>
    <td><?php echo '&#8358; '.number_format($vala->paid2,2); ?></td>
    </tr>
   <?php } } ?> 
   <tr>
    <td></td>
    <td style="font-weight:bolder;">Total Payment</td>
    <td style="font-weight:bolder;"><?php $ak= $acc->FieldCalculation($vala->cid)->emoney; echo '&#8358; '.number_format($ak,2); ?></td>
   </tr>        
      </tbody>
  </table>
</div>
</div>

<?php if($data->anexfee>0){ ?>
<div class="col-sm-6">
  <label style="border-bottom:1px #ccc solid;" class="pull-right"><i class="fa fa-bars"></i> Annexation History</label>
  <div class="table-responsive">
  <table class="table table-striped" cellspacing="0">
    <thead>
      <tr style="padding:3px !important;font-size:13px;text-transform:uppercase;">
      <th width="10px">SN</th>
      <th>Date</th>
      <th>Payment</th>
      </tr>
    </thead>
    <tbody>
<?php $anex= $utility->PullRecord("ledger_balance WHERE cid='{$data->cid}'"); if($anex){
      $a=1; foreach($anex as $key => $vala){ ?>    
    <tr style="padding:3px !important;font-size:12px;">
    <td><?php echo $a++; ?></td>
    <td><?php echo date('d M Y',strtotime($vala->dated)); ?></td>
    <td><?php echo '&#8358; '.number_format($vala->anexbal,2); ?></td>
    </tr>
   <?php } } ?> 
   <tr>
    <td></td>
    <td style="font-weight:bolder;">Total Payment</td>
    <td style="font-weight:bolder;"><?php $ak= $acc->FieldCalculation($vala->cid)->emoney2; echo '&#8358; '.number_format($ak,2); ?></td>
   </tr>        
  </tbody>
  </table>
</div>
</div>
<?php } ?>

</div>
</div>

<!-- Other Payment Summary -->

<div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Other Payments</div>                                         
</div>

<div class="ibox-body">

  <div class="table-responsive">
  <table class="table table-striped" cellspacing="0">
    <thead>
      <tr style="padding:3px !important;font-size:13px;text-transform:uppercase;">
      <th width="10px"></th>
      <th>Title</th>
      <th>Amount</th>
      </tr>
    </thead>
    <tbody style="font-weight:bolder;">
   <tr>
    <td></td>
    <td><i class="fa fa-caret-right"></i> Infrastructural Fee:</td>
    <td><span class="val"><?php echo '&#8358; '.number_format($data->infra,2); ?></span></td>
  </tr>     
   <tr>
    <td></td>
    <td><i class="fa fa-caret-right"></i> Maintenance fee:</td>
    <td><span class="val"><?php echo '&#8358; '.number_format($data->main,2); ?></span></td>
  </tr>
   <tr>
    <td></td>
    <td><i class="fa fa-caret-right"></i> Survey fee:</td>
    <td><span class="val"><?php echo '&#8358; '.number_format($data->survey,2); ?></span></td>
  </tr>
   <tr>
    <td></td>
    <td><i class="fa fa-caret-right"></i> Legal fee:</td>
    <td><span class="val"><?php echo '&#8358; '.number_format($data->legal,2); ?></span></td>
  </tr>
   <tr>
    <td></td>
    <td><i class="fa fa-caret-right"></i> Building fee:</td>
    <td><span class="val"><?php echo '&#8358; '.number_format($data->build,2); ?></span></td>
  </tr>
   <tr>
    <td></td>
    <td><i class="fa fa-caret-right"></i> Fencing fee:</td>
    <td><span class="val"><?php echo '&#8358; '.number_format($data->fence,2); ?></span></td>
  </tr>
   <tr>
    <td></td>
    <td><i class="fa fa-caret-right"></i> Non Refundable fee:</td>
    <td><span class="val"><?php echo '&#8358; '.number_format($data->nonrefund,2); ?></span></td>
  </tr>       
    </tbody>
  </table>

<br/>
<div class="form-group">
    <button class="btn btn-danger" type="none" onclick="print()" style="cursor:pointer;width:135px"><i class="fa fa-print"></i> PRINT </button>

    <a href="payment" class="btn btn-primary pull-right" style="cursor:pointer;width:135px"> CANCEL</a>
</div>

    </div>
      </div>
  </div>

<?php } ?>

   
</div>




<?php
include('incs/ft.php');

?>

<script type="text/javascript">
// var prtContent = document.getElementById("PrintAgent");
// var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
// WinPrint.document.write(prtContent.innerHTML);
// WinPrint.document.close();
// WinPrint.focus();
// WinPrint.print();
// WinPrint.close();
</script>