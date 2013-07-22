<?php 


if(isset($_SESSION['last_to_pay_amt']) && isset($_SESSION['last_to_pay_project']) && isset($_SESSION['last_to_pay_user'])){
  unset($_SESSION['last_to_pay_amt']);
  unset($_SESSION['last_to_pay_project']);
  unset($_SESSION['last_to_pay_user']);
  system_message('cancel success!');
  forward(REFERER);
}

?>