<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
require("../connect_db.php");
output("ユーザーリスト");
DataTable("users");
?>
<div class="container">
	<?php ConsoleMenu(); ?>
	<div class="col-sm-10">
<?php
if (isset($_POST['del'])){
	$id = $_POST['del'];
	$query = "DELETE FROM `member` WHERE `id` = '$id'";
	$result = mysqli_query ($link,$query);
	if($result){
		echo "ユーザID".$id."の削除が完了しました";
	}else{
		echo "Failed";
	}
}

if (isset($_POST['admin'])){
	$id = $_POST['admin'];
	$query = "SELECT admin FROM member WHERE id = $id";
	$result = mysqli_query ($link,$query);
	$row = mysqli_fetch_array($result);
	$admin = $row['admin'];
	switch ($admin){
		case 0:
			$admin = 1;
			break;
		case 1:
			$admin = 0;
			break;
	}
		$query = "UPDATE member SET admin = $admin WHERE id = $id";
		$result = mysqli_query ($link,$query);
		if($result){
			echo $admin."管理者権限切り替え完了";
		}else{
			echo "Failed";
		}
	}

?>
<form action="user_list.php" method="post">
<!-- 表生成開始 -->

<table id="users" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
<thead><tr><th>#</th><th>ユーザー名</th><th>登録日時</th><th>管理権限</th><th>削除</th></tr></thead>
<?php
$result = mysqli_query($link,'SELECT id,user_id,time,admin FROM member');
$count = 0;
while ($row = mysqli_fetch_assoc($result)){
  $count ++;
	if ($row['admin'] == 1){
		$row['admin'] = "<span class=\"glyphicon glyphicon-lock\"></span> 管理者";
	}else{
		$row['admin'] = "<span class=\"glyphicon glyphicon-user\"></span> ユーザー";
	}
  echo "<tr>";
  echo "<td>",$row['id'],"</td>"; //商品ID
  echo "<td>",$row["user_id"],"</td>";
  echo "<td>".$row["time"]."</td>";
  echo "<td>".$row["admin"]." <button type=\"button\" class=\"btn btn-primary btn-xs\" data-toggle=\"modal\" data-target=\"#admin".$row['id']."\"><span class=\"glyphicon glyphicon-random\"></span> 切替</button></td>";
  echo "<td><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#delete".$row['id']."\"><span class=\"glyphicon glyphicon-trash\"></span> 削除</button></td>"; //checkbox
  echo "</tr>";
  ModalSet($row['id'],$row["user_id"],$row['admin']);
 }
  echo "</tbody>";
  echo "</table>";
  echo "<h4>" .$count. "件</h4><hr>";

  function ModalSet($id,$name,$admin){
	    if($admin == 1){
			$msg = "はく奪しますか？";
			$aleart = "今後このユーザーは管理者メニューを見ることができません";
		}else{
			$msg ="本当に付与しますか？";
			$aleart ="このユーザーは今後</br><b>「ユーザの管理、すべてのユーザの予約履歴の確認、商品の管理」</b></br>ができるようになります";
		}
  ?>

  	 <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
					<h4 class="modal-title">商品の削除</h4>
				</div>
					<div class="modal-body">
					<b><?php echo $name; ?></b> さんの予約履歴は見られなくなります</br>
					<b> <?php echo $id." : ". $name ?></b> さんのアカウントを本当に削除しますか？
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					<button type="submit" class="btn btn-danger" name='del' value='<?php echo $id; ?>'>削除</button>
				</div>
			</div>
		</div>
	  </div>
	    <div class="modal fade" id="admin<?php echo $id; ?>" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
					<h4 class="modal-title">管理者権限切り替え</h4>
				</div>
					<div class="modal-body">
					<?php	?>
					<b> <?php echo $id." : ".$name; ?></b>  管理者権限を<?php echo $msg; ?></br></br>
					<?php echo $aleart; ?>
					 </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					<button type="submit" class="btn btn-danger" name='admin' value='<?php echo $id; ?>'>切り替え</button>
				</div>
			</div>
		</div>
	  </div>
<?php
  }
 ?>
 </div>
