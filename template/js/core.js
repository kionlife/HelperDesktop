function refresh(status) {
    $.ajax({
        type: "POST",
        url: "https://10.10.2.98/helper/tickets/get/" + status,
        success: function (html) {
            $(".tickets").html(html);
        }
    });
}



function accept(ticket_id) {
    $.ajax({
        type: "POST",
        data: {
            "status": "accept"
        },
        url: "https://10.10.2.98/helper/tickets/changeStatus/" + ticket_id,
        success: function (data) {
            update();
        }
    });
}

function success(ticket_id) {
    $.ajax({
        type: "POST",
        data: {
            "status": "success"
        },
        url: "https://10.10.2.98/helper/tickets/changeStatus/" + ticket_id,
        success: function () {
            update();
        }
    });
}


function cls(ticket_id) {
    $.ajax({
        type: "POST",
        data: {
            "status": "close"
        },
        url: "https://10.10.2.98/helper/tickets/changeStatus/" + ticket_id,
        success: function () {
            refresh();
        }
    });
}

function sendNotification(title, options) {
    if (!("Notification" in window)) {
        alert('Ваш браузер не підтримує HTML Notifications');
    } else if (Notification.permission === "granted") {
        var notification = new Notification(title, options);

        function clickFunc() {
            //якщо клікнути на сповіщення
        }

        notification.onclick = clickFunc;
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                var notification = new Notification(title, options);

            } else {
                alert('Ви заборонили сповіщення');
            }
        });
    } else {
        //
    }
}


$(document).ready(function () {
    $("#menu a").click(function (event) {
        if ($(this).next('ul').length) {
            event.preventDefault();
            $(this).next().slideToggle('fast');
        }
    });
});

/*
sendNotification('Новий тікет!', {
    body: '',
    icon: '/template/img/logo.png',
    dir: 'auto'
});
*/