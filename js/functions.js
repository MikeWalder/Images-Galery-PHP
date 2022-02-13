function redirection() {
    window.location.href = 'http://localhost/wf3/bdd/Images-Galery-PHP/images.php';
}



function setFaviconDisplayMode() {
    const nightInput = document.querySelector('#nightInput');
    const nightSelection = document.querySelector("#nightSelection");
    let date = new Date(Date.now() + 3600 * 1000); // one hour
    date = date.toUTCString();

    if((document.cookie)){
        nightInput.addEventListener('click', function() {
            if (nightInput.checked == true) {
                nightSelection.innerHTML = "<i class='fas fa-sun fa-lg mt-2'></i>";
                nightSelection.value = true;
                document.body.style.background = "black";
                document.cookie = "night=true; path=/; expires=" + date;

            } else if (nightInput.checked == false) {
                nightSelection.innerHTML = "<i class='far fa-moon fa-lg mt-2'></i>";
                nightSelection.value = false;
                document.body.style.backgroundImage = 'url("content/font2.jpg")';
                document.cookie = "night=false; path=/; expires" + date;
            }
        })
    }
    else {
        document.cookie = "night=false; path=/; expires" + date;
        saveState("night");
    }
}



function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}



function checkModeIcon() {
    const nightSelection = document.querySelector("#nightSelection");
    const imgSelect = document.querySelector("#imgSelect");
    let night = getCookie("night");

    if(document.cookie) {
        if(night == "true") {
            nightSelection.innerHTML = "<i class='far fa-moon fa-lg mt-2' onclick='setFaviconDisplayMode()'></i>";
            document.body.style.background = "black";
            //maintitled.style.color = "white";
            imgSelect.style.backgroundColor = "white";

        } else if(night == "false") {
            nightSelection.innerHTML = "<i class='fas fa-sun fa-lg mt-2' onclick='setFaviconDisplayMode()'></i>";
            document.body.style.backgroundImage = 'url("content/font2.jpg")';
            //maintitled.style.color = "black";
            imgSelect.style.backgroundColor = "black";
        }
    return nightSelection.innerHTML;
    }
    else {
        nightSelection.innerHTML = "<i class='fas fa-sun fa-lg mt-2' onclick='setFaviconDisplayMode()'></i>";
        return nightSelection.innerHTML;
    }
}