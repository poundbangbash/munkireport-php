<?php

namespace munkireport\controller;

use MR\Kiss\Controller;
use MR\Kiss\View;
use munkireport\lib\Themes;

class Settings extends Controller
{
    public function __construct()
    {
        throw new \Exception("Deprecated by Laravel App\Http\Controllers\SettingsController");

        if (! $this->authorized()) {
            mr_view('json', array('msg' => 'Not authorized'));

            die();
        }
    }

    //===============================================================

    /**
     * Set
     *
     * Set/Get theme value in $_SESSION
     *
     */
    public function theme()
    {
        if(isset($_POST['set']))
        {
            // Check if valid theme
            $themeObj = new Themes();
            if(in_array($_POST['set'], $themeObj->get_list()))
            {
                sess_set('theme', $_POST['set']);
            }
            else
            {
                mr_view('json', array('msg' => sprintf('Error: theme %s unknown', $_POST['set'])));
            }
        }

        mr_view('json', array('msg' => sess_get('theme', conf('default_theme'))));
    }

}
