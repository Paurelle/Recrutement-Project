
function validate(announcement, id_announcement){
    $.ajax({
        type:"POST", 	        
        url:"controllers/Announcements.php",  
        dataType: "json",
        data:{type: 'validateAnnouncement', id_announcement: id_announcement},
        success:function(){
            if (document.getElementById(announcement)) {
                document.getElementById(announcement).style.display = 'none';
                document.location.href="validateAnnouncement.php"; 
            }else{
                document.location.href="validateAnnouncement.php"; 
            }
        }
     })
}

function refuse(announcement, id_announcement){
    $.ajax({
        type:"POST", 	        
        url:"controllers/Announcements.php",  
        dataType: "json",
        data:{type: 'refuseAnnouncement', id_announcement: id_announcement},
        success:function(){
            if (document.getElementById(announcement)) {
                document.getElementById(announcement).style.display = 'none';
                document.location.href="validateAnnouncement.php"; 
            }else{
                document.location.href="validateAnnouncement.php"; 
            }
        }
     })
}