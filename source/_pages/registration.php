---
permalink: /anmeldung/registration.php
---
<?php

  $_c_filename = "jpq5laf2m9uodr2h3tl1veghn7c6lm08.csv";

  $_registration_type = getPostInput('registration-type');
  $_group_id = getPostInput('group-id');
  $_first_name = getPostInput('first-name');
  $_last_name = getPostInput('last-name');
  $_street = getPostInput('street');
  $_plz = getPostInput('plz');
  $_residence = getPostInput('residence');
  $_diocese = getPostInput('diocese');
  $_email = getPostInput('email');
  $_phone = getPostInput('phone');
  $_date_of_birth = getPostInput('date-of-birth');
  $_nutrition_habit = getPostInput('nutrition-habit');
  $_room_type = getPostInput('room-type');
  $_package = getPostInput('package');
  $_payment_method = getPostInput('payment-method');

  // validate
  $type_single = $_registration_type == 'single';
  $type_group_leader = $_registration_type == 'group-leader';
  $type_group_participant = $_registration_type == 'group-participant';

  $valid_registration_type = (boolean)isValidRequired($_registration_type);
  $valid_group_id = $type_single || (boolean)isValidRequired($_group_id);
  $valid_first_name = (boolean)isValidName($_first_name);
  $valid_last_name = (boolean)isValidName($_last_name);
  $valid_street = $type_group_participant || (boolean)isValidStreet($_street);
  $valid_plz = $type_group_participant || (boolean)isValidNumber($_plz);
  $valid_residence = $type_group_participant || (boolean)isValidName($_residence);
  $valid_diocese = $type_group_participant || (boolean)isValidName($_diocese);
  $valid_email = (boolean)isValidEmail($_email);
  $valid_phone = $type_group_participant || (boolean)isValidPhone($_phone);
  $valid_date_of_birth = (boolean)isValidRequired($_date_of_birth);
  $valid_nutrition_habit = (boolean)isValidRequired($_nutrition_habit);
  $valid_room_type = (boolean)isValidRequired($_room_type);
  $valid_package = (boolean)isValidRequired($_package);
  $valid_payment_method = (boolean)isValidRequired($_payment_method);

  $valid_overall = $valid_registration_type
    && $valid_group_id
    && $valid_first_name
    && $valid_last_name
    && $valid_street
    && $valid_plz
    && $valid_residence
    && $valid_diocese
    && $valid_email
    && $valid_phone
    && $valid_date_of_birth
    && $valid_nutrition_habit
    && $valid_room_type
    && $valid_package
    && $valid_payment_method;

  if ($valid_overall) {
    $_file = createOrOpenFile($_c_filename);

    fputcsv($_file, array(
      $_registration_type,
      $_group_id,
      $_first_name,
      $_last_name,
      $_street,
      $_plz,
      $_residence,
      $_diocese,
      $_email,
      $_phone,
      $_date_of_birth,
      $_nutrition_habit,
      $_room_type,
      $_package,
      $_payment_method
    ));

    fclose($_file);
  }

  $validation = array(
    'registration' => $valid_overall,
    'registration-type' => $valid_registration_type,
    'group-id' => $valid_group_id,
    'first-name' => $valid_first_name,
    'last-name' => $valid_last_name,
    'street' => $valid_street,
    'plz' => $valid_plz,
    'residence' => $valid_residence,
    'diocese' => $valid_diocese,
    'email' => $valid_email,
    'phone' => $valid_phone,
    'date-of-birth' => $valid_date_of_birth,
    'nutrition-habit' => $valid_nutrition_habit,
    'room-type' => $valid_room_type,
    'package' => $valid_package,
    'payment-method' => $valid_payment_method
  );

  echo json_encode($validation);

  //

  function getPostInput($_inputname) {
    return htmlspecialchars(stripslashes(trim($_POST[$_inputname])));
  }

  function validIf($_input, $_validate) {
    return $_validate ? $_input : TRUE;
  }

  function isValidRequired($_input) {
    return !empty($_input);
  }

  function isValidName($_input) {
    return preg_match("/^[\pL- ]+$/u", $_input);
  }

  function isValidStreet($_input) {
    return preg_match("/^[\pL- ]+[0-9]*$/u", $_input);
  }

  function isValidNumber($_input) {
    return preg_match("/^[0-9]+$/", $_input);
  }

  function isValidEmail($_input) {
    return filter_var($_input, FILTER_VALIDATE_EMAIL);
  }

  function isValidPhone($_input) {
    return preg_match("/^[+]?[0-9 ]+$/", $_input);
  }

  //

  function createOrOpenFile($_filename) {
    if (!file_exists($_filename)) {
      $_file = fopen($_filename, "w");
      fputcsv($_file, array(
        'registration-type',
        'group-id',
        'first-name',
        'last-name',
        'street',
        'plz',
        'residence',
        'diocese',
        'email',
        'phone',
        'date-of-birth',
        'nutrition-habit',
        'room-type',
        'package',
        'payment-method'
      ));
      return $_file;
    }
    else {
      return fopen($_filename, "a");
    }
  }
?>
