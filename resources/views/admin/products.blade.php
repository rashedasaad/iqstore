 
<?php $admin = Session::get('admin');  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset("styles/index.css") }}">
    <link rel="stylesheet" href="{{ asset("styles/2_.css") }}">
</head>
<body>
    @if (session('statusbad'))
    <p style="display: none"  class="error">{{ session('statusbad') }}</p>
    <p style="display: none"  class="boolean">{{ session('bool') }}</p>
    @elseif (session('status'))  
    <p style="display: none"  class="error">{{ session('status') }}</p>
    <p style="display: none" class="boolean">{{ session('bool') }}</p>
    @endif
    <span class="controllerButton">controller</span>
    <div class="glass"></div>
    <div class="selector_config_1">
        <button id="ubdate_type">Update</button>
        <p>or</p>
        <button id="create_new_type">Create</button>
        <p>or</p>
        <button class="deleteOption" id="delete_type">Delete</button>
    </div>
    <div class="selector_config_2 arabicEnglishTypes">
        <p>Create new type</p>
        <form action="{{ route("create_type") }}" method="POST">
            @csrf
            <input type="text" name="arabic_type" placeholder="Type Arabic Name">
            <input type="text" name="english_type"  placeholder="type english name">
            <input type="submit" value="Create">
        </form>
    </div>
    <div class="selector_config_3">
        <p>Ubdate Type</p>
        <div>
            <select>
                <option></option>
            </select>
        </div>
    </div>
    <div class="selector_config_4 arabicEnglishTypes">
        <p>Update type</p>
        <form action="{{ route("update_type") }}" method="POST">
            @csrf
            <input id="selectType" name="target" type="hidden">
            <input type="text" name="arabic_type" placeholder="Type Arabic Name">
            <input type="text" name="english_type" placeholder="Type English Name">
            <input type="submit" value="Update">
        </form>
    </div>
    <div class="delete_product arabicEnglishTypes">
        <p>Delete Product</p>
        <span>are you sure that</span>
        <span>you want to delete this product?</span>

        <form action="{{ route("deleteproduct") }}" method="POST">
            @csrf
            <input id="selectProduct" name="id" type="hidden">
            <input type="submit" value="Delete">
        </form>

    </div>
    <div class="delete_type arabicEnglishTypes">
        <p>Delete Type</p>
        <span>are you sure that</span>
        <span>you want to delete this type?</span>
        <form action="{{ route("delete_type") }}" method="POST">
            @csrf
            <input id="selectType_delete" name="target" type="hidden">
            <input type="submit" value="Delete">
        </form>
    </div>
    <div class="delete_typeselector">
        <p>Delete Type</p>
        <div>
            <select>
                <option></option>
            </select>
        </div>
    </div>
    <aside class="cntroller">
        <p class="closeController">x</p>
        <div class="user">
            <img src="{{ asset("imgs/logo.svg") }}" alt="logo">
            <p>{{$admin["username"] }}</p>
        </div>
        <div class="selectors">
            <a href="#" class="active">Production Management</a>
            <a href="/admin/orders">Orders</a>
            <a href="/admin/feedback">Messages</a>
            <a href="/admin/users">Users Management</a>
        </div>
        <a href="/admin/logout"  class="logout">Log Out</a>
    </aside>
    <div class="mangement">
        <button class="backButton">Back</button>
        <div class="updatePtoduct">
            <form action="{{ route("updateproduct") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flexPlace">
                    <div class="imageMsnge">
                        <div class="image">
                            <img id="update_image" src="">
                        </div>
                        <label for="updateImage">Update Image</label>
                        <input name="image" id="updateImage" style="display: none;" type="file">
                    </div>
                    <div class="inputs">
                        <h1 id="update_productName_1">Product Name</h1>
                        <input type="hidden" name="id" id="update_id">
                        <input name="product_name" id="update_productName_2" type="text" placeholder="Product Name">
                        <input  name="product_price" id="update_price" type="number" placeholder="Price">
                        <select name="type" id="update_selector">
                        </select>
                    </div>
                </div>
                <div class="flexButtons">
                    <input type="submit" value="update"/>
                    <div id="deleteProductButton">delete</div>
                </div>
            </form>
        </div>
        <div class="cards">
            <div class="types">
                <div class="active">All</div>
            </div>
            <div class="products">
                    <div class="arrows">
                        <a type="submit" href="{{ $products->previousPageUrl() }}"  class="back allArraows">back</a>
                        <div class="numbers">
                            <a class="number">{{ $products->currentPage() }}</a>
                            @if ($products->hasMorePages())
                            <a class="number">{{ $products->currentPage() + 1 }}</a>
                      
                                @if ($products->hasMorePages())
                                    <a class="points">...</a>
                                @endif
        
    
                            @endif
                        </div>
                        <a type="submit" href="{{ $products->nextPageUrl() }}" name="forward" class="back allArraows">forward</a>
                    </div>

                    @foreach ($products as $product)
                        
                <div class="product">
                    <p style="display:none;" class="productId">{{ $product->id }}</p>
    
                    <img src="<?php echo asset("images")."/".$product->img ?>" alt="">
                    <p>Name: <span>{{ $product->name }}</span></p>
                    <p>Price: <span>{{ $product->price }}$</span></p>
                    <p>type: <span class="type">{{ $product->section }}</span></p>
                </div>

                @endforeach
            </div>
        </div>
        <div class="addProducts">
            <form action="{{ route("createproduct") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="product_name" placeholder="Product Name">
                <input type="number" name="product_price" placeholder="Price">
                <div class="select">
                    <select name="type" id="create_selector">

                        @foreach ($secions as $secion )

                        <option>{{ $secion["en"] }}</option>
            
                        @endforeach
                    </select>
                    <p id="plusSelect">+</p>
                </div>
                <label class="fileImporter" for="fileUplader">Import Image</label>
                <input type="file" name="image" id="fileUplader">
                <input type="submit" value="Create New Product">
            </form>
            <div class="image">
                <img id="newProdcutImage">
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
    <script src="{{ asset("scripts/_1.js") }}"></script>
</body>
</html>