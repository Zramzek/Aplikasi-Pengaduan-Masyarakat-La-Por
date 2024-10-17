<style type="text/css">
	.container{
		background-color: lightgrey;
		border-radius: 10px;
		width: 50%;
	}	

</style>

<div class="container mt-5 mb-5">
<form method="post" action="" enctype="multipart/form-data" >
	<center><div class="card mt-3 mb-3" style="width: 90%;"></center>
	<h2><center><strong>Form Tambah Laporan</strong></center></h2>
	<?php if ($this->session->flashdata('gagal')) : ?>
        <div class="row mt-3">
          <div class="col md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 30%;">
                <?= $this->session->flashdata('message'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
        <?php endif; ?>
	<div class="card-body">
		<div class="mb-3">
			<input type="text" class="form-control" name="id_anggota" value=" <?= $anggota['id_anggota']; ?>" hidden>
		</div>
		<div class="mb-3">
	    <label class="form-label"><b>Bidang Laporan</b></label>
	    <select class="form-control" name="bidang" required>
	    	<option hidden value="">Pilih Bidang Laporan</option>
	    	<?php foreach($bidang as $bdg) :?>
    			<option value="<?= $bdg['bidang']?>" ><?= $bdg['bidang'] ?></option>
	    	<?php endforeach; ?>
	    </select>
	    <small class="form-text text-danger"><?= form_error('bidang'); ?></small>
	  </div>
	  <div class="mt-3">
		<div class="row align-items">
		<label class="form-label"><b>Kategori Laporan</b></label>
			<?php foreach($kategori as $ktgr) :?>
				<div class="col">
					<input class="form-check-input" type="radio" name="kategori_pengaduan" value="<?= $ktgr ?>" required>
					<label class="form-label">
						<?= $ktgr ?>
					</label>
				</div>
			<?php endforeach; ?>
		</div>
	  </div>
		<div class="mb-3">
			<label class="form-label mt-3"><b>Judul Laporan</b></label>
			<input type="text" class="form-control" name="judul_pengaduan" required>
			<small class="form-text text-danger"><?= form_error('judul_pengaduan'); ?></small>
		</div>
	  <div class="mb-3">
	    <label class="form-label"><b>Isi Laporan</b></label><br>
	    <textarea class="form-control" name="isi_pengaduan" required></textarea>
	    <small class="form-text text-danger"><?= form_error('isi_pengaduan');  ?></small>
	  </div>
	  <div class="mb-3">
			<label class="form-label mt-3"><b>Lampiran (max 2mb)</b></label><br>
			<input type="file" name="foto_pengaduan" size="20" required>
	</div>
	  <div class="mb-3 form-check">
	  </div>
	  <button type="submit" class="btn btn-primary mb-3">Buat Laporan</button>
	</div>
	</div>
</form>
	
</div>