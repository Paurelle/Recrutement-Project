
function apply(email, id_announcement){
    $.ajax({
        type:"POST", 	        
        url:"controllers/Applied_candidates.php",  
        dataType: "json",
        data:{type: 'applyCandidate', email: email, id_announcement: id_announcement},
        success:function(){
            $('.apply-btn').hide();
            document.location.href="index.php"; 
        }
     })
    
}
