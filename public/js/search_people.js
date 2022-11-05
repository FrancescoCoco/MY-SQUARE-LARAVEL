    function onThumbnailClick(json) {
    modalView = document.querySelector('#modal-view');
    document.body.classList.add('no-scroll');
    modalView.style.top = window.pageYOffset + 'px';
    for(cliccato of json) { 
    const contenuto= document.createElement("div");
    contenuto.classList.add("contenuto");
    const chiusura = document.createElement("div");
    chiusura.classList.add("chiusura");
    const imageChiusura= document.createElement("img");
    imageChiusura.classList.add("imageChiusura");
    imageChiusura.src= ChiusuraImage;
    imageChiusura.addEventListener('click',onModalClick);
    chiusura.appendChild(imageChiusura);
    const image = document.createElement("img");
    image.classList.add("imageClick");
    if(cliccato.avatar===null){
        image.src = defaultImage;
        }
    else {
          image.src = storage+"/"+cliccato.avatar; 
        }
    const informazioni= document.createElement("div");
    informazioni.classList.add("informazioni");
    const nome = document.createElement("div");
    nome.classList.add("nomeClick");
    nome.textContent="Nome "+ cliccato.nome;
    const cognome = document.createElement("div");
    cognome.classList.add("cognomeClick");
    cognome.textContent="Cognome: " +cliccato.cognome;
    const email = document.createElement("div");
    email.classList.add("emailClick");
    email.textContent="Email: "+ cliccato.email;
    const nomeUtente = document.createElement("div");
    nomeUtente.classList.add("nomeUtenteClick");
    nomeUtente.textContent="Nome Utente: "+cliccato.nomeUtente;
    const follower = document.createElement("div");
    follower.classList.add("follower");
    follower.textContent="Follower: "+ cliccato.seguaci;
    const seguiti = document.createElement("div");
    seguiti.classList.add("seguiti");
    seguiti.textContent="Seguiti: " +cliccato.seguiti;
    informazioni.appendChild(nome);
    informazioni.appendChild(cognome);
    informazioni.appendChild(email);
    informazioni.appendChild(nomeUtente);
    informazioni.appendChild(seguiti);
    informazioni.appendChild(follower);
    contenuto.appendChild(image);
    contenuto.appendChild(informazioni);
    modalView.appendChild(chiusura);
    modalView.appendChild(contenuto);
    modalView.classList.remove('hidden');
    }
  }
  
  function onModalClick() {
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML = '';
  }

function creaModale(){
   event.preventDefault();
   const imageClick = event.currentTarget;
   boxUtentecliccato= imageClick.parentNode;
   const input = boxUtentecliccato.querySelector("input[type=submit]");
   fetch(SeeUser+"?cliccato="+input.name).then(onResponse).then(onThumbnailClick);
}


function onText(text){
     if(tastoSegui.value=="Segui"){
        tastoSegui.removeEventListener('click',seguiUtente);
        tastoSegui.removeAttribute("FollowPeople");
        tastoSegui.value= text;
        tastoSegui.setAttribute("DisfollowPeople",DisfollowPeople);
        tastoSegui.addEventListener('click',smettiseguiUtente);
     }
     if(tastoSegui.value=="Segui_già"){
        tastoSegui.removeEventListener('click',smettiseguiUtente);
        tastoSegui.removeAttribute('DisfollowPeople');
        tastoSegui.value = text;
        tastoSegui.setAttribute("FollowPeople",FollowPeople);
        tastoSegui.addEventListener('click',seguiUtente);
     }
     aggiorna();
}


function onJSON(json)
{   
    console.log(json);
    const boxUtenti = document.querySelector("#boxUtenti");
    boxUtenti.innerHTML = '';
    for(utente of json)
    {   
        const boxUtente = document.createElement("div");
        boxUtente.classList.add("BoxUtente");
        boxUtente.setAttribute("id",utente.nomeUtente);
        const nomeUtente = document.createElement("span");
        nomeUtente.classList.add("nomeUtente");
        nomeUtente.textContent = utente.nomeUtente;
        const avatar = document.createElement("img");
        avatar.classList.add("avatar");
        if(utente.avatar===null){
            avatar.src = defaultImage;
            }
        else {
              avatar.src = storage+"/"+utente.avatar; 
            }
        boxUtente.appendChild(avatar);
        avatar.addEventListener('click', creaModale);
        boxUtente.appendChild(nomeUtente);
        const buttonBox = document.createElement("div");
        buttonBox.classList.add("buttonBox");
        const buttonFollow = document.createElement("input");
        buttonFollow.setAttribute("type", "submit");
        if(utente.isfollow=='1'){
        buttonFollow.setAttribute("value","Segui_già");
        buttonFollow.setAttribute("DisfollowPeople",DisfollowPeople);
        buttonFollow.addEventListener('click',smettiseguiUtente);
        }
        else {
        buttonFollow.setAttribute("value","Segui");
        buttonFollow.setAttribute("FollowPeople",FollowPeople);
        buttonFollow.addEventListener('click',seguiUtente);
        }
        buttonFollow.setAttribute("name",utente.seguito);
        buttonBox.appendChild(buttonFollow);
        boxUtente.appendChild(buttonBox);
        boxUtenti.appendChild(boxUtente);
    }
    
    }


function onResponse(response)
{   
    return response.json();
}


function onResponseSegui(response)
{   
    return response.text();
}


function cercaUtente(event){
event.preventDefault();
var token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
const form= event.currentTarget;
const testo= form.utenti.value;
fetch(event.currentTarget.action+"?testo="+testo).then(onResponse).then(onJSON);
}

function seguiUtente(event){
event.preventDefault();
tastoSegui = event.currentTarget;
fetch(tastoSegui.getAttribute("FollowPeople")+"?userfollowed="+tastoSegui.name).then(onResponseSegui).then(onText);
}

function smettiseguiUtente(event){
    event.preventDefault();
    tastoSegui = event.currentTarget;
    fetch(tastoSegui.getAttribute("DisfollowPeople")+"?userunfollowed="+tastoSegui.name).then(onResponseSegui).then(onText);
    }

function aggiorna(){
    const elementRoute= document.querySelector("#restituisciUtenti");
    fetch(elementRoute.getAttribute("restituisciUtenti")).then(onResponse).then(onJSON);
}

function onModalCellClick(){
    document.body.classList.remove('no-scroll');
    modal_cell.classList.add('hidden');
}

function apriModaleMenu(){
    document.body.classList.add('no-scroll');
    modal_cell = document.querySelector('#modal_cell');
    modal_cell.style.top = window.pageYOffset + 'px';
    modal_cell.classList.remove('hidden');
    const imageChiusura= document.querySelector(".imageChiusura");
    imageChiusura.addEventListener('click',onModalCellClick);
    modal_cell.classList.remove('hidden');
    }

var tastoSegui;
var modalView ;
var modal_cell;
let formCerca = document.querySelector("#RicercaUtente");
const divMenu= document.querySelector("div#menuBar");
formCerca.addEventListener('submit',cercaUtente);
divMenu.addEventListener("click",apriModaleMenu);
aggiorna(); 

