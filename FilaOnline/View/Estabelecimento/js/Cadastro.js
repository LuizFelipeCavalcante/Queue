// Mascara de Telefone 
const handlePhone = (event) => {
    let telefone = event.target
    telefone.value = phoneMask(telefone.value)
  }
  
  const phoneMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{2})(\d)/,"($1) $2")
    value = value.replace(/(\d)(\d{4})$/,"$1-$2")
    return value
  }

// Mascara de CNPJ
const handleCnpj = (event) => {
  let Cnpj = event.target
  Cnpj.value = cnpjMask(telefone.value)
}
const cnpj(v){
  v=v.replace(/\D/g,"")                           
  v=v.replace(/^(\d{2})(\d)/,"$1.$2")             
  v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") 
  v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           
  v=v.replace(/(\d{4})(\d)/,"$1-$2")              
  return v
}

// Para mostrar e esconder senha
function togglePass() {
    const senha = document.getElementById("senha");
  if (senha.type === "password") {
    senha.type = "text";
    document.getElementsById("btnsenha").innerHTML = "teste";
  } else {
    senha.type = "password";
  }
}