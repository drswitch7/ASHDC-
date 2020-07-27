<?php
include('incs/hd.php');

$log= new EstateManagement;
$utility= new Utility;

$client= $utility->PullRecord('client WHERE status=1');

if(isset($_GET['anc'])&& isset($_GET['act'])){
	$utility->Operation($_GET['anc'],$_GET['act'],'client');
}



if(isset($_POST['find'])){
  if($_POST['estate']!='0'){
    $_GET['find']= $_POST['estate'];
  }else{$er= 'ESTATE NAME NOT SELECTED';}
}


?>


			<div class="page-heading">
                <h1 class="page-title"></h1>
                
            	</div>
            
            
  <div class="row">

 <?php if(!isset($_GET['search'])){ ?>
   
  <div class="col-md-12">       
  <div class="ibox">
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Manage Client Record</div>   
   <div class="ibox-tools">
  <a href="?search" class="btn btn-link" style="text-decoration:none;font-weight:bolder;"><i class="fa fa-search" title="Search by Estate"></i> Search by Estate </a>
  <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
  </div>                                   
  </div>
                            

                 
		<div class="ibox-body">
        <div class="table-responsive">
	<table class="table table-striped table-bordered" id="example-table" cellspacing="0">
		<thead>
			<tr style="font-size:12px;text-transform:uppercase;">
      <th width="10px">SN</th>
			<th>Estate</th>
      <th>Plot No</th>
      <th>Plot Size</th>
      <th>Allotee Name</th>
      <th>State/ LGA</th>
      <th>Mobile No</th>
      <th>Date</th>
      <th>Action</th>
      </tr>
    </thead>
		<tbody>
  <?php if($client){
	  	$a=1; foreach($client as $key => $val){ ?>      
    <tr style="font-size:13px;">
    <td><?php echo $a++; ?></td>
    <td><?php echo $utility->Changer("estates WHERE id='$val->eid'")->name; ?></td>
    <td><?php echo $val->plot; ?></td>
    <td><?php echo $val->plotsize; ?></td>
    <td><?php echo $val->fname.' '.$val->lname; ?></td>
    <td><?php echo $utility->Changer("state WHERE id='$val->state'")->state; ?><br/>
      <small><?php echo $utility->Changer("lga WHERE id='$val->lga'")->lganame; ?></small>
    </td>
    <td><?php echo $val->fone; ?></td>
    <td><?php echo date('d M, Y',strtotime($val->dated)); ?></td>
    <td>
<a href="client-info?plot=<?php echo $val->cid; ?>"><button class="btn btn-success btn-xs m-r-2" data-toggle="tooltip" data-original-title="Edit Plot Details" style="cursor:pointer"><i class="fa fa-edit font-12"></i></button></a>
<a href="client-info?edit=<?php echo $val->cid; ?>"><button class="btn btn-info btn-xs m-r-2" data-toggle="tooltip" data-original-title="Edit" style="cursor:pointer"><i class="fa fa-pencil font-12"></i></button></a>
<a href="?anc=<?php echo $val->id; ?>&act=0&sn=<?php echo uniqid(); ?>"><button class="btn btn-danger btn-xs m-r-2" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer"><i class="fa fa-trash font-12"></i></button></a>
<a href="client-detail?info=<?php echo $val->cid; ?>&Information=<?php echo uniqid(); ?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Information" style="cursor:pointer"><i class="fa fa-eye font-12"></i></button></a>
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
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i> Manage Client Record</div>  
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
<a href="client-info?plot=<?php echo $vala->cid; ?>"><button class="btn btn-success btn-xs m-r-2" data-toggle="tooltip" data-original-title="Edit Plot Details" style="cursor:pointer"><i class="fa fa-edit font-12"></i></button></a>
<a href="client-info?edit=<?php echo $vala->cid; ?>"><button class="btn btn-info btn-xs m-r-2" data-toggle="tooltip" data-original-title="Edit" style="cursor:pointer"><i class="fa fa-pencil font-12"></i></button></a>
<a href="?anc=<?php echo $vala->id; ?>&act=0&sn=<?php echo uniqid(); ?>"><button class="btn btn-danger btn-xs m-r-2" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer"><i class="fa fa-trash font-12"></i></button></a>
<a href="client-detail?info=<?php echo $vala->cid; ?>&Information=<?php echo uniqid(); ?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Information" style="cursor:pointer"><i class="fa fa-eye font-12"></i></button></a>  

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
        
<?php }  ?>

</div>




<?php include('incs/ft.php');  ?>


