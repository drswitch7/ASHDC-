<?php
include('incs/hd.php');

$add= new Administrator;


if(isset($_POST['send'])){
	if($_POST['folder']!='0'){
        if($_POST['title']!=''){
    $file= $_FILES['file'];
  if($file['name']!=''){
$imgid= substr(sha1(uniqid().$_POST['folder']),4,6).'-'.str_replace(' ','-',$_POST['title']);
    $log=array('jpg','jpeg','png','pdf','docx','doc','ppt','txt','xls');
    $ge= explode('.',$file ['name']);
    $get=strtolower(end($ge));
    if(in_array($get,$log)){ 
      $path=LOCALPAT.'assets/docs/'.$_POST['folder'].'/'.$imgid.'.'.$get;
      $dburl= SERVERPAT.'assets/docs/'.$_POST['folder'].'/'.$imgid.'.'.$get;
      $move=move_uploaded_file($_FILES['file']['tmp_name'],$path);
		try{
		$send= $add->UploadDocs($_POST['folder'],$_POST['title'],$dburl);
		}catch(Exception $e){$er= $e->getMessage(); unlink($path);}
         }else{$er='Invalid document format; format should be in (Jpg, Jpeg, Png, pdf, docx, doc, ppt, txt)';}
        }else{$er='Passport is Required';}
    }else{$er='File Title is required';}
	}else{$er='File Folder not Selected';}
}

?>


<div class="page-heading">
<h1 class="page-title"></h1>
</div>
            
            
<div class="row">
<div class="col-md-8">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-plus-square"></i> Add File</div>   
</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="upload";},2000);});</script>';} 
?>                                
</div> 
      
<div class="ibox-body">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group row">
<label class="col-sm-2 col-form-label">Select Folder</label>
<div class="col-sm-10">
<select class="form-control" style="cursor:pointer;width:auto;"name="folder" >
    <option value="0">- Select -</option>
    <option value="acc">Account Department</option>
    <option value="admin">Admin Department</option>
    <option value="estate">Estate Department</option>
    <option value="legal">Legal Unit</option>
    <option value="plan">Planning Department</option>
    <option value="work">Works Department</option>
</select>
</div>
</div>
    
<div class="form-group row">
<label class="col-sm-2 col-form-label">File Title</label>
<div class="col-sm-10">
<input class="form-control" name="title" type="text" placeholder="Enter Estate Name" autocomplete="off" >
</div>
</div>

<div class="form-group row">
  <label class="col-sm-2 col-form-label">Upload File</label>
  <div class="col-sm-10">
  <input type="file" name="file" class="form-control" style="border:none; cursor:pointer;padding: 4px;" required>
</div>
</div>
                                    
<div class="form-group row">
<div class="col-sm-10 ml-sm-auto">
<button class="btn btn-info" type="submit" name="send" style="cursor:pointer"> UPLOAD</button>
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