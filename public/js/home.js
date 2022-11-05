function onJSONInfoSeguaci(json){
    document.body.classList.add('no-scroll');
    modalView = document.querySelector('#modal-view');
    modalView.style.top = window.pageYOffset + 'px';
    modalView.classList.remove('hidden');
    const chiusura = document.createElement("div");
    chiusura.classList.add("chiusura");
    const imageChiusura= document.createElement("img");
    imageChiusura.classList.add("imageChiusura");
    imageChiusura.src= ChiusuraImage;
    imageChiusura.addEventListener('click',onModalClick);
    chiusura.appendChild(imageChiusura);
    const contenuto= document.createElement("div");
    contenuto.classList.add("contenuto");
    const testo = document.createElement("span");
    testo.classList.add=("testoFollower");
    testo.textContent="Followers:";
    contenuto.appendChild(testo);
    for(utente of json){
      const boxUtente= document.createElement("div");
      boxUtente.classList.add("boxUtente");
      const boxFotoUtente = document.createElement("span");
      boxFotoUtente.classList.add("boxFotoUtente");
      const avatar = document.createElement("img");
      avatar.classList.add("FotoProfilo");
      if(utente.seguaceImage===null){
        avatar.src = defaultImage;
        }
    else {
          avatar.src = storage+"/"+utente.seguaceImage; 
        }
      boxFotoUtente.appendChild(avatar);
      boxUtente.appendChild(avatar);
      const testo= document.createElement("span");
      testo.textContent= utente.seguace;
      boxUtente.appendChild(testo);
      contenuto.appendChild(boxUtente);
    }
    modalView.appendChild(chiusura);
    modalView.appendChild(contenuto);
    modalView.classList.remove('hidden');
    }

function onJSONInfoSeguiti(json){
document.body.classList.add('no-scroll');
modalView = document.querySelector('#modal-view');
modalView.style.top = window.pageYOffset + 'px';
modalView.classList.remove('hidden');
const chiusura = document.createElement("div");
chiusura.classList.add("chiusura");
const imageChiusura= document.createElement("img");
imageChiusura.classList.add("imageChiusura");
imageChiusura.src= ChiusuraImage;
imageChiusura.addEventListener('click',onModalClick);
chiusura.appendChild(imageChiusura);
const contenuto= document.createElement("div");
contenuto.classList.add("contenuto");
const testo = document.createElement("span");
testo.classList.add=("testoFollower");
testo.textContent="Utenti seguiti:";
contenuto.appendChild(testo);
for(utente of json){
  const boxUtente= document.createElement("div");
  boxUtente.classList.add("boxUtente");
  const boxFotoUtente = document.createElement("span");
  boxFotoUtente.classList.add("boxFotoUtente");
  const avatar = document.createElement("img");
  avatar.classList.add("FotoProfilo");
  if(utente.seguitoImage===null){
    avatar.src = defaultImage;
    }
    else {
      avatar.src = storage+"/"+utente.seguitoImage; 
    }
  boxFotoUtente.appendChild(avatar);
  boxUtente.appendChild(avatar);
  const testo= document.createElement("span");
  testo.textContent= utente.seguito;
  boxUtente.appendChild(testo);
  contenuto.appendChild(boxUtente);
}
modalView.appendChild(chiusura);
modalView.appendChild(contenuto);
modalView.classList.remove('hidden');
}

function onJsonUtentiLikes(json){
document.body.classList.add('no-scroll');
modalView = document.querySelector('#modal-view');
modalView.style.top = window.pageYOffset + 'px';
modalView.classList.remove('hidden');
const chiusura = document.createElement("div");
chiusura.classList.add("chiusura");
const imageChiusura= document.createElement("img");
imageChiusura.classList.add("imageChiusura");
imageChiusura.src= ChiusuraImage;
imageChiusura.addEventListener('click',onModalClick);
chiusura.appendChild(imageChiusura);
const contenuto= document.createElement("div");
contenuto.classList.add("contenuto");
const testo = document.createElement("span");
testo.classList.add=("testoLikes");
testo.textContent="Utenti che hanno messo like";
contenuto.appendChild(testo);
for(utente of json){
  const boxUtente= document.createElement("div");
  boxUtente.classList.add("boxUtente");
  const boxFotoUtente = document.createElement("span");
  boxFotoUtente.classList.add("boxFotoUtente");
  const avatar = document.createElement("img");
  avatar.classList.add("FotoProfilo");
  if(utente.fotoProfilo==null){
    avatar.src = defaultImage;
  }
  else {
  avatar.src = storage+'/'+utente.fotoProfilo;
  }
  boxFotoUtente.appendChild(avatar);
  boxUtente.appendChild(avatar);
  const testo= document.createElement("span");
  testo.textContent= utente.utentiLikes;
  boxUtente.appendChild(testo);
  contenuto.appendChild(boxUtente);
}
modalView.appendChild(chiusura);
modalView.appendChild(contenuto);
modalView.classList.remove('hidden');
}

function apriModale(event){
    const contatoreLikes = event.currentTarget;
    const likeBox = contatoreLikes.parentNode;
    const boxPost= likeBox.parentNode;
    fetch(UtentiLikes+"?idPost="+boxPost.id).then(onResponse).then(onJsonUtentiLikes);
  }

function onModalClick() {
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML = "";
  }

function onJsonLikes(json){
    console.log(json);
    for(box of json){
        const idPost = box.idPost;
        const boxPost = document.getElementById(idPost);
        const likeButton= boxPost.querySelector(".likeButton");
        if(likeButton.value=='mipiace'){
            likeButton.removeEventListener('click',aggiungiLike);
            likeButton.value = "non_mipiace_più";
            likeButton.addEventListener('click',togliLike);
        }
        else{
            likeButton.removeEventListener('click',togliLike);
            likeButton.value ="mipiace";
            likeButton.addEventListener('click',aggiungiLike);
        }
        const likeBox= boxPost.querySelector(".likeBox");
        const contatore= likeBox.querySelector(".contatoreLikes");
        contatore.classList.add("contatoreLikes");
        contatore.innerHTML="";
        contatore.textContent="Piace a "+ box.numeroLikes +" Persone";
       }
       
}

function aggiungiLike(event){
    const likeButton= event.currentTarget;
    const likeBox = likeButton.parentNode;
    const boxPost = likeBox.parentNode;
    fetch(AggiungiLike+"?idPost="+boxPost.id).then(onResponse).then(onJsonLikes);
}

function togliLike(event){
    const likeButton= event.currentTarget;
    const likeBox = likeButton.parentNode;
    const boxPost = likeBox.parentNode;
    fetch(TogliLike+"?idPost="+boxPost.id).then(onResponse).then(onJsonLikes);
}

function onJsonProfilo(json){
console.log(json);
document.body.classList.add('no-scroll');
modalView = document.querySelector('#modal-view');
modalView.style.top = window.pageYOffset + 'px';
modalView.classList.remove('hidden');
const chiusura = document.createElement("div");
chiusura.classList.add("chiusura");
const imageChiusura= document.createElement("img");
imageChiusura.classList.add("imageChiusura");
imageChiusura.src= ChiusuraImage;
imageChiusura.addEventListener('click',onModalClick);
chiusura.appendChild(imageChiusura);
const contenuto= document.createElement("div");
contenuto.classList.add("contenuto");
for(cliccato of json){
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
}
modalView.appendChild(chiusura);
modalView.appendChild(contenuto);
modalView.classList.remove('hidden');
}

function mostraProfilo(event){
    const click = event.currentTarget;
    const boxProfile = click.parentNode;
    fetch(UtenteInfo+"?nomeUtente="+boxProfile.id).then(onResponse).then(onJsonProfilo);
}

function onJSON(json)
{  
    boxPosts= document.querySelector("#Posts");
    boxPosts.innerHTML="";
    for (boxutente of json ){
        const boxPost = document.createElement("div");
        boxPost.classList.add("boxPost");
        boxPost.setAttribute("id",boxutente.idPost);
        const boxProfile= document.createElement("span");
        boxProfile.classList.add("boxProfile");
        boxProfile.setAttribute("id",boxutente.nomeUtente);
        const avatarSpan = document.createElement("span");
        avatarSpan.classList.add("avatarSpan");
        avatarSpan.addEventListener('click',mostraProfilo);
        const imgProfile= document.createElement("img");
        imgProfile.classList.add("imgProfile");
        if(boxutente.Imageuser===null){
        imgProfile.src= defaultImage;
        }
        else {
          imgProfile.src= storage+"/"+boxutente.Imageuser; 
        }
        const nomeProfilo= document.createElement("span");
        nomeProfilo.classList.add("nomeProfilo");
        nomeProfilo.addEventListener('click',mostraProfilo);
        nomeProfilo.textContent= boxutente.nomeUtente;
        avatarSpan.appendChild(imgProfile);
        boxProfile.appendChild(avatarSpan);
        boxProfile.appendChild(nomeProfilo);
        boxPost.appendChild(boxProfile);
        const titoloText= document.createElement("span");
        titoloText.classList.add("titoloText");
        titoloText.textContent= boxutente.titoloPost;
        boxPost.appendChild(titoloText);
        const dataBox= document.createElement("span");
        dataBox.classList.add("dataBox");
        const dataTime= document.createElement("span");
        dataTime.classList.add("dataTime");
        dataTime.textContent= boxutente.dataPost;
        dataBox.appendChild(dataTime);
        boxPost.appendChild(dataBox);
        const imageBox= document.createElement("span"); 
        imageBox.classList.add("imageBox");
        const imagePost= document.createElement("img");
        imagePost.classList.add("imagePost");
        imagePost.src= boxutente.ImagePost;
        imageBox.appendChild(imagePost);
        const likeBox= document.createElement("span");
        likeBox.classList.add("likeBox");
        const likeButton= document.createElement("input");
        likeButton.setAttribute("type","submit");
        if(boxutente.isLiked=='0'){
            likeButton.setAttribute("value","mipiace");
            likeButton.addEventListener('click',aggiungiLike);
        }
        else{
        likeButton.setAttribute("value","non_mipiace_più");
        likeButton.addEventListener('click',togliLike);
        }
        likeButton.setAttribute("name","likeButton");
        likeButton.classList.add("likeButton");
        likeBox.appendChild(likeButton);
        const contatore= document.createElement("span");
        contatore.classList.add("contatoreLikes");
        contatore.textContent="Piace a "+ boxutente.numeroLikes +" Persone";
        contatore.addEventListener("click",apriModale);
        likeBox.appendChild(contatore);
        boxPost.appendChild(imageBox);
        boxPost.appendChild(likeBox);
        boxPosts.appendChild(boxPost);
    }
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

function onResponse(response)
{   
    return response.json();
}

function AggiornaHome(){
fetch(UtentiSeguiti).then(onResponse).then(onJSON);
}

function apriModaleseguiti(){
    fetch(seguiti).then(onResponse).then(onJSONInfoSeguiti);
}

function apriModaleseguaci(){
    fetch(seguaci).then(onResponse).then(onJSONInfoSeguaci);
}




var modal_cell;
var modalView;
var boxPosts;
const followed = document.querySelector("span#seguiti");
const follower= document.querySelector("span#seguaci");
const divMenu= document.querySelector("div#menuBar");
divMenu.addEventListener("click",apriModaleMenu);
followed.addEventListener("click",apriModaleseguiti);
follower.addEventListener("click",apriModaleseguaci);
AggiornaHome();


