const createUserButton = get('.createUser')! as HTMLButtonElement
const userGlass = get('.glass')! as HTMLDivElement
const create_new_user_form = get('.create_new_user_form')! as HTMLDivElement
const showPasswordCreate = get('.showPassword')! as HTMLButtonElement
const showPassword_update = get('.showPassword_update')! as HTMLButtonElement
const userersDiplay = get('.userersDiplay')! as HTMLDivElement
const allusers = getAll('.single_user')! 
const userManage = get('.userManage')! as HTMLDivElement
const usersBackButton = get('.backButton')! as HTMLButtonElement
const mannge_user_id = get('#mannge_user_id')! as HTMLParagraphElement
const mange_username = get('#mange_username')! as HTMLSpanElement
const mange_update = get('#mange_update')! as HTMLButtonElement
const mange_delete = get('#mange_delete')! as HTMLButtonElement
const delete_user_form = get('.delete_user')! as HTMLDivElement
const update_user_form = get('.update_user_form') as HTMLDivElement
const input_user_delete = get('.input_user_delete') as HTMLInputElement




const update_user_username_input = get('.update_user_form form')?.querySelector('.username')! as HTMLInputElement
const update_user_userId_input =  get('.update_user_form form')?.querySelector('.update_form_user_id')! as HTMLInputElement

mange_update.onclick = async() =>{
    update_user_username_input.value = mange_username.textContent!
    update_user_userId_input.value = mannge_user_id.textContent!
    userGlass.style.display = 'block'
    update_user_form.style.display = 'block'
    await sleep(500)
    update_user_form.style.scale = '1'
    userGlass.style.opacity = '1'
}
mange_delete.onclick = async() =>{
    userGlass.style.display = 'block'
    delete_user_form.style.display = 'block'
    input_user_delete.value = mannge_user_id.textContent!
    await sleep(500)
    delete_user_form.style.scale = '1'
    userGlass.style.opacity = '1'
}


usersBackButton.onclick = () =>{
    usersBackButton.style.display = 'none'
    userManage.style.display = 'none'
    userersDiplay.style.display = 'block'
    mange_username.textContent = ''
    mannge_user_id.textContent = ''
}

allusers.forEach(elm => {
    const element = elm as HTMLDivElement
    const username = element.querySelector('.username')! as HTMLParagraphElement
    const user_id = element.querySelector('.user_id')! as HTMLParagraphElement
    element.onclick = () =>{
        mange_username.textContent = username.textContent
        mannge_user_id.textContent = user_id.textContent
        usersBackButton.style.display = 'block'
        userManage.style.display = 'block'
        userersDiplay.style.display = 'none'
    }
})


var isCreateUserShowedPassword = false
const allPasswordsUserCreate = get('.create_new_user_form form')?.querySelectorAll('input[type=password]')
showPasswordCreate.onclick = () =>{
    
    if(!isCreateUserShowedPassword){
        isCreateUserShowedPassword = true
        showPasswordCreate.textContent = 'Hide Password'
        allPasswordsUserCreate?.forEach(elm => {
            const element =  elm as HTMLInputElement
            element.type= 'text'
        })
    } else{
        isCreateUserShowedPassword = false
        showPasswordCreate.textContent = 'Show Password'
        allPasswordsUserCreate?.forEach(elm => {
            const element =  elm as HTMLInputElement
            element.type= 'password'
        })
    }
}

var isUpdateUserShowedPassword = false
const allPasswordsUserupdate = get('.update_user_form form')?.querySelectorAll('input[type=password]')
showPassword_update.onclick = () =>{
    if(!isUpdateUserShowedPassword){
        isUpdateUserShowedPassword = true
        showPassword_update.textContent = 'Hide Password'
        allPasswordsUserupdate?.forEach(elm => {
            const element =  elm as HTMLInputElement
            element.type= 'text'
        })
    } else{
        isUpdateUserShowedPassword = false
        showPassword_update.textContent = 'Show Password'
        allPasswordsUserupdate?.forEach(elm => {
            const element =  elm as HTMLInputElement
            element.type= 'password'
        })
    }
}



userGlass.onclick = async() =>{
    userGlass.style.opacity = '0'
    input_user_delete.value =''
    create_new_user_form.style.scale = '0'
    delete_user_form.style.scale = '0'
    update_user_form.style.scale = '0'
    await sleep(500)
    update_user_username_input.value = ''
    update_user_userId_input.value = ''
    update_user_form.style.display = 'none'
    delete_user_form.style.display = 'none'
    create_new_user_form.style.display = 'none'
    userGlass.style.display = 'none'
}

createUserButton.onclick = async() => {
    userGlass.style.display = 'block'
    create_new_user_form.style.display = 'block'
    await sleep(500)
    create_new_user_form.style.scale = '1'
    userGlass.style.opacity = '1'
}
