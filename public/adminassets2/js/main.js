
//this for thumbnail video
document.getElementById('mediaInput').addEventListener('change', function(event) {
    const files = event.target.files;
    const thumbnailPreview = document.getElementById('thumbnailPreview');

    thumbnailPreview.innerHTML = ''; // Clear previous preview

    if (files) {
      Array.from(files).forEach(file => {
        if (file.type.startsWith('video/')) {
          generateThumbnail(file);
        }
      });
    }
  });

  function generateThumbnail(videoFile) {
    const video = document.createElement('video');
    video.src = URL.createObjectURL(videoFile);

    video.onerror = function(error) {
        console.error('Error loading video:', error);
        // Display a user-friendly error message
    };

    video.onloadedmetadata = function() {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        if (video.readyState >= 4) {
            const seekTime = 5; // Seek to 5 seconds mark
            video.currentTime = seekTime;

            video.onseeked = function() {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                 
                const thumbnailInput = document.createElement('input');
                thumbnailInput.type = 'hidden';
                thumbnailInput.name = 'thumbnails';
                thumbnailInput.value = canvas.toDataURL(); // Convert canvas to data URL

                document.getElementById('mediaForm').appendChild(thumbnailInput);

                document.getElementById('thumbnailPreview').appendChild(thumbnailInput);
                document.getElementById('thumbnailPreview').style.display = 'block';

                const thumbnailImage = document.createElement('img');
                thumbnailImage.src = canvas.toDataURL(); // Set the image source
                thumbnailImage.style.maxWidth = '100px';
                thumbnailImage.style.maxHeight = '100px';
                 
                document.getElementById('thumbnailPreview').appendChild(thumbnailImage);
            };
        } else {
            console.warn('Video not ready to capture frame');
        }
    };

    video.onended = function() {
        URL.revokeObjectURL(video.src);
    };
  }
