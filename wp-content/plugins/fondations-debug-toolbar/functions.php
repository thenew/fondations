<?php
function fon_debug_toolbar(){
  if(WP_DEBUG):
  ?>
    <div class="fon_debug_toolbar">
      <ul class="options cf">
        <?php if(defined('FONDATIONS_VERSION') && FONDATIONS_VERSION): ?>
          <li class="is_link logo"><a href="<?php echo site_url('/wp-admin', 'admin'); ?>"><code><?php echo FONDATIONS_VERSION; ?></code></a></li>
        <?php endif; ?>
        <li class="template"><code><?php echo fon_get_template(); ?></code></li>
        <li class="queries"><?php echo get_num_queries(); ?></li>
        <li class="timer"><?php echo timer_stop($display = 0, $precision = 2).'s'; ?></li>
        <li class="is_link user">
          <?php 
          // TODO: absolute url or relative url for the redirect
          $fon_current_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
          if (is_user_logged_in()){
            global $current_user, $user_login;
            get_currentuserinfo();
            // roles
            $user_roles = '';
            foreach ($current_user->roles as $role) {
              if($user_roles == '')
                $user_roles = $role;
              else
                $user_roles .= ', '.$role;
            }
            echo '<a href="'.wp_logout_url($_SERVER["REQUEST_URI"]).'" rel="tooltip" title="Role(s) : '.$user_roles.'">
              '.$user_login.'
            </a>';
          } else {
            echo '<a href="'.wp_login_url($_SERVER["REQUEST_URI"]).'">not logged in</a>';
          }
          ?>
        </li>
        <li class="search" rel="tooltip" data-original-title="codex">
          <form class="codex-search" target="_blank" name="search" action="http://codex.wordpress.org/index.php?title=Special:Search" method="get">
            <input type="text" name="search" id="fon_dbar_search"/>
          </form>
        </li>
      </ul>
      <?php $debug_log = fon_debug_log();?>
    </div>
    <?php
  endif;
}

function fon_get_template(){
  // http://wordpress.stackexchange.com/questions/10537/get-name-of-the-current-template-file
  global $template;
  $template_file = basename($template);
  return $template_file;
}

/*
 * Display the debug.log file (wp-content folder) in the footer
 */
function fon_debug_log(){
  if(WP_DEBUG && WP_DEBUG_LOG){
    $debug_file = ABSPATH.'wp-content/debug.log';
    if(file_exists($debug_file) && file_get_contents($debug_file) != "") {

      // delete
      if(isset($_GET['fon_debug_log']) && 'delete' == $_GET['fon_debug_log']){
        if(unlink($debug_file)) {
          die;
        } else {
          echo "Error: File could not be deleted";
        }
      }

      $debug_log = file_get_contents($debug_file);
      preg_match_all("#PHP (Parse error|Fatal error|Notice|Warning):  (.+)\n#", $debug_log, $results);
      ?>
      <div class="fon_debug_log" id="fon_debug_log">
        <?php // Delete button ?>
        <div class="actions">
          <form id="fon_debug_log_form" name="fon_debug_log" class="delete" action="" method="get">
            <input type="hidden" name="fon_debug_log" value="delete" />
            <button class="btn btn-danger btn-delete">Vider les logs</button>
          </form>
          <?php // Trigger modal ?>
          <a href="#fon_modal_log" data-toggle="modal" class="btn display">Afficher logs</a>
        </div>
        <ol class="linenums">
        <?php // change order : from newest to oldest
        $results[2] = array_reverse($results[2]);
        $bug_n = '';
        foreach ($results[2] as $key => $bug) {
          // avoid duplication
          if($bug_n != $bug){
            $bug_n = $bug;
            // add classes
            $error_type = $results[1][$key];
            $error_class = '';
            $error_class = ('Fatal error' == $error_type)? 'fatal-error':'error-type';
            echo '<li><pre><span class="'.$error_class.'">'.$results[1][$key].'</span> '.$bug.'</pre></li>';
          }
        } ?>
        </ol>
      </div>
      <?php
      return $debug_log;
    } // end if file exists

  }
}