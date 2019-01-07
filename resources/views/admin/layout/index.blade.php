<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>后台</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('/admin/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
	<link id="base-style" href="/admin/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="/admin/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/bootstrap-3.3.7-dist/js/jquery-3.3.1.min.js"></script>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="/admin/css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="/admin/css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
		<!-- start 顶部菜单栏 -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index"><span>SnEAKER ✔</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						
						
				
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> 管理员位置
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>操作</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> 个人信息</a></li>
								<li><a href="login.html"><i class="halflings-icon off"></i> 退出</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: 顶部菜单 -->
				
			</div>
		</div>
	</div>
	<!-- start 左侧菜单 -->
	<div class="copyrights">Collect from <a href="http://www.cssmoban.com/" ></a></div>
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li>
							<a class="dropmenu" href="#"><i class="icon-star"></i><span class="hidden-tablet"> 商品管理</span></a>
							<ul>
								<li><a class="submenu" href="/admin/goods"><i class="icon-file-alt"></i><span class="hidden-tablet"> 商品详情</span></a></li>
								<li><a class="submenu" href="/admin/goods/create"><i class="icon-file-alt"></i><span class="hidden-tablet"> 商品添加</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-bar-chart"></i><span class="hidden-tablet"> 用户管理</span></a>
							<ul>
								<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
							</ul>	
						</li>
							<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> 管理员管理</span></a>
							<ul>
								<li><a class="submenu" href="/admin/users"><i class="icon-file-alt"></i><span class="hidden-tablet"> 用户详情</span></a></li>
								<li><a class="submenu" href="/admin/users/create"><i class="icon-file-alt"></i><span class="hidden-tablet"> 添加用户</span></a></li>
								
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-list-alt"></i><span class="hidden-tablet"> 品牌类别管理</span></a>
							<ul>
								<li><a class="submenu" href="/admin/brand"><i class="icon-file-alt"></i><span class="hidden-tablet">品牌详情</span></a></li>
								<li><a class="submenu" href="/admin/brand/create"><i class="icon-file-alt"></i><span class="hidden-tablet"> 品牌添加</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-edit"></i><span class="hidden-tablet"> 网站配置</span></a>
							<ul>
								<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-eye-open"></i><span class="hidden-tablet"> 评论管理</span></a>
							<ul>
								<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> 导航管理</span></a>
							<ul>
								<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-envelope"></i><span class="hidden-tablet"> 广告管理</span></a>
							<ul>
								<li><a class="submenu" href="/admin/advertisement"><i class="icon-file-alt"></i><span class="hidden-tablet"> 广告详情</span></a></li>
								<li><a class="submenu" href="/admin/advertisement/create"><i class="icon-file-alt"></i><span class="hidden-tablet">广告添加</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-align-justify"></i><span class="hidden-tablet"> 友情链接管理</span></a>
							<ul>
								<li><a class="submenu" href="/admin/link"><i class="icon-file-alt"></i><span class="hidden-tablet">友情链接详情</span></a></li>
								<li><a class="submenu" href="/admin/link/create"><i class="icon-file-alt"></i><span class="hidden-tablet">友情链接添加</span></a></li>
							</ul>	
						</li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-open"></i><span class="hidden-tablet"> 轮播图管理</span></a>
							<ul>
								<li><a class="submenu" href="/admin/changepic"><i class="icon-file-alt"></i><span class="hidden-tablet"> 轮播图详情</span></a></li>
								<li><a class="submenu" href="/admin/changepic/create"><i class="icon-file-alt"></i><span class="hidden-tablet"> 轮播图添加</span></a></li>

							</ul>	
						</li>

					</ul>

				</div>
			</div>

			<!-- end:左侧菜单 -->
			
			
			
			<!-- start 右侧主体  -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="/admin/index">主页</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">{{ $page_name  or ''}}</a></li>
			</ul>

						
			@section ('content')
			
			
			
			
			@show
       

		</div>
		<!--/.fluid-container-->
	
		<!-- end 右侧主体 -->
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
	
	
	
	
	
	<footer>

		<p>
			<span style="text-align:left;float:left;">&copy; 2013 <a href="downloads/janux-free-responsive-admin-dashboard-template/" alt="Bootstrap_Metro_Dashboard">JANUX Responsive Dashboard</a></span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="{{asset('js/jquery-1.9.1.min.js')}}"></script>
	<script src="{{asset('js/jquery-migrate-1.0.0.min.js')}}"></script>
	
		<script src="{{asset('js/jquery-ui-1.10.0.custom.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.ui.touch-punch.js')}}"></script>
	
		<script src="{{asset('js/modernizr.js')}}"></script>
	
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.cookie.js')}}"></script>
	
		<script src="{{asset('js/fullcalendar.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>

		<script src="{{asset('js/excanvas.js')}}"></script>
	<script src="{{asset('js/jquery.flot.js')}}"></script>
	<script src="{{asset('js/jquery.flot.pie.js')}}"></script>
	<script src="{{asset('js/jquery.flot.stack.js')}}"></script>
	<script src="{{asset('js/jquery.flot.resize.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.chosen.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.uniform.min.js')}}"></script>
		
		<script src="{{asset('js/jquery.cleditor.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.noty.js')}}"></script>
	
		<script src="{{asset('js/jquery.elfinder.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.raty.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.iphone.toggle.js')}}"></script>
	
		<script src="{{asset('js/jquery.uploadify-3.1.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.gritter.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.imagesloaded.js')}}"></script>
	
		<script src="{{asset('js/jquery.masonry.min.js')}}"></script>
	
		<script src="{{asset('js/jquery.knob.modified.js')}}"></script>
	
		<script src="{{asset('js/jquery.sparkline.min.js')}}"></script>
	
		<script src="{{asset('js/counter.js')}}"></script>
	
		<script src="{{asset('js/retina.js')}}"></script>

		<script src="{{asset('js/custom.js')}}"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
