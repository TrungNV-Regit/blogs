const uploadImageInput = document.getElementById('uploadImage');
const imageBlog = document.getElementById('imageBlog');

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

function deleteImage() {
    uploadImageInput.value = '';
    document.getElementById('imageBlog').classList.add('d-none');
    document.getElementById('buttonDeleteImage').classList.add('d-none');
    document.getElementById('checkDeleteImage').checked = true;
}
