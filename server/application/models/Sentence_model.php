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
      $allopenid=array();
      $allopenid[]=DB::select('user_table', ['openid']);
      if(in_array($openid,$allopenid)){
        echo 'openid已存在';
      }
      else{
        DB::insert('user_table', [
          'openid' => $openid,
          'user_integral'=> 0
        ]);
        echo '插入成功';
      }
		}
	}
?>