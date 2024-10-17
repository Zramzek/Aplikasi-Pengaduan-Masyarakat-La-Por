<div class="container" >
    <div class="row mt-5 mb-5" >
      <div class="col mb-5 mt-5" style=" display: inline;">
        <div class="container-fluid">
        <?php if ($this->session->flashdata('message')) : ?>
        <div class="row mt-3">
          <div class="col md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Berhasil <?= $this->session->flashdata('message'); ?> Data Petugas
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <table>
          <tr>
            <td>
              <h3><center>Daftar Petugas</center></h3></td>
            <td><h3><center>Tambah Petugas</center></h3></td>
          </tr>
          <tr >
            <td width="50%">
            <?php if(empty($petugas)) : ?>
            <div class="alert alert-danger d-inline-flex" style="margin-left:15%;">
              Data petugas tidak ditemukan
          </div>
        <?php endif; ?>
            <div class="container-fluid">
        <center>
        <div class="container">
        <table class="table table-bordered mt-5">
          <thead class="table-info">
            <tr>
              <th >ID</th>
              <th >Nama</th>
              <th >Password</th>
              <th >Level</th>
              <th >Aktif</th>
              <th >Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($petugas)) : ?>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
          </div>
        <?php endif; ?>
        <?php foreach($petugas as $ptgs) : ?>
            <tr>
              <td><?= $ptgs['id_petugas'] ?></td>
              <td><?= $ptgs['nama_petugas'] ?></td>
              <td><?= $ptgs['password_petugas'] ?></td>
             <td>
               <?php if($ptgs['level'] == '1') : ?>
                <label>Admin</label>
              <?php else : ?> 
                <label>Petugas</label>
              <?php endif ?>
            </td>
              <td>
              <?php if($ptgs['aktif'] == '1') : ?>
                <label>Aktif</label>
              <?php else : ?> 
                <label>Non-Aktif</label>
              <?php endif ?>
              </td>
              <td>
                  <a class="btn btn-danger" href="<?= base_url(); ?>admin/hapuspetugas/<?= $ptgs['id_petugas'] ?>" class="tombol" onclick="return confirm('Yakin Ingin Menghapus?')">Hapus</a><br>
              </td>
              <td>
                <?php if($ptgs['aktif'] == 1) : ?>
                  <a class="btn btn-danger" href="<?= base_url(); ?>admin/nonaktifpetugas/<?= $ptgs['id_petugas'] ?>" class="tombol" onclick="return confirm('Yakin Ingin Menon-aktifkan?')">Non-Aktifkan</a><br>
                <?php else : ?> 
                  <a class="btn btn-danger" href="<?= base_url(); ?>admin/aktifpetugas/<?= $ptgs['id_petugas'] ?>" class="tombol" onclick="return confirm('Yakin Ingin Mengaktifkan?')">Aktifkan</a><br>
              <?php endif ?>
              </td>
            </tr>
          </tbody>
          <?php endforeach; ?> 
        </table>
      </div>
      </td>
      <td width="50%">
        <div class="container-fluid">
        <div class="container mt-5">
        <form action="" method="post">
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama_petugas" class="form-control">
            <small class="form-text text-danger"><?= form_error('nama_petugas'); ?></small>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password_petugas" class="form-control">
            <small class="form-text text-danger"><?= form_error('password_petugas'); ?></small>
          </div>
          <div class="mb-3">
            <label></label>
            <input class="form-check-input" type="radio" name="level" value="1"> Admin
            <input class="form-check-input" type="radio" name="level" value="2"> Petugas
            <small class="form-text text-danger"><?= form_error('level'); ?></small>
          </div>
          <div>
            <button type="submit" class="btn btn-primary mb-3">Buat</button>
          </div>

        </form>
      </div>
      </td>
      </tr>
      </table>
    </center>
  </div>
</div>
</div>
<?= $this->pagination->create_links();?>
</div>
</div>
