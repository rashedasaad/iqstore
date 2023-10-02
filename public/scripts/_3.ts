const singleMsgs = getAll('.singleMsg')
const allMsgesBox = get('.allMsges')! as HTMLDivElement
const msgsGlass = get('.glass')! as HTMLDivElement
const delete_Msg = get('.delete_Msg')! as HTMLDivElement
const input_msg_delete = get('#input_msg_delete')! as HTMLInputElement
const re_msg_id = get('#re_msg_id')! as HTMLSpanElement
const re_msg_email = get('#re_msg_email')! as HTMLSpanElement
const re_msg_phone = get('#re_msg_phone')! as HTMLSpanElement
const re_msg_content = get('#re_msg_content')! as HTMLDivElement
const rplaySection = get('.rplaySection'!) as HTMLDivElement
const input_msg_id = get('#input_msg_id')! as HTMLInputElement
const input_msg_email = get('#input_msg_email')! as HTMLInputElement
const msgBackButton = get('.backButton')! as HTMLButtonElement
const arrowsMsg = get('.arrows')! as HTMLDivElement
var i = 0

msgsGlass.onclick = async() =>{
    input_msg_delete.value = ''
    msgsGlass.style.opacity = '0'
    delete_Msg.style.scale = '0'
    await sleep (500)
    delete_Msg.style.display = 'none'
    msgsGlass.style.display = 'none'
}

msgBackButton.onclick =() =>{
    if(re_msg_content.children.length != 0){
        Array.from(re_msg_content.children).forEach(elm => {
            elm.remove()
        })
    }
    arrowsMsg.style.display = 'flex'
    msgBackButton.style.display = 'none'
    allMsgesBox.style.display = 'flex'
    rplaySection.style.display = 'none'
}

singleMsgs.forEach(elm => {
    const hideMsg = elm.querySelector('.backMsg')! as HTMLParagraphElement
    const content = elm.querySelector('.content')! as HTMLDivElement
    const msg_id = elm.querySelector('.msg_id')! as HTMLParagraphElement
    const msg_email = elm.querySelector('.msg_email')! as HTMLParagraphElement
    const msg_phone = elm.querySelector('.msg_phone')! as HTMLParagraphElement
    const lines = hideMsg.textContent?.trim()!.split('\n')
    lines?.forEach(line => {
        const pragarphLine = document.createElement('p')
        pragarphLine.textContent = line
        content.appendChild(pragarphLine)
    })
    const RplayButton = elm.querySelector('.buttons ._1') as HTMLButtonElement
    const deleteButton = elm.querySelector('.buttons ._2') as HTMLButtonElement
    deleteButton.onclick = async() =>{
        input_msg_delete.value = msg_id.textContent!
        msgsGlass.style.display = 'block'
        delete_Msg.style.display = 'block'
        await sleep (500)
        delete_Msg.style.scale = '1'
        msgsGlass.style.opacity = '1'
    }
    RplayButton.onclick = async() =>{
        arrowsMsg.style.display = 'none'
        msgBackButton.style.display = 'block'
        allMsgesBox.style.display = 'none'
        rplaySection.style.display = 'block'
        re_msg_id.textContent = msg_id.textContent!
        re_msg_email.textContent = msg_email.textContent!
        re_msg_phone.textContent = msg_phone.textContent!
        rplaySection.style.display = 'block'
        input_msg_id.value = msg_id.textContent!
        input_msg_email.value = msg_email.textContent!
        if(re_msg_content.children.length != 0){
            Array.from(re_msg_content.children).forEach(elm => {
                elm.remove()
            })
        }
        lines?.forEach(line => {
            const pragarphLine = document.createElement('p')
            pragarphLine.textContent = line
            re_msg_content.appendChild(pragarphLine)
        })
    }
})

