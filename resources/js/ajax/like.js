import "./config.js"

let blog = JSON.parse(document.getElementById('data').getAttribute('blog'));
let imageLikeElement = document.getElementById('like');
var totalLikeElement = document.getElementById('totalLike');
let rootUrl = window.location.origin;

$(document).ready(function () {
    $('#like').click(function () {
        $.ajax({
            url: rootUrl + '/blog/like',
            type: 'POST',
            data: {
                blogId: blog.id,
            },
            success: function (data) {
                let liked = JSON.parse(data)
                let totalLike = parseInt(totalLikeElement.innerHTML);
                if (liked) {
                    totalLikeElement.innerHTML = totalLike - 1;
                    imageLikeElement.classList.remove('liked');
                    imageLikeElement.classList.add('unliked');
                } else {
                    totalLikeElement.innerHTML = totalLike + 1;
                    imageLikeElement.classList.remove('unliked');
                    imageLikeElement.classList.add('liked');
                }
            },
            error: function (xhr) {
                if (xhr.status == 401) {
                    window.location.href = rootUrl + "/auth/sign-in";
                }
            }
        });
    });
});
