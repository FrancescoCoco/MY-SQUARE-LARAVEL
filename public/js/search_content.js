
function creaModaleShare(event){
    const buttonBoxClick = event.currentTarget; 
    const boxClick = buttonBoxClick.parentNode;
    const titolo=boxClick.querySelector(".nomeAlbum");
    const contenuto= document.createElement("div");
    contenuto.classList.add("contenuto");
    const chiusura = document.createElement("div");
    chiusura.classList.add("chiusura");
    const imageChiusura= document.createElement("img");
    imageChiusura.classList.add("imageChiusura");
    imageChiusura.src= ChiusuraImage;
    imageChiusura.addEventListener('click',onModalClick);
    chiusura.appendChild(imageChiusura);
    modalView = document.querySelector('#modal-view');
    modalView.appendChild(chiusura);
    document.body.classList.add('no-scroll');
    modalView.style.top = window.pageYOffset + 'px';
    const imageModal = document.createElement("img");
    imageModal.classList.add("imageClick");
    imageModal.src = boxClick.querySelector(".imageAlbum").src;
    const informazioni= document.createElement("div");
    informazioni.classList.add("informazioni");
    const titoloCliccato = document.createElement("div");
    titoloCliccato.classList.add("nomeClick");
    titoloCliccato.textContent="Titolo:"+titolo.textContent;
    informazioni.appendChild(titoloCliccato);
    const form= document.createElement("form");
    form.setAttribute("method","GET");
    const labelTesto= document.createElement("label");
    const labelInvio= document.createElement("label");
    const inputText= document.createElement("input");
    inputText.setAttribute("type", "search");
    inputText.setAttribute("placeholder", "A cosa stai pensando?");
    inputText.setAttribute("name","titolo");
    labelTesto.appendChild(inputText);
    const buttonShare = document.createElement("input");
    buttonShare.setAttribute("type", "submit");
    buttonShare.setAttribute("value","Condividi");
    buttonShare.setAttribute("name",imageModal.src);
    buttonShare.addEventListener('click',condividiPost);
    labelInvio.appendChild(buttonShare);
    form.appendChild(labelTesto);
    form.appendChild(labelInvio);
    informazioni.appendChild(form);
    contenuto.appendChild(imageModal);
    contenuto.appendChild(informazioni);
    modalView.appendChild(contenuto);
    modalView.classList.remove('hidden');
  }

  function condividiPost(event){
    event.preventDefault();
    tastoShare = event.currentTarget;
    const labelInvioc= tastoShare.parentNode;
    const formc=labelInvioc.parentNode;
    const testo= formc.querySelector("input[name=titolo]");
    const testoscritto= encodeURIComponent(testo.value);
    fetch(SharePost+"?image="+ tastoShare.name+ "&titolo="+testoscritto).then(onResponseCondividi).then(onText);
  }
  
  function onResponseCondividi(response){
    return response.text();
  }

   function onText(text){
    console.log(text);
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    modalView.innerHTML = '';
   }

function creaModaleimg(event){
  const imageClick = event.currentTarget;
  const boxClick = imageClick.parentNode;
  const titolo=boxClick.querySelector(".nomeAlbum");
  const contenuto= document.createElement("div");
    contenuto.classList.add("contenuto");
    const chiusura = document.createElement("div");
    chiusura.classList.add("chiusura");
    const imageChiusura= document.createElement("img");
    imageChiusura.classList.add("imageChiusura");
    imageChiusura.src= ChiusuraImage;
    imageChiusura.addEventListener('click',onModalClick);
    chiusura.appendChild(imageChiusura);
    modalView = document.querySelector('#modal-view');
    modalView.appendChild(chiusura);
  document.body.classList.add('no-scroll');
  modalView.style.top = window.pageYOffset + 'px';
  const imageModal = document.createElement("img");
  imageModal.classList.add("imageClick");
  imageModal.src = imageClick.src;
  const informazioni= document.createElement("div");
  informazioni.classList.add("informazioni");
  const titoloCliccato = document.createElement("div");
  titoloCliccato.classList.add("nomeClick");
  titoloCliccato.textContent="Titolo:"+ titolo.textContent;
  informazioni.appendChild(titoloCliccato);
  contenuto.appendChild(imageModal);
  contenuto.appendChild(informazioni);
  modalView.appendChild(contenuto);
  modalView.classList.remove('hidden');
}

function onModalClick() {
  document.body.classList.remove('no-scroll');
  modalView.classList.add('hidden');
  modalView.innerHTML = '';
}


function onJson(json){
  console.log(json);
  const library = document.querySelector('#boxPosts');
  library.innerHTML = '';
  if(opzione=="spotify"){
  const results = json.albums.items;
  let num_results = results.length;
  if(num_results > 20)
    num_results = 20;
  for(let i=0; i<num_results; i++)
  { 
    const album_data = results[i];
    const titleText = album_data.name; 
    const selected_image = album_data.images[0].url; 
    const boxPost = document.createElement("div");
        boxPost.classList.add("BoxPost");
        boxPost.setAttribute("id",i);
        const nomeAlbum = document.createElement("span");
        nomeAlbum.classList.add("nomeAlbum");
        nomeAlbum.textContent = titleText;
        const imageAlbum = document.createElement("img");
    imageAlbum.classList.add("imageAlbum");
    imageAlbum.src = selected_image;
    const buttonBox = document.createElement("div");
    buttonBox.classList.add("buttonBox");
    const buttonShare = document.createElement("input");
    buttonShare.setAttribute("type", "submit");
    buttonShare.setAttribute("value","Condividi");
    buttonShare.setAttribute("name",selected_image);
    buttonBox.appendChild(buttonShare);
    boxPost.appendChild(nomeAlbum);
    boxPost.appendChild(imageAlbum);
    boxPost.querySelector(".imageAlbum").addEventListener('click',creaModaleimg);
    boxPost.appendChild(buttonBox);
    boxPost.querySelector(".buttonBox").addEventListener('click',creaModaleShare);
    library.appendChild(boxPost);
  }
}
 else {
   console.log(json);
   const results = json.data;
   let num_result = json.pagination.total_count
   if(num_result > 20) num_result=20;
   for(let i=0; i<num_result; i++){
    const album_data = results[i];
    const titleText = album_data.title;
    const selected_image = album_data.images.downsized.url; 
    const boxPost = document.createElement("div");
    boxPost.classList.add("BoxPost");
    const nomeAlbum = document.createElement("span");
    nomeAlbum.classList.add("nomeAlbum");
    nomeAlbum.textContent = titleText;
    const imageAlbum = document.createElement("img");
    imageAlbum.setAttribute("href","#");
    imageAlbum.classList.add("imageAlbum");
    imageAlbum.src = selected_image;
    const buttonBox = document.createElement("div");
    buttonBox.classList.add("buttonBox");
    const buttonShare = document.createElement("input");
    buttonShare.setAttribute("type", "submit");
    buttonShare.setAttribute("value","Condividi");
    buttonShare.setAttribute("name",selected_image);
    buttonBox.appendChild(buttonShare);
    boxPost.appendChild(nomeAlbum);
    boxPost.appendChild(imageAlbum);
    boxPost.querySelector(".imageAlbum").addEventListener('click',creaModaleimg);
    boxPost.appendChild(buttonBox);
    boxPost.querySelector(".buttonBox").addEventListener('click',creaModaleShare);
    library.appendChild(boxPost);
   }
 }
}

function onResponse(response)
{   
    return response.json();
}

function cercaContenuto(event){
event.preventDefault();
var token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
const form_data = new FormData(formCerca);
const inserito = formCerca.posts.value;
form_data.append('send',inserito);
form_data.append("opzione",formCerca.opzione.value);
form_data.append('_token',token);
opzione = formCerca.opzione.value;
fetch(event.currentTarget.getAttribute("doSearchContent"),{method:'POST', body: form_data}).then(onResponse).then(onJson);
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

var modalView;
var opzione;
var modal_cell;
const divMenu= document.querySelector("div#menuBar");
let formCerca = document.querySelector("#RicercaContenuto");
formCerca.addEventListener('submit',cercaContenuto);
divMenu.addEventListener("click",apriModaleMenu);


