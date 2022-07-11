@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Short Link</div>

                    <div class="card-body">
                        <form id="short_link">
                            {{--@csrf--}}
                            {{--@method('PUT')--}}
                            <div class="form-group row">
                                <label for="text" class="col-md-4 col-form-label text-md-right">Link</label>
                                <a class="col-md-6">
                                    <input id="link" type="text" class="form-control" name="link" value="" required autocomplete="URL" autofocus>
                                </a>
                                    <a id="btn" href="javascript:;" type="submit" class="btn btn-primary">
                                        Send
                                    </a>

                                <div id="danger">

                                </div>

                            </div>
                            {{--</div>--}}
                            <div id="shlink">

                            </div>

                        </form>
                    </div>
                    <div class="alert alert-success" id="success-alert">
                        <p>Success</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script  type="text/javascript">
    $(document).ready(function() {
        $("#success-alert").hide();
        $("#btn").click(function ValidAlert() {
            $('#shlink').empty();
            $('#danger').empty();
            var link = $('#link').val();
            var _token   = $('meta[name="csrf-token"]').attr('content');
            if (link.length < 1) {

                $('#danger').append('<span class="error" style="color:red">This field is required</span>');
            }else {
                var regEx = /(^https?:\/\/)?[a-z0-9~_\-\.]+\.[a-z]{2,9}(\/|:|\?[!-~]*)?$/i;
                var validLink = regEx.test(link);
                if (!validLink) {

                    $('#danger').append('<span class="error" style="color:red">Enter a valid Link</span>');
                } else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:"{{ url('/ajax') }}",
                        type:'POST',
                        dataType:'json',
                        data:{link:link,
                            _tonek:_token
                        },
                        success:function(result) {
                            $('#shlink').append('<a href="'+result.code+'" target="_blank">'+result.code+'</a>');
                            $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
                                $("#success-alert").slideUp(500);
                            });
                        }
                    });
                }
            }
        });
    });
</script>