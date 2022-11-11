<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/styles.css" />
    <?=$this->section("page_specific_css")?>
    <title><?=$this->e($title)?></title>
  </head>
  <body>
    <div class="offcanvas offcanvas-end" id="demo">
      <div class="offcanvas-header">
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
        ></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav">
          <li class="nav-item nav-item-top">
            <a href="/" class="nav-link active">Store</a>
          </li>
          <li class="nav-item nav-item-top">
            <a href="#" class="nav-link">FAQ</a>
          </li>
        </ul>
      </div>
    </div>
    <nav class="navbar navbar-expand-sm bg-white border-bottom">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">YENGJI</a>
        <button
          class="btn btn-light menu"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#demo"
        >
          <i class="bi bi-list"></i>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between">
          <ul class="navbar-nav me-auto nav-items-pc mb-2 mb-lg-0">
            <li class="nav-item">
              <a href="/" class="nav-link active">Store</a>
            </li>
            <li class="nav-item">
              <a href="/faq" class="nav-link">FAQ</a>
            </li>
          </ul>
          <!-- <div class="nb">
          </div> -->
          <div class="lang">
            <ul class="navbar-nav">
              <?php if (! \App\SessionGuard::isUserLoggedIn()) : ?>
                <li class="nav-item"><a class="nav-link" href="/login">Đăng nhập</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Đăng ký</a></li>
              <?php else : ?>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                          <?=$this->e(\App\SessionGuard::user()->name)?> <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu dropdown-menu-end modal h-auto w-auto">
                          <li>
                            <a class="dropdown-item" href="/profile">Thông tin tài khoản</a>
                          </li>
                          <li>
                              <a class="dropdown-item" href="/logout"
                                  onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                  Đăng xuất
                              </a>

                              <form id="logout-form" action="/logout" method="POST" style="display: none;">
                              </form>
                          </li>
                      </ul>
                  </li>
              <?php endif ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <?=$this->section("page")?>

    <footer class="footer">
      <div class="container d-flex justify-content-center align-items-center" style="height: 5rem;">
        <p class="text-muted my-0">Copyright &copy; 2022</p>
      </div>
    </footer>    

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <?=$this->section("page_specific_js")?>
</body>
</html>
