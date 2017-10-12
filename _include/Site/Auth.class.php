<?php
/**
 * Site Authentication Class, used to authenticate system users.
 * This class is responsible for login and logout procedures.
 *
 * Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

/**
 * Site Authentication Class.
 *
 * @category   Framework
 * @package    PNP Tools
 * @subpackage SGS
 * @author     William Moffett <william.moffett@bigfishgames.com>
 * @copyright  2007-2011 Big Fish Games, Inc.
 * @license    http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
 * @version    Release: 1.0
 * @link       https://affiliates.bigfishgames.com/tools/sgs/
 */

class Site_Auth
{

    /**
     * @var array Athentication configuration properties
     */
    protected static $config = array();

    /**
     * Initialize configuration properties
     *
     * @return void
     */
    private static function _init()
    {
        self::$config['sgs_authenticate_key'] 
            = is_null(Configuration::get('sgs_authenticate_key')) ? 
            'sgscookie' : 
            Configuration::get('sgs_authenticate_key');

        self::$config['sgs_authenticate_method'] 
            = is_null(Configuration::get('sgs_authenticate_method')) ? 
            'session' : 
            Configuration::get('sgs_authenticate_method');

        if (is_null(Configuration::get('sgs_username'))) {
            trigger_error(
                'Could not load sgs_username from config.php',
                E_USER_ERROR
            );
        }

        self::$config['sgs_username'] = Configuration::get('sgs_username');

        if (is_null(Configuration::get('sgs_password'))) {
            trigger_error(
                'Could not load sgs_password from config.php',
                E_USER_ERROR
            );
        }

        self::$config['sgs_password'] = Configuration::get('sgs_password');
    
    }

    /**
     * authenticateUser
     * 
     * @param array $auth (username, password ,[bool $autologin = ''])
     * 
     * @return void
     */
    public static function authenticateUser($auth)
    {
        self::_init();
        $auth = array_map('trim', $auth);
        $auth = array_map('stripslashes', $auth);
        $authenticated 
            = self::_login(
                $auth['username'],
                $auth['password'],
                isset($auth['autologin']) ? $auth['autologin'] : ''
            );
        /**
         * define('ERROR_MESSAGE_LOGIN', 
         * Site_Language::display('auth_doLogin_error_empty'));
         */
        if (!$authenticated) {
            define(
                'ERROR_MESSAGE_LOGIN',
                Site_Language::display('auth_doLogin_error_invalid')
            );
        } else {
            $location = SGS_SELF.(SGS_QUERY !='' ? '?'.SGS_QUERY : '');
            header("Location: {$location}");
            exit;
        }
    }

    /**
     * checkUserAuthentication
     * used to check and set the current users authentication state,
     * called by site loader by way of event register, method autorun
     * 
     * @return bool Authenticated
     */
    public static function checkUserAuthentication()
    {
        self::_init();

        if (!self::_trackingValuesAreNotSet()) { //we have tracking valuse
            
            list($username, $password)= self::_getTrackingValues();
        
            $validUserName = ($username == self::$config['sgs_username']);
            $validPassWord = ($password == self::$config['sgs_password']);
    
            if ($validUserName && $validPassWord) {
                define('SGS_ADMIN', true);
                define('SGS_USER', false);
                define('SGS_USERNAME', $username);
                return true;
            }
        }

        
        define('SGS_ADMIN', false);
        define('SGS_USER', false);
        define('SGS_USERNAME', false);
        
        return false;                
    }
    /**
     * Log the user out of the system and redirect them to the index page. 
     * Called by Site Event, method get logout.
     * 
     * @return void
     */
    public static function deauthenticateUser()
    {
        self::_init();
        
        if (self::$config['sgs_authenticate_method'] == 'cookie') {
            setcookie(
                self::$config['sgs_authenticate_key'],
                '',
                (time() - 2592000),
                '/'
            );
        }
        
        if (self::$config['sgs_authenticate_method'] == 'session') {
            $_SESSION[self::$config['sgs_authenticate_key']] = '';
            session_destroy();
        }
        
        header('location:'.SGS_BASE_URL.'index.php');
    
    }

    /**
     * loginForm
     * 
     * @return string html login form
     */
    public static function loginForm()
    {
        Site_Forms::start_form(
            'LoginForm',
            SGS_SELF.(SGS_QUERY !='' ? '?'.SGS_QUERY : '')
        );
        Site_Forms::add_plain_html('<div>');
        
        if (defined('ERROR_MESSAGE_LOGIN')) {
            Site_Forms::add_plain_html(
                '<p'.(
                    (defined('ERRORCLASS') && ERRORCLASS !='') ? 
                    ' class="'.ERRORCLASS.'"'
                    : 
                    'error'
                    ).'>'.ERROR_MESSAGE_LOGIN.'</p>'
            );
        }
        
        Site_Forms::add_input_data(
            'username',
            '',
            Site_Language::display('auth_login_form_username'),
            'textbox'
        );
        Site_Forms::add_private_data(
            'password',
            '',
            Site_Language::display('auth_login_form_password'),
            'textbox'
        );

        if (self::$config['sgs_authenticate_method'] != 'session') {
            Site_Forms::add_check_box(
                'autologin',
                array('1'),
                '',
                Site_Language::display('auth_login_form_autologin'),
                ''
            );
            Site_Forms::add_plain_html('<br />');
        }

        Site_Forms::add_hidden_data('login', 'login');
        Site_Forms::add_button(
            'loginsubmit',
            Site_Language::display('auth_login_form_submit'),
            'submit',
            'button'
        );
        Site_Forms::add_plain_html('</div>');

        return  Site_Forms::return_form();
    }

    /**
     * _login
     * 
     * @param string $username  username
     * @param string $password  password
     * @param bool   $autologin autologin
     * 
     * @return bool
     */
    private static function _login($username, $password, $autologin='')
    {
        self::_init();

        if ($username == '' || $password == '') {
            return false;
        }    

        $cookieval = $username.'.'.md5($password);
        $days = ($autologin == 1) ? 30 : 1;
        $user = ($username ==  self::$config['sgs_username']);
        $pass = (md5($password) == self::$config['sgs_password']);
        
        if ($user && $pass) {
            
            if (self::$config['sgs_authenticate_method'] == 'cookie') {
                setcookie(
                    self::$config['sgs_authenticate_key'], 
                    $cookieval, 
                    (time() + 3600 * 24 * $days),
                    '/'
                );
                
                return true;               
            }
            
            if (self::$config['sgs_authenticate_method'] == 'session') {
                
                $_SESSION[self::$config['sgs_authenticate_key']] = $cookieval;
                
                return true;
            } 
        }

        return false;				
    }
    
    /**
     * Get user tracking values from cookie or session if they exist
     * 
     * @return string
     */
    private static function _getTrackingValues()
    {
       
        if (self::$config['sgs_authenticate_method'] == 'cookie') {
            return  explode('.', $_COOKIE[self::$config['sgs_authenticate_key']]);
        }
        
        if (self::$config['sgs_authenticate_method'] =='session') {
            return explode('.', $_SESSION[self::$config['sgs_authenticate_key']]);
        }
        
        return null;
    }

    /**
     * test user tracking values.
     * 
     * @return bool true if values are not present.
     */
    private static function _trackingValuesAreNotSet()
    {
        
        if (self::$config['sgs_authenticate_method'] == 'cookie') {
            return !isset($_COOKIE[self::$config['sgs_authenticate_key']]);
        }
        
        if (self::$config['sgs_authenticate_method'] =='session') {
            return !isset($_SESSION[self::$config['sgs_authenticate_key']]);
        }
                
        return true;
        
    }
    
    
}
?>