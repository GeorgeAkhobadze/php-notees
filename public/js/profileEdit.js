const fileInput = document.getElementById('profilePictureInput')

document.getElementById('change-picture').addEventListener('click', function(e) {
    e.preventDefault();
    fileInput.click();

    console.log(fileInput)
});

fileInput.onchange = function() {
    document.getElementById("profile-form").submit();

}