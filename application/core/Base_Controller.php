<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * InvoicePlane
 * 
 * A free and open source web based invoicing system
 *
 * @package		InvoicePlane
 * @author		Kovah (www.kovah.de)
 * @copyright	Copyright (c) 2012 - 2015 InvoicePlane.com
 * @license		https://invoiceplane.com/license.txt
 * @link		https://invoiceplane.com
 * 
 */

class Base_Controller extends MX_Controller
{

    public $ajax_controller = false;

    public function __construct()
    {
        parent::__construct();

        $this->config->load('invoice_plane');

        // Don't allow non-ajax requests to ajax controllers
        if ($this->ajax_controller and !$this->input->is_ajax_request()) {
            exit;
        }

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('trans');
        $this->load->helper('country');

        // Check if database has been configured
        if (!file_exists(APPPATH . 'config/database.php')) {

            $this->load->helper('redirect');
            redirect('/welcome');

        } else {
            if ( $this->session->userdata('user_db') == '' ) {
                $this->load->database();
            } else {
                                               
                $config['hostname'] = 'localhost';
                $config['username'] = 'root';
                $config['password'] = 'Magic2010';
                $config['database'] = $this->session->userdata('user_db');
                $config['dbdriver'] = 'mysqli';
                $config['dbprefix'] = '';
                $config['pconnect'] = false;
                $config['db_debug'] = false;
                $config['cache_on'] = false;
                $config['cachedir'] = '';
                $config['char_set'] = 'utf8';
                $config['dbcollat'] = 'utf8_general_ci';
                $config['swap_pre'] = '';
                $config['autoinit'] = false;
                $config['stricton'] = false;
                $this->load->database($config, false, true);

                //$db_obj = $this->load->database($config, false, true);
                //$connected = $db_obj->initialize();
                //if (!$connected) {
                //    $db_obj = $this->load->database();                   
                //}
                //$this->load->database();
            }
            $this->load->library('form_validation');
            $this->load->helper('number');
            $this->load->helper('pager');
            $this->load->helper('invoice');
            $this->load->helper('date');
            $this->load->helper('redirect');

            // Load setting model and load settings
            $this->load->model('settings/mdl_settings');
            $this->mdl_settings->load_settings();

            $this->lang->load('ip', $this->mdl_settings->setting('default_language'));
            $this->lang->load('form_validation', $this->mdl_settings->setting('default_language'));
            $this->lang->load('custom', $this->mdl_settings->setting('default_language'));

            $this->load->helper('language');

            $this->load->module('layout');

        }
    }

}
