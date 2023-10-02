//
let navList = document.querySelectorAll(".nav li");
let boxs = Array.from(document.querySelectorAll(`.Section .box`));

window.scrollTo({
    left:0
})

navList.forEach((li) => {
    li.addEventListener("click", removeActive);
    li.addEventListener("click", mangbox);
});


function removeActive() {
    navList.forEach((li) => {
        li.classList.remove("active");
        this.classList.add("active");
    });
}

function mangbox() {
    boxs.forEach((box) => {
        const sectionName = box.querySelector('.section_name')
        box.style.display = "none";
        console.log()
        if(sectionName.textContent.toLocaleLowerCase() == this.dataset.cat.toLocaleLowerCase()
         || this.dataset.cat.toLocaleLowerCase() == 'all' 
         || this.dataset.cat.toLocaleLowerCase() == 'الكل' 
         ){
            box.style.display = 'block'
        }
    });
}
//

const allSections = []
const AllSEctions = document.querySelectorAll('.section_select')
AllSEctions.forEach(selectSction => {
    allSections.push({
        cat:selectSction.dataset.cat,
        arText:selectSction.textContent
    })
    selectSction.dataset.cat = selectSction.textContent
})
boxs.forEach((box) => {
    const sectionName = box.querySelector('.section_name')
    allSections.forEach(value =>{
        if(value.cat == sectionName.textContent){
            sectionName.textContent = value.arText
        }
    })
});
// Popap card
let popap_card = document.querySelectorAll(".popap-card");
let box = document.querySelectorAll(".box");

popap_card.forEach((elem) => {
    elem.onclick = function () {
        let card = elem.parentElement.parentElement;
        const cardImg = card.querySelector("img");
        const cardName = card.querySelector("h1");
        const productId = card.querySelector(".productId");
        const Type = card.querySelector(".type p");
        const productprice = card.querySelector("h3");
        const qtn = card.querySelector('.foo')

        const finlData = {
            product_iamge: cardImg.src.trim(),
            product_name: cardName.textContent.trim(),
            product_id: productId.textContent.trim(),
            product_typeType: Type.textContent.trim(),
            product_price: productprice.textContent.trim(),
            product_qtn: qtn.value.trim()
        };

        if (!localStorage.getItem("cartData") || localStorage.getItem("cartData").length == 0) {
            localStorage.setItem("cartData", JSON.stringify([finlData]));
        } else {
            const filterCart = JSON.parse(localStorage.getItem("cartData")).filter(value => {
                if (value.product_id == finlData.product_id) {
                    return false
                }
                return true
            })
            localStorage.setItem(
                "cartData",
                JSON.stringify([...filterCart, finlData])
            );
        }


        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });

        Toast.fire({
            icon: "success",
            title: `تمت إضافة المنتج ${cardName.textContent.trim()} بالكمية x${qtn.value.trim()}`,
        });
    };
});
// Popap card





// select
const createSelect = () => {
    const getAllProduct = document.querySelectorAll('.box .foo')
    getAllProduct.forEach(product => {
        for (let i = 1; i <= 100; i++) {
            const option = document.createElement('option')
            option.textContent = i
            option.value = i
            product.appendChild(option)
        }
    })
}
createSelect()
// select




const toggler = document.querySelector('.menu__toggler');
const menu = document.querySelector('.menu');


toggler.addEventListener('click', () => {
    toggler.classList.toggle('active');
    menu.classList.toggle('active');
})