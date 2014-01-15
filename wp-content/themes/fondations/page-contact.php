<?php
/*
Template Name: Contact
*/
get_header();
the_post();

// "name", "day", "month" & "year" are protected POST names
include('mail.php');
?>
<div class="content">
  <?php //the_content(); ?>

  <form id="contact_form" class="" action="/contact" method="POST">
    <fieldset>
      <ul>
        <li>
          <label for="email">Name</label>
          <input type="text" id="email" name="email" placeholder="Georges Abitbol" />
        </li>
        <li>
          <label for="lastname">Email</label>
          <input type="email" id="lastname" name="lastname" placeholder="g.abitbol@laclasse.us" />
        </li>
        <li>
          <label for="message">Your message</label>
          <textarea id="message" name="message" rows="7" cols="20">Écoute moi bien mon p'tit José. Tu baises les ménagères, bien, tu dois avoir le cul qui brille. Mais c'est pas ça qu'on appelle la classe.</textarea>
        </li>
      </ul>
    </fieldset>
    <ul>
      <li>
        <button type="submit">Envoyer</button>
      </li>
    </ul>
  </form>
</div>

<?php
get_footer();