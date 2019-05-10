---
layout: page
title: Anmeldung
permalink: /anmeldung/
---

{%comment%}
<section class="section">
  <div class="container">
    <p>
      Leider gibt es im Moment technische Probleme bei der Anmeldung auf unserer Homepage. Unsere Techniker arbeiten mit Hochdruck daran das Problem zu lösen. Wir bitten euch daher euch erst einmal nicht anzumelden. Wir geben euch auf WhatsApp und Facebook bescheid, sobald das Problem behoben ist.
      Für alle die sich schon angemeldet und eine Bestätigungsmail bekommen haben ist alles in Ordnung. Falls ihr nach der Anmeldung keine Bestätigungsmail bekommen habt, habt noch ein bisschen Geduld, ihr hört bald von uns.
      Falls ihr zu eurer Anmeldung noch Fragen habt, erreicht ihr uns über Facebook,WhatsApp oder per Mail unter info(at)nachtdesheiligtums.de
    </p>
  </div>
</section>
{%endcomment%}

<form id="registration-form" class="container registration-form" method="post" action="https://registrierung.nachtdesheiligtums.de/registration.php" onsubmit="return onRegistrationSubmit(this)">
  <div class="box">
    <p class="help">Mit * markierte Felder sind erforderlich</p>
    <div class="field is-horizontal">
      <div class="field-label is-normal"><label class="label">Anmeldungstyp</label></div>
      <div class="field-body">
        <div class="select is-fullwidth">
            <select name="registration-type" id="registration-type-field" onchange="onRegistrationTypeChange()">
              <option value="single">Einzelanmeldung</option>
              <option value="group-leader">Gruppenverantwortlicher</option>
              <option value="group-participant">Gruppenteilnehmer</option>
            </select>
        </div>
      </div>
    </div>
    <div class="field is-horizontal is-removed" id="group-id">
      <div class="field-label is-normal"><label class="label">Gruppen-ID*</label></div>
      <div class="field-body">
        <input name="group-id" id="group-id-field" class="input" type="text" placeholder="Gruppe">
        <p class="help">Ein Name für deine Gruppe (bspw. "SMJ Augsburg"). Mit diesem können später auch weitere Gruppenteilnehmer angemeldet werden.</p>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal"><label class="label">Vorname*</label></div>
      <div class="field-body">
        <input name="first-name" class="input" type="text" placeholder="Vorname">
        <p class="help is-danger is-removed" id="first-name-validation">Dieses Feld ist erforderlich. Bitte nur Buchstaben, Leerzeichen und Bindestriche verwenden.</p>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal"><label class="label">Name*</label></div>
      <div class="field-body">
        <input name="last-name" class="input" type="text" placeholder="Name">
        <p class="help is-danger is-removed" id="last-name-validation">Dieses Feld ist erforderlich. Bitte nur Buchstaben, Leerzeichen und Bindestriche verwenden.</p>
      </div>
    </div>
    <div class="field is-horizontal" id="street">
      <div class="field-label is-normal"><label class="label">Straße / Nr.*</label></div>
      <div class="field-body">
        <input name="street" class="input" type="text" placeholder="Straße / Hausnummer">
        <p class="help is-danger is-removed" id="street-validation">Dieses Feld ist erforderlich. Bitte nur Buchstaben, Leerzeichen und Bindestriche und Zahlen verwenden.</p>
      </div>
    </div>
    <div class="field is-horizontal" id="plz">
      <div class="field-label is-normal"><label class="label">PLZ*</label></div>
      <div class="field-body">
        <input name="plz" class="input" type="number" placeholder="PLZ">
        <p class="help is-danger is-removed" id="plz-validation">Dieses Feld ist erforderlich. Bitte nur Zahlen verwenden.</p>
      </div>
    </div>
    <div class="field is-horizontal" id="residence">
      <div class="field-label is-normal"><label class="label">Wohnort*</label></div>
      <div class="field-body">
        <input name="residence" class="input" type="text" placeholder="Wohnort">
        <p class="help is-danger is-removed" id="residence-validation">Dieses Feld ist erforderlich. Bitte nur Buchstaben, Leerzeichen und Bindestriche verwenden.</p>
      </div>
    </div>
    <div class="field is-horizontal" id="diocese">
      <div class="field-label is-normal"><label class="label">Diözese*</label></div>
      <div class="field-body">
        <input name="diocese" class="input" type="text" placeholder="Diözese">
        <p class="help is-danger is-removed" id="diocese-validation">Dieses Feld ist erforderlich. Bitte nur Buchstaben, Leerzeichen und Bindestriche verwenden.</p>
      </div>
    </div>
    <div class="field is-horizontal" id="email">
      <div class="field-label is-normal"><label class="label">Email*</label></div>
      <div class="field-body">
        <input name="email" class="input" type="email" placeholder="Email">
        <p class="help is-danger is-removed" id="email-validation">Dieses Feld ist erforderlich. Bitte verwende eine gültige Email-Adresse.</p>
      </div>
    </div>
    <div class="field is-horizontal" id="phone">
      <div class="field-label is-normal"><label class="label">Telefonnummer*</label></div>
      <div class="field-body">
        <input name="phone" class="input" type="tel" placeholder="Telefonnummer">
        <p class="help is-danger is-removed" id="phone-validation">Dieses Feld ist erforderlich. Bitte nur Zahlen verwenden.</p>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal"><label class="label">Geburtsdatum*</label></div>
      <div class="field-body">
        <input name="date-of-birth" class="input" type="date" value="" max="2019-01-01" placeholder="Geburtsdatum">
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal"><label class="label">Vegetarier</label></div>
      <div class="field-body">
        <div class="select is-fullwidth">
            <select name="nutrition-habit">
              <option value="default">Nein</option>
              <option value="vegetarian">Ja</option>
            </select>
        </div>
      </div>
    </div>
    <div class="field is-horizontal" id="room-type">
      <div class="field-label is-normal"><label class="label">Übernachtung</label></div>
      <div class="field-body">
        <div class="select is-fullwidth">
            <select name="room-type">
              <option value="dorm">Schlafsaal (Schlafack, Isomatte/Luftmatratze)</option>
              <option value="double">Bett im Doppelzimmer (zzgl. 10 Euro/Nacht + bitte Schlafsack mitbringen)</option>
              <option value="single">Einzelzimmer (zzgl. 20 Euro/Nacht + bitte Schlafsack mitbringen)</option>
            </select>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal"><label class="label">Paketwahl</label></div>
      <div class="field-body">
        <div class="select is-fullwidth">
            <select name="package" id="package-field" onchange="onPackageChange()">
              <option value="package-a">Wochenende komplett (58 Euro)</option>
              <option value="package-b">Wochende Samstagnachmittag bis Sonntagmittag (35 Euro)</option>
              <option value="package-c">Wochenende ohne Übernachtung (45 Euro)</option>
              <!--option value="help-week" id="help-week">Teilnahme an der Helferwoche (103 Euro)</option-->
            </select>
        </div>
      </div>
    </div>
    <div class="field is-horizontal" id="payment-method">
      <div class="field-label is-normal"><label class="label">Bezahlmethode</label></div>
      <div class="field-body">
        <div class="select is-fullwidth">
            <select name="payment-method">
              <option value="transfer">Überweisung</option>
              <option value="cash">Bar (zzgl. 3 Euro)</option>
            </select>
        </div>
      </div>
    </div>
    <div class="field is-grouped is-grouped-centered"><div class="control"><button class="button is-link" id="submit" name="submit" type="submit">Absenden</button></div></div>
    <p class="help is-danger is-removed" id="registration-validation">Die Anmeldung konnte nicht erfolgreich abgeschlossen werden.<br />Stelle sicher, dass alle erforderlichen Felder ausgefüllt sind.</p>
    <p class="help is-danger is-removed" id="registration-validation-error">Die Anmeldung konnte aufgrund eines Fehlers nicht erfolgreich abgeschlossen werden.<br />Bitte versuche es später noch einmal.</p>
  </div>
</form>

<div class="container registration-form">
  <p>
    Hast du Probleme bei der Anmeldung? Dann schreibe uns einfach an info(at)nachtdesheiligtums.de
  </p>
</div>

<a href="{{ "anmeldung/einverständniserklärung" | relative_url }}">Einverständniserklärung</a>

<div id="registration-finished" class="registration-form container is-removed">
  <div class="box content">
    <p>Deine Anmeldung wurde erfolgreich abgeschickt. Du solltest in kürze eine Email zur Bestätigung erhalten.</p>
    <p><a href="{{ site.baseurl }}{% link _pages/anmeldung.md %}" onclick="return resetRegistration()">Weitere Anmeldung</a></p>
    <p><a href="{{ site.baseurl }}{% link index.md %}">Zurück zur Startseite</a></p>
  </div>
</div>


<script>
function onRegistrationTypeChange() {
   var registrationType = document.getElementById('registration-type-field').value;

   if (registrationType === 'single') {
     document.getElementById('group-id').classList.add('is-removed');
     document.getElementById('help-week').classList.remove('is-removed');
   } else {
     document.getElementById('group-id').classList.remove('is-removed');
     document.getElementById('help-week').classList.add('is-removed');

     var package_field = document.getElementById('package-field');
     if (package_field.value === 'help-week') {
       package_field.value = 'package-a';
     }
   }

   if (registrationType === 'group-participant') {
     document.getElementById('street').classList.add('is-removed');
     document.getElementById('plz').classList.add('is-removed');
     document.getElementById('residence').classList.add('is-removed');
     document.getElementById('diocese').classList.add('is-removed');
     //document.getElementById('email').classList.add('is-removed');
     document.getElementById('phone').classList.add('is-removed');
     document.getElementById('payment-method').classList.add('is-removed');
   } else {
     document.getElementById('street').classList.remove('is-removed');
     document.getElementById('plz').classList.remove('is-removed');
     document.getElementById('residence').classList.remove('is-removed');
     document.getElementById('diocese').classList.remove('is-removed');
     //document.getElementById('email').classList.remove('is-removed');
     document.getElementById('phone').classList.remove('is-removed');
     document.getElementById('payment-method').classList.remove('is-removed');
   }
}

function onPackageChange() {
   var package_field = document.getElementById('package-field').value;

   if (package_field === 'help-week') {
     document.getElementById('room-type').classList.add('is-removed');
   } else {
     document.getElementById('room-type').classList.remove('is-removed');
   }
}

function onRegistrationSubmit(_form) {
  try {
    document.getElementById('submit').classList.add('is-loading');
    document.getElementById('registration-validation-error').classList.add('is-removed');

    var url = _form.action;
    var xhr = new XMLHttpRequest();

    // [].fn.call(form.elements, ...) allows us to call .fn
    // on the form's elements, even though it's not an array.
    var params = [].map.call(_form.elements, function(el) {
        // Map each field into a name=value string, make sure to properly escape!
        return encodeURIComponent(el.name) + '=' + encodeURIComponent(el.value);
    }).join('&'); // Then join all the strings by &

    xhr.open("POST", url);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //.bind ensures that this inside of the function is the XHR object.
    xhr.onload = onRegistrationSubmitCallback.bind(xhr);

    //All preperations are clear, send the request!
    xhr.send(params);
  } catch(_error) {
    console.log(_error.message);
    document.getElementById('submit').classList.remove('is-loading');
    document.getElementById('registration-validation-error').classList.remove('is-removed');
  }

  return false;
}

function onRegistrationSubmitCallback(_xhr) {
  try {
    document.getElementById('submit').classList.remove('is-loading');
    var validation = JSON.parse(_xhr.currentTarget.responseText);

    if (validation['registration'] === true) {
      document.getElementById('registration-form').classList.add('is-removed');
      document.getElementById('registration-finished').classList.remove('is-removed');
    } else {
      for (var key in validation) {
        // skip loop if the property is from prototype
        if (!validation.hasOwnProperty(key)) continue;

        var valid = validation[key] === true;

        // your code
        var elements = document.getElementsByName(key);
        if (elements.length != 0) {
          if (valid) {
            elements[0].classList.remove('is-danger');
          } else {
            elements[0].classList.add('is-danger');
          }
        }

        var validationElement = document.getElementById(key + '-validation');
        if (validationElement) {
          if (valid) {
            validationElement.classList.add('is-removed');
          } else {
            validationElement.classList.remove('is-removed');
          }
        }
      }
    }
  } catch(_error) {
    console.log(_error.message + ", " + _xhr.currentTarget.responseText);
    document.getElementById('registration-validation-error').classList.remove('is-removed');
  }
}

function resetRegistration() {
  document.getElementById('registration-form').classList.remove('is-removed');
  document.getElementById('registration-finished').classList.add('is-removed');

  var registrationType = document.getElementById('registration-type-field').value;
  if (registrationType === 'single') {
    document.getElementById('registration-form').reset();
  } else {
    var groupID = document.getElementById('group-id-field').value;
    document.getElementById('registration-form').reset();
    document.getElementById('registration-type-field').value = 'group-participant';
    document.getElementById('group-id-field').value = groupID;
    onRegistrationTypeChange();
  }

  return false;
}

</script>
