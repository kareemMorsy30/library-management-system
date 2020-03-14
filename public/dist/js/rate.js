let stars = document.getElementsByClassName('rankwithcomment');

for( let i=0; i<5 ; i++){
    stars[i].addEventListener("click",()=>{ rate(i) })
}

function rate(index){
    for(let i=0 ; i<5 ; i++){
        if(i<= index){
            stars[i].innerHTML = "&starf;";
            stars[i].getElementsByClassName.color="gold";
        }else{
            stars[i].innerHTML = "&star;";
            stars[i].getElementsByClassName.color="black";
        }
    }
}