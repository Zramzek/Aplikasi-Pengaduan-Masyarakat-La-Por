<div class="container mt-5 mb-5">
    <div class="row mt-5 mb-5">
        <div class="col mt-5 mb-5">
            <center><h3><label>Generate Laporan</label></h3></center>
            <form action="" id="formgenerate">
                <select class="form-control" style="width: auto;" class="pilih_bidang" id="pilih_bidang">
                    <option hidden value="">Pilih Bidang</option>
                    <?php foreach($bidang as $bdg) :?>
                      <option value="<?= $bdg['bidang']?>" ><?= $bdg['bidang'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Cetak</button>
            </form>
        </div>
        <div class="col-md-9">
            <div id="result">
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script>
  $(document).ready(function() {
    $('#formgenerate').submit(function(e){
      e.preventDefault();
      var id = $('#pilih_bidang').val();
      //console.log(id);
      var url = "<?= site_url('Admin/filterlaporan/') ?>" + id;
      $('#result').load(url); 
    })
  });
</script>