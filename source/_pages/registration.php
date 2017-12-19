---
permalink: /anmeldung/registration.php
---
<?php
    $_c_filename = "jpq5laf2m9uodr2h3tl1veghn7c6lm08";

    $_registration_type = $_POST['registration-type'];
    $_group_id = $_POST['group-id'];
    $_first_name = $_POST['first-name'];
    $_last_name = $_POST['last-name'];
    $_street = $_POST['street'];
    $_plz = $_POST['plz'];
    $_residence = $_POST['residence'];
    $_diocese = $_POST['diocese'];
    $_email = $_POST['email'];
    $_phone = $_POST['phone'];
    $_date_of_birth = $_POST['date-of-birth'];
    $_nutrition_habit = $_POST['nutrition-habit'];
    $_room_type = $_POST['room-type'];
    $_package = $_POST['package'];
    $_payment_method = $_POST['payment-method'];

    $_file = NULL;
    if (!file_exists($_c_filename)) {
      $_file = fopen($_c_filename, "w");
      fputcsv($_file, array(
        "registration-type",
        "group-id",
        "first-name",
        "last-name",
        "street",
        "plz",
        "residence",
        "diocese",
        "email",
        "phone",
        "date-of-birth",
        "nutrition-habit",
        "room-type",
        "package",
        "payment-method"
      ));
    }
    else {
      $_file = fopen($_c_filename, "a");
    }

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
?>
