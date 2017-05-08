<?php 

/**
 * user_sessions module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class User_sessions_controller extends Module_controller
{
	
	/*** Protect methods with auth! ****/
	function __construct()
	{
		// Store module path
		$this->module_path = dirname(__FILE__);
	}

	/**
	 * Default method
	 * @author tuxudo
	 *
	 **/
	function index()
	{
		echo "You've loaded the user_sessions module!";
	}
    
	/**
     * Retrieve data in json format
     *
     **/

     public function get_data($serial_number = '')
     {
        $out = array();
        if (! $this->authorized()) {
            $out['error'] = 'Not authorized';
        } else {
            $unique_users = new User_sessions_model;
            foreach ($unique_users->retrieve_records($serial) as $user) {
                $out[] = $user->rs;
            }
        }
        
        $obj = new View();
        $obj->view('json', array('msg' => $out));
     }


/*    public function get_unique_users()
    {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => array('error' => 'Not authenticated')));
            return;
        }
        
        $unique_users = new User_sessions_model;
        $obj->view('json', array('msg' => $unique_users->get_unique_users()));
    }
*/

		
} // END class User_sessionss_controller
