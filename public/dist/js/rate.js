let stars = document.getElementsByClassName('ranks');
let rating = document.getElementsByName('hiddenrate')[0];

function rate(index){
    for(let i=0 ; i<5 ; i++){
        if(i< index){
            stars[i].innerHTML = "&star;";
            stars[i].style.color="black";
        }else{
            stars[i].innerHTML = "&starf;";
            stars[i].style.color="gold";
            
        }
    }
    rating.value = Math.abs(index-5);
}

for(let i=0 ; i < 5 ; i++ ){
    stars[i].addEventListener("click",()=>{rate(i)});
}

