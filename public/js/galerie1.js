function allowSubmit(){
    var form = document.forms['0'];
    var formField = form.getElementsByName('pic1');
    var buttonFormSubmit = document.getElementById('submitButton');
    if (!formField.value){
        buttonFormSubmit.disabled='true';
    }
    else{
        buttonFormSubmit.disabled='false';
    }

}
allowSubmit();

function ScanForEmpty()
    {
        var theForm=document.forms[0];
        var empty=false;
        switch(true){
            case (theForm.elements['pic1'].value.length==0) : empty=true;
                break;
            case (theForm.elements['pic2'].value.length==0) : empty=true;
                break;
            case (theForm.elements['pic3'].value.length==0) : empty=true;
                break;
            case (theForm.elements['pic4'].value.length==0) : empty=true;
                break;
            case (theForm.elements['pic5'].value.length==0) : empty=true;
                break;
            case (theForm.elements['pic6'].value.length==0) : empty=true;
                break;
        }
        document.forms[0].elements['submitButton'].disabled=empty;
    }

ScanForEmpty();