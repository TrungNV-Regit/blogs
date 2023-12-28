import "../config.js";
import "../../bootstrap.js";
import data from "../data.js";
import services from "./services.js";

let imageLikeElement = $('#like');

$(document).ready(function () {

    $('#like').click(function () {
        $.ajax({
            url: data.route.like,
            type: 'POST',
            data: {
                blogId: data.blog.id,
            },
            success: function (data) {
                let liked = JSON.parse(data);
                services.handleLikeEvent(liked);
                if (liked) {
                    imageLikeElement.removeClass('liked');
                    imageLikeElement.addClass('unliked');
                } else {
                    imageLikeElement.removeClass('unliked');
                    imageLikeElement.addClass('liked');
                }
            },
            error: function (xhr) {
                if (xhr.status == 401 || xhr.status == 403) {
                    window.location.href = data.route.login;
                }
            }
        });
    });
});
