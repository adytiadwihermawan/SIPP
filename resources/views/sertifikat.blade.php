<html>
    <head>
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                font-family:Verdana, sans-serif;;
                font-size: 24px;
           
            }
            .container {
                background-image: url("dist/img/bg2.png");
                background-size: cover;
                width: 29.7cm;
                height: 20.5cm;
                image-rendering: -webkit-optimize-contrast;
                margin: none;
                position: fixed;
                text-align: center;
              
            }
           
            .nama {
                font-size: 1cm;
                color:#16558f ;
                margin-top:6cm;

            }
       
            .nim {
                color:#16558f ;
                font-size: 0.6cm;
                margin-top: 0.2cm;
            }
            .matkul {
                font-size: 0.6cm;
                margin-top: 1.6cm;
            }
        </style>
    </head>
    <body>
        
        <div class="container">
            
            <div class="nama">
               <b>    {{$data->nama_user}}</b>
            </div>
            <div class="nim">
                <b>  {{$data->username}}</b>
            </div>
            <div class="matkul">
                <b>   {{$data->nama_praktikum}}</b>
            </div>
            

        </div>
    </body>
</html>