<?
$title = 'Marsh Lane Day Nursery LTD - Contact Us';
include_once('templates/headingScroll.php');
?>

<div class="content">
<h1>Contact Us</h1>
<div class="contactUsForm">
<table class="hoursTbl"><tr><td>We would love to hear from you.</br>Please fill out this form and</br>we will get back to you as soon as possible.</td></tr></table>
<hr style="width:80%; color:#4196E1;">
<table class="hoursTbl"><tr><td><p class="openingHoursHeading">Opening<br>Hours</p></td><td><p class="days">Mon - Fri</p><p class="hours">8am - 6pm</td></table></div>
<div  class="contactUsForm">
    <form action="emailScript.php" method="POST">
      <input placeholder="Name" name="name" id="name" type="text" class="txtbox">
      <input placeholder="Email" name="email" id="email" type="text" class="txtbox">
      <select class="txtbox" id="subject" name="subject">
	  <option default>Please Select a Subject</option>
	  <option>I would like to arrange a viewing</option>
	  <option>I would like more information about your nursery</option>
	  </select>
      <textarea id="message" class="txtareaMessage" placeholder="Message" name="message"></textarea>
	  	<input class="navigationButton" value="Send" type="button">
	  	<input type="submit" />
    </form>
    </div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3554.467410881363!2d-2.6451284957263983!3d50.95353005653261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4872402643e4fa3d%3A0xec34c639e60cb241!2sMarsh+Lane+Day+Nursery+Ltd!5e0!3m2!1sen!2suk!4v1512638123048" 
width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<div class="footer">
</div>
<?
include_once('templates/footer.php');
?>
</body>
</html>