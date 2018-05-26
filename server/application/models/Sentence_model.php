<?php
	use QCloud_WeApp_SDK\Mysql\Mysql as DB;
	class Sentence_model extends CI_Model{
    public function getdailylist(){
      $pdo = DB::getInstance();
      $sql = 'select count(*) from sentence_table';
      $result = $pdo->query($sql);//提交sql
      $rowsNumber = $result->fetchColumn();//取回结果集中的一个字段
      return $rowsNumber;
		}
    public function getdaylist($val){
      // return DB::select('sentence_table', ['*'],'sentence_id='.$val);
      $db = DB::getInstance();
      $strSql = "select * from sentence_table where sentence_id=".$val;
      $result=$db->query($strSql);
      return $result->fetchAll();
		}
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
    public function add_publish_list($otextarea,$oleibie,$oauthor,$oopenid){
      $db = DB::getInstance();
      $strSql = "select sentence_content from sentence_table where sentence_content like '%".$otextarea."%'";
      $result=$db->query($strSql);
      if($result->fetchAll()){
        return "句子重复";
      }
      else{
        $pdo = DB::getInstance();
        $sql = "insert into sentence_table (sentence_content,sentence_source,category_id) values (?,?,?)";
        $preObj = $pdo->prepare($sql);
        $res    = $preObj->execute(array($otextarea, $oauthor,$oleibie));
        $lastInsertId = $pdo->lastInsertId();//获取插入后的id
        $ouserid = DB::row('user_table', ['user_id'], 'openid = "'.$oopenid.'"');
        $adduserid= $ouserid->user_id;
        DB::insert('publish_table', [
          'sentence_id' => $lastInsertId,
          'user_id'=> $adduserid
        ]);

        $jifen="select user_integral from user_table where user_id=".$adduserid;
        $rejifen=$pdo->query($jifen);
        $duijifen=$rejifen->fetchAll();
        $jieguo=$duijifen[0][0]+2;
        // $stmt = $pdo->prepare("UPDATE user_table SET user_integral=? WHERE user_id= ?");  
        // $stmt->bindValue($jieguo,$adduserid);  
        // $num = $stmt->execute(); 
        // return  $adduserid;
        $jiaer="UPDATE user_table SET user_integral=".$jieguo." WHERE user_id=".$adduserid;
        $pdo->exec($jiaer);
        $stmt =$pdo->prepare($jiaer);
        $stmt->execute(); 
        return  $jieguo;
      }
		}
    public function get_publish_list($oopenid){
      $ouserid = DB::row('user_table', ['user_id'], 'openid = "'.$oopenid.'"');
      $adduserid= $ouserid->user_id;
      $db = DB::getInstance();
      $strSql = "SELECT * FROM sentence_table AS a,publish_table AS b WHERE a.sentence_id=b.sentence_id AND user_id=".$adduserid;
      $result=$db->query($strSql);
      return $result->fetchAll();
			// $publishlist=DB::select('publish_table', ['sentence_id'],'category_id='.$adduserid);
      // return $publishlist;


      // $db = DB::getInstance();
      // $strSql = "select sentence_id from publish_table where user_id=".$adduserid;
      // $result=$db->query($strSql);
      // $myresult=$result->fetchAll();
      // // return $myresult;
      // $onem=array();
      // foreach($myresult as $vol){
      //   $onem[]=$vol[0];
      // }
      // $jieguo=array();
      // for ($x=0; $x<count($onem); $x++) {
      //   $dbdb = DB::getInstance();
      //   $strSql = "select * from sentence_table where sentence_id=".$onem[$x];
      //   $result=$db->query($strSql);
      //   $jieguo[$x]=$result->fetchAll();
      //   return $jieguo[$x];
      // }
		}
    public function add_collection_list($clasnam,$claauto,$oopenid){
      $pdo = DB::getInstance();
      // $strSql = "select sentence_id from sentence_table where sentence_content=".$clasnam;
      $ousersen = DB::row('sentence_table', ['sentence_id'], 'sentence_content = "'.$clasnam.'"');
      $ouseraut = DB::row('user_table', ['user_id'], 'openid = "'.$oopenid.'"');
      $addusersenid= $ousersen->sentence_id;
      $adduserautid= $ouseraut->user_id;
      $num=DB::row('collection_table', ['sentence_id'], 'sentence_id = "'.$addusersenid.'"');
      if($num==null){
         DB::insert('collection_table', [
            'sentence_id' => $addusersenid,
            'user_id'=> $adduserautid
        ]);
        $jifen="select user_integral from user_table where user_id=".$adduserautid;
        $rejifen=$pdo->query($jifen);
        $duijifen=$rejifen->fetchAll();
        $jieguo=$duijifen[0][0]+1;
        $jiaer="UPDATE user_table SET user_integral=".$jieguo." WHERE user_id=".$adduserautid;
        $pdo->exec($jiaer);
        $stmt =$pdo->prepare($jiaer);
        $stmt->execute(); 
        return  $jieguo;
      }
      else{
        return "此句子您已收藏";
      }
    }
    public function getcollection_list($oopenid){
        $ouserid = DB::row('user_table', ['user_id'], 'openid = "'.$oopenid.'"');
        $adduserid= $ouserid->user_id;
        $db = DB::getInstance();
        $strSql = "SELECT * FROM sentence_table AS a,collection_table AS b WHERE a.sentence_id=b.sentence_id AND user_id=".$adduserid;
        $result=$db->query($strSql);
        return $result->fetchAll();
    }
    public function getintegral($oopenid){
      $pdo = DB::getInstance();
      $ouseraut = DB::row('user_table', ['user_id'], 'openid = "'.$oopenid.'"');
      $adduserautid= $ouseraut->user_id;
      $jifen="select user_integral from user_table where user_id=".$adduserautid;
      $rejifen=$pdo->query($jifen);
      $duijifen=$rejifen->fetchAll();
      return $duijifen[0][0];
    }
    public function deletecollection_list($clasnam,$claauto,$oopenid){
      $pdo = DB::getInstance();
      // $strSql = "select sentence_id from sentence_table where sentence_content=".$clasnam;
      $ousersen = DB::row('sentence_table', ['sentence_id'], 'sentence_content = "'.$clasnam.'"');
      $ouseraut = DB::row('user_table', ['user_id'], 'openid = "'.$oopenid.'"');
      $addusersenid= $ousersen->sentence_id;
      $adduserautid= $ouseraut->user_id;
      $deleterows = DB::delete('collection_table', 'sentence_id = '.$addusersenid.'','user_id = '.$adduserautid);
      return "删除成功";
      // $num=DB::row('collection_table', ['sentence_id'], 'sentence_id = "'.$addusersenid.'"');
      // if($num==null){
      //    DB::insert('collection_table', [
      //       'sentence_id' => $addusersenid,
      //       'user_id'=> $adduserautid
      //   ]);
      //   $jifen="select user_integral from user_table where user_id=".$adduserautid;
      //   $rejifen=$pdo->query($jifen);
      //   $duijifen=$rejifen->fetchAll();
      //   $jieguo=$duijifen[0][0]+1;
      //   $jiaer="UPDATE user_table SET user_integral=".$jieguo." WHERE user_id=".$adduserautid;
      //   $pdo->exec($jiaer);
      //   $stmt =$pdo->prepare($jiaer);
      //   $stmt->execute(); 
      //   return  $jieguo;
      // }
    }
    public function deletepublication_list($clasnam,$claauto,$oopenid){
      $pdo = DB::getInstance();
      // $strSql = "select sentence_id from sentence_table where sentence_content=".$clasnam;
      $ousersen = DB::row('sentence_table', ['sentence_id'], 'sentence_content = "'.$clasnam.'"');
      $ouseraut = DB::row('user_table', ['user_id'], 'openid = "'.$oopenid.'"');
      $addusersenid= $ousersen->sentence_id;
      $adduserautid= $ouseraut->user_id;
      $delete_publish_rows = DB::delete('publish_table', 'sentence_id = '.$addusersenid.'','user_id = '.$adduserautid);
      // $delet_esenence_rows = DB::delete('publish_table', 'sentence_id = '.$addusersenid);
      return "删除成功";
    }
	}
?> 