<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>login with fullscreen background - Sample  - Bootsnipp.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet"> 
    <style type="text/css">

        .login2background{    
            /*background-image: url(https://s13.postimg.org/8xs7irifb/education2.png);*/
            background-repeat:no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .loginbox{  
            background: white;
            color: black;    
            margin-top: 30%;
            left: 0;
            padding: 20px;   
            box-shadow: 0 8px 50px -2px #000;
            border-radius:5px;

        }
        .logo{
            width: 50px; 
            height: 78px;
            margin-left: 10%;
        }
        @media (max-width:767px) {
            .loginbox{ 
                margin-top: 10%;
            }    
        }

        .loginbox_content{
            padding:5% 11% 5% 11%;

        }

        .singtext{
            font-family: "Open Sans",sans-serif;
            font-size: 27px;  
            color: #82C226;
            float: right;
            padding-right: 25%;
        }

        .submit-btn{
            float: right;
            margin-right: 28%;
        }

        .forgotpassword{
            padding-left: 10%;
        }
        @media (max-width:800px) {
            .submit-btn{

                margin-right: 23%;
            }


        }
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head> 
<?php
$cal_d = get_opt_calendar(14, 30); 
?>
<body class="login2background">
    <div class="container">  
        <div class="col-lg-6 col-md-6 col-sm-8  loginbox">
            <div class=" row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                    <img src="<?php echo base_url();?>assets/img/upgris.png" alt="Logo" class="logo"> 
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6  ">
                    <span class="singtext" >Log In </span>   
                </div>

            </div>
            <form action="" id="form_register" onSubmit="addsubmit();return false;" method="post">
                <fieldset>  
                    <legend>Ujian Penerimaan Mahasiswa Baru</legend>
                    <table>
                        <tbody>
                            <tr>
                                <td>Masukkan Nomor Ujian</td><td>: <input type="text" id="no_test" name="no_test" maxlength="13" size="32" class="input required"></td>
                            </tr>
                            <tr>
                                <td>Nama</td><td>: <input type="text" id="nama" name="nama" maxlength="130" size="32" class="input validate[required]"></td>
                            </tr>
                            <tr>
                                <td>Kelompok</td><td>: <select name="jurusan" id="jurusan" class="select validate[required]" onchange="geting_jurusan(this)">
                                {kelompok}</select></td>
                            </tr>
                            <tr>
                                <td>Pilihan Jurusan I</td><td>: <select name="prodi1" id="prodi1" class="select validate[required]" onchange="geting_jurusan1()">
                                <option value="" selected="">Pilih Jurusan 1</option></select></td>
                            </tr>
                            <tr>
                                <td>Pilihan Jurusan II</td><td>: <select name="prodi2" id="prodi2" class="select validate[required]">
                                <option value="" selected="">Pilih Jurusan 2</option></select></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td><td>: <select class="select validate[required]" name="jkel" id="jkel" >
                                <option value="" selected="">Pilih</option><option value="L">Laki - Laki</option><option value="P" >Perempuan</option></select></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir Anda</td>
                                <td>: 
                                    <select size="1" class="select validate[required]" name="tgl_lhr" id="tgl_lhr" >
                                        <option value="" selected="">Tgl</option><?php echo $cal_d['tanggal']; ?></select> - 
                                        <select size="1" class="select validate[required]" name="bln_lhr" id="bln_lhr" >
                                            <option value="" selected="">bln</option><?php echo $cal_d['bulan']; ?></select> - 
                                            <select size="1" class="select validate[required]" name="thn_lhr" id="thn_lhr" >
                                                <option value="" selected="">Thn</option><?php echo $cal_d['tahun']; ?></select>
                                            </td></tr>      

                                        </tbody></table>

                                        
                                        <h4>Harap Masukkan Data Anda Dengan Benar</h4>
                                    </fieldset>
                                <div class="row ">                   
                                    <div class="col-lg-8 col-md-8  col-sm-8 col-xs-7 forgotpassword "> 
                                        <a href="#"  > </a>                        
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4  col-xs-5 ">      
                                    <input class="btn btn-default submit-btn" name="pmb_info" value="LogIn" onclick="" type="submit">                   
                                  </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-4 "></div> 

                                </form>
                        </div>
                    </body>
<script type="text/javascript">
var base_url='<?php echo $base_url; ?>';
function geting_jurusan(sel) {
    //alert(sel.value); 
    var x = sel.value;
    if (x!='') { 
    $.post(base_url+'welcome/get_pilihan1', {'kelompok':x}, function(data){
    if(data.valid){
    $('#prodi1').html(data.jurusan);
    $('#prodi2').html('<option value="" selected="">Pilih Jurusan 2</option>');
    }
    }, 'json');
    } else {
    // Do nothing!
    }
}
function geting_jurusan1(){
    var x = $('#jurusan option:selected').val();
    var y = $('#prodi1 option:selected').val();  
    if (x!='') { 
    $.post(base_url+'welcome/get_pilihan2', {'kelompok':x,'pil1':y}, function(data){
    if(data.valid){
    $('#prodi2').html(data.jurusan);
    }
    }, 'json');
    }
}  
function addsubmit(){  
    var username=$('#no_test').val();
    var nama=$('#nama').val();
    var jurusan=$('#jurusan').val();
    var prodi1=$('#prodi1').val();
    var prodi2=$('#prodi2').val();
    var jkel=$('#jkel').val();
    var pass=$('#thn_lhr').val()+'-'+$('#bln_lhr').val()+'-'+$('#tgl_lhr').val();
    if((username=='')||(nama=='')||(jurusan==0)){
        alert('Isi Data Dengan Lengkap & Benar');
        return;
    }
    $('#loginform').slideUp(300);   
    $('#tunggu').show(300); 
    $.post('{base_url}welcome/eko_login',{'no_ujian':username,'tgl_lahir':pass,'nama':nama,'jurusan':jurusan,'jkel':jkel,'prodi1':prodi1,'prodi2':prodi2}, function(data){
        if(data.valid){
            document.location='{base_url}welcome/home'; 
        }else{
            alert('Maaf No Pendaftaran atau Tanggal lahir tidak sesuai...');
            $('#loginform').show(); 
            $('#tunggu').hide();
        }
    },'json');
    return false;
    
}
</script> 
</body>
</html>