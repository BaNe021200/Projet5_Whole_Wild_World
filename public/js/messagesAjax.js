


function deleteMessage()
{
    const tableArchivedMessage = document.getElementById('tableArchivedMessage') ;
    const trArchivedMessage = document.getElementById('trArchivedMessage') ;
    const deleteButton = document.getElementById('deleteButton') ;

    deleteButton.addEventListener('click',function (e) {
        e.preventDefault();
        tableArchivedMessage.removeChild(trArchivedMessage);
    })




}


ajaxPost("templates/messages.html.twig",deleteMessage(),function (){
       console.log('le message à été détruit');
});