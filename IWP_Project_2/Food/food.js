function detectFood() {
    var fileInput = document.getElementById('foodImageInput');
    var file = fileInput.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                var imageContainer = document.getElementById('foodImageContainer');
                imageContainer.innerHTML = '';
                imageContainer.appendChild(image);
                // Here you would call your backend API for logo recognition
                // and display the results in the corresponding result element
                var result = document.getElementById('foodResult');
                result.innerHTML = '<p>Detected food item: [Item Name]</p>';
            };
        };
        reader.readAsDataURL(file);
    }
  }
  
  // Attach click event listener to the detect logo button
  document.getElementById('detectFoodButton').addEventListener('click', detectFood);
  
  // Function to handle "Go to Home" button click
  document.getElementById('goToHome').addEventListener('click', function () {
    // Navigate to the home page
    window.location.href = '../page.html';
  });