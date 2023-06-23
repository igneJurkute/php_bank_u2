<?php

switch ($alert) {

  case 0:
    echo "";
    break;

  case 1:
    echo '<div class="alert alert-success" role="alert">New account created.</div>';
    break;

  case 2:
    echo '<div class="alert alert-danger" role="alert">
    There are funds in the account. Cannot be deleted.</div>';
    break;

  case 3:
    echo '<div class="alert alert-success" role="alert">Account deleted.</div>';
    break;
    
  case 4:
    echo '<div class="alert alert-warning" role="alert">Not enough money.</div>';
    break;

  case 5:
    echo '<div class="alert alert-warning" role="alert">
    Name and surname must consist of at least three characters.</div>';
    break;

  case 6:
    echo '<div class="alert alert-warning" role="alert">ID-code must consist of 11 numbers.</div>';
    break;

  case 7:
    echo '<div class="alert alert-warning" role="alert">
    A user with this ID-code has already been entered.</div>';
    break;

  case 8:
    echo '<div class="alert alert-warning" role="alert">
    The amount entered must be a positive integer.</div>';
    break;
  
  case 9:
    echo '<div class="alert alert-success" role="alert">Funds added.</div>';
    break;

  case 10:
    echo '<div class="alert alert-success" role="alert">Funds withdrawn.</div>';
    break;

}