<div class="enter-email ">
    <div class="container">
{{--        <h2>Vertical (basic) form</h2>--}}
        <form action="/action_page.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
            </div>
{{--            <a   class="template-btn mt-3 next-step2 ml-5" >next step2</a>--}}
        </form>
    </div>

</div>

{{--@section('enter-email-script')--}}

{{--    $(".next-step2").on('click', function () {--}}

{{--    $(".enter-email").addClass("animated fadeOutLeftBig d-inline-block overflow-hidden");--}}
{{--    $('html, body').css('overflowY', 'hidden');--}}
{{--    setTimeout(()=>{--}}
{{--    $(".enter-email").remove();--}}
{{--    $(".quick-login").show().addClass("d-inline-block  ").addClass("animated fadeInRightBig")  ; },500);--}}

{{--    })--}}

{{--@endsection--}}
