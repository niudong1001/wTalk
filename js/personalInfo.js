var personalInfo=idInitial("personalInfo");
var passwordChange=idInitial("passwordChange");
personalInfo.onclick=function()
{
	personalInfo.style.backgroundColor="white";
	passwordChange.style.backgroundColor="#F0F0F0";
	passwordChange.style.border="none";
}
passwordChange.onclick=function()
{
	passwordChange.style.backgroundColor="white";
	personalInfo.style.backgroundColor="#F0F0F0";
	personalInfo.style.border="none";
}