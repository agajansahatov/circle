form.text_field_anim("email_field", "Type here your Email address", "Example@mail.com");
document.getElementById("img_background").style.height = "60%";
document.getElementById("email_field").focus();
document.getElementById("btn_set_email").onclick = function(){
	form.button_anim("btn_set_email", 0);
}
