function validate()
{
    var id=document.myform.email.value;
    var atpos=id.indexOf("@");
    var dotpos=id.lastIndexOf(".");
    if(atpos<1||dotpos-atpos<2)
    {
        alert("PLEASE PROVIDE VALID EMAIL");
        document.myform.email.focus();
        return false;
    }
    var pass=document.myform.password.value;
    if(pass=="")
    {
        alert("PLEASE PROVIDE VALID PASSWORD");
        document.myform.password.focus();
        return false;
    }
   return true;
}