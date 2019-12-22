!function(t){var e={};function r(n){if(e[n])return e[n].exports;var o=e[n]={i:n,l:!1,exports:{}};return t[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=t,r.c=e,r.d=function(t,e,n){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)r.d(n,o,function(e){return t[e]}.bind(null,o));return n},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="/",r(r.s=45)}({0:function(t,e,r){t.exports=r(4)},2:function(t,e,r){"use strict";r.r(e),r.d(e,"validateEmailDB",(function(){return l})),r.d(e,"connectUser",(function(){return h})),r.d(e,"sendPwdLink",(function(){return v}));var n=r(0),o=r.n(n);function a(t,e,r,n,o,a,i){try{var c=t[a](i),s=c.value}catch(t){return void r(t)}c.done?e(s):Promise.resolve(s).then(n,o)}function i(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var i=t.apply(e,r);function c(t){a(i,n,o,c,s,"next",t)}function s(t){a(i,n,o,c,s,"throw",t)}c(void 0)}))}}var c,s=!1,u=null;function l(t){return f.apply(this,arguments)}function f(){return(f=i(o.a.mark((function t(e){var r;return o.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e||(e=$("#email").val()),t.prev=1,t.next=4,axios.post("/validate-email",{email:e});case 4:return t.sent,$("#info").text(""),$("#forgotPwd").hide().delay(300).show(),t.abrupt("return",!0);case 10:return t.prev=10,t.t0=t.catch(1),r=t.t0.response.data.errors.email,r=_.head(r),$("#forgotPwd").hide(),console.log(r),"new-user"===r&&(s=!0,$("#info").text("Hello new user , type a password of 8 chars "),$("#pwd").attr("placeholder","Type a password"),c=$("#pwd").val(),$("#pwd").attr("placeholder")),t.abrupt("return",!1);case 18:case"end":return t.stop()}}),t,null,[[1,10]])})))).apply(this,arguments)}function h(){s?p().then($(".carousel-item").delay(500).animate({height:700},600)):d().then($(".carousel-item").delay(500).animate({height:700},600))}var p=function(){var t=i(o.a.mark((function t(){var e;return o.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(u&&c){t.next=2;break}return t.abrupt("return",console.log("no email to send or password"));case 2:return e=u.substr(0,u.indexOf("@")),t.next=5,axios.post("/register",{email:u,name:e,password:c});case 5:case"end":return t.stop()}}),t)})));return function(){return t.apply(this,arguments)}}(),d=function(){var t=i(o.a.mark((function t(){var e;return o.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return c=$("#pwd").val(),t.next=3,axios.post("/login",{email:u,name:name,password:c});case 3:e=t.sent,console.log({userDetails:e});case 5:case"end":return t.stop()}}),t)})));return function(){return t.apply(this,arguments)}}(),v=function(){var t=i(o.a.mark((function t(e){var r,n,a;return o.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=$(".flip-card-inner"),n=$(".flip-card"),u=$("#email").val(),r.removeClass("link-sent"),t.next=6,n.fadeIn(1e3);case 6:return console.log(u),t.next=9,axios.post("/pwd-link?registered=".concat(e),{email:u});case 9:200===(a=t.sent).status&&(r.addClass("link-sent"),setTimeout((function(){n.fadeOut(1e3)}),1e3)),console.log({userDetails:a});case 12:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}()},4:function(t,e,r){var n=function(t){"use strict";var e,r=Object.prototype,n=r.hasOwnProperty,o="function"==typeof Symbol?Symbol:{},a=o.iterator||"@@iterator",i=o.asyncIterator||"@@asyncIterator",c=o.toStringTag||"@@toStringTag";function s(t,e,r,n){var o=e&&e.prototype instanceof v?e:v,a=Object.create(o.prototype),i=new P(n||[]);return a._invoke=function(t,e,r){var n=l;return function(o,a){if(n===h)throw new Error("Generator is already running");if(n===p){if("throw"===o)throw a;return j()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=L(i,r);if(c){if(c===d)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===l)throw n=p,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=h;var s=u(t,e,r);if("normal"===s.type){if(n=r.done?p:f,s.arg===d)continue;return{value:s.arg,done:r.done}}"throw"===s.type&&(n=p,r.method="throw",r.arg=s.arg)}}}(t,r,i),a}function u(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=s;var l="suspendedStart",f="suspendedYield",h="executing",p="completed",d={};function v(){}function m(){}function y(){}var g={};g[a]=function(){return this};var w=Object.getPrototypeOf,x=w&&w(w(_([])));x&&x!==r&&n.call(x,a)&&(g=x);var b=y.prototype=v.prototype=Object.create(g);function k(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function $(t){var e;this._invoke=function(r,o){function a(){return new Promise((function(e,a){!function e(r,o,a,i){var c=u(t[r],t,o);if("throw"!==c.type){var s=c.arg,l=s.value;return l&&"object"==typeof l&&n.call(l,"__await")?Promise.resolve(l.__await).then((function(t){e("next",t,a,i)}),(function(t){e("throw",t,a,i)})):Promise.resolve(l).then((function(t){s.value=t,a(s)}),(function(t){return e("throw",t,a,i)}))}i(c.arg)}(r,o,e,a)}))}return e=e?e.then(a,a):a()}}function L(t,r){var n=t.iterator[r.method];if(n===e){if(r.delegate=null,"throw"===r.method){if(t.iterator.return&&(r.method="return",r.arg=e,L(t,r),"throw"===r.method))return d;r.method="throw",r.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var o=u(n,t.iterator,r.arg);if("throw"===o.type)return r.method="throw",r.arg=o.arg,r.delegate=null,d;var a=o.arg;return a?a.done?(r[t.resultName]=a.value,r.next=t.nextLoc,"return"!==r.method&&(r.method="next",r.arg=e),r.delegate=null,d):a:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,d)}function E(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function O(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function P(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(E,this),this.reset(!0)}function _(t){if(t){var r=t[a];if(r)return r.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,i=function r(){for(;++o<t.length;)if(n.call(t,o))return r.value=t[o],r.done=!1,r;return r.value=e,r.done=!0,r};return i.next=i}}return{next:j}}function j(){return{value:e,done:!0}}return m.prototype=b.constructor=y,y.constructor=m,y[c]=m.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,y):(t.__proto__=y,c in t||(t[c]="GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},k($.prototype),$.prototype[i]=function(){return this},t.AsyncIterator=$,t.async=function(e,r,n,o){var a=new $(s(e,r,n,o));return t.isGeneratorFunction(r)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},k(b),b[c]="Generator",b[a]=function(){return this},b.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=_,P.prototype={constructor:P,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(O),!t)for(var r in this)"t"===r.charAt(0)&&n.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var r=this;function o(n,o){return c.type="throw",c.arg=t,r.next=n,o&&(r.method="next",r.arg=e),!!o}for(var a=this.tryEntries.length-1;a>=0;--a){var i=this.tryEntries[a],c=i.completion;if("root"===i.tryLoc)return o("end");if(i.tryLoc<=this.prev){var s=n.call(i,"catchLoc"),u=n.call(i,"finallyLoc");if(s&&u){if(this.prev<i.catchLoc)return o(i.catchLoc,!0);if(this.prev<i.finallyLoc)return o(i.finallyLoc)}else if(s){if(this.prev<i.catchLoc)return o(i.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return o(i.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var o=this.tryEntries[r];if(o.tryLoc<=this.prev&&n.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,d):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),O(r),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;O(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,r,n){return this.delegate={iterator:_(t),resultName:r,nextLoc:n},"next"===this.method&&(this.arg=e),d}},t}(t.exports);try{regeneratorRuntime=n}catch(t){Function("r","regeneratorRuntime = r")(n)}},45:function(t,e,r){t.exports=r(46)},46:function(t,e,r){"use strict";r.r(e);var n,o,a=r(0),i=r.n(a),c=r(2);function s(t,e,r,n,o,a,i){try{var c=t[a](i),s=c.value}catch(t){return void r(t)}c.done?e(s):Promise.resolve(s).then(n,o)}function u(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var a=t.apply(e,r);function i(t){s(a,n,o,i,c,"next",t)}function c(t){s(a,n,o,i,c,"throw",t)}i(void 0)}))}}function l(t){t||(t=$("#email").val()),console.log({email:t});return/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(t)}var f=$("#email");function h(){!function(t){console.log("%c "+t,"background: white; color: green; display: block;")}("inside validate"),n=$("#result");var t=$("#email").val();if(n.text(""),t.length<1)throw o&&(n.text("Email is empty :("),n.css({color:"red"})),"EMAIL IS EMPTY";return l(t)?(n.text(t+" is valid :)"),n.css("color","green"),$(".next-step").prop("disabled",!1).css({cursor:"pointer"}),!0):($(".next-step").prop("disabled",!0).css({cursor:"not-allowed"}),n.text(t+" is not valid :("),n.css("color","red"),!1)}function p(t){if(t){var e=$("#loginUser");e.hasClass("shake")||(e.addClass("animated shake"),setTimeout((function(){e.removeClass("animated shake")}),2e3))}}$("#validate").on("click",h),f.hover(h,h),$(".next-step").on("click",u(i.a.mark((function t(){var e,r;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if($(this).hasClass("step2")&&Object(c.connectUser)(),e=$("#email").val(),r=$("#result"),e){t.next=5;break}return t.abrupt("return",r.text("Please enter a valid email"));case 5:return t.next=7,h();case 7:$(".carousel-control-next")[0].click(),$(this).removeClass("step".concat(cItem)),$(".progressbar  li.c".concat(cItem)).removeClass("shadow"),cItem=3===cItem?1:cItem+1,$(this).addClass("step".concat(cItem)),$(".progressbar  li.c".concat(cItem)).addClass("active shadow");case 13:case"end":return t.stop()}}),t,this)})))),$(".start-process").on("click","#getDecision",u(i.a.mark((function t(){var e;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return o=!0,t.next=3,h();case 3:if(t.sent){t.next=8;break}return t.abrupt("return",console.log("not Valid . stop."));case 8:return t.next=10,Object(c.validateEmailDB)();case 10:return e=t.sent,console.log({userExists:e}),t.next=14,Object(c.sendPwdLink)(e);case 14:case"end":return t.stop()}}),t)})))),$(".welcome-text").on("click","#pwdLink",u(i.a.mark((function t(){var e;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,l();case 2:if(e=t.sent,console.log(e),e){t.next=6;break}return t.abrupt("return",n.text("email is not valid"));case 6:Object(c.validateEmailDB)().then((function(t){p(t),n.text(t?"User exists in system":"sending mail.....")}));case 7:case"end":return t.stop()}}),t)}))))}});