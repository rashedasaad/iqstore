<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env("APP_NAME") }}</title>
    <!-- index css -->
    <link rel="stylesheet" href="{{ asset("home/styles/index.css") }}">
    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset("css/all.css") }}">
    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body>
    @if (session('statusbad'))

    <p style="display: none"  class="error">{{ session('statusbad') }}</p>
    <p style="display: none"  class="boolean">{{ session('bool') }}</p>

    @elseif (session('status'))  
    <p style="display: none"  class="error">{{ session('status') }}</p>
    <p style="display: none" class="boolean">{{ session('bool') }}</p>
    @endif

    <!-- Start header -->
    <header>
        <div class="continer">
            <div class="logo">
                <img src="{{ asset("/home/imgs/IMG_7712-removebg-preview 3.svg") }}" alt="">
                <h1>IQ- SKILLER</h1>
            </div>
            <ul class="nav">
                <div class="all-li">
                    <li><a href="#">Landing</a></li>
                    <li><a onclick="document.getElementById('services').scrollIntoView();">services</a></li>
                    <li><a onclick="document.getElementById('product').scrollIntoView();">store</a></li>
                    <li><a onclick="document.getElementById('form-contact').scrollIntoView();">Contact</a></li>
                </div>

                <div class="icon">
                    <div class="menu__toggler active"><span></span></div>
                    <a href="/cart/en"><i class="fas fa-cart-plus"></i></a>
                    <a href="/ar"><i class="fas fa-globe-europe"></i></a>
                </div>
            </ul>
        </div>
    </header>
    <div class="menu active">
        <p>Landing</p>
        <p>services</p>
        <p>store</p>
        <p>Contact</p>
    </div>
    <!-- End header -->


    <!-- start landing -->
    <div class="landing">
        <div class="continer">
            <div class="ero">
                <div class="taitel">
                    <h1>CREATIVE UI <span>DESIGNER</span></h1>
                    <button onclick="document.getElementById('product').scrollIntoView();">store</button>
                    <button onclick="document.getElementById('form-contact').scrollIntoView();">contact</button>
                </div>
                <img src="{{ asset("/home/imgs/Vector 187.svg") }}" alt="">
            </div>
            <div class="img-logo">
                <img class="log" src="{{ asset("/home/imgs/IMG_7712-removebg-preview 3.svg") }}" alt="">
                <img class="backgr" src="{{ asset("/home/imgs/doodles mixed round.svg") }}" alt="">
            </div>
        </div>
    </div>
    <!-- End landing -->


    <!-- Start Services -->
    <div id="services" class="services">
        <div class="container">
            <div class="title">
                <h1>our services</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi necessitatibus omnis vel
                    nesciunt,porrofacilis tempora, dolor obcaecati voluptate soluta debitis odio minus molestiae
                    tenetur? Minima eaexcepturi facilis quo!</p>
            </div>
            <div class="All_card">
                <div class="flex-card">
                    <img src="{{ asset("/home/imgs/Vector 186.svg") }}" alt="">
                    <div class="box1">
                        <h2>APP Desine</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, autem. Ut enim nisi, esse
                            veritatis dolores corrupti maiores ipsum dignissimos! Neque unde fugit labore ea
                            necessitatibus
                            quo quidem error reiciendis!</p>
                        <div class="icon">
                            <i class="fa-solid fa-link"></i>
                        </div>
                    </div>
                    <div class="box2">
                        <h2>APP Desine</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia, autem. Ut enim nisi, esse
                            veritatis dolores corrupti maiores ipsum dignissimos! Neque unde fugit labore ea
                            necessitatibus
                            quo quidem error reiciendis!</p>
                        <div class="icon">
                            <i class="fa-solid fa-link"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="postion">
                <img src="{{ asset("/home/imgs/undraw_share_link_re_54rx 1.svg") }}" alt="">
            </div>
        </div>
    </div>
    <!-- End Services -->


    <!-- Start products -->
    <div class="products">
        <div class="title">
            <h1>our products</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.!</p>
        </div>

        <div class='asid'>

            <div class='asidContiner'>
                <div class='selct_box'>
                    <div class="logooo">
                        <img src="{{ asset("home/imgs/IMG_7712-removebg-preview 3.svg") }}" alt="">
                    </div>
                    <ul class="nav">
                        <li class="active" data-cat="all"> ALL</li>
                        @foreach ($lang_arrays as $lang_array )

                            <li data-cat="{{$lang_array["en"]}}"> {{$lang_array["en"]}}</li>
                        
                        @endforeach
                    </ul>
                </div>

                <div class="Section">
                    <div class="allcard">
                        <div id="product" class="contenar">
                            <!--  -->
                       @foreach ( $products as $product )
                            <div class="box all">
                                <div class="prod">
                                    <img src="<?php echo asset("images")."/".$product->img ?>" alt="">
                                </div>
                                <div class="taitel">
                                    <h1>{{ $product->name }}</h1>
                                    <p class="productId" style="display: none;">{{ $product->id }}</p>
                                    <div class="type">
                                        <div class="total">
                                            <p class="section_name">{{ $product->section }}</p>
                                            <h3>{{ $product->price }} <span>$</span></h3>
                                        </div>
                                        <select name="" class="foo">

                                        </select>
                                    </div>
                                </div>
                                <div class="add_to_cart">
                                    <button class="popap-card">Add to Cart <i class="fas fa-cart-plus"></i></button>
                                </div>
                            </div>
                                 
                       @endforeach

                        </div>
                        <div class="arrows">
                            <a  href="{{ $products->previousPageUrl() }}"  class="back allArraows"><i class="fa-solid fa-chevron-left"></i></a>
                            <div class="numbers">
                                <a class="number">{{ $products->currentPage() }}</a>
                                @if ($products->hasMorePages())
                                <a class="number">{{ $products->currentPage() + 1 }}</a>
                        
                                    @if ($products->hasMorePages())
                                        <a class="points">...</a>
                                    @endif
            
        
                                @endif
                            </div>
                            <a  href="{{ $products->nextPageUrl() }}" name="forward" class="back allArraows"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End products -->

    <!-- Start contact -->
    <div class="contact">
        <div class="container">
            <div class="titel_contact">
                <h1>Got a project in <span>mind?</span></h1>
                <img class="rotet" src=" {{ asset("/home/imgs/3232Vector 186.svg") }}" alt="">
                <div class="coimgs">
                    <img src=" {{ asset("/home/imgs/Group 2372.svg") }}" alt="">
                </div>
            </div>

            <div class="alllbro">
                <img class="z0" src="{{ asset("/home/imgs/keyboard.svg") }}" alt="">
                <div id="form-contact" class="form-contact">
                    <form action="{{ route("formcontact") }}" method="POST">
                        @csrf
                        <div class="total">
                            <h1>Your email</h1>
                            <input type="email" placeholder="email" name="email">
                        </div>
                        <div class="total">
                            <h1>phone number</h1>
                            <input type="number" name="number" placeholder="number">
                        </div>
                        <div class="total">
                            <h1>Your Message</h1>
                            <textarea class="input" placeholder="Tell Us About Your Needs" name="message"></textarea>
                        </div>
                        <button class="submitt" type="submit"><i class="fa-regular fa-paper-plane"></i>send</button>
                    </form>
                </div>
                <img class="z1" src="{{ asset("/home/imgs/mail.svg") }}" alt="">
            </div>
        </div>
    </div>
    <!-- End contact -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let error = document.querySelector(".error")
let bool = document.querySelector(".boolean")

if (error.value != "") {
    if(bool.textContent == true){
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: error.textContent,
        showConfirmButton: false,
        timer: 4500
        })
        
    }else if(bool.textContent == false){
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: error.textContent,
        showConfirmButton: false,
        timer: 4500
        })
    }
}
    </script>
    <script src="{{ asset("home/scripts/index.js") }}"></script>
</body>

</html>