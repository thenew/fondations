<?php

function fon_pagination(){
  global $wp_query;
  $total_pages = $wp_query->max_num_pages;
  if($total_pages > 1){
    $current_page = max(1, get_query_var('paged'));

    echo '<div class="cssn_pagination fon-pagination">';
      echo paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => 'page/%#%',
        'current' => $current_page,
        'total' => $total_pages,
        'type' => 'list',
        'prev_text' => __('Prev'),
        'next_text' => __('Next')
      ));
    echo '</div>';
  }
}

function fon_get_attachment($page_id, $format) {
    query_posts('post_type=page&p='.$page_id);
    while (have_posts()) : the_post();
        $args = array( 
            'post_type' => 'attachment', 
            'numberposts' => 1, 
            'post_status' => null,
            'post_parent' => $post->ID 
        );
        $attachments = get_posts($args);
        if ($attachments) {
            foreach ($attachments as $attachment) {
                return wp_get_attachment_image($attachment->ID, $format);
            }
        }
    endwhile;
    wp_reset_query();
}

function fon_debug_toolbar(){
  if(WP_DEBUG):
  ?>
    <div class="fon_debug_toolbar">
      <ul class="options cf">
        <?php if(FONDATIONS_VERSION): ?>
          <li class="is_link logo"><a href="<?php echo site_url('/wp-admin', 'admin'); ?>"><code><?php echo FONDATIONS_VERSION; ?></code></a></li>
        <?php endif; ?>
        <li class="template"><code><?php echo fon_get_template(); ?></code></li>
        <li class="is_link queries"><a href="#fon_modal_queries" data-toggle="modal"><code><?php echo get_num_queries(); ?></code></a></li>
        <li class="timer"><code><?php echo timer_stop().' s'; ?></code></li>
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
              <code>'.$user_login.'</code>
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

    <?php // Modals ?>
<!--     <div id="fon_modal_log" class="modal hide fade in">
      <div class="modal-body">
        <pre>
          <?php echo $debug_log; ?>
        </pre>
      </div>
    </div> -->

<!--     <div id="fon_modal_queries" class="modal hide fade in">
      <div class="modal-body">
        <?php
        // global $wpdb;
        // if(SAVEQUERIES)
          // var_dump($wpdb->queries);
        ?>
      </div>
    </div> -->
    <?php
  endif;
}

add_action('init', 'fon_add_bootstrap_popover');
function fon_add_bootstrap_popover() {
  if (!is_admin()){
    wp_enqueue_script('fon_debug_toolbar',ASSETS_URL.'/js/fon_debug_toolbar.js', '','1.0',true);
  }
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
    if(file_exists($debug_file)) {
      // delete
      if(isset($_POST['fon_debug_log']) && 'delete' == $_POST['fon_debug_log']){
        if(unlink($debug_file)) {
          $_POST['fon_debug_log'] = '';
          unset($GLOBALS['_POST']['fon_debug_log']);
          die;
        } else {
          echo "Error: File could not be deleted";
        }
      }

      $debug_log = file_get_contents($debug_file);
      preg_match_all("#PHP (Parse error|Fatal error|Notice|Warning):  (.+)\n#", $debug_log, $results);
      ?>
      <div class="fon_debug_log">
        <?php // Delete button ?>
        <div class="actions">
          <form name="fon_debug_log" class="delete" action="" method="post">
            <input type="hidden" name="fon_debug_log" value="delete" />
            <button class="btn btn-danger btn-delete">Vider les logs</button>
          </form>
          <?php // Trigger modal ?>
          <a href="#fon_modal_log" data-toggle="modal" class="btn display">Afficher logs</a>
        </div>
        <code>
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
              echo '<li><span class="'.$error_class.'">'.$results[1][$key].'</span> '.$bug.'</li>';
            }
          } ?>
          </ol>
        </code>
      </div>
      <?php
      return $debug_log;
    } // end if file exists

    // si il reste des _POST qui trainent
    if(isset($_POST['fon_debug_log'])){
      $_POST['fon_debug_log'] = '';
      unset($GLOBALS['_POST']['fon_debug_log']);
    }

  }
}
