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
  {//Request $request
    $code=$this->input->get('oocode');//获取data传过来的值
    // echo $code.'PHP打印出来的';
    $url= 'https://api.weixin.qq.com/sns/jscode2session?appid=wxb8224cd2db31ceb1&secret=62497cd7be447460f69a22b6e728b27e&js_code='.$code.'&grant_type=authorization_code';
    // $weixin=file_get_contents($url);
    // $jsondecode=json_decode($weixin);
    // $array=get_object_vars($jsondecode);
    // $openid= $array['openid'];
    // print_r($array);

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $res = curl_exec($ch);
    $json_obj=json_decode($res);
    curl_close($ch);
    $openid = $json_obj->openid;
    // print_r($openid);//向调用此方法的my_page.js输出openid
    $this->load->model('sentence_model');
    $result=$this->sentence_model->add_user_list($openid);
    echo json_encode($openid);

    // function getcurl($url){
    //   $ch=curl_init();
    //   curl_setopt($ch,CURLOPT_URL,$url);
    //   curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    //   curl_setopt($ch,CURLOPT_TIMEOUT,30);
    //   $content=curl_exec($ch);
    //   $status=(int)cuel_getinfo($ch,CURLINFO_HTTP_CODE);
    //   if($status==404){
    //     return "";
    //   }
    //   curl_close($ch);
    //   return $content;
    // }
    // $res=getcurl($url);
    // print_r($res);
    // $this->load->model('sentence_model');
    // $this->sentence_model->add_user_list($res);


  // 获取微信用户信息
        // $code   =   $request->get('code');
        // $encryptedData   =   $request->get('encryptedData');
        // $iv   =   $request->get('iv');
        // $appid  =  "wxb8224cd2db31ceb1" ;
        // $secret =   "62497cd7be447460f69a22b6e728b27e";

        // $URL = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$code."&grant_type=authorization_code";

        // $apiData=file_get_contents($URL);
        // var_dump($code,'wwwwwwww',$apiData['errscode']);
        //     $ch = curl_init();
        // 　　curl_setopt($ch, CURLOPT_URL, $URL);
        // 　　curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 　　curl_setopt($ch, CURLOPT_HEADER, 0);
        // 　　$output = curl_exec($ch);
        // 　　curl_close($ch)

        // if(!isset($apiData['errcode'])){
        //     $sessionKey = json_decode($apiData)->session_key;
        //     $userifo = new \WXBizDataCrypt($appid, $sessionKey);

        //     $errCode = $userifo->decryptData($encryptedData, $iv, $data );

        //     if ($errCode == 0) {
        //         return ($data . "\n");
        //     } else {
        //         return false;
        //     }
        // }
  }
  public function get_publish_list()
  {
    $otextarea = $this->input->get('otextarea');
    $oleibie = $this->input->get('oleibie');
    $oauthor = $this->input->get('oauthor');
    $openId = $this->input->get('openId');
    $this->load->model('sentence_model');
    $result=$this->sentence_model->add_publish_list($otextarea,$oleibie,$oautho,$openId);
    // echo json_encode($result);
  }
}
?>