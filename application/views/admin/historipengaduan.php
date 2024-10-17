<div class="container">
    <div class="row mt-5 mb-5">
      <div class="col mb-5 mt-5">
        <h3><center><label>Daftar Histori Pengaduan</label></center></h3>
        <?php if(empty($pengaduan)) : ?>
          <div class="alert alert-danger d-inline-flex" style="margin-left:15%;">
            Data pengaduan tidak ditemukan
          </div>
        <?php endif; ?>
        <div class="container-fluid">
        <center>
        <table width="60%">
            <tr>
            <form method="post" action="" class="mt-5">
              <td>
                  <select class="form-control" name="filter_bidang">
                    <option hidden value="">Pilih Bidang</option>
                    <option value="">Pilih Semua</option>
                    <?php foreach($bidang as $bdg) :?>
                      <option value="<?= $bdg['bidang']?>" ><?= $bdg['bidang'] ?></option>
                      <?php endforeach; ?>
                    </select>
              </td>
              <td>
                  <select class="form-control" name="filter_kategori">
                    <option hidden value="">Pilih Kategori</option>
                    <option value="">Pilih Semua</option>
                    <?php foreach($kategori_pengaduan as $ktgr) :?>
                      <option value="<?= $ktgr ?>" ><?= $ktgr ?></option>
                      <?php endforeach; ?>
                    </select>
              </td>
              <td>
                  <select class="form-control" name="filter_status">
                    <option hidden value="">Pilih Status</option>
                    <option value="">Pilih Semua</option>
                    <?php foreach($status_pengaduan as $sts) :?>
                      <option value="<?= $sts ?>"><?= $sts ?></option>
                      <?php endforeach; ?>
                    </select>
              </td>
              <td>
                  <select class="form-control" name="filter_jumlah">
                    <option hidden value="">10</option>
                    <?php foreach($jumlah as $jumlah) :?>
                      <option value="<?= $jumlah ?>"><?= $jumlah ?></option>
                      <?php endforeach; ?>
                    </select>
                  </td>
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
        </center>
        <center>
          <div class="container">
          <table class="table table-bordered mt-1" style="width: 90%;">
          <thead class="table-info">
            <tr>
              <th >#</th>
              <th >Tanggal Pengaduan</th>
              <th >Judul Pengaduan</th>
              <th >Bidang Pengaduan</th>
              <th >Kategori Pengaduan</th>
              <th >Lampiran</th>
              <th >Status</th>
              <th ></th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($pengaduan)) : ?>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
          </div>
        <?php endif; ?>
        <?php foreach($pengaduan as $pgd) : ?>
            <tr>
              <td><?= ++$start; ?></td>
              <td><?= $pgd['tgl_pengaduan'] ?></td>
              <td><?= $pgd['judul_pengaduan'] ?></td>
              <td><?= $pgd['bidang'] ?></td>
              <td><?= $pgd['kategori_pengaduan'] ?></td>
              <td style="max-width: 300px;">
                <img class="img-fluid" src="<?= base_url('./gambar/') . $pgd['foto_pengaduan'] ?>" >
              </td>
              <td>
                  <?php if($pgd['status_pengaduan'] == 'invalid') : ?>
                    <div class="alert alert-danger text-wrap" style="width: 7rem;">
                    Laporan Ditolak
                    </div>
                  <?php elseif($pgd['status_pengaduan'] == 'menunggu') : ?> 
                    <div class="alert alert-secondary text-wrap" style="width: 7rem;">
                    Menunggu Verifikasi
                    </div>
                    <?php elseif($pgd['status_pengaduan'] == 'proses') : ?> 
                      <div class="alert alert-warning text-wrap" style="width: 7rem;">
                      Laporan Diproses
                      </div>
                    <?php elseif($pgd['status_pengaduan'] == 'ditanggapi') : ?> 
                      <div class="alert alert-info text-wrap" style="width: 7rem;">
                      Laporan Sudah Ditanggapi
                      </div>
                    <?php elseif($pgd['status_pengaduan'] == 'lanjutan') : ?> 
                    <div class="alert alert-primary text-wrap" style="width: 7rem;">
                    Tahap Lanjutan
                    </div>
                  <?php elseif($pgd['status_pengaduan'] == 'selesai') : ?> 
                    <div class="alert alert-success text-wrap" style="width: 7rem;">
                    Laporan Selesai
                    </div>
                  <?php endif ?>
              </td>
              <td>
              <a class="btn btn-primary" href="<?= base_url(); ?>admin/detailpengaduan/<?= $pgd['id_pengaduan'] ?>" class="tombol">Detail</a><br>
              </td>
              </td>
            </tr>
          </tbody>
          <?php endforeach; ?> 
        </table>
      </div>
    </center>
  </div>
  <?= $this->pagination->create_links();?>
</div>
</div>
</div>
</div>
