
function validate(row, role, id_user){

    switch (role) {
        case 'recruiter':
            validateRecruiter(row, id_user);
            break;
        case 'candidate':
            validateCandidate(row, id_user);
            break;
        default:
            break;
    }
}

function validateRecruiter(row, id_user) {
    $.ajax({
        type:"POST", 	        
        url:"controllers/Recruiters.php",  
        dataType: "json",
        data:{type: 'validateRecruiter', id_user: id_user},
        success:function(){
            document.getElementById(row).style.display = 'none';
        }
     })
}

function validateCandidate(row, id_user) {
    $.ajax({
        type:"POST", 	        
        url:"controllers/Candidates.php",  
        dataType: "json",
        data:{type: 'validateCandidate', id_user: id_user},
        success:function(){
            document.getElementById(row).style.display = 'none';
        }
     })
}

function refuse(row, role, id_user){
    switch (role) {
        case 'recruiter':
            refuseRecruiter(row, id_user);
            break;
        case 'candidate':
            refuseCandidate(row, id_user);
            break;
        default:
            break;
    }
}

function refuseRecruiter(row, id_user) {
    $.ajax({
        type:"POST", 	        
        url:"controllers/Recruiters.php",  
        dataType: "json",
        data:{type: 'refuseRecruiter', id_user: id_user},
        success:function(){
            document.getElementById(row).style.display = 'none';
        }
     })
}

function refuseCandidate(row, id_user) {
    $.ajax({
        type:"POST", 	        
        url:"controllers/Candidates.php",  
        dataType: "json",
        data:{type: 'refuseCandidate', id_user: id_user},
        success:function(){
            document.getElementById(row).style.display = 'none';
        }
     })
}
