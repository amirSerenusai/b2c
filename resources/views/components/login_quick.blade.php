
<div  class="quick-login ">

{{--LOGIN QUICK--}}

    <div class="container" >
{{--        <h2>Vertical (basic) form</h2>--}}
        <form action="/action_page.php">
{{--            <div class="form-group">--}}
{{--                <label for="email">Email:</label>--}}
{{--                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">--}}
{{--            </div>--}}
            <div class="form-group">
{{--                <label  for="pwd">Password:</label>--}}
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>

            {{--            <div class="checkbox">--}}
{{--                <label><input type="checkbox" name="remember"> Remember me</label>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-default">Submit</button>--}}
{{--            <a    href="{{route('combination.run', 99 )}}" class="template-btn mt-3 next-step">next step</a>--}}
        </form>
        <span id="info"></span>
        <a class="btn btn-link" id="forgotPwd" href="http://localhost/b2c/public/password/reset">
            Forgot Your Password?
        </a>
    </div>

</div>

