﻿<?php include('connect.php') ?>
<!doctype html>
<html lang="en">

<head>
	<title>Order Service</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?php include('bar.php') ?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">

						<!--<li><a href="Home-Factory.php" class=""><i class="lnr lnr-home"></i> <span>หน้าแรก</span></a></li>-->
						<li><a href="Summary-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายรวมทุกประเภท</span></a></li>
						<li><a href="Order-All.php" class=""><i class="lnr lnr-chart-bars"></i> <span>รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
						<!--<li><a href="Summary-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทบริการ</span></a></li>
						<li><a href="Summary-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทกลุ่มสินค้า</span></a></li>-->
						<li><a href="Summary-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามทุกรายการสินค้า</span></a></li>
						<li><a href="Summary-Canceled-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายรายการยกเลิกออเดอร์<br>(ที่ร้าน, ที่โรงงาน )</span></a></li>
						<li><a href="Order-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ทุกประเภท</span></a></li>
						<li><a href="Order-Service-F.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ประเภทบริการ</span></a></li>
						<li><a href="Order-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ประเภทกลุ่มสินค้า</span></a></li>
						<li><a href="Order-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอรทุกรายการสินค้า</span></a></li>
						<li><a href="Customer-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดออเดอร์ลูกค้าประจำร้าน</span></a></li>
						<li><a href="Customer-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดประเภทบริการลูกค้าประจำร้าน</span></a></li>

					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->


		<!-- MAIN -->
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="col-md-6">
						<!-- INPUTS -->
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">ค้นหา</h3>
							</div>
							<div class="panel-body">
								<form action="Order-Service-F.php" method="post" onSubmit="return getDate()" >

									<label>เลือกวันที่</label>
									<input type="date" name="date_start" class="form-control" required>
									<br><label>ถึง</label><br>
									<input type="date" name="date_end" class="form-control" required>
									<br>
									<label>ค้นหาประเภทร้าน</label><br>
									<select class="form-control"  name="keywords" required>
										<option value="cheese">--เลือกประเภทร้าน--</option>
										<?php
									$stmt="select BranchTypeID,BranchTypeNameTH from mas_branchtype where IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
										<option value="<?php echo $row["BranchTypeID"];?>"><?php echo $row["BranchTypeNameTH"];?></option>
										<?php } ?>
									</select>
									<br><label>ค้นหาชื่อร้าน</label><br>
									<select class="form-control"  name="keywords2" required>
										<option value="cheese">--เลือกชื่อร้าน--</option>
										<?php
									$stmt="select distinct ops_order.BranchID,BranchNameTH from ops_order left join mas_branch on ops_order.BranchID=mas_branch.BranchID where ops_order.IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
										<option value="<?php echo $row["BranchID"];?>"><?php echo $row["BranchNameTH"];?></option>
										<?php } ?>
									</select>
									<br>

									<center><input type="submit" value="Search"></center>

								</form>
							</div>
						</div>
					</div>
					<!-- END INPUTS -->

					<?php
					$date_start=$_POST["date_start"];
					$date_end=$_POST["date_end"];
					$keywords=$_POST["keywords"];
$keywords2=$_POST["keywords2"];
					?>
					<div class="col-md-6">
						<!-- INPUTS -->
						<div class="panel">
							<div class="panel-heading">

								<h2>สรุปยอดรายการออเดอร์ประเภทบริการ</h2>

								<h2 class="panel-title">ผลการค้นหา</h2>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<div class="metric">
											<p><span class="title">วันที่</span>
												<span class="number"><?php echo "&nbsp";?><?php echo substr($date_start,8,2);?>-<?php echo substr($date_start,5,2);?>-<?php echo substr($date_start,0,4);?>
												<?php echo "&nbsp ถึง &nbsp";?>
												<?php echo substr($date_end,8,2);?>-<?php echo substr($date_end,5,2);?>-<?php echo substr($date_end,0,4);?></span>
												<br>
												<?php
												if($_POST['select_top']){
												 if($_POST['select_top']==100){
													echo 'แสดงทั้งหมด (All)';
												}else{
													echo $_POST['select_top'].' อันดับแรก (Top '.$_POST['select_top'].')';
												}
												}
												?>
											</p>
											<br>
										</div>
									</div>

								</div>
							</div>
							<div class="panel-body">
								<label>จัดอันดับ</label><br>
								<form method="post" action="Order-Service-F.php" id="frm">
									<select class="form-control" name="select_top" onchange="onSelectChange();">
										<?php if($_POST["date_start"]){?>
										<option value="">--เลือกการจัดอันดับ--</option>
										<option value="10">10 อันดับแรก (Top 10)</option>
										<option value="20">20 อันดับแรก (Top 20)</option>
										<option value="30">30 อันดับแรก (Top 30)</option>
										<option value="100">แสดงทั้งหมด (All)</option>
										<?php }else{?>
										<option value="">--เลือกการจัดอันดับ--</option>
										<?php }?>

									</select>
									<input type="hidden" name="date_start" value=<?php echo $date_start; ?>>
									<input type="hidden" name="date_end" value=<?php echo $date_end; ?>>
									<input type="hidden" name="keywords" value=<?php echo $keywords; ?>>
									<input type="hidden" name="keywords2" value=<?php echo $_POST["keywords2"];?>>

								</form>
								<br>
							</div>
						</div>
					</div>



					<!-- END INPUTS -->



					<!-- OVERVIEW -->
					<?php
					if($_POST['select_top']==10){
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT distinct top 10 mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}else{
					$stmt="SELECT distinct top 10 mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$keywords2."' AND mas_branchtype.BranchTypeNameTH = '".$keywords."'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}}else if($_POST['select_top']==20){
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT distinct top 20 mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}else{
					$stmt="SELECT distinct top 20 mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$keywords2."' AND mas_branchtype.BranchTypeNameTH = '".$keywords."'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}}else if($_POST['select_top']==30){
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT distinct top 30 mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}else{
					$stmt="SELECT distinct top 30 mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$keywords2."' AND mas_branchtype.BranchTypeNameTH = '".$keywords."'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}}else if($_POST['select_top']==100){
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT distinct mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}else{
					$stmt="SELECT distinct mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$keywords2."' AND mas_branchtype.BranchTypeNameTH = '".$keywords."'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}}else{
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT distinct mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}else{
					$stmt="SELECT distinct mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then ops_orderdetail.Amount else null end),0) as service1,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end),0) as orderservice1,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then ops_orderdetail.Amount else null end),0) as service2,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end),0) as orderservice2,
 coalesce ( SUM(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then ops_orderdetail.Amount else null end),0) as service3,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end),0) as orderservice3,
  coalesce (SUM(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then ops_orderdetail.Amount else null end),0) as service4,
  coalesce (Count(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end),0) as orderservice4,
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักแห้ง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำ' then 1 else null end)+
 COUNT(case when ops_orderdetail.ServiceNameTH = 'สปาเครื่องหนัง' then 1 else null end)+
  COUNT(case when ops_orderdetail.ServiceNameTH = 'ซักน้ำด้วยมือ' then 1 else null end) as total
 from ops_orderdetail left join
 (ops_order left join (mas_branch
 left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
 on ops_order.BranchID=mas_branch.BranchID)on ops_orderdetail.OrderNo=ops_order.OrderNo
 WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$keywords2."' AND mas_branchtype.BranchTypeNameTH = '".$keywords."'

 GROUP BY mas_branchtype.BranchTypeNameTH,
 mas_branch.BranchCode,mas_branch.BranchNameTH
";
					}
					}
					$query = sqlsrv_query($conn,$stmt);
					?>


					<div class="row">
						<div class="col-md-12">
							<!--<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Bar Chart</h3>
								</div>
								<div class="panel-body">
									<center>
										<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
										<div id="chart_div" style="height: 1000px; width: 100%"></div>
									</center>
								</div>
							</div>-->
						</div>
					</div>
					<!-- END OVERVIEW -->


					<!-- RECENT PURCHASES -->

					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">ตารางข้อมูล</h3>

						</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th bgcolor="#ffffff"> <center>ลำดับที่</center> </th>
                    <th bgcolor="#ffffff"> <center>ประเภทร้าน</center> </th>
                    <th bgcolor="#ffffff"> <center>รห้สร้าน</center> </th>
                    <th bgcolor="#ffffff"> <center>ชื่อร้าน</center> </th>
                    <th bgcolor="#ffffff"> <center>ยอดขายซักแห้ง</center> </th>
                    <th bgcolor="#ffffff"> <center>จำนวนชิ้นซักแห้ง</center> </th>
                    <th bgcolor="#ffffff"> <center>ยอดขายซักน้ำ</center> </th>
                    <th bgcolor="#ffffff"> <center>จำนวนชิ้นซักน้ำ</center> </th>
                    <th bgcolor="#ffffff"> <center>ยอดขายซักน้ำด้วยมือ</center> </th>
                    <th bgcolor="#ffffff"> <center>จำนวนชิ้นซักน้ำด้วยมือ</center> </th>
										<th bgcolor="#ffffff"> <center>ยอดขายสปาเครื่องหนัง</center> </th>
                    <th bgcolor="#ffffff"> <center>จำนวนชิ้นสปาเครื่องหนัง</center> </th>
                    <th bgcolor="#ffffff"> <center>จำนวนชิ้นทั้งหมด</center> </th>
									</tr>
								</thead>
								<?php

																$i=1;
																$total1=0;
																$total2=0;
																$total3=0;
																$total4=0;
																$total5=0;
																$total6=0;
																$total7=0;
																$total8=0;
																$total9=0;

																while($row = sqlsrv_fetch_array($query)){

																	$format_total=number_format($row['total'],2);


																	$total1=$total1+$row['service1'];
																	$total2=$total2+$row['orderservice1'];
																	$total3=$total3+$row['service2'];
																	$total4=$total4+$row['orderservice2'];
																	$total5=$total5+$row['service3'];
																	$total6=$total6+$row['orderservice3'];
																	$total7=$total7+$row['service4'];
																	$total8=$total8+$row['orderservice4'];
																	$total9=$total9+$row['total'];


																	?>

																	<tbody>
																		<tr>
																			<td align="center"><?php echo $i;?></td>
																			<td align="center"><?php echo $row['BranchTypeNameTH'];?></td>
																			<td align="center"><?php echo $row['BranchCode'];?></td>
																			<td align="center"><?php echo $row['BranchNameTH'];?></td>
																			<td align="center"><?php echo number_format($row['service1'],2);?></td>
                                      <td align="center"><?php echo $row['orderservice1'];?></td>
                                      <td align="center"><?php echo number_format($row['service2'],2);?></td>
                                      <td align="center"><?php echo $row['orderservice2'];?></td>
                                      <td align="center"><?php echo number_format($row['service3'],2);?></td>
                                      <td align="center"><?php echo $row['orderservice3'];?></td>
																			<td align="center"><?php echo number_format($row['service4'],2);?></td>
                                      <td align="center"><?php echo $row['orderservice4'];?></td>
																			<td align="center"><?php echo $row['total'];?></td>
																			<?php $i++;}?>
																			<tr>

																				<td colspan="4" align="center" bgcolor="#2eb82e"><font color="white"><text1><?php echo 'รวม';?></text1></font></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total1,2);?></font></text1></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total2;?></font></text1></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total3,2);?></font></text1></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total4;?></font></text1></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total5,2);?></font></text1></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total6;?></font></text1></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total7,2);?></font></text1></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total8;?></font></text1></td>
																				<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total9;?></font></text1></td>


																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
													<!-- END MAIN CONTENT -->
												</div>
												<!-- END MAIN -->
												<div class="clearfix"></div>

											</div>
											<!-- END WRAPPER -->
											<!-- Javascript -->
											<script type="text/javascript">
                                                function onSelectChange(){
                                                    document.getElementById('frm').submit();
                                                }
												function getDate(){
													var start=document.getElementById("date_start").value;
													var end=document.getElementById("date_start").value;
												}
											</script>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>



											<?php
											$query = sqlsrv_query($conn,$stmt);
											?>


														<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
														<script type="text/javascript">
														google.charts.load('current', {packages: ['corechart', 'bar']});
														google.charts.setOnLoadCallback(drawBasic);

														function drawBasic() {
																var data = google.visualization.arrayToDataTable([
														['ชื่อร้านค้า','จำนวนออร์เดอร์ซักแห้ง','จำนวนออร์เดอร์ซักน้ำ','จำนวนออร์เดอร์ซักน้ำด้วยมือ','จำนวนออร์เดอร์สปาเครื่องหนัง'],
														<?php
														while($row = sqlsrv_fetch_array($query)) {
															echo "['".$row['BranchNameTH']."',".$row['orderservice1'].",".$row['orderservice2'].",".$row['orderservice3'].",".$row['orderservice4']."],";
														}
														?>
														]);
														var options = {
															hAxis: {
													title: 'จำนวนออเดอร์ (ออเดอร์)',
													minValue: 0
												},

													 legend: { position: 'top', maxLines: 3 },
													 bar: { groupWidth: '75%' },
													 isStacked: true
													};

													var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

												 chart.draw(data, google.charts.Bar.convertOptions(options));

												 var btns = document.getElementById('btn-group');

												 btns.onclick = function (e) {

													 if (e.target.tagName === 'BUTTON') {
														 options.vAxis.format = e.target.id === 'none' ? '' : e.target.id;
														 chart.draw(data, google.charts.Bar.convertOptions(options));
													 }
												 }
											 }

										 </script>


									 </body>

									 </html>
