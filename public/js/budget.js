$(document).ready(function() {
    
    var host = $('#host').val();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
   $('form#filters').on('submit', function(e) {
        e.preventDefault();
   
        $.ajax({
           type:'POST',
           url: host + '/search_' + $('#search_type').val(),
           data: $('#filters').serialize(),
           success:function(data){
               $('#search-result').html(data);
           }
        });
  
    });

    $('#input-budget-type').on('change', function(){
        $('#input-budget-category').hide();
        $('#input-budget-categoryIncome').hide();
        $('#input-budget-categoryExpense').hide();
        
        var d = $(this).val();
        $('#input-budget-category'+d).removeAttr('disabled').show();
    }); 

} );