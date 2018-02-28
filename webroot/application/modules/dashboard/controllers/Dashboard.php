<?php

class Dashboard extends Front_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('users/user_model');
  }

  //--------------------------------------------------------------------

  public function index() {
    $user_id = $this->session->userdata['user_id'];
    $user = $this->user_model->find_user_and_meta($user_id);

    Template::set('user', $user);
    Template::render('evpiu');
  }

  //--------------------------------------------------------------------

}
