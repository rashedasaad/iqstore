
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <!-- index css -->
    <style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap");
.allInvoice {
  max-width: 600px;
  margin: 0 auto;
  border-radius: 0 0 max(1vw, 1em) max(1vw, 1em);
}
.allInvoice .continer .logo {
  width: 100%;
  text-align: center;
  background-color: #4A2D67;
  padding: max(2vw, 2em) 0;
  border-radius: 10px 10px 0 0;
  text-align: center;
}
.allInvoice .continer .logo img {
  width: 300px;
}
.allInvoice .continer .logo h1 {
  text-align: center;
  color: white;
  letter-spacing: 2px;
  font-size: max(2vw, 2em);
}
.allInvoice .continer .invoice {
  width: 100%;
  text-align: center;
  background-color: #36224A;
  padding: max(2vw, 2em);
  border-radius: 0 0 10px 10px;
}
.allInvoice .continer .invoice h1 {
  text-align: center;
  color: white;
  font-size: max(2vw, 2em);
  background-color: #7C5E99;
  width: -webkit-fit-content;
  width: -moz-fit-content;
  width: fit-content;
  margin: 0 auto;
  padding: 5px max(0.4vw, 0.4em);
  border-radius: 10px;
  box-shadow: 0 0 14px 1px black inset;
}
.allInvoice .continer .invoice p {
  color: white;
  background-color: #7C5E99;
  width: 100%;
  padding: max(1vw, 1em);
  margin: max(1vw, 1em) 0 0;
  text-align: left;
  border-radius: max(0.3vw, 0.3em);
  box-shadow: 0 0 54px 15px #36224a inset;
  border: 2px solid #4a2d67;
}
.allInvoice .continer .invoice p span {
  color: rgb(232, 232, 232);
  display: block;
}

* {
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
}

body {
  background-color: #ffffff;
  overflow-x: hidden;
}
body::-webkit-scrollbar {
  width: 0.2rem;
  height: 0.4rem;
}
body::-webkit-scrollbar-track {
  background: transparent;
  cursor: pointer;
}
body::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.3411764706);
  border-radius: 1%;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}
body::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.1843137255);
}/*# sourceMappingURL=Invoice.css.map */
    </style>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">


    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="allInvoice">
        <div class="continer">
            <div class="logo">
                <img src="{{ asset('imgs/IMG_7712-removebg-preview_7.png') }}" alt="">
                <h1>IQ SKILLER</h1>
            </div>
            <div class="invoice">
      
                <h1 style="text-align: center;">{{ $info['title'] }}</h1>
             
              
                <p>{{ $info['massage'] }}
                    <br>
                </p>
            </div>
        </div>
    </div>

</body>

</html>
