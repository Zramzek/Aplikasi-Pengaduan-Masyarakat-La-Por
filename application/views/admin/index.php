<div class="container">
    <div class="row mt-5 mb-5">
      <div class="col mb-5 mt-5">
        <h3><center>Ada <?= $jumlah_pengaduan ?> Laporan Terbaru</center></h3>
        <?php if(empty($pengaduan)) : ?>
          <div class="alert alert-danger mt-5">
            Tidak ada Laporan terbaru
          </div>
        <?php endif; ?>
        <div class="container-fluid">
        <?php if ($this->session->flashdata('message')) : ?>
        <div class="row mt-3">
          <div class="col md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 30%;">
                Berhasil <?= $this->session->flashdata('message'); ?> Laporan
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <table class="mt-5" width="20%" align="center">
            <tr>
            <form method="post" action="" class="mt-5">
        <td>
                    <select class="form-control" name="filter_urut">
                    <option hidden value="">Urut Tanggal</option>
                    <option value="DESC">Paling Baru</option>
                    <option value="ASC">Paling Awal</option>
                    </select>
              </td>
                  <td>
                    <button type="pilih_jumlah" class="btn btn-primary">Cari</button>
                  </td>
        </form>
        </tr>
        </table>
        <?php foreach($pengaduan as $pgd) :?>
        <div class="containerdalem">
          <center>
        <table class="table  mt-5" style="width: 40%;">
            <thead class="table-info table-dark">
                <td>--</td>
                <td>--</td>
            </thead>
            <tr>
                <td><b>ID Pengaduan</b></td>
                <td><?= $pgd['id_pengaduan'] ?></td>
            </tr>
            <tr>
                <td><b>Tanggal</b></td>
                <td><?= $pgd['tgl_pengaduan'] ?></td>
            </tr>
            <tr>
                <td><b>Judul</b></td>
                <td><?= $pgd['judul_pengaduan'] ?></td>
            </tr>
            <tr>
                <td><b>Isi</b></td>
                <td><?= $pgd['isi_pengaduan'] ?></td>
            </tr>
            <tr>
                <td><b>Bidang</b></td>
                <td><?= $pgd['bidang'] ?></td>
            </tr>
            <tr>
                <td><b>Lampiran</b></td>
                <td><img class="img-fluid" src="<?= base_url('./gambar/') . $pgd['foto_pengaduan'] ?>" ></td>
            </tr>
            <tr>
              <td>
                <a class="btn btn-primary" href="<?= base_url(); ?>petugas/terimapengaduan/<?= $pgd['id_pengaduan'] ?>" onclick="return confirm('Terima Pengaduan?');">Terima Pengaduan</a>
              </td>
              <td>
                <a class="btn btn-primary float-end" href="<?= base_url(); ?>petugas/tolakpengaduan/<?= $pgd['id_pengaduan'] ?>" onclick="return confirm('Tolak Pengaduan?');">Tolak Pengaduan</a>
              </td>
            </tr>
          </table>
        </center>         
      </div>
      <?php endforeach ?>
    </div>
  </div>
  <?= $this->pagination->create_links();?>
</div>
</div>
