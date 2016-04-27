<?php
class abn_wordpress {

    var $style_name = 'juicycafe-style';
    var $bug_link_setup = true;
    var $bug_link_info = array(
      'form-id' => '1U_Cw1lJCtgiEcc8-KU1BJUxQkpZdw5CmR7z14GN1pt4',
      'user' => '624350126',
      'url' => '1812251945',
      'agent' => '1346188628',
    );


    function abn_wordpress($env='prod') {
      //Turning Emojis off
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      remove_action( 'admin_print_styles', 'print_emoji_styles' );

      //Adding page specific style sheets
      add_filter( 'template_include', array( $this, 'var_template_include'), 1000 );
      add_action( 'wp_enqueue_scripts', array( $this, 'page_based_style'), 1000 );

      if($env === 'dev') {
        add_action( 'wp_footer', $this->bug_link());
      }
    }

    public function setup_bug_link($formID, $user, $url, $agent) {
      $this->bug_link_setup = true;
      $this->$bug_link_info['form-id'] = $formID;
      $this->$bug_link_info['user'] = $user;
      $this->$bug_link_info['url'] = $url;
      $this->$bug_link_info['agent'] = $agent;
    }
    private function bug_link() {
      if($this->bug_link_setup && !is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
        $current_user = wp_get_current_user();
        echo '<a style="position:fixed;bottom:0;right:1%;display;block;background: #FFF;color:#000;padding: 1.5% 3% 1% 3%;text-decoration:none;border:1px solid #000;border-bottom:none;opacity:0.5;border-top-left-radius:10px;border-top-right-radius:10px;z-index:10" href="https://docs.google.com/forms/d/'.$this->bug_link_info['form-id'].'/viewform?entry.'.$this->bug_link_info['user'].'='. urlencode($current_user->display_name).'&entry.'.$this->bug_link_info['url'].'='. urlencode('http://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]) .'&entry.1316165924=&entry.1995983033&entry.'.$this->bug_link_info['agent'].'='. urlencode($_SERVER['HTTP_USER_AGENT']) .'" target="_blank"><span class="dashicons dashicons-flag"></span> Bug Report</a>';
      }
    }

    public function var_template_include($t) {
      $GLOBALS['current_theme_template'] = basename($t);
      return $t;
    }

    public function page_based_style() {
      if( isset( $GLOBALS['current_theme_template'] ) ) {
        $templateFile = str_replace('.php', '.css', $GLOBALS['current_theme_template']);

        if(file_exists(get_template_directory().'/css/'.$templateFile)) {
          $styles = file_get_contents(get_template_directory().'/css/'.$templateFile);
          $styles = preg_replace('/url\((.+?)\)/','url('.get_stylesheet_directory_uri().'/\1)',$styles);
          wp_add_inline_style( $this->style_name, $styles );
        }
      }
    }
}






?>
