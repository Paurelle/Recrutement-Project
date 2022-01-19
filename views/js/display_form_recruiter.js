
function display_form()
{
  if (document.getElementById('form-profil').style.display == 'none') {
       document.getElementById('form-profil').style.display = 'block';
       document.getElementById('profil').style.display = 'none';
    
       if(document.getElementById('form-profil'))
       {
        $.ajax({
            type:"POST", 	        
            url:"controllers/Recruiters.php",  
            dataType: "json",
            data:"type=displayProfile",
            success:function(data){
                if (data.company_name != null) {
                    document.getElementsByName('company_name')[0].placeholder=data.company_name;
                    document.getElementsByName('company_name')[0].value = data.company_name;
                }
                if (data.company_address != null) {
                    document.getElementsByName('company_address')[0].placeholder=data.company_address;
                    document.getElementsByName('company_address')[0].value = data.company_address;
                }
                
                document.getElementsByName('email')[0].placeholder=data.email;
                document.getElementsByName('email')[0].value = data.email;
                
            }
         })
       }
       else
       {
        $('#res').html("Entrez le nom de l'utilisateur");
       }

  }
  else {
       document.getElementById('form-profil').style.display = 'none';
       document.getElementById('profil').style.display = 'block';
  }
}