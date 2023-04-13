$(document).ready(function() {
    $('#summernote').summernote({
        height: 200
    });
  });

  
$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        }
        else{
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });
    
   /* var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);
    $('#load-screen').delay(1000).fadeOut(1200, function(){
        $(this).remove();
    });
    */
});

//FUNCION PARA REFRESACAR USUARIOS ONLINE AUTOMATICAMENTE, NO LO EXPLICA PORQUE LO TIENE EN OTRO CURSO
function loadUsersOnLine(){
    $.get("functions.php?onlineusers=result",function(data){
        $(".usersonline").text(data);
    });
}
setInterval(function(){
    loadUsersOnLine();
},500);
