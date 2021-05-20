$(document).ready(function(){
        
        // CKEDITOR 
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );     


		// in case second editor in same page..
		ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } ); 
		 		
       
});

	   
	   
	   
 
  /*==================================================================
  Dependent dynamic dropdown list (countries->states->cities->districts)
  ===================================================================*/
    
    // country -> states
    $(document).ready(function(){
      
      $('#country').on('change',function(){
       
       var countryID = $(this).val(); 
        
        if(countryID)
        {
          $.get(
            "../ajax.php",
            {country: countryID},
            function(data){
              $('#state').html(data);
            }
          );
        }
        else
        {
          $('#state').html('<option>Select country first </option>');
        }
        });
    
    
    // State -> cities  
      $('#state').on('change',function(){
        
       var stateID = $(this).val(); 
        
        if(stateID)
        {
          $.get(
            "../ajax.php",
            {state: stateID},
            function(data){
              $('#city').html(data);
            }
          );
        }
        else
        {
          $('#city').html('<option>Select State first </option>');
        }
        });
    
    
    // City => districts
      $('#city').on('change',function(){
       
       var cityID = $(this).val(); 
        
        if(cityID)
        {
          $.get(
            "../ajax.php",
            {city: cityID},
            function(data){
              $('#district').html(data);
            }
          );
        }
        else
        {
          $('#district').html('<option>Select city first </option>');
        }
        });
      });
    
    
    
    
  /*==================================================================
  Dependent dynamic dropdown list (Category -> sub category)
  ===================================================================*/
    

    $(document).ready(function(){
    
    // City => districts
      $('#category').on('change',function(){
       
       var categoryID = $(this).val(); 
        
        if(categoryID)
        {
          $.get(
            "../ajax.php",
            {category: categoryID},
            function(data){
              $('#subcategory').html(data);
            }
          );
        }
        else
        {
          $('#subcategory').html('<option>Select city Category first </option>');
        }
        });
      });    


    
    
  /*==================================================================
  Dependent dynamic dropdown list (Category -> Ad Custom Fields)
  ===================================================================*/
    

    $(document).ready(function(){
    
    // category => custom fields
      $('.for-fields').on('change',function(){
       
       var fieldCategoryID = $(this).val(); 
        
        if(fieldCategoryID)
        {
          $.get(
            "../ajax.php",
            {fields_category: fieldCategoryID},
            function(data){
              $('#adfields').html(data);
            }
          );
        }
        else
        {
          $('#adfields').html('<option>Select Category first to show the related Custom fields </option>');
        }
        });
      });    

	  
	  
	  
		
	  /*==================================================================
		Script for showing/hiding the contact detail 
	  ===================================================================*/
		  
        function show1(){
          a = document.getElementById('collapseOne');
          b = document.getElementById('collapseTwo');
          
          a.style.display ='block';
          b.style.display ='none';
        }
        
        function show2(){
          a = document.getElementById('collapseOne');
          b = document.getElementById('collapseTwo');
          
          a.style.display ='none';
          b.style.display ='block';
        }
