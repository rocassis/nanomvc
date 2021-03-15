<?php if (!defined('ABSPATH')) exit; ?>

<?php
require_once(VIEWS . '_includes/header.php');
require_once(VIEWS . '_includes/menu.php');
?>

<div class="wrap">

  <p>Hello <br>
    Home page of NanoMVC a extremely lightweight MVC framework</p>

  <br>
  <?php foreach($users as $u){
    echo '<p>'. $u['user_name'] .' | '. $u['user_permissions'] . '</p>';
  } ?>

</div> <!-- .wrap -->

<?php require_once(VIEWS . '_includes/footer.php');  ?>