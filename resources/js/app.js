const uploadImageInput = $('#uploadImage');
const imageBlog = $('#imageBlog');
let header = $("#headerScroll");
let previousScroll = window.scrollY;

if (imageBlog.attr('has-error') && localStorage.getItem('imageBlog')) {
    imageBlog.attr('src', localStorage.getItem('imageBlog'));
    imageBlog.removeClass('d-none');
    $('#buttonDeleteImage').removeClass('d-none');
} else {
    localStorage.removeItem('imageBlog');
}

if (uploadImageInput.length) {
    uploadImageInput.on('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = (e) => {
            imageBlog.attr('src', e.target.result);
            imageBlog.removeClass('d-none');
            localStorage.setItem('imageBlog', e.target.result);
        };

        reader.readAsDataURL(file);
        $('#buttonDeleteImage').removeClass('d-none');
    });
}

function deleteImage(hasImage) {
    localStorage.removeItem('imageBlog');
    uploadImageInput.val('');
    imageBlog.addClass('d-none');
    $('#buttonDeleteImage').addClass('d-none');
    if (hasImage) {
        $('#checkDeleteImage').prop('checked', true);
    }
}

$(document).scroll(function () {
    if ($(window).scrollTop() > previousScroll) {
        header.removeClass('header-down');
        header.addClass('header-up');
    } else {
        header.removeClass('header-up');
        header.addClass('header-down');
    }

    previousScroll = $(window).scrollTop();
});

function handleOnchangeCategory(value) {
    $('#categoryId').val(value);
    $('#search').submit();
}

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(index) {
    showSlides(slideIndex += index);
}

function currentSlide(index) {
    showSlides(slideIndex = index);
}

function showSlides(index) {
    let slides = $(".slide");
    let dots = $(".dot");
    if (slides.length) {
        if (index > slides.length) {
            slideIndex = 1;
        }
        if (index < 1) {
            slideIndex = slides.length;
        }
        slides.hide();
        dots.removeClass("active");
        slides.eq(slideIndex - 1).show();
        dots.eq(slideIndex - 1).addClass("active");
    }
}

function seachMobile() {
    $('#headerMobile').find('div:first').addClass('d-none');
    $('#headerMobile').find('form').removeClass('d-none');
    $('#headerMobile').find('input:first').focus();
}

function handleCancelSearch() {
    $('#headerMobile').find('div:first').removeClass('d-none');
    $('#headerMobile').find('form').addClass('d-none');
}
