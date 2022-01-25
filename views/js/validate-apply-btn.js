
function validate(row, id_candidate, id_announcement){
    console.log('ok');
    $.ajax({
        type:"POST", 	        
        url:"controllers/Applied_Candidates.php",  
        dataType: "json",
        data:{type: 'validateApply', id_candidate: id_candidate, id_announcement: id_announcement},
        success:function(){
            document.getElementById(row).style.display = 'none';
        }
     })
}


function refuse(row, id_candidate, id_announcement){
    $.ajax({
        type:"POST", 	        
        url:"controllers/Applied_Candidates.php",  
        dataType: "json",
        data:{type: 'refuseApply', id_candidate: id_candidate, id_announcement: id_announcement},
        success:function(){
            document.getElementById(row).style.display = 'none';
        }
     })
}
