"use strict";
const cartTable = document.querySelector('#cartdTable');
const totalPriceElm = document.querySelector('#total_price');
const totalItemsElm = document.querySelector('#total_itmes');
const renderCart = () => {
    var totalPrice = 0;
    var totalItems = 0;
    if (localStorage.getItem('cartData')) {
        var cart_data = JSON.parse(localStorage.getItem('cartData'));
        cart_data.forEach(data => {
            const totalPriceOfThisProduct = Number(data.product_price.replace(' $', '')) * Number(data.product_qtn);
            const product_name_elm = document.createElement('td');
            const product_img_elm = document.createElement('td');
            const product__single_price_elm = document.createElement('td');
            const product_qtn_elm = document.createElement('td');
            const product_price_elm = document.createElement('td');
            product_name_elm.textContent = data.product_name;
            //img
            const productImage = document.createElement('img');
            productImage.src = data.product_iamge;
            product_img_elm.appendChild(productImage);
            product__single_price_elm.textContent = `${data.product_price.replace(' $', '')}$`;
            product_qtn_elm.textContent = `x${data.product_qtn}`;
            product_price_elm.textContent = `${totalPriceOfThisProduct}$`;
            // deleteButton
            const prodcut_close_button_elm = document.createElement('td');
            const deleteIcon = document.createElement('i');
            prodcut_close_button_elm;
            deleteIcon.classList.add('fas');
            deleteIcon.classList.add('fa-times-circle');
            prodcut_close_button_elm.appendChild(deleteIcon);
            const childBody = document.createElement('tr');
            childBody.appendChild(product_name_elm);
            childBody.appendChild(product_img_elm);
            childBody.appendChild(product__single_price_elm);
            childBody.appendChild(product_qtn_elm);
            childBody.appendChild(product_price_elm);
            childBody.appendChild(prodcut_close_button_elm);
            const allDatra = document.createElement('tbody');
            prodcut_close_button_elm.onclick = () => {
                allDatra.remove();
                localStorage.setItem('cartData', JSON.stringify(cart_data.filter(filterData => {
                    return data.product_name != filterData.product_name;
                })));
            };
            allDatra.appendChild(childBody);
            cartTable.appendChild(allDatra);
            totalPrice += totalPriceOfThisProduct;
            totalItems += Number(data.product_qtn);
        });
        if (totalPrice == 0) {
            totalPriceElm.textContent = `0`;
        }
        else {
            totalPriceElm.textContent = `${totalPrice}$`;
        }
        if (totalItems == 0) {
            totalItemsElm.textContent = `0`;
        }
        else {
            totalItemsElm.textContent = `x${totalItems}`;
        }
    }
    else {
        totalPriceElm.textContent = `0`;
        totalItemsElm.textContent = `0`;
    }
};
renderCart();
setInterval(() => {
    Array.from(cartTable.children).forEach((elm) => {
        if (elm.children[0].id != 'titles') {
            elm.remove();
        }
    });
    renderCart();
}, 1000);
/*

<tbody>
    <tr>
        <td>GTA V</td>
        <td><img src="/public/home/imgs/arifwdn-oiEXtqgBdw4-unsplash.jpg" alt=""></td>
        <td>10$</td>
        <td>x3</td>
        <td>30$</td>
        <td><i class="fas fa-times-circle"></i></td>
    </tr>
</tbody>

*/ 
