<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" /> 
    <title>CBT Upgris</title> 
    <link href="{base_url}assets/css/bootstrap.css" rel="stylesheet" /> 
    <link href="{base_url}assets/css/font-awesome.css" rel="stylesheet" /> 
    <link href="{base_url}assets/css/style.css" rel="stylesheet" /> 
</head>
<body>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">

                    <img src="{base_url}assets/img/upgris.png" style="width: 60px;"/>
                </a>

            </div> 
        </div>
    </div>
    <!-- LOGO HEADER END-->
    {menus}
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">{page_title}</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        Computer Base Test - ujian Masuk Penerimaan Mahasiswa Baru Universitas PGRI Semarang.
                    </div>
                </div>

            </div>
            <div class="row">
             <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Hasil Test 
                    </div>

                    <div class="panel-body">
                      <p>Test Potensi Akademik = {tpa} Point</p>
                      <div class="progress">
                          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {tpa}%"> 
                          </div>
                      </div>
                      <p>Test Skala Kepribadian</p>
                      <div class="progress">
                          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {skala}%"> 
                          </div>

                      </div> 

                      <a href="{base_url}welcome/cetak_hasil_tpa" class="btn btn-primary">Cetak Hasil Test TPA</a>
                      <a href="#" class="btn btn-danger">Cetak Hasil Test Skala</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div> 
</div> 
</div>
</div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                &copy; 2017  | By : BPTIK - UPGRIS
            </div>

        </div>
    </div>
</footer>
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY SCRIPTS -->
<script src="{base_url}assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="{base_url}assets/js/bootstrap.js"></script>
</body>
</html>
