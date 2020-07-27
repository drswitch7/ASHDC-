<?php
include('incs/hd.php');

$add= new Administrator;
$utility= new Utility;


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
  $file= $_FILES['img'];
  if($file['name']!=''){
    $imgid= substr(sha1(uniqid().$_POST['staff']),4,6).'_'.$_POST['staff'];
    $log=array('jpg','jpeg','png');
    $ge= explode('.',$file ['name']);
    $get=strtolower(end($ge));
    if(in_array($get,$log)){ 
      $path=LOCALPAT.'assets/img/staff/'.$imgid.'.'.$get;
      $dburl= SERVERPAT.'assets/img/staff/'.$imgid.'.'.$get;
      $move=move_uploaded_file($_FILES['img']['tmp_name'],$path);
    try{
     $send= $add->AddGeneralStaff($_POST['staff'],$_POST['sname'],$_POST['fname'],$_POST['oname'],$_POST['sex'],$_POST['dob'],$_POST['national'],$_POST['email'],$_POST['fone'],$_POST['fone2'],$_POST['state'],$_POST['lga'],$_POST['home'],$_POST['adrex'],$_POST['grade'],$_POST['design'],$_POST['job'],$_POST['kin'],$_POST['fone3'],$_POST['work'],$_POST['skul'],$_POST['cert'],$_POST['year'],$_POST['skul2'],$_POST['cert2'],$_POST['year2'],$_POST['oda'],$leta,$_POST['apoint'],$_POST['retire'],$_POST['level'],$_POST['scale'],$dis,$_POST['doc'],$dburl);
    }catch(Exception $e){$er= $e->getMessage();}
      }else{$er='Invalid passport format; Passport should be in Jpg, Jpeg or Png';}
  }else{$er='Passport is Required';}  
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

<div class="col-md-9">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-plus-square"></i> Add Staff</div>                                                            
</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="'.$_SERVER['PHP_SELF'].'";},2000);});</script>';} 
?>                                
</div> 
      
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="ibox-body">

<div class="row">

<div class="col-sm-6 form-group">
    <label>Staff Id</label>
    <input class="form-control" name="staff" type="text" placeholder="Enter Staff Id Number" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['staff'];} ?>">
</div>

<div class="col-sm-6 form-group">
    <label>Surname</label>
    <input class="form-control" name="sname" type="text" placeholder="Enter Surname" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['sname'];} ?>">
</div>

</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>First Name</label>
<input class="form-control" type="text" name="fname" placeholder="Enter First Name" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['fname'];} ?>">
</div>
<div class="col-sm-6 form-group">
<label>Othernames</label>
<input class="form-control" type="text" name="oname" placeholder="Enter Othernames" autocomplete="off" value="<?php if(isset($_POST['send'])){ echo $_POST['oname'];} ?>">
</div>
</div>

<div class="row">

<div class="col-sm-4 form-group">
    <label>Gender</label>
    <select class="form-control" name="sex" title="Select Gender" style="cursor:pointer;">
      <option value="0">- Select -</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
</div>

<div class="col-sm-4 form-group">
    <label>Date of Birth</label>
    <input class="form-control" name="dob" type="date" placeholder="Enter Date of Birth" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['dob'];} ?>">
</div>

<div class="col-sm-4 form-group">
    <label>Nationality</label>
    <select class="form-control" name="national" title="Select Nationality" style="cursor:pointer;">
      <option value="0">- Select -</option>
        <option value="1">Non Nigerian</option>
        <option value="2">Nigerian</option>
    </select>
</div>

</div>

<div class="row">
  <div class="col-sm-4 form-group">
<label>Email Address</label>
<input class="form-control" type="email" name="email" placeholder="Enter Email Address" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['email'];} ?>">
</div>
<div class="col-sm-4 form-group">
<label>Mobile Number</label>
<input class="form-control" type="text" name="fone" placeholder="Enter Mobile Number" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['fone'];} ?>">
</div>
<div class="col-sm-4 form-group">
<label>Phone Number</label>
<input class="form-control" type="text" name="fone2" placeholder="Enter Phone Number" autocomplete="off" value="<?php if(isset($_POST['send'])){ echo $_POST['fone2'];} ?>">
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>State</label>
  <select class="form-control" id="state" name="state" title="Select State" style="cursor:pointer;">
    <?php echo $utility->Dropdown('state','state','state'); ?>
  </select>
</div>
<div class="col-sm-6 form-group">
<label>Local Government</label>
  <select class="form-control" id="lga" name="lga" title="Select Local Government" style="cursor:pointer;" disabled>
  </select>
</div>
</div>

<div class="row">

<div class="col-sm-6 form-group">
<label>Home Town</label>
<input class="form-control" type="text" name="home" placeholder="Enter Home Town" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['home'];} ?>">
</div>
<div class="col-sm-6 form-group">
<label>Residential Address</label>
    <textarea class="form-control" name="adrex" placeholder="Enter Residential Address" autocomplete="off" required><?php if(isset($_POST['send'])){ echo $_POST['adrex'];} ?></textarea>
</div>

</div>

<div class="row">

<div class="col-sm-3 form-group">
<label>Grade Level</label>
<select class="form-control" name="grade" title="Select Grade Level" style="cursor:pointer;">
    <?php echo $utility->DropdownLevel(1,25); ?>
  </select>
</div>

<div class="col-sm-3 form-group">
<label>Designation</label>
<select class="form-control" name="design" title="Select Designation" style="cursor:pointer;">
    <?php echo $utility->Dropdown('name','designation','name'); ?>
  </select>
</div>

<div class="col-sm-6 form-group">
<label>Job Discription</label>
    <textarea class="form-control" name="job" placeholder="Enter Job Discription" autocomplete="off" required><?php if(isset($_POST['send'])){ echo $_POST['job'];} ?></textarea>
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
<input class="form-control" type="text" name="kin" placeholder="Enter Next of Kin Full Name" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['kin'];} ?>">
</div>
<div class="col-sm-4 form-group">
<label>Mobile Number</label>
<input class="form-control" type="text" name="fone3" placeholder="Enter Mobile Number" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['fone3'];} ?>">
</div>
<div class="col-sm-4 form-group">
<label>Occupation</label>
<input class="form-control" type="text" name="work" placeholder="Enter Occupation" autocomplete="off" value="<?php if(isset($_POST['send'])){ echo $_POST['work'];} ?>">
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
<input class="form-control" type="text" name="skul" placeholder="Enter School Name" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['skul'];} ?>">
</div>
<div class="col-sm-4 form-group">
<label>Cerficate</label>
<input class="form-control" type="text" name="cert" placeholder="Enter Cerficate" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['cert'];} ?>">
</div>
<div class="col-sm-4 form-group">
<label>Year</label>
<select class="form-control" name="year" title="Select Year" style="cursor:pointer;">
    <?php echo $utility->DropdownYear(1976,date('Y')); ?>
</select>
</div>

</div>

<div class="row">
  <div class="col-sm-4 form-group">
<label>School Name (2)</label>
<input class="form-control" type="text" name="skul2" placeholder="Enter School Name" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['skul2'];} ?>">
</div>
<div class="col-sm-4 form-group">
<label>Cerficate</label>
<input class="form-control" type="text" name="cert2" placeholder="Enter Cerficate" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['cert2'];} ?>">
</div>
<div class="col-sm-4 form-group">
<label>Year</label>
<select class="form-control" name="year2" title="Select Year" style="cursor:pointer;">
    <?php echo $utility->DropdownYear(1976,date('Y')); ?>
</select>
</div>

</div>


<div class="form-group">
<label>Other Qualifications</label>
<textarea class="form-control" name="oda" placeholder="Enter Other Qualification" autocomplete="off"><?php if(isset($_POST['send'])){ echo $_POST['oda'];} ?></textarea>
</div>

</div>

<hr/>
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-file"></i> Record of Service</div>                                                            
</div>

<div class="ibox-body">


<div class="form-group">
<label class="ui-checkbox ui-checkbox-gray">
  <input type="checkbox" id="leta" name="leta" value="1" required>
  <span class="input-span"></span> <b> Letter of Appointment</b></label>
</div><br/>
  
<div class="row" id="apointdiv" style="display:none;">
  <div class="col-sm-3 form-group">
<label>Date of Appointment</label>
<input class="form-control" type="date" name="apoint" placeholder="Enter Date Of Appointment" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['apoint'];} ?>">
</div>
<div class="col-sm-3 form-group">
<label>Date of Retirement</label>
<input class="form-control" type="date" name="retire" placeholder="Enter Date of Retirement" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['retire'];} ?>">
</div>
<div class="col-sm-3 form-group">
<label>Grade Level</label>
<select class="form-control" name="level" title="Select Grade Level" style="cursor:pointer;">
    <?php echo $utility->DropdownLevel(1,25); ?>
</select>
</div>

<div class="col-sm-3 form-group">
<label>Salary Scale</label>
<select class="form-control" name="scale" title="Select Year" style="cursor:pointer;">
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
  <input type="checkbox" id="dis" name="dis" value="1">
  <span class="input-span"></span> <b> Disable</b></label>
</div>

<br/>

<div class="form-group" id="doctor" style="display:none;">
<label>Doctor's Medical Report (if any)</label>
<textarea class="form-control" name="doc" placeholder="Enter Doctor's Medical Report (if any)" autocomplete="off"><?php if(isset($_POST['send'])){ echo $_POST['doc'];} ?></textarea>
</div>

<div class="form-group col-sm-5">
  <label>Upload Passport</label><br/>
  <img src="" alt="" width="80" id="tim" style="margin-top:5px;margin-bottom: 4px;" class="img-rounded lop">
  <input type="file" name="img" id="imginp" class="form-control" onchange="readURL(this)" style="border:none; cursor:pointer;padding: 4px;" required>
</div>

<div class="form-group">
    <button class="btn btn-success" type="submit" name="send" style="cursor:pointer;width:135px;font-weight:bolder;"> SUBMIT </button>
</div>

</div>


  </form>

   
    </div>
    </div>
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