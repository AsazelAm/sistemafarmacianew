const inputs=document.querySelectorAll(".input");

function addcl(){
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}
function remcl(){
    let parent = this.parentNode.parentNode;    
    if(this.value == ""){/*con esto le decimos q si el contenido esta vacio se vuelva a su lugar q esta inicialmente */
        parent.classList.remove("focus");
    }
}
inputs.forEach(input =>{ //haca le decimos q se repita cada ves q el usuario de el click
    input.addEventListener("focus",addcl);
    input.addEventListener("blur",remcl);
});
console.log("ss");
