$("body").on("click", "li[class='t']", function (){
	$(this).siblings().removeClass("hover");
	$(this).addClass("hover");
	$("div[class='loadmore']").css('display','none');
	$("div[class='loadmore']").children().eq(0).html(1);
	$('ul[id="msgM"]').empty();
	var type = $(this).index();
	if(type == 0){
	}
	if(type == 1){
		$("div[id='cg_loadmore']").css('display','block');
		loadCgMessageList(1);
	}
});

$("body").on("click", "#cg_loadmore", function (){
	var loadmore = this;
	var page = $(loadmore).children().eq(0).html();
	var nextpPage = parseInt(page)+1;
	
	if(loadCgMessageList(nextpPage)==''){
		alert('暂无数据');
	}else{
		$(loadmore).children().eq(0).html(nextpPage);
	}
	
});

function loadCgMessageList($page){
	$data = getMessagesList($page);
	console.log($data);
	var arr = $data;
	for(var n in arr){
		insertMessage(arr[n]['Id'],arr[n]['uid'],arr[n]['username'],arr[n]['content'],arr[n]['url']);
	}
	return $data;
}

function insertMessage($Id,$uid,$username,$content,$url){
	
	$message = '<li><a id="'+$Id+'" target="_blank" href="'+$url+'"><div class="header clear">'
	+'<div class="portrait"><img src="../user/h?id='+$uid+'" /></div>'
	+'<div class="username">'+$username+'</div>'
	+'</div>'
	+'<div class="content">'+$content+'</div>'
	+'</a></li>';
	$('ul[id="msgM"]').append($message);
}

function getMessagesList($page){
 var csrfToken = $('meta[name="csrf-token"]').attr("content");		
	var vdata = '';
	
	$.ajax({
	type: 'POST',
	url:'../api/message/message/gml' ,
	async:false, 
	data:{
		'_csrf-frontend':csrfToken,
		page:$page
		},
	success: function(data){
			  if(data.code == 'success'){
				  vdata = data.data;
				  
			  }
			},
	dataType: 'json'//返回数据的类型
	});
	
	return vdata; 
}


