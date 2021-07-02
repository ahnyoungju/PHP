<?php
    require_once('header.inc');
?>
<?php
    require_once('../bll/getLogin.php');
    /* Check Login */
    global $login;
    if( $login != true )
        require_once('nav_default.inc');
    else
        require_once('nav_login.inc');
?>
<div id="loader"></div>
<article id="contact" class="padding2 animate-bottom">
  <h3>Do you need more information? <br/>Complete the form below.</h3>
  <form target="_blank" onsubmit="window.open('about:blank','print_popup','width=500,height=800');">
    <label for="fname">First Name: </label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Last Name: </label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

    <label for="email">e-mail: </label>
    <input type="email" name="email" id="email" placeholder="Your e-mail address.."/>
    <label for="phone">Phone: </label>
    <input type="tel" name="phone" id="phone" placeholder="Your phone number.."/>

    <label for="country">State or Teritory:</label>
    <select id="country" name="country">
      <option value="NSW">New South Wales</option>
      <option value="QL">Queensland</option>
      <option value="SA">South Australia</option>
      <option value="TAS">Tasmania</option>
      <option value="VIC">Victoria</option>
      <option value="WA">Western Australia</option>
      <option value="ACT">Australian Capital Territory</option>
      <option value="NT">Northen Territory</option>
    </select>

    <p class="chkbx">I would like more information about:</p>
    <ul>
      <li><input type="checkbox" name="database" id="database" class="chkbx"/>Database</li>
      <li><input type="checkbox" name="network" id="network" class="chkbx"/>Network</li>
      <li><input type="checkbox" name="security" id="security" class="chkbx"/>Security</li>
    </ul>
    <label for="question">Question?</label>
    <textarea id="question" name="question" placeholder="Write something.." style="height:50px"></textarea>

    <input type="submit" value="Submit">
    <input type="reset" id="reset" value="Reset" class="btn" />

  </form>
</article>
<section id="locationDetails">
  <p>We are located at:<br>
  [MELBOURNE] 153 S. Oak Ave. Melbourn, VIC 4186</p>
  [SYDNEY]   1123 Sturt street Sydney, NSW 2186</p>
  <p>Phone Number: <a class="mobile" href="tel:1759486387">(1759) 486-3i87</a>
  <p>Email Address: <a href="mailto:r.mcleod@mcmillanit.com" class="contact">r.mcleod@mcmillanit.com</a></p>
</section>

<?php
  require('footer.inc');
?>
