<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env("APP_NAME") }}</title>
    <!-- index css -->
    <link rel="stylesheet" href="{{ asset("cart/cart.css") }}">
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

    <!-- Start header -->
    <header>
        <div class="continer">
            <div class="logo">
                <img src="/public/home/imgs/IMG_7712-removebg-preview 3.svg" alt="">
                <h1>IQ- SKILLER</h1>
            </div>
            <ul class="nav">
                <div class="all-li">
                    <li><a href="/">Landing</a></li>
                    <li><a href="/">services</a></li>
                    <li><a href="/">store</a></li>
                    <li><a href="/">Contact</a></li>
                </div>

                <div class="icon">
                    <a href="/cart/ar"><i class="fas fa-globe-europe"></i></a>
                </div>
            </ul>
        </div>
    </header>
    <!-- End header -->


    <div class="cart-shop">
        <div class="continer">


            <!-- table -->
            <!-- table -->
            <div class="outputs">
                <div class="scroll">
                    <table id=cartdTable>
                        <tr id="titles">
                            <th>Product</th>
                            <th></th>
                            <th>Unit Price</th>
                            <th>quantity</th>
                            <th>total price</th>
                            <th></th>
                        </tr>
                    </table>
                </div>
                <div class="iconss">
                    <div class="lolo">
                        <i class="fas fa-car"></i>
                        <p>Lorem, ipsum dolor.</p>
                    </div>
                    <div class="lolo">
                        <i class="fas fa-chart-line"></i>
                        <p>Lorem, ipsum dolor.</p>
                    </div>
                    <div class="lolo">
                        <i class="fas fa-people-carry"></i>
                        <p>Lorem, ipsum dolor.</p>
                    </div>
                    <div class="lolo">
                        <i class="fas fa-credit-card"></i>
                        <p>Lorem, ipsum dolor.</p>
                    </div>
                    <div class="lolo">
                        <i class="fas fa-truck-moving"></i>
                        <p>Lorem, ipsum dolor.</p>
                    </div>
                    <div class="lolo">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>Lorem, ipsum dolor.</p>
                    </div>
                    <div class="lolo">
                        <i class="fab fa-uncharted"></i>
                        <p>Lorem, ipsum dolor.</p>
                    </div>
                </div>
            </div>
            <!-- table -->
            <!-- table -->


            <div class="total">
                <div class="shop-icon">
                    <i class="fas fa-cart-arrow-down"></i>
                    <h1>Cart</h1>
                </div>
                <div class="check">
                    <div class="items">
                        <h1>Total Items</h1>
                        <p id=total_itmes></p>
                    </div>
                    <div class="amount">
                        <h1>Total amount</h1>
                        <p id="total_price"></p>
                    </div>
                    <button onclick="location.href = '/card'" class="out">check out</button>
                </div>
            </div>

        </div>
    </div>



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset("cart/js/index.js") }}"></script>

</body>

</html>