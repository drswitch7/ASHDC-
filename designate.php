<?php
include('incs/hd.php');

$log= new Administrator;
$utility= new Utility;

if(isset($_GET['anc']) && isset($_GET['act'])){
    $utility->Operation($_GET['anc'],$_GET['act'],'designation');
}


if(isset($_POST['send'])){
    if($_POST['des']!=''){
        try{
        $send= $log->AddDesignate($_POST['des']);
        }catch(Exception $e){$er= $e->getMessage();}
    }else{$er='Grade is Required';}
}


if(isset($_POST['update'])){
    if($_POST['des']!=''){
        try{
        $send= $log->AddDesignate($_POST['des'],$_POST['id']);
        }catch(Exception $e){$er= $e->getMessage();}
    }else{$er='Designation is Required';}
}

?>


<div class="page-heading">
    <h1 class="page-title"></h1>
</div>
            
            
<div class="row">

<?php if(!isset($_GET['edit'])){ ?>
<div class="col-md-6">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-plus-square"></i> Add Designation</div>                               
</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="designate";},2000);});</script>';} 
?>                                
</div> 
      
<div class="ibox-body">
    <form class="form-horizontal" action="" method="post" name="form2">
    <div class="form-group row">
<label class="col-sm-3 col-form-label">Designation</label>
<div class="col-sm-9">
<input class="form-control" name="des" type="text" placeholder="Enter Designation" autocomplete="off" required>
</div>
</div>
                                    
<div class="form-group row">
    <div class="col-sm-10">
<button class="btn btn-success pull-right" type="submit" name="send" style="cursor:pointer">ADD DESIGNATION</button>
    </div>
</div>
    </form>
        </div>
    </div>
</div>


<?php $abc= $utility->PullRecord("designation WHERE status!=0 ORDER BY name"); if($abc){ ?>
<div class="col-md-8">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-bars"></i> Manage Designation</div>                                
</div>

<div class="ibox-body">
        <div class="table-responsive">
    <table class="table table-striped table-bordered" id="example-table" cellspacing="0">
        <thead>
            <tr>
            <th width="20px">SN</th>
            <th>Designation</th>
            <th>Date</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
  <?php $a=1; foreach($abc as $key => $val){ ?>      
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
<a href="?edit=<?php echo $val->id; ?>&mvc=<?php echo uniqid(); ?>"><button class="btn btn-info btn-xs m-r-3" data-toggle="tooltip" data-original-title="Edit" style="cursor:pointer"><i class="fa fa-pencil font-12"></i></button></a>
<a href="?anc=<?php echo $val->id; ?>&act=0&sn=<?php echo uniqid(); ?>"><button class="btn btn-danger btn-xs m-r-3" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer"><i class="fa fa-trash font-12"></i></button></a>
            </td>
            </tr>
   <?php } ?>         
      </tbody>
    </table>
    </div>
</div>

</div>
</div>

<?php } } ?>



<?php if(isset($_GET['edit'])){ $data= $utility->Changer("designation WHERE id='{$_GET['edit']}'"); ?>


<div class="col-md-6">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-edit"></i> Edit Designation</div>                               
</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['update']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="designate";},2000);});</script>';} 
?>                                
</div> 
      
<div class="ibox-body">
    <form class="form-horizontal" action="" method="post" name="form2">
    <div class="form-group row">
<label class="col-sm-3 col-form-label">Designation</label>
<div class="col-sm-9">
<input class="form-control" name="des" type="text" placeholder="Enter Designation" value="<?php echo $data->name; ?>" autocomplete="off" required>
</div>
</div>
                                    
<div class="form-group row">
    <div class="col-sm-10">
   <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">     
<button class="btn btn-success pull-right" type="submit" name="update" style="cursor:pointer">UPDATE DESIGNATION</button>
    </div>
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