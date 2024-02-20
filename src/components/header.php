<header class="header">
  <div class="header__content">
    <button id="openSidebar"><i class="fas fa-bars"></i></button>
  </div>
  <div class="logout">
    <a href="../../query/Signin/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
  </div>
</header>

<!-- Sidebar -->
<div id="sidebar">
  <div class="close__container">
    <button id="closeSidebar"><i class="fas fa-times"></i></button>
  </div>
  <h2 class="sidebar__title">Dashboard <span><img src="../../assets/gope-logo.png" alt="GoPE logo"></span></h2>
  <div class="sidebar__profile-info">
    <p><?php echo $_SESSION['name'] ?></p>
    <p class="type"><?php echo $_SESSION['type'] ?></p>
  </div>
  <ul class="sidebar__links">
    <?php if ($_SESSION['type'] === 'admin') : ?>
    <li><a href="../../../src/pages/Dashboard/usersList.php"> Users List</a></li>
    <li><a href="../../../src/pages/Dashboard/countriesList.php">Countries List</a></li>
    <li><a href="../../../src/pages/Guide/manualGuide.php">Guide</a></li>
    <?php else : ?>
    <li><a href="../../../src/pages/Dashboard/countriesList.php?id=<?php echo $_SESSION['id']; ?>">Countries list</a>
    </li>
    <li><a href="../../../src/pages/Guide/manualGuide.php">Guide</a></li>
    <?php endif; ?>
  </ul>
</div>

<!-- JavaScript to handle sidebar toggle -->
<script>
const openSidebarButton = document.getElementById('openSidebar');
const sidebar = document.getElementById('sidebar');

openSidebarButton.addEventListener('click', () => {
  sidebar.classList.add('open');
});

const closeSidebarButton = document.getElementById('closeSidebar');

closeSidebarButton.addEventListener('click', () => {
  sidebar.classList.remove('open');
});
</script>