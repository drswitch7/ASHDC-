<?php
include('incs/hd.php');

$log= new EstateManagement;


if(isset($_POST['send'])){
	if($_POST['estate']!=''){
		try{
		$send= $log->AddEstate($_POST['estate']);
		}catch(Exception $e){$er= $e->getMessage();}
	}else{$er='Estate Name is Required';}
}

?>


			<div class="page-heading">
                <h1 class="page-title"></h1>
                
            	</div>
            
            
					<div class="row">
            	        <div class="col-md-8">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title"><i class="fa fa-plus-square"></i> Add Estate</div>   
                                
                                <div class="ibox-tools">
                                    <a href="manage-estate"><i class="fa fa-exclamation-circle"></i> Manage Estate</a>
                                </div>                             
                            </div>
<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="'.SERVERPAT.'";},2000);});</script>';} 
?>                                
</div> 
      
                            <div class="ibox-body">
                                <form class="form-horizontal" action="" method="post">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Estate Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="estate" type="text" placeholder="Enter Estate Name" autocomplete="off" >
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-10 ml-sm-auto">
                                            <button class="btn btn-info" type="submit" name="send" style="cursor:pointer">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




<?php
include('incs/ft.php');

?>