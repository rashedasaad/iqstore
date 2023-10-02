<?php $admin = Session::get('admin');  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('styles/index.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/4_.css') }}">
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
    <div class="delete_Msg arabicEnglishTypes">
        <p>Delete Massage</p>
        <span>are you sure that</span>
        <span>you want to delete this massage?</span>
        <form action="{{ route("deletefeedback") }}" method="POST">
            @csrf
            <input id="input_msg_delete" name="id" type="hidden">
            <input type="submit" value="Delete">
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
            <a href="/admin/orders">Orders</a>
            <a href="/admin/feedback" class="active" >Messages</a>
            <a href="/admin/users">Users Management</a>
        </div>
        <a href="/admin/logout"  class="logout">Log Out</a>
    </aside>
    <div class="mangement">
        <button class="backButton">Back</button>
        <div class="rplaySection">
            <div class="dateTime">
                <p class="date">2022-8-12</p>
                <p class="time">10:15</p>
            </div>
            <h1>Massage Details</h1>
            <div class="info">
                <p>id: <span id="re_msg_id"></span></p>
                <p>Email: <span id="re_msg_email"></span></p>
                <p>Phone Number: <span id="re_msg_phone"></span></p>
                <div id="re_msg_content" class="content"></div>
            </div>
            <form action="{{ route("feedbacksendmail") }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="input_msg_id" name="id">
                <input type="hidden" id="input_msg_email" name="email">
                <input type="text" placeholder="Title" name="title">
                <textarea placeholder="Rplay Massage" name="massage"></textarea>
                <div class="fileImprorter">
                    <p>Import File</p>
                    <input type="file" name="email_file" multiple >
                </div>
                <div class="sendBox">
                    <input type="submit" value="Send">
                </div>
            </form>
        </div>
        <div class="allMsges">

            @foreach ($messges as $messge)
                <div class="singleMsg">
                    <h1>New Massage</h1>
                    <div class="info">
                        <div class="dateTime">
                            <p class="date">{{ $messge['created_at'] }}</p>
                        </div>
                        <p class="backMsg" style="display: none;">{{ $messge['message'] }}
                        </p>
                        <p>id: <span class="msg_id">{{ $messge['id'] }}</span></p>
                        <p>Email: <span class="msg_email">{{ $messge['email'] }}</span></p>
                        <p>Phone Number: <span class="msg_phone">{{ $messge['phone_number'] }}</span></p>
                        <div class="content"></div>
                    </div>
                    <div class="buttons">
                        <button class="_1">Replay</button>
                        <button class="_2">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>

    
            <div class="arrows">
                <a type="submit" href="{{ $messges->previousPageUrl() }}" class="back allArraows">back</a>
                <div class="numbers">
                                        <a class="number">{{ $messges->currentPage() }}</a>
                    @if ($messges->hasMorePages())
                        <a class="number">{{ $messges->currentPage() + 1 }}</a>
                  
                            @if ($messges->hasMorePages())
                                <a class="points">...</a>
                            @endif
    

                        @endif
                </div>
                <a href="{{ $messges->nextPageUrl() }}" class="back allArraows">forward</a>
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
    <script src="{{ asset('scripts/index.js') }}"></script>
    <script src="{{ asset('scripts/_3.js') }}"></script>
</body>

</html>
