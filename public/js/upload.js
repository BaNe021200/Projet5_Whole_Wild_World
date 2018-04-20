function showHiddenForm(uploadId)
{
    var buttonId= document.getElementById('uploadButton'+uploadId);
    var hiddenForm = document.getElementById('uploadFormHidden'+uploadId);
    buttonId.addEventListener('click',function (e) {
        e.preventDefault();
        hiddenForm.style.display='block';

    });

}

showHiddenForm(1);
showHiddenForm(2);
showHiddenForm(3);
showHiddenForm(4);
showHiddenForm(5);
showHiddenForm(6);

function hideForm(uploadId)
{
    var buttonId= document.getElementById('hideButton'+uploadId);
    var hiddenForm = document.getElementById('uploadFormHidden'+uploadId);
    buttonId.addEventListener('click',function (e) {
        e.preventDefault();
        hiddenForm.style.display='none';

    });

}

hideForm(1);
hideForm(2);
hideForm(3);
hideForm(4);
hideForm(5);
hideForm(6);


function delayedModal(){
    var timeoutID;
    timeoutID = window.setTimeout(showModal(),2000);
}

function showModal() {
    $('#Success').modal('show');
}


function allowSubmit(){
    var form = document.forms['uploadFormHidden1'];
    var formField = form.getElementsByTagName('input').getElementsByTagName('file');
    var buttonFormSubmit = document.getElementById('submitButton');
     if (formField.value == ""){
        buttonFormSubmit.disabled='true';
     }
     else{
         buttonFormSubmit.disabled='false';
     }

}



allowSubmit();

/*setTimeout(function (e) {
            e.preventDefault();
            $('#Success').modal('show');
        }, 100)*/