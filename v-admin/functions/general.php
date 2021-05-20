<?php
	/* ----------------------------------------------------
        Words Fixing function (using for URI)
     ----------------------------------------------------- */
    function fixForUri($string){
        $slug = trim($string); // trim the string
        $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
        $slug= str_replace(' ','-', $slug); // replace spaces by dashes
        $slug= strtolower($slug);  // make it lowercase
        return $slug;
    }

    
    
    /* ----------------------------------------------------
        add class 'show' to the current opened element 
     ----------------------------------------------------- */
    function activeMenu(){
        
        global $currentPage;   // $currentPage = basename($_SERVER['PHP_SELF']);
        
        
        $numargs = @func_num_args(activeMenu);   // number of arguments of this function..
              
        $elements = array();

        for($i=0; $i<=$numargs; $i++ )
        {
            //echo func_get_arg($i) . " ";
            
            $elements[$i] = @func_get_arg($i);   // we insert the arguments on this array '$elements'
        }
    	
        
        if(in_array($currentPage, $elements))       // if the current page (ex. test.php) exist in array '$elements'
        {
            echo 'show';    // we add this class
        }
        
    }
    

 
    
  
    /* ----------------------------------------------------
        Get the base url
     ----------------------------------------------------- */
    
     /**
    * Suppose, you are browsing in your localhost 
    * http://localhost/myproject/index.php?id=8
    */
    function getBaseUrl() 
    {
       // output: /myproject/index.php
       $currentPath = $_SERVER['PHP_SELF']; 
       
       // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
       $pathInfo = pathinfo($currentPath); 
       
       // output: localhost
       $hostName = $_SERVER['HTTP_HOST']; 
       
       // output: http://
       $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
       
       // return: http://localhost/myproject/
       return $protocol.$hostName.$pathInfo['dirname']."/";
   }   

   
   /* ----------------------------------------------------
        Check module status Enabled / Disabled
     ----------------------------------------------------- */
    function checkModuleStatus($module)
    {
      if($module == 0)
			{
			//	header("Location: settings.php");
			}
    }
   
   
      /* ----------------------------------------------------
        Check User Role Admin / Super Admin
     ----------------------------------------------------- */
    function checkSuperAdmin()
    {
      if($_SESSION['u_role'] !== 'sup-admin')
			{
				header("Location: settings.php");
			}
    }
   
?>