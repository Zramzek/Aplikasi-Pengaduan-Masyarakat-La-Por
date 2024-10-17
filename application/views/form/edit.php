<style type="text/css">
	.container{
		background-color: lightgrey;
		border-radius: 6px;
		width: 40%;
	}	

</style>


<div class="container mt-3 mb-3">
		<h1><center>Form Edit Data</center></h1>
	<form action="" method="post">
		<input type="hidden" name="id" value="<?= $pegawai['nip']; ?>">
		<div class="mb-3 mt-4">
			<label class="form-label">NIP</label>
			<input type="number" class="form-control" name="nip" id="nip" value="<?= $pegawai['nip']; ?>" readonly>
		</div>
		<div class="mb-3">
			<label class="form-label">Nama</label>
			<input type="text" class="form-control" name="nama" id="nama" value="<?= $pegawai['nama']; ?>">
			<small class="form-text text-danger"><?= form_error('nama'); ?></small>
		</div>
	  <div class="mb-3">
	    <label for="alamat" class="form-label">Alamat</label><br>
	    <textarea class="form-control" name="alamat" id="alamat" ><?= $pegawai['alamat']; ?></textarea>
	    <small class="form-text text-danger"><?= form_error('alamat'); ?></small>
	  </div>
	  <div class="mb-3">
	    <label for="kota" class="form-label">Kota</label>
	    <select class="form-control" name="kota" id="kota">
	    	<?php foreach($kota as $kt) :?>
	    		<?php if ($kt == $pegawai['kota']) : ?>
	    			<option value="<?= $kt?>" selected><?= $kt ?></option>
	    		<?php else : ?>
	    			<option value="<?= $kt?>" ><?= $kt ?></option>
	    		<?php endif; ?>
	    	<?php endforeach; ?>
	    </select>
	  </div>
	  <div class="form-check mb-3" >
	  	  <label for="jenkel" class="form-label">Jenis Kelamin :</label><br>
		  <input class="form-check-input" type="radio" name="jenkel" value="Perempuan" >
		  <label class="form-check-label">Perempuan</label><br>
		  <input class="form-check-input" type="radio" name="jenkel" value="Laki-Laki" >
		  <label class="form-check-label" >Laki-Laki</label>
		  <small class="form-text text-danger"><?= form_error('jenkel'); ?></small>
	  </div>
	  <div class="mb-3">
	    <label for="jabatan" class="form-label">Jabatan</label>
	    <select class="form-control" name="jabatan" id="jabatan" >
	    	<?php foreach($jabatan as $jb) :?>
	    		<?php if ($jb == $pegawai['jabatan']) : ?>
	    			<option value="<?= $jb?>" selected><?= $jb ?></option>
	    		<?php else : ?>
	    			<option value="<?= $jb?>" ><?= $jb ?></option>
	    		<?php endif; ?>
	    	<?php endforeach; ?>
	    </select>
	  </div>
	  <div class="mb-4">
			<label class="form-label">Nomor Telepon</label>
			<input type="number" class="form-control" minlength="10" maxlength="12" name="telp" id="telp" value="<?= $pegawai['telp']; ?>" >
			<small class="form-text text-danger"><?= form_error('telp'); ?></small>
	  </div>
	  <div class="input-group">
	  	  <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $pegawai['email']; ?>">
	  	  <span class="input-group-text">@gmail.com</span><br>
	  </div><small class="form-text text-danger"><?= form_error('email'); ?></small>
	  <div class="mb-3 form-check">
	    <input type="checkbox" class="form-check-input" >
	    <label class="form-check-label" >Sudah Cek Ulang?</label>
	  </div>
	  <button type="submit" name="edit" class="btn btn-primary mb-3">Edit Data</button>
</form>
	
</div>