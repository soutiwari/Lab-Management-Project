 function validateForm()
{
  var firstname=document.myform.firstname.value;
  var lastname=document.myform.lastname.value;
  var username=document.myform.username.value;
  var email=document.myform.email.value;
  var atposition=email.indexOf("@");  
  var dotposition=email.lastIndexOf("."); 
  var password=document.myform.password.value;  
  var password2=document.myform.password2.value;
   var letters = /^[A-Za-z]+$/; 
   var lettersalpha = /^[0-9a-zA-Z]+$/; 
  if(firstname==null || firstname=="",lastname==null ||lastname=="",username==null || username=="",email==null || email=="",password==null || password=="",password2==null || password2=="")
    {
    alert("Please fill all field");
    return false;
    }
 if(/^[A-Za-z\s]+$/.test(firstname)==0)
    {
      alert('Firstname must have alphabet characters only');
      return false;  
    }
  else if(/^[A-Za-z\s]+$/.test(lastname)==0)
    {
      alert('Lastname must have alphabet characters only');
      return false;  
    }
    else if(/^[0-9a-zA-Z]+$/.test(username)==0)
    {
      alert('Username must have alphanumeric characters only');
      return false; 
    }
  else if (atposition<1 || dotposition<atposition+2 || dotposition+2>=email.length){  
      alert("Please enter a valid e-mail address");  
      return false;  
      }
  else if(password.length<6){  
      alert("Password must be at least 6 characters long.");  
      return false;  
      }
  else if(password2!=password){  
      alert("Both Password should be same!");  
      return false;  
      }
}
