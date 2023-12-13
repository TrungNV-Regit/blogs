const uploadImageInput = document.getElementById('uploadImage');
const imageBlog = document.getElementById('imageBlog');
let header = document.querySelector("#headerScroll");
let previousScroll = window.scrollY;

if (uploadImageInput) {
    uploadImageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = (e) => {
            imageBlog.src = e.target.result;
            imageBlog.classList.remove('d-none');
        };

        reader.readAsDataURL(file);
        document.getElementById('buttonDeleteImage').classList.remove('d-none');
    });
}

function deleteImage(hasImage) {
    uploadImageInput.value = '';
    document.getElementById('imageBlog').classList.add('d-none');
    document.getElementById('buttonDeleteImage').classList.add('d-none');
    if (hasImage) {
        document.getElementById('checkDeleteImage').checked = true;
    }
}

document.addEventListener('scroll', function () {
    if (window.scrollY > previousScroll) {
        header.classList.remove('header-down');
        header.classList.add('header-up');
    } else {
        header.classList.remove('header-up');
        header.classList.add('header-down');
    }

    previousScroll = window.scrollY;
});

function handleOnchangeCategory(value) {
    document.getElementById('categoryId').value = value;
    document.getElementById('search').submit();
}

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}
