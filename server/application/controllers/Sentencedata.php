<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sentencedata extends CI_Controller {
  public function get_sentence_list()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->get_list();
    echo json_encode($result);
  }
   public function get_sentence_list2()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->get_list2();
    echo json_encode($result);
  }
   public function get_sentence_list3()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->get_list3();
    echo json_encode($result);
  }
   public function get_sentence_list4()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->get_list4();
    echo json_encode($result);
  }
   public function get_sentence_list5()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->get_list5();
    echo json_encode($result);
  }
   public function get_sentence_list6()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->get_list6();
    echo json_encode($result);
  }
   public function get_sentence_list7()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->get_list7();
    echo json_encode($result);
  }
  public function get_sentence_list8()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->get_list8();
    echo json_encode($result);
  }
  public function get_search_list()
  {
    $this->load->model('sentence_model');
    $result=$this->sentence_model->search_list();
    echo json_encode($result);
  }
}
?>