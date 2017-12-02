function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}

$(document).ready(function(){ 
	var page = GetQueryString("f");
	if(page==null){return;}
	var floor = location.hash.substring(2);
	$("ul[id='reply_build_"+floor+"']").attr('page',page);
	$("a[id='reply_build_btn_"+floor+"']").click();
}); 

function getLocalTime(nS) {     
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");      
}  

$("body").on("click", ".reply_build_floor_input_btn", function (){
	var uid = document.getElementById('uid').value;
	var builddata = JSON.parse($(this).parent().prevAll(".reply_build").attr('data-field'));
	
	var reply_build_floor_input = '<div contenteditable="true" class="reply_build_floor_input">辣鸡游戏毁我青春。</div>'
	+'<input type="submit" value="回复" class="reply_build_floor_submit">'
	+'<input id="reply_receiveId" type="hidden" value="'+builddata['senduid']+'">'
	+'<div id="reply_receiveUn" class="reply_receive">'+builddata['sendun']+'</div>';
	if(uid==''){alert('请先登录呢');}else{$(this).parent().html(reply_build_floor_input);}
}); 	
	
$("body").on("click", "a[id^='reply_build_btn_']", function (){
	var reply_build_block = $(this).parent().next();
	var reply_build = $(reply_build_block).children("ul");
	var tid = $(this).attr('id').replace('reply_build_btn_',"");
	var rid = $(reply_build).attr('id').replace('reply_build_',"");
		
	if(reply_build_block.css('display')=='none'){
			$(this).attr('class','open');
			//setReplyBuildBlockStatus(this,1);
			
			$(reply_build_block).slideDown(150,function (){
				$("ul[id='reply_build_"+rid+"']").empty();
				var page = $("ul[id='reply_build_"+rid+"']").attr('page');
				loadReplyBuild(rid,1);
			});
		}else{
			$(this).attr('class','');
			$(reply_build_block).slideUp(150,function (){
			});
			//setReplyBuildBlockStatus(this,0);
	}
		
		
}); 

$("div[id^='thread_say_del_']").bind("click", function(){
	var rid = $(this).attr('id').replace('thread_say_del_',"");
	var csrfToken = $('meta[name="csrf-token"]').attr("content");
	var tid = document.getElementById("p").value;
	var reply_block = $(this).parent().parent();
	
	$.ajax({
	type: 'POST',
	url:'../api/forum/thread/dr',
	data:{
		'_csrf-frontend':csrfToken,
		tid:tid,
		rid:rid
		},
	success: function(data){
			console.log(data.code);
			  if(data.code == 'success'){
				 $(reply_block).slideUp(350,function (){
					$(reply_block).remove();
				});
			  }
			},
	dataType: 'json'//返回数据的类型
	});
	
	
}); 

$("body").on("click", ".reply_loadmore", function (){
	var reply_loadmore = this;
	var rid = $(reply_loadmore).prevAll(".reply_build").attr('id').replace('reply_build_',"");
	var page = $(reply_loadmore).children().eq(0).html();
	var nextpPage = parseInt(page)+1;
	
	if(loadReplyBuild(rid,nextpPage)==''){
		alert('暂无数据');
	}else{
		$(reply_loadmore).children().eq(0).html(nextpPage);
		$(reply_loadmore).prevAll(".reply_build").attr('page',nextpPage);
	}
	
});	
	 
$("body").on("click", ".reply_build_floor_submit", function (){
	var csrfToken = $('meta[name="csrf-token"]').attr("content");
	var rid = $(this).parent().prevAll(".reply_build").attr('id').replace('reply_build_',"");
	var replyContent = $(this).prevAll(".reply_build_floor_input").html();
	var replyUsername =$(this).siblings("#reply_receiveUn").html();
	var replyUid = $(this).siblings("#reply_receiveId").val();
	if(!replyContent || replyContent == '辣鸡游戏毁我青春。'){alert('请输入回复内容');return;}
	if(!replyUid){alert('未选定回复目标');return;}

	$.ajax({
	type: 'POST',
	url:'../api/forum/thread/irb',
	data:{
		'_csrf-frontend':csrfToken,
		rid:rid,
		post_content:replyContent,
		receive_uid:replyUid,
		receive_username:replyUsername
		},
	success: function(data){
			  if(data.code == 'success'){
				  refreshReplyBuild(rid);
			  }
			  if(data.code == 'lose'){
				  if(data.cause == 'vcode is missing'){
					  loadvcode();
				  }
			  }
			},
	dataType: 'json'//返回数据的类型
	});
});
	 
$("body").on("click", ".reply_floor_btn", function (){
	var rdata = JSON.parse($(this).parent().parent().attr('data-field').replace(/'/g, '"'));
	var reply_build_bottom = $(this).parent().parent().parent().next();
	
	changeReplyData(reply_build_bottom,rdata['senduid'],rdata['sendun']);
});

$("body").on("click", ".reply_floor_del", function (){
	var rdata = JSON.parse($(this).parent().parent().attr('data-field').replace(/'/g, '"'));
	delReplyFloor(rdata['rid'],rdata['rrid']);
});

function delReplyFloor($rid,$rrid){
	var csrfToken = $('meta[name="csrf-token"]').attr("content");
	
	$.ajax({
	type: 'POST',
	url:'../api/forum/thread/drf',
	data:{
		'_csrf-frontend':csrfToken,
		rid:$rid,
		rrid:$rrid
		},
	success: function(data){
			  if(data.code == 'success'){
				  refreshReplyBuild($rid);
			  }
			},
	dataType: 'json'//返回数据的类型
	});
}

function refreshReplyBuild($rid){
	$("ul[id='reply_build_"+$rid+"']").empty();
	var page = $("ul[id='reply_build_"+$rid+"']").attr('page');
	loadReplyBuild($rid,page);
}

function changeReplyData($obj,$uid,$un){
	var uid = $obj.children().eq(2).val($uid);
	var un = $obj.children().eq(3).html($un);
}

function loadReplyBuild($rid,$page){
	$data = getReplyBuildData($rid,$page);
	var arr = $data;
	for(var n in arr){
		insertReplyBuild($rid,arr[n]['Id'],arr[n]['post_content'],arr[n]['post_time'],arr[n]['send_uid'],arr[n]['send_username'],arr[n]['receive_uid'],arr[n]['receive_username']);
	}
	return $data;
}

function getReplyBuildData($rid,$page){
 	var csrfToken = $('meta[name="csrf-token"]').attr("content");		
	var vdata = '';
	
	$.ajax({
	type: 'POST',
	url:'../api/forum/thread/grb',
	async:false, 
	data:{
		'_csrf-frontend':csrfToken,
		rid:$rid,
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

function insertReplyBuild($rid,$rrid,$content,$time,$senduid,$senduser,$receiveuid,$receiveuser){
	$uid = document.getElementById('uid').value;
	if($uid == $senduid){ $del_btn =  '<a class="reply_floor_del">删除</a>';}else{$del_btn = '';}
	var rdata = {
		rid:$rid,
		rrid:$rrid,
		senduid:$senduid,
		sendun:$senduser
	}
	$floor = '<li id="'+$rrid+'" data-field="'+JSON.stringify(rdata).replace(/\"/g,"'")+'">'
	+'<div class="reply_floor_main"><div class="s">'+$senduser+'</div><div class="t">&gt;</div><div class="r">'+$receiveuser+'</div> : '+$content+'</div>'
	+'<div class="reply_floor_bottom clear">'
	+'<a class="reply_floor_time">'+getLocalTime($time)+'</a>'
	+'<a class="reply_floor_btn">回复</a>'
	+ $del_btn
	
	+'</div>'
	+'</li>';
	
	$("ul[id='reply_build_"+$rid+"']").append($floor);
}

function setReplyBuildBlockStatus(id,status){
	/* open replybuildblock */
	if(status==1){status='block';}else{status='none';}
	$(id).parent().next().css('display',status);
}


function readySend(){
	var vdata = checkvcode();
	var content = getEditHtml();
	
	if(content == 'Hi 快把你想说的告诉大家吧~'){
		alert('请输入帖子内容');
		return false;
	}
	
	if(vdata.code == 'success'){
		return true;
	}else{
		loadvcode();
		return false;
	}
}

document.getElementById("load_master_more").onclick = function(){
	this.parentNode.style.display = 'none';
	document.getElementById("master_thread_block").style.height = 'auto';
	document.getElementById("master_thread_block").style.overflow = 'visible';
}