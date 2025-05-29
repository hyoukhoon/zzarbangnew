<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="즐거운 생활을 위한 재밌는 사이트 - 짜르방닷컴">
    <meta name="author" content="짜르방닷컴">
    <meta name="generator" content="Hugo 0.108.0">
	<meta name="naver-site-verification" content="b04ea38394e2b509018e38c8c6a3ba8535d628c9" />
	<link rel="shortcut icon" href="/img/favi/favicon.ico"> <!--추가-->
	<link rel="apple-touch-icon" sizes="57x57" href="/img/favi/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/img/favi/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/img/favi/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/img/favi/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/img/favi/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/img/favi/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/img/favi/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/img/favi/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/img/favi/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/img/favi/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/favi/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/favi/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/favi/favicon-16x16.png">
	<link rel="manifest" href="/img/favi/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/img/favi/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
    <title>ZZr르방 - 뻘글저장소</title>

<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/offcanvas-navbar/">
 <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<script  src="https://code.jquery.com/jquery-latest.min.js"></script>
    <style>
	footer {
		width: 100%;
		position: fixed;  
		bottom: 0;
		left: 0;
	}
	a {
		  color: #000000;
		  text-decoration: none;
		}

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="/assets/offcanvas-navbar.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body class="bg-light">
    
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">ZZr르방 <span style="font-size:14px;">- 뻘글저장소</span></a>
    <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>

		<span class="position-absolute top-1 start-10 translate-middle p-2 bg-danger border border-light rounded-circle">
		<span class="visually-hidden">New alerts</span>
	  </span>

    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
		  
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">home</span>HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/hot100.php?type=daily"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">workspace_premium</span>데일리핫</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/hot100.php?type=weekly"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">social_leaderboard</span>위클리핫</a>
        </li>
		<!-- <li class="nav-item">
          <a class="nav-link" href="/hoo.php"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">shield_lock</span>후방짤</a>
        </li> -->
		<li class="nav-item">
			  <a class="nav-link" href="/convert/convert.php"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">change_circle</span>파일변환</a>
			</li>

			<li class="nav-item">
			  <a class="nav-link" href="/member/login"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">login</span>로그인</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="/member/signup"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">person_add</span>회원가입</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="/board/qna.php"><span class="material-symbols-outlined" style="vertical-align: text-bottom;">support_agent</span>문의하기</a>
			</li>
        
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>

@yield('content')

<!-- Footer -->
<footer class="bg-dark" style="z-index:1000;">
    <div class="container" style="padding:10px;">
      <p class="m-0 text-center text-white">CopyRight &copy; 짜르방닷컴 2023 / <a href="javascript:;" onclick="window.open('/member/privacy.php');" style="color:#fff">개인정보취급방침</a></p>
    </div>
    <!-- /.container -->
  </footer>

<div class="modal fade" id="msgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">쪽지보내기</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
          <input type="hidden" name="memberid" id="memberid">
        <div class="mb-3">
          <label for="message-text" class="col-form-label">메세지</label>
          <textarea class="form-control" id="message-text" style="width:100%;height:100px;"></textarea>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="msgcancel">취소</button>
      <button type="button" class="btn btn-primary" id="msgsend">보내기</button>
    </div>
  </div>
</div>
</div>

<script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/offcanvas-navbar.js"></script>

</body>
</html>