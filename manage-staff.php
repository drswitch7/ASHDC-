<?php
include('incs/hd.php');

$add= new Administrator;
$utility= new Utility;

$client= $utility->PullRecord('staff WHERE status=1');

if(isset($_GET['anc'])&& isset($_GET['act'])){
	$utility->Operation($_GET['anc'],$_GET['act'],'client');
}


if(isset($_POST['send'])){
  if($_POST['staff']!='0'){
      if(ctype_alpha($_POST['sname'])!=''){
        if(ctype_alpha($_POST['fname'])!=''){
          if($_POST['sex']!='0'){
          if($_POST['dob']!=''){
            if($_POST['national']!='0'){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  if($_POST['fone']!=''){
              if($_POST['state']!='0'){
                if($_POST['lga']!='0'){
                  if($_POST['home']!=''){
                      if($_POST['adrex']!=''){
    if($_POST['grade']!='0'){
      if($_POST['design']!='0'){
        if($_POST['job']!=''){   
          if($_POST['kin']!=''){
            if($_POST['fone3']!=''){
              if($_POST['work']!=''){
                if($_POST['skul']!=''){
                  if($_POST['cert']!=''){
                    if($_POST['year']!='0'){//leta,apoint,retire,level,scale

                      if(isset($_POST['leta'])){
                        if($_POST['apoint']!=''){
                          if($_POST['retire']!=''){
                            if($_POST['level']!='0'){
                              if($_POST['scale']!='0'){

                              }else{$er='Salary Scale is required';}
                            }else{$er='Grade Level is required';}
                          }else{$er='Date of Retirement is required';}
                        }else{$er='Date of Appointment is required';}
                        $leta= $_POST['leta'];
                      }else{$leta='0';}
                      if(isset($_POST['dis'])){$dis=$_POST['dis'];}else{$dis='0';}
                    $f = $_FILES['img'];
                if ($f['size'] <= 0) { $path = ''; $dburl = '';} else {
                  $imgid= substr(sha1(uniqid().$_POST['staff']),4,6).$_POST['staff'];
                  $file = $_FILES['img'];
                  $type = array('jpg','jpng','png');
                  $get = explode('.', $file['name']);
                  $pick = strtolower(end($get));
                  if (in_array($pick, $type)) {
                    $path=LOCALPAT.'assets/img/staff/'.$imgid.'.'.$get;
                    $dburl= SERVERPAT.'assets/img/staff/'.$imgid.'.'.$get;
                    $move = move_uploaded_file($_FILES['img']['tmp_name'],$path);
                  } else {$er='Invalid passport format; Passport should be in Jpg, Jpeg or Png';}
              } if(empty($dburl)){$img=$dburl;}else{$img=$_POST['imgfile'];}
    try{
     $send= $add->AddGeneralStaff($_POST['staff'],$_POST['sname'],$_POST['fname'],$_POST['oname'],$_POST['sex'],$_POST['dob'],$_POST['national'],$_POST['email'],$_POST['fone'],$_POST['fone2'],$_POST['state'],$_POST['lga'],$_POST['home'],$_POST['adrex'],$_POST['grade'],$_POST['design'],$_POST['job'],$_POST['kin'],$_POST['fone3'],$_POST['work'],$_POST['skul'],$_POST['cert'],$_POST['year'],$_POST['skul2'],$_POST['cert2'],$_POST['year2'],$_POST['oda'],$leta,$_POST['apoint'],$_POST['retire'],$_POST['level'],$_POST['scale'],$dis,$_POST['doc'],$img,$_POST['sid']);
    }catch(Exception $e){$er= $e->getMessage();}
                            }else{$er='Year is required';}
                          }else{$er='Cerficate is required';}
                            }else{$er='School Name is required';}
                                }else{$er='Next of Kin Occupation is required';}
                              }else{$er='Next of Kin Mobile Number is required';}
                            }else{$er='Next of Kin Full Name is required';}
                          }else{$er='Job Discription is Required';}
                        }else{$er='Staff Designation is Required';}
                      }else{$er='Staff Grade is Required';}
                    }else{$er='Residential Address is Required';}
              }else{$er='Home Town is Required';}
                  }else{$er='Local Government is Required';}
                }else{$er='State of Origin is Required';}
          }else{ $er='Mobile Number is required';}
        }else{ $er='Email Address is required';}
      }else{$er='Nationality is Required';}
      }else{$er='Date of Birth is Required';}
    }else{$er='Gender is Required';}
     }else{$er='First Name is Required (Alphabet Only)';}
    }else{$er='Surame is Required (Alphabet Only)';}
  }else{$er='Staff Id Number is Required';}

 } 



?>


<div class="page-heading">
<h1 class="page-title"></h1>
</div>
            
            
  <div class="row">

<?php if(!isset($_GET['edit']))if(!isset($_GET['info'])){ ?>

  <div class="col-md-12">       
  <div class="ibox">
  <div class="ibox-head">
  <div class="ibox-title"><i class="fa fa-bars"></i> Manage Staff Information</div>   
                                      
  </div>
                            

                 
		<div class="ibox-body">
        <div class="table-responsive">
	<table class="table table-striped table-bordered" id="example-table" cellspacing="0">
		<thead>
			<tr>
      <th width="20px">SN</th>
			<th>Staff ID</th>
      <th>Name</th>
      <th>Gender</th>
      <th>Mobile No</th>
      <th>Email</th>
      <th>State/ LGA</th>
      <th>Date</th>
      <th>Action</th>
      </tr>
    </thead>
		<tbody>
  <?php if($client){
	  	$a=1; foreach($client as $key => $val){ ?>      
    <tr>
    <td><?php echo $a++; ?></td>
    <td><?php echo $val->stafid; ?></td>
    <td><?php echo $val->sname.' '.$val->fname.'<br/><small>'.$val->oname.'</small>'; ?></td>
    <td><?php echo $val->sex; ?></td>
    <td><?php echo $val->fone; ?></td>
    <td><?php echo $val->email; ?></td>
    <td><?php echo $utility->Changer("state WHERE id='$val->state'")->state; ?><br/>
      <small><?php echo $utility->Changer("lga WHERE id='$val->lga'")->lganame; ?></small>
    </td>
    <td><?php echo date('d M, Y',strtotime($val->dated)); ?></td>
    <td>
<a href="?edit=<?php echo $val->sid; ?>"><button class="btn btn-info btn-xs m-r-3" data-toggle="tooltip" data-original-title="Edit" style="cursor:pointer"><i class="fa fa-pencil font-12"></i></button></a>
<a href="?anc=<?php echo $val->id; ?>&act=0&sn=<?php echo uniqid(); ?>"><button class="btn btn-danger btn-xs m-r-3" data-toggle="tooltip" data-original-title="Delete" style="cursor:pointer"><i class="fa fa-trash font-12"></i></button></a>
<a href="?info=<?php echo $val->sid; ?>&Information=<?php echo uniqid(); ?>"><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Information" style="cursor:pointer"><i class="fa fa-eye font-12"></i></button></a>
			</td>
			</tr>
   <?php } }else{echo 'No row found';} ?>         
      </tbody>
	</table>
		</div>
        </div>
                 
        
</div>
</div>

  <?php }
    if(isset($_GET['edit'])){ $data= $utility->Changer("staff WHERE sid='{$_GET['edit']}'");
    //var_dump($data);
?>


<div class="col-md-9">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-edit"></i> Edit Staff Information</div>                                                        
</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="manage-staff";},2000);});</script>';} 
?>                                
</div> 
      
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="ibox-body">

<div class="row">

<div class="col-sm-6 form-group">
    <label>Staff Id</label>
    <input class="form-control" name="staff" type="text" placeholder="Enter Staff Id Number" autocomplete="off" required value="<?php echo $data->stafid; ?>">
</div>

<div class="col-sm-6 form-group">
    <label>Surname</label>
    <input class="form-control" name="sname" type="text" placeholder="Enter Surname" autocomplete="off" required value="<?php echo $data->sname; ?>">
</div>

</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>First Name</label>
<input class="form-control" type="text" name="fname" placeholder="Enter First Name" autocomplete="off" required value="<?php echo $data->fname; ?>">
</div>
<div class="col-sm-6 form-group">
<label>Othernames</label>
<input class="form-control" type="text" name="oname" placeholder="Enter Othernames" autocomplete="off" value="<?php echo $data->oname; ?>">
</div>
</div>

<div class="row">

<div class="col-sm-4 form-group">
    <label>Gender</label>
    <select class="form-control" name="sex" title="Select Gender" style="cursor:pointer;">
<option value="<?php echo $data->sex; ?>"><?php echo $data->sex; ?></option>      
      <option value="0">- Select -</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
</div>

<div class="col-sm-4 form-group">
    <label>Date of Birth</label>
    <input class="form-control" name="dob" type="date" placeholder="Enter Date of Birth" autocomplete="off" required value="<?php echo $data->dob; ?>">
</div>

<div class="col-sm-4 form-group">
    <label>Nationality</label>
    <select class="form-control" name="national" title="Select Nationality" style="cursor:pointer;">
<option value="<?php echo $data->national; ?>"><?php if($data->national==1){echo 'Non Nigerian';}elseif($data->national==2){echo 'Nigerian';} ?></option>      
      <option value="0">- Select -</option>
        <option value="1">Non Nigerian</option>
        <option value="2">Nigerian</option>
    </select>
</div>

</div>

<div class="row">
  <div class="col-sm-4 form-group">
<label>Email Address</label>
<input class="form-control" type="email" name="email" placeholder="Enter Email Address" autocomplete="off" required value="<?php echo $data->email; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Mobile Number</label>
<input class="form-control" type="text" name="fone" placeholder="Enter Mobile Number" autocomplete="off" required value="<?php echo $data->fone; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Phone Number</label>
<input class="form-control" type="text" name="fone2" placeholder="Enter Phone Number" autocomplete="off" value="<?php echo $data->fone2; ?>">
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>State</label>
  <select class="form-control" id="state" name="state" title="Select State" style="cursor:pointer;">
    <?php $utility->ConvertDropdown('state',"state WHERE id='{$data->state}'"); ?>
    <?php echo $utility->Dropdown('state','state','state'); ?>
  </select>
</div>
<div class="col-sm-6 form-group">
<label>Local Government</label>
  <select class="form-control" id="lga" name="lga" title="Select Local Government" style="cursor:pointer;">
    <?php $utility->ConvertDropdown('lganame',"lga WHERE id='{$data->lga}'"); ?> 
  </select>
</div>
</div>

<div class="row">

<div class="col-sm-6 form-group">
<label>Home Town</label>
<input class="form-control" type="text" name="home" placeholder="Enter Home Town" autocomplete="off" required value="<?php echo $data->home; ?>">
</div>
<div class="col-sm-6 form-group">
<label>Residential Address</label>
    <textarea class="form-control" name="adrex" placeholder="Enter Residential Address" autocomplete="off" required><?php echo $data->adrex; ?></textarea>
</div>

</div>

<div class="row">

<div class="col-sm-3 form-group">
<label>Grade Level</label>
<select class="form-control" name="grade" title="Select Grade Level" style="cursor:pointer;">
  <option value="<?php echo $data->grade; ?>"><?php echo $data->grade; ?></option>
    <?php echo $utility->DropdownLevel(1,25); ?>
  </select>
</div>

<div class="col-sm-3 form-group">
<label>Designation</label>
<select class="form-control" name="design" title="Select Designation" style="cursor:pointer;">
  <?php $utility->ConvertDropdown('name','designation'); ?>
    <?php echo $utility->Dropdown('name','designation','name'); ?>
  </select>
</div>

<div class="col-sm-6 form-group">
<label>Job Discription</label>
    <textarea class="form-control" name="job" placeholder="Enter Job Discription" autocomplete="off" required><?php echo $data->job; ?></textarea>
</div>

</div>

</div>

<hr/>
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-users"></i> Next of Kin Information</div>                                                            
</div>

<div class="ibox-body">
  
<div class="row">
  <div class="col-sm-4 form-group">
<label>Full Name</label>
<input class="form-control" type="text" name="kin" placeholder="Enter Next of Kin Full Name" autocomplete="off" required value="<?php echo $data->kin; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Mobile Number</label>
<input class="form-control" type="text" name="fone3" placeholder="Enter Mobile Number" autocomplete="off" required value="<?php echo $data->fone3; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Occupation</label>
<input class="form-control" type="text" name="work" placeholder="Enter Occupation" autocomplete="off" value="<?php echo $data->work; ?>">
</div>
</div>

</div>

<hr/>
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-graduation-cap"></i> Education Qualification</div>                                                            
</div>

<div class="ibox-body">
  
<div class="row">
  <div class="col-sm-4 form-group">
<label>School Name (1)</label>
<input class="form-control" type="text" name="skul" placeholder="Enter School Name" autocomplete="off" required value="<?php echo $data->skul; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Cerficate</label>
<input class="form-control" type="text" name="cert" placeholder="Enter Cerficate" autocomplete="off" required value="<?php echo $data->cert; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Year</label>
<select class="form-control" name="year" title="Select Year" style="cursor:pointer;">
  <option value="<?php echo $data->cyear; ?>"><?php echo $data->cyear; ?></option>
    <?php echo $utility->DropdownYear(1976,date('Y')); ?>
</select>
</div>

</div>

<div class="row">
  <div class="col-sm-4 form-group">
<label>School Name (2)</label>
<input class="form-control" type="text" name="skul2" placeholder="Enter School Name" autocomplete="off" required value="<?php echo $data->skul2; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Cerficate</label>
<input class="form-control" type="text" name="cert2" placeholder="Enter Cerficate" autocomplete="off" required value="<?php echo $data->cert2; ?>">
</div>
<div class="col-sm-4 form-group">
<label>Year</label>
<select class="form-control" name="year2" title="Select Year" style="cursor:pointer;">
<option value="<?php echo $data->cyear2; ?>"><?php echo $data->cyear2; ?></option>
    <?php echo $utility->DropdownYear(1976,date('Y')); ?>
</select>
</div>

</div>


<div class="form-group">
<label>Other Qualifications</label>
<textarea class="form-control" name="oda" placeholder="Enter Other Qualification" autocomplete="off"><?php echo $data->oda; ?></textarea>
</div>

</div>

<hr/>
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-file"></i> Record of Service</div>                                                            
</div>

<div class="ibox-body">


<div class="form-group">
<label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" id="leta" name="leta" value="1" required <?php if($data->leta==1){echo 'checked';} ?>>
  <span class="input-span"></span> <b> Letter of Appointment</b></label>
</div><br/>
  
<div class="row" id="apointdiv" <?php if($data->leta!=1){echo 'style="display:none"';} ?>>
  <div class="col-sm-3 form-group">
<label>Date of Appointment</label>
<input class="form-control" type="date" name="apoint" placeholder="Enter Date Of Appointment" autocomplete="off" required value="<?php echo $data->apoint; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Date of Retirement</label>
<input class="form-control" type="date" name="retire" placeholder="Enter Date of Retirement" autocomplete="off" required value="<?php echo $data->retire; ?>">
</div>
<div class="col-sm-3 form-group">
<label>Grade Level</label>
<select class="form-control" name="level" title="Select Grade Level" style="cursor:pointer;">
<option value="<?php echo $data->level; ?>"><?php echo $data->level; ?></option>
    <?php echo $utility->DropdownLevel(1,25); ?>
</select>
</div>

<div class="col-sm-3 form-group">
<label>Salary Scale</label>
<select class="form-control" name="scale" title="Select Year" style="cursor:pointer;">
<option value="<?php echo $data->scale; ?>"><?php echo $data->scale; ?></option>
    <option value="0">- SELECT -</option>
    <option value="Pension Stage">Pension Stage</option>
    <option value="Gratuity Stage">Gratuity Stage</option>
</select>
</div>

</div>

</div>

<hr/>
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-medical"></i> Medical Report</div>                                                            
</div>

<div class="ibox-body">

<div class="form-group col-sm-6">
  <label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" id="dis" name="dis" value="1" <?php if($data->dis==1){echo 'checked';} ?>>
  <span class="input-span"></span> <b> Disable</b></label>
</div>

<br/>

<div class="form-group" id="doctor" <?php if($data->dis!=1){echo 'style="display:none"';} ?>>
<label>Doctor's Medical Report (if any)</label>
<textarea class="form-control" name="doc" placeholder="Enter Doctor's Medical Report (if any)" autocomplete="off"><?php echo $data->doct; ?></textarea>
</div>

<div class="row">

 <div class="form-group col-sm-2">
   <img src="<?php echo $data->img; ?>" width="90" style="margin:4px;padding:4px;border:2px #ccc solid;">
 </div> 

<div class="form-group col-sm-4">
  <label>Upload Passport</label><br/>
  <img src="" alt="" width="80" id="tim" style="margin-top:5px;margin-bottom: 4px;" class="img-rounded lop">
  <input type="file" name="img" id="imginp" class="form-control" onchange="readURL(this)" style="border:none; cursor:pointer;padding: 4px;">
</div>
</div>

<div class="form-group">
  <input type="hidden" name="sid" value="<?php echo $data->sid; ?>">
  <input type="hidden" name="imgfile" value="<?php echo $data->img; ?>">
    <button class="btn btn-success" type="submit" name="send" style="cursor:pointer;width:135px;font-weight:bolder;"> UPDATE </button>
    <a href="manage-staff" class="btn btn-danger pull-right"> CANCEL </a>
</div>

</div>


  </form>

   
    </div>
    </div>


<!-- Staff Information -->
 <?php }
    if(isset($_GET['info'])){ $data= $utility->Changer("staff WHERE sid='{$_GET['info']}'");
    //var_dump($data);
?>

<style type="text/css">
  .tanchor{font-weight:bolder;padding: 5px 5px 0px 10px; text-transform:capitalize;}
  .tvalue{font-size:17px; text-transform:capitalize;}
</style>
<div class="col-md-8">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-user-circle"></i> Staff Information</div>                                                        
</div>

      
<div class="ibox-body">
<div class="row">

<div class="form-group col-sm-2">
   <img src="<?php echo $data->img; ?>" width="90" style="margin:4px;padding:4px;border:2px #ccc solid;">
 </div>

  <div class="form-group col-sm-10">
<table class="table-striped" width="100%">
     <tr>
       <td class="tanchor">Staff ID:</td>
       <td class="tvalue"><?php echo $data->stafid; ?></td>
     </tr>
     <tr>
       <td class="tanchor">Name:</td>
       <td class="tvalue"><?php echo $data->sname.' '.$data->fname.' '.$data->oname; ?></td>
     </tr> 
     <tr>
       <td class="tanchor">Gender</td>
       <td class="tvalue"><?php echo $data->sex; ?></td>
     </tr>
     <tr>
       <td class="tanchor">Date of Birth</td>
       <td class="tvalue"><?php $a= date('d F, Y',strtotime($data->dob)); $b= explode(' ',$a); $c= round(date('Y')-$b[2]); ?>
       <?php echo $a.' &nbsp;&nbsp; <small>('.$c.' Yrs)</small>'; ?></td>
     </tr>         
</table> 
    
  </div>
  
</div>
<div class="row">
  <div class="col-sm-12">
<table class="table-striped" width="100%">

     <tr>
       <td class="tanchor">Nationality:</td>
       <td class="tvalue"><?php if($data->national==1){echo 'Non Nigerian';}else{echo 'Nigerian';} ?></td>
     </tr> 
     <tr>
       <td class="tanchor">State of Origin:</td>
       <td class="tvalue"><?php echo $utility->Changer("state WHERE id=$data->state")->state.', &nbsp;&nbsp;<small>'.
       $utility->Changer("lga WHERE id=$data->lga")->lganame.'</small>'; ?></td>
     </tr>
     <tr>
       <td class="tanchor">Home Town:</td>
       <td class="tvalue"><?php echo $data->home; ?></td>
     </tr>
     <tr>
       <td class="tanchor">Residential Address:</td>
       <td class="tvalue"><?php echo $data->adrex; ?></td>
     </tr>
     <tr>
       <td class="tanchor">Email Address:</td>
       <td class="tvalue"><?php echo $data->email; ?></td>
     </tr>
     <tr>
       <td class="tanchor">Mobile No:</td>
       <td class="tvalue"><?php echo $data->fone.', '.$data->fone2; ?></td>
     </tr>
     <tr>
       <td class="tanchor">Designation:</td>
       <td class="tvalue"><?php echo $utility->Changer("designation WHERE id='$data->design'")->name; ?></td>
     </tr>
     <tr>
       <td class="tanchor">Grade:</td>
       <td class="tvalue"><?php echo $data->grade; ?></td>
     </tr> 
     <tr>
       <td class="tanchor">Job Description:</td>
       <td class="tvalue"><?php echo $data->job; ?></td>
     </tr> 
     <?php if($data->dis==1){ ?>
     <tr>
       <td class="tanchor">Disability:</td>
       <td class="tvalue"> YES </td>
     </tr>  
     <tr>
       <td class="tanchor">Doctor Report:</td>
       <td class="tvalue"> <?php echo $data->doct; ?> </td>
     </tr>  
    <?php } ?>       
</table>    
    
  </div>
</div>
</div>
</div>

<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-user"></i> Next Of kin Information</div>                                                  
</div>
      
<div class="ibox-body">
<div class="row">
  <div class="col-sm-12">
<table class="table-striped" width="100%">  
  <tr>
    <td class="tanchor">Name:</td>
    <td class="tvalue"><?php echo $data->kin; ?></td>
  </tr>
  <tr>
      <td class="tanchor">Occupation:</td>
      <td class="tvalue"><?php echo $data->work; ?></td>
  </tr>
  <tr>
      <td class="tanchor">Mobile Number:</td>
      <td class="tvalue"><?php echo $data->fone3; ?></td>
  </tr>
</table>
</div>
</div>
</div>
</div>

<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-graduation-cap"></i> Educational Qualification</div>                                                  
</div>

      
<div class="ibox-body">
<div class="row">
  <div class="col-sm-12">
<table class="table-striped" width="100%">
  <tr>
    <td class="tanchor" width="22">1</td>
    <td class="tanchor">School:</td>
    <td class="tanchor">Certificate</td>
    <td class="tanchor">Year</td>
  </tr> 
  <tr>
    <td width="22">&nbsp;</td>
    <td class="tvalue"><?php echo $data->skul; ?></td>
    <td class="tvalue"><?php echo $data->cert; ?></td>
    <td class="tvalue"><?php echo $data->cyear; ?></td>
  </tr>
  <tr>
    <td class="tanchor" width="22">2</td>
    <td class="tanchor">School</td>
    <td class="tanchor">Certificate</td>
    <td class="tanchor">Year</td>
  </tr> 
  <tr>
    <td width="22">&nbsp;</td>
    <td class="tvalue"><?php echo $data->skul2; ?></td>
    <td class="tvalue"><?php echo $data->cert2; ?></td>
    <td class="tvalue"><?php echo $data->cyear2; ?></td>
  </tr>
  <tr>
    <td width="22" class="tanchor">3</td>
    <td colspan="3" class="tanchor">Other Qualification</td>
  </tr>
  <tr>
    <td></td>
    <td colspan="3" class="tvalue"><?php echo $data->oda; ?></td>
  </tr>  
</table>
</div>
</div>
</div>
</div>

<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-file"></i> Record of Service</div>                                                  
</div>

      
<div class="ibox-body">
<div class="row">
  <div class="col-sm-12">
<table class="table-striped" width="100%">
  <tr>
    <td class="tanchor">Letter of Appointment:</td>
    <td class="tanchor">YES</td>
  </tr>
  <tr>
    <td class="tanchor">Date of Appointment:</td>
    <td class="tvalue"><?php echo date('jS F, Y',strtotime($data->apoint)); ?></td>
  </tr> 
  <tr>
    <td class="tanchor">Date of Retirement:</td>
    <td class="tvalue"><?php echo date('jS F, Y',strtotime($data->retire)); ?></td>
  </tr>
  <tr>
    <td class="tanchor">Level:</td>
    <td class="tvalue"><?php echo $data->level; ?></td>
  </tr>
  <tr>
    <td class="tanchor">Salary Scale:</td>
    <td class="tvalue"><?php echo $data->scale; ?></td>
  </tr> 
</table>
</div>
</div>
</div>

</div>

<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-file-o"></i> Official Use</div>                                                  
</div>

      
<div class="ibox-body">
<div class="row">
  <div class="col-sm-12">
<table class="table-striped" width="100%">
  <tr>
    <td class="tanchor">Created By</td>
    <td class="tvalue"><?php echo $data->admin; ?></td>
    <td class="tanchor">Updated By</td>
    <td class="tvalue"><?php echo $data->admin2; ?></td>
  </tr>
  <tr>
    <td class="tanchor">Date Created</td>
    <td class="tvalue"><?php echo date('jS F, Y',strtotime($data->dated)); ?></td>
    <td class="tanchor">Date Updated:</td>
    <td class="tvalue"><?php echo date('jS F, Y',strtotime($data->updated)); ?></td>
  </tr> 
</table>
</div>
</div>

<br/>
<div class="form-group col-sm-12">
  <a href="manage-staff" class="btn btn-danger pull-right">CANCEL</a>
</div>
<br/>
</div>

</div>
<?php } ?>


</div>
<script type="text/javascript">

  $(document).ready(function(e){

$('#state').change(function(e) {
  state=$('#state').val(); 
  if(state!=0){
      boss= 'state='+state;
      $.ajax({
        type:'post',
        url:'handler.php',
        data:boss,
        success: function(response){
          if(response){
            $('#lga').removeAttr('disabled','disabled');
            $('#lga').html(response);
          }
        }
      });
  }else $('#lga').attr('disabled','disabled');
});


$("#dis").click(function () {
  if ($(this).is(":checked")) {
  $("#doctor").show();
  } else {
  $("#doctor").hide();
  }
  });

$("#leta").click(function () {
  if ($(this).is(":checked")) {
  $("#apointdiv").show();
  } else {
  $("#apointdiv").hide();
  }
  });

$('#tim').hide();
  function readURL(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function (e){
        $('#tim').attr('src',e.target.result);
        $('.lop').show().css('border-color','#999');
        $('.lop').show().css('border-width','1px');
        $('.lop').show().css('border-style','inset');
        $('.lop').show().css('-moz-border-radius','4px');
        $('.lop').show().css('-webkit-border-radius','4px');
        $('.lop').show().css('border-radius','4px');
        
      }
      reader.readAsDataURL(input.files[0]);
    }
    }

$("#imginp").change(function(){
    readURL(this);
}); 
  
});
</script>




<?php
include('incs/ft.php');

?>