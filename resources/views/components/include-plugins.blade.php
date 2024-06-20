@isset($dataTable)
    @section('head')
        <link rel="stylesheet" href="{{ asset('assets/css/datatables.bootstrap4.min.css') }}">
    @endsection

    @section('script')
        <script src="{{ asset('assets/js/jquery.datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.responsive.min.js') }}"></script>
    @endsection
@endisset
@isset($imagePreview)
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) {
                return;
            }
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('image_preview');
                const img = new Image();
                img.src = event.target.result;
                img.onload = function() {
                    preview.innerHTML = '';
                    preview.appendChild(img);
                };
            };
            reader.readAsDataURL(file);
        });
    </script>
@endisset

@isset($multipleImage)
<script>
    var fileArr = [];
        $("#images").change(function() {
            if (fileArr.length > 0) fileArr = [];
            $('#image_preview_new').html("");
            var total_file = document.getElementById("images").files;

            if (!total_file.length) return;
            for (var i = 0; i < total_file.length; i++) {
                if (total_file[i].size > 1048576) {
                    return false;
                } else {
                    fileArr.push(total_file[i]);
                    $('#image_preview_new').append("<div class='img-div' id='img-div" + i + "'><img src='" + URL
                        .createObjectURL(event.target.files[i]) +
                        "' class='img-responsive image' style='height:141px; width:150px' title='" + total_file[
                            i].name + "'><div class='middle'><button id='action-icon' value='img-div" + i +
                        "' class='btn btn-danger' role='" + total_file[i].name +
                        "'><i class='fa fa-trash'></i></button></div></div>");
                }
            }
        });

        $('body').on('click', '#action-icon', function(evt) {
            var divName = this.value;
            var fileName = $(this).attr('role');
            $(`#${divName}`).remove();
            for (var i = 0; i < fileArr.length; i++) {
                if (fileArr[i].name === fileName) {
                    fileArr.splice(i, 1);
                }
            }
            document.getElementById('images').files = FileListItem(fileArr);
            evt.preventDefault();
        });

        function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
    </script>

@endisset