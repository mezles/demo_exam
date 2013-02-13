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
class AdminsController extends AppController {

	public function beforeRender() {
		if ( ! $this->Session->check('Userlogin.id') ) {
			$this->redirect( array('controller' => 'users', 'action' => 'index') );
		}
		// $this->Session->destroy();
	}
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function index() {
		$username = $this->Session->read('Userlogin.username');
		$this->set('site_title', 'Home - Demo Exam');
		$this->set('page_title', 'Welcome ' . $username . '!');
		
		// $this->Session->write('Person.eyeColor', 'Green');
		// $green = $this->Session->read('Person');
		// var_dump($green);
		
	}
}
