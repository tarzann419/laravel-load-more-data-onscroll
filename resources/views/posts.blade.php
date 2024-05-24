<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Load More Data on Button Click using JQuery Laravel - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <div class="container mt-5" style="max-width: 750px">
        <h1>Load More Data on Button Click using JQuery Laravel 11 - ItSolutionStuff.com</h1>
        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Search...">
        </div>

        <div id="data-wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>
                    @include('partials.data')
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <button class="btn btn-success load-more-data"><i class="fa fa-refresh"></i> Load More Data...</button>
        </div>

        <!-- Data Loader -->
        <div class="auto-load text-center" style="display: none;">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var ENDPOINT = "{{ route('posts.index') }}";
        var page = 1;

        // Function to load more data
        function infinteLoadMore(page, query = '') {
            $.ajax({
                    url: ENDPOINT + "?page=" + page + "&query=" + query,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                    }
                })
                .done(function(response) {
                    if (response.html == '') {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }

                    $('.auto-load').hide();
                    $("#data-wrapper tbody").append(response.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occurred');
                });
        }

        // Detect scroll event
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                page++;
                var query = $('#search').val();
                infinteLoadMore(page, query);
            }
        });

        // Detect search input event
        $('#search').on('keyup', function() {
            var query = $(this).val();
            page = 1; // Reset to the first page
            $("#data-wrapper tbody").html(''); // Clear the table
            infinteLoadMore(page, query); // Load data with query
        });

        
    </script>


</body>

</html>