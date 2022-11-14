const searchBar = document.querySelector(".users .search input"),
    searchBtn = document.querySelector(".users .search button"),
    usersList = document.querySelector(".users .users-list");

searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();

    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    if (searchTerm != "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active")
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/search.php", true);
    xhr.onload = () => {
        let data = xhr.response;
        usersList.innerHTML = data;
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`searchTerm=${searchTerm}`);
}

                                                                                                                                                                                                                 
setInterval(() => {
     let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = () => {
        let data = xhr.response;
        if (!searchBar.classList.contains("active")) { //if class active not contains in search bar then add this
            usersList.innerHTML = data;
        }
        console.log(data);
    }
    xhr.send();
}, 500); //this function will run frequently after 500ms








