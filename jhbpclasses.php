<?php
/* jhbpclasses.php is part of the Book Previewer plugin for WordPress
 * 
 * This file is distributed as part of the Book Previewer plugin for WordPress
 * and is not intended to be used apart from that package. You can download
 * the entire Book Previewer plugin from the WordPress plugin repository at
 * http://wordpress.org/plugins/book-previewer/
 */

/* 
 * Copyright 2014	James R. Hanback, Jr.  (email : james@jameshanback.com)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

defined('ABSPATH') or die("Incorrect path");
class jhbpwidget extends WP_Widget {
    public $jhbpcountries = array (
                            'hy',
                            'bg',
                            'ca',
                            'zh-CN',
                            'zh-TW',
                            'hr',
                            'cs',
                            'da',
                            'nl',
                            'en',
                            'fil',
                            'fi',
                            'fr',
                            'de',
                            'el',
                            'hi',
                            'hu',
                            'is',
                            'id',
                            'in',
                            'it',
                            'ja',
                            'ko',
                            'lv',
                            'lt',
                            'no',
                            'pl',
                            'pt-BR',
                            'pt-PT',
                            'ro',
                            'ru',
                            'sr',
                            'sk',
                            'sl',
                            'es',
                            'sv',
                            'th',
                            'tr',
                            'uk',
                            'vi'
                            );
                            
    public function __construct() 
    {
	    parent::__construct(
		    'jhbp_widget', 
		    __('Book Preview','bookpreviewer'),
		    array( 'description' => __( 'Displays a Google Books preview of a title you specify.','bookpreviewer'), )
	    );
    }
    
    public function widget($args, $instance)
    {  
		$title      = apply_filters( 'widget_title', $instance['title'] );
		$jhbparray  = array('embedded','popup','link');

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		if( isset ($instance[ 'bookid' ]) )
		{
		    if(empty($instance['idtype']))
		    {
		        $instance['idtype'] = 'ISBN';
		    }
		    $jhbpscode = '[bookpreviewer idtype="' . strip_tags($instance['idtype']) . '" bookid="' . strip_tags($instance['bookid']) . '"';
		    if(($instance['width']!=0) && isset ($instance[ 'width' ]) )
		    {
		        $jhbpscode .= ' width="' . absint($instance[ 'width' ]) . '"';
		    }
		    if(($instance['height']!=0) && isset ($instance[ 'height' ]) )
		    {
		        $jhbpscode .= ' height="' . absint($instance[ 'height' ]) . '"';
		    }
            if(in_array($instance['previewer'],$jhbparray)) {
                $jhbpscode .= ' previewer="' . $instance['previewer'] . '"';
            }
            if(in_array($instance['language'],$this->jhbpcountries)) {
                $jhbpscode .= ' language="' . $instance['language'] . '"';
            }
            $jhbpscode .= "]";
		    echo do_shortcode($jhbpscode);
		}
		echo $args['after_widget'];
    }
    
    public function form($instance)
    {                       
		if ( isset( $instance[ 'title' ] ) ) 
		{
			$title = $instance[ 'title' ];
		}
		else 
		{
			$title = __( 'Book Preview', 'bookpreviewer' );
		}
		if ( isset( $instance[ 'idtype'] ) )
		{
		    $idtype = $instance['idtype'];
		}
		else
		{
		    $idtype = 'ISBN';
		}
		if ( isset( $instance[ 'bookid' ] ) ) 
		{
		    $bookid = $instance[ 'bookid' ];
		}
		else
		{
		    $bookid = '';
		}
		if ( isset( $instance[ 'width' ] ) ) 
		{
		    $width = $instance[ 'width' ];
		}
		else
		{
		    $width = '';
		}
		if ( isset( $instance[ 'height' ] ) ) 
		{
		    $height = $instance[ 'height' ];
		}
		else
		{
		    $height = '';
		}
		if ( isset( $instance[ 'previewer' ] ) ) 
		{
		    $previewer = $instance[ 'previewer' ];
		}
		else
		{
		    $previewer = 'embedded';
		}
		if ( isset( $instance[ 'language' ] ) ) 
		{
		    $language = $instance[ 'language' ];
		}
		else
		{
		    $language = 'en';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','bookpreviewer'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
 		<label for="<?php echo $this->get_field_id( 'idtype' ); ?>"><?php _e('ID Type:','bookpreviewer'); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'idtype' ); ?>" name="<?php echo $this->get_field_name( 'idtype' ); ?>">
        <option value="GGKEY" <?php echo (esc_attr($idtype)=='GGKEY') ? 'selected' : ''; ?>>GGKEY</option>
        <option value="ISBN" <?php echo (esc_attr($idtype)=='ISBN') ? 'selected' : ''; ?>>ISBN</option>
        <option value="OCLC" <?php echo (esc_attr($idtype)=='OCLC') ? 'selected' : ''; ?>>OCLC</option>
        <option value="LCCN" <?php echo (esc_attr($idtype)=='LCCN') ? 'selected' : ''; ?>>LCCN</option>
        </select>
 		<label for="<?php echo $this->get_field_id( 'bookid' ); ?>"><?php _e('ID:','bookpreviewer'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'bookid' ); ?>" name="<?php echo $this->get_field_name( 'bookid' ); ?>" type="text" value="<?php echo esc_attr( $bookid ); ?>">
 		<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width (in pixels):','bookpreviewer'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>">
 		<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height (in pixels):','bookpreviewer' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>">
 		<label for="<?php echo $this->get_field_id( 'previewer' ); ?>"><?php _e('Previewer:','bookpreviewer'); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'previewer' ); ?>" name="<?php echo $this->get_field_name( 'previewer' ); ?>">
        <option value="embedded" <?php echo (esc_attr($previewer)=='embedded') ? 'selected' : ''; ?>>Embedded</option>
        <option value="popup" <?php echo (esc_attr($previewer)=='popup') ? 'selected' : ''; ?>>Popup</option>
        <option value="link" <?php echo (esc_attr($previewer)=='link') ? 'selected' : ''; ?>>Link</option>
        </select>
 		<label for="<?php echo $this->get_field_id( 'language' ); ?>"><?php _e('Language:','bookpreviewer'); ?></label>
        <select class="widefat" id="<?php echo $this->get_field_id( 'language' ); ?>" name="<?php echo $this->get_field_name( 'language' ); ?>">
        <?php
        foreach ($this->jhbpcountries as $jhbpcountry)
        {
        ?><option value="<?php echo $jhbpcountry;?>" <?php echo (esc_attr($language)==$jhbpcountry) ? 'selected' : '';?>><?php echo $jhbpcountry; ?></option>
        <?php } ?>
        </select>
		</p>
		<?php 
    }
    
    public function update($new_instance, $old_instance)
    {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['idtype'] = ( ! empty( $new_instance['idtype'] ) ) ? strip_tags( $new_instance['idtype'] ) : '';
		$instance['bookid']  = ( ! empty( $new_instance['bookid'] ) ) ? strip_tags( $new_instance['bookid'] ) : '';
		$instance['width']  = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['height']  = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';
		$instance['previewer']  = ( ! empty( $new_instance['previewer'] ) ) ? strip_tags( $new_instance['previewer'] ) : '';
		$instance['language']  = ( ! empty( $new_instance['language'] ) ) ? strip_tags( $new_instance['language'] ) : '';
		return $instance;
    }
    
}

class jhbookpreviewer 
{
    public $jhbpcacheexpire = 12;
    public $jhbpclearcache  = 0;
    public $jhbpdefer       = 0;
    public $jhbpagree       = 1;
    public $jhbpresponsive  = 0;
    public $jhbpatts        = array();
    public $jhbpidtypes     = array (
                              'ISBN',
                              'OCLC',
                              'LCCN',
                              'GGKEY'
                              );
          
    public $jhbpcountries = array (
                            'hy',
                            'bg',
                            'ca',
                            'zh-CN',
                            'zh-TW',
                            'hr',
                            'cs',
                            'da',
                            'nl',
                            'en',
                            'fil',
                            'fi',
                            'fr',
                            'de',
                            'el',
                            'hi',
                            'hu',
                            'is',
                            'id',
                            'in',
                            'it',
                            'ja',
                            'ko',
                            'lv',
                            'lt',
                            'no',
                            'pl',
                            'pt-BR',
                            'pt-PT',
                            'ro',
                            'ru',
                            'sr',
                            'sk',
                            'sl',
                            'es',
                            'sv',
                            'th',
                            'tr',
                            'uk',
                            'vi'
                            );
    
    // Google Books branding host
    public $jhbpphost = "www.google.com/intl/";
    
    // Google Books branding button
    public $jhbppbutton = "/googlebooks/images/gbs_preview_button1.png";
   
    public function jhbpdonatelink($links,$file)
    {
        // Code based on codex.wordpress.org/Plugin_API/Filter_Reference/plugin_row_meta
        if(strpos($file, 'book-previewer.php') !== false)
        {
            $jhbpdonatelinks = array(
                               '<a href="http://www.timetides.com/donate" target="_blank">Donate</a>'
                               );
            $links = array_merge($links, $jhbpdonatelinks);
        }
        return $links;
    }
     
    public function jhbpgetpagetype()
    {
        global $post;
        $jhbpgoodpage = FALSE;
        
        if(is_home() || is_front_page() || is_active_widget( false, false, 'jhbp_widget', true)) {
            $jhbpgoodpage = TRUE;
        } elseif (is_single() || is_page()) {
            if(has_shortcode($post->post_content,'bookpreviewer'))
            {
                $jhbpgoodpage = TRUE;
            }
        }
        
        return $jhbpgoodpage;
    }

    public function jhbploadlocal()
    {
        load_plugin_textdomain('bookpreviewer',false,basename(dirname(__FILE__)).'/lang');
    }

    public function jhbploadinfooter()
    {
        $jhbpinfooter = ($this->getdeferload()==1) ? true : false;
        return $jhbpinfooter;
    }
 
    public function jhbploadscripts()
    {   
        // Load scripts/stylesheet if required and if shortcode is present
        // below code does NOT work with do_shortcode and requires WP 3.6 or later
        if($this->jhbpgetpagetype())
        {
                $jhbpliburl = '//www.google.com/jsapi';
                $bpscript = plugins_url('/js/book-previewer.js', __FILE__);
        
                wp_register_script('googlebookpreviewer',$jhbpliburl,false,false,$this->jhbploadinfooter());
                wp_register_script('bpviewer',$bpscript,false,false,$this->jhbploadinfooter());
                wp_enqueue_script('googlebookpreviewer',false,array(),false,$this->jhbploadinfooter());
                wp_enqueue_script('bpviewer',false,array(),false,$this->jhbploadinfooter());
                wp_enqueue_script('jquery-ui-dialog',false,array(),false,$this->jhbploadinfooter());
                wp_enqueue_script('jquery-effects-core',false,array(),false,$this->jhbploadinfooter());
                wp_enqueue_script('jquery-effects-blind',false,array(),false,$this->jhbploadinfooter());
                wp_enqueue_script('jquery-effects-explode',false,array(),false,$this->jhbploadinfooter());
        }
    }
    
    public function jhbploadstyles()
    {
        wp_enqueue_style('wp-jquery-ui-dialog',(($this->getdeferload()==1) ? true : false));
    }
    
    public function jhbpquicktag()
    {
        if(wp_script_is('quicktags'))
        {
        ?>
            <script type="text/javascript">
            QTags.addButton('eg_bookpreviewer','BPr','[bookpreviewer idtype="ISBN" bookid="" previewer="popup"]','','bookpreviewer','Book Previewer Shortcode');
            </script>
        <?php
        }
    }

    public function jhbpcleancache()
    {
        global $wpdb;
        $jhbpDBquery = 'SELECT option_name FROM ' . $wpdb->options . ' WHERE option_name LIKE \'_transient_timeout_jhbpT-%\';';
        $jhbpCleanDB = $wpdb->get_col($jhbpDBquery);
        foreach ($jhbpCleanDB as $jhbpTransient) {
            $jhbpDBKey = str_replace('_transient_timeout_','',$jhbpTransient);
            delete_transient($jhbpDBKey);
        }
    }

    public function jhbpoptionslink($jhbplink) 
    {
        $jhbpSettingsLink  = '<a href="' . admin_url() . 'admin.php?page=bookpreviewer-options">' . __('Settings','bookpreviewer') . '</a>';
        array_unshift($jhbplink,$jhbpSettingsLink);
        return $jhbplink;
    }
    
    public function jhbpoptionsscreen()
    {
        $jhbpscreen = get_current_screen();
        return ($jhbpscreen->id == 'bookpreviewer-options') ? true : false;
    }

    public function setbpagree($newval)
    {
        $this->jhbpagree = (trim($newval)=='checked') ? 1 : trim($newval);
        return absint($this->jhbpagree);
    }
    
    public function getbpagree()
    {
        $this->jhbpagree = get_option('bookpreviewer-agree','1');
        return absint($this->jhbpagree);
    }

    public function setcacheexpire($newval)
    {
        $this->jhbpcacheexpire = (! empty($newval)) ? trim($newval) : 12;
        return absint($this->jhbpcacheexpire);
    }
    
    public function getcacheexpire()
    {
        $this->jhbpcacheexpire = get_option('bookpreviewer-perform','12');
        return absint($this->jhbpcacheexpire);
    }
    
    public function setclearcache($newval)
    {
        $this->jhbpclearcache = (! empty($newval)) ? trim($newval) : 0;
        return absint($this->jhbpclearcache);
    }
    
    public function getclearcache()
    {
        $jhbpclear = get_option('bookpreviewer-clearcache','0');
        update_option('bookpreviewer-clearcache','0');
        return absint($jhbpclear);
    }

    public function setdeferload($newval)
    {
        $this->jhbpdefer = (trim($newval)=='checked') ? 1 : trim($newval);
        return absint($this->jhbpdefer);
    }
    
    public function getdeferload()
    {
        $this->jhbpdefer = get_option('bookpreviewer-defer','');
        return absint($this->jhbpdefer);
    }
    
    public function setresponsive($newval)
    {
        $this->jhbpresponsive = (trim($newval)=='checked') ? 1 : trim($newval);
        return absint($this->jhbpresponsive);
    }
    
    public function getbpresponsive()
    {
        $this->jhbpresponsive = get_option('bookpreviewer-responsive','0');
        return absint($this->jhbpresponsive);
    }
    
    public function jhbpoptionscallback()
    {
        $jhbp1      = __('WARNING!');
        $jhbp2      = __('You should make a backup of your WordPress database before attempting to use the <strong>Clear Cache</strong> option. The <strong>Clear Cache</strong> option attempts to delete data directly from the WordPress database and is therefore dangerous. Use the <strong>Clear Cache</strong> option with caution.','bookpreviewer');
        $jhbpformat = '<p><h2>%s</h2></p><p>%s</p>';

        printf($jhbpformat,$jhbp1,$jhbp2);
    }
    
    public function jhbpusagecallback()
    {
        echo '<p><b>' . __('Shortcode','bookpreviewer') .'</b>: <code>[bookpreviewer bookid="<i>ISBN</i>" previewer="embedded"]</code></p>';

        $jhbp1      = __('Insert the above shortcode into any page or post where you want Google Books previews to appear. Replace ','bookpreviewer');
        $jhbp2      = __(' with the product identifier to retrieve and display the preview for that product.','bookpreviewer');
        $jhbp3      = __('For a more detailed and complete overview of how Book Previewer works, click the "Help" tab on the upper right of the Book Previewer settings page.','bookpreviewer');
        $jhbpformat = '<p>%s<code><i>ISBN</i></code>%s</p><p>%s</p>';

        printf($jhbpformat,$jhbp1,$jhbp2,$jhbp3);
    }
    
    public function jhbpregistersettings() 
    {
        register_setting('bookpreviewer-options','bookpreviewer-agree',array(&$this, 'setbpagree'));
        register_setting('bookpreviewer-options','bookpreviewer-perform',array(&$this, 'setcacheexpire'));
        register_setting('bookpreviewer-options','bookpreviewer-clearcache',array(&$this, 'setclearcache'));
        register_setting('bookpreviewer-options','bookpreviewer-defer',array(&$this, 'setdeferload'));
        register_setting('bookpreviewer-options','bookpreviewer-responsive',array(&$this,'setresponsive'));
    }
    
    public function jhbpaddadminpage() 
    {
        $jhbpoptionspage = add_submenu_page('options-general.php','Book Previewer','Book Previewer','manage_options','bookpreviewer-options',array(&$this, 'jhbpgetoptionsscreen'));
        $jhbpusagepage   = add_submenu_page('bookpreviewer-options','Usage','Usage','manage_options','bookpreviewer-usages',array(&$this, 'jhbpgetoptionsscreen'));    

        add_action('load-' . $jhbpoptionspage,array(&$this,'jhbpcontexthelp'));
        add_action('load-' . $jhbpusagepage, array(&$this, 'jhbpcontexthelp'));
    }
    
    public function jhbpgetoptionsscreen() 
    {
        $active_tab = 'bookpreviewer_retrieval_section';
        
        switch(get_admin_page_title())
        {
            case 'BookPreviewer':
                 $_GET['tab'] = 'bookpreviewer_retrieval_section';
                 break;
            case 'Usage':
                 $_GET['tab'] = 'bookpreviewer_usage_section';
                 break;
        }
        // Settings navigation tabs
        if( isset( $_GET[ 'tab' ] ) ) {
            $active_tab = isset( $_GET[ 'tab' ] ) ? sanitize_text_field($_GET[ 'tab' ]) : 'bookpreviewer_retrieval_section';
        }
        echo '<h2 class="nav-tab-wrapper"><a href="' . admin_url() .'admin.php?page=bookpreviewer-options&tab=bookpreviewer_retrieval_section" class="nav-tab ';
        echo $active_tab == 'bookpreviewer_retrieval_section' ? 'nav-tab-active' : '';
        echo '">Book Previewer</a><a href="' . admin_url() .'admin.php?page=bookpreviewer-usages&tab=bookpreviewer_usage_section" class="nav-tab ';
        echo $active_tab == 'bookpreviewer_usage_section' ? 'nav-tab-active' : '';
        echo '">Usage</a></h2>';
        
        // Settings form
        add_settings_section(
            'bookpreviewer_retrieval_section',
            __('Book Previewer','bookpreviewer'),
            array(&$this, 'jhbpoptionscallback'),
            'bookpreviewer-options'
        );
               
        add_settings_section(
            'bookpreviewer_usage_section',
            __('Usage','bookpreviewer'),
            array(&$this, 'jhbpusagecallback'),
            'bookpreviewer-usages'
        );
        
        // Create settings fields
        $this->getoptionsform();   
        switch($active_tab)
        {
            case 'bookpreviewer_retrieval_section':
                 echo '<form method="post" action="options.php">';
                 settings_fields('bookpreviewer-options');
                 do_settings_sections('bookpreviewer-options');
                 echo get_submit_button();
                 echo '</form>';
                 break;
            case 'bookpreviewer_usage_section':
                 settings_fields('bookpreviewer-usages');
                 do_settings_sections('bookpreviewer-usages');
                 break;
        }

    }
    
    public function jhbpagreefield($args)
    {
        $jhbpfield  = '<input type="checkbox" name="bookpreviewer-agree" id="bookpreviewer-agree" value="1" /' .
        checked(1, $this->getbpagree(), false) . 
        $this->getbpagree() .
        '><br />';
        $jhbpfield .= '<label for="bookpreviewer-agree"> '  . sanitize_text_field($args[0]) . '</label>';
        echo $jhbpfield;
    }
    
    public function jhbpcacheresponsivefield($args)
    {
        $jhbpfield  = '<input type="checkbox" name="bookpreviewer-responsive" id="bookpreviewer-responsive" value="1" /' .
        checked(1, $this->getbpresponsive(), false) . 
        $this->getbpresponsive() .
        '><br />';
        $jhbpfield .= '<label for="bookpreviewer-responsive"> '  . sanitize_text_field($args[0]) . '</label>';
        echo $jhbpfield;
    }

    public function jhbpcacheexpirefield($args)
    {
	    $jhbpfield = '<select id="bookpreviewer-perform" name="bookpreviewer-perform">';
	    for($x=1;$x<24;$x++)
	    {
	        $jhbpfieldselected = ($this->getCacheExpire()==$x) ? ' selected="selected"' : '';
	        $jhbpfield .= '<option value="' .
	                      absint($x) .
	                      '"' .
	                      sanitize_text_field($jhbpfieldselected) .
	                      '>' .
	                      absint($x) .
	                      '</option>';
	    }
	    $jhbpfield .= '</select> Hours<br />';
        $jhbpfield .= '<label for="bookpreviewer-perform"> '  . sanitize_text_field($args[0]) . '</label>';
	    echo $jhbpfield;
    }

    public function jhbpclearcachefield($args)
    {
        $jhbpfield  = '<input type="checkbox" name="bookpreviewer-clearcache" id="bookpreviewer-clearcache" value="1" /><br />';
        $jhbpfield .= '<label for="bookpreviewer-clearcache"> '  . sanitize_text_field($args[0]) . '</label>';
        echo $jhbpfield;
    }
    
    public function jhbpdeferfield($args)
    {
        $jhbpfield  = '<input type="checkbox" name="bookpreviewer-defer" id="bookpreviewer-defer" value="1" ' .
        checked(1, $this->getdeferload(), false) .
        $this->getdeferload() .
        ' /><br />';
        $jhbpfield .= '<label for="bookpreviewer-defer"> '  . sanitize_text_field($args[0]) . '</label>';
        echo $jhbpfield;
    }
    
    public function getoptionsform()
    {
        add_settings_field(
            'bookpreviewer-agree',
            __('Allow Book Previewer','bookpreviewer'),
            array(&$this, 'jhbpagreefield'),
            'bookpreviewer-options',
            'bookpreviewer_retrieval_section',
            array(
                __('By selecting this checkbox, you agree to allow Book Previewer to display Google Books Previewer branding, previews, images, buttons, links, and text on your WordPress site. If you do not agree to these terms, you cannot use the Book Previewer plugin.','bookpreviewer')
            )
        );
        
        add_settings_field(
            'bookpreviewer-responsive',
            __('Use Responsive Style','bookpreviewer'),
            array(&$this, 'jhbpcacheresponsivefield'),
            'bookpreviewer-options',
            'bookpreviewer_retrieval_section',
            array(
                __('Uses a responsive container for the previewer rather than a fixed width.','bookpreviewer')
            )
        );

        add_settings_field(
            'bookpreviewer-perform',
            __('Cache Expires In','bookpreviewer'),
            array(&$this, 'jhbpcacheexpirefield'),
            'bookpreviewer-options',
            'bookpreviewer_retrieval_section',
            array(
                __('The number of hours that should pass before cached previewers expire. Cannot be more than 23 hours. Default is 12.','bookpreviewer')
            )
        );
        
        add_settings_field(
            'bookpreviewer-defer',
            __('Defer Until Footer','bookpreviewer'),
            array(&$this, 'jhbpdeferfield'),
            'bookpreviewer-options',
            'bookpreviewer_retrieval_section',
            array(
                __('Loads Book Previewer data asynchronously for better site performance. See the Help menu for more information.','bookpreviewer')
            )
        );
        
        add_settings_field(
            'bookpreviewer-clear-cache-field',
            __('Clear Cache','bookpreviewer'),
            array(&$this, 'jhbpclearcachefield'),
            'bookpreviewer-options',
            'bookpreviewer_retrieval_section',
            array(
                __('Clears Book Previewer transient data.','bookpreviewer')
            )
        );
    }

    public function jhbpcontexthelp()
    {
        $screen = get_current_screen();
        $screen->add_help_tab( array(
            'id'       => 'bookpreviewer',
            'title'    => __('Book Previewer','bookpreviewer'),
            'content'  => '<p>' . 
                          __('Book Previewer is a shortcode that retrieves and displays Google Books previews of titles you specify. To use the shortcode, you must have an International Standard Book Number (ISBN), Online Computer Library Center (OCLC) ID, Library of Congress Control Number (LCCN), or Google Play Generated Key (GGKEY) for the title you want to display.','bookpreviewer') . 
                          '</p><p>' .
                          __('The Book Previewer shortcode requires the following two parameters:','bookpreviewer') . 
                          '<ul><li><code>bookid</code>,' .
                          __(' the ISBN, OCLC, LCCN, or GGKEY of the title that has the Google Books preview you want to display.','bookpreviewer') .
                          '</li><li><code>previewer</code>,' .
                          __(' the type of preview you want to display. There are three options that correspond to the three types of Google Books preview elements: <code>embedded</code>, <code>link</code>, and <code>popup</code>.','bookpreviewer') . 
                          '</li></ul></p><p>' .
                          __('For example, the following shortcode displays a Google Preview button that, when clicked, will launch a popup Google Books preview of HOPPERS by Isaac Thorne:','bookpreviewer') . 
                          '</p><p><code>[bookpreviewer bookid="9781938271168" previewer="popup"]</code></p>'
                        ) );
        $screen->add_help_tab( array(
            'id'       => 'bookpreviewer-params',
            'title'    => __('Book Previewer Options','bookpreviewer'),                        
            'content'  => '<p>' .
                          __('The Book Previewer shortcode supports all of the following optional parameters:','bookpreviewer') .
                          '<ul><li><code>idtype</code>' .
                          __(' accepts a value of <code>ISBN</code>, <code>OCLC</code>, <code>LCCN</code>, or <code>GGKEY</code>. If you do not specify an <code>idtype</code>, Google Books preview will search its database for book IDs of any type that match the <code>bookid</code> value you entered.','bookpreviewer') .
                          '</li><li><code>width</code>' .
                          __(' accepts an integer value in pixels to configure the width of the previewer. This parameter is only useful if <code>previewer</code> is configured to <code>embedded</code>.','bookpreviewer') .
                          '</li><li><code>height</code>' .
                          __(' accepts an integer value in pixels to configure the height of the previewer. This parameter is only useful if <code>previewer</code> is configured to <code>embedded</code>.','bookpreviewer') .
                          '</li><li><code>language</code>' .
                          __(' accepts a code to enable the Google Preview button to display text in a language other than English. The full list of codes is <a href="https://developers.google.com/books/docs/viewer/developers_guide#Localization" target="_blank">available here</a>.','bookpreviewer') .
                          '</li><li><code>cobrand</code>' .
                          __(' accepts a string that identifies a publisher\'s Google Books cobrand. This parameter only works if you have established a cobrand with the Google Books partner program.','bookpreviewer') .
                          '</li></ul></p><p>' .
                          __('The Book Previewer shortcode can be issued by typing the shortcode in the Text window of the editor on any page or post. The Text window also contains a <strong>bookpreviewer</strong> button that you can use to automatically place the shortcode into the text frame.','bookpreviewer') .
                          '</p>'
                       ) );
        if ( $screen->id == 'settings_page_bookpreviewer-options' )
        {
            $screen->add_help_tab( array(
                'id'       => 'bookpreviewer-settings',
                'title'    => __('Book Previewer Settings','bookpreviewer'),                        
                'content'  => '<p>' .
                              __('The Book Previewer plugin caches some information to your WordPress database if you do not have a caching plugin, such as W3 Total Cache, installed and activated. You can alter the following Book Previewer performance settings on this page:','bookpreviewer') .
                              '<ul><li><code>Cache Expires In</code>' .
                              __(' Configures the number of hours the WordPress database should store Book Previewer caches. Cannot be longer than 23 hours.','bookpreviewer') .
                              '</li><li><code>Use Responsive STyle</code>' .
                              __(' Uses a variable-width container for the previewer instead of a fixed-width container, which can improve the appearance of the previewer on responsive sites.','bookpreviewer') .
                              '</li><li><code>Defer Until Footer</code>' .
                              __(' Loads all Book Previewer JavaScript and <code>link</code> tags in your WordPress site\'s footer, which can benefit site performance. Your WordPress theme must use the wp_footer function for this option to work.','bookpreviewer') .
                              '</li><li><code>Clear Cache</code>' .
                              __(' If your site does not use a caching plugin, you can use this option to clear cached Book Previewer information from your WordPress database. Please be aware that if you are using a caching plugin, such as W3 Total Cache, with object caching enabled, the Clear Cache option will not do anything. You will need to clear the object cache by using the caching plugin\'s clear cache feature.','bookpreviewer') .
                              '</p>'
                           ) );
        }
    }
    
    public function jhbpshownotices()
    {
        if($this->getclearcache()=='1') 
        {
            add_settings_error( 'bookpreviewer-notices', 'jhbp-cache-cleared', __('Cache cleared', 'bookpreviewer'), 'updated' );
            $this->jhbpcleancache();
        }
    }

    public function jhbpaddactions()
    {
        // Localization
        add_action('plugins_loaded', array(&$this, 'jhbploadlocal'));

        add_action('wp_enqueue_scripts', array(&$this, 'jhbploadscripts'));
        add_action('wp_enqueue_scripts', array(&$this, 'jhbploadstyles'));
        add_action('admin_print_footer_scripts',array(&$this, 'jhbpquicktag'));
        
        // Load help
        add_action('load-post.php',array(&$this, 'jhbpcontexthelp'));
        add_action('load-post-new.php',array(&$this, 'jhbpcontexthelp'));
        add_action('load-page.php',array(&$this, 'jhbpcontexthelp'));
        add_action('load-page-new.php',array(&$this, 'jhbpcontexthelp'));
                
        // Add shortcode functionality
        add_shortcode('bookpreviewer', array(&$this, 'jhbpshortcode'));
        
        // Add widget
       add_action('widgets_init',create_function('', 'return register_widget("jhbpwidget");'));
    }
    
    public function jhbpisSSL()
    {
        $jhbpSSL = (isset($_SERVER['HTTPS'])) || (is_ssl()) ? 'https://' : 'http://';
        return $jhbpSSL;
    }

    private function jhbperror()
    {
        $jhbpoutput  = 'document.write("<h2>' . __('Book Previewer Error') . ':</h2>';
        $jhbpoutput .= __(' Previewer Type Not Recognized.<br><br>Valid entries are ') .
                          '<strong>embedded</strong>, <strong>link</strong>, ' .
                          __('or') .
                          ' <strong>popup</strong>.';
        $jhbpoutput .= '");';
        return $jhbpoutput;
    }    
    
    private function jhbptransientid($jhbpatts)
    {
        $jhbptransid = implode('',$jhbpatts);
        $jhbptransid = 'jhbpT-' . wp_hash($jhbptransid);
        return $jhbptransid;
    }
 
    private function jhbpidentifier($jhbpatts)
    {
        $jhbpidentifier  = (in_array(strtoupper($jhbpatts["idtype"]),$this->jhbpidtypes)) ? sanitize_text_field(strtoupper($jhbpatts["idtype"])) . ':' : '';
        $jhbpidentifier .= ($jhbpatts["bookid"]!='') ? sanitize_text_field($jhbpatts["bookid"]) : '';
        return $jhbpidentifier;
    }
    
    private function jhbplinkidentifier($jhbpatts)
    {
        $jhbpidentifier  = (in_array(strtoupper($jhbpatts["idtype"]),$this->jhbpidtypes)) ? sanitize_text_field(strtoupper($jhbpatts["idtype"])) : '';
        $jhbpidentifier .= ($jhbpatts["bookid"]!='') ? sanitize_text_field($jhbpatts["bookid"]) : '';
        return $jhbpidentifier;
    }
    
    private function jhbpsetlanguage($jhbpatts)
    {
        if(in_array($jhbpatts["language"],$this->jhbpcountries))
        {
            $jhbpoutput = sanitize_text_field($jhbpatts["language"]);
        } else {
            $jhbpoutput = 'en';        
        }
        return $jhbpoutput;
    }
    
    private function jhbpsetcobrand($jhbpatts)
    {
        if($jhbpatts["cobrand"]!='')
        {
            $jhbpoutput = sanitize_text_field($jhbpatts["cobrand"]);
        } else {
            $jhbpoutput = '';
        }
        return $jhbpoutput;
    }
    
    private function jhbpsetwidth($jhbpatts)
    {
       $jhbpoutput = ($jhbpatts["width"]>0) ? absint($jhbpatts["width"]) : '600';
       return $jhbpoutput;
    }
    
    private function jhbpsetheight($jhbpatts)
    {
       $jhbpoutput = ($jhbpatts["height"]>0) ? absint($jhbpatts["height"]) : '500';
       return $jhbpoutput;
    }
    
    private function jhbpshowbutton($jhbpatts)
    {
       $jhbpoutput = $this->jhbpisSSL() . $this->jhbpphost . $this->jhbpsetlanguage($jhbpatts) . $this->jhbppbutton;
       return $jhbpoutput;
    }
    
    public function jhbpinitial()
    {
        $jhbpattr    = $this->jhbpatts;
        $jhbpoutput  = '<script>loadBPviewer(\'' . $this->jhbpsetlanguage($jhbpattr) . '\',\'' . $this->jhbpsetcobrand($jhbpattr) . '\')</script>' . PHP_EOL;
        if($this->getdeferload()==1)
        {
            echo $jhbpoutput;
        } 
        else 
        {
            return $jhbpoutput;
        }
    }
    
    public function jhbpembedded()
    {
        $jhbpattr   = $this->jhbpatts;
        $jhbpoutput = '<script>bpshowpreview(\'' . $this->jhbpidentifier($jhbpattr) . '\')</script>' . PHP_EOL;
        if($this->getdeferload()==1)
        {
            echo $jhbpoutput;
        } 
        else 
        {
            return $jhbpoutput;
        }
    }
    
    public function jhbppopup()
    {
        $jhbpattr   = $this->jhbpatts;
	    $jhbpoutput = '<script>bppopup(\'' . __('Google Books Preview','bookpreviewer') . '\',\'' . $this->jhbpidentifier($jhbpattr) . '\',\'' . $this->jhbpsetwidth($jhbpattr) . '\',\'' . $this->jhbpsetheight($jhbpattr) . '\')</script>' . PHP_EOL;
        if($this->getdeferload()==1)
        {
            echo $jhbpoutput;
        } 
        else 
        {
            return $jhbpoutput;
        }
    }
    
    private function jhbplink($jhbpatts)
    {
        $jhbpoutput  = '';
        $jhbphost    = (isset($jhbpatts["cobrand"])) ? 'books.google.com/books/' . sanitize_text_field($jhbpatts["cobrand"]) . '?vid=' : 'books.google.com/books?vid=';
        $jhbpoutput .= '<a href="' . $this->jhbpisSSL() . $jhbphost . $this->jhbplinkidentifier($jhbpatts) .'&printsec=frontcover">';
        $jhbpoutput .= '<img src="' . $this->jhbpshowbutton($jhbpatts) . '" width="88" height="31"/></a>';
        return $jhbpoutput;
    }
    
    public function jhbpcontainer($jhbpatts)
    {
        $jhbpoutput  = '<div id="jhbpreviewer" style="width:';
        $jhbpoutput .= ($this->getbpresponsive()==0) ? $this->jhbpsetwidth($jhbpatts) . 'px' : '100%';
        $jhbpoutput .= ';height:' . $this->jhbpsetheight($jhbpatts) . 'px;"><div id="viewerCanvas" style="width:100%;height:95%;"></div></div>';
        return $jhbpoutput;
    }

    public function jhbpselect($jhbpatts)
    {
        $jhbpoutput = '';
        switch(strtolower($jhbpatts["previewer"]))
        {
            case    "embedded":
                    if($this->getdeferload()==1)
                    {
                        add_action('wp_footer',array(&$this,'jhbpembedded'),100);
                    } else {
                        $jhbpoutput .= $this->jhbpembedded();
                    }
                    $jhbpoutput .= $this->jhbpcontainer($jhbpatts);
                    break;
            case    "link":
                    $jhbpoutput .= $this->jhbplink($jhbpatts);
                    break;
            case    "popup":
                    if($this->getdeferload()==1)
                    {
                        add_action('wp_footer',array(&$this,'jhbppopup'),100);
                    } else {
                        $jhbpoutput .= $this->jhbppopup();
                    }
                    $jhbpoutput .= '<a href="#" onClick="return false;" id="gbppop"><img src="' . $this->jhbpshowbutton($jhbpatts) . '" /></a>';
                    $jhbpoutput .= $this->jhbpcontainer($jhbpatts);
                    break;
            default:
                    $jhbpoutput .= $this->jhbperror();
        }
        return $jhbpoutput;
    }
    
    public function jhbpgetpreview($jhbpatts)
    {   
        $jhbpoutput = '';
        if ($this->getdeferload()==1) 
        {
            add_action('wp_footer',array(&$this,'jhbpinitial'), 100);
        } else {
            $jhbpoutput = $this->jhbpinitial();
        }
                
        $jhbpoutput .= $this->jhbpselect($jhbpatts);

        return $jhbpoutput;
    }
       
    public function jhbpshortcode($jhbpSCatts)
    {   
        if($this->getbpagree()==1)
        {
            $jhbptransientexpire = $this->getcacheexpire();
            $this->jhbpatts = shortcode_atts( array(
                                  'idtype'       => 'ISBN',
                                  'bookid'       => '',
                                  'previewer'    => 'embedded',
                                  'width'        => '500',
                                  'height'       => '600',
                                  'language'     => 'en',
                                  'cobrand'      => ''
	                          ), $jhbpSCatts);
	                      
            if($this->getdeferload()==1)
            {
               add_action('wp_footer',array(&$this,'jhbpinitial'), 100);
               $this->jhbpselect($this->jhbpatts);
            }
        
            if (false === ($jhbpoutput = get_transient($this->jhbptransientid($this->jhbpatts))))
            {
                set_transient ($this->jhbptransientid($this->jhbpatts), $this->jhbpgetpreview($this->jhbpatts), $jhbptransientexpire * HOUR_IN_SECONDS);
            }
        
            $jhbpoutput = get_transient($this->jhbptransientid($this->jhbpatts));
        } else {
            $jhbpoutput = "<h2>Book Previewer Error</h2> In order to use this plugin, you must agree to the terms. Please review the Book Previewer Settings page.";
        }
        return $jhbpoutput;
    }
}
?>
