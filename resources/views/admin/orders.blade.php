<?php $admin = Session::get('admin');  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset("styles/index.css") }}">
    <link rel="stylesheet" href="{{ asset("styles/3_.css") }}">
</head>
<body>
    @if (session('statusbad'))

    <p style="display: none"  class="error">{{ session('statusbad') }}</p>
    <p style="display: none"  class="boolean">{{ session('bool') }}</p>

    @elseif (session('status'))  
    <p style="display: none"  class="error">{{ session('status') }}</p>
    <p style="display: none" class="boolean">{{ session('bool') }}</p>
    @endif
    <div class="glass"></div>
    </div>
        <div class="delete_order arabicEnglishTypes">
        <p>Delete Order</p>
        <span>are you sure that</span>
        <span>you want to delete this order</span>
        <form action="{{ route("deleteorder") }}" method="POST">
            @csrf
            <input id="input_order_delete" name="id" type="hidden">
            <input type="submit" value="Delete">
        </form>
    </div>
    </div>
        <div class="refound_order arabicEnglishTypes">
        <p>Refound Order</p>
        <span>are you sure that</span>
        <span>you want to refound this order</span>
        <form action="{{ route("refound") }}" method="POST">
            @csrf
            <input id="input_order_refound" name="id" type="hidden">
            <input type="submit" value="Refound">
        </form>
    </div>
    <span class="controllerButton">controller</span>
    <aside class="cntroller">
        <p class="closeController">x</p>
        <div class="user">
            <img src="{{ asset("imgs/logo.svg") }}" alt="logo">
            <p>{{$admin["username"] }}</p>
        </div>
        <div class="selectors">
            <a href="/admin/products" >Production Management</a>
            <a href="/admin/orders" class="active">Orders</a>
            <a href="/admin/feedback">Messages</a>
            <a href="/admin/users">Users Management</a>
        </div>
        <a href="/admin/logout" class="logout">Log Out</a>
    </aside>
    <div class="mangement"> 
        <button class="backButton">Back</button>
        <div class="sendOrderEmail">
            <h1>Order detalse</h1>
            <p>ID: <span id="email_order_id"></span></p>
            <p>Emai: <span id="email_order_email"></span></p>
            <p>Phone Number: <span id="email_order_phone"></span></p>
            <p>Paid Price: <span id="email_order_price"></span></p>
            <div class="select">
                <p>Products:</p>
                <select id="email_order_products"></select>
            </div>
            <form action="{{ route("ordersendmail") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="email_odere_id_sender">
                <input type="hidden" name="email" id="email_odere_email_sender">
                <input type="text" name="title" placeholder="title">
                <textarea placeholder="Massage" name="massage"></textarea>
                <div class="fileManger">
                    <p>Import File: </p>
                    <input name="email_file" id="email_order_file" type="file">
                </div>
                <div class="ok">
                    <input type="submit" value="Send">
                </div>
                
            </form>
        </div>
        <div class="allCards">

            @foreach ($orders as  $order)
                
      
            <div class="orderCard">
                <h1>New Order</h1>
                <div class="info">
                    <div class="dateTime">
                        <p class="date">{{ $order->created_at }}</p>
                    </div>
                    <p class="id">ID: <span>{{ $order->id }}</span></p>
                    <p>Emai: <span class="new_order_email">{{ $order->email }}</span></p>
                    <p>Phone Number: <span class="new_order_phoner">{{ $order->number }}</span></p>
                    <p>Paid Price: <span class="new_order_paid_price">{{ $order->paid_price }}$</span></p>
                    <div class="select">
                        <p>Products:</p>
                        <select class="new_order_products">
                            @foreach (json_decode($order->products) as $orderproduct )
                            <option>{{ $orderproduct->name." x" }}{{ $orderproduct->qtn }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="buttons">
                    <button class="_3">Refound</button>
                    <button class="_2">Delete</button>
                    <button class="_1">Manage</button>
                </div>
            </div>
            @endforeach
        </div>
      
        <div class="arrows">
            <a type="submit" href="{{ $orders->previousPageUrl() }}" class="back allArraows">back</a>
            <div class="numbers">
                                    <a class="number">{{ $orders->currentPage() }}</a>
                @if ($orders->hasMorePages())
                    <a class="number">{{ $orders->currentPage() + 1 }}</a>
              
                        @if ($orders->hasMorePages())
                            <a class="points">...</a>
                        @endif


                    @endif
            </div>
            <a href="{{ $orders->nextPageUrl() }}" class="back allArraows">forward</a>
        </div>
    </div>
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
    <script src="{{ asset("scripts/index.js") }}"></script>
    <script src="{{ asset("scripts/_2.js") }}"></script>
</body>
</html>