function publish_post(action, formID) {
  switch (action) {
    case 'update':
        if (quill.getLength() === 1) { return window.alert('Post body is empty'); }
        var input = $("<input>").attr("type", "hidden").attr('name', 'body').val(quill.root.innerHTML);
        $('#' + formID).append(input).submit();
      break;
    case 'image':
        var cropper = $image.data('cropper'), reader = new FileReader();
        if (!cropper) { return window.alert('Please choose an image file.'); }
        cropper.getCroppedCanvas({ width: 800, height: 500, fillColor: '#ffffff' }).toBlob((blob) => {
          reader.readAsDataURL(blob);
          reader.onloadend = function() {
            $('#loader').removeClass('d-none').addClass('m-4');
            $('.center-loader-message').html('Uploading your image');
            $('#uploaded-image, .inf__drop-area').addClass('d-none');
            var input = $("<input>").attr("type", "hidden").attr("name", "image").val(reader.result);
            $('#' + formID).append(input).submit();
          }
        });
      break;
    case 'store':
        var cropper = $image.data('cropper'), reader = new FileReader();
        if (quill.getLength() === 1) { return window.alert('Post body is empty'); }
        if (!cropper) { return window.alert('Please choose an image file.'); }
        var input1 = $("<input>").attr("type", "hidden").attr('name', 'body').val(quill.root.innerHTML);
        cropper.getCroppedCanvas({ width: 800, height: 500, fillColor: '#ffffff' }).toBlob((blob) => {
          reader.readAsDataURL(blob);
          reader.onloadend = function() {
            var input2 = $("<input>").attr("type", "hidden").attr("name", "image").val(reader.result);
            $('#loader').removeClass('d-none').addClass('m-4');
            $('.center-loader-message').html('Your post is being published');
            $('#uploaded-image, .inf__drop-area, .publish_post_form_group').addClass('d-none');
            $('#' + formID).append(input1, input2).submit();
          }
        });
        break;
    default:
      break;
  }
}
