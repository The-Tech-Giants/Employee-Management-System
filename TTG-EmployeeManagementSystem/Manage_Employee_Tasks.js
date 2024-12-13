document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.querySelector(".toggle-btn");
    const sidebar = document.querySelector(".sidebar");
    
    // Sidebar toggle functionality
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    }

    // Close sidebar when clicking outside it (optional, for better UX)
    document.addEventListener("click", (event) => {
        if (sidebar && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove("open");
        }
    });
    

    // Profile picture upload logic
    const input = document.getElementById("imageUpload");
    const img = document.getElementById("profilePic");
    
    if (input) {
        input.addEventListener("change", () => {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    img.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
