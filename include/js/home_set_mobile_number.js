form.text_field_anim("mobilenumber_field", "Type here your mobile number", "+99365123456");
document.getElementById("img_background").style.height = "65%";
document.getElementById("mobilenumber_field").focus();
document.getElementById("btn_set_mobile_number").onclick = function(){
	form.button_anim("btn_set_mobile_number", 0);
}
