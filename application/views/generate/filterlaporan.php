<table class="table table-stripped">
    <tr>
        <th >#</th>
        <th >Tanggal Pengaduan</th>
        <th >Judul Pengaduan</th>
        <th >Bidang Pengaduan</th>
        <th >Lampiran</th>
        <th >Status</th>
    </tr>
    <?php foreach($pengaduan as $pgd) : ?>
            <tr>
              <td><?= ++$start; ?></td>
              <td><?= $pgd['tgl_pengaduan'] ?></td>
              <td><?= $pgd['judul_pengaduan'] ?></td>
              <td><?= $pgd['bidang'] ?></td>
              <td style="max-width: 300px;">
                <img class="img-fluid" src="<?= base_url('./gambar/') . $pgd['foto_pengaduan'] ?>" >
              </td>
              <td><?= $pgd['status_pengaduan'] ?></td>
              <td>
              <a class="btn btn-primary" href="<?= base_url(); ?>admin/detailpengaduan/<?= $pgd['id_pengaduan'] ?>" class="tombol">Detail</a><br>
              </td>
              </td>
            </tr>
          </tbody>
          <?php endforeach; ?> 
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script>
  $(document).ready(function() {
    $('#formgenerate').submit(function(e){
      e.preventDefault();
      var bidang = $('#pilih_bidang').val();
      //console.log(id);
      var url = "<?= site_url('Admin/filterlaporan/') ?>" + bidang;
      $('#result').load(url); 
    })
  });
</script>