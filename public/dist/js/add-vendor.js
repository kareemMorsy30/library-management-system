/*jslint plusplus: true, evil: true */
/*global console, alert, prompt, confirm, $, jQuery */

function passwordCheck() {
    "use strict";
    var passwordOne = document.getElementById("password"),
        passwordTwo = document.getElementById("rep-password"),
        message = document.getElementById("message");
    if (passwordTwo.value === "") {
        message.textContent = "";
    } else if (passwordOne.value === "") {
        message.textContent = "Password field is empty";
        message.style.color = "red";
    } else if (passwordTwo.value === passwordOne.value) {
        message.textContent = "Passwords Match";
        message.style.color = "green";
    } else if (passwordTwo.value !== passwordOne.value) {
        message.textContent = "Passwords Do Not Match";
        message.style.color = "red";
    }
}
function passwordOneCheck() {
    "use strict";
    var passwordOne = document.getElementById("password"),
        passwordTwo = document.getElementById("rep-password"),
        message = document.getElementById("message");
    if (passwordTwo.value !== "") {
        if (passwordTwo.value === "") {
            message.textContent = "";
        } else if (passwordOne.value === "") {
            message.textContent = "Password field is empty";
            message.style.color = "red";
        } else if (passwordTwo.value === passwordOne.value) {
            message.textContent = "Passwords Match";
            message.style.color = "green";
        } else if (passwordTwo.value !== passwordOne.value) {
            message.textContent = "Passwords Do Not Match";
            message.style.color = "red";
        }
    }
}