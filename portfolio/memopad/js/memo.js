$(document).ready(function(){

    var memolist = {};

    //lolalstorageのタイトルと内容を配列に格納
    function getMemoList(){
        memolist ={};
        var lgt = localStorage.length;
        for(var i=0; i<lgt ; i++){
            var tmp = localStorage.key(i);
            memolist[tmp] = localStorage.getItem(tmp);
        }
    }
    
    //memolistのkey:titleをリストに表示するDOM operating

    function makeMemoList(){
            $('ul#sidelist').html('');
        for(key in memolist){
            $('ul#sidelist').append('<li>'+key+'</li>');
        }
    }

    //List内のイベント $().('click',function(){~});を使ってliに対して全て同じ関数を与える
    //Main画面に内容を表示する関数
    function listEvent(){
        $('ul#sidelist > li').on('click',function(){
        $('#titletext').val($(this).text());
        $('#text_area').val(memolist[$(this).text()]);
    })
}



    memoListMake();
    //Listのロードと表示を行う
function memoListMake(){
    getMemoList();
    makeMemoList();
    listEvent();
}




    //




  //1.Save クリックイベント
$("#save").on('click',function(){
    var txt = $('#text_area').val();
    var title = $('#titletext').val();
    $.when(localStorage.setItem(title,txt),
    alert("SAVED")
    ).done(function(){
        memoListMake()
    });
});



 //2.clear クリックイベント
$("#clear").on('click',function(){
    var title = $('#titletext').val();
    $.when(localStorage.removeItem(title),
    $("#text_area").val(""),
    $("#titletext").val("")
//    ,alert("CLEARED")
          ).done(function(){
    memoListMake();
    });
});



 //3.ページ読み込み：保存データ取得表示

//if(localStorage.getItem("memo")){
//    var value = localStorage.getItem("memo");
//    $("#text_area").val(value);
//}


 //ロード時に表示
 //※こんなこともできる例
$("main").slideDown(1000);
    
$('#cartain').on('click',function(){
    $('#sidebar').animate({width:"toggle"},500,"swing",function(){
        if($('div#sidebar').css("display") === "none"){
        $('div#cartain > span').html("<<");
        $('#wrapper').css({
            width:"100%"
        });
        }else{
        $('div#cartain > span').html(">>");
        $('#wrapper').css({
            width:"70%",
            left:"0"
        });
        }
    });
});
});
