<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
 
    <link rel="stylesheet" href="{{ asset("/styles/login.css") }}">
</head>
<body>
    @if (session('statusbad'))

    <p style="display: none"  class="error">{{ session('statusbad') }}</p>
    <p style="display: none"  class="boolean">{{ session('bool') }}</p>

    @elseif (session('status'))  
    <p style="display: none"  class="error">{{ session('status') }}</p>
    <p style="display: none" class="boolean">{{ session('bool') }}</p>
    @endif
    <form action="{{ route("loginstore") }}" method="POST">
        @csrf
        <h1>Login</h1>
        <input type="text" name="username" placeholder="username"/>
        <input type="password" name="password" placeholder="password"/>
        <input type="submit" value="Login">
    </form>
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
    <script src="{{ asset("scripts/login.js") }}"></script>
</body>
</html>