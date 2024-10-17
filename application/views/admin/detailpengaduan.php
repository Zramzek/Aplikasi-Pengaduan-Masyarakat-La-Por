<div class="container">
    <div class="row mt-5 mb-5">
      <div class="col mb-5 mt-5">
        <table width="90%">
          <tr>
            <td><h3><center>Detail Laporan</center></h3></td>
            <td><h3><center>Tanggapan</center></h3></td>
          </tr>
          <tr>
<td>
  <center>
        <div class="container">
        <table class="table table-borderless mt-5" style="width: 60%;">
            <tr>
              <td>ID Pengaduan</td>
              <td><?= $pengaduan['id_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Laporan</td>
                <td><?= $pengaduan['tgl_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Judul Laporan</td>
                <td><?= $pengaduan['judul_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Isi Laporan</td>
                <td><?= $pengaduan['isi_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Bidang Laporan</td>
                <td><?= $pengaduan['bidang'] ?></td>
            </tr>
            <tr>
                <td>Kategori Laporan</td>
                <td><?= $pengaduan['kategori_pengaduan'] ?></td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td><img class="img-fluid" src="<?= base_url('./gambar/') . $pengaduan['foto_pengaduan'] ?>" ></td>
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
                    Menunggu Respon Anggota
                    </div>
                  <?php elseif($pengaduan['status_pengaduan'] == 'selesai') : ?> 
                    <div class="alert alert-success text-wrap" style="width: 12rem;">
                    Laporan Selesai
                    </div>
                  <?php endif ?>
              </td>
            </tr>
            <tr>
              <td>Lanjutan Pengaduan</td>
              <?php if(!$pengaduan['lanjutan_pengaduan']) : ?>
                <td>-</td>
                <?php else : ?>
                  <td><label class="text text-danger"> <?=$pengaduan['lanjutan_pengaduan']; ?></label></td>
                <?php endif ?>  
            </tr>
            <tr>
                <td><a class="btn btn-primary float-end" href="<?= base_url(); ?>admin/historipengaduan">Kembali</a></td>
              <?php if ($pengaduan['status_pengaduan'] == 'selesai') : ?>
                <td><a class="btn btn-warning" href="<?= base_url(); ?>admin/generatelaporan/<?= $pengaduan['id_pengaduan'] ?> ?>" class="tombol">Generate</a></td>
              <?php else : ?>

              <?php endif ?>
            </tr>       
      </table>
      </div>
      <td >
        <div class="container">
        <table class="table table-borderless mt-5" >
            <?php if(empty($tanggapan) == false) : ?>
              <tr>
                    <td>Petugas</td>
                    <td>
                       : <?= $pelaksana->nama_pelaksana ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal </td>
                    <td>
                       : <?= $tanggapan['tgl_tanggapan'] ?>
                    </td>
                </tr>  
              <tr>
                    <td>Isi Tanggapan</td>
                    <td>
                       : <?= $tanggapan['isi_tanggapan'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Foto Tanggapan</td>
                    <td><img class="img-fluid" src="<?= base_url('./gambar/') . $tanggapan['foto_tanggapan'] ?>" ></td>
                </tr>
                <?php else : ?>
                    <div class="alert alert-danger d-inline-flex" style="width: 12rem;" style="margin-left:15%;">
                        Pengaduan belum ditanggapi
                    </div>
                <?php endif; ?>
                <tr>
                    <td>Isi Tanggapan Lanjutan</td>
                    <td>
                       : <label class="text text-danger"> <?=$tanggapan['lanjutan_tanggapan']; ?></label>
                    </td>
                </tr>
                <tr>
                    <td>Lampiran Lanjutan</td>
                    <td><img class="img-fluid" src="<?= base_url('./gambar/') . $tanggapan['foto_lanjutan_tanggapan'] ?>" ></td>
                    </td>
                </tr>
      </table>
      </div>
  </td>
    </center>
  </td>
          </tr>
        </table>
      </div>
    </div>
    </div>
</div>
</div>
