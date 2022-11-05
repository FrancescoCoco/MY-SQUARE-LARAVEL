
function onText(text)
{   
    console.log(text);
    const erroreNomeUtente = document.querySelector("#ErroreNomeUtente");
    erroreNomeUtente.innerHTML = "";
    if(text==0){
        var messaggio;
        messaggio= "Username not available";
        erroreNomeUtente.innerHTML= messaggio;
    }
}

function onResponse(response)
{
    return response.text();
}

function controlloUser(event){
    const inserito= event.currentTarget.value;
    var token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
    const formData= new FormData();
    formData.append('send',inserito);
    formData.append('_token',token);
    fetch(event.currentTarget.getAttribute("verifyUsername"),{method:'POST',body: formData,headers:{"X-CSRF-TOKEN":token}}).then(onResponse).then(onText);
    event.preventDefault();
}


const user = document.querySelector('label input[name = username]');
user.addEventListener('blur',controlloUser);

