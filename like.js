function like_add(Foodname)
{
    $.post('ajax/like_add.php', {Foodname:Foodname}, function(data) {
      if(data == 'success')
      {
          //success
          like_get(Foodname);
      }
      else
      {
          alert(data);
      }
        
        
    });
    
}

function like_get(Foodname)
{
    $.post('ajax/like_get.php', {Foodname:Foodname}, function(data) {
        $('#Food_'+Foodname+'_likes').text(data);
    });
    
}
