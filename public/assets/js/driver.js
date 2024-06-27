$(document).ready(function() {
    $("input#image_preview").on('change', function() {
		var viewId = $(this).attr('name');
        
        $('#'+viewId).html(""); // Clear existing preview (if any)

        var file = this.files[0]; // Get the single file from the input

        if (file) {
            if (file.size > 1048576) {
                alert('File size exceeds 1MB. Please choose a smaller file.');
                $(this).val(''); 
                return false;
            } else {
                // Display the image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#'+viewId).append("<div class='img-div'><img src='" + e.target.result +
                        "' class='img-responsive image' style='height:141px; width:150px' title='" + file.name +
                        "'><div class='middle'><button id='action-icon' class='btn btn-danger' role='" + viewId +
                        "'><i class='fa fa-trash'></i></button></div></div>");
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $('body').on('click', 'button#action-icon', function(e) {
        e.preventDefault();
        
        var viewId = $(this).attr('role');
        $('#'+viewId).html(""); // Clear the preview container
        $('[name="'+viewId+'"]').val(''); // Reset the file input
    });
});