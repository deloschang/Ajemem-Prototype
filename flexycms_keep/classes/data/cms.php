<?php
class cms{
	function insert($arr){
		$sql = "INSERT INTO ".TABLE_PREFIX."content VALUES('','$arr[name]','$arr[cmscode]','$arr[meta_description]','$arr[meta_keywords]','$arr[title]','$arr[description]','$arr[language]','".$_SERVER['REMOTE_ADDR']."',NOW(),'')";
		$err = execute($sql,$err);
		$id = mysql_insert_id();
		return $id;
	}
	function update($data){
		$sql = "UPDATE ".TABLE_PREFIX."content SET name='".$data['name']."',
				title='".$data['title']."',cmscode='".$data['cmscode']."',
				description='".$data['description']."',
				meta_description='".$data['meta_description']."',
				meta_keywords='".$data['meta_keywords']."',
				ip='".$_SERVER['REMOTE_ADDR']."',last_update_time = NOW()
				WHERE id_content=".$data['id_content'];
		execute($sql,$err);
	}
	function insert_archieve($arr){
		$sql = "INSERT INTO ".TABLE_PREFIX."content_archieve
			VALUES('','".$arr['id_content']."','".$arr['name']."','".$arr['cmscode']."','".$arr['meta_description']."',
			'".$arr['meta_keywords']."','".$arr['title']."','".$arr['description']."','".$arr['language']."','".$arr['ip']."',
			'".$arr['ctime']."','".$arr['last_update_time']."',NOW())";
		//print $sql;
		mysql_query($sql);
	}

	function delete($code){
		$sql = "DELETE FROM ".TABLE_PREFIX."content WHERE cmscode='".$code."'";
		execute($sql,$err);
	}
}
?>