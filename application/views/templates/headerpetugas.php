<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title><?= $judul  ?></title>

     <style type="text/css">
      body{
        font-family: helvetica;
        background-color: indianred;
      }

      .container{
        background-color: white;
        border-radius: 10px;
      }

      .containerdalem{
        background-color: whitesmoke;
        border-radius: 10px;
        width: 40%;  
        float: left;
        margin: 30px 0px 0px 7%;
      }

      .index{
        color: white;
        background-color: red;
        text-decoration: none;
        border-color: red;
        border-radius: 10px;
        padding: 10px;
        margin-left: 50px;
      }

      .index:hover{
        color: black;
        text-decoration: none;
        background-color: lightgrey;
      }

      th{
        text-align: center;
      }

      .tombol{
        color: red;
        background-color: white;
        text-decoration: none;
        border-color: red;
        border-radius: 5px;
        padding: 10px;
        margin: 3px 3px;
      }

      .tombol:hover{
        color: black;
        text-decoration: none;
        background-color: lightgrey;
      }

      .dropdown{
        float: right;
        position: absolute;
        margin-left: 600px;
      }

      .pagination{
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 5px;
      }

      .footer{
        text-align: right;
        background-color: white;
        padding: 2px;
      }

  </style>

  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>petugas"><button class="index"><h1>La-Por</h1></button></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> 
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="<?= base_url(); ?>petugas/historipengaduanpetugas "><button class="tombol">Histori Pengaduan</button></a>
        </div>
        <?/*php if(empty($username)){
          redirect('auth');
        }else{/*/?>
            <div class="dropdown" style="margin-left: 60%;">
              <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $username['nama_petugas'];?> - Petugas
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="<?= base_url(); ?>petugas/logout">Logout</a></li>
              </ul> 
         </div>
        <?php //} ?>  
        </div>           
      </div>
    </div>
</nav>