function detectLandmark() {
    var fileInput = document.getElementById('landmarkImageInput');
    var file = fileInput.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                var imageContainer = document.getElementById('landmarkImageContainer');
                imageContainer.innerHTML = '';
                imageContainer.appendChild(image);
                // Here you would call your backend API for logo recognition
                // and display the results in the corresponding result element
                var result = document.getElementById('landmarkResult');
                result.innerHTML = '<p>Detected landmark: [Landmark Name]</p>';
            };
        };
        reader.readAsDataURL(file);
    }
}

// Attach click event listener to the detect logo button
document.getElementById('detectLandmarkButton').addEventListener('click', detectLandmark);

// Function to handle "Go to Home" button click
document.getElementById('goToHome').addEventListener('click', function () {
    // Navigate to the home page
    window.location.href = '../page.html';
});