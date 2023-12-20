<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="your-styles.css">
  <style>
    /* 왼쪽 메뉴 스타일 */
    .menu {
      width: 200px;
      background-color: #1b1e24;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      overflow-y: auto;
      padding-top: 20px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }
    
    .menu ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .menu li {
      margin: 0;
      padding: 10px 20px;
      border-bottom: 1px solid #343a45;
      text-align: left;
    }
    
    .menu li:last-child {
      border-bottom: none;
    }
    
    .menu a {
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      display: block;
    }
    
    .menu a:hover {
      color: #1161ee;
    }
  </style>
</head>
<body>
  <div class="menu">
    <ul>
      <li><a href="#">메뉴 1</a></li>
      <li><a href="#">메뉴 2</a></li>
      <li><a href="#">메뉴 3</a></li>
    </ul>
  </div>

  <div class="table-title">
    <h3>테이블 제목</h3>
  </div>

  <div class="table-fill">
    <table>
      <!-- 테이블 내용... -->
    </table>
  </div>

  <div class="login-wrap">
    <div class="login-html">
      <!-- 로그인 폼 내용... -->
    </div>
  </div>
</body>
</html>