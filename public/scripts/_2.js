"use strict";
const delete_order = get('.delete_order');
const refound_order = get('.refound_order');
const input_order_delete = get('#input_order_delete');
const allCardsBox = get('.allCards');
const thsglass = get('.glass');
const input_order_refound = get('#input_order_refound');
const orderCard = getAll('.orderCard');
const orderFather = get('.orderCard');
const sendOrderEmail = get('.sendOrderEmail');
const thsbackButton = get('.backButton');
const email_order_id = get('#email_order_id');
const email_order_email = get('#email_order_email');
const email_order_phone = get('#email_order_phone');
const email_order_price = get('#email_order_price');
const email_order_products = get('#email_order_products');
const email_odere_id_sender = get('#email_odere_id_sender');
const email_odere_email_sender = get('#email_odere_email_sender');
const arrowsEmail = get('.arrows');
thsglass.onclick = async () => {
    input_order_delete.value = '';
    input_order_refound.value = '';
    thsglass.style.opacity = '0';
    refound_order.style.scale = '0';
    delete_order.style.scale = '0';
    await sleep(500);
    thsglass.style.display = 'none';
    delete_order.style.display = 'none';
    refound_order.style.display = 'none';
};
thsbackButton.onclick = () => {
    arrowsEmail.style.display = 'flex';
    email_odere_email_sender.value = '';
    email_odere_id_sender.value = '';
    email_order_email.textContent = '';
    email_order_phone.textContent = '';
    email_order_price.textContent = '';
    email_order_id.textContent = '';
    allCardsBox.style.display = 'flex';
    sendOrderEmail.style.display = 'none';
    thsbackButton.style.display = 'none';
    Array.from(email_order_products.children).forEach(elm => {
        elm.remove();
    });
};
orderCard.forEach(elm => {
    const refoundButton = elm.querySelector('._3');
    const deleteButton = elm.querySelector('._2');
    const mangeButton = elm.querySelector('._1');
    const new_order_email = elm.querySelector('.new_order_email');
    const new_order_phoner = elm.querySelector('.new_order_phoner');
    const new_order_paid_price = elm.querySelector('.new_order_paid_price');
    const new_order_products = elm.querySelector('.new_order_products');
    const new_order_id = elm.querySelector('.id span');
    mangeButton.onclick = () => {
        arrowsEmail.style.display = 'none';
        thsbackButton.style.display = 'block';
        allCardsBox.style.display = 'none';
        sendOrderEmail.style.display = 'block';
        email_odere_id_sender.value = new_order_id?.textContent;
        email_odere_email_sender.value = new_order_email?.textContent;
        email_order_email.textContent = new_order_email?.textContent;
        email_order_phone.textContent = new_order_phoner?.textContent;
        email_order_price.textContent = new_order_paid_price?.textContent;
        email_order_id.textContent = new_order_id?.textContent;
        console.log(new_order_products);
        Array.from(new_order_products.children).forEach(elm => {
            if (elm.tagName == 'OPTION') {
                const option = document.createElement('option');
                option.textContent = elm.textContent;
                email_order_products.appendChild(option);
            }
        });
    };
    refoundButton.onclick = async () => {
        input_order_refound.value = new_order_id.textContent;
        thsglass.style.display = 'block';
        refound_order.style.display = 'block';
        await sleep(500);
        refound_order.style.scale = '1';
        thsglass.style.opacity = '1';
        console.log('yow');
    };
    deleteButton.onclick = async () => {
        input_order_delete.value = new_order_id.textContent;
        thsglass.style.display = 'block';
        delete_order.style.display = 'block';
        await sleep(500);
        thsglass.style.opacity = '1';
        delete_order.style.scale = '1';
    };
});
