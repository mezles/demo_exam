<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {
	public $components = array('Session');
		
	/**
	 * Displays the view for login page
	 *
	 * @access public
	 * @param mixed What page to display
	 * @return void
	 */
	public function index() {
		$this->set('site_title', 'Home - Demo Site');
		$this->set('page_title', 'Login Page');
		
		// if form is submitted
		if ($this->request->is('post')) {
			// checks for valid login
			$login_check 	= $this->login_check( $this->request->data );
			
			// if validation is successful, stores session
			if ( $login_check['success'] ) {
			
				$this->Session->write('Userlogin.id', $login_check['data']['User']['id']);
				$this->Session->write('Userlogin.username', $login_check['data']['User']['username']);
				//redirect to main page
				$this->redirect( array('controller' => 'admins', 'action' => 'index') );
			
			// else, sets error message			
			} else {
				$this->Session->setFlash($login_check['msg'], 'default', array('class' => 'error-wrapper'));
				
			}
		}
		
	}
	
	/**
	 * Displays the view for users list
	 *
	 * @access public
	 * @param mixed What page to display
	 * @return void
	 */
	public function view() {
		// if not logged in, redirects to login page
		if ( ! $this->Session->check('Userlogin.id') ) {
			
			$this->redirect( array('controller' => 'users', 'action' => 'index') );
			
		// else view the page
		} else {
			$username = $this->Session->read('Userlogin.username');
		
			$this->set('site_title', 'View All Users - Demo Site');
			$this->set('page_title', 'Welcome ' . $username . '!');
			$this->set('page_subtitle', 'View All Users');
			$this->set('users', $this->User->find('all'));
		}
		
	}
	
	/**
	 * Simple login validation, not using cakephp auth
	 * Checks and validates user login
	 *
	 * @access private
	 * @param array $data
	 * @return array
	 */
	protected function login_check( $data ) {
		$return = array();
		$username = $data['User']['username'];
		$password = $data['User']['password'];
		
		$this->User->set( $data );
		
		// if validation is true
		if ($this->User->validates()) {
			// it validated logic
			$has_user = $this->User->find('first', array(
				'conditions' => array('User.username' => $username, 'User.password' => sha1($password . ':' . Configure::read('PSALT')))
			));
			
			$return['data'] = $has_user;
			$return['success'] = ($has_user) ? TRUE : FALSE;
			$return['msg'] = ($has_user) ? '<p>Successfully logged in</p>' : '<p>Username and password not matched.</p>'; 
		
		// validation fails		
		} else {
			// didn't validate logic
			$return['data'] = array();
			$return['success'] = FALSE;
			$return['msg'] = '<p>Error in validation.</p>'; 
		}	
		
		return $return;
	}
	
}
