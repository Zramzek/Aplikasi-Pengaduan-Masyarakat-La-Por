<html><head>    
    <title>Laporan ID Pengaduan <?= $pengaduan['id_pengaduan'] ?></title>
    <style>
        img{
            margin-left: 65%;
            width: 150px;
            position: absolute;
        }

        .header{
            margin-left: 25%;
            font-size: 20pt;
            font-weight: bold;
        }

        .pengaduan{
            margin-top: 150px;
            margin-left: 20%;
            position: absolute;
            align-items: center;
        }

        .tanggapan{
            margin-top: 150px;
            margin-left: 300px;
            position: absolute;
            align-items: center
        }

        th{
            text-align: left;
        }

        td{
            padding: 5px;
        }
    </style>
</head><body>
        <img src="./gambar/logo.png" alt="">
        <table class="header">
            <tr>
                <td>
                    <label>La-Por</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Aplikasi Pengaduan Masyarakat</label>
                </td>
            </tr>
        </table>
        <hr>
        <table class="pengaduan" >  
        <tr>
            <td collspan="2"><b><h2>Pengaduan</h2></b></td>
            <td></td>
        </tr>
        <tr>
            <th>ID</th>
            <td >
                <?= $pengaduan['id_pengaduan'] ?>
            </td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td >
                <?= $pengaduan['tgl_pengaduan'] ?>
            </td>
        </tr>
        <tr>
            <th>Judul</th>
            <td >
                <?= $pengaduan['judul_pengaduan'] ?>
            </td>
        </tr>
        <tr>
            <th>Isi</th>
            <td >
                <?= $pengaduan['isi_pengaduan'] ?>
            </td>
        </tr>
        <tr>
            <th>Bidang</th>
            <td >
                <?= $pengaduan['bidang'] ?>
            </td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td >
                <?= $pengaduan['kategori_pengaduan'] ?>
            </td>
        </tr>
        <tr>
            <th>Lampiran</th>
            <td >
                <img src="<?= base_url('./gambar/') . $pengaduan['foto_pengaduan'] ?>" alt="">
            </td>
        </tr>
        <tr>
            <th>Lanjutan</th>
            <?php if(empty($pengaduan['lanjutan_pengaduan'])) : ?>
                <td>-</td>
            <?php else : ?>
                <td><?= $pengaduan['lanjutan_pengaduan'] ?></td>
            <?php endif ?>    
        </tr>
    </table>
    <table class="tanggapan">
        <tr>
            <td collspan="2"><b><h2>Tanggapan</h2></b></td>
            <td></td>
        </tr>
        <tr>
            <th>Petugas</th>
            <td><?= $pelaksana->nama_pelaksana ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td >
                <?= $tanggapan['tgl_tanggapan'] ?>
            </td>
        </tr>
        <tr>
            <th>Isi</th>
            <td >
                <?= $tanggapan['isi_tanggapan'] ?>
            </td>
        </tr>
        <tr>
            <th>Lampiran</th>
            <td>
                <img src="<?= base_url('./gambar/') . $pengaduan['foto_tanggapan'] ?>" alt="">
            </td>
        </tr>
        <tr>
            <th>Lanjutan</th>
            <?php if(!$pengaduan['lanjutan_pengaduan']) : ?>
                <td>-</td>
            <?php else : ?>
                <td><?= $pengaduan['lanjutan_tanggapan'] ?></td>
            <?php endif ?>    
        </tr>
        <tr>
            <th>Lampiran Lanjutan</th>
            <?php if(!$pengaduan['lanjutan_pengaduan']) : ?>
                <td>-</td>
            <?php else : ?>
                <img src="<?= base_url('./gambar/') . $pengaduan['foto_lanjutan_tanggapan'] ?>" alt="">
            <?php endif ?>    
        </tr>
    </table>
</body></html>

