//
//
//
// $(document).ready(function(){
//

//
//     // window.Echo.channel('adminserenus').listen('TestEvent', e => {
//     // console.log({ e });
//     // if((typeof alertHi === "function") ) alertHi(e);
// // });
//
// });
//
// $(document).ajaxError(function() {
//     //$( ".log" ).text( "Triggered ajaxError handler." );
//
// });

$(document).ready(function(){
  let $ =jQuery;
  let subscribeErr =$("#subscribe-error");
  let subscribeSuccess =$("#subscribe-success");

    if(subscribeErr.length || subscribeSuccess.length ) {
        let node = subscribeErr.length ? subscribeErr : subscribeSuccess ;

        console.log({node});
      var offset = node.offset();
      $('html, body').animate({
          scrollTop: offset.top,
          scrollLeft: offset.left
      }, 50);
  }



});
