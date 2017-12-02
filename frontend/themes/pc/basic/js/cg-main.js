function readySend(){
	var vdata = checkvcode();
	var content = getEditHtml();
	
	console.log(content);
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

