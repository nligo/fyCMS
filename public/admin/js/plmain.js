// JavaScript Document 
//删除左右两端的空格
function trim(str)
{ 
	return str.replace(/(^s*)|(s*$)/g, "");
}

//栏目管理弹出框加载
function program_management_edit(url){
	$('#program_management_edit').removeData();
	$('#program_management_edit').modal({remote:url,show:true,backdrop:'static'});
}

//删除弹出框加载
function program_management_del(){
	$('#program_management_del').modal({backdrop:'static'});
	
}



//删除弹出框加载
function role_management_edit(url){
	$('#editRole').removeData();
	$('#editRole').modal({remote:url,show:true,backdrop:'static'});
}

//删除弹出框加载
function role_management_del(){
	$('#delRole').removeData();
	$('#delRole').modal({backdrop:'static'});
}

//老师列表管理
//编辑弹出框加载
function userlist_edit(){
	$('#userlist_edit').removeData();
	$('#userlist_edit').modal({remote:'userlist_edit_pop.html',show:true,backdrop:'static'});
}
//编辑弹出框加载
function userlist_setting(url){
	$('#userlist_setting').removeData();
	$('#userlist_setting').modal({remote:url,backdrop:false,show:true});
}
//删除弹出框加载
function userlist_del(){
	$('#userlist_del').removeData();
	$('#userlist_del').modal({remote:'userlist_del_pop.html',show:true,backdrop:'static'});
}

//上传头像弹出框
function jquery_Jcrop(url){
	$('#jquery_Jcrop').removeData();
	$('#jquery_Jcrop').modal({remote:url,show:true,backdrop:'static'});
}

//花量弹出框加载
function flower_management_edit(url){
	$('#editFlower').removeData();
	$('#editFlower').modal({remote:url,show:true,backdrop:'static'});
}


function changtabajax(type,url,id,showclass)
{
	$('li').removeClass("active");
	$(type).parent().addClass("active");
	
	$.get(url, function(data) {
		$('#'+id).html(data);
	});

	$('.'+showclass).hide();
	$('#'+id).show();
    return false;
}

function classlist_edit(url){
	$('#classlist_edit').removeData();
	$('#classlist_edit').modal({remote:url,show:true,backdrop:'static'});
}

function studentlist_edit(url){
	$('#studentlist_edit').removeData();
	$('#studentlist_edit').modal({remote:url,show:true,backdrop:'static'});
}

//家长关联弹出框加载
function studentparents_relation(url){
	$('#studentparents_relation').removeData();
	$('#studentparents_relation').modal({remote:url,show:true,backdrop:'static'});
}

function editrelation(url){
	$('#studentparents_editrelation').removeData();
	$('#studentparents_editrelation').modal({remote:url,show:true,backdrop:'static'});
}

//课程弹出框加载
function course_management_edit(url){
	$('#course_add').removeData();
	$('#course_add').modal({remote:url,show:true,backdrop:'static'});
}

//校园锦集弹出框加载
function highlights_management_edit(url){
	$('#highlights_add').removeData();
	$('#highlights_add').modal({remote:url,show:true,backdrop:'static'});
}

//专家回答问题
function experts_management_edit(url){
	$('#experts_message').removeData();
	$('#experts_message').modal({remote:url,show:true,backdrop:'static'});
}

//通知通知弹出框加载
function notice_management_edit(url)
{
	$('#notice_management_edit').removeData();
	$('#notice_management_edit').modal({remote:url,show:true,backdrop:'static'});
}

//通知转园弹出框
function studentlistzy(url){
	$('#studentlist_zy').removeData();
	$('#studentlist_zy').modal({remote:url,show:true,backdrop:'static'});
}

function sqzyMain(url){
	$('#sqzy_btn').removeData();
	$('#sqzy_btn').modal({remote:url,show:true,backdrop:'static'});
}

function orderinfoflower(url){
	$('#orderinfo').removeData();
	$('#orderinfo').modal({remote:url,show:true,backdrop:'static'});
}
//园长信箱1
function mailbox_management_edit(url){
	$('#mailbox_management_edit').removeData();
	$('#mailbox_management_edit').modal({remote:url,show:true,backdrop:'static'});
}

function viewflower_management_edit(url){
	$('#viewflower_management_edit').removeData();
	$('#viewflower_management_edit').modal({remote:url,show:true,backdrop:'static'});
}
