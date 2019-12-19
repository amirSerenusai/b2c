
{{--<button class="open-button" onclick="openForm()">Open Form</button>--}}



    {{--    <button class="template-btn mt-3 open-button" onclick="openForm()">Open Form</button>--}}
    <a    onclick="openForm()"   id="sp-open-a" style="
    bottom: 373px;margin: 0;padding: 0;
    right: 228px;"><button id="getDecision"  class="template-btn mt-3 c-pointer"  >
            <b style="color:white;font-size: 15px">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                Start process!</b>
        </button></a>


<div class="start-process">
<div class="sp-form-popup " id="myForm">
    <div   class="sp-form-container">
        <h1>Login</h1>

        <label for="email"><b>Email</b></label>
        <input id="email" type="text" placeholder="Enter Email" name="email" required>
           <h4 id='result'></h4>
{{--        <label for="psw"><b>Password</b></label>--}}
{{--        <input type="password" placeholder="Enter Password" name="psw" required>--}}
        @component('components.start-process-sendmail')@endcomponent
        <a><button id="getDecision"  class="template-btn mt-3   c-pointer" style="    width: 100%;padding:16px 20px !important;" >
        <b style="color:white;font-size: 15px">
        <i class="fa fa-envelope-o" aria-hidden="true"></i>
        Get a password link!</b>
        </button></a>





{{--        <button type="submit" class="btn template-btn">Send me a password link!</button>--}}
        <button type="button" class="btn cancel mt-1" onclick="closeForm()">Close</button>
    </div>
</div>
</div>
<script>
    function openForm() {
            console.log( document.getElementById("sp-open-a").style.display);
        document.getElementById("myForm").style.display = "block";
        document.getElementById("sp-open-a").style.display = "none";
    }

    function closeForm() {
        console.log( document.getElementById("sp-open-a").style.display);
        document.getElementById("myForm").style.display = "none";
        document.getElementById("sp-open-a").style.display = "inline";
    }
</script>
