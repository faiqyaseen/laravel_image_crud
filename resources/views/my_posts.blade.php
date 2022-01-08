@extends('layouts.app')
@section('css-section')
    <style>
        .post_img {
            border-radius: 0 5% 0 5% ;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center" id="postData">
        @include('post_data')
    </div>
</div>
<div class="ajax-load text-center">
    <p><img height="50" width="50" src="{{ asset('images/loader.gif') }}" alt="Loader Gif"> Loading..</p>
</div>
@endsection
@section('script-section')
    <script>
        function loadMoreData(page) {
            $.ajax({
                url: '?page=' + page,
                type: 'GET',
                beforeSend: function() {
                    $(".ajax-load").show();
                }
            })
            .done(function(data) {
                if(data.html == '') {
                    $(".ajax-load").html(`No more records found.`);
                    return;
                }
                $(".ajax-loader").hide();
                $("#postData").append(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError){
                alert("server not responding")
            })
        }

        var page = 1;
        $(window).scroll(function(){
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page ++;
                loadMoreData(page);
            }
        })

        function readMore(description, id) {
            var short_desc = $("#post-"+id).html();

            $("#post-"+id).html(description);
            $("#btn-"+id).removeClass('btn-success').addClass('btn-secondary').html('Read less').attr('onclick', `readLess('${description}', '${short_desc}', ${id})`);
        }

        function readLess(description ,short_description, id) {
            $("#post-"+id).html(short_description);
            $("#btn-"+id).removeClass('btn-secondary').addClass('btn-success').html('Read More').attr('onclick', `readMore('${description}', ${id})`);
        }
    </script>
@endsection
