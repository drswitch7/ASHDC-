<?php
include('incs/hd.php');

$acc= new AccountantDepartment;
$utility= new Utility;

$client= $utility->PullRecord('client WHERE status=1');


if(isset($_POST['send'])){
  if($_POST['year']!='0'){
    if($_POST['amt']!=''){
    try{
     $send= $acc->AddGroundRent($_POST['year'],$_POST['amt'],$_POST['pen'],'',$_POST['cid']);
    }catch(Exception $e){$er= $e->getMessage(); }
      }else{$er='Amount Paid is Required';}
    }else{$er='Ground Year is Required';}
 } 


if(isset($_GET['anc'])&& isset($_GET['act'])){
  $utility->Operation($_GET['anc'],$_GET['act'],'client_groundrent');
}


?>

<style type="text/css">
label{font-weight:bolder;}
.drp{cursor:pointer;padding:3px 6px;}
</style>

			<div class="page-heading">
                <h1 class="page-title"></h1>
                
            	</div>
            
            
  <div class="row">

<?php if(!isset($_GET['client'])){ ?>
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
	  	$a=1; foreach($client as $key => $val){ $cname= ucwords($val->fname.' '.$val->lname); ?>      
    <tr>
    <td><?php echo $a++; ?></td>
    <td><?php echo $utility->Changer("estates WHERE id='$val->eid'")->name; ?></td>
    <td><?php echo $val->plot; ?></td>
    <td><?php echo $val->plotsize; ?></td>
    <td><?php echo $cname; ?></td>
    <td><?php echo $val->fone; ?></td>
    <td>
<a href="?client=<?php echo $val->cid; ?>"><button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="View Ground Rent" style="cursor:pointer"><i class="fa fa-eye font-13"></i></button></a>

			</td>
			</tr>
   <?php } }else{echo 'No row found';} ?>         
      </tbody>
	</table>
		</div>
        </div>
  </div>
</div>  

<?php } if(isset($_GET['client'])) if(!isset($_GET['sid'])){ 
  $list= $utility->PullRecord("client_groundrent WHERE cid='{$_GET['client']}' AND status=1"); 
  $name= $utility->Changer("client WHERE cid='{$_GET['client']}'");
   ?>

 <div class="col-md-8">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Allotee Information </div>                                         
  </div>    

    <div class="ibox-body">
      <label><i class="fa fa-home"></i> Estate Name: <span style="color:green"><?php echo ucwords($utility->Changer("estates WHERE id='$name->eid'")->name); ?></span></label><br/>
      <label><i class="fa fa-map-o"></i> Plot Number: <span style="color:green"><?php echo $name->plot; ?></span></label><br/>
      <label><i class="fa fa-user"></i> Allotee Name: <span style="color:green"><?php echo ucwords($name->fname.' '.$name->lname); ?></span></label>

    </div>

  </div>
</div>



  <div class="col-md-8">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Ground Rent</div> 

   
  <div class="ibox-title pull-right"><i class="fa fa-times-circle"></i> <a href="manage-ground-rent"> Cancel </a></div>                                         
  </div>
                            

                 
    <div class="ibox-body">
        <div class="table-responsive">
  <table class="table table-striped table-bordered" id="example-table" cellspacing="0">
    <thead>
      <tr>
      <th width="20px">SN</th>
      <th>Year</th>
      <th>Amount Paid</th>
      <th>Penalty</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>
  <?php if($list){
      $a=1; foreach($list as $key => $val){ ?>      
    <tr>
    <td><?php echo $a++; ?></td>
    <td><?php echo $val->cyear; ?></td>
    <td><?php echo '&#8358; '.number_format($val->amt); ?></td>
    <td><?php echo '&#8358; '.number_format($val->pen); ?></td>
    <td>
<a href="?client=<?php echo $val->cid; ?>&sid=<?php echo $val->id; ?>&<?php echo $val->cyear; ?>"><button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Edit Row" style="cursor:pointer"><i class="fa fa-edit font-13"></i></button></a>
<a href="?anc=<?php echo $val->id; ?>&act=0&sn=<?php echo uniqid(); ?>"><button class="btn btn-danger btn-xs m-r-3" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer"><i class="fa fa-trash font-12"></i></button></a>
      </td>
      </tr>
   <?php } }else{echo 'No row found';} ?>         
      </tbody>
  </table>
    </div>
        </div>
  </div>
</div>             
        
<?php } if(isset($_GET['sid'])){ 
  $data= $utility->Changer("client_groundrent WHERE id='{$_GET['sid']}'"); 
  $name= $utility->Changer("client WHERE cid='{$data->cid}'");
  ?>


 <div class="col-md-8">       
  <div class="ibox">  
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Allotee Information </div>                                         
  </div>    

    <div class="ibox-body">
      <label><i class="fa fa-home"></i> Estate Name: <span style="color:green"><?php echo ucwords($utility->Changer("estates WHERE id='$name->eid'")->name); ?></span></label><br/>
      <label><i class="fa fa-map-o"></i> Plot Number: <span style="color:green"><?php echo $name->plot; ?></span></label><br/>
      <label><i class="fa fa-user"></i> Allotee Name: <span style="color:green"><?php echo ucwords($name->fname.' '.$name->lname); ?></span></label>

    </div>

  </div>
</div>


<div class="col-md-10">       
  <div class="ibox">
<div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Manage Ground Rent</div>                                         
  </div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="manage-ground-rent?client='.$data->cid.'";},1500);});</script>';} 
?>                                
</div>

<div class="ibox-body">

  <form action="" method="POST">
<div class="row">

<div class="col-sm-4 form-group">
    <label>Select Year</label>
<select class="form-control drp" name="year" title="Select Year">
  <option value="<?php echo $data->cyear; ?>"><?php echo $data->cyear; ?></option>
  <?php $utility->DropdownYear(2000,date('Y')+1); ?>    
</select> 
</div>

<div class="col-sm-4 form-group">
    <label>Amount Paid</label>
    <input class="form-control" name="amt" type="number" placeholder="Enter Amount Paid" autocomplete="off" required value="<?php echo $data->amt; ?>">
</div>

<div class="col-sm-4 form-group">
    <label>Penalty Paid</label>
    <input class="form-control" name="pen" type="number" placeholder="Enter Penalty Paid" autocomplete="off" value="<?php echo $data->pen; ?>">
</div>

</div>


<div class="form-group">
  <input type="hidden" name="cid" value="<?php echo $_GET['sid']; ?>">
    <button class="btn btn-success" type="submit" name="send" style="cursor:pointer;font-weight:bolder;"> UPDATE </button>
    <a href="?client=<?php echo $data->cid; ?>" class="btn btn-danger pull-right" style="cursor:pointer;font-weight:bolder;"> CANCEL </a>
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