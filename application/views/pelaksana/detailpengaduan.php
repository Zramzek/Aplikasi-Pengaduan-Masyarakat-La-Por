<div class="container">
    <div class="row mt-5 mb-5">
      <div class="col mb-5 mt-5">
        <table width="80%" align="center">
          <tr>
            <td><h3><center>Detail Laporan</center></h3></td>
            <td><h3><center>Buat Tanggapan</center></h3></td>
          </tr>
          <tr>
      <td width="50%">
        <div class="container">
        <table class="table table-borderless mt-5" >
            <tr>
                <td>ID Pengaduan</td>
                <td>: <?= $pengaduan['id_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Laporan</td>
                <td>: <?= $pengaduan['tgl_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Judul Laporan</td>
                <td>: <?= $pengaduan['judul_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Isi Laporan</td>
                <td>: <?= $pengaduan['isi_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Bidang Laporan</td>
                <td>: <?= $pengaduan['bidang'] ?></td>
            </tr>
            <tr>
                <td>Foto Pengaduan</td>
                <td>
                <img class="img-fluid" src="<?= base_url('./gambar/') . $pengaduan['foto_pengaduan'] ?>" >
                </td>
            </tr>
            <tr>
                <td>Status Pengaduan</td>
                <td>
                  <?php if($pengaduan['status_pengaduan'] == 'invalid') : ?>
                    <div class="alert alert-danger text-wrap" style="width: 12rem;">
                    Laporan Ditolak
                    </div>
                  <?php elseif($pengaduan['status_pengaduan'] == 'menunggu') : ?> 
                    <div class="alert alert-secondary text-wrap" style="width: 12rem;">
                    Menunggu Verifikasi
                    </div>
                  <?php elseif($pengaduan['status_pengaduan'] == 'proses') : ?> 
                    <div class="alert alert-warning text-wrap" style="width: 12rem;">
                    Laporan Diproses
                    </div>
                  <?php elseif($pengaduan['status_pengaduan'] == 'ditanggapi') : ?> 
                    <div class="alert alert-info text-wrap" style="width: 12rem;">
                    Laporan Sudah Ditanggapi
                    </div>
                  <?php elseif($pengaduan['status_pengaduan'] == 'lanjutan') : ?> 
                    <div class="alert alert-primary text-wrap" style="width: 12rem;">
                    Tahap Lanjutan
                    </div>
                  <?php elseif($pengaduan['status_pengaduan'] == 'selesai') : ?> 
                    <div class="alert alert-success text-wrap" style="width: 12rem;">
                    Laporan Selesai
                    </div>
                  <?php endif ?>
              </td>
            </tr>
            <tr>
              <td>Pengaduan Lanjutan</td>
              <td>
                <?php if(!$pengaduan['lanjutan_pengaduan']) : ?>
                  -
                <?php else : ?>
                  <?=$pengaduan['lanjutan_pengaduan']; ?>
                <?php endif ?>
              </td>
            </tr>
            <tr>
                <td></td>
                <td><a class="btn btn-primary float-end" href="<?= base_url('pelaksana'); ?>">Kembali</a></td>
            </tr>       
      </table>
      </div>
  </td>
  <td width="50%" >
        <div class="container-fluid">
        <div class="container">
        <?php if(!$pengaduan['lanjutan_pengaduan'] == TRUE) : ?>
        <form action="<?= base_url(); ?>pelaksana/inputtanggapan" method="post" enctype="multipart/form-data" > 
          <input type="text" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>" hidden>
          <input type="text" name="id_pelaksana" value="<?= $pelaksana['id_pelaksana'] ?>" hidden>
          <div class="mb-3">
            <label>Isi Tanggapan</label>
            <textarea rows="6" cols="12" name="isi_tanggapan" class="form-control"></textarea>
            <small class="form-text text-danger"><?= form_error('isi_tanggapan'); ?></small>
          </div>
          <div class="mb-3">
            <label class="form-label mt-3">Bukti Penyelesaian (Wajib)</label><br>
			      <input type="file" accept="image/*" name="foto_tanggapan">
            <small class="form-text text-danger"><?= form_error('foto_tanggapan'); ?></small>
          </div>
          <div>
            <button type="submit" class="btn btn-primary mt-3">Buat</button>
          </div>
        </form>
        <?php elseif($pengaduan['lanjutan_pengaduan'] == TRUE) : ?>
          <table class="table table-borderless mt-5">
            <tr>
              <td><label for="">Nama Petugas</label></td>
              <td><?= $nama_pelaksana->nama_pelaksana ?></td>
            </tr>
            <tr>
              <td><label for="">Tanggal Penanggapan</label></td>
              <td><?= $tanggapan['tgl_tanggapan'] ?></td>
            </tr>
            <tr>
              <td><label for="">Isi Tanggapan</label></td>
              <td><?= $tanggapan['isi_tanggapan'] ?></td>
            </tr>
            <tr>
              <td><label for="">Lampiran Tanggapan</label></td>
              <td><img class="img-fluid" src="<?= base_url('./gambar/') . $tanggapan['foto_tanggapan'] ?>" ></td>
            </tr>
          </table>
          </div>
          <form action="<?= base_url(); ?>pelaksana/inputlanjutantanggapan" method="post" enctype="multipart/form-data" >
          <input type="text" name="id_tanggapan" value="<?= $tanggapan['id_tanggapan'] ?>" hidden>
          <input type="text" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>" hidden>
            <div class="mb-3">
              <label>Tanggapan Lanjutan</label>
              <textarea rows="6" cols="12" name="lanjutan_tanggapan" class="form-control" required></textarea>
              <small class="form-text text-danger"><?= form_error('lanjutan_tanggapan'); ?></small>
            </div>
            <div class="mb-3">
              <label class="form-label mt-3">Bukti Penyelesaian Lanjutan (Wajib)</label><br>
              <input type="file" name="foto_lanjutan_tanggapan" required>
            </div>
            <div>
            <button type="submit" class="btn btn-primary mt-3">Buat</button>
          </div>       
          </form>
        <?php endif ?>
      </div>
    </td>
          </tr>
        </table>
      </div>
    </div>
    </div>
</div>
</div>
