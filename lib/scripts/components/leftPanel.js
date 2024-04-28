window.addEventListener("DOMContentLoaded", (event) => {
    document.getElementById('profilePictureImg').addEventListener('click', function() {
        document.getElementById('profilePictureInput').click();
    });
    
    document.getElementById('profilePictureInput').addEventListener('change', function() {
        document.getElementById('profilePictureForm').submit();
    });
});