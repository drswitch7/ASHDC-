<?php
include('incs/hd.php');

$add= new EstateManagement;
$utility= new Utility;


if(isset($_POST['send'])){
//if($_POST['mode']!='0'){
  if($_POST['estate']!='0'){
    if($_POST['plot']!=''){
      if($_POST['size']!=''){
      if(ctype_alpha($_POST['fname'])!=''){
        if($_POST['lname']!=''){
          if($_POST['dob']!=''){
            if($_POST['national']!='0'){
              if($_POST['state']!='0'){
                if($_POST['lga']!='0'){
                  if($_POST['home']!=''){
                    if($_POST['town']!=''){
                      if($_POST['adrex']!=''){
                        if($_POST['fone']!=''){
    $file= $_FILES['img'];
  if($file['name']!=''){
    $imgid= substr(sha1(uniqid().$_POST['plot']),4,6).'_'.$_POST['fname'];
    $log=array('jpg','jpeg','png');
    $ge= explode('.',$file ['name']);
    $get=strtolower(end($ge));
    if(in_array($get,$log)){ 
      $path=LOCALPAT.'assets/img/client/'.$imgid.'.'.$get;
      $dburl= SERVERPAT.'assets/img/client/'.$imgid.'.'.$get;
      $move=move_uploaded_file($_FILES['img']['tmp_name'],$path);
    try{
     $send= $add->AddClientRecord($_POST['estate'],$_POST['plot'],$_POST['size'],$_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['national'],$_POST['state'],$_POST['lga'],$_POST['home'],$_POST['town'],$_POST['adrex'],$_POST['fone'],$_POST['fone2'],$dburl);
    }catch(Exception $e){$er= $e->getMessage(); unlink($path);}
                              }else{$er='Invalid passport format; Passport should be in Jpg, Jpeg or Png';}
                            }else{$er='Passport is Required';}
                          }else{$er='Phone Number is Required';}
                        }else{$er='Residential Address is Required';}
                      }else{$er='Home Town Address is Required';}
                    }else{$er='Home Town is Required';}
                  }else{$er='Local Government is Required';}
                }else{$er='State of Origin is Required';}
              }else{$er='Nationality is Required';}
            }else{$er='Date of Birth is Required';}
          }else{$er='Allotee Last Name is Required (You can Include other name)';}
        }else{$er='Allotee First Name is Required (Alphabet Only)';}
      }else{$er='Plot size is required';}
      }else{$er='Plot Number is Required';}
    }else{$er='Estate Name is Required';}
  //}else{$er='Constent To Transfer is Required';}
} 


?>

<style type="text/css">label{font-weight:bolder;}</style>

<div class="page-heading">
  <h1 class="page-title"></h1>
</div>
            
            
<div class="row">

<div class="col-md-8">
<div class="ibox">
<div class="ibox-head">
<div class="ibox-title"><i class="fa fa-plus-square"></i> Add Client Record</div>                                                            
</div>

<div style="margin:5px 10px;">                            
<?php 
if(isset($_POST['send']))if($er){echo '<div class="alert alert-warning text-center text-uppercase" style="padding:3px !important;">
<i class="fa fa-times-circle"></i> '.$er.'</div>';}elseif(isset($send)){echo '<div class="alert alert-success text-center text-uppercase" style="padding:3px !important;"><i class="fa fa-check-circle"></i> '.$send.'</div>'.'<script type="text/javascript">jQuery(document).ready(function(e){setTimeout(function(){window.location.href="'.$_SERVER['PHP_SELF'].'";},2000);});</script>';} 
?>                                
</div> 
      

<div class="ibox-body">
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="row">
<!-- 
<div class="col-sm-6 form-group">
    <label>Constent To Transfer</label>
    <select class="form-control" name="mode" title="Select Constent To Transfer" style="cursor:pointer;">
  <option value="0">- Select -</option>
  <option value="1"> NO </option>
  <option value="2"> YES </option>
    </select>
</div> -->
<div class="col-sm-6 form-group">
    <label>Select Estate</label>
    <select class="form-control" name="estate" title="Select Estate" style="cursor:pointer;">
      <?php echo $utility->Dropdown('name','estates WHERE status=1','name'); ?>
    </select>
</div>
</div>

<div class="row">

<div class="col-sm-6 form-group">
    <label>Plot Number</label>
    <input class="form-control" name="plot" type="text" placeholder="Enter Plot Number" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['plot'];} ?>">
</div>

<div class="col-sm-6 form-group">
    <label>Plot Size</label>
    <input class="form-control" name="size" type="text" placeholder="Enter Plot Size" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['size'];} ?>">
</div>

</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>Allotee First Name</label>
<input class="form-control" type="text" name="fname" placeholder="Enter Allotee First Name" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['fname'];} ?>">
</div>
<div class="col-sm-6 form-group">
<label>Allotee Last Name</label>
<input class="form-control" type="text" name="lname" placeholder="Enter Allotee Last Name" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['lname'];} ?>">
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
    <label>Date of Birth</label>
    <input class="form-control" name="dob" type="date" placeholder="Enter Date of Birth" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['dob'];} ?>">
</div>

<div class="col-sm-6 form-group">
    <label>Nationality</label>
    <select class="form-control" name="national" title="Select Nationality" style="cursor:pointer;">
<?php if(isset($_POST['send']))if($_POST['national']!='0'){ ?><option value="<?php echo $_POST['national']; ?>"><?php if($_POST['national']==1){echo 'Non Nigerian';}else{echo 'Nigerian';} ?></option><?php } ?>      
      <option value="0">- Select -</option>
        <option value="1">Non Nigerian</option>
        <option value="2">Nigerian</option>
    </select>
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>State</label>
  <select class="form-control" id="state" name="state" title="Select State" style="cursor:pointer;">
<?php if(isset($_POST['send']))if($_POST['state']!='0'){ ?>
  <option value="<?php echo $_POST['state']; ?>"><?php echo $utility->Changer("state WHERE id='{$_POST['state']}'")->state; ?></option>   
  <?php } ?> 
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
<label>Home Town Address</label>
<input class="form-control" type="text" name="town" placeholder="Enter Home Town Address" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['town'];} ?>">
</div>
</div>

<div class="form-group">
    <label>Residential Address</label>
    <textarea class="form-control" name="adrex" type="text" placeholder="Enter Residential Address" autocomplete="off" required><?php if(isset($_POST['send'])){ echo $_POST['adrex'];} ?></textarea>
</div>

<div class="row">
<div class="col-sm-6 form-group">
<label>Mobile Number</label>
<input class="form-control" type="text" name="fone" placeholder="Enter Mobile Number" autocomplete="off" required value="<?php if(isset($_POST['send'])){ echo $_POST['fone'];} ?>">
</div>
<div class="col-sm-6 form-group">
<label>Phone Number</label>
<input class="form-control" type="text" name="fone2" placeholder="Enter Phone Number" autocomplete="off" value="<?php if(isset($_POST['send'])){ echo $_POST['fone2'];} ?>">
</div>
</div>

<div class="form-group col-sm-5">
  <label>Upload Passport</label><br/>
  <img src="" alt="" width="80" id="tim" style="margin-top:5px;margin-bottom: 4px;" class="img-rounded lop">
  <input type="file" name="img" id="imginp" class="form-control" onchange="readURL(this)" style="border:none; cursor:pointer;padding: 4px;" required>
</div>

<div class="form-group">
    <button class="btn btn-success" type="submit" name="send" style="cursor:pointer;width:135px"> SUBMIT </button>
</div>

    </form>

    </div>
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