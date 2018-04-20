function changeCrop(username)
{
    /*var img = new Image();
    img.src ='user/users/img/user/'+username+'/crop/img_001-cropped-center.jpg';*/

   var imgTarget = document.getElementById('cropImage');

   this.src='users/img/user/'+username+'/crop/img_001-cropped-center.jpg';
   this.height =150;

    return imgTarget;
}
changeCrop(Biche);