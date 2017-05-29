<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" /> 
    <title>CBT Upgris</title> 
    <script src="{base_url}assets/js/jquery.min.js"></script> 
    <script src="{base_url}assets/js/jquery.time-to.js"></script>
    <link href="{base_url}assets/css/bootstrap.css" rel="stylesheet" /> 
    <link href="{base_url}assets/css/font-awesome.css" rel="stylesheet" /> 
    <link href="{base_url}assets/css/style.css" rel="stylesheet" />  
    <link href="{base_url}assets/css/timeTo.css" type="text/css" rel="stylesheet"/>
    <style type="text/css">
        .soal_hide{
            display: none;
        }
        .tdk_pilih{
            color: #fff;
            background-color: #5bc0de;
            border-color: #46b8da;
            margin-right: 50px;
        }
        .pilih{
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
            margin-right: 50px;
        }
    </style>
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
              {petunjuk}
          </div>
          <div class="row">
            <div class="col-md-9"> 
                {soal}
            </div> 
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        LEMBAR MONITOR JAWABAN
                    </div>        
                    <div id="countdown-1" style="text-align: center;"></div> 
                    <script> 
                        $('#countdown-1').timeTo({timer}, function(){
                           // alert('Waktu Habis');
                            tempAlert("Waktu Telah Habis",5000);
                           // setTimeout( window.location = '{base_url}Welcome/home', 5000);
                            
                        });
                        
                    </script>
                    <h3 style="text-align:center;" ><input class="btn simpan btn-warning" value="Simpan" onclick="send_jwb();" /></h3>
                    <div class="panel-body"> 
                        {monitor}
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
                &copy; 2017 UPGRIS
            </div>

        </div>
    </div>
</footer>
<script src="{base_url}assets/js/jquery-1.11.1.js"></script>
<script src="{base_url}assets/js/bootstrap.js"></script>
<script>
//get listing id soal from daftar
var daftar = $("#rekap").val();
eval('var obj='+daftar); 
    $( document ).ready(function() {
      to_soal(1);
      for (i = 0; i < 100 ; i++) { update_monitor(i);} 
      send_jwb();
  });
    function next(no) { 
      $("#soal"+no).hide(); 
      $("#soal"+(parseInt(no)+1)).show();
  }
  function back(no) {
      $("#soal"+no).hide();
      $("#soal"+(parseInt(no)-1)).show();
  } 
  $(".next").click( function() {
    var no = $(this).val();
    next(no);
})

  $(".back").click( function() {
    var no = $(this).val();
    back(no); 
})
  $(".jawaban").click( function() { 
    var c = $(this).attr('class');
    var no = c.split(' ');
    var nomor  = no[2].split('-');
    jawab(nomor);
})
  $(".monitor").click( function() { 
    var c = $(this).attr('class');
    var no = c.split(' ');
    var nomor  = no[2].split('-');
    to_soal(nomor[1]);
})
  function jawab(nomor) {
    var btn = nomor[0]+"-"+nomor[1]; 
    $("."+btn).toggleClass('pilih tdk_pilih'); 
    update_monitor(nomor[0]); 
    switch(nomor[1]) {
        case "A": 
        update_ljk(nomor[0],"A");
        $("."+nomor[0]+"-B").removeClass('pilih'); $("."+nomor[0]+"-B").addClass('tdk_pilih');$("."+nomor[0]+"-C").removeClass('pilih'); $("."+nomor[0]+"-C").addClass('tdk_pilih');$("."+nomor[0]+"-D").removeClass('pilih'); $("."+nomor[0]+"-D").addClass('tdk_pilih');$("."+nomor[0]+"-E").removeClass('pilih'); $("."+nomor[0]+"-E").addClass('tdk_pilih'); 
        break;
        case "B":
        update_ljk(nomor[0],"B");
        $("."+nomor[0]+"-A").removeClass('pilih'); $("."+nomor[0]+"-A").addClass('tdk_pilih');$("."+nomor[0]+"-C").removeClass('pilih'); $("."+nomor[0]+"-C").addClass('tdk_pilih');$("."+nomor[0]+"-D").removeClass('pilih'); $("."+nomor[0]+"-D").addClass('tdk_pilih');$("."+nomor[0]+"-E").removeClass('pilih'); $("."+nomor[0]+"-E").addClass('tdk_pilih'); 
        break;
        case "C":
        update_ljk(nomor[0],"C");
        $("."+nomor[0]+"-B").removeClass('pilih'); $("."+nomor[0]+"-B").addClass('tdk_pilih');$("."+nomor[0]+"-A").removeClass('pilih'); $("."+nomor[0]+"-A").addClass('tdk_pilih');$("."+nomor[0]+"-D").removeClass('pilih'); $("."+nomor[0]+"-D").addClass('tdk_pilih');$("."+nomor[0]+"-E").removeClass('pilih'); $("."+nomor[0]+"-E").addClass('tdk_pilih'); 
        break;
        case "D":
        update_ljk(nomor[0],"D");
        $("."+nomor[0]+"-B").removeClass('pilih'); $("."+nomor[0]+"-B").addClass('tdk_pilih');$("."+nomor[0]+"-C").removeClass('pilih'); $("."+nomor[0]+"-C").addClass('tdk_pilih');$("."+nomor[0]+"-A").removeClass('pilih'); $("."+nomor[0]+"-A").addClass('tdk_pilih');$("."+nomor[0]+"-E").removeClass('pilih'); $("."+nomor[0]+"-E").addClass('tdk_pilih'); 
        break;
        case "E":
        update_ljk(nomor[0],"E");
        $("."+nomor[0]+"-B").removeClass('pilih'); $("."+nomor[0]+"-B").addClass('tdk_pilih');$("."+nomor[0]+"-C").removeClass('pilih'); $("."+nomor[0]+"-C").addClass('tdk_pilih');$("."+nomor[0]+"-D").removeClass('pilih'); $("."+nomor[0]+"-D").addClass('tdk_pilih');$("."+nomor[0]+"-A").removeClass('pilih'); $("."+nomor[0]+"-A").addClass('tdk_pilih'); 
        break;
    }
    send_jwb()
} 
function to_soal(nomer) {
    for (i = 0; i < 50 ; i++) { 
      $("#soal"+i).hide();
  }
  $("#soal"+nomer).show();
}
function update_monitor(nomor) {  
    if ($("."+nomor+"-A").hasClass('pilih') || $("."+nomor+"-B").hasClass('pilih') || $("."+nomor+"-C").hasClass('pilih') || $("."+nomor+"-D").hasClass('pilih') || $("."+nomor+"-E").hasClass('pilih')){
        $(".M-"+nomor).removeClass('btn-default');
        $(".M-"+nomor).addClass('btn-success');
    }else{
        $(".M-"+nomor).removeClass('btn-success');
        $(".M-"+nomor).addClass('btn-default');
    } 
} 
function update_ljk(noljk,jwb) {  

    if (obj['S'+noljk]==jwb){
        obj['S'+noljk]="X"; 
    }else{
        obj['S'+noljk]=jwb; 
    }
    
    //alert(JSON.stringify(obj));
}
function send_jwb(){    
    $("#rekap").val(JSON.stringify(obj));
    $.post('{base_url}welcome/save_jwb',{'jawaban':JSON.stringify(obj)}, function(data){
        if(data.valid){
           // alert('save oke');
        }else{
            alert('Maaf silahkan di ulang');
        }
    },'json');
    return false;
}
function tempAlert(msg,duration)
{
     var el = document.createElement("div");
     el.setAttribute("style","position:absolute;top:40%;left:20%;background-color:white;");
     el.innerHTML = msg;
     setTimeout(function(){
      el.parentNode.removeChild(el);
     },duration);
     document.body.appendChild(el);
}
</script> 
</body>
</html>