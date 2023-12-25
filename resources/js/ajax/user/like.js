import "../config.js"
import data from "../data.js";

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
                let liked = JSON.parse(data)
                let totalLike = parseInt($('#totalLike').text());
                let newTotalLikeElement = $('<span>').attr('id', 'totalLike');
                if (liked) {
                    newTotalLikeElement.text(totalLike - 1);
                    imageLikeElement.removeClass('liked');
                    imageLikeElement.addClass('unliked');
                } else {
                    newTotalLikeElement.text(totalLike + 1);
                    imageLikeElement.removeClass('unliked');
                    imageLikeElement.addClass('liked');
                }
                $('#totalLike').slideUp(function () {
                    $(this).replaceWith(newTotalLikeElement);
                    newTotalLikeElement.hide().slideDown();
                });
            },
            error: function (xhr) {
                if (xhr.status == 401 || xhr.status == 403) {
                    window.location.href = data.route.login;
                }
            }
        });
    });
});
