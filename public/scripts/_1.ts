const allProducts = getAll('.product')!
const prodcutsBox = get('.cards')! as HTMLDivElement
const addProdcutSection = get('.addProducts')! as HTMLDivElement
const updateProductSection = get('.updatePtoduct')! as HTMLDivElement
const backButton = get('.backButton')! as HTMLButtonElement
const newProdcutImage = get('#newProdcutImage')! as HTMLImageElement
const fileUplader = get('#fileUplader')! as HTMLInputElement
const updateImage = get('#updateImage')! as HTMLInputElement
const update_id = get('#update_id')! as HTMLInputElement
const selectProductDeleted = get('#selectProduct')! as HTMLInputElement
const deleteProductButton = get('#deleteProductButton')! as HTMLDivElement
const delete_productBox = get('.delete_product')! as HTMLDivElement

deleteProductButton.onclick = async() =>{
    const ProductId = deleteProductButton.parentElement?.parentElement?.parentElement?.querySelector('#update_id')! as HTMLInputElement
    selectProductDeleted.value = ProductId.value!
    glass.style.display = 'block'
    delete_productBox.style.display = 'block'
    await sleep(500)
    delete_productBox.style.scale = '1'
    glass.style.opacity = '1'
}

fileUplader.onchange = () => {
    newProdcutImage.style.width = '100%'
    const file = fileUplader.files
    if (file && file[0]) {
        newProdcutImage.src = URL.createObjectURL(file[0])
    }
}


const update_productName_1 = get('#update_productName_1')! as HTMLHeadingElement
const update_productName_2 = get('#update_productName_2')! as HTMLInputElement
const update_price = get('#update_price')! as HTMLInputElement
const update_image = get('#update_image')! as HTMLImageElement
const create_selector = get('#create_selector')! as HTMLSelectElement
const update_selector = get('#update_selector')! as HTMLSelectElement

updateImage.onchange = () => {
    const file = updateImage.files
    if (file && file[0]) {
        update_image.src = URL.createObjectURL(file[0])
    }
}

const hideShowStore = (isVisble:boolean):void =>{
    if(isVisble){
        prodcutsBox.style.display = 'none'
        addProdcutSection.style.display = 'none'
        updateProductSection.style.display = 'block'
        backButton.style.display = 'block'
        return
    }
    update_id.value = ''
    backButton.style.removeProperty('display')
    updateProductSection.style.removeProperty('display')
    prodcutsBox.style.removeProperty('display')
    addProdcutSection.style.removeProperty('display')
}
backButton.onclick = () => {
    hideShowStore(false)
}
allProducts.forEach(elm => {
    const element = elm as HTMLDivElement
    element.onclick = () => {
        const productImage = element.querySelector('img')! as HTMLImageElement
        const productId = element.querySelector('.productId')! as HTMLParagraphElement
        console.log(productId)
        const allData = element.querySelectorAll('p span')
        const productname = allData[0]
        const productPrice = allData[1]
        const productType = allData[2]
        update_id.value = productId?.textContent!
        update_productName_1.textContent = productname.textContent
        update_productName_2.value = productname.textContent!
        Array.from(update_selector.children).forEach(elm => {
            elm.remove()
        })
        Array.from(create_selector.children).forEach(elm => {
            if(elm.tagName == 'OPTION'){
                const option = document.createElement('option')
                option.textContent = elm.textContent
                update_selector.appendChild(option)
            }
        })
        update_selector.value = productType.textContent!
        update_price.value = productPrice.textContent!.replace('$', '')
        update_image.src =  productImage.src
        hideShowStore(true)
    }
})

//--m add products
const plusSelect = get('#plusSelect')! as HTMLButtonElement
const glass = get('.glass')! as HTMLDivElement
const selector_config_1 = get('.selector_config_1')! as HTMLDivElement
const selector_config_2 = get('.selector_config_2')! as HTMLDivElement
const selector_config_3 = get('.selector_config_3')! as HTMLDivElement
const selector_config_4 = get('.selector_config_4')! as HTMLDivElement
const create_new_type = get('#create_new_type')! as HTMLButtonElement
const ubdate_type = get('#ubdate_type')! as HTMLButtonElement
const delete_type = get('#delete_type')! as HTMLButtonElement
const delete_typeBox = get('.delete_type')! as HTMLDivElement
const delete_typeselector = get('.delete_typeselector')! as HTMLDivElement
const selectTypeHide = get('#selectType')! as HTMLInputElement
const ubdate_type_select = selector_config_3.querySelector('select')! as HTMLSelectElement
const deleteTypeSelect = delete_typeselector.querySelector('select')! as HTMLSelectElement
console.log(ubdate_type_select)
const selectType_delete = get('#selectType_delete')! as HTMLInputElement
const typesProducts = get('.types')! as HTMLDivElement
Array.from(create_selector.children).forEach(elm => {
    if(elm.tagName == 'OPTION'){
        const option = document.createElement('option')
        const anotheroption = document.createElement('option')
        const typeDiv = document.createElement('div')
        typeDiv.textContent = elm.textContent
        typesProducts.appendChild(typeDiv)
        option.textContent = elm.textContent
        anotheroption.textContent = elm.textContent
        ubdate_type_select.appendChild(option)
        deleteTypeSelect.appendChild(anotheroption)
        console.log(deleteTypeSelect)
        ubdate_type_select.onchange = async() =>{
            selectTypeHide.value = ubdate_type_select.value
            selector_config_3.style.scale = '0'
            selector_config_4.style.display = 'block'
            await sleep(500)
            selector_config_4.style.scale = '1'
            selector_config_3.style.display = 'none'
        }
        deleteTypeSelect.onchange = async() =>{
            selectType_delete.value = deleteTypeSelect.value
            delete_typeselector.style.scale = '0'
            delete_typeBox.style.display = 'block'
            await sleep(500)
            delete_typeBox.style.scale = '1'
            delete_typeselector.style.display = 'none'
        }
    }
})
Array.from(typesProducts.children).forEach(elm => {
    const element = elm as HTMLDivElement
    element.onclick = () =>{
        Array.from(typesProducts.children).forEach(elm => {
            elm.classList.remove('active')
        })
        element.classList.add('active')
        allProducts.forEach(elm => {
            const allData = elm.querySelectorAll('p span')
            const productType = allData[2]
            const product = elm as HTMLDivElement
            product.style.display = 'none'
            if(element.textContent?.toLocaleLowerCase() == 'all'){
                product.style.removeProperty('display')
                return
            }
            if(productType.textContent?.toLocaleLowerCase() == element.textContent?.toLocaleLowerCase()){
                product.style.removeProperty('display')
            }
        })
    }
})


const removeGlassWithEveryThng = async() =>{
    glass.style.opacity = '0'
    selector_config_2.style.scale = '0'
    selector_config_1.style.scale = '0'
    selector_config_3.style.scale = '0'
    selector_config_4.style.scale = '0'
    delete_productBox.style.scale = '0'
    delete_typeBox.style.scale = '0'
    delete_typeselector.style.scale = '0'
    selectProductDeleted.value = ''
    selectType_delete.value = ''
    deleteTypeSelect.value = ''
    await sleep(500)
    ubdate_type_select.value = ''
    selectTypeHide.value = ''
    glass.style.display = 'none'
    delete_typeselector.style.display = 'none'
    delete_typeBox.style.display = 'none'
    delete_productBox.style.display = 'none'
    selector_config_1.style.display = 'none'
    selector_config_2.style.display = 'none'
    selector_config_3.style.display = 'none'
    selector_config_4.style.display = 'none'
}
ubdate_type.onclick = async() =>{
    selector_config_1.style.scale = '0'
    selector_config_3.style.display = 'block'
    await sleep(500)
    selector_config_3.style.scale = '1'
    selector_config_1.style.display = 'none'
}
delete_type.onclick = async() =>{
    selector_config_1.style.scale = '0'
    delete_typeselector.style.display = 'block'
    await sleep(500)
    delete_typeselector.style.scale = '1'
    selector_config_1.style.display = 'none'
}
create_new_type.onclick = async() =>{
    selector_config_1.style.scale = '0'
    selector_config_2.style.display = 'block'
    await sleep(500)
    selector_config_2.style.scale = '1'
    selector_config_1.style.display = 'none'
}
glass.onclick = () => {
    removeGlassWithEveryThng()
}
plusSelect.onclick = async() => {
    glass.style.display = 'block'
    selector_config_1.style.display = 'flex'
    selector_config_2.style.display = 'block'
    await sleep(500)
    
    selector_config_1.style.scale = '1'
    glass.style.opacity = '1'
}