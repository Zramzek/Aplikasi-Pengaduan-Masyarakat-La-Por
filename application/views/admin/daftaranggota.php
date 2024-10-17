<div class="container">
    <div class="row mt-5 mb-5">
      <div class="col mb-5 mt-5">
        <h3><center>Daftar Anggota</center></h3>
        <?php if(empty($anggota)) : ?>
          <div class="alert alert-danger d-inline-flex" style="margin-left:15%;">
            Data anggota tidak ditemukan
          </div>
        <?php endif; ?>
        <div class="container-fluid">
        <?php if ($this->session->flashdata('message')) : ?>
        <div class="row mt-3">
          <div class="col md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 30%;">
                Berhasil <?= $this->session->flashdata('message'); ?> Anggota
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <form method="post" action="">
          <div class="input-group mt-5" style="width: 30%; margin-left: 15%;"> 
            <input type="text" class="form-control" placeholder="Cari Nama Anggota" name="keyword">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </div>
        </form>
        <center>
        <div class="container">
        <table class="table table-bordered mt-5">
          <thead class="table-info">
            <tr>
              <th >#</th>
              <th >ID Anggota</th>
              <th >Nama Anggota</th>
              <th >Email Anggota</th>
              <th >Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($anggota)) : ?>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
          </div>
        <?php endif; ?>
        <?php foreach($anggota as $agt) : ?>
            <tr>
              <td><?= ++$start; ?></td>
              <td><?= $agt['id_anggota'] ?></td>
              <td><?= $agt['nama_anggota'] ?></td>
              <td><?= $agt['email_anggota'] ?></td>
              <td>
                  <?php if($agt['aktif'] == '1') : ?>
                    <div class="alert alert-success d-inline-flex" >
                      Aktif
                    </div>
                  <?php else : ?> 
                    <div class="alert alert-warning d-inline-flex" >
                      Non-Aktif
                    </div>
                  <?php endif ?>
              </td>
              <td>
              <?php if($agt['aktif'] == '1') : ?>
                  <a class="btn btn-danger" href="<?= base_url(); ?>admin/nonaktifanggota/<?= $agt['id_anggota'] ?>" class="tombol" onclick="return confirm('Yakin Ingin Menon-aktifkan?')">Non-Aktifkan</a><br>
                <?php else : ?> 
                  <a class="btn btn-danger" href="<?= base_url(); ?>admin/aktifanggota/<?= $agt['id_anggota'] ?>" class="tombol" onclick="return confirm('Yakin Ingin Mengaktifkan?')">Aktifkan</a><br>
              <?php endif ?>
              </td>
            </tr>
          </tbody>
          <?php endforeach; ?> 
        </table>
      </div>
    </center>
  </div>
</div>
</div>
<?= $this->pagination->create_links();?>
</div>
</div>
