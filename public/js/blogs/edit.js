var __webpack_exports__ = {};

  function addImage(tag) {
  var tag = $(tag);
  tag.parent('div').append('<input type="file" name="images[]" multiple class="form-control" accept="image/*">');
} //-------------------


function deleteImage(tag) {
  var tag = $(tag);
  var imageId = tag.attr('data-image');
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
        $('#imgs').append('<li><img data-blog="' + value['blog_id'] + '" id="' + value['id'] + '" src="' + value['path'] + '" alt=""><a class="float-left btn btn-danger" data-image="' + value['id'] + '" onclick="deleteImage(this)" class="exit-x">X</a></li>');
      });
    }
  });
}

;