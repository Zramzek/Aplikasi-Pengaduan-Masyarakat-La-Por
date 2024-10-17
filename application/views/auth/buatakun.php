<!DOCTYPE html>
<html>
<head>
	<title><?= $judul; ?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style type="text/css">
      body{
        font-family: helvetica;
      }

      .daftar{
        padding: 1em;
        margin: 1em auto;
        width: 17em;
        width: 60%;
        background-color: lightpink;
        border-radius: 6px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      }

      .tombol{
        background-color: lightblue;
        color: black;
        text-decoration: none;
        border: 0;
        border-radius: 5px;
        padding: 5px 8px;
        margin: 20px 10px;
      }

      .tombol:hover{
        color: black;
        text-decoration: none;
        background-color: white;
      }

      .form-group{
      	width: 40%;
      	display: inline-table;   
      	margin-left: 30px;	  
	  }

	  .form-control{
		border-radius: 20px;
	  }

	</style>
</head>
<body>
	<br>
	<div class="daftar">
	<center><h2><strong>BUAT AKUN</strong></h2></center><br>
		<form action="" method="post">
			<div class="form-group ">
				<label>Nama :</label>
 				<input type="text" class="form-control form-control-user" name="nama_anggota" value="<?= set_value('nama_anggota'); ?>">
 				<small class="form-text text-danger pl-1"><?= form_error('nama_anggota'); ?></small>
 			</div>
 			<div class="form-group">	
				<label>Email :</label>
 				<input type="email" class="form-control" name="email_anggota" value="<?= set_value('email_anggota'); ?>">
 				<small class="form-text text-danger pl-1"><?= form_error('email_anggota'); ?></small>
			</div>
 			<div class="form-group" style="float-right">
  				<label>Password :</label>
  				<input type="password" class="form-control" name="password_anggota">
  				<small class="form-text text-danger pl-1"><?= form_error('password_anggota'); ?></small>
			</div>
			<div class="form-group" style="float-right">
  				<label>Ulangi Password :</label>
  				<input type="password" class="form-control" name="password2">
  				<small class="form-text text-danger pl-1"><?= form_error('password2'); ?></small>
			</div>
			<div class="form-group">
				<input type="submit" name="kirim" value="Buat Akun" class="tombol">
				<a href="<?= base_url(); ?>auth/index" class="tombol">Sudah Punya Akun?</a>
			</div>	
		</form>
	</div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-
q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>