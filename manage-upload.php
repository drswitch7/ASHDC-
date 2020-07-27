<?php
include('incs/hd.php');

$add= new Administrator;
$utility= new Utility;

if(isset($_GET['anc'])&& isset($_GET['act'])){
  $utility->Operation($_GET['anc'],$_GET['act'],'uploads');
}

if(isset($_POST['send'])){
  if($_POST['folder']!='0'){
        if($_POST['title']!=''){
    $file= $_FILES['file'];
  if($file['name']!=''){
$imgid= substr(sha1(uniqid().$_POST['folder']),4,6).'-'.str_replace(' ','-',$_POST['title']);
    $log=array('jpg','jpeg','png','pdf','docx','doc','ppt','txt');
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


if(isset($_POST['find'])){
  if($_POST['folder']!='0'){
    $_GET['find']= $_POST['folder'];
  }else{$er= 'Folder NOT SELECTED';}
}


?>


<div class="page-heading">
<h1 class="page-title"></h1>
</div>
            
            
<div class="row">


<?php if(!isset($_GET['edit']))if(!isset($_GET['search'])){ ?> 
  <div class="col-md-10">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-bars"></i> Manage Uploaded File</div> 
<div class="ibox-tools">
  <a href="?search" class="btn btn-link" style="text-decoration:none;font-weight:bolder;"><i class="fa fa-search" title="Search by Folder"></i> Search by Folder </a>
  <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
  </div>  
</div>               
    <div class="ibox-body">
        <div class="table-responsive">
  <table class="table table-striped table-bordered" id="example-table" cellspacing="0">
    <thead>
      <tr>
            <th width="20px">SN</th>
      <th>Folder Name</th>
            <th>Title</th>
            <th>Date</th>
            <th>Action</th>
            </tr>
        </thead>
    <tbody>
  <?php $ab= $utility->PullRecord("uploads WHERE status!=0 ORDER BY title"); if($ab){
      $a=1; foreach($ab as $key => $val){ ?>      
           <tr>
           <td><?php echo $a++; ?></td>
           <td><?php echo $utility->FolderName($val->folder); ?></td>
           <td><?php echo $val->title; ?></td>
            <td><?php echo date('d M, Y',strtotime($val->dated)); ?></td>
            <td>
 <?php if($val->status==1){ ?>           
      <a href="?anc=<?php echo $val->id; ?>&act=2&sn=<?php echo uniqid(); ?>"><button class="btn btn-warning btn-xs m-r-3" data-toggle="tooltip" data-original-title="Deactivate" style="cursor:pointer"><i class="fa fa-times font-12"></i></button></a>
 <?php } if($val->status==2){ ?>
<a href="?anc=<?php echo $val->id; ?>&act=1&sn=<?php echo uniqid(); ?>"><button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Available" style="cursor:pointer"><i class="fa fa-check font-12"></i></button></a>
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
              
<?php } if(isset($_GET['search'])){ ?>

<div class="<?php if(isset($_GET['find'])){echo 'col-sm-12';}else{echo 'col-md-7';} ?>">       
  <div class="ibox">

    <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-exclamation-circle"></i><?php if(!isset($_GET['find'])){echo ' Search';}else{echo' Folder List';} ?></div> 

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

<div class="ibox-body">
  <form method="POST" name="formsearch">
<div class="form-group">
    <label>Select Folder</label>
<select class="form-control" style="cursor:pointer;width:auto;" name="folder" >
    <option value="0">- Select -</option>
    <option value="acc">Account Department</option>
    <option value="admin">Admin Department</option>
    <option value="estate">Estate Department</option>
    <option value="legal">Legal Unit</option>
    <option value="plan">Planning Department</option>
    <option value="work">Works Department</option>
</select>
</div>

<div class="form-group">
    <button class="btn btn-success" type="submit" name="find" style="cursor:pointer;width:135px">SEARCH</button>
</div>

</form>
</div>

<?php } if(isset($_GET['find'])){  $efind= $utility->PullRecord("uploads WHERE folder='{$_GET['find']}' AND status!=0"); ?> 

<!-- SEARCH AREANA -->

<div class="ibox-body">

<div class="table-responsive">
  <table class="table table-striped table-bordered" id="example-table" cellspacing="0">
    <thead>
      <tr>
      <th width="20px">SN</th>
      <th>Folder Name</th>
      <th>Title</th>
      <th>Date</th>
      <th>Action</th>
      </tr>
    </thead>
    <tbody>
  <?php if($efind){
      $a=1; foreach($efind as $key => $vala){ ?>      
    <tr>
    <td><?php echo $a++; ?></td>
    <td><?php echo $utility->FolderName($vala->folder); ?></td>
    <td><?php echo $vala->title; ?></td>
    <td><?php echo date('d M, Y',strtotime($vala->dated)); ?></td>
    <td>
    
   <?php if($vala->status==1){ ?>           
      <a href="?anc=<?php echo $vala->id; ?>&act=2&sn=<?php echo uniqid(); ?>"><button class="btn btn-warning btn-xs m-r-3" data-toggle="tooltip" data-original-title="Deactivate" style="cursor:pointer"><i class="fa fa-times font-12"></i></button></a>
 <?php } if($vala->status==2){ ?>
<a href="?anc=<?php echo $vala->id; ?>&act=1&sn=<?php echo uniqid(); ?>"><button class="btn btn-success btn-xs m-r-3" data-toggle="tooltip" data-original-title="Available" style="cursor:pointer"><i class="fa fa-check font-12"></i></button></a>
  <?php } ?>
<a href="?anc=<?php echo $vala->id; ?>&act=0&sn=<?php echo uniqid(); ?>"><button class="btn btn-danger btn-xs m-r-3" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer"><i class="fa fa-trash font-12"></i></button></a>

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

<?php } ?>



</div>




<?php
include('incs/ft.php');

?>