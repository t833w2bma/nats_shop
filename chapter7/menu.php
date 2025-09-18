<?php @session_start(); 
  if (!empty($_SESSION['customer'])) {
    $logdin = true; // bool
  }else{
    $logdin = false;
  }
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ナッツショップ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="product.php">商品一覧</a>
        </li>

        <??>
        <li class="nav-item">
          <a class="nav-link <?= $logdin ? '' : 'hidden' ?>" href="favorite-show.php">お気に入り</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item <?= $logdin ? '' : 'hidden' ?>" href="history.php">購入履歴</a></li>
            <li><a class="dropdown-item <?= $logdin ? '' : 'hidden' ?>" href="cart-show.php">カート</a></li>
            <li><a class="dropdown-item <?= $logdin ? '' : 'hidden' ?>" href="purchase-input.php">購入</a></li>
            <li><a class="dropdown-item <?= $logdin ? '' : 'hidden' ?>" href="customer-input.php">会員情報更新</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item <?= $logdin ? 'hidden' : '' ?>" href="login-input.php">ログイン</a></li>
            <li><a class="dropdown-item <?= $logdin ? '' : 'hidden' ?>" href="logout-output.php">ログアウト</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $logdin ? 'hidden' : '' ?>" href="customer-input.php">会員登録</a>
        </li>
      </ul>

      <div class="d-flex pe-2"><?=$logdin ? $_SESSION['customer']['name'].'さん' : '' ?></div>

      <form class="d-flex" role="search" action="product.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


<hr>
