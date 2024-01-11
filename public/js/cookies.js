function setCookie(name, val){
    let d = new Date();
    d.setTime(d.getTime());

    if(!(getCookie(name) === "true")){
        document.cookie=`${name}=${val};  path=/`;
    }
}
function getCookie(name){
    let vector_of_params = document.cookie.split(";");

    for(let param of vector_of_params){
        if(param.trim().startsWith(name+"=")){
            return param.split("=")[1];
        }
    }
    return null;
}


window.addEventListener("DOMContentLoaded", function(){
    if(getCookie("ok_cookies")){
        this.document.getElementById("cookies_banner").style.display = "none";
    }

    this.document.getElementById("ok_cookies").onclick = () => {
        setCookie("ok_cookies", true);
        this.document.getElementById("cookies_banner").style.display = "none";
        if(window.location.pathname !== '/'){
            location.reload();
        }
    }
})
