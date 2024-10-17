<html>
<head>
	<title><?= $judul; ?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

	<style type="text/css">
      body{
        font-family: helvetica;
      }

      .login{
        padding: 1em;
        margin: 1em auto;
        width: 17em;
        width: 30%;
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

      .form-control{
				border-radius: 20px;
			}
      
  </style>

<body>
	<br><br>

	<div class="login">
	<center><h2>LOGIN PELAKSANA</h2></center><br><br>
			<?= $this->session->flashdata('message') ?>
		<form action="" method="post" >
			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control form-control-sm" name="nama_pelaksana" value="<?= set_value('nama_pelaksana'); ?>">
				<small class="form-text text-danger"><?= form_error('nama_pelaksana'); ?></small>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password_pelaksana" class="form-control">
				<small class="form-text text-danger"><?= form_error('password_pelaksana'); ?></small>
			</div>
			<div >
				<input type="submit" name="kirim" value="Login" class="tombol"><br>
                <label>Login sebagai <a href="<?= base_url(); ?>auth" class="tombol">Anggota</a>/<a href="<?= base_url(); ?>auth/loginpetugas" class="tombol">Petugas</a><br></label>        
			</div>
		</form>
	</div>
</body>
