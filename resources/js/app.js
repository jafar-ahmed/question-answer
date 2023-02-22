require('./bootstrap');

require('alpinejs');


window.Echo.private('App.Models.User.' + userId)
    .notification(function (data) {
        alert(data.body)
    });
