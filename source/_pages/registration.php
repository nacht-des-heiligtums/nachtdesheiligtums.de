---
permalink: /anmeldung/registration.php
---
<?php

  $_c_filename = "jpq5laf2m9uodr2h3tl1veghn7c6lm08.csv";
  $_c_mailfrom = "anmeldung@nachtdesheiligtums.de";

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

    $_registration_type_nice = $type_single ? 'Einzelanmeldung' : $type_group_leader ? 'Gruppenverantwortlicher' : 'Gruppenteilnehmer';
    $_nutrition_habit_nice = $_nutrition_habit == 'vegetarian' ? 'Ja' : 'Nein';
    $_room_type_nice = $_room_type == 'dorm'
      ? 'Schlafsaal (Schlafack, Isomatte/Luftmatratze)'
      : $_room_type == 'double'
        ? 'Bett im Doppelzimmer (zzgl. 10 Euro/Nacht + bitte Schlafsack mitbringen)'
        : 'Einzelzimmer (zzgl. 20 Euro/Nacht + bitte Schlafsack mitbringen)';
    $_package_nice = $_package == 'package-a'
      ? 'Wochenende komplett (55 Euro)'
      : $_package == 'package-b'
        ? 'Wochende Samstagnachmittag bis Sonntagmittag (35 Euro)'
        : 'Wochenende ohne Übernachtung (45 Euro)';
    $_payment_method_nice = $_payment_method == 'cash' ? 'Bar' : 'Überweisung';

    $mail_to = $_email;
    $mail_subject = 'Anmeldebestätigung: Nacht des Heiligtums 2018';
    $mail_message = 'Hallo ' . $_first_name . ',' . "\r\n\r\n" .
                    'wir haben Deine Anmeldung zur Nacht des Heiligtums 2018 (31. August bis 02. September) erhalten und freuen uns darüber.' . "\r\n\r\n" .
                    'Deine Angaben:' . "\r\n" .
                    'Anmeldungstyp: ' . $_registration_type_nice . "\r\n" .
                    ($type_single ? '' : ('Gruppen-ID: ' . $_group_id . "\r\n")) .
                    'Vorname: ' . $_first_name . "\r\n" .
                    'Name: ' . $_last_name . "\r\n" .
                    ($type_group_participant ? '' : ('Straße / Nr.: ' . $_street . "\r\n")) .
                    ($type_group_participant ? '' : ('PLZ: ' . $_plz . "\r\n")) .
                    ($type_group_participant ? '' : ('Wohnort: ' . $_residence . "\r\n")) .
                    ($type_group_participant ? '' : ('Diözese: ' . $_diocese . "\r\n")) .
                    'Email: ' . $_email . "\r\n" .
                    ($type_group_participant ? '' : ('Telefonnummer: ' . $_phone . "\r\n")) .
                    'Geburtsdatum: ' . $_date_of_birth . "\r\n" .
                    'Vegetarier: ' . $_nutrition_habit_nice . "\r\n" .
                    'Übernachtung: ' . $_room_type_nice . "\r\n" .
                    'Paketwahl: ' . $_package_nice . "\r\n" .
                    ($type_group_participant ? "\r\n" : ('Bezahlmethode: ' . $_payment_method_nice . "\r\n\r\n")) .
                    'Du bist nun als Teilnehmer für die Nacht des Heiligtums 2018 registriert.' . "\r\n" .
                    'Wenn Du als Bezahlmethode die Überweisung gewählt hast, dann überweise den Teilnehmerbeitrag' . "\r\n" .
                    'bitte spätestens bis zum 20. August 2018 auf folgendes Konto:' . "\r\n\r\n" .
                    'Schönstattbewegung Deutschland e.V. - Nacht des Heiligtums' . "\r\n" .
                    'Kreditinstitut: Sparkasse Koblenz' . "\r\n" .
                    'IBAN: DE31 5705 0120 0000 1346 50' . "\r\n" .
                    'BIC: MALADE51KOB' . "\r\n" .
                    'Verwendungszweck: Gruppenname + Teilnehmername + NdH 2018' . "\r\n\r\n" .
                    'Noch nicht 18? Dann fülle bitte noch das Formular unter http://www.nachtdesheiligtums.de/anmeldung/anmeldeformular-pdf aus,' . "\r\n" .
                    'lass es von deinen Eltern unterschreiben und schicke es uns oder lege es uns spätestens beim Einchecken vor.' . "\r\n\r\n" .
                    'See you - wir sehen uns in Schönstatt!' . "\r\n\r\n" .
                    'Dein Kernteam';
    $mail_headers = 'From: ' . $_c_mailfrom . "\r\n" .
        'Reply-To: ' . $_c_mailfrom . "\r\n" .
        'Content-Type: text/plain; charset=UTF-8' . "\r\n" .
        'Content-Transfer-Encoding: 8bit' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($mail_to, $mail_subject, $mail_message, $mail_headers);
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
