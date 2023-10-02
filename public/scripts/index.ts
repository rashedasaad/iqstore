const bottonController = document.querySelector('.controllerButton') as HTMLButtonElement
const controoler = document.querySelector('.cntroller')! as HTMLDivElement
const closeControllerButton = document.querySelector('.closeController') as HTMLButtonElement

const get = (selector:string) => {
    return document.querySelector(selector)
}
const getAll = (selector:string) => {
    return document.querySelectorAll(selector)
}

console.log('liqwdgh');

const sleep = async(dlay:number) => {
    await new Promise(r => setTimeout(() => r(true), dlay))
}

var controllerIsHide = true
closeControllerButton.onclick = () =>{
    controoler.style.width = '0'
}
bottonController.onclick = () => {
    if(controllerIsHide){
        controoler.style.width = '100%'
        controoler.style.overflow = 'auto'
        return
    }
    controoler.style.overflow = 'none'
    controoler.style.width = '0'
}
console.log('js is on')