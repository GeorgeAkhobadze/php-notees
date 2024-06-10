const fileInput = document.getElementById('profilePictureInput')

document.getElementById('change-picture').addEventListener('click', function(e) {
    e.preventDefault();
    fileInput.click();
});

fileInput.onchange = function() {
    document.getElementById("profile-form").submit();
}