function ini_restful(selector) {
	var obj = jQuery("<div />", {
		"class" : "canvas responsearea",
		"attr" : "restful",
		"style":"width:500px;display:block;background-color:#194919;padding:30px;color:white;"
	});
	var help = jQuery("<div />", {
		"class" : "helptext",
		"style":"width:500px;display:block;background-color:#868654;padding:30px;color:white;"
	});
	var text=jQuery("<input />",{
		"placeholder":"please put your url request here... ",
		//"val":"http://wsm.imusictech.com/get_taxonomy_posts?taxonomy=hkmtype_album&term=female-singer",
		"type":"text",
		"name":"restful_request",
		"size":"40",
		"style":"font-size:33px;width: 550px;margin-top:10px;"
	});
	var objbutton = "<a id='get_request' style='  background-color: #EFCCAC;    display: block;    font-size: 30px;    height: 40px;    line-height: 40px;    padding: 13px;    text-align: center;    width: 260px;'>restFUL API</a>";
	jQuery(selector).html(help);
	jQuery(obj).insertAfter(help);
	jQuery(text).insertAfter(obj);
	jQuery(objbutton).insertAfter(text);
	jQuery(".responsearea").html("this is the response area");
	jQuery(".helptext").html("Your request is starting with : http://wsm.imusictech.com/?json=<br> And adding your additional commands from the listed items under your admin panel > settings > JSON API. <br> Example: <strong>get_recent_posts</strong>&post_type=hkmtype_album&taxonomy=singa&term=female-singer");
	//alert("ini");
	// /http://wsm.imusictech.com/get_taxonomy_posts?taxonomy=hkmtype_album&term=female-singer
	jQuery("#get_request").bind("click",function(){
		console.log("start...");
		var url=jQuery("input[name='restful_request']").val();
		jQuery.ajax(url).done(function(jsonlocal) {
		var data = jsonlocal.posts;
		console.log("print result..");
		console.log(data);
		jQuery(".responsearea").html("This is the post data that has been successfully requested and printed on the following area. <br><pre>"+data+"</pre><br>Please right click and inspect the detail on your console.");
		});
	});
}
