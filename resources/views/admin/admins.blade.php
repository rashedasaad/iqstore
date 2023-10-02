<?php $admin = Session::get('admin');  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset("/styles/index.css") }}">
    <link rel="stylesheet" href="{{ asset("/styles/5_.css") }}">
</head>
<body>
    @if (session('statusbad'))

    <p style="display: none"  class="error">{{ session('statusbad') }}</p>
    <p style="display: none"  class="boolean">{{ session('bool') }}</p>

    @elseif (session('status'))  
    <p style="display: none"  class="error">{{ session('status') }}</p>
    <p style="display: none" class="boolean">{{ session('bool') }}</p>
    @endif
    <div class="create_new_user_form">
        <h1>Create New User</h1>
        <form action="{{ route("createuser") }}" method="POST">
            @csrf
            <input type="text" class="username" placeholder="username" name="username">
            <input type="password" class="password" placeholder="password" name="password">
            <input type="password" class="password" placeholder="re password" name="re_password">
            <div class="buttons">
                <div class="showPassword">Show Password</div>
                <input type="submit" value="Create">
            </div>
            
        </form>
    </div>
    <div class="update_user_form">
        <h1>Update User</h1>
        <form action="{{ route("updateuser") }}" method="POST">
            @csrf
            <input type="hidden" class="update_form_user_id" name="id">
            <input type="text" class="username" placeholder="username" name="username">
            <input type="password" class="password" placeholder="password" name="password">
            <input type="password" class="password" placeholder="re password" name="re_password">
            <div class="buttons">
                <div class="showPassword_update">Show Password</div>
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
    <div class="delete_user arabicEnglishTypes">
        <p>Delete User</p>
        <span>are uou sure that you</span>
        <span>want to delete this user?</span>
        <form action="{{ route("deleteuser") }}" method="POST">
            @csrf
            <input class="input_user_delete" name="id" type="hidden">
            <input type="submit" value="Delete">
        </form>
    </div>
    <div class="glass"></div>
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
            <a href="/admin/feedback" >Messages</a>
            <a href="/admin/users" class="active" >Users Management</a>
        </div>
        <a href="/admin/logout"  class="logout">Log Out</a>
    </aside>
    <div class="mangement">
        <button class="backButton">Back</button>
        <div class="userManage">
            <h1>Manage User</h1>
                <p id="mannge_user_id" style="display: none;"></p>
                <p>Username: <span id="mange_username"></span></p>
                <button class="update" id="mange_update">Update User</button>
                <button class="delete" id="mange_delete">Delete User</button>
        </div>
        <div class="userersDiplay">
            <button class="createUser">Create New User</button>
            <div class="allUsers">
                @foreach ($users as $user)
                <div class="single_user">
                    <p class="user_id" style="display: none;">{{ $user["id"] }}</p>
                    <p class="username">{{ $user["username"] }}</p>
                </div>
                @endforeach
           
             
            </div>
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
    <script src="{{ asset("scripts/_4.js") }}"></script>
</body>
</html>