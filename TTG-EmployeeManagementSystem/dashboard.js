
document.addEventListener("DOMContentLoaded", () => {
    // Select toggle button and sidebar
    const toggleBtn = document.querySelector(".toggle-btn");
    const sidebar = document.querySelector(".sidebar");

    // Toggle the sidebar on button click
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    }


    // Close the sidebar when clicking outside it (optional, for better UX)
    document.addEventListener("click", (event) => {
        if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove("open");
        }
    });
});



function updateProfilePic() {
    const fileInput = document.getElementById('imageUpload');
    const profilePic = document.getElementById('profilePic');

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            profilePic.src = e.target.result; // Set the image to the uploaded file
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
}
