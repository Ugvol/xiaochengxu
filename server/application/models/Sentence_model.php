<?php
	use QCloud_WeApp_SDK\Mysql\Mysql as DB;
	class Sentence_model extends CI_Model{
		public function get_list(){
			return DB::select('sentence_table', ['*'],'category_id=1');
		}
    public function get_list2(){
			return DB::select('sentence_table', ['*'],'category_id=2');
		}
    public function get_list3(){
			return DB::select('sentence_table', ['*'],'category_id=3');
		}
    public function get_list4(){
			return DB::select('sentence_table', ['*'],'category_id=4');
		}
    public function get_list5(){
			return DB::select('sentence_table', ['*'],'category_id=5');
		}
    public function get_list6(){
			return DB::select('sentence_table', ['*'],'category_id=6');
		}
    public function get_list7(){
			return DB::select('sentence_table', ['*'],'category_id=7');
		}
    public function get_list8(){
			return DB::select('sentence_table', ['*'],'category_id=8');
		}
    public function search_list($val){
      $db = DB::getInstance();
      $strSql = "select * from sentence_table where sentence_content like '%".$val."%'";
      $result=$db->query($strSql);
      return $result->fetchAll();
		}
    public function add_user_list($openid){
      $allopenid=DB::select('user_table', ['openid']);//返回一维对象数组
      $onem=array();
      foreach($allopenid as $vol){//遍历对象数组，每次取出一个对象
         $onem[]=$vol->openid;//取出对象中openid的值,$vol['openid']会报错
      }
      if(in_array($openid,$onem)){
        // echo "该用户已存在";
      }
      else{
        DB::insert('user_table', [
          'openid' => $openid,
          'user_integral'=> 0
        ]);
      }
		}
    public function add_publish_list($otextarea,$oleibie,$oauthor,$openId){
      $rows = DB::row('sentence_table', ['sentence_content'], 'sentence_content = '+$otextarea);
      if($rows==$otextarea){
        echo '句子重复';
      }else{
        switch($oleibie){
          case '励志':
            $oleibie=1;
            break;
          case '情感':
            $oleibie=2;
            break;
          case '家书':
            $oleibie=3;
            break;
          case '呓语':
            $oleibie=4;
            break;
          case '歌词':
            $oleibie=5;
            break;
          case '台词':
            $oleibie=6;
            break;
          case '书籍':
            $oleibie=7;
            break;
          case '诗词':
            $oleibie=8;
            break;
        }
        DB::insert('sentence_table', [
          'sentence_content' => $otextarea,
          'sentence_source'=> $oauthor,
          'category_id' => $oleibie,
        ]);
        $addsentenseid = DB::row('sentence_table', ['sentence_id'], 'sentence_content = '+$otextarea);
        $adduserid = DB::row('user_table', ['user_id'], 'openid = '+$openId);
         DB::insert('publish_table', [
          'sentence_id' => $addsentenseid,
          'user_id'=> $adduserid
        ]);
        echo '成功';
      }
		}
	}
?> 