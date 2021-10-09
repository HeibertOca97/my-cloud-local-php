"use strict";

const form_img = document.querySelector("#form-img"),
file_image = document.querySelector("input[name=image]"),
status_img = document.querySelector("#status-file"),
btn_cancel =document.getElementById("btn-cancel");

const img_src = document.querySelector("#box-img"),
    txt_name =document.getElementsByClassName("name")[0],
    txt_type =document.getElementsByClassName("type")[0];

if(btn_cancel){
    btn_cancel.style.display = "none";
    btn_cancel.addEventListener("click", clearValueInputFile);
}

function clearValueInputFile(){
    btn_cancel.style.display = "none";
    img_src.setAttribute("src", "");
    file_image.value = "";
    txt_name.innerHTML = "";
    txt_type.innerHTML = "";
    messageState({
        color: "",
        margin: "",
        message: ""
    });
}

function messageState($obj){
    const {color, margin, message} = $obj;
    status_img.style.color = color;
    status_img.style.margin = margin;
    status_img.innerHTML = message;
}

if(form_img){
    form_img.addEventListener('submit', sendImageFile);
}

function sendImageFile(e){
    e.preventDefault();
    if(file_image.value){
        e.target.submit();
    }else{
        messageState({
            color: "red",
            margin: "20px",
            message: "Debe escoger una imagen para poder guardarla"
        });
    }
}

if(file_image){
    file_image.addEventListener('change', getImage);
}

function getImage(e){    
    const fileObj = e.target.files[0];
    const file = e.target;
    const img_exp = /\.(jpg|png|gif)$/i;
    const {name, type} = fileObj;
    const _name = name.split('.')[0];
    
    
    if(img_exp.test(name)){
        btn_cancel.style.display = "block";

        const url_tmp = URL.createObjectURL(fileObj);
        img_src.setAttribute("src", url_tmp);

        txt_name.innerHTML = "<strong>Nombre:</strong> " + _name;
        txt_type.innerHTML = "<strong>Tipo:</strong> " + type;
        messageState({
            color: "green",
            margin: "20px",
            message: "Imagen lista para guardar"
        });
    }else{
        btn_cancel.style.display = "none";

        img_src.setAttribute("src", "");
        file.value="";
        txt_name.innerHTML = "";
        txt_type.innerHTML = "";
        messageState({
            color: "red",
            margin: "20px",
            message: "Lo que ha intentando escoger no es una imagen"
        });
    }
   
}