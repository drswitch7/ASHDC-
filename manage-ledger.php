<?php
include('incs/hd.php');

$acc= new AccountantDepartment;
$utility= new Utility;

$client= $utility->PullRecord('ledger WHERE status=1');

 if(isset($_POST['update'])){
  if($_POST['receipt']!='0'){
    if($_POST['sale']!=''){
      if($_POST['paid']!=''){
        if($_POST['paid2']!=''){
        if(isset($_POST['cert'])){$cert= $_POST['cert'];}else{$cert='0';}
          if(isset($_POST['document'])){$document= $_POST['document'];}else{$document='0';}
    try{
     $send= $acc->AddLedgerRecord($_POST['receipt'],$_POST['sale'],$_POST['paid'],$_POST['paid2'],$_POST['anexfee'],$_POST['anexpaid'],$_POST['anexbal'],$_POST['refund'],$_POST['infra'],$_POST['main'],$_POST['survey'],$_POST['legal'],$document,$_POST['build'],$_POST['fence'],$_POST['nonrefund'],$cert,$_POST['anexrept'],$_POST['infrarept'],$_POST['mainrept'],$_POST['surrept'],$_POST['legrept'],$_POST['buildrept'],$_POST['fencerept'],$_POST['nonrept'],'',$_POST['cid']);
    }catch(Exception $e){$er= $e->getMessage(); }
       }else{$er='Available Balance is Required';}
      }else{$er='Amount Paid is required';}
      }else{$er='Selling Price is Required';}
    }else{$er='Receipt Number is Required';}
 }


if(isset($_POST['bal'])){
  if($_POST['paid2']!=''){
    if($_POST['receipt']!=''){
      try{
$send= $acc->PaidDepthBalance($_POST['sale'],$_POST['paid'],$_POST['paid2'],$_POST['receipt'],$_POST['anexfee'],$_POST['anexpaid'],$_POST['anexbal'],$_POST['anexrept'],$_POST['cid']);
  }catch(Exception $e){$er= $e->getMessage(); }
    }else{$er='Receipt No is Required';}
  }else{$er='Available Balance is Required';}
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

<?php if(!isset($_GET['update']))if(!isset($_GET['balance-up'])){ ?>
  <div class="col-md-12">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Manage Ledger</div>                                         
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
    <td><?php echo date('d M, Y',strtotime($val->dated)); ?></td>
    <td>
      <a href="?update=<?php echo $val->cid; ?>"><button class="btn btn-primary btn-xs m-r-3" data-toggle="tooltip" data-original-title="Edit Information" style="cursor:pointer"><i class="fa fa-edit font-12"></i></button></a>

			</td>
			</tr>
   <?php }} ?>         
      </tbody>
	</table>
		</div>
        </div>
  </div>
</div>               
        
<?php }  
 if(isset($_GET['update'])){ $data= $utility->Changer("ledger WHERE cid='{$_GET['update']}'"); ?>


<div class="col-md-10">       
  <div class="ibox">
    <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> Client Information <small style="color:red">(Not Editable)</small></div>                                         
  </div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['update']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="'.$_SERVER['PHP_SELF'].'";},1500);});</script>';} 
?>                                
</div>

<div class="ibox-body">
<div class="form-group">
    <label>Estate Name</label>
    <input class="form-control undaline" name="estate" type="text" value="<?php echo $utility->Changer("estates WHERE id='{$data->eid}'")->name; ?>" readonly>
</div>

<div class="row">

<div class="col-sm-6 form-group">
    <label>Plot Number</label>
    <input class="form-control undaline" name="plot" type="text" value="<?php echo $data->plot; ?>" readonly>
</div>

<div class="col-sm-6 form-group">
    <label>Plot Size</label>
    <input class="form-control undaline" name="size" type="text" value="<?php echo $data->plotsize; ?>" readonly>
</div>

</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>Allotee First Name</label>
<input class="form-control undaline" type="text" name="fname" value="<?php echo $data->fname; ?>" readonly>
</div>
<div class="col-sm-6 form-group">
<label>Allotee Last Name</label>
<input class="form-control undaline" type="text" name="lname" value="<?php echo $data->lname; ?>" readonly>
</div>
</div>
</div>

<hr/>
<div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-edit"></i> Edit Client Ledger</div>                                         
  </div>


<div class="ibox-body">
  <form action="" method="POST">

<div class="row">

<div class="col-sm-3 form-group">
    <label>Selling Price</label>
    <input class="form-control" name="sale" type="number" placeholder="Enter Selling Price" autocomplete="off" required value="<?php echo $data->sale; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Amount Paid</label>
  <input class="form-control" name="paid" type="number" placeholder="Enter Amount Paid" autocomplete="off" required value="<?php echo $data->paid; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Available Balance</label>
  <input class="form-control" name="paid2" type="number" placeholder="Enter Available Balance" autocomplete="off" value="<?php echo $data->paid2; ?>">
</div>
<div class="col-sm-3 form-group">
    <label>Receipt No</label>
    <input class="form-control" name="receipt" type="text" placeholder="Enter Receipt No" autocomplete="off" required value="<?php echo $data->receipt; ?>">
</div>
</div>

<div class="row">
<div class="col-sm-3 form-group">
<label>Annexation Fee</label>
<input class="form-control" type="number" name="anexfee" placeholder="Enter Annexation Fee" autocomplete="off" value="<?php echo $data->anexfee; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Annexation Paid</label>
<input class="form-control" type="number" name="anexpaid" placeholder="Enter Annexation Paid" autocomplete="off" value="<?php echo $data->anexpaid; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Annexation Balance</label>
<input class="form-control" type="number" name="anexbal" placeholder="Enter Annexation Balance" autocomplete="off" value="<?php echo $data->anexbal; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Annexation Receipt No</label>
<input class="form-control" name="anexrept" type="text" placeholder="Enter Annexation Receipt No" autocomplete="off" value="<?php echo $data->anexrept; ?>">
</div>
</div>

<div class="row">
<div class="col-sm-3 form-group">
<label>Infrastructural Fee</label>
<input class="form-control" type="number" name="infra" placeholder="Enter Infrastructural Fee" autocomplete="off" value="<?php echo $data->infra; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Infrastructural Receipt No</label>
<input class="form-control" name="infrarept" type="text" placeholder="Enter Infrastructural Receipt No" autocomplete="off" value="<?php echo $data->infrarept; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Maintenance fee</label>
<input class="form-control" type="number" name="main" placeholder="Enter Maintenance Fee" autocomplete="off" value="<?php echo $data->main; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Maintenance Receipt No</label>
<input class="form-control" name="mainrept" type="text" placeholder="Enter Maintenance Receipt No" autocomplete="off" value="<?php echo $data->mainrept; ?>">
</div>
</div>

<div class="row">
<div class="col-sm-3 form-group">
<label>Survey Fee</label>
<input class="form-control" type="number" name="survey" placeholder="Enter Survey Fee" autocomplete="off" value="<?php echo $data->survey; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Survey Receipt No</label>
<input class="form-control" name="surrept" type="text" placeholder="Enter Survey Receipt No" autocomplete="off" value="<?php echo $data->surrept; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Legal Fee</label>
<input class="form-control" type="number" name="legal" placeholder="Enter Legal Fee" autocomplete="off" value="<?php echo $data->legal; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Legal Receipt No</label>
<input class="form-control" name="legrept" type="text" placeholder="Enter Legal Receipt No" autocomplete="off" required value="<?php echo $data->legrept; ?>">
</div>
</div>

<div class="row">
<div class="col-sm-3 form-group">
<label>Building Fee</label>
<input class="form-control" type="number" name="build" placeholder="Enter Building Fee" autocomplete="off" value="<?php echo $data->build; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Building Receipt No</label>
<input class="form-control" name="buildrept" type="text" placeholder="Enter Building Receipt No" autocomplete="off" required value="<?php echo $data->buildrept; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Fencing Fee</label>
<input class="form-control" type="number" name="fence" placeholder="Enter Fencing Fee" autocomplete="off" value="<?php echo $data->fence; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Fencing Receipt No</label>
<input class="form-control" name="fencerept" type="text" placeholder="Enter Fencing Receipt No" autocomplete="off" required value="<?php echo $data->fencerept; ?>">
</div>
</div>

<div class="row">
 <div class="col-sm-4 form-group">
<label>Non Refundable Fee</label>
<input class="form-control" type="number" name="nonrefund" placeholder="Enter Non Refundable Fee" autocomplete="off" value="<?php echo $data->nonrefund; ?>">
</div> 
<div class="col-sm-4 form-group">
<label>Non Refundable Receipt No</label>
<input class="form-control" name="nonrept" type="text" placeholder="Enter Non Refundable Receipt No" autocomplete="off" required value="<?php echo $data->nonrept; ?>">
</div>
 <div class="col-sm-4 form-group">
<label>Refundable Amount</label>
<input class="form-control" type="number" name="refund" placeholder="Enter Refundable Amount" autocomplete="off" value="<?php echo $data->refund; ?>">
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
  <div class="col-sm-10">
    <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" value="1" name="cert" required <?php if($data->cert==1){echo 'checked';} ?>>
  <span class="input-span"></span> Certified True Copy</label>
  </div>
</div>

<div class="col-sm-6 form-group">
  <div class="col-sm-10">
    <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" value="1" name="document" required <?php if($data->document==1){echo 'checked';} ?>>
  <span class="input-span"></span> Title Document</label>
  </div>
</div>
</div>
<br/>
<div class="form-group">
  <input type="hidden" name="cid" value="<?php echo $_GET['update']; ?>">
    <button class="btn btn-success" type="submit" name="update" style="cursor:pointer;width:135px"> UPDATE</button>

    <a href="manage-ledger" class="btn btn-danger pull-right" style="cursor:pointer;width:135px"> CANCEL</a>
</div>

    </form>

    </div>
      </div>
  </div>

<?php } ?>


<?php if(isset($_GET['balance-up'])){ 
  $bal= $utility->Changer("ledger WHERE cid='{$_GET['balance-up']}'");
    $txt= $acc->FieldCalculation($_GET['balance-up']);
?>

<div class="col-md-10">       
  <div class="ibox">
    <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> Client Information <small style="color:red">(Not Editable)</small></div>                                         
  </div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['bal']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="ledger";},1500);});</script>';} 
?>                                
</div>

<div class="ibox-body">
<div class="form-group">
    <label>Estate Name</label>
    <input class="form-control undaline" name="estate" type="text" value="<?php echo $utility->Changer("estates WHERE id='{$bal->eid}'")->name; ?>" readonly>
</div>

<div class="row">

<div class="col-sm-6 form-group">
    <label>Plot Number</label>
    <input class="form-control undaline" name="plot" type="text" value="<?php echo $bal->plot; ?>" readonly>
</div>

<div class="col-sm-6 form-group">
    <label>Plot Size</label>
    <input class="form-control undaline" name="size" type="text" value="<?php echo $bal->plotsize; ?>" readonly>
</div>

</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>Allotee First Name</label>
<input class="form-control undaline" type="text" name="fname" value="<?php echo $bal->fname; ?>" readonly>
</div>
<div class="col-sm-6 form-group">
<label>Allotee Last Name</label>
<input class="form-control undaline" type="text" name="lname" value="<?php echo $bal->lname; ?>" readonly>
</div>
</div>
</div>

<hr/>
<div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-edit"></i> Balance Up Ledger</div>                                         
  </div>


<div class="ibox-body">
  <form action="" method="POST">

<div class="row">
<div class="col-sm-3 form-group">
    <label>Selling Price</label>
    <input class="form-control undaline" readonly value="<?php echo $bal->sale; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Amount Paid</label>
  <input class="form-control undaline" readonly value="<?php if($txt->emoney!=''){echo $txt->emoney+$txt->paid;}else{echo $bal->paid;} ?>">
</div>
<div class="col-sm-3 form-group">
<label>Paid Balance</label>
  <input class="form-control" name="paid2" type="number" placeholder="Your Balance <?php if($txt->emoney!=''){
    $sub= $txt->emoney+$txt->paid; echo $txt->sale-$sub;}else{echo round($bal->sale-$bal->paid);} ?>" autocomplete="off" required value="<?php if(isset($_POST['bal'])){echo $_POST['paid2'];} ?>">
</div>
<div class="col-sm-3 form-group">
    <label>Receipt No</label>
    <input class="form-control" name="receipt" type="text" placeholder="Enter Receipt No" autocomplete="off" required value="<?php if(isset($_POST['bal'])){echo $_POST['receipt'];} ?>">
</div>
</div>


<div class="row">

<div class="col-sm-3 form-group">
    <label>Annexation Fee</label>
  <input class="form-control undaline" readonly value="<?php echo $bal->anexfee; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Amount Paid</label>
  <input class="form-control undaline" readonly value="<?php if($txt->emoney2!=''){echo $txt->emoney2+$txt->anexpaid;}else{echo $bal->anexpaid;} ?>">
</div>
<div class="col-sm-3 form-group">
<label>Paid Balance</label>
  <input class="form-control" text="number" name="anexbal" 
  placeholder="Your Balance <?php if($txt->emoney2!=''){$suba= $txt->emoney2+$txt->anexpaid; echo round($txt->anexfee-$suba);}else{echo round($bal->anexfee-$bal->anexpaid);} ?>" autocomplete="off" value="<?php if(isset($_POST['bal'])){echo $_POST['anexbal'];} ?>">
</div>
<div class="col-sm-3 form-group">
    <label>Annexation Receipt No</label>
    <input class="form-control" name="anexrept" type="text" placeholder="Enter Annexation Receipt No" autocomplete="off" value="<?php if(isset($_POST['bal'])){echo $_POST['anexrept'];} ?>">
</div>
</div>


<br/>
<div class="form-group">
  <input type="hidden" name="cid" value="<?php echo $_GET['balance-up']; ?>">
  <input type="hidden" name="sale" value="<?php echo $bal->sale; ?>">
  <input type="hidden" name="paid" value="<?php echo $bal->paid; ?>">
  <input type="hidden" name="anexfee" value="<?php echo $bal->anexfee; ?>">
  <input type="hidden" name="anexpaid" value="<?php echo $bal->anexpaid; ?>">
    <button class="btn btn-success" type="submit" name="bal" style="cursor:pointer;width:135px"> PAY BALANCE</button>

    <a href="ledger" class="btn btn-danger pull-right" style="cursor:pointer;width:135px"> CANCEL</a>
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