window.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('profilePictureImgSettings').addEventListener('click', function() {
        document.getElementById('profilePictureInputSettings').click();
    });
    
    document.getElementById('profilePictureInputSettings').addEventListener('change', function() {
        document.getElementById('profilePictureFormSettings').submit();
    });
});