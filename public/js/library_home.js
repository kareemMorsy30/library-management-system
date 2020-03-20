$(function() {
    $('#borrow-model').on("show.bs.modal", function (e) {
        $("#borrowModalLabel").html("Borrow Confirmation");
        $("#book-title").html($(e.relatedTarget).data('title'));
        $("#book_id").val($(e.relatedTarget).data('book_id'))
    });
});


$(function() {
    $('#exampleModalCenter').on("show.bs.modal", function (e) {
        $("#comment").val($(e.relatedTarget).data('comment'))
        $("#rateId").val($(e.relatedTarget).data('id'))
    });
});

let searchBar = document.getElementById('formStyle');

searchBar.addEventListener('input' , e => {
    let query;
    if(e.target.value == ""){
        query = "NULL";
    }else{
        query = e.target.value;
    }
    
    console.log(query);
    
    let searchUrl = `/search-books/${query}`;

    $.ajax({
        type:'GET',
        url: searchUrl,
        success:function (data) {
            console.log(data);
           
            let categories = document.getElementsByClassName('links')[0];
            let container = document.getElementsByClassName('showCards')[0];
            container.innerHTML = "";

            if(categories){
                $('.links').slideUp("slow", function() { $('.links').remove();});
            }

            for(book of data.res){
                let flex_card = document.createElement('div');
                let img = document.createElement('img');
                img.setAttribute('src', `/uploads/${book.pic}`);
                flex_card.setAttribute('class', 'flex-card card');
                let a = document.createElement('a');
                a.setAttribute('href', `/user/book/${book.id}`);
                a.appendChild(img);

                let card_body = document.createElement('div');
                card_body.setAttribute('class', 'card-body');

                let title = document.createElement('p');
                let text = document.createElement('p');
                title.setAttribute('class', 'card-title');
                title.innerHTML = book.title;
                text.setAttribute('class', 'card-text');
                text.innerHTML = book.description;

                let status = document.createElement('button');
                status.setAttribute('class', 'btn btn-danger btn-sm');
                status.style.borderRadius = '15px';
                status.setAttribute('disabled', 'disabled');
                status.innerHTML= 'no copies available';

                let span = document.createElement('span');
                span.innerHTML = `${book.quantity} copies available`;

                let form = document.createElement('form');
                let hidden = document.createElement('input');
                let heart = document.createElement('input');
                let remToken = document.createElement('input');

                hidden.setAttribute('type', 'hidden');
                hidden.setAttribute('name', 'id');
                hidden.value = book.id;

                form.setAttribute('method', 'POST');

                heart.setAttribute('type', 'image');
                heart.setAttribute('id', 'heart');

                if(data.favourites.includes(book.id)){
                    form.setAttribute('action', '/remove-favourite');
                    heart.src = "/coloredheart.png";

                    remToken.type = 'hidden';
                    remToken.name = '_method';
                    remToken.value = 'delete';

                    form.append(remToken);
                }else{
                    form.setAttribute('action', '/Favourite');
                    heart.src = "/heart.png";
                }
                
                form.append(hidden);
                form.append(heart);

                card_body.append(title);
                card_body.append(text);
                if(book.quantity <= 0){
                    card_body.append(status);
                }else{
                    card_body.append(span);
                }
                
                card_body.append(form);

                let card_footer = document.createElement('div');
                card_footer.setAttribute('class', 'card-footer');

                let lease = document.createElement('button');
                lease.setAttribute('id', "lease");
                lease.setAttribute('data-toggle', "modal");
                lease.setAttribute('data-title', book.title);
                lease.setAttribute('data-book_id', book.id);
                lease.setAttribute('data-target', "#borrow-model");
                lease.setAttribute('class', "btn btn-success btn-sm btn-block lease");
                if(book.quantity <= 0){
                    lease.setAttribute('disabled', 'disabled');
                }
                
                lease.innerHTML = 'Lease';

                card_footer.appendChild(lease);

                flex_card.append(a);
                flex_card.append(card_body);
                flex_card.append(card_footer);

                container.append(flex_card);
            }
        },
        error:function(error){
            console.log(error);
        }
    });
});