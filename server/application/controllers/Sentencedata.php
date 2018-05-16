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
    $val = $this->input->get('val');
    $this->load->model('sentence_model');
    $result=$this->sentence_model->search_list($val);
    echo json_encode($result);
  }
  public function get_user_list()
  {
    $code=$_REQUEST['code'];
    echo $code.'PHP打印出来的';
    $url= 'https://api.weixin.qq.com/sns/jscode2session?appid=wxb8224cd2db31ceb1&secret=62497cd7be447460f69a22b6e728b27e&js_code=$code&grant_type=authorization_code';
    function getcurl($url){
      $ch=curl_init();
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch,CURLOPT_TIMEOUT,30);
      $content=curl_exec($ch);
      $status=(int)cuel_getinfo($ch,CURLINFO_HTTP_CODE);
      if($status==404){
        return "";
      }
      curl_close($ch);
      return $content;
    }
    $res=getcurl($url);
    print_r($res);
    $this->load->model('sentence_model');
    $this->sentence_model->add_user_list($res);
  }
}
?>