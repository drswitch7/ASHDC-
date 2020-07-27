<?php
include('incs/hd.php');

$acc= new AccountantDepartment;
$utility= new Utility;

$client= $utility->PullRecord('client WHERE status=1');


if(isset($_POST['send'])){
  if($_POST['year']!='0'){
    if($_POST['amt']!=''){
    try{
     $send= $acc->AddGroundRent($_POST['year'],$_POST['amt'],$_POST['pen'],$_POST['cid']);
    }catch(Exception $e){$er= $e->getMessage(); }
      }else{$er='Amount Paid is Required';}
    }else{$er='Ground Year is Required';}
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

<?php if(!isset($_GET['add'])){ ?>
  <div class="col-md-12">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Ground Rent</div>                                         
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
      <th>Mobile Number</th>
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
    <td>
<a href="?add=<?php echo $val->cid; ?>"><button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Add Ground Rent" style="cursor:pointer"><i class="fa fa-plus-square font-13"></i></button></a>
			</td>
			</tr>
   <?php } }else{echo 'No row found';} ?>         
      </tbody>
	</table>
		</div>
        </div>
  </div>
</div>               
        
<?php } if(isset($_GET['add'])){ $data= $utility->Changer("client WHERE cid='{$_GET['add']}'"); ?>

<div class="col-md-10">       
  <div class="ibox">
    <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> Client Information <small style="color:red">(Not Editable)</small></div>                                         
  </div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="ground-rent";},2000);});</script>';} 
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
  <div class="ibox-title"><i class="fa fa-plus-square"></i> Add Ground Rent</div>                                         
  </div>


<div class="ibox-body">

  <form action="" method="POST">
<div class="row">

<div class="col-sm-4 form-group">
    <label>Select Year</label>
<select class="form-control drp" name="year" title="Select Year">
  <?php $utility->DropdownYear(1976,date('Y')+5); ?>    
</select> 
</div>

<div class="col-sm-4 form-group">
    <label>Amount Paid</label>
    <input class="form-control" name="amt" type="number" placeholder="Enter Amount Paid" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['amt'];} ?>">
</div>

<div class="col-sm-4 form-group">
    <label>Penalty Paid</label>
    <input class="form-control" name="pen" type="number" placeholder="Enter Penalty Paid" autocomplete="off" value="<?php if(isset($_POST['send'])){ echo $_POST['pen'];} ?>">
</div>

</div>


<div class="form-group">
  <input type="hidden" name="cid" value="<?php echo $_GET['add']; ?>">
    <button class="btn btn-success" type="submit" name="send" style="cursor:pointer;font-weight:bolder;"> SUBMIT</button>
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