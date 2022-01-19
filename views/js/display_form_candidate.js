
function display_form()
{
  if (document.getElementById('form-profil').style.display == 'none') {
       document.getElementById('form-profil').style.display = 'block';
       document.getElementById('profil').style.display = 'none';
    
       if(document.getElementById('form-profil'))
       {
        $.ajax({
            type:"POST", 	        
            url:"controllers/Candidates.php",  
            dataType: "json",
            data:"type=displayProfile",
            success:function(data){
                if (data.name != null) {
                    document.getElementsByName('name')[0].placeholder=data.name;
                    document.getElementsByName('name')[0].value = data.name;
                }
                if (data.lastname != null) {
                    document.getElementsByName('lastname')[0].placeholder=data.lastname;
                    document.getElementsByName('lastname')[0].value = data.lastname;
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