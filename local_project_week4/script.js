document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("profileImage");
    const previewImage = document.getElementById("imagePreview");

    if (fileInput) {
        fileInput.addEventListener("change", function (event) {
            const file = event.target.files[0];

            if (file) {
                // Check if the uploaded file is an image
                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = "block"; // Show the preview
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert("Please upload a valid image file (JPG, PNG, GIF).");
                    fileInput.value = ""; // Clear invalid file
                    previewImage.style.display = "none"; // Hide preview
                }
            }
        });
    }
});
