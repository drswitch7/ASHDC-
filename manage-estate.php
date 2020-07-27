<?php
include('incs/hd.php');

$log= new EstateManagement;
$utility= new Utility;



if(isset($_GET['anc'])&& isset($_GET['act'])){
	$utility->Operation($_GET['anc'],$_GET['act'],'estates');
}


if(isset($_POST['send'])){
	if($_POST['estate']!=''){
		try{
		$send= $log->AddEstate($_POST['estate'],$_POST['id']);
		}catch(Exception $e){$er= $e->getMessage();}
	}else{$er='Estate Name is Required';}
}

?>


			<div class="page-heading">
                <h1 class="page-title"></h1>
                
            	</div>
            
            
					<div class="row">
            	        <div class="col-md-9">

                 <?php if(!isset($_GET['info'])){ ?>       
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title"><i class="fa fa-bars"></i> Manage Estate</div>   
                                
                                <div class="ibox-tools">
                                    <a href="add-estate"><i class="fa fa-exclamation-circle"></i> Add Estate</a>
                                </div>                             
                            </div>
                            
  <?php if(isset($_GET['edit'])){ $edit= $utility->Changer("estates WHERE id='{$_GET['edit']}'"); ?>
<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'
.'<script>jQuery(document).ready(function(e){setTimeout(function(){window.location.href="manage-estate";},1500);})</script>';} 
?>                                
</div> 
      
                            <div class="ibox-body">
                                <form class="form-horizontal" action="" method="post">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Estate Name</label>
                                        <div class="col-sm-10">
<input class="form-control" name="estate" type="text" placeholder="Enter Estate Name" autocomplete="off" value="<?php echo $edit->name; ?>">
<input  name="id" type="hidden" value="<?php echo $edit->id; ?>">
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-10 ml-sm-auto">
<button class="btn btn-info" type="submit" name="send" style="cursor:pointer">Update</button>

<a href="manage-estate" class="btn btn-warning pull-right" style="cursor:pointer">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                 <?php }
				 if(!isset($_GET['edit'])){ ?> 
                 
		<div class="ibox-body">
        <div class="table-responsive">
	<table class="table table-striped table-bordered" id="example-table" cellspacing="0">
		<thead>
			<tr>
            <th width="20px">SN</th>
			<th>Estate Name</th>
            <th>Date</th>
            <th>Action</th>
            </tr>
        </thead>
		<tbody>
  <?php $ab= $utility->PullRecord("estates WHERE status!=0 ORDER BY name"); if($ab){
	  	$a=1; foreach($ab as $key => $val){ ?>      
           <tr>
           <td><?php echo $a++; ?></td>
           <td><?php echo $val->name; ?></td>
            <td><?php echo date('d M, Y',strtotime($val->dated)); ?></td>
            <td>
 <?php if($val->status==1){ ?>           
      <a href="?anc=<?php echo $val->id; ?>&act=2&sn=<?php echo uniqid(); ?>"><button class="btn btn-warning btn-xs m-r-3" data-toggle="tooltip" data-original-title="Unavailable" style="cursor:pointer"><i class="fa fa-times font-12"></i></button></a>
 <?php } if($val->status==2){ ?>
<a href="?anc=<?php echo $val->id; ?>&act=1&sn=<?php echo uniqid(); ?>"><button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Available" style="cursor:pointer"><i class="fa fa-check font-12"></i></button></a>
  <?php } ?>
<a href="?edit=<?php echo $val->id; ?>&mvc=estate"><button class="btn btn-info btn-xs m-r-3" data-toggle="tooltip" data-original-title="Edit" style="cursor:pointer"><i class="fa fa-pencil font-12"></i></button></a>
<a href="?anc=<?php echo $val->id; ?>&act=0&sn=<?php echo uniqid(); ?>"><button class="btn btn-danger btn-xs m-r-3" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer"><i class="fa fa-trash font-12"></i></button></a>
<a href="?info=<?php echo $val->id; ?>&sv=<?php echo uniqid(); ?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Information" style="cursor:pointer"><i class="fa fa-eye font-12"></i></button></a>
			</td>
			</tr>
   <?php } } ?>         
      </tbody>
	</table>
		</div>
        </div>
                 
                 <?php } ?>          
                        </div>


<?php } 
      if(isset($_GET['info'])){  $edit= $utility->Changer("estates WHERE id='{$_GET['info']}'"); ?>

  <div class="ibox">
    <div class="ibox-head">
      <div class="ibox-title"><i class="fa fa-bars"></i> Estate Name Information</div> 
  </div>

  <div class="ibox-body">
    <div class="form-group">
      <label><b>Estate Name:</b></label>
      <div class="col-sm-10"><?php echo $edit->name; ?></div>
    </div>

    <div class="form-group">
      <label><b>Date Created / Admin</b></label>
      <div class="col-sm-10"><?php echo date('d M, Y / h:ia',strtotime($edit->dated)) .'/ '.$edit->admin; ?></div>
    </div>
<?php if(!empty($edit->admin2)){ ?>
    <div class="form-group">
      <label><b>Date Modified / Admin</b></label>
      <div class="col-sm-10"><?php echo date('d M, Y / h:ia',strtotime($edit->updated)) .'/ '.$edit->admin2; ?></div>
    </div>
<?php } ?>
  </div>


</div>


<?php } ?>


                    </div>
                </div>




<?php
include('incs/ft.php');

?>