function nightModeCookie() {
    let d = new Date(Date.now() + 86400000); // = 1 day
    d = d.toUTCString(); // convert into a string

    document.cookie = 'night=false; path=/; expires=' + d;
    if(document.ccokie.length > 0){
        let tableCookies = document.cookie.split(';');
        let nightCookie = "night=";
        let valueCookie = "";
        for(i=0; i<tableCookies.length; i++){
            if(tableCookies[i].indexOf(nightCookie) != -1){
                valueCookie = tableCookies[i].substring(nightCookie.length + tableCookies[i].indexOf(nightCookie), tableCookies[i].length);
            }
        }
        console.log(valueCookie);
        console.log(valueCookie);

    }
}

function redirection() {
    window.location.href = 'http://localhost/wf3/bdd/Images-Galery-PHP/images.php';
}

function setFaviconDisplayMode() {
    const nightInput = document.querySelector('#nightInput');
    const nightSelection = document.querySelector("#nightSelection");
    const mainTitle = document.querySelector(".h1");
    let date = new Date(Date.now() + 3600 * 1000); // one hour
    date = date.toUTCString();

    if((document.cookie)){
        nightInput.addEventListener('click', function() {
            if (nightInput.checked == true) {
                nightSelection.innerHTML = "<i class='fas fa-sun fa-lg mt-2'></i>";
                nightSelection.value = true;
                mainTitle.style.color = "white";
                document.body.style.background = "black";
                document.cookie = "night=true; path=/; expires=" + date;

            } else if (nightInput.checked == false) {
                nightSelection.innerHTML = "<i class='far fa-moon fa-lg mt-2'></i>";
                nightSelection.value = false;
                mainTitle.style.color = "black";
                document.body.style.backgroundImage = 'url("content/font2.jpg")';
                document.cookie = "night=false; path=/; expires" + date;
            }
        })
    }
    else {
        document.cookie = "night=false; path=/; expires" + date;
        saveState("night");
        console.log(document.cookie);
    }
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

/* function saveState(state){
    const nightSelection = document.querySelector("#nightSelection");
    if(state == true){
        nightSelection.innerHTML = "<i class='fas fa-sun fa-lg mt-2' onclick='setFaviconDisplayMode()'></i>";
    } else if(state == false) {
        nightSelection.innerHTML = "<i class='far fa-moon fa-lg mt-2' onclick='setFaviconDisplayMode()'></i>";
    } else if(document.cookie === null) {
        document.cookie("night=false; path=/; expires = 36000000");
    }
    //return nightSelection.innerHTML;
} */

function defaultModeIcon(mode) {
    const nightSelection = document.querySelector("#nightSelection");
    if(mode == false) {
        nightSelection.innerHTML = "<i class='far fa-moon fa-lg mt-2' onclick='setFaviconDisplayMode()'></i>";
        document.cookie = "night=false; path=/; expires = 3600000";
    } else if(mode == true) {
        nightSelection.innerHTML = "<i class='fas fa-sun fa-lg mt-2' onclick='setFaviconDisplayMode()'></i>";
        document.cookie = "night=true; path=/; expires = 3600000";
    }
    return nightSelection.innerHTML;
}