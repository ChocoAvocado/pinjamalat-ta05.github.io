<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h1>RFID Login</h1>
			</div>
			<div class="card-body">
				<form method="post" action="index.php">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Tap Ur RFID" name="User_tag">
						
					</div>
					<!-- <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Pin" id="pin" name="pin" disabled>
                        <span class="eye" onclick="fungsiku()">
                        <i id="hide2" class="fa fa-eye"></i>
                        <i id="hide1" class="fa fa-eye-slash"></i>
                        </span>
					</div> -->
					<div class="form-group">
                        <input type="submit" value= "Login" class="btn float-center login_btn" name="login"></a>
					</div>
				</form>
				<!--Syarat-->
				<?php
				if(isset($_POST['login'])) {
					$Tag = $_POST['User_tag'];
					$qry = mysqli_query($conn, "SELECT * FROM user WHERE User_tag= '$Tag'");
					$cek = mysqli_num_rows($qry);
						// print_r(md5("willy"));
						// exit;
						if($cek > 0){

							$data = mysqli_fetch_assoc($qry);
				// 			print_r($data['User_nama']);
				// 			exit;
						    $_SESSION['User_nama']= $data['User_nama'];
							// cek jika user login sebagai dosen
							if($data['User_level_id']=="1"){
						   
							 // buat session login dan username
							 $_SESSION['User_tag'] = $Tag;
							 $_SESSION['User_level_id'] = "1";
							 // alihkan ke halaman dashboard dosen
							 header("location:webadmin");
						   
							// cek jika user login sebagai mahasiswa
							}else if($data['User_level_id']=="3"){
							 // buat session login dan username
							 $_SESSION['User_tag'] = $Tag;
							 $_SESSION['User_level_id'] = "3";
							 
							 // alihkan ke halaman dashboard mahasiswa
							 header("location:webuser");
						   
							} else {
								echo '<span class="errormessage">Tidak Terdaftar</span>';
							}
							} else {
								echo '<span class="errormessage">Tidak Terdaftar</span>';
							}
	
						}
				
				?>
				<!--syarat kelar-->

			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Use Another Account<a href="#">Click Here</a>
				</div>
                <div class="d-flex justify-content-center">
					<a href="email.php">Use Email/Username?</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <script>
    function fungsiku(){
        var x=document.getElementById("pin");
        var y=document.getElementById("hide1");
        var z=document.getElementById("hide2");

        if(x.type === 'Pin_User'){
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
        }
        else{
            x.type = "Pin_User";
            y.style.display = "none";
            z.style.display = "block";
        }
    }
</script> -->


</body>