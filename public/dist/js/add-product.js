/*jslint plusplus: true, evil: true */
/*global console, alert, prompt, confirm, $, jQuery */

$(document).ready(function () {
    "use strict";
    $('#summernote').summernote();
    
});

function cat() {
    "use strict";
    var select = document.getElementById("cats"),
        categories = document.getElementById("selected-categories"),
        newCat = document.createElement("div"),
        inputShow = document.createElement("input"),
        input = document.createElement("input"),
        close = document.createElement("span");
    categories.appendChild(newCat);
    newCat.appendChild(inputShow);
    newCat.appendChild(input);
    newCat.appendChild(close);
    inputShow.setAttribute("disabled", "disabled");
    inputShow.classList.add("cat");
    inputShow.setAttribute("value", select.value);
    input.classList.add("hidden");
    input.setAttribute("name", "categories[]");
    input.setAttribute("value", select.value);
    close.innerHTML = "&times;";
    close.classList.add("closeit");

    close.onclick = function closeit() {
        newCat.parentNode.removeChild(newCat);
    };
}
function showDate() {
    "use strict";
    var cancel = document.getElementById("cancel"),
        dates = document.getElementById("dates");
    dates.classList.add("show");
    dates.classList.remove("hide");
}
function hideDate() {
    "use strict";
    var cancel = document.getElementById("cancel"),
        dates = document.getElementById("dates"),
        startDate = document.getElementById("start-date"),
        endDate = document.getElementById("end-date");
    startDate.value = "";
    endDate.value = "";
    dates.classList.add("hide");
    dates.classList.remove("show");
}

/*jslint plusplus: true, evil: true */
/*global console, alert, prompt, confirm, $, jQuery */

$(document).ready(function () {
    "use strict";
    $('#summernote').summernote();
    
});

function cat() {
    "use strict";
    var select = document.getElementById("cats"),
        categories = document.getElementById("selected-categories"),
        newCat = document.createElement("div"),
        inputShow = document.createElement("input"),
        input = document.createElement("input"),
        close = document.createElement("span");
    categories.appendChild(newCat);
    newCat.appendChild(inputShow);
    newCat.appendChild(input);
    newCat.appendChild(close);
    inputShow.setAttribute("disabled", "disabled");
    inputShow.classList.add("cat");
    inputShow.setAttribute("value", select.value);
    input.classList.add("hidden");
    input.setAttribute("name", "categories[]");
    input.setAttribute("value", select.value);
    close.innerHTML = "&times;";
    close.classList.add("closeit");

    close.onclick = function closeit() {
        newCat.parentNode.removeChild(newCat);
    };
}
function showDate() {
    "use strict";
    var cancel = document.getElementById("cancel"),
        dates = document.getElementById("dates");
    dates.classList.add("show");
    dates.classList.remove("hide");
}
function hideDate() {
    "use strict";
    var cancel = document.getElementById("cancel"),
        dates = document.getElementById("dates"),
        startDate = document.getElementById("start-date"),
        endDate = document.getElementById("end-date");
    startDate.value = "";
    endDate.value = "";
    dates.classList.add("hide");
    dates.classList.remove("show");
}