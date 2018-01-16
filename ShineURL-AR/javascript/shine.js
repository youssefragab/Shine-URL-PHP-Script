$(function () {


// -->> BackEnd Functions

function checkConnection () {

// Set Request Key For Security
var key = "TrustedRequest";
// sent ajax request
$.ajax({
url:"php/config/CheckConnection.php",
type:"post",
data: {key: key},
success: function (data) {

   if (data == "failed") {
    window.location.href = "404.php";
  }

}
});

}


function getLatestLinks() {

var key = "TrustedRequest";

$.ajax({

url:"php/LatestShortedLinks.php",
type:"post",
data:{key: key},
success: function (data) {

  $(".latest-links").html(data);
  $(".latest-link-copy").click(function () {

    swal(
      '',
      'تم نسخ عنوان الرابط',
      'success'
    )

  });
}


});

new Clipboard('.latest-link-copy');
}

getLatestLinks();



function proccessURL(){
  // input value
  var url = $(".url").val();
  // responde varibles
  var returnedURL = null;
  var isError = null;
  var error = null;
 // security varible
 var key = "TrustedRequest";
  if(url == ""){
     emptyUrl();
  }else {
    swal({
      title: 'جاري اختصار رابطك',
      text: 'الرجاء الانتظار',
      timer: 1500,
      onOpen: () => {
        swal.showLoading()
        $.ajax({
        url:"php/ShortURL.php",
        type:"post",
        data: {url: url,key: key},
        success: function (data) {

          if(data == "NOT_VALID_URL") {
            isError = true;
            error = "عنوان الرابط غير صالح";
          }else {
            isError = false;
            returnedURL = data;
          }

        }
        });
      }
    }).then((result) => {
      if (result.dismiss === 'timer') {
          new Clipboard('.copy');
        if(isError == false) {
        $(".cp-con").html(returnedURL);
        swal({
        html: '<h2 class="shorted-url z-depth-2">' + returnedURL +'</h2> <div class="copy-container"><center><div class="copy z-depth-3" data-clipboard-target="#copylink"><img src="images/copy.png"> نسخ</div></center></div>      '

        })
        $(".copy").click(function() {


            swal(
              '',
              'تم نسخ عوان الرابط',
              'success'
            )

        });
        getLatestLinks();
      }else if(isError == true) {
           NotVaild(error);
      }

      }
    })
  }

}

checkConnection();




// Html Document Proccessing

function emptyUrl() {
  swal(
  '',
  'الرجاء ادخال رابط',
  'error'
)
}

function NotVaild(error) {
  swal(
  '',
  error,
  'error'
)
}


$("button").click(function () {


proccessURL();



});



$(".sub-link-container img").click(function () {

  swal(
    '',
    'تم نسخ الرابط',
    'success'
  )

});

if ($(window).width() < 768) {
  $("input").css("padding-top","7px");
  $("input").css("padding-bottm","7px");
  $("input").css("padding-right","0px");
  $("input").css("padding-left","10px");
}

});
