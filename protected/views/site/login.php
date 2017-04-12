<style>
.login-image {
	height:50%;
	width:50%;
}
</style>
<?php /*
$to = "dedemaulanapriatna@gamil.com";
$subject = "HTML email";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";
$message = wordwrap($message, 70, "\r\n");

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <islademuerta847@gmail.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

if(mail($to,$subject,$message,$headers)) :
?>
<script>
	alert('email has send');
</script>
<?php endif; */?>
<div class="login-box">
  <center>
	<img class="login-image" src="<?=Yii::app()->request->baseUrl?>/themes/alte/dist/img/banner.png" alt="User Image">
  </center>
  <div class="login-logo">
    <a><b>PaperlessFlow</b> Systems</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?php $form=$this->beginWidget('CActiveForm', array('enableAjaxValidation'=>false)); ?>
      <div class="form-group has-feedback">
		<?php echo $form->textField($model,'username',array('class'=>'form-control', 'placeholder'=>'Type Your Email / Username Here', 'required'=>'true')); ?>
		<?php echo $form->error($model,'username'); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control', 'placeholder'=>'Type Your Password Here', 'required'=>'true')); ?>
		<?php echo $form->error($model,'password'); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <?php echo $form->checkBox($model,'rememberMe', array('class'=>'checkbox')); ?>
			  <?php echo $form->label($model,'rememberMe'); ?>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    <?php $this->endWidget(); ?>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br> -->
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->