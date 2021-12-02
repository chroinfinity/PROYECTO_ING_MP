$(document).ready(function() {

    $('[name="checks[]"]').click(function() {
        
      var arr = $('[name="checks[]"]:checked').map(function(){
        return this.value;
      }).get();
      
      var str = arr.join(',');
      
      $('#arr').text(JSON.stringify(arr));
      
      $('#str').text(str);
    
    });
  
  });