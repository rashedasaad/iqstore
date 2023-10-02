"use strict";
const bottonController = document.querySelector('.controllerButton');
const controoler = document.querySelector('.cntroller');
const closeControllerButton = document.querySelector('.closeController');
const get = (selector) => {
    return document.querySelector(selector);
};
const getAll = (selector) => {
    return document.querySelectorAll(selector);
};
console.log('liqwdgh');
const sleep = async (dlay) => {
    await new Promise(r => setTimeout(() => r(true), dlay));
};
var controllerIsHide = true;
closeControllerButton.onclick = () => {
    controoler.style.width = '0';
};
bottonController.onclick = () => {
    if (controllerIsHide) {
        controoler.style.width = '100%';
        controoler.style.overflow = 'auto';
        return;
    }
    controoler.style.overflow = 'none';
    controoler.style.width = '0';
};
console.log('js is on');
