function publish_post(action, formID) {
  switch (action) {
    case 'update':
        if (quill.getLength() === 1) { return window.alert('Post body is empty'); }
        var input = $("<input>").attr("type", "hidden").attr('name', 'body').val(quill.root.innerHTML);
        $('#' + formID).append(input).submit();
      break;
    case 'image':
        var cropper = $image.data('cropper'), reader = new FileReader(), input1, input2, input3;
        if (!cropper) { return window.alert('Please choose an image file.'); }
        cropper.getCroppedCanvas({ width: 800, height: 500, fillColor: '#ffffff' }).toBlob((blob) => {
          reader.readAsDataURL(blob);
          reader.onloadend = function() {
            input1 = $("<input>").attr("type", "hidden").attr("name", "image_lg").val(reader.result);
            new Compressor(blob, {
              width: 400,
              height: 400,
              quality: 0.5,
              success(result1) {
                reader.readAsDataURL(result1);
                reader.onloadend = function() {
                  input2 = $("<input>").attr("type", "hidden").attr("name", "image_md").val(reader.result);
                  new Compressor(blob, {
                    width: 200,
                    height: 200,
                    quality: 0.5,
                    success(result2) {
                      reader.readAsDataURL(result2);
                      reader.onloadend = function() {
                        input3 = $("<input>").attr("type", "hidden").attr("name", "image_sm").val(reader.result);
                        $('#loader').removeClass('d-none').addClass('m-4');
                        $('.center-loader-message').html('Uploading your image');
                        $('#uploaded-image, .inf__drop-area').addClass('d-none');
                        $('#' + formID).append(input1, input2, input3).submit();
                      }
                    },
                    error(err) {
                      console.log(err.message);
                    },
                  });
                }
              },
              error(err) {
                console.log(err.message);
              },
            });
          }
        });
      break;
    case 'store':
        var cropper = $image.data('cropper'), reader = new FileReader(), input1, input2, input3, input4;
        if (quill.getLength() === 1) { return window.alert('Post body is empty'); }
        if (!cropper) { return window.alert('Please choose an image file.'); }
        input1 = $("<input>").attr("type", "hidden").attr('name', 'body').val(quill.root.innerHTML);
        cropper.getCroppedCanvas({ width: 800, height: 500, fillColor: '#ffffff' }).toBlob((blob) => {
          reader.readAsDataURL(blob);
          reader.onloadend = function() {
            input2 = $("<input>").attr("type", "hidden").attr("name", "image_lg").val(reader.result);
            new Compressor(blob, {
              width: 400,
              height: 400,
              quality: 0.5,
              success(result1) {
                reader.readAsDataURL(result1);
                reader.onloadend = function() {
                  input3 = $("<input>").attr("type", "hidden").attr("name", "image_md").val(reader.result);
                  new Compressor(blob, {
                    width: 200,
                    height: 200,
                    quality: 0.5,
                    success(result2) {
                      reader.readAsDataURL(result2);
                      reader.onloadend = function() {
                        input4 = $("<input>").attr("type", "hidden").attr("name", "image_sm").val(reader.result);
                        $('#loader').removeClass('d-none').addClass('m-4');
                        $('.center-loader-message').html('Your post is being published');
                        $('#uploaded-image, .inf__drop-area, .publish_post_form_group').addClass('d-none');
                        $('#' + formID).append(input1, input2, input3, input4).submit();
                      }
                    },
                    error(err) {
                      console.log(err.message);
                    },
                  });
                }
              },
              error(err) {
                console.log(err.message);
              },
            });
          }
        });
        break;
    default:
      break;
  }
}
