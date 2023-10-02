console.log('lalala')
const productsData = document.querySelector('#productsData')
const writeForm = () => {
    const newData = []
    if(localStorage.getItem('cartData')){
      const data = Array.from(JSON.parse(localStorage.getItem('cartData')))
      
      if(data.length == 0){
        console.log(newData)
        productsData.value = ""
        return
      }
      data.forEach(data => {
        newData.push({
            product_id:data.product_id,
            product_qtn:data.product_qtn
        })
      })
      productsData.value = JSON.stringify(newData)
    }
    console.log(newData)
  }
  writeForm()
  setInterval(() => {
    writeForm()
  }, 2000)
 