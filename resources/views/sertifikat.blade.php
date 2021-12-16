<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <style type="text/css">
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                font-family: Georgia, serif;
                font-size: 24px;
                text-align: center;
            }
            .container {
                background-image: url("dist/img/Sertifikatbg.png");
                background-size: cover;
                width: 29.7cm;
                height: 21cm;
                margin: none;
                vertical-align: middle;
              
            }
           

            .judul {
                
                color:#16558f ;
                font-size: 45px;
                
            }
           
            .person {
                font-size: 35px;
                color:#16558f ;
                margin: 20px auto;
                width: 800px;
            }
            .reason {
                margin:14px;
                font-size: 16px;
            }
            .nim {
                color:#16558f ;
                font-size: 20;
            }
            .matkul {
                margin: 20px;
                font-size: 25px;
            }
            .ttd{
                width: 3cm;
                height: 2cm;
            }
        </style>
    </head>
    <body>
        <input hidden id="id"> 
        <div class="container">
        
<br>
<br>
<br>
<br>
            <div class="judul">
                SERTIFIKAT
            </div>

            <div class="reason">
                DIBERIKAN KEPADA
            </div>

            <div class="person">
                {{$data->nama_user}}
            </div>
            <div class="nim">
                {{$data->username}}
            </div>

            <div class="reason">
                Telah Menjadi Asisten Praktikum Mata Kuliah
            </div>
            <div class="matkul">
                {{$data->nama_praktikum}}
            </div>
            <div class="reason">
               Program Studi Teknologi Informasi<br/>
               Universitas Lambung Mangkurat
                <br>
                <br>
                <br>
                <b> Mengetahui</b>

            </div>
            <div class="nim">
                Koordinator Program Studi Teknologi Informasi
            </div>
            <div class="ttd">

            </div>
            <div class="reason">
                <b>Ir.Muhammad Alkaff,S.Kom.,M.Kom.,IPM</b>
                <br>
                NIP.198606132015041001
                </div>
            
            <br>
            <br>
            <br>

        </div>
    </body>
</html>