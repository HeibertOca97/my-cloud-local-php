"use strict";

const form_doc = document.querySelector("#form-doc"),
file_doc = document.querySelector("input[name=document]"),
status_doc = document.querySelector("#status-file"),
btn_cancel =document.getElementById("btn-cancel"),
btn_select =document.getElementById("btn-select");

const doc_src = document.querySelector("#box-doc"),
    txt_name =document.getElementsByClassName("name")[0],
    txt_type =document.getElementsByClassName("type")[0];

if(btn_cancel){
    btn_cancel.style.display = "none";
    btn_cancel.addEventListener("click", clearValueInputFile);
}

doc_src.style.display = "none";

function clearValueInputFile(){
    btn_select.style.display = "block";
    btn_cancel.style.display = "none";
    doc_src.style.display = "none";
    doc_src.setAttribute("src", "");
    file_doc.value = "";
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
    status_doc.style.color = color;
    status_doc.style.margin = margin;
    status_doc.innerHTML = message;
}

if(form_doc){
    form_doc.addEventListener('submit', saveDocumentFile);
}

function saveDocumentFile(e){
    e.preventDefault();
    if(file_doc.value){
        e.target.submit();
    }else{
        messageState({
            color: "red",
            margin: "20px",
            message: "Debe escoger un documento para poder guardarlo"
        });
    }
}

if(file_doc){
    file_doc.addEventListener('change', validatedFileTypeDocument);
}

function validatedFileTypeDocument(e){    
    const fileObj = e.target.files[0];
    const file = e.target;
    const img_exp = /\.(pdf)$/i;
    const {name, type} = fileObj;
    const _name = name.split('.')[0];
    
    
    if(img_exp.test(name)){
        btn_select.style.display = "none";
        btn_cancel.style.display = "block";

        doc_src.style.display = "block";
        const url_tmp = URL.createObjectURL(fileObj);
        doc_src.setAttribute("src", url_tmp);

        txt_name.innerHTML = "<strong>Nombre:</strong> " + _name;
        txt_type.innerHTML = "<strong>Tipo:</strong> " + type;
        messageState({
            color: "green",
            margin: "20px",
            message: "Documento listo para guardar"
        });
    }else{
        btn_select.style.display = "block";
        btn_cancel.style.display = "none";
        doc_src.style.display = "none";
        doc_src.setAttribute("src", "");
        file.value="";
        txt_name.innerHTML = "";
        txt_type.innerHTML = "";
        messageState({
            color: "red",
            margin: "20px",
            message: "Lo que ha intentando escoger no es un documento"
        });
    }
   
}

let btn_delete_doc = document.getElementsByClassName("delete-doc");
for (let index = 0; index < btn_delete_doc.length; index++) {
    const form_delete = btn_delete_doc[index];
    deleteDocumentFile(form_delete);
}

function deleteDocumentFile(form){
    form.addEventListener("submit", e => {
        e.preventDefault();
        if(window.confirm("Esta seguro de eliminar este documento?")){
            e.target.submit();
        }
    })
}