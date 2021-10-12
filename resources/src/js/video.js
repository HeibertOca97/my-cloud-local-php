"use strict";

const form_video = document.querySelector("#form-img"),
file_image = document.querySelector("input[name=video]"),
status_img = document.querySelector("#status-file"),
btn_cancel =document.getElementById("btn-cancel"),
btn_select =document.getElementById("btn-select");

const video_src = document.querySelector("#box-video"),
    txt_name =document.getElementsByClassName("name")[0],
    txt_type =document.getElementsByClassName("type")[0];

if(btn_cancel){
    btn_cancel.style.display = "none";
    btn_cancel.addEventListener("click", clearValueInputFile);
}

video_src.parentElement.style.display = "none";

function clearValueInputFile(){
    btn_cancel.style.display = "none";
    video_src.parentElement.style.display = "none";
    video_src.setAttribute("src", "");
    video_src.setAttribute("type", "");
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

if(form_video){
    form_video.addEventListener('submit', saveImageFile);
}

function saveImageFile(e){
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
    const img_exp = /\.(mp4|flv|avi|wmv)$/i;
    const {name, type} = fileObj;
    const _name = name.split('.')[0];
    
    
    if(img_exp.test(name)){
        btn_select.style.display = "none";
        btn_cancel.style.display = "block";

        video_src.parentElement.style.display = "block";
        const url_tmp = URL.createObjectURL(fileObj);
        video_src.setAttribute("src", url_tmp);
        video_src.setAttribute("type", type);

        txt_name.innerHTML = "<strong>Nombre:</strong> " + _name;
        txt_type.innerHTML = "<strong>Tipo:</strong> " + type;
        messageState({
            color: "green",
            margin: "20px",
            message: "Video lista para guardar"
        });
    }else{
        btn_select.style.display = "block";
        btn_cancel.style.display = "none";
        video_src.parentElement.style.display = "none";
        video_src.setAttribute("src", "");
        video_src.setAttribute("type", "");
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

let btn_delete_video = document.getElementsByClassName("delete-video");
for (let index = 0; index < btn_delete_video.length; index++) {
    const form_delete = btn_delete_video[index];
    deleteImageFile(form_delete);
}

function deleteImageFile(form){
    form.addEventListener("submit", e => {
        e.preventDefault();
        if(window.confirm("Esta seguro de eliminar este video?")){
            e.target.submit();
        }
    })
}