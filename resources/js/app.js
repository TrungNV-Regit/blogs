const uploadImageInput = document.getElementById('uploadImage');
const imageBlog = document.getElementById('imageBlog');

uploadImageInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = (e) => {
        imageBlog.src = e.target.result;
        imageBlog.style.display = 'block';
    };

    reader.readAsDataURL(file);
});
