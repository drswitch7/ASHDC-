<?php
include('incs/hd.php');

$add= new Administrator;
$utility= new Utility;



if(isset($_GET['anc'])&& isset($_GET['act'])){
	$utility->Operation($_GET['anc'],$_GET['act'],'admin');
}

?>


<div class="page-heading">
<h1 class="page-title"></h1>             
</div>
            
            
<div class="row">
<div class="col-md-9">

     
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-bars"></i> Manage Admin</div>   

</div>
                            
                 
		<div class="ibox-body">
        <div class="table-responsive">
  <table class="table table-striped table-bordered" id="example-table" cellspacing="0">
  <thead>
  <tr>
  <th width="20px">SN</th>
  <th>Staff Id</th>
  <th>Username</th>
  <th>Date</th>
  <th>Action</th>
  </tr>
  </thead>
		<tbody>
  <?php $ab= $utility->PullRecord("admin WHERE status!=0 ORDER BY uname"); if($ab){
	  	$a=1; foreach($ab as $key => $val){ ?>      
  <tr>
  <td><?php echo $a++; ?></td>
  <td><?php echo $val->stafid; ?></td>
  <td><?php echo $val->uname; ?></td>
  <td><?php echo date('d M, Y',strtotime($val->dated)); ?></td>
  <td>

 <?php if($val->status==1){ ?>           
      <a href="?anc=<?php echo $val->id; ?>&act=2&sn=<?php echo uniqid(); ?>"><button class="btn btn-warning btn-xs m-r-3" data-toggle="tooltip" data-original-title="Deactivate" style="cursor:pointer"><i class="fa fa-times font-12"></i></button></a>
 <?php } if($val->status==2){ ?>
<a href="?anc=<?php echo $val->id; ?>&act=1&sn=<?php echo uniqid(); ?>"><button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Activate" style="cursor:pointer"><i class="fa fa-check font-12"></i></button></a>
  <?php } ?>
<a href="?anc=<?php echo $val->id; ?>&act=0&sn=<?php echo uniqid(); ?>"><button class="btn btn-danger btn-xs m-r-3" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer"><i class="fa fa-trash font-12"></i></button></a>
			</td>
			</tr>
   <?php } } ?>         
      </tbody>
	</table>
		</div>
        </div>         
</div>


</div>
</div>




<?php
include('incs/ft.php');

?>