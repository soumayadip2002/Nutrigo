window.onscroll = () => {
    if(searchForm){
        searchForm.classList.remove('active');
    }
    if(shoopingCart){
        shoopingCart.classList.remove('active');
    }
    if(loginForm){
        loginForm.classList.remove('active');
    }
    if(NavBar){
        NavBar.classList.remove('active');
    }
    if(favcart){
        favcart.classList.remove('active');
    }
}


searchForm = document.querySelector('.search-form');
if(document.querySelector('#search-btn')){
    document.querySelector('#search-btn').onclick = () => {
        if(searchForm){
            searchForm.classList.toggle('active');
        }
        if(shoopingCart){
            shoopingCart.classList.remove('active');
        }
        if(loginForm){
            loginForm.classList.remove('active');
        }
        if(NavBar){
            NavBar.classList.remove('active');
        }
        if(favcart){
            favcart.classList.remove('active');
        }
    }
    
}

shoopingCart = document.querySelector('.shopping-cart');
if(document.querySelector('#cart-btn')){
    document.querySelector('#cart-btn').onclick = () => {
        if(searchForm){
            searchForm.classList.remove('active');
        }
        if(shoopingCart){
            shoopingCart.classList.toggle('active');
        }
        if(loginForm){
            loginForm.classList.remove('active');
        }
        if(NavBar){
            NavBar.classList.remove('active');
        }
        if(favcart){
            favcart.classList.remove('active');
        }
    }
}


let favcart = document.querySelector('.fav-cart');
if(document.querySelector('#fav-btn')){
    document.querySelector('#fav-btn').onclick = () => {
        if(searchForm){
            searchForm.classList.remove('active');
        }
        if(shoopingCart){
            shoopingCart.classList.remove('active')
        }
        if(loginForm){
            loginForm.classList.remove('active');
        }
        if(NavBar){
            NavBar.classList.remove('active');
        }
        if(favcart){
            favcart.classList.toggle('active');
        }
    }
    
}


let NavBar = document.querySelector('.navbar');
if(document.querySelector('#menu-btn')){
    document.querySelector('#menu-btn').onclick = () => {
        if(searchForm){
            searchForm.classList.remove('active');
        }
        if(shoopingCart){
            shoopingCart.classList.remove('active')
        }
        if(loginForm){
            loginForm.classList.remove('active');
        }
        if(NavBar){
            NavBar.classList.toggle('active');
        }
        if(favcart){
            favcart.classList.remove('active');
        }
    
    }
    
}

let loginForm = document.querySelector('.login-form');
if(document.querySelector('#login-btn')){
    document.querySelector('#login-btn').onclick = () => {
        if(searchForm){
            searchForm.classList.remove('active');
        }
        if(shoopingCart){
            shoopingCart.classList.remove('active')
        }
        if(loginForm){
            loginForm.classList.toggle('active');
        }
        if(NavBar){
            NavBar.classList.remove('active');
        }
        if(favcart){
            favcart.classList.remove('active');
        }
    
    }
}


