var $image, originalImageURL, uploadedImageURL, ratio;
var URL = window.URL || window.webkitURL;
var uploadedImageName = 'cropped.png';
var uploadedImageType = 'image/png';

$('#iconInput, #logoLightInput, #logoDarkInput').on('change', function(){

  logo = $(this).attr('data-logo');
  $('#'+ logo +'Loader').removeClass('d-none');

  switch (logo) {
    case 'icon':
      ratio = 1 / 1;
      width = 75;
      height = 75;
      break;
    case 'logoLight':
      ratio = 16 / 2.8;
      width = 580;
      height = 100;
      break;
    case 'logoDark':
      ratio = 16 / 2.8;
      width = 580;
      height = 100;
      break;
    default:
      ratio = 1 / 1;
      width = 580;
      height = 100;
      break;
  }

  $image = $('#'+ logo +'Image');
  originalImageURL = $image.attr('src');

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
        aspectRatio: ratio,
        viewMode: 1,
        dragMode: 'move',
        crop: function(event) {}
      });

      $('#iconUploaded, #logoLightUploaded, #logoDarkUploaded').addClass('d-none');
      $('#'+ logo +'Uploaded').removeClass('d-none');

    } else {
      window.alert('Please choose an image file.');
    }

  }

  $('#'+ logo +'Loader').addClass('d-none');

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

function changeLogo(type, name) {
  var cropper = $image.data('cropper'), reader = new FileReader(), input;
  cropper.getCroppedCanvas({ width: width, height: height }).toBlob((blob) => {
    reader.readAsDataURL(blob);
    reader.onloadend = function() {
      input = $("<input>").attr("type", "hidden").attr("name", name).val(reader.result);
      $('#'+ type +'Loader').removeClass('d-none').addClass('m-4');
      $('.center-loader-message').html('Uploading your image');
      $('#'+ type +'Uploaded, .inf__drop-area').addClass('d-none');
      $('#'+ type +'Form').append(input).submit();
    }
  });
}
