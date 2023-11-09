const searchBar = document.querySelector(".home .search input"),
searchBtn = document.querySelector(".home .search button");
homeList = document.querySelector(".home .home-list");


searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }

    // Code AJAX sady mifandry amina php/search

    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/search.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                homeList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);

}

setInterval(()=>{

    //let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("GET", "php/home.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){ // Mba tsy ahafahan'ilay interval executer indroa satria mety hisy koa ny recherche utilisateurs
                    homeList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();

}, 500);

