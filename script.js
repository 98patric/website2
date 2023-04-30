 
var currentImage = document.getElementById("current-image");

var imageThumbs = document.getElementById("image-thumbs");

for (var i = 1; i <= 7; i++){

	var thumb = document.createElement("img");
	thumb.src = "image" + i + ".JPG";
	thumb.alt = "Image " + i;
  
	thumb.classList.add("thumb");
	imageThumbs.appendChild(thumb);

	thumb.addEventListener(
		"click", function() {
			currentImage.src = this.src;
			currentImage.alt = this.alt;
		}
		);
 
}
