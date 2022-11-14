<?php 
//Database Connection
include('databaseconn.php');
if(isset($_POST['submit']))
  {
  	$eid=$_GET['editid'];
  	//Getting Post Values
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $contno=$_POST['contactno'];
    $email=$_POST['email'];
    $add=$_POST['address'];

      //For Image 1
		$filename = $_FILES["file1"]["name"];
		$tempname = $_FILES["file1"]["tmp_name"];
		$folder1 = "./upload/" . $filename;

	  // Now let's move the uploaded image into the folder: upload
		move_uploaded_file($tempname, $folder1);

	  //For Image 2
		$file_name = $_FILES["file2"]["name"];
		$temp_name = $_FILES["file2"]["tmp_name"];
		$folder2 = "./upload/" . $file_name;

	  // Now let's move the uploaded image into the folder: upload
		move_uploaded_file($temp_name, $folder2);

    //Query for data updation
     $query=mysqli_query($conn, "update  tblusers set FirstName='$fname',LastName='$lname', MobileNumber='$contno', Email='$email', Address='$add', Image1='$filename', Image2='$file_name' where ID='$eid'");
     
    if ($query) {
    echo "<script>alert('You have successfully update the data');</script>";
    echo "<script type='text/javascript'> document.location ='viewdata.php'; </script>";
  }
  else
    {
      echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>PHP Crud Operation!!</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 450px;
	margin: 0 auto;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: #999;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
</style>
</head>
<body>
<div class="signup-form">
    <form  method="POST" enctype="multipart/form-data">
 <?php
$eid=$_GET['editid'];
$ret=mysqli_query($conn,"select * from tblusers where ID='$eid'");
while ($row=mysqli_fetch_array($ret)) {
?>
		<h2>Update </h2>
		<p class="hint-text">Update your info.</p>
        <div class="form-group">
			<div class="row">
				<div class="col"><input type="text" class="form-control" name="fname" value="<?php  echo $row['FirstName'];?>" required="true"></div>
				<div class="col"><input type="text" class="form-control" name="lname" value="<?php  echo $row['LastName'];?>" required="true"></div>
			</div>        	
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="contactno" value="<?php  echo $row['MobileNumber'];?>" required="true" maxlength="10" pattern="[0-9]+">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" value="<?php  echo $row['Email'];?>" required="true">
        </div>
		
		<div class="form-group">
            <textarea class="form-control" name="address" required="true"><?php  echo $row['Address'];?></textarea>
        </div>
        <div class="form-group">
				<label for="filename">Update Your Profile Picture</label><br>
                <table>
                    <tr>
                        <td><input type="file" class="form-control" name="file1" onchange="readURL(this);" required="true"><br></td>
                        <td><input type="file" class="form-control" name="file2" onchange="read_URL(this);" required="true"><br></td>
                    </tr>
                </table>
                <p><strong>Your Previous Profile picture</strong></p>
                <img src="<?php echo "upload/".$row['Image1'];?> " width="100px" style="border-radius: 50%;">
                <img src="<?php echo "upload/".$row['Image2'];?> " width="100px" style="border-radius: 50%;"><br><br>
				<p><strong>Your New Profile picture</strong></p>
                <img id="one" src="#" alt="Profile 1" width="100px" style="border-radius: 50%;">
                <img id="two" src="#" alt="Profile 2" width="100px" style="border-radius: 50%;">
			</div>        
      <?php 
}?>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
        </div>
    </form>

</div>

<script>
	function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#one').attr('src', e.target.result).width(100).height(100);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

  function read_URL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#two').attr('src', e.target.result).width(100).height(100);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

</script>
</body>
</html>