var $image = $('#post-thumbnail');
var URL = window.URL || window.webkitURL;
var originalImageURL = $image.attr('src');
var uploadedImageName = 'cropped.jpg';
var uploadedImageType = 'image/jpeg';
var uploadedImageURL;

$('#upload_image').on('change', function(){
  $('#loader').removeClass('d-none');

  var files = this.files;
  var file;

  if (files && files.length) {
    file = files[0];

    if (/^image\/\w+$/.test(file.type)) {

      uploadedImageName = file.name;
      uploadedImageType = file.type;

      if (uploadedImageURL) {
        URL.revokeObjectURL(uploadedImageURL);
      }

      uploadedImageURL = URL.createObjectURL(file);
      $image.cropper('destroy').attr('src', uploadedImageURL).cropper({
        aspectRatio: 16 / 9,
        viewMode: 1,
        dragMode: 'move',
        crop: function(event) {}
      });

      $('#uploaded-image').removeClass('d-none');

    } else {
      window.alert('Please choose an image file.');
    }

  }

  $('#loader').addClass('d-none');

});

$("#crop-image").click(function(event){
  var cropper = $image.data('cropper'), reader = new FileReader();
  if (!cropper) {
    return window.alert('Please choose an image file.');
  }
  cropper.getCroppedCanvas({ width: 800, height: 500, fillColor: '#ffffff' }).toBlob((blob) => {
    reader.readAsDataURL(blob);
    reader.onloadend = function() {
      $('#loader').removeClass('d-none').addClass('m-4');
      $('.center-loader-message').html('Uploading your image');
      $('#uploaded-image, .inf__drop-area').addClass('d-none');
      var input = $("<input>").attr("type", "hidden").attr("name", "image").val(reader.result);
      $('#upload_image_form').append(input).submit();
    }
  });
});

$('.cropper-action').click(function () {
  const action = $(this).attr("data-cropper");
  switch (action) {
    case 'scaleX-':
      $image.cropper("scaleX", -1)
      $(this).attr("data-cropper", "scaleX");
      break;
    case 'scaleX':
      $image.cropper("scaleX", 1)
      $(this).attr("data-cropper", "scaleX-");
      break;
    case 'scaleY-':
      $image.cropper("scaleY", -1)
      $(this).attr("data-cropper", "scaleY");
      break;
    case 'scaleY':
      $image.cropper("scaleY", 1)
      $(this).attr("data-cropper", "scaleY-");
      break;
    case 'rotateRight':
      $image.cropper("rotate", 45)
      break;
    case 'rotateLeft':
      $image.cropper("rotate", -45)
      break;
    default:
      break;
  }
});
