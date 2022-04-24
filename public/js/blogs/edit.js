
function addImage(tag) {
  var tag = $(tag);
  tag.parent('div').append('<input type="file" name="images[]" multiple class="form-control" accept="image/*">');
} //-------------------


function deleteImage(tag) {
  var tag = $(tag);
  var imageId = tag.attr('data-image');
  swal({
    title: "Are you sure for delete?",
    text: "Your Image will delete from this Blog!",
    icon: "warning",
    buttons: [
      'No',
      'Yes'
    ],
    dangerMode: true,
  }).then(function(isConfirm) {
    if (isConfirm) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: ajaxRoute,
        data: {
          image: imageId
        },
        success: function success(data) {
          var images = data.images;
          $('#imgs').empty();
          $.each(JSON.parse(images), function (index, value) {
            $('#imgs').append('<li><a class="float-left btn btn-danger" data-image="' + value['id'] + '" onclick="deleteImage(this)" class="exit-x">X</a><div class="image-div" style="background-size: cover;background-image: url(' + value['path'] + ') ;" data-blog="' + value['blog_id'] + '" id="' + value['id'] + '" ></div></li>');
          });
        }
      });
    } 
  })


}

;