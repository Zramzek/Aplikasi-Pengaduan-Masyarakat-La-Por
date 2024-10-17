<div class="container">
    <div class="row mt-5 mb-5">
      <div class="col mb-5 mt-5" >
        
        <div class="container-fluid">
        <?php if ($this->session->flashdata('message')) : ?>
        <div class="row mt-3">
          <div class="col md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert" >
                Berhasil <?= $this->session->flashdata('message'); ?> Data Pelaksana
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <table>
          <tr>
            <td><h3><center>Daftar Pelaksana</center></h3></td>
            <td><h3><center>Tambah Pelaksana</center></h3></td>
          </tr>
          <tr >
            <td width="50%">
            <?php if(empty($pelaksana)) : ?>
          <div class="alert alert-danger d-inline-flex" style="margin-left:15%;">
            Data pelaksana tidak ditemukan
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
              <th >Bidang</th>
            </tr>
          </thead>
          <tbody>
            <?php if(empty($pelaksana)) : ?>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
          </div>
        <?php endif; ?>
        <?php foreach($pelaksana as $plks) : ?>
            <tr>
              <td><?= $plks['id_pelaksana'] ?></td>
              <td><?= $plks['nama_pelaksana'] ?></td>
              <td><?= $plks['password_pelaksana'] ?></td>
              <td><?= $plks['bidang'] ?></td>
              <td>
                  <a class="btn btn-danger" href="<?= base_url(); ?>admin/hapuspelaksana/<?= $plks['id_pelaksana'] ?>" class="tombol" onclick="return confirm('Yakin Ingin Menghapus?')">Hapus</a><br>
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
            <input type="text" name="nama_pelaksana" class="form-control">
            <small class="form-text text-danger"><?= form_error('nama_pelaksana'); ?></small>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password_pelaksana" class="form-control">
            <small class="form-text text-danger"><?= form_error('password_pelaksana'); ?></small>
          </div>
          <div class="mb-3">
            <select class="form-control" name="bidang">
              <option hidden value="">Pilih Bidang Pengaduan</option>
              <?php foreach($bidang as $bdg) :?>
                <option value="<?= $bdg['bidang']?>" ><?= $bdg['bidang'] ?></option>
              <?php endforeach; ?>
            </select>
            <small class="form-text text-danger"><?= form_error('bidang'); ?></small>
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
  <?= $this->pagination->create_links();?>
</div>
</div>
</div>
</div>
