@extends('layout')
@section("content")
<div style="min-height:1000px;width:1000px;margin-top:300px">
<div class="echo-div"></div></div>
<script src="{{asset("js/app.js")}}"></script>

@endsection


@section('script')

    <script>
function alertHi({data}){

  //  console.log($);
    let qTitle = data.qTitle ;
    let qID = data.qID ;
    let answers = data.answers ;
    var $newdiv1 = $( `<div id='object1'> ${qTitle}</div>` ) ;

        $(".echo-div").append('<div id="Qdiv'+qID+'">'+qID+'. ' +qTitle+'</div>');
    answers.forEach( a => {
        $(`#Qdiv${qID}`).append('<div style="color:blue"> ' + a +'</div>');

    });


 //$(".echo-div").append()
}
    </script>

@endsection
