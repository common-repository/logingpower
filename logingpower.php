<?php
/*
 * Plugin Name: LogingPower
 * Plugin URI: https://bitwali.com/loging-power/
 * Author URI: https://bitwali.com/contact-us/ 
 * Author: Muhammad Ijaz Anjum CEO Bitwali
 * Description: LogingPower is decorated with tabs designed according to the page layout،  exactly like the login page, which facilitates its use to all users according to their skill level and mastery from novice, beginner, advanced beginner, competent,expert.
 * Requires at least: 6.0  
 * Tested up to: 6.6.1 
 * Version:1.1.9
 * Stable tag: 1.1.9  
 * Requires PHP: 5.3
 * License: GPLv2 or later  

 * Text Domain: logingpower
 * Domain Path: /languages
 */

// Security check to prevent direct access.
if ( ! defined( 'ABSPATH' ) ) { exit; }
define( 'LOGINGPOWER_VERSION', '1.1.9' );

if(!class_exists('LogingPower')):

	class LogingPower {
		/**
		* @var string
		* since 1.0.0
		*/
		public $version = LOGINGPOWER_VERSION;
	  
	  /**
		* @var WPoptions options
		*/

		public $options;
	  	    
    public function __construct(){

        $this->define_constants();
  		$this->logingpower_actions();
  		$this->options=get_option('logingpower_settings');
  		$this->logingpower_register_settings_fields();
  		// delete_option('logingpower_settings');
  		$this->logingpower_update_options();  

    }
    /**
		* Define LoginPower Constants
		*/
		private function define_constants() {
			$this->define( 'LOGINGPOWER_VERSION', $this->version );
			// $this->define( 'LOGINGPOWER_VERSION', LOGINGPOWER_VERSION );
			$this->define( 'LOGINGPOWER_DIR_PATH', plugin_dir_path( __FILE__ ) );
		}
    /**
		* Define constant if not already set
		* @param  string $name
		* @param  string|bool $value
		*/
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}
	    
			
		/**
		 *  
		 *  LogingPower Actions 
		 * */
	    private function logingpower_actions(){
	    	add_action( 'admin_enqueue_scripts', array($this ,'logingpower_admin_styles')  );
	    	add_action( 'admin_enqueue_scripts', array($this ,'logingpower_admin_scripts')  );
	    }
	    // LogingPower enqueue styles
	    public function logingpower_admin_styles() {
	    	
	    	wp_register_style('logingpower_interface', plugins_url( 'css/interface.css', __FILE__ ),array(),LOGINGPOWER_VERSION);
				wp_enqueue_style( 'logingpower_interface' );
				wp_register_style('logingpower_page_tabs', plugins_url( 'css/logingpower_tabs.css', __FILE__ ),array(),LOGINGPOWER_VERSION);
				wp_enqueue_style( 'logingpower_page_tabs' );
				
			} 
		/**
		 * LogingPower enqueue scripts
		 * */
		public function logingpower_admin_scripts() {
	    wp_enqueue_style( 'wp-color-picker' );
	    wp_register_script('logingpower-color-script', plugins_url( 'js/logingpower_ColorPicker.js', __FILE__ ), array( 'wp-color-picker' ), LOGINGPOWER_VERSION,True);
			wp_enqueue_script( 'logingpower-color-script');
			wp_register_script('logingpower_tab_js', plugins_url( 'js/tab_script.js', __FILE__ ),array(),LOGINGPOWER_VERSION,true);
			wp_enqueue_script( 'logingpower_tab_js' );
		} 
		
		/**
			 * Creates menu page 
			 */
			public static  function logingpower_menu_page(){
	      add_menu_page('Loging Power Page','Loging Power','manage_options','logingpower',array('LogingPower','logingpower_page'),'', 20);
	      

	    }
	    /**
		 * Creates Loging Power page  
		 */

    public static  function logingpower_page(){

    ?>
    	<div class="wrap">
    		<div>
    			<h1><?php esc_html_e( 'LogingPower','logingpower' ); ?></h1>
					<h3>
						<strong><?php esc_html_e( 'For any dream customization visit:bitwali.com', 'logingpower' ); ?></strong></h3>
    		</div>
				<button class="tablink" onclick="openTab('Login', this, 'pink')" id="defaultOpen" ><?php esc_html_e( ' Login Page','logingpower' ); ?></button>
				<button class="tablink" onclick="openTab('Loginsection', this, 'lightgreen')"  ><?php esc_html_e( 'Login Section','logingpower' ); ?></button>
				<button class="tablink" onclick="openTab('Loginlogo', this, '#d9e8f7')"><?php esc_html_e( 'Login Logo','logingpower' ); ?></button>
				<button class="tablink" onclick="openTab('Loginmessage', this, 'orange')"><?php esc_html_e( 'Login Message','logingpower' ); ?></button>
				<button class="tablink" onclick="openTab('Loginform', this, '#F99A98')"><?php esc_html_e( 'Login Form','logingpower' ); ?></button>
				<button class="tablink" onclick="openTab('Lostpassword', this, 'lightgreen')"><?php esc_html_e( 'Lost password?','logingpower' ); ?></button>
				<button class="tablink" onclick="openTab('Templates', this, 'pink')" ><?php esc_html_e( 'Templates','logingpower' ); ?></button>
				<button class="tablink" onclick="openTab('Langswitcher', this, '#B6C7D8')" ><?php esc_html_e( 'Lang Switcher','logingpower' ); ?></button>
				<button class="tablink" onclick="openTab('Settings', this, 'orange')"><?php esc_html_e( 'Settings','logingpower' ); ?></button>

				<?php settings_errors(); ?>
			  <form method="POST" action="options.php"  enctype="multipart/form-data"   >
			  <?php
			  // settings_fields( 'wpdocs-plugin-settings-group' );  
		      	settings_fields( 'logingpower_settings' );
				do_settings_sections( 'logingpower');
		            ?>
		        <?php wp_nonce_field( 'logingpower_action', 'logingpower_nonce_field' ); ?>
				    
         	<p class="submit">
						<input class="button button-primary" type="submit" name="submit" value="Save Changes" >
				 </p>       
        </form>
			</div>   
         
     <?php
    }

/**
 * logingpower update optons 
 * 
 * */
	public function logingpower_update_options(){
		// die('has been called ');
	}

    /**
		 * Registrs settings sections and fields  
		 */
	  public function logingpower_register_settings_fields(){
	  	$args = array( 'sanitize_callback' => array($this,'validate'),);
	    register_setting('logingpower_settings','logingpower_settings',$args);
	    $logingpower_settings_option_args=array(
	      	'before_section'=>'<div id="Settings" class="tabcontent" >',
	         	'after_section'=>'</div>',
	         );  
	    add_settings_section('logingpower_settings_option','',array($this, 'logingpower_settings_option'),'logingpower',$logingpower_settings_option_args);
	    add_settings_field('logingpower_settings_option_fields','',array($this,'logingpower_settings_option_fields'),'logingpower','logingpower_settings_option');
      $logingpower_loginpage_args=array(
	      	'before_section'=>'<div id="Login" class="tabcontent">',
	         	'after_section'=>'</div>',
	      );
	    add_settings_section('logingpower_loginpage','',array($this, 'logingpower_loginpage'),'logingpower',$logingpower_loginpage_args );
			add_settings_field('logingpower_loginpage_fields','',array($this,'logingpower_loginpage_fields'),'logingpower','logingpower_loginpage');
			$logingpower_loginsec_args=array(
	      	'before_section'=>'<div id="Loginsection" class="tabcontent">',
	         	'after_section'=>'</div>',
	         ); 
	    add_settings_section('logingpower_loginsec','',array($this, 'logingpower_loginsec'),'logingpower',$logingpower_loginsec_args);
	    add_settings_field('logingpower_loginsec_fields','',array($this,'logingpower_loginsec_fields'),'logingpower','logingpower_loginsec');
	    $logingpower_loginlogo_args=array(
	      	'before_section'=>'<div id="Loginlogo" class="tabcontent">',
	         	'after_section'=>'</div>',
	         ); 
	    add_settings_section('logingpower_loginlogo','',array($this, 'logingpower_loginlogo'),'logingpower',$logingpower_loginlogo_args);
	    add_settings_field('logingpower_loginlogo','',array($this,'logingpower_loginlogo_fields'),'logingpower','logingpower_loginlogo');
	    $logingpower_loginmessage_args=array(
	      	'before_section'=>'<div id="Loginmessage" class="tabcontent">',
	         	'after_section'=>'</div>',
	         ); 
	    add_settings_section('logingpower_loginmessage','',array($this, 'logingpower_loginmessage'),'logingpower',$logingpower_loginmessage_args);
	    add_settings_field('logingpower_loginmessage_fields','',array($this,'logingpower_loginmessage_fields'),'logingpower','logingpower_loginmessage');
		 	$logingpower_loginform_args=array(
	      	'before_section'=>'<div id="Loginform" class="tabcontent">',
	         	'after_section'=>'</div>',
	         ); 
	    add_settings_section('logingpower_loginform','',array($this, 'logingpower_loginform'),'logingpower',$logingpower_loginform_args);
	    add_settings_field('logingpower_loginform_fields','',array($this,'logingpower_loginform_fields'),'logingpower','logingpower_loginform');
	    $logingpower_lostpassword_args=array(
	      	'before_section'=>'<div id="Lostpassword" class="tabcontent">',
	         	'after_section'=>'</div>',
	         ); 
	    add_settings_section('logingpower_lostpassword','',array($this, 'logingpower_lostpassword'),'logingpower',$logingpower_lostpassword_args);
	    add_settings_field('logingpower_lostpassword_fields','',array($this,'logingpower_lostpassword_fields'),'logingpower','logingpower_lostpassword');
		  $logingpower_templates=array(
	      	'before_section'=>'<div id="Templates" class="tabcontent">',
	         	'after_section'=>'</div>',
	         ); 
	    add_settings_section('logingpower_templates_sec','',array($this, 'logingpower_templates_sec'),'logingpower',$logingpower_templates);
	    add_settings_field('logingpower_templates_fields','',array($this,'logingpower_templates_fields'),'logingpower','logingpower_templates_sec');
	    $logingpower_languageswitcher=array(
	      	'before_section'=>'<div id="Langswitcher" class="tabcontent">',
	         	'after_section'=>'</div>',
	         ); 
	    add_settings_section('logingpower_languageswitcher_sec','',array($this, 'logingpower_languageswitcher_sec'),'logingpower',$logingpower_languageswitcher);
	    add_settings_field('logingpower_languageswitcher_fields','',array($this,'logingpower_languageswitcher_fields'),'logingpower','logingpower_languageswitcher_sec');
	    }
	  public function validate($plugin_options){
	  	//	  	if ( ! isset( $_POST['prefix_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash ( $_POST['prefix_nonce'] ) ) , 'prefix_nonce' ) )
	    if ( !isset( $_POST['logingpower_nonce_field'] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash ($_POST['logingpower_nonce_field']) ), 'logingpower_action' ) ) {
	    	return;
	    }
      	// login page
		   if (!empty($_FILES['logingpower_loginpage_bgimg']['tmp_name']) ) {
				    $override= array(
				        'test_form' => false,
				      	'mimes'=>array(
					        'jpg'  => 'image/jpeg',
					        'jpeg' => 'image/jpeg',
					        'png'  => 'image/png')
					);
		        // $override=array('test_form'=>false);
		        $file=wp_handle_upload($_FILES['logingpower_loginpage_bgimg'],$override);
		        $plugin_options['logingpower_loginpage_bgimg']=sanitize_url($file['url']);
		    	
		    }elseif(!empty($this->options['logingpower_loginpage_bgimg'])){
		        $plugin_options['logingpower_loginpage_bgimg']= sanitize_url($this->options['logingpower_loginpage_bgimg']);
		    }else{
		    	($plugin_options['logingpower_loginpage_bgimg'] ?? $plugin_options['logingpower_loginpage_bgimg']=sanitize_url(plugins_url( 'imgs/loginpage_bgbagh.jpg', __FILE__ )));
		    }
		
		    //Login Section 
	     if (!empty($_FILES['logingpower_loginsec_bgimg']['tmp_name']) ) {
				    $override= array(
				        'test_form' => false,
				      	'mimes'=>array(
					        'jpg'  => 'image/jpeg',
					        'jpeg' => 'image/jpeg',
					        'png'  => 'image/png')
					);
		        // $override=array('test_form'=>false);
		        $file=wp_handle_upload($_FILES['logingpower_loginsec_bgimg'],$override);
		        $plugin_options['logingpower_loginsec_bgimg']=sanitize_url($file['url']);
		    	
		    }elseif(!empty($this->options['logingpower_loginsec_bgimg'])){
		        $plugin_options['logingpower_loginsec_bgimg']= sanitize_url($this->options['logingpower_loginsec_bgimg']);
		    }else{
		    	($plugin_options['logingpower_loginsec_bgimg'] ?? $plugin_options['logingpower_loginsec_bgimg']=sanitize_url(plugins_url( 'imgs/login_section.jpg', __FILE__ )));
		    }

		    // Login Logo 
		    if (!empty($_FILES['logingpower_loginlogo_img']['tmp_name']) ) {
				    $override= array(
				        'test_form' => false,
				      	'mimes'=>array(
					        'jpg'  => 'image/jpeg',
					        'jpeg' => 'image/jpeg',
					        'png'  => 'image/png')
					);
		        // $override=array('test_form'=>false);
		        $file=wp_handle_upload($_FILES['logingpower_loginlogo_img'],$override);
		        $plugin_options['logingpower_loginlogo_img']=sanitize_url($file['url']);
		    	
		    }elseif(!empty($this->options['logingpower_loginlogo_img'])){
		        $plugin_options['logingpower_loginlogo_img']= sanitize_url($this->options['logingpower_loginlogo_img']);
		    }else{
		    	($plugin_options['logingpower_loginlogo_img'] ?? $plugin_options['logingpower_loginlogo_img']=sanitize_url(plugins_url( 'imgs/butterflyherder_logo.png', __FILE__ )));
		    }

		    // Login form background
		    if (!empty($_FILES['logingpower_loginform_background_img']['tmp_name']) ) {
				    $override= array(
				        'test_form' => false,
				      	'mimes'=>array(
					        'jpg'  => 'image/jpeg',
					        'jpeg' => 'image/jpeg',
					        'png'  => 'image/png')
					);
		        // $override=array('test_form'=>false);
		        $file=wp_handle_upload($_FILES['logingpower_loginform_background_img'],$override);
		        $plugin_options['logingpower_loginform_background_img']=sanitize_url($file['url']);
		    	
		    }elseif(!empty($this->options['logingpower_loginform_background_img'])){
		        $plugin_options['logingpower_loginform_background_img']= sanitize_url($this->options['logingpower_loginform_background_img']);
		    }else{
		    	($plugin_options['logingpower_loginform_background_img'] ?? $plugin_options['logingpower_loginform_background_img']=sanitize_url(plugins_url( 'imgs/loginform_bglaptop.jpg', __FILE__ )));
		    }


		    // language switcher background image 
		    if (!empty($_FILES['logingpower_languageswitcher_background_img']['tmp_name']) ) {
				    $override= array(
				        'test_form' => false,
				      	'mimes'=>array(
					        'jpg'  => 'image/jpeg',
					        'jpeg' => 'image/jpeg',
					        'png'  => 'image/png')
					);
		        // $override=array('test_form'=>false);
		        $file=wp_handle_upload($_FILES['logingpower_languageswitcher_background_img'],$override);
		        $plugin_options['logingpower_languageswitcher_background_img']=sanitize_url($file['url']);
		    	
		    }elseif(!empty($this->options['logingpower_languageswitcher_background_img'])){
		        $plugin_options['logingpower_languageswitcher_background_img']= sanitize_url($this->options['logingpower_languageswitcher_background_img']);
		    }else{
		    	($plugin_options['logingpower_languageswitcher_background_img'] ?? $plugin_options['logingpower_languageswitcher_background_img']=sanitize_url(plugins_url( 'imgs/language_switcher.jpg', __FILE__ )));
		    }

		   return $plugin_options;
	    
	}
	  
	  // blank call back
		public function logingpower_settings_option(){ 	}
		/**
		 * Defining settings options 
		 */
		public function logingpower_settings_option_fields(){

			$this->options['logingpower_settings_tmp_bg']=!empty($this->options['logingpower_settings_tmp_bg'])??'#f0f0f1';

			echo "<tr valign='top'>
					<th scope='row'>". esc_html( 'Deprecated', 'logingpower' )."</th>";
					// print_r($this->options);
			echo"	<td><label for='logingpower_settings_tmp_bg'>
				<input id='logingpower_settings_tmp_bg' name='logingpower_settings[logingpower_settings_tmp_bg]'  class='mycolor-field' type='color' value='{".esc_attr($this->options['logingpower_settings_tmp_bg'])."}'  placeholder='#f0f0f1' />

					<p class='description'> ". esc_html( 'To resolve "Deprecated: Automatic conversion of false to array is deprecated" , save settings', 'logingpower' )."</p>
					</label></td>";

			echo"</tr>";
					// delete options
	    echo "<tr valign='top' style='background-color:'".esc_attr($this->options['logingpower_settings_tmp_bg'])."''>
				<th scope='row'>". esc_html( 'Restore default settings', 'logingpower', 'logingpower' )."</th>";
				$checked= !empty($this->options['logingpower_settings_options'])?sanitize_text_field('checked'):'';
			echo"	<td><label for='logingpower_settings_options'>";
			echo"	<input id='logingpower_settings_options' name='logingpower_settings[logingpower_settings_options]'  class='mycolor-field' type='checkbox' value='1' ".esc_attr( $checked)." />	
				<p class='description'> ". esc_html( 'To restore all default settings,check it ,click on save changes ,  Log Out and then Log In . ', 'logingpower' )."</p></label></td>";
			echo "</tr>";
			
		}
		// blank call back
	  public function logingpower_loginpage(){ 
	    }
   /**
	 *Defining login page options
	 */
	  public function logingpower_loginpage_fields(){
	  	$this->options['logingpower_loginpage_bgcolor']=sanitize_hex_color($this->options['logingpower_loginpage_bgcolor']??'#f0f0f1');	
	    echo "<tr valign='top'>
					<th scope='row'>". esc_html( 'Login Page Color', 'logingpower' )."</th>";
			echo"	<td><label for= 'logingpower_loginpage_bgcolor'>
				<input id='logingpower_loginpage_bgcolor' name='logingpower_settings[logingpower_loginpage_bgcolor]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginpage_bgcolor']}" )." oninput='this.form.pagebgColor.value=this.value' placeholder='#f0f0f1' />
				<input type='text' style='height:12px;padding:0'  name='pagebgColor'  value=". esc_attr("{$this->options['logingpower_loginpage_bgcolor']}" )."   size='7'  oninput='this.form.logingpower_loginpage_bgcolor.value=this.value' placeholder='#f0f0f1' />
				<p class='description'> ". esc_html( 'Customize login page background-color.default:#f0f0f1', 'logingpower' )."</p>
				</label></td>";
			echo"</tr>";

			//checkbox for background image
			$checked= !empty($this->options['logingpower_loginpage_bgimg_show'])? sanitize_text_field('checked'):'';
	    echo "<tr valign='top'>
				<th scope='row'>". esc_html( 'Login Page Background Image ', 'logingpower', 'logingpower' )."</th>
				<td><label for=".esc_attr('logingpower_loginpage_bgimg_show').">";
			echo"	<input id=".esc_attr('logingpower_loginpage_bgimg_show')." name='logingpower_settings[logingpower_loginpage_bgimg_show]'  class='mycolor-field' type='checkbox' value= "."'1'" .esc_attr($checked)." />	<p class='description'> ". esc_html( 'Enable to show login page background-image', 'logingpower' )."</p>
				</label></td>";

			// upload background image
			 
			$this->options['logingpower_loginpage_bgimg']=sanitize_url($this->options['logingpower_loginpage_bgimg']??plugins_url( 'imgs/loginpage_bgbagh.jpg', __FILE__ ));

	   	echo "	<td><label for='logingpower_loginpage_bgimg'>
				<input id='logingpower_loginpage_bgimg' name='logingpower_loginpage_bgimg'  class='' type='file' accept='.jpg,.png,.jpeg'  />
				<p class='description'> ". esc_html( 'Upload / Change login page background image', 'logingpower' )."</p>
				</label></td>";
		echo "<td>
				<img class='interface_img' src=".esc_url("{$this->options['logingpower_loginpage_bgimg']}")." alt='Login page image'>
				<p class='description'> ". esc_html( 'Recommended any size', 'logingpower' )."</p>
				</td>";
			echo "</tr>	";

			echo "<tr valign='top'>";
			echo"		<th scope='row'></th>";
			// repeat image
			$this->options['logingpower_loginpage_bgimg_repeat']=sanitize_text_field($this->options['logingpower_loginpage_bgimg_repeat']??'no-repeat');
				
			echo"		<td><label for='logingpower_loginpage_bgimg_repeat'>";
			$items=array('repeat','repeat-x','repeat-y','no-repeat');
	    echo "<select  name='logingpower_settings[logingpower_loginpage_bgimg_repeat]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginpage_bgimg_repeat']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ." > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
			echo "<p class='description'> ". esc_html( 'Repeat Login Page Background Image', 'logingpower' )."</p>
			</label></td>";
			$this->options['logingpower_loginpage_bgimg_size']=sanitize_text_field($this->options['logingpower_loginpage_bgimg_size']??'auto');	
			echo "<td><label for='logingpower_loginpage_bgimg_size'>";
			$items=array('auto','width','height','both');
	    echo "<select  name='logingpower_settings[logingpower_loginpage_bgimg_size]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginpage_bgimg_size']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select><p class='description'> ". esc_html( 'Select login page background image width', 'logingpower' )."</p>
				</label></td>";
			echo "	</tr>	";	
		}
	    
	  // black callback for Loging Power section 
	  public function logingpower_loginsec(){ }
	  /**
		* adding login section fields 
		*/
		public function logingpower_loginsec_fields(){
			// Border Radius
			echo"<tr valign='top'><th scope='row'>". esc_html( 'Login Section Border Radius ', 'logingpower' )."</th> ";
			$this->options['logingpower_loginsec_border_radius_topleft']=absint($this->options['logingpower_loginsec_border_radius_topleft']??0);
			echo"<td><label for='logingpower_loginsec_border_radius_topleft'>
				<input id='logingpower_loginsec_border_radius_topleft' name='logingpower_settings[logingpower_loginsec_border_radius_topleft]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginsec_border_radius_topleft']}" )." oninput='this.form.secBorderTopLeft.value=this.value' />
				<input type='number'   name='secBorderTopLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginsec_border_radius_topleft']}" )."   size='2'  oninput='this.form.logingpower_loginsec_border_radius_topleft.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change top left border radius', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginsec_border_radius_topright']=absint($this->options['logingpower_loginsec_border_radius_topright']??0);
			echo"<td><label for='logingpower_loginsec_border_radius_topright'>
				<input id='logingpower_loginsec_border_radius_topright' name='logingpower_settings[logingpower_loginsec_border_radius_topright]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginsec_border_radius_topright']}" )." oninput='this.form.secBorderTopRight.value=this.value' />
				<input type='number'   name='secBorderTopRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginsec_border_radius_topright']}" )."   size='2'  oninput='this.form.logingpower_loginsec_border_radius_topright.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change top right border radius', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginsec_border_radius_bottomright']=absint($this->options['logingpower_loginsec_border_radius_bottomright']??0);
			echo"<td><label for='logingpower_loginsec_border_radius_bottomright'>
				<input id='logingpower_loginsec_border_radius_bottomright' name='logingpower_settings[logingpower_loginsec_border_radius_bottomright]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginsec_border_radius_bottomright']}" )." oninput='this.form.secBorderBottomRight.value=this.value' />
				<input type='number'   name='secBorderBottomRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginsec_border_radius_bottomright']}" )."   size='2'  oninput='this.form.logingpower_loginsec_border_radius_bottomright.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change bottom-right border radius', 'logingpower' )."</p>
					</label></td>";
					
			echo"</tr>";
			echo"<tr valign='top'><th scope='row'></th> ";
			$this->options['logingpower_loginsec_border_radius_bottomleft']=absint($this->options['logingpower_loginsec_border_radius_bottomleft']??0);
			echo"<td><label for='logingpower_loginsec_border_radius_bottomleft'>
				<input id='logingpower_loginsec_border_radius_bottomleft' name='logingpower_settings[logingpower_loginsec_border_radius_bottomleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginsec_border_radius_bottomleft']}" )." oninput='this.form.secBorderBottomLeft.value=this.value' />
				<input type='number'   name='secBorderBottomLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginsec_border_radius_bottomleft']}" )."   size='2'  oninput='this.form.logingpower_loginsec_border_radius_bottomleft.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change bottom left border radius', 'logingpower' )."</p>
					</label></td>";
			echo "</tr> ";
		 	echo "<tr valign='top'>
				<th scope='row'>". esc_html( 'Login section Color,Position,Width', 'logingpower' )."</th>";
			$this->options['logingpower_loginsec_bgcolor']=sanitize_hex_color($this->options['logingpower_loginsec_bgcolor']??'#f0f0f1');
			echo"	<td><label for='logingpower_loginsec_bgcolor'>
				<input id='logingpower_loginsec_bgcolor' name='logingpower_settings[logingpower_loginsec_bgcolor]'  class='mycolor-field' type='color' value='". esc_attr("{$this->options['logingpower_loginsec_bgcolor']}" )."' oninput='this.form.SectionBgColor.value=this.value' placeholder='#c7ccd1' />
				<input type='text' style='height:12px;padding:0'  name='SectionBgColor'  value=". esc_attr("{$this->options['logingpower_loginsec_bgcolor']}" )."   size='7'  oninput='this.form.logingpower_loginsec_bgcolor.value=this.value' placeholder='#c7ccd1' />
				<p class='description'> ". esc_html( 'Change Login Section  Color. default:#f0f0f1', 'logingpower' )."</p>
				</label></td>";
				// Section Position
			$this->options['logingpower_loginsec_position']=sanitize_text_field( $this->options['logingpower_loginsec_position']??'None');
			echo "<td><label for='logingpower_loginsec_position'>";
					$items=array('None','Top-Left','Top-Center','Top-Right','Left-Center','Center-Center','Right-Center','Bottom-Left','Bottom-Center','Bottom-Right');
	    echo "<select  name='logingpower_settings[logingpower_loginsec_position]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginsec_position']===$item )?sanitize_text_field('selected="selected"'):'';
	      	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo '</select>';
			echo "<p class='description'> ". esc_html( 'Select Login Section Position', 'logingpower' )."</p>
				</label></td>";
				// Section Width
			$this->options['logingpower_loginsec_width']=absint($this->options['logingpower_loginsec_width']??320);
			echo "<td><label for='logingpower_loginsec_width'>
				<input id='logingpower_loginsec_width' name='logingpower_settings[logingpower_loginsec_width]'  type='range' min='320' max='1000' value=". esc_attr("{$this->options['logingpower_loginsec_width']}" )." oninput='this.form.login_sec_width.value=this.value' />
				<input type='number'  min='320' max='1000'  name='login_sec_width' value='". esc_attr("{$this->options['logingpower_loginsec_width']}" )."'   size='2'  oninput='this.form.logingpower_loginsec_width.value=this.value' />px
				<p class='description'> ". esc_html( 'Change login section width. default:320px', 'logingpower' )."</p>
				</label></td>";
			echo "</tr>";
			$checked= !empty($this->options['logingpower_loginsec_bgimg_show'])? sanitize_text_field('checked'):'';
	    echo "<tr valign='top'>
			<th scope='row'>". esc_html( 'Login Section Background image', 'logingpower' )."</th>
					<td><label for='logingpower_loginsec_bgimg_show'>";
			echo"	<input id='logingpower_loginsec_bgimg_show' name='logingpower_settings[logingpower_loginsec_bgimg_show]'  type='checkbox' value='1' ". esc_attr( $checked)." />";
			echo "<p class='description'> ". esc_html( 'Check To enable login section background image', 'logingpower' )."</p>
					</label></td>";
			// loging section image
			$this->options['logingpower_loginsec_bgimg']=sanitize_url( $this->options['logingpower_loginsec_bgimg']??plugins_url( 'imgs/laptop.jpg', __FILE__ ));
		  echo"<td><label for='logingpower_loginsec_bgimg'>
					<input id='logingpower_loginsec_bgimg' name='logingpower_loginsec_bgimg' class='' type='file'  />
					<p class='description'> ". esc_html( 'Upload / Change Login Section Background Image', 'logingpower' )."</p>
					</label></td>";

			echo "<td><img class='interface_img' src=". esc_attr("{$this->options['logingpower_loginsec_bgimg']}" )." alt='Login Section Background Image'> 
			<p class='description'> ". esc_html( 'Recommended Width:450px ,Height: 700px', 'logingpower' )."</p>
			</td>";
			echo "</tr>";	
			echo "<tr valign='top'><th scope='row'></th>";
			$this->options['logingpower_loginsec_bgimg_repeat']=sanitize_text_field( $this->options['logingpower_loginsec_bgimg_repeat']??'no-repeat');
			echo"<td><label for='logingpower_loginsec_bgimg_repeat'>";
			$items=array('repeat','repeat-x','repeat-y','no-repeat');
		  echo "<select  name='logingpower_settings[logingpower_loginsec_bgimg_repeat]'> ";
		  	foreach ($items as $item) {
		    	$selected= ( $this->options['logingpower_loginsec_bgimg_repeat']===$item )?sanitize_text_field('selected="selected"'):'';
		        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
		    }
		  echo '</select>';
		  echo "<p class='description'> ". esc_html( 'Repeat login section background image', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginsec_bgimg_size']=sanitize_text_field( $this->options['logingpower_loginsec_bgimg_size']??'auto');
			echo "<td><label for='logingpower_loginsec_bgimg_size'>";
			$items=array('auto','width','height','both');
		  echo "<select  name='logingpower_settings[logingpower_loginsec_bgimg_size]'> ";
		  	foreach ($items as $item) {
		    	$selected= ( $this->options['logingpower_loginsec_bgimg_size']===$item )?sanitize_text_field('selected="selected"'):'';
		        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
		      }
		  echo '</select>';
		  echo "<p class='description'> ". esc_html( 'Select login section background image size', 'logingpower' )."</p>
				</label></td>";
			echo "	</tr>	";
		}
	 
		// callback for log 
		public function logingpower_loginlogo(){}
		
		/**
	   * defining log fields 
	   **/
		public function logingpower_loginlogo_fields(){
			$checked= !empty($this->options['logingpower_customlogo_show'])?sanitize_text_field('checked'):'';
	
		 	echo "<tr valign='top'>
					<th scope='row'>". esc_html( 'Custom Logo', 'logingpower' )."</th>
					<td>
					<label for='logingpower_customlogo_show'><input id='logingpower_customlogo_show' name='logingpower_settings[logingpower_customlogo_show]' type='checkbox' value='1' ".esc_attr( $checked)." />	<p class='description'> ". esc_html( 'Check to show custom logo / Uncheck to show default WordPress logo', 'logingpower' )."</p>
				</label> </td>";
			
			$this->options['logingpower_loginlogo_img']=sanitize_url( $this->options['logingpower_loginlogo_img']??plugins_url( 'imgs/butterflyherder_logo.png', __FILE__ ));
			echo "	<td>
				<label for='logingpower_loginlogo_img'>
				<input id='logingpower_loginlogo_img' name='logingpower_loginlogo_img' class='' type='file' accept='.jpg,.png,.jpeg' />
				<p class='description'> ". esc_html( 'Upload / Change cusotom logo', 'logingpower' )."</p>
				</label></td>
			  <td>
					<img class='interface_img' src=". esc_attr("{$this->options['logingpower_loginlogo_img']}" )." alt='logo Image'>
				<p class='description'> ". esc_html( 'Recommended Width:80px Height:80px', 'logingpower' )."</p>
				</td>";
			echo"	</tr>";
			echo "<tr valign='top'>
				<th scope='row'>". esc_html( 'Hide Logo and Show Text ', 'logingpower' )."</th>";
				$checked= !empty($this->options['logingpower_loginlogo_hide'])?sanitize_text_field('checked'):'';
			echo"	<td><label for='logingpower_loginlogo_hide'>";
			echo"	<input id='logingpower_loginlogo_hide' name='logingpower_settings[logingpower_loginlogo_hide]'  class='mycolor-field' type='checkbox' value='1' ".esc_attr( $checked)." />";
			echo "
				<p class='description'> ". esc_html( 'Check To Hide Logo and Show Text ', 'logingpower' )."</p>
				</label></td>";
			echo "<td ><label for='logingpower_loginlogo_text' >";

			$this->options['logingpower_loginlogo_text']=sanitize_text_field(($this->options['logingpower_loginlogo_text'])??'Powered by WordPress');
			echo "<input name='logingpower_settings[logingpower_loginlogo_text]' placeholder='Powered by WordPress' style='padding: 4px;Width:90%;' type='text' 
			value= '".esc_attr("{$this->options['logingpower_loginlogo_text']}")."' />";
			echo "
				<p class='description'> ". esc_html( 'Change Logo Text ', 'logingpower' )."</p>
				</label></td>";
			echo "</tr>";	
			echo "<tr valign='top'>
				<th scope='row'>". esc_html( 'Redirect logo url', 'logingpower' )."</th>";
			$this->options['logingpower_loginlogo_url']=sanitize_url($this->options['logingpower_loginlogo_url']??'https://wordpress.org');
			echo "	<td ><label for='logingpower_loginlogo_url' >
				<input name='logingpower_settings[logingpower_loginlogo_url]' placeholder='https://wordpress.org/' style='padding: 4px;Width:90%;' type='text' value='". esc_attr("{$this->options['logingpower_loginlogo_url']}" )."'/>";
			echo "
				<p class='description'> ". esc_html( 'It will redirect the user on clicking the logo.https://wordpress.org ', 'logingpower' )."</p>
				</label></td>
				</tr>
			";	
		}
		

	  /**
		 * callback login message
		 * */
		public function logingpower_loginmessage()	{ }
		/**
		 *define login message fields  
		 * */
		public function logingpower_loginmessage_fields(){
	  	$this->options['logingpower_loginmessage_bgcolor']=sanitize_hex_color ( $this->options['logingpower_loginmessage_bgcolor']??'#ffffff');
	  	echo "<tr valign='top'>
				<th scope='row'>". esc_html( 'Message Background Color', 'logingpower' )."</th>
				<td><label for='logingpower_loginmessage_bgcolor'>
				<input id='logingpower_loginmessage_bgcolor' name='logingpower_settings[logingpower_loginmessage_bgcolor]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginmessage_bgcolor']}" )." oninput='this.form.MessageBgColor.value=this.value' placeholder='#f0f0f1' />
				<input type='text' style='height:12px;padding:0'  name='MessageBgColor'  value=". esc_attr("{$this->options['logingpower_loginmessage_bgcolor']}" )."   size='7'  oninput='this.form.logingpower_loginmessage_bgcolor.value=this.value' placeholder='#f0f0f1' />
				<p class='description'> ". esc_html( 'Customize message background color.default:#ffffff', 'logingpower' )."</p>
					</label></td>";
			echo"</tr>";
	   	$this->options['logingpower_loginmessage_borderleft_width']=absint($this->options['logingpower_loginmessage_borderleft_width']??4);	
	    echo "<tr valign='top'>
					<th scope='row'>". esc_html( 'Message Border Left', 'logingpower' )."</th>";
			echo"		<td><label for='logingpower_loginmessage_borderleft_width'>
				<input id='logingpower_loginmessage_borderleft_width' name='logingpower_settings[logingpower_loginmessage_borderleft_width]'  type='range' min='4' max='20' value=". esc_attr("{$this->options['logingpower_loginmessage_borderleft_width']}" )." oninput='this.form.msg_borderleft_wdth.value=this.value' />
					<input type='number'   name='msg_borderleft_wdth' min='4' max='20' value=". esc_attr("{$this->options['logingpower_loginmessage_borderleft_width']}" )."   size='2'  oninput='this.form.logingpower_loginmessage_borderleft_width.value=this.value' placeholder ='4'/>px
					<p class='description'> ". esc_html( 'Customize message border left width : default:4px ', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_loginmessage_borderleft_style']=sanitize_text_field( $this->options['logingpower_loginmessage_borderleft_style']??'solid');	
			echo"<td><label for='logingpower_loginmessage_borderleft_style'>";
			$items=array('dotted','dashed','solid','double','groove','ridge','inset','outset','none','hidden');
	    echo "<select  name='logingpower_settings[logingpower_loginmessage_borderleft_style]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginmessage_borderleft_style']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
	    echo "<p class='description'> ". esc_html( 'Customize message border left style : default:solid', 'logingpower' )."</p>
			</label></td>";
			$this->options['logingpower_loginmessage_borderleft_color']=sanitize_hex_color( $this->options['logingpower_loginmessage_borderleft_color']??'#72aee6');
			echo "<td><label for='logingpower_loginmessage_borderleft_color'>
				<input id='logingpower_loginmessage_borderleft_color' name='logingpower_settings[logingpower_loginmessage_borderleft_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginmessage_borderleft_color']}" )." oninput='this.form.MessageBorderLeftColor.value=this.value' placeholder='#f0f0f1' />
				<input type='text' style='height:12px;padding:0'  name='MessageBorderLeftColor'  value=". esc_attr("{$this->options['logingpower_loginmessage_borderleft_color']}" )."   size='7'  oninput='this.form.logingpower_loginmessage_borderleft_color.value=this.value' placeholder='#f0f0f1' />
				<p class='description'> ". esc_html( 'Customize message border-left color.default:#72aee6', 'logingpower' )."</p>
					</label></td>";
			echo "	</tr>	";
			$this->options['logingpower_loginmessage_paddding']=absint($this->options['logingpower_loginmessage_paddding']??12);
			echo "<tr valign='top'>";
			echo"	<th scope='row'>". esc_html( 'Message Padding,Font Size, Color', 'logingpower' )."</th>";
			echo"	<td><label for='logingpower_loginmessage_paddding'>
				<input id='logingpower_loginmessage_paddding' name='logingpower_settings[logingpower_loginmessage_paddding]'  type='range' min='12' max='30' value=". esc_attr("{$this->options['logingpower_loginmessage_paddding']}" )." oninput='this.form.amountInputW.value=this.value' />
				<input type='number'  min='12' max='30'  name='amountInputW' value=". esc_attr("{$this->options['logingpower_loginmessage_paddding']}" )."   size='2'  oninput='this.form.logingpower_loginmessage_paddding.value=this.value' />px
					<p class='description'> ". esc_html( 'Customize message padding. default:12px ', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_loginmessage_fontsize']=absint($this->options['logingpower_loginmessage_fontsize']??12);		
			echo "	<td><label for='logingpower_loginmessage_fontsize'>
					<input id='logingpower_loginmessage_fontsize' name='logingpower_settings[logingpower_loginmessage_fontsize]'  type='range' min='12' max='44' value=". esc_attr("{$this->options['logingpower_loginmessage_fontsize']}" )." oninput='this.form.msgfontsize.value=this.value' />
					<input type='number' min='12' max='44'  name='msgfontsize' value=". esc_attr("{$this->options['logingpower_loginmessage_fontsize']}" )."  oninput='this.form.logingpower_loginmessage_fontsize.value=this.value'  size='2'  />px
					<p class='description'> ". esc_html( 'Customize message font size.default: 12px ', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_loginmessage_color']=sanitize_hex_color($this->options['logingpower_loginmessage_color']??'#000000');
			echo "	<td><label for='logingpower_loginmessage_color'>
				<input id='logingpower_loginmessage_color' name='logingpower_settings[logingpower_loginmessage_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginmessage_color']}" )." oninput='this.form.MessageColor.value=this.value' placeholder='#000' />
				<input type='text' style='height:12px;padding:0'  name='MessageColor'  value=". esc_attr("{$this->options['logingpower_loginmessage_color']}" )."   size='7'  oninput='this.form.logingpower_loginmessage_color.value=this.value' placeholder='#000000' />
				<p class='description'> ". esc_html( 'Change message color.default:#000000', 'logingpower' )."</p>
					</label></td>";
			echo "</tr>";
    }
		/**
		 * callback login form
		 * 
		 * */
		public function logingpower_loginform()	{
			//call back;
		}
		/**
		 * define loginform fields
		 * */
		public function logingpower_loginform_fields(){
			$this->options['logingpower_loginform_background_color']=sanitize_hex_color($this->options['logingpower_loginform_background_color']??'#ffffff');
			echo "<tr valign='top'>
				<th scope='row'>". esc_html( 'Form Color , Font Weight ', 'logingpower' )."</th>";
			echo "	<td><label for='logingpower_loginform_background_color'>
				<input id='logingpower_loginform_background_color' name='logingpower_settings[logingpower_loginform_background_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginform_background_color']}" )." oninput='this.form.FormColor.value=this.value' placeholder='#f0f0f1' />
					<input type='text' style='height:12px;padding:0'  name='FormColor'  value=". esc_attr("{$this->options['logingpower_loginform_background_color']}" )."   size='7'  oninput='this.form.logingpower_loginform_background_color.value=this.value' placeholder='#f0f0f1' />
				<p class='description'> ". esc_html( 'Customize form background color.default:#ffffff', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_loginform_fontweight']=absint($this->options['logingpower_loginform_fontweight']??400);
			echo"
				<td><label for='logingpower_loginform_fontweight'>
				<input id='logingpower_loginform_fontweight' name='logingpower_settings[logingpower_loginform_fontweight]'  type='range' min='100' max='800' step='100' value=". esc_attr("{$this->options['logingpower_loginform_fontweight']}" )." oninput='this.form.formLabelFontweight.value=this.value' />
					<input type='number' min='100' max='800'  name='formLabelFontweight' 
					value=". esc_attr("{$this->options['logingpower_loginform_fontweight']}" )."  oninput='this.form.logingpower_loginform_fontweight.value=this.value'  size='2'  />px
					<p class='description'> ". esc_html( 'Change form  font weight form 100 to 800.default 400', 'logingpower' )."</p>
					</label></td>";
			echo"</tr>";
			$this->options['logingpower_loginform_border_width']=absint($this->options['logingpower_loginform_border_width']??1);
	    echo "<tr valign='top'>
				<th scope='row'>". esc_html( 'Form Border style ', 'logingpower' )."</th>";
			echo"<td><label for='logingpower_loginform_border_width'>
				<input id='logingpower_loginform_border_width' name='logingpower_settings[logingpower_loginform_border_width]'  type='range' min='1' max='20' 
					value=". esc_attr("{$this->options['logingpower_loginform_border_width']}" )." oninput='this.form.formBorderWidth.value=this.value' />
				<input type='number'   name='formBorderWidth' min='1' max='20' value=". esc_attr("{$this->options['logingpower_loginform_border_width']}" )."   size='2'  oninput='this.form.logingpower_loginform_border_width.value=this.value' placeholder='1' />px
					<p class='description'> ". esc_html( 'Change form border width:1px to 20px default width 1px , ', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_loginform_border_style']=sanitize_text_field($this->options['logingpower_loginform_border_style']??'solid');
			echo"<td><label for='logingpower_loginform_border_style'>";
				$items=array('dotted','dashed','solid','double','groove','ridge','inset','outset','none','hidden');
	    echo "<select  name='logingpower_settings[logingpower_loginform_border_style]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginform_border_style']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
			echo "<p class='description'> ". esc_html( 'Seect form border style', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginform_border_color']=sanitize_hex_color($this->options['logingpower_loginform_border_color']??'#c3c4c7');
			echo "<td><label for='logingpower_loginform_border_color'>
				<input id='logingpower_loginform_border_color' name='logingpower_settings[logingpower_loginform_border_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginform_border_color']}" )." oninput='this.form.FormBorderColor.value=this.value' placeholder='#c3c4c7' />
				<input type='text' style='height:12px;padding:0'  name='FormBorderColor'  value=". esc_attr("{$this->options['logingpower_loginform_border_color']}" )."   size='7'  oninput='this.form.logingpower_loginform_border_color.value=this.value' placeholder='#c3c4c7' />
				<p class='description'> ". esc_html( 'Customize form border color.default:#c3c4c7', 'logingpower' )."</p>
				</label></td>";
			echo "	</tr> ";
			$this->options['logingpower_loginform_border_radius_topleft']=absint($this->options['logingpower_loginform_border_radius_topleft']??0);
			echo"<tr valign='top'><th scope='row'>". esc_html( 'Form Border Radius ', 'logingpower' )."</th> ";
			echo"<td><label for='logingpower_loginform_border_radius_topleft'>
				<input id='logingpower_loginform_border_radius_topleft' name='logingpower_settings[logingpower_loginform_border_radius_topleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_border_radius_topleft']}" )." oninput='this.form.formBorderTopLeft.value=this.value' />
				<input type='number'   name='formBorderTopLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_border_radius_topleft']}" )."   size='2'  oninput='this.form.logingpower_loginform_border_radius_topleft.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change top left border radius', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginform_border_radius_topright']=absint($this->options['logingpower_loginform_border_radius_topright']??0);
			echo"<td><label for='logingpower_loginform_border_radius_topright'>
				<input id='logingpower_loginform_border_radius_topright' name='logingpower_settings[logingpower_loginform_border_radius_topright]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_border_radius_topright']}" )." oninput='this.form.formBorderTopRight.value=this.value' />
				<input type='number'   name='formBorderTopRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_border_radius_topright']}" )."   size='2'  oninput='this.form.logingpower_loginform_border_radius_topright.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change top right border radius', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_loginform_border_radius_bottomright']=absint($this->options['logingpower_loginform_border_radius_bottomright']??0);
			echo"<td><label for='logingpower_loginform_border_radius_bottomright'>
				<input id='logingpower_loginform_border_radius_bottomright' name='logingpower_settings[logingpower_loginform_border_radius_bottomright]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_border_radius_bottomright']}" )." oninput='this.form.formBorderBottomRight.value=this.value' />
				<input type='number'   name='formBorderBottomRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_border_radius_bottomright']}" )."   size='2'  oninput='this.form.logingpower_loginform_border_radius_bottomright.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change bottom-right border radius', 'logingpower' )."</p>
					</label></td>";
			echo"</tr>";
			$this->options['logingpower_loginform_border_radius_bottomleft']=absint($this->options['logingpower_loginform_border_radius_bottomleft']??0);
			echo"<tr valign='top'><th scope='row'></th> ";
			echo"<td><label for='logingpower_loginform_border_radius_bottomleft'>
				<input id='logingpower_loginform_border_radius_bottomleft' name='logingpower_settings[logingpower_loginform_border_radius_bottomleft]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginform_border_radius_bottomleft']}" )." oninput='this.form.formBorderBottomLeft.value=this.value' />
				<input type='number'   name='formBorderBottomLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_border_radius_bottomleft']}" )."   size='2'  oninput='this.form.logingpower_loginform_border_radius_bottomleft.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change bottom left border radius', 'logingpower' )."</p>
					</label></td>";
			echo "</tr> ";
			$this->options['logingpower_loginform_label_fontsize']=absint($this->options['logingpower_loginform_label_fontsize']??14);
    	echo "<tr valign='top'>
				<th scope='row'>". esc_html( 'Form Label ', 'logingpower' )."</th>";
			echo"<td><label for='logingpower_loginform_label_fontsize'>
				<input id='logingpower_loginform_label_fontsize' name='logingpower_settings[logingpower_loginform_label_fontsize]'  type='range' min='10' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginform_label_fontsize']}" )." oninput='this.form.formLabelFontSize.value=this.value' />
				<input type='number'   name='formLabelFontSize' min='10' max='100' value=". esc_attr("{$this->options['logingpower_loginform_label_fontsize']}" )."   size='2'  oninput='this.form.logingpower_loginform_label_fontsize.value=this.value' placeholder='14' />px
				<p class='description'> ". esc_html( 'Change form label font size : range 1 to 100px default font size  14px , ', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginform_label_cursor']=sanitize_text_field($this->options['logingpower_loginform_label_cursor']??'pointer');
			echo"<td><label for='logingpower_loginform_label_cursor'>";
			$items=array(' auto ','default',' none ',' context-menu ',' help ',' pointer ',' progress ',' wait ',' cell ',' crosshair ',' text ',' vertical-text ',' alias ',' copy ',' move ',' no-drop ',' not-allowed ',' grab ',' grabbing ',' e-resize ',' n-resize ',' ne-resize ',' nw-resize ',' s-resize ',' se-resize ',' sw-resize ',' w-resize ',' ew-resize ',' ns-resize ',' nesw-resize ',' nwse-resize ',' col-resize ',' row-resize ',' all-scroll ',' zoom-in ',' zoom-out ');
	    echo "<select  name='logingpower_settings[logingpower_loginform_label_cursor]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginform_label_cursor']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
	    $this->options['logingpower_loginform_label_color']=sanitize_hex_color($this->options['logingpower_loginform_label_color']??'#3c434a');
			echo "<p class='description'> ". esc_html( 'Select cursor on label :Default pointer', 'logingpower' )."</p>
				</label></td>";
			echo "<td><label for='logingpower_loginform_label_color'>
				<input id='logingpower_loginform_label_color' name='logingpower_settings[logingpower_loginform_label_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginform_label_color']}" )." oninput='this.form.FormLabelColor.value=this.value' placeholder='#3c434a' />
				<input type='text' style='height:12px;padding:0'  name='FormLabelColor'  value=". esc_attr("{$this->options['logingpower_loginform_label_color']}" )."   size='7'  oninput='this.form.logingpower_loginform_label_color.value=this.value' placeholder='#3c434a' />
				<p class='description'> ". esc_html( 'Customize label color.default:#3c434a', 'logingpower' )."</p>
					</label></td>";
			echo "	</tr> ";
			$this->options['logingpower_loginform_username']=sanitize_text_field($this->options['logingpower_loginform_username']??'Username or Email Address');
			echo "<tr valign='top'><th scope='row'></th>";
			echo "<td ><label for='logingpower_loginform_username' >
				<input name='logingpower_settings[logingpower_loginform_username]'  style='padding: 4px;Width:90%;' type='text' value='". esc_attr("{$this->options['logingpower_loginform_username']}" )."' placeholder='Username or Email Address' />";
			echo "<p class='description'> ". esc_html( 'Change Username or Email Address ', 'logingpower' )."</p></label></td>";
			$this->options['logingpower_loginform_password']=sanitize_text_field($this->options['logingpower_loginform_password']??'Password');
			echo "<td ><label for='logingpower_loginform_password' >
				<input name='logingpower_settings[logingpower_loginform_password]'  style='padding: 4px;Width:90%;' type='text' value='". esc_attr("{$this->options['logingpower_loginform_password']}" )."' placeholder='Password' />";
			$this->options['logingpower_loginform_rememberme']=sanitize_text_field($this->options['logingpower_loginform_rememberme']??'Remember Me');		
			echo "<p class='description'> ". esc_html( 'Change Password ', 'logingpower' )."</p>
				</label></td>";	
			echo "<td ><label for='logingpower_loginform_rememberme' >
				<input name='logingpower_settings[logingpower_loginform_rememberme]'  style='padding: 4px;Width:90%;' type='text' value='". esc_attr("{$this->options['logingpower_loginform_rememberme']}" )."' placeholder='Remember Me' />";
			echo "<p class='description'> ". esc_html( 'Change Remember Me ', 'logingpower' )."</p>
				</label></td>";	
			echo "</tr> ";
			$this->options['logingpower_loginform_input_border_width']=absint($this->options['logingpower_loginform_input_border_width']??1);
	  	echo "<tr valign='top'>
					<th scope='row'>". esc_html( 'Form Input Border ', 'logingpower' )."</th>";
			echo"
				<td><label for='logingpower_loginform_input_border_width'>
				<input id='logingpower_loginform_input_border_width' name='logingpower_settings[logingpower_loginform_input_border_width]'  type='range' min='1' max='20' 
					value=". esc_attr("{$this->options['logingpower_loginform_input_border_width']}" )." oninput='this.form.formInputBorderWidth.value=this.value' />
				<input type='number'   name='formInputBorderWidth' min='1' max='20' value=". esc_attr("{$this->options['logingpower_loginform_input_border_width']}" )."   size='2'  oninput='this.form.logingpower_loginform_input_border_width.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Customize input border width.default:1px , ', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_loginform_input_style']=sanitize_text_field($this->options['logingpower_loginform_input_style']??'solid');
			echo"<td><label for='logingpower_loginform_input_style'>";
				$items=array('dotted','dashed','solid','double','groove','ridge','inset','outset','none','hidden');
	    echo "<select  name='logingpower_settings[logingpower_loginform_input_style]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginform_input_style']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
			echo "<p class='description'> ". esc_html( 'Seect input border style', 'logingpower' )."</p>
			</label></td>";
			$this->options['logingpower_loginform_input_border_color']=sanitize_hex_color($this->options['logingpower_loginform_input_border_color']??'#c3c4c7');
			echo "<td><label for='logingpower_loginform_input_border_color'>
				<input id='logingpower_loginform_input_border_color' name='logingpower_settings[logingpower_loginform_input_border_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginform_input_border_color']}" )." oninput='this.form.ForminputBorderColor.value=this.value' placeholder='#c3c4c7;' />
				<input type='text' style='height:12px;padding:0'  name='ForminputBorderColor'  value=". esc_attr("{$this->options['logingpower_loginform_input_border_color']}" )."   size='7'  oninput='this.form.logingpower_loginform_input_border_color.value=this.value' placeholder='#c3c4c7;' />
				<p class='description'> ". esc_html( 'Customize input border color.default:#c3c4c7;', 'logingpower' )."</p>
					</label></td>";
			echo "	</tr> ";
			echo"<tr valign='top'><th scope='row'>". esc_html( 'Input Radius ', 'logingpower' )."</th> ";
			$this->options['logingpower_loginform_input_radius_topleft']=absint($this->options['logingpower_loginform_input_radius_topleft']??1); 
			echo"<td><label for='logingpower_loginform_input_radius_topleft'>
				<input id='logingpower_loginform_input_radius_topleft' name='logingpower_settings[logingpower_loginform_input_radius_topleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_input_radius_topleft']}" )." oninput='this.form.formImputTopLeft.value=this.value' />
				<input type='number'   name='formImputTopLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_input_radius_topleft']}" )."   size='2'  oninput='this.form.logingpower_loginform_input_radius_topleft.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Change top left input radius', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginform_input_radius_topright']=absint($this->options['logingpower_loginform_input_radius_topright']??1);
			echo"<td><label for='logingpower_loginform_input_radius_topright'>
				<input id='logingpower_loginform_input_radius_topright' name='logingpower_settings[logingpower_loginform_input_radius_topright]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginform_input_radius_topright']}" )." oninput='this.form.formInputTopRight.value=this.value' />
				<input type='number'   name='formInputTopRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_input_radius_topright']}" )."   size='2'  oninput='this.form.logingpower_loginform_input_radius_topright.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Change top right input radius', 'logingpower' )."</p>
				</label></td>";
				// form input radius bottom right
			$this->options['logingpower_loginform_input_radius_bottomright']=absint($this->options['logingpower_loginform_input_radius_bottomright']??1);
			echo"<td><label for='logingpower_loginform_input_radius_bottomright'>
				<input id='logingpower_loginform_input_radius_bottomright' name='logingpower_settings[logingpower_loginform_input_radius_bottomright]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginform_input_radius_bottomright']}" )." oninput='this.form.formInputBottomRight.value=this.value' />
				<input type='number'   name='formInputBottomRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_input_radius_bottomright']}" )."   size='2'  oninput='this.form.logingpower_loginform_input_radius_bottomright.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Change bottom-right input radius', 'logingpower' )."</p>
				</label></td>";
			echo"</tr>";
			$this->options['logingpower_loginform_input_radius_bottomleft']=absint($this->options['logingpower_loginform_input_radius_bottomleft']??1);
			echo"<tr valign='top'><th scope='row'></th> ";
			echo"<td><label for='logingpower_loginform_input_radius_bottomleft'>
				<input id='logingpower_loginform_input_radius_bottomleft' name='logingpower_settings[logingpower_loginform_input_radius_bottomleft]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginform_input_radius_bottomleft']}" )." oninput='this.form.formInputBottomLeft.value=this.value' />
				<input type='number'   name='formInputBottomLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_input_radius_bottomleft']}" )."   size='2'  oninput='this.form.logingpower_loginform_input_radius_bottomleft.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Change bottom left input radius', 'logingpower' )."</p>
				</label></td>";
			echo "</tr> ";
			$this->options['logingpower_loginform_input_height']=absint($this->options['logingpower_loginform_input_height']??50);
			echo"<tr valign='top'><th scope='row'>". esc_html( 'Input Height and color ', 'logingpower' )."</th> ";
			
			echo"<td><label for='logingpower_loginform_input_height'>
				<input id='logingpower_loginform_input_height' name='logingpower_settings[logingpower_loginform_input_height]'  type='range' min='50' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginform_input_height']}" )." oninput='this.form.formInputHeight.value=this.value' />
				<input type='number'   name='formInputHeight' min='50' max='100' value=". esc_attr("{$this->options['logingpower_loginform_input_height']}" )."   size='2'  oninput='this.form.logingpower_loginform_input_height.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Change input height', 'logingpower' )."</p>
				</label></td>";
				$this->options['logingpower_loginform_input_color']=sanitize_hex_color($this->options['logingpower_loginform_input_color']??'#ffffff');
			echo "<td><label for='logingpower_loginform_input_color'>
			<input id='logingpower_loginform_input_color' name='logingpower_settings[logingpower_loginform_input_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginform_input_color']}" )." oninput='this.form.ForminputColor.value=this.value' placeholder='#ffffff;' />
			<input type='text' style='height:12px;padding:0'  name='ForminputColor'  value=". esc_attr("{$this->options['logingpower_loginform_input_color']}" )."   size='7'  oninput='this.form.logingpower_loginform_input_color.value=this.value' placeholder='#ffffff;' />
			
			<p class='description'> ". esc_html( 'Customize input color', 'logingpower' )."</p>
			</label></td>";
			echo "</tr> ";
			$this->options['logingpower_loginform_submit_width']=absint($this->options['logingpower_loginform_submit_width']??25);
			echo"<tr valign='top'><th scope='row'>". esc_html( 'Submit Button ', 'logingpower' )."</th> ";
			echo"<td><label for='logingpower_loginform_submit_width'>
				<input id='logingpower_loginform_submit_width' name='logingpower_settings[logingpower_loginform_submit_width]'  type='range' min='25' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_submit_width']}" )." oninput='this.form.formSubmitButtonWidth.value=this.value' />
				<input type='number'   name='formSubmitButtonWidth' min='25' max='100' value=". esc_attr("{$this->options['logingpower_loginform_submit_width']}" )."   size='2'  oninput='this.form.logingpower_loginform_submit_width.value=this.value' placeholder='25' />%
				<p class='description'> ". esc_html( 'Change submit button width', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginform_submit_height']=absint($this->options['logingpower_loginform_submit_height']??32);
			echo"<td><label for='logingpower_loginform_submit_height'>
				<input id='logingpower_loginform_submit_height' name='logingpower_settings[logingpower_loginform_submit_height]'  type='range' min='32' max='100' 
				value=". esc_attr("{$this->options['logingpower_loginform_submit_height']}" )." oninput='this.form.formSubmitButtonHeight.value=this.value' />
				<input type='number'   name='formSubmitButtonHeight' min='32' max='100' value=". esc_attr("{$this->options['logingpower_loginform_submit_height']}" )."   size='2'  oninput='this.form.logingpower_loginform_submit_height.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Change submit button height', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginform_submit_fontsize']=absint($this->options['logingpower_loginform_submit_fontsize']??13);
			echo"<td><label for='logingpower_loginform_submit_fontsize'>
			<input id='logingpower_loginform_submit_fontsize' name='logingpower_settings[logingpower_loginform_submit_fontsize]'  type='range' min='13' max='44' value=". esc_attr("{$this->options['logingpower_loginform_submit_fontsize']}" )." oninput='this.form.fromSubmitFontsize.value=this.value' />
			<input type='number' min='13' max='44'  name='fromSubmitFontsize' value=". esc_attr("{$this->options['logingpower_loginform_submit_fontsize']}" )."  oninput='this.form.logingpower_loginform_submit_fontsize.value=this.value'  size='2'  placeholder='13'/>px
			<p class='description'> ". esc_html( 'Change submit font size form 13px to 44px', 'logingpower' )."</p>
			</label></td>";
			echo "</tr> ";
			$this->options['logingpower_loginform_submit_bgcolor']=sanitize_hex_color($this->options['logingpower_loginform_submit_bgcolor']??'#2271b1');
			echo"<tr valign='top'><th scope='row'></th> ";
			echo "<td><label for='logingpower_loginform_submit_bgcolor'>
				<input id='logingpower_loginform_submit_bgcolor' name='logingpower_settings[logingpower_loginform_submit_bgcolor]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginform_submit_bgcolor']}" )." oninput='this.form.ForminputColor.value=this.value' placeholder='#2271b1' />
				<input type='text' style='height:12px;padding:0'  name='ForminputColor'  value=". esc_attr("{$this->options['logingpower_loginform_submit_bgcolor']}" )."   size='7'  oninput='this.form.logingpower_loginform_submit_bgcolor.value=this.value' placeholder='#2271b1' />
				<p class='description'> ". esc_html( 'Customize submit button color.default:#2271b1 ', 'logingpower' )."</p>
				</label></td>";
				// submit label color 
				$this->options['logingpower_loginform_submit_lbcolor']=sanitize_hex_color($this->options['logingpower_loginform_submit_lbcolor']??'#ffffff');
			echo "<td><label for='logingpower_loginform_submit_lbcolor'>
				<input id='logingpower_loginform_submit_lbcolor' name='logingpower_settings[logingpower_loginform_submit_lbcolor]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_loginform_submit_lbcolor']}" )." oninput='this.form.ForminputColor.value=this.value' placeholder='#ffffff;' />
					<input type='text' style='height:12px;padding:0'  name='ForminputColor'  value=". esc_attr("{$this->options['logingpower_loginform_submit_lbcolor']}" )."   size='7'  oninput='this.form.logingpower_loginform_submit_lbcolor.value=this.value' placeholder='#ffffff;' />
					<p class='description'> ". esc_html( 'Customize submit label color', 'logingpower' )."</p></label></td>";
			$this->options['logingpower_loginform_submit_label']=sanitize_text_field($this->options['logingpower_loginform_submit_label']??'Log In');
			echo "<td ><label for='logingpower_loginform_submit_label' >
				<input name='logingpower_settings[logingpower_loginform_submit_label]'  style='padding: 4px;Width:90%;' type='text' value='". esc_attr("{$this->options['logingpower_loginform_submit_label']}" )."' placeholder='Log In' />";
			echo "<p class='description'> ". esc_html( 'Customize Log In label', 'logingpower' )."</p></label></td>";
			echo "</tr> ";
			$this->options['logingpower_loginform_submit_radius_topleft']=absint($this->options['logingpower_loginform_submit_radius_topleft']??0);
			echo"<tr valign='top'><th scope='row'></th> ";
			echo"<td><label for='logingpower_loginform_submit_radius_topleft'>
				<input id='logingpower_loginform_submit_radius_topleft' name='logingpower_settings[logingpower_loginform_submit_radius_topleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_submit_radius_topleft']}" )." oninput='this.form.formSubmitTopLeft.value=this.value' />
				<input type='number'   name='formSubmitTopLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_submit_radius_topleft']}" )."   size='2'  oninput='this.form.logingpower_loginform_submit_radius_topleft.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change top left radius', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginform_submit_radius_topright']=absint($this->options['logingpower_loginform_submit_radius_topright']??0);
			echo"<td><label for='logingpower_loginform_submit_radius_topright'>
				<input id='logingpower_loginform_submit_radius_topright' name='logingpower_settings[logingpower_loginform_submit_radius_topright]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_submit_radius_topright']}" )." oninput='this.form.formSubmitTopRight.value=this.value' />
				<input type='number'   name='formSubmitTopRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_submit_radius_topright']}" )."   size='2'  oninput='this.form.logingpower_loginform_submit_radius_topright.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Change top right radius', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_loginform_submit_radius_bottomright']=absint($this->options['logingpower_loginform_submit_radius_bottomright']??0);
			echo"<td><label for='logingpower_loginform_submit_radius_bottomright'>
				<input id='logingpower_loginform_submit_radius_bottomright' name='logingpower_settings[logingpower_loginform_submit_radius_bottomright]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_submit_radius_bottomright']}" )." oninput='this.form.formSubmitBottomRight.value=this.value' />
				<input type='number'   name='formSubmitBottomRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_submit_radius_bottomright']}" )."   size='2' oninput='this.form.logingpower_loginform_submit_radius_bottomright.value=this.value' placeholder='0' />px
					<p class='description'> ". esc_html( 'Change bottom-right radius', 'logingpower' )."</p>
					</label></td>";
			echo"</tr>";
			$this->options['logingpower_loginform_submit_radius_bottomleft']=absint($this->options['logingpower_loginform_submit_radius_bottomleft']??0);
			echo"<tr valign='top'><th scope='row'></th> ";
			echo"<td><label for='logingpower_loginform_submit_radius_bottomleft'>
				<input id='logingpower_loginform_submit_radius_bottomleft' name='logingpower_settings[logingpower_loginform_submit_radius_bottomleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_loginform_submit_radius_bottomleft']}" )." oninput='this.form.formSubmitBottomLeft.value=this.value' />
				<input type='number'   name='formSubmitBottomLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_loginform_submit_radius_bottomleft']}" )."   size='2'  oninput='this.form.logingpower_loginform_submit_radius_bottomleft.value=this.value' placeholder='0' />px
					<p class='description'> ". esc_html( 'Change bottom left radius', 'logingpower' )."</p>
				</label></td>";
			echo "</tr> ";
			$checked= !empty($this->options['logingpowerloginform_background_show'])?sanitize_text_field('checked'):'';
		
		 
			
	  	// $this->options['logingpower_loginform_background_img']=sanitize_url($this->options['logingpower_loginform_background_img']??plugins_url( 'imgs/loginform_bglaptop.jpg', __FILE__ ));
			echo "<tr valign='top'>";
			echo "<th scope='row'>". esc_html( 'Form background image', 'logingpower' )."</th>
					<td><label for='logingpowerloginform_background_show'>";
			echo"	<input id='logingpowerloginform_background_show' name='logingpower_settings[logingpowerloginform_background_show]'  class='mycolor-field' type='checkbox' value='1' ".esc_attr( $checked)." />";
			echo "
					<p class='description'> ". esc_html( 'Check to show form background image', 'logingpower' )."</p>
				</label></td>
				";
		$this->options['logingpower_loginform_background_img']=sanitize_url($this->options['logingpower_loginform_background_img']??plugins_url( 'imgs/loginform_bglaptop.jpg', __FILE__ ));	
		echo "<td><label for='logingpower_loginform_background_img'>
				<input id='logingpower_loginform_background_img' name='logingpower_loginform_background_img'  type='file' accept='.jpg,.png,.jpeg' />
				<p class='description'> ". esc_html( 'Upload / Change Login From Background Image', 'logingpower' )."</p>
				</label></td>";
				echo "<td>
				<img class='interface_img' src=". esc_url(plugins_url( 'imgs/loginform_bglaptop.jpg', __FILE__ ))." alt='Login Form image'/>
				<p class='description'> ". esc_html( 'Recommended Width:450px,Height:350px', 'logingpower' )."</p>
				</td>";

			echo "</tr> ";
			echo"	<tr > <th scope='row'></th>";
			echo"
				<td><label for='logingpower_loginform_background_repeat'>";
				$items=array('repeat','repeat-x','repeat-y','no-repeat');
	    echo "<select  name='logingpower_settings[logingpower_loginform_background_repeat]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginform_background_repeat']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
			echo "<p class='description'> ". esc_html( 'Repeat login form background image ', 'logingpower' )."</p>
				</label></td>
				";
			echo"
				<td><label for='logingpower_loginform_background_imgsize'>";
				$items=array('auto','width','height','both');
		  echo "<select  name='logingpower_settings[logingpower_loginform_background_imgsize]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_loginform_background_imgsize']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo '</select>';
			echo "<p class='description'> ". esc_html( 'Select form background image size', 'logingpower' )."</p>
				</label></td>
				";

			echo "</tr>";
	  }
	  /**
	   * callback lastpassword
	   * 
	  */
	  public function logingpower_lostpassword(){ }
	  /**
	   * define fields for lastpassword
	   * 
	  */
		public function logingpower_lostpassword_fields (){
			$this->options['logingpower_lostpassword_label_fontsize']=absint($this->options['logingpower_lostpassword_label_fontsize']??13);
	    echo "<tr valign='top'>";
	    echo"<th scope='row'>". esc_html( 'Lost your password?', 'logingpower' )."</th>
				<td><label for='logingpower_lostpassword_label_fontsize'>
				<input id='logingpower_lostpassword_label_fontsize' name='logingpower_settings[logingpower_lostpassword_label_fontsize]'  type='range' min='10' max='100' 
					value='". esc_attr("{$this->options['logingpower_lostpassword_label_fontsize']}" )."' oninput='this.form.lostpasswordLabelFontSize.value=this.value' placeholder='13' />
				<input type='number'   name='lostpasswordLabelFontSize' min='10' max='100' value=". esc_attr("{$this->options['logingpower_lostpassword_label_fontsize']}" )."   size='2'  oninput='this.form.logingpower_lostpassword_label_fontsize.value=this.value' placeholder='14' /><span>px</span>
				<p class='description'> ". esc_html( 'Customize font size.Default:13px', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_lostpassword_label_color']=sanitize_hex_color($this->options['logingpower_lostpassword_label_color']??'#50575e');
			echo "<td><label for='logingpower_lostpassword_label_color'>
					<input id='logingpower_lostpassword_label_color' name='logingpower_settings[logingpower_lostpassword_label_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_lostpassword_label_color']}" )." oninput='this.form.lostpasswordLabelColor.value=this.value' placeholder='13' 
					 />
					<input type='text' style='height:12px;padding:0'  name='lostpasswordLabelColor'  value=". esc_attr("{$this->options['logingpower_lostpassword_label_color']}" )."   size='7'  oninput='this.form.logingpower_lostpassword_label_color.value=this.value' placeholder='#50575e' />
					<p class='description'> ". esc_html( 'Customize label color.default:#50575e', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_lostpassword_label_hover_color']=sanitize_hex_color($this->options['logingpower_lostpassword_label_hover_color']??'#135e96');
			echo "<td><label for='logingpower_lostpassword_label_hover_color'>
					<input id='logingpower_lostpassword_label_hover_color' name='logingpower_settings[logingpower_lostpassword_label_hover_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_lostpassword_label_hover_color']}" )." 
						oninput='this.form.lostpasswordHoverColor.value=this.value'  
					 />
					<input type='text' style='height:12px;padding:0'  name='lostpasswordHoverColor'  value=". esc_attr("{$this->options['logingpower_lostpassword_label_hover_color']}" )."   size='7'  oninput='this.form.logingpower_lostpassword_label_hover_color.value=this.value' placeholder='#135e96' />
					<p class='description'> ". esc_html( 'Customize hover color.Default:#135e96', 'logingpower' )."</p>
					</label></td>";
			echo "	</tr> ";
			$this->options['logingpower_lostpassword_text']=sanitize_text_field($this->options['logingpower_lostpassword_text']??'Lost your password?');
			echo "<tr valign='top'><th scope='row'></th>";
			echo"	<td ><label for='logingpower_lostpassword_text' >";
			echo "<input name='logingpower_settings[logingpower_lostpassword_text]' placeholder='Lost your password?' style='padding: 4px;Width:90%;' type='text' 

			value='". esc_attr("{$this->options['logingpower_lostpassword_text']}" )."' />";
			echo "<p class='description'> ". esc_html( 'Customize content of Lost your password? ', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_lostpassword_label_cursor']=sanitize_text_field($this->options['logingpower_lostpassword_label_cursor']??'pointer');
			echo"<td><label for='logingpower_lostpassword_label_cursor'>";
			$items=array('auto','default','none ','context-menu ','help ','pointer ','progress ','wait ','cell ','crosshair ','text ','vertical-text ','alias','copy','move','no-drop','not-allowed','grab','grabbing','e-resize','n-resize','ne-resize','nw-resize','s-resize','se-resize','sw-resize','w-resize','ew-resize','ns-resize','nesw-resize','nwse-resize','col-resize','row-resize','all-scroll','zoom-in','zoom-out');
	    echo "<select  name='logingpower_settings[logingpower_lostpassword_label_cursor]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_lostpassword_label_cursor']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
	    echo "<p class='description'> ". esc_html( 'Select cursor on label :Default:pointer', 'logingpower' )."</p>
				</label></td>";
			echo "</tr> ";	
			$this->options['logingpower_backtoblog_label_fontsize']=absint($this->options['logingpower_backtoblog_label_fontsize']??13);
			echo "<tr valign='top'>";
	    echo"
				<th scope='row'>". esc_html( 'Back to Blog', 'logingpower' )."</th>
				<td><label for='logingpower_backtoblog_label_fontsize'>
				<input id='logingpower_backtoblog_label_fontsize' name='logingpower_settings[logingpower_backtoblog_label_fontsize]'  type='range' min='10' max='100' 
					value='". esc_attr("{$this->options['logingpower_backtoblog_label_fontsize']}" )."' oninput='this.form.backtoblogLabelFontSize.value=this.value' placeholder='13' />
				<input type='number'   name='backtoblogLabelFontSize' min='10' max='100' value='". esc_attr("{$this->options['logingpower_backtoblog_label_fontsize']}" )."'  size='2'  oninput='this.form.logingpower_backtoblog_label_fontsize.value=this.value' placeholder='14' /><span>px</span>
					<p class='description'> ". esc_html( 'Customize label font size.Default:13px , ', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_backtoblog_label_color']=sanitize_hex_color($this->options['logingpower_backtoblog_label_color']??'#50575e');
			echo "<td><label for='logingpower_backtoblog_label_color'>
					<input id='logingpower_backtoblog_label_color' name='logingpower_settings[logingpower_backtoblog_label_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_backtoblog_label_color']}" )." 
					oninput='this.form.BacktoBlogLabelColor.value=this.value'  
					 />
					<input type='text' style='height:12px;padding:0'  name='BacktoBlogLabelColor'  value=". esc_attr("{$this->options['logingpower_backtoblog_label_color']}" )."   size='7'  oninput='this.form.logingpower_backtoblog_label_color.value=this.value' placeholder='#135e96' />
				<p class='description'> ". esc_html( 'Customize label color.Default:#50575e', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_backtoblog_label_hover_color']=sanitize_hex_color($this->options['logingpower_backtoblog_label_hover_color']??'#135e96');	
			echo "<td><label for='logingpower_backtoblog_label_hover_color'>
					<input id='logingpower_backtoblog_label_hover_color' name='logingpower_settings[logingpower_backtoblog_label_hover_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_backtoblog_label_hover_color']}" )." oninput='this.form.BacktoBlogHoverColor.value=this.value'  
					 />
					<input type='text' style='height:12px;padding:0'  name='BacktoBlogHoverColor'  value='". esc_attr("{$this->options['logingpower_backtoblog_label_hover_color']}" )."'   size='7'  oninput='this.form.logingpower_backtoblog_label_hover_color.value=this.value' placeholder='#135e96' />
				<p class='description'> ". esc_html( 'Customize hover color.Default:#135e96', 'logingpower' )."</p>
					</label></td>";
			echo "	</tr> ";
			echo "<tr valign='top'><th scope='row'></th>";
			// $this->options['logingpower_backtoblog_text']=sanitize_text_field($this->options['logingpower_backtoblog_text']??'← Go to');
			// echo"	<td ><label for='logingpower_backtoblog_text' >";
			// echo "<input name='logingpower_settings[logingpower_backtoblog_text]' placeholder='← Go to' style='padding:4px;Width:90%;' type='text' value='". esc_attr("{$this->options['logingpower_backtoblog_text']}" )."' />";
			// echo "<p class='description'> ". esc_html( 'Customize content of  ← Go to', 'logingpower' )."</p>
			// 	</label></td>";
			$this->options['logingpower_backtoblog_label_cursor']=sanitize_text_field($this->options['logingpower_backtoblog_label_cursor']??'auto');
			echo"<td><label for='logingpower_backtoblog_label_cursor'>";
				$items=array('auto','default','none ','context-menu ','help ','pointer ','progress ','wait ','cell ','crosshair ','text ','vertical-text ','alias','copy','move','no-drop','not-allowed','grab','grabbing','e-resize','n-resize','ne-resize','nw-resize','s-resize','se-resize','sw-resize','w-resize','ew-resize','ns-resize','nesw-resize','nwse-resize','col-resize','row-resize','all-scroll','zoom-in','zoom-out');
	    echo "<select  name='logingpower_settings[logingpower_backtoblog_label_cursor]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_backtoblog_label_cursor']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
	    echo "<p class='description'> ". esc_html( 'Select cursor on label :Recommended:pointer', 'logingpower' )."</p>
				</label></td>";
			echo "</tr> ";	
		}
		/**
		 * callback for template
		 * */
		public function logingpower_templates_sec(){ }
		/**
		 * Define fields for  template
		 * */
		public function logingpower_templates_fields(){
			$this->options[ 'logingpower_template' ]=sanitize_text_field($this->options[ 'logingpower_template' ]??'none');
			
			echo "<tr valign='top'><th scope='row'>". esc_html( 'Default', 'logingpower' )."</th>";
			echo"	<td ><label for='none' >";
			echo "<input type='radio'  name='logingpower_settings[logingpower_template]' id='none' value='none'  ".checked('none', $this->options[ 'logingpower_template' ],false)."  />";
			echo "<p class='description'> ". esc_html( 'Preferences of users', 'logingpower' )."</p></label></td>";
			echo"</tr>";
			echo "<tr valign='top'><th scope='row'>". esc_html( 'Leaf Template', 'logingpower' )."</th>";
			echo"	<td style='width: 259px; vertical-align:top'><label for='leaf' >";
			echo "<input type='radio'  name='logingpower_settings[logingpower_template]' id='leaf' value='leaf'   ".checked('leaf', $this->options[ 'logingpower_template' ],false)."  />";
			echo "<p class='description' > ". esc_html( 'leaf style ', 'logingpower' )."</p></label></td>";
			echo"<td> </td>";
			
			
			echo "<td> <img class='interface_img' src= ".esc_url(sanitize_url( plugins_url( 'imgs/template_leaf.jpg', __FILE__ )))." alt='logingpower Template leaf img' style='width:80%;height:100%;'>
							</td>";
			echo"<td> </td>";
			echo"</tr>";
			echo "<tr valign='top'><th scope='row'>". esc_html( 'Logo Template', 'logingpower' )."</th>";
			echo"	<td style='width: 259px; vertical-align:top'><label for='templatelogo' >";
			echo "<input type='radio'  name='logingpower_settings[logingpower_template]' id='templatelogo' value='logo'  ".checked('logo', $this->options[ 'logingpower_template' ],false)."   />";
			echo "<p class='description'> ". esc_html( 'Logo', 'logingpower' )."</p></label></td>";
			echo"<td> </td>";
			echo "<td> <img class='interface_img' src= ".esc_url( sanitize_url( plugins_url( 'imgs/template_logo.jpg', __FILE__ )))." alt='logingpower loginform background img' style='width:80%;height:100%;'>
							</td>";
			echo"<td> </td>";
			echo "</tr>";
		}
		/**
		 * callback for Language Switcher
		 * */		 
		public function logingpower_languageswitcher_sec(){
			// code...
		}
		/**
		 * Define fields for Language Switcher
		 * */
		public function logingpower_languageswitcher_fields(){
			$checked=!empty($this->options['logingpower_languageswitcher_background_color_show'])?sanitize_text_field('checked'):'';
			echo "<tr valign='top'><th scope='row'>". esc_html( 'Language Switcher Color, Width', 'logingpower' )."</th>";
	    echo"<td><label for='logingpower_languageswitcher_background_color_show'>
	   		<input id='logingpower_languageswitcher_background_color_show' name='logingpower_settings[logingpower_languageswitcher_background_color_show]'  class='mycolor-field' type='checkbox' value='1' ".esc_attr( $checked)." />";
			echo "<p class='description'> ". esc_html( 'Check to enable language switcher background-color:default:none', 'logingpower' )."</p>
				</label></td>	";	
 			$this->options['logingpower_languageswitcher_background_color']=sanitize_hex_color($this->options['logingpower_languageswitcher_background_color']??'#c7ccd1');
			echo "<td><label for='logingpower_languageswitcher_background_color'>
					<input id='logingpower_languageswitcher_background_color' name='logingpower_settings[logingpower_languageswitcher_background_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_languageswitcher_background_color']}" )." oninput='this.form.langaugeswitcherBgColor.value=this.value' placeholder='#c7ccd1' />
					<input type='text' style='height:12px;padding:0'  name='langaugeswitcherBgColor'  value=". esc_attr("{$this->options['logingpower_languageswitcher_background_color']}" )."   size='7'  oninput='this.form.logingpower_languageswitcher_background_color.value=this.value' placeholder='#c7ccd1' />
					<p class='description'> ". esc_html( 'Select language switcher background-color', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_languageswitcher_width']=absint($this->options['logingpower_languageswitcher_width']??100);
			echo"	<td><label for='logingpower_languageswitcher_width'>
					<input id='logingpower_languageswitcher_width' name='logingpower_settings[logingpower_languageswitcher_width]'  type='range' min='50' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_width']}" )." oninput='this.form.langaugeswitcherWidth.value=this.value' placeholder='50' />
					<input type='number'   name='langaugeswitcherWidth' min='50' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_width']}" )."   size='3'  oninput='this.form.logingpower_languageswitcher_width.value=this.value' placeholder='14' /><span>%</span>
					<p class='description'> ". esc_html( 'Customize language switcher width:50% to 100% default:100%, ', 'logingpower' )."</p>
					</label></td>";
			echo "	</tr> ";
			$this->options['logingpower_languageswitcher_border_width']=absint($this->options['logingpower_languageswitcher_border_width']??0);	
			echo"<tr valign='top'><th scope='row'>". esc_html( 'Language Switcher Border Width, Style, Color', 'logingpower' )."</th> ";
			echo"<td><label for='logingpower_languageswitcher_border_width'>
					<input id='logingpower_languageswitcher_border_width' name='logingpower_settings[logingpower_languageswitcher_border_width]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_border_width']}" )." oninput='this.form.langaugeswitcherBorderWidth.value=this.value' placeholder='0'/>
					<input type='number'   name='langaugeswitcherBorderWidth' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_border_width']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_border_width.value=this.value' placeholder='0' />px
					<p class='description'> ". esc_html( 'Customize border width:default:none', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_languageswitcher_border_style']=sanitize_text_field($this->options['logingpower_languageswitcher_border_style']??'none');
			echo"<td><label for='logingpower_languageswitcher_border_style'>";
			$items=array('dotted','dashed','solid','double','groove','ridge','inset','outset','none','hidden');
	    echo "<select  name='logingpower_settings[logingpower_languageswitcher_border_style]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_languageswitcher_border_style']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
	    echo "<p class='description'> ". esc_html( 'Select border style:default solid', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_border_color']=sanitize_hex_color($this->options['logingpower_languageswitcher_border_color']??'#2271b1');
			echo "<td><label for='logingpower_languageswitcher_border_color'>
				<input id='logingpower_languageswitcher_border_color' name='logingpower_settings[logingpower_languageswitcher_border_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_languageswitcher_border_color']}" )." oninput='this.form.langaugeswitcherBordercolor.value=this.value' placeholder='#2271b1'  />
				<input type='text' style='height:12px;padding:0'  name='langaugeswitcherBordercolor'  value=". esc_attr("{$this->options['logingpower_languageswitcher_border_color']}" )."   size='7'  oninput='this.form.logingpower_languageswitcher_border_color.value=this.value' placeholder='#2271b1' />
				<p class='description'> ". esc_html( 'Customize language switcher border color, default:#2271b1', 'logingpower' )."</p>
					</label></td>";
			echo"</tr>";
			echo"<tr valign='top'><th scope='row'>".esc_html( 'Language switcher border radius', 'logingpower' )."</th> ";
			$this->options['logingpower_languageswitcher_border_radius_topleft']=absint($this->options['logingpower_languageswitcher_border_radius_topleft']??0);
			echo"<td><label for='logingpower_languageswitcher_border_radius_topleft'>
				<input id='logingpower_languageswitcher_border_radius_topleft' name='logingpower_settings[logingpower_languageswitcher_border_radius_topleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_border_radius_topleft']}" )." oninput='this.form.languageswitcherBorderTopLeft.value=this.value' />
				<input type='number'   name='languageswitcherBorderTopLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_border_radius_topleft']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_border_radius_topleft.value=this.value' placeholder='1' />px
					<p class='description'> ". esc_html( 'Customize language switcher top-left border radius', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_border_radius_topright']=absint($this->options['logingpower_languageswitcher_border_radius_topright']??0);
			echo"<td><label for='logingpower_languageswitcher_border_radius_topright'>
				<input id='logingpower_languageswitcher_border_radius_topright' name='logingpower_settings[logingpower_languageswitcher_border_radius_topright]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_border_radius_topright']}" )." oninput='this.form.languageswiterBorderTopRight.value=this.value' />
				<input type='number'   name='languageswiterBorderTopRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_border_radius_topright']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_border_radius_topright.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Customize language switcher top-right border radius', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_border_radius_bottomright']=absint($this->options['logingpower_languageswitcher_border_radius_bottomright']??0);
			echo"<td><label for='logingpower_languageswitcher_border_radius_bottomright'>
				<input id='logingpower_languageswitcher_border_radius_bottomright' name='logingpower_settings[logingpower_languageswitcher_border_radius_bottomright]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_border_radius_bottomright']}" )." oninput='this.form.languageswiterBorderBottomRight.value=this.value' />
				<input type='number'   name='languageswiterBorderBottomRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_border_radius_bottomright']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_border_radius_bottomright.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Customize language switcher bottom-right border radius', 'logingpower' )."</p>
				</label></td>";
			echo"</tr>";
			echo"<tr valign='top'><th scope='row'></th> ";
			$this->options['logingpower_languageswitcher_border_radius_bottomleft']=absint($this->options['logingpower_languageswitcher_border_radius_bottomleft']??0);
			echo"<td><label for='logingpower_languageswitcher_border_radius_bottomleft'>
				<input id='logingpower_languageswitcher_border_radius_bottomleft' name='logingpower_settings[logingpower_languageswitcher_border_radius_bottomleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_border_radius_bottomleft']}" )." oninput='this.form.languageswiterBorderBottomLeft.value=this.value' />
				<input type='number'   name='languageswiterBorderBottomLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_border_radius_bottomleft']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_border_radius_bottomleft.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Customize language switcher bottom-left border radius', 'logingpower' )."</p>
				</label></td>";
			echo "</tr> ";	
			$this->options['logingpower_languageswitcher_padding_top']=absint($this->options['logingpower_languageswitcher_padding_top']??0);
			echo"<tr valign='top'><th scope='row'>".esc_html( 'Language Switcher Padding', 'logingpower' )."</th> ";
			echo"<td><label for='logingpower_languageswitcher_padding_top'>
				<input id='logingpower_languageswitcher_padding_top' name='logingpower_settings[logingpower_languageswitcher_padding_top]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_languageswitcher_padding_top']}" )." oninput='this.form.languageswitcherPaddingTop.value=this.value' />
				<input type='number'   name='languageswitcherPaddingTop' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_padding_top']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_padding_top.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Customize padding-top.default:0', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_padding_right']=absint($this->options['logingpower_languageswitcher_padding_right']??0);
			echo"<td><label for='logingpower_languageswitcher_padding_right'>
				<input id='logingpower_languageswitcher_padding_right' name='logingpower_settings[logingpower_languageswitcher_padding_right]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_languageswitcher_padding_right']}" )." oninput='this.form.languageswiterPaddingRight.value=this.value' />
				<input type='number'   name='languageswiterPaddingRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_padding_right']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_padding_right.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Customize padding-right.default:0 ', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_padding_bottom']=absint($this->options['logingpower_languageswitcher_padding_bottom']??0);
			echo"<td><label for='logingpower_languageswitcher_padding_bottom'>
				<input id='logingpower_languageswitcher_padding_bottom' name='logingpower_settings[logingpower_languageswitcher_padding_bottom]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_languageswitcher_padding_bottom']}" )." oninput='this.form.languageswiterPaddingBottom.value=this.value' />
				<input type='number'   name='languageswiterPaddingBottom' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_padding_bottom']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_padding_bottom.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Customize padding-bottom.default:0', 'logingpower' )."</p>
				</label></td>";
			echo "</tr> ";	
			$this->options['logingpower_languageswitcher_padding_left']=absint($this->options['logingpower_languageswitcher_padding_left']??0);
			echo "<tr valign='top'><th scope='row'></th>";
			echo"<td><label for='logingpower_languageswitcher_padding_left'>
				<input id='logingpower_languageswitcher_padding_left' name='logingpower_settings[logingpower_languageswitcher_padding_left]'  type='range' min='0' max='100' 
				value=". esc_attr("{$this->options['logingpower_languageswitcher_padding_left']}" )." oninput='this.form.languageswiterPaddingLeft.value=this.value' />
				<input type='number'   name='languageswiterPaddingLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_padding_left']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_padding_left.value=this.value' placeholder='0' />px
				<p class='description'> ". esc_html( 'Customize padding-left.default:', 'logingpower' )."</p>
				</label></td>";
			echo"</tr>";
			$this->options['logingpower_languageswitcher_background_color']=$this->options['logingpower_languageswitcher_background_color']??'#f0f0f1';
	    echo "<tr valign='top'>";
				$checked= !empty($this->options['logingpower_languageswitcher_background_show'])?sanitize_text_field('checked'):'';
			echo "<th scope='row'>". esc_html( 'Language Switcher Background Image', 'logingpower' )."</th>
					<td><label for='logingpower_languageswitcher_background_show'>";
			echo"	<input id='logingpower_languageswitcher_background_show' name='logingpower_settings[logingpower_languageswitcher_background_show]'  class='mycolor-field' type='checkbox' value='1' ".esc_attr( $checked)." />";
			echo "
				<p class='description'> ". esc_html( 'Check to enable language switcher image', 'logingpower' )."</p>
			</label></td>";
			
			$this->options['logingpower_languageswitcher_background_img']=sanitize_url($this->options['logingpower_languageswitcher_background_img']??plugins_url( 'imgs/language_switcher.jpg', __FILE__ ));
			echo "<td><label for='logingpower_languageswitcher_background_img'>
				<input id='logingpower_languageswitcher_background_img' name='logingpower_languageswitcher_background_img'  type='file' accept='.jpg,.png,.jpeg' />
				<p class='description'> ". esc_html( 'Upload / Change language switcher image', 'logingpower' )."</p>
				</label></td>";
			echo "<td>
				<img class='langswitcher_img' src=". esc_attr("{$this->options['logingpower_languageswitcher_background_img']}" )." alt='logingpower languageswitcher background img' width:200px height:50px>
				<p class='description'> ". esc_html( 'Recommended height:50px', 'logingpower' )."</p>
				</td>";
			echo "</tr> ";
			echo"	<tr > <th scope='row'></th>";
			echo"
				<td><label for='logingpower_languageswitcher_background_repeat'>";
				$items=array('repeat','repeat-x','repeat-y','no-repeat');
	    echo "<select  name='logingpower_settings[logingpower_languageswitcher_background_repeat]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_languageswitcher_background_repeat']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
	    echo "<p class='description'> ". esc_html( 'Repeat language switcher image ', 'logingpower' )."</p>
				</label></td>
				";
			echo"
				<td><label for='logingpower_languageswitcher_background_imgsize'>";
				$items=array('auto','width','height','both');
	    echo "<select  name='logingpower_settings[logingpower_languageswitcher_background_imgsize]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_languageswitcher_background_imgsize']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo '</select>';
	   	echo "<p class='description'> ". esc_html( 'Select language switcher image size', 'logingpower' )."</p>
				</label></td>
				";
			$this->options['logingpower_languageswitcher_opacity']=sanitize_text_field($this->options['logingpower_languageswitcher_opacity']??'1.0');
			echo"	<td><label for='logingpower_languageswitcher_opacity'>
					<input id='logingpower_languageswitcher_opacity' name='logingpower_settings[logingpower_languageswitcher_opacity]'  type='range' min='0.0' max='1.0' step='0.1'
					value=". esc_attr("{$this->options['logingpower_languageswitcher_opacity']}" )." oninput='this.form.langaugeswitcherImageOpacity.value=this.value'  />
					<input type='number'   name='langaugeswitcherImageOpacity' min='0.0' max='1.0' value=". esc_attr("{$this->options['logingpower_languageswitcher_opacity']}" )." step='0.1'  size='3'  oninput='this.form.logingpower_languageswitcher_opacity.value=this.value' placeholder='0.6' /><span>px</span>
					<p class='description'> ". esc_html( 'Customize language switcher opacity:0 to 1 default:1, ', 'logingpower' )."</p>
					</label></td>";
			echo "</tr>";
			echo "<tr valign='top'><th scope='row'>".esc_html( 'Change Button Size', 'logingpower' )."</th>";
			$this->options['logingpower_languageswitcher_change_height']=absint($this->options['logingpower_languageswitcher_change_height']??30);
			echo"	<td><label for='logingpower_languageswitcher_change_height'>
				<input id='logingpower_languageswitcher_change_height' name='logingpower_settings[logingpower_languageswitcher_change_height]'  type='range' min='30' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_change_height']}" )." oninput='this.form.angaugeswitcherChangeHeight.value=this.value' placeholder='30' />
				<input type='number'   name='angaugeswitcherChangeHeight' min='30' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_height']}" )."   size='3'  oninput='this.form.logingpower_languageswitcher_change_height.value=this.value' placeholder='14' /><span>px</span>
					<p class='description'> ". esc_html( 'Customize change button height:20px to 100px default:30px, ', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_change_width']=absint($this->options['logingpower_languageswitcher_change_width']??65);
			echo"	<td><label for='logingpower_languageswitcher_change_width'>
				<input id='logingpower_languageswitcher_change_width' name='logingpower_settings[logingpower_languageswitcher_change_width]'  type='range' min='65' max='500' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_change_width']}" )." oninput='this.form.langaugeswitcherChangeWidth.value=this.value' placeholder='65' />
				<input type='number'   name='langaugeswitcherChangeWidth' min='65' max='500' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_width']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_change_width.value=this.value' placeholder='65' /><span>px</span>
					<p class='description'> ". esc_html( 'Customize change button width:65px to 200px default:30px, ', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_change_fontsize']=absint($this->options['logingpower_languageswitcher_change_fontsize']??13);
			echo"	<td><label for='logingpower_languageswitcher_change_fontsize'>
				<input id='logingpower_languageswitcher_change_fontsize' name='logingpower_settings[logingpower_languageswitcher_change_fontsize]'  type='range' min='13' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_change_fontsize']}" )." oninput='this.form.langaugeswitcherChangeFontSize.value=this.value' placeholder='13' />
				<input type='number'   name='langaugeswitcherChangeFontSize' min='13' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_fontsize']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_change_fontsize.value=this.value' placeholder='13' /><span>px</span>
					<p class='description'> ". esc_html( 'Customize change button font size:13px to 100px default:13px, ', 'logingpower' )."</p>
				</label></td>";
			echo "	</tr> ";
			echo "<tr valign='top'><th scope='row'>". esc_html( 'Change Button Color, Label, Cursor', 'logingpower' )."</th>";
			$this->options['logingpower_languageswitcher_change_background_color']=sanitize_hex_color($this->options['logingpower_languageswitcher_change_background_color']??'#f6f7f7');
			echo "<td><label for='logingpower_languageswitcher_change_background_color'>
					<input id='logingpower_languageswitcher_change_background_color' name='logingpower_settings[logingpower_languageswitcher_change_background_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_background_color']}" )." oninput='this.form.langaugeswitcherChangebgcolor.value=this.value' placeholder='#ddd5d5' />
				<input type='text' style='height:12px;padding:0'  name='langaugeswitcherChangebgcolor'  value=". esc_attr("{$this->options['logingpower_languageswitcher_change_background_color']}" )."   size='7'  oninput='this.form.logingpower_languageswitcher_change_background_color.value=this.value' placeholder='#ddd5d5' />
				<p class='description'> ". esc_html( 'Customize change button background color', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_change_hover_color']=sanitize_hex_color($this->options['logingpower_languageswitcher_change_hover_color']??'#f6f7f7');
			echo "<td><label for='logingpower_languageswitcher_change_hover_color'>
				<input id='logingpower_languageswitcher_change_hover_color' name='logingpower_settings[logingpower_languageswitcher_change_hover_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_hover_color']}" )." oninput='this.form.langaugeswitcherChangeHovercolor.value=this.value' placeholder='#ddd5d5'  />
				<input type='text' style='height:12px;padding:0'  name='langaugeswitcherChangeHovercolor'  value=". esc_attr("{$this->options['logingpower_languageswitcher_change_hover_color']}" )."   size='7'  oninput='this.form.logingpower_languageswitcher_change_hover_color.value=this.value' placeholder='#ddd5d5' />
				<p class='description'> ". esc_html( 'Customize change button hover color', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_change_label']=sanitize_text_field($this->options['logingpower_languageswitcher_change_label']??'Change');
			echo"	<td ><label for='logingpower_languageswitcher_change_label' >";
			echo "<input name='logingpower_settings[logingpower_languageswitcher_change_label]' placeholder='Powered by WordPress' style='padding: 4px;Width:90%;' type='text' value='". esc_attr("{$this->options['logingpower_languageswitcher_change_label']}" )."'/>";
			echo "<p class='description'> ". esc_html( 'Customize change button label:default Change ', 'logingpower' )."</p>
				</label></td>";
			echo "<tr valign='top'><th scope='row'></th>";
			$this->options['logingpower_languageswitcher_change_label_color']=$this->options['logingpower_languageswitcher_change_label_color']??'#2271b1';
			echo "<td><label for='logingpower_languageswitcher_change_label_color'>
				<input id='logingpower_languageswitcher_change_label_color' name='logingpower_settings[logingpower_languageswitcher_change_label_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_label_color']}" )." oninput='this.form.langaugeswitcherChangeBordercolor.value=this.value' placeholder='#2271b1'  />
				<input type='text' style='height:12px;padding:0'  name='langaugeswitcherChangeBordercolor'  value=". esc_attr("{$this->options['logingpower_languageswitcher_change_label_color']}" )."   size='7'  oninput='this.form.logingpower_languageswitcher_change_label_color.value=this.value' placeholder='#2271b1' />
				<p class='description'> ". esc_html( 'Customize change button label color', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_change_cursor']=sanitize_text_field($this->options['logingpower_languageswitcher_change_cursor']??'pointer');
			echo"<td><label for='logingpower_languageswitcher_change_cursor'>";
				$items=array('auto','default','none ','context-menu ','help ','pointer ','progress ','wait ','cell ','crosshair ','text ','vertical-text ','alias','copy','move','no-drop','not-allowed','grab','grabbing','e-resize','n-resize','ne-resize','nw-resize','s-resize','se-resize','sw-resize','w-resize','ew-resize','ns-resize','nesw-resize','nwse-resize','col-resize','row-resize','all-scroll','zoom-in','zoom-out');
	    echo "<select  name='logingpower_settings[logingpower_languageswitcher_change_cursor]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_languageswitcher_change_cursor']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
	    echo "<p class='description'> ". esc_html( 'Select change button cursor:default pointer', 'logingpower' )."</p>
				</label></td>";
			echo "</tr> ";
			$this->options['logingpower_languageswitcher_change_border_style']=sanitize_text_field($this->options['logingpower_languageswitcher_change_border_style']??'solid');
			echo"<tr valign='top'><th scope='row'>". esc_html( 'Change Button Border ', 'logingpower' )."</th> ";
			echo"<td><label for='logingpower_languageswitcher_change_border_style'>";
			$items=array('dotted','dashed','solid','double','groove','ridge','inset','outset','none','hidden');
	    echo "<select  name='logingpower_settings[logingpower_languageswitcher_change_border_style]'> ";
	    	foreach ($items as $item) {
	      	$selected= ( $this->options['logingpower_languageswitcher_change_border_style']===$item )?sanitize_text_field('selected="selected"'):'';
	        	echo "<option value='". esc_attr($item)."'".esc_html( sanitize_text_field( $selected )) ."  > ".esc_html( $item). "</option>";
	      }
	    echo "</select>";
	    echo "<p class='description'> ". esc_html( 'Select change button border style:default solid', 'logingpower' )."</p>
			</label></td>";
				$this->options['logingpower_languageswitcher_change_border_width']=absint($this->options['logingpower_languageswitcher_change_border_width']??1);
			echo"<td><label for='logingpower_languageswitcher_change_border_width'>
				<input id='logingpower_languageswitcher_change_border_width' name='logingpower_settings[logingpower_languageswitcher_change_border_width]'  type='range' min='1' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_width']}" )." oninput='this.form.changeBorderWidth.value=this.value' placeholder='1'/>
				<input type='number'   name='changeBorderWidth' min='1' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_width']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_change_border_width.value=this.value' placeholder='1' />px
					<p class='description'> ". esc_html( 'Change button border width', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_change_border_color']=sanitize_hex_color($this->options['logingpower_languageswitcher_change_border_color']??'#2271b1');
			echo "<td><label for='logingpower_languageswitcher_change_border_color'>
				<input id='logingpower_languageswitcher_change_border_color' name='logingpower_settings[logingpower_languageswitcher_change_border_color]'  class='mycolor-field' type='color' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_color']}" )." oninput='this.form.langaugeswitcherChangeBordercolor.value=this.value' placeholder='#2271b1'  />
				<input type='text' style='height:12px;padding:0'  name='langaugeswitcherChangeBordercolor'  value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_color']}" )."   size='7'  oninput='this.form.logingpower_languageswitcher_change_border_color.value=this.value' placeholder='#2271b1' />
				<p class='description'> ". esc_html( 'Customize change button border color', 'logingpower' )."</p>
					</label></td>";
			echo"</tr>";
			echo"<tr valign='top'><th scope='row'>". esc_html( 'Change Button Border Radius', 'logingpower' )."</th> ";
			$this->options['logingpower_languageswitcher_change_border_radius_topleft']=absint($this->options['logingpower_languageswitcher_change_border_radius_topleft']??3);
			echo"<td><label for='logingpower_languageswitcher_change_border_radius_topleft'>
				<input id='logingpower_languageswitcher_change_border_radius_topleft' name='logingpower_settings[logingpower_languageswitcher_change_border_radius_topleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_radius_topleft']}" )." oninput='this.form.changeBorderTopLeft.value=this.value' />
				<input type='number'   name='changeBorderTopLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_radius_topleft']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_change_border_radius_topleft.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Change button border-radius:top-left ', 'logingpower' )."</p>
				</label></td>";
			$this->options['logingpower_languageswitcher_change_border_radius_topright']=absint($this->options['logingpower_languageswitcher_change_border_radius_topright']??3);
			echo"<td><label for='logingpower_languageswitcher_change_border_radius_topright'>
				<input id='logingpower_languageswitcher_change_border_radius_topright' name='logingpower_settings[logingpower_languageswitcher_change_border_radius_topright]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_radius_topright']}" )." oninput='this.form.changeBorderTopRight.value=this.value' />
				<input type='number'   name='changeBorderTopRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_radius_topright']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_change_border_radius_topright.value=this.value' placeholder='1' />px
				<p class='description'> ". esc_html( 'Change button top right border radius', 'logingpower' )."</p>
					</label></td>";
			$this->options['logingpower_languageswitcher_change_border_radius_bottomright']=absint($this->options['logingpower_languageswitcher_change_border_radius_bottomright']??3);
			echo"<td><label for='logingpower_languageswitcher_change_border_radius_bottomright'>
				<input id='logingpower_languageswitcher_change_border_radius_bottomright' name='logingpower_settings[logingpower_languageswitcher_change_border_radius_bottomright]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_radius_bottomright']}" )." oninput='this.form.changeBorderBottomRight.value=this.value' />
				<input type='number'   name='changeBorderBottomRight' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_radius_bottomright']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_change_border_radius_bottomright.value=this.value' placeholder='1' />px
					<p class='description'> ". esc_html( 'Change button bottom-right border radius', 'logingpower' )."</p>
				</label></td>";
			echo "</tr> ";	
			echo"<tr valign='top'><th scope='row'></th> ";
			$this->options['logingpower_languageswitcher_change_border_radius_bottomleft']=absint($this->options['logingpower_languageswitcher_change_border_radius_bottomleft']??3);
			echo"<td><label for='logingpower_languageswitcher_change_border_radius_bottomleft'>
				<input id='logingpower_languageswitcher_change_border_radius_bottomleft' name='logingpower_settings[logingpower_languageswitcher_change_border_radius_bottomleft]'  type='range' min='0' max='100' 
					value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_radius_bottomleft']}" )." oninput='this.form.changeBorderBottomLeft.value=this.value' />
				<input type='number'   name='changeBorderBottomLeft' min='0' max='100' value=". esc_attr("{$this->options['logingpower_languageswitcher_change_border_radius_bottomleft']}" )."   size='2'  oninput='this.form.logingpower_languageswitcher_change_border_radius_bottomleft.value=this.value' placeholder='1' />px
					<p class='description'> ". esc_html( 'Change button bottom-left border radius', 'logingpower' )."</p>
				</label></td>";
			echo"</tr>";
		}
	    
	}
	endif;
	
if(isset(get_option('logingpower_settings')['logingpower_template']) && get_option('logingpower_settings')['logingpower_template']==='leaf'){
	function logingpower_template_leaf(){
		wp_register_style('logingpower_template_leaf', plugins_url( 'templates/template_leaf.css', __FILE__ ),array(),LOGINGPOWER_VERSION);
		wp_enqueue_style( 'logingpower_template_leaf' );
	}add_action( 'login_enqueue_scripts', 'logingpower_template_leaf' );

}elseif (isset(get_option('logingpower_settings')['logingpower_template']) && get_option('logingpower_settings')['logingpower_template']==='logo') {
	function logingpower_template_logo(){
		wp_register_style('logingpower_template_logo', plugins_url( 'templates/template_logo.css', __FILE__ ),array(),LOGINGPOWER_VERSION);
		wp_enqueue_style( 'logingpower_template_logo' );
	}add_action( 'login_enqueue_scripts', 'logingpower_template_logo' );
}elseif (isset(get_option('logingpower_settings')['logingpower_template']) && get_option('logingpower_settings')['logingpower_template']==='none'){

	// loginpage customization
	function logingpower_loginpage_style() {
		if ( !empty(get_option('logingpower_settings')['logingpower_loginpage_bgcolor'] )):
			$logingpower_style ="body {  background-color:". esc_attr( get_option('logingpower_settings')['logingpower_loginpage_bgcolor'])."!important; }";
			wp_add_inline_style('login',$logingpower_style);
		endif;
		if ( !empty(get_option('logingpower_settings')['logingpower_loginpage_bgimg_show']) ) :	
		 $logingpower_style="body{ background-image:url(". esc_url( get_option('logingpower_settings')['logingpower_loginpage_bgimg'] ) ." )!important;}";
		wp_add_inline_style('login',$logingpower_style);
		endif; 
		
		// Background image
		$loginpage_bgimg_style='auto';
		if (!empty(get_option('logingpower_settings')['logingpower_loginpage_bgimg_size'])) 
			$loginpage_bgimg_size=sanitize_text_field( get_option('logingpower_settings')['logingpower_loginpage_bgimg_size']);
			
			switch ($loginpage_bgimg_size) {
				case 'auto':
				 	$loginpage_bgimg_style='auto';
					break;
				case 'width':
				 $loginpage_bgimg_style='100%  auto';
					break;
				case 'height':
					$loginpage_bgimg_style='auto 100%';
					break;
				case 'both':
				 $loginpage_bgimg_style='100%  100%';
					break;
				default:
					$loginpage_bgimg_style='auto';
					break;
			}
		
		$logingpower_loginpage_bgimg_repeat='no-repeat';
		if(!empty(get_option('logingpower_settings')[ 'logingpower_loginpage_bgimg_repeat' ]))
		$logingpower_loginpage_bgimg_repeat=get_option('logingpower_settings')[ 'logingpower_loginpage_bgimg_repeat' ];
		$logingpower_style="body{ background-position: center top !important;
				background-repeat: ".esc_attr($logingpower_loginpage_bgimg_repeat)."!important;
		  	display:block;   
		  	background-attachment: fixed !important; 
		  	background-size:". esc_attr($loginpage_bgimg_style)." !important; }";
		wp_add_inline_style('login',$logingpower_style);
	}add_action( 'login_enqueue_scripts', 'logingpower_loginpage_style' );
	//add_action( 'login_head', 'logingpower_loginpage_style') ;	
	
	// login section
	function logingpower_loginsec_styles() {
		if ( !empty(get_option('logingpower_settings')['logingpower_loginsec_bgcolor'] )){
	 	$logingpower_style =' body.login div#login {  background-color:'.  esc_attr( get_option('logingpower_settings')['logingpower_loginsec_bgcolor'] ).'!important; }';
	 	wp_add_inline_style('login',$logingpower_style);
		}
		// section position
		if ( !empty(get_option('logingpower_settings')['logingpower_loginsec_position'] )){

			$position=sanitize_text_field( get_option('logingpower_settings')['logingpower_loginsec_position']);
			$loginsec_style='';
			$sec_width=  absint(get_option('logingpower_settings')['logingpower_loginsec_width'] ??320);
			switch ($position) {
				case 'None':
				 	$loginsec_style=' auto ';
					break;
				case 'Top-Left':
				 	$loginsec_style='0 100% 0 0  ';
					break;
				case 'Top-Center':
					$loginsec_style=' 0 auto 0 auto ';
					break;
				case 'Top-Right':
				 	$loginsec_style=' 0 0 0 auto ';
					break;
				case 'Left-Center':
				 	$loginsec_style=' 5% auto 5% 0 ';
					break;
				case 'Center-Center':
					$loginsec_style=' 5%  auto ';
					break;
				case 'Right-Center':
				 	$loginsec_style=' 5% 0 5% auto ';
					break;
				case 'Bottom-Left':
					$loginsec_style=' 5% auto 0 0 ';
					break;
				case 'Bottom-Center':
				 	$loginsec_style=' 5% auto 0 ';
					break;
				case 'Bottom-Right':
				 	$loginsec_style='5% 0 0 auto ';
					break;
				default:
					$loginsec_style='auto ';
					break;
			}	
			$logingpower_style = ' body.login div#login { 
				width:'.esc_attr($sec_width).'px;
				padding: 5% 0 0;
				margin: '.esc_attr($loginsec_style).'!important ;
				}';
			wp_add_inline_style('login',$logingpower_style);
		}

		//Section image 
		if ( !empty(get_option('logingpower_settings')['logingpower_loginsec_bgimg_show']) ) :	
			 $logingpower_style="body.login div#login{ background-image:url(". esc_url( get_option('logingpower_settings')['logingpower_loginsec_bgimg'] ) ." )!important;}";
			wp_add_inline_style('login',$logingpower_style);
		endif;
		$loginsec_bgimg_style='auto';

		if (!empty(get_option('logingpower_settings')['logingpower_loginsec_bgimg_size'])) 
			$loginsec_bgimg_size=  sanitize_text_field(get_option('logingpower_settings')['logingpower_loginsec_bgimg_size']);
			
			switch ($loginsec_bgimg_size) {
				case 'auto':
				 	$loginsec_bgimg_style='auto';
					break;
				case 'width':
				 $loginsec_bgimg_style='100%  auto';
					break;
				case 'height':
					$loginsec_bgimg_style='auto 100%';
					break;
				case 'both':
				 $loginsec_bgimg_style='100%  100%';
					break;
				default:
					$loginsec_bgimg_style='auto';
					break;
			}
		
			
			$logingpower_loginsec_bgimg_repeat='no-repeat';
			if(!empty(get_option('logingpower_settings')[ 'logingpower_loginsec_bgimg_repeat' ])) 
			$logingpower_loginsec_bgimg_repeat=get_option('logingpower_settings')[ 'logingpower_loginsec_bgimg_repeat' ];
			$logingpower_style= ' body.login div#login { 
			
			background-position: center top !important;
			background-repeat: ' . esc_attr( $logingpower_loginsec_bgimg_repeat) . '!important;
		  	display:block;   
		  	background-attachment: fixed !important;

		  	 background-size:'.esc_attr($loginsec_bgimg_style).'!important; 
		  	 }';
		  	 wp_add_inline_style('login',$logingpower_style);
		
		$sec_border_radius_topleft=absint( get_option('logingpower_settings')[ 'logingpower_loginsec_border_radius_topleft' ]?? 0) ;
		$sec_border_radius_topright=absint(get_option('logingpower_settings')[ 'logingpower_loginsec_border_radius_topright' ]?? 0) ;
		$sec_border_radius_bottomright= absint(get_option('logingpower_settings')[ 'logingpower_loginsec_border_radius_bottomright' ]?? 0 );
		$sec_border_radius_bottomleft=absint(get_option('logingpower_settings')[ 'logingpower_loginsec_border_radius_bottomleft' ]?? 0 );
		$logingpower_style= ' body.login div#login { 
				border-radius:' . esc_attr( $sec_border_radius_topleft ) .'px '. esc_attr( $sec_border_radius_topright ) .'px '. esc_attr(  $sec_border_radius_bottomright) .'px '. esc_attr($sec_border_radius_bottomleft  ) .'px !important;
				} 	';
		wp_add_inline_style('login',$logingpower_style);
	}add_action( 'login_enqueue_scripts', 'logingpower_loginsec_styles') ;
	// add_action( 'login_head', 'logingpower_loginsec_styles') ;
	
	// login log
	function logingpower_loginlogo_hide() {
		if ( !empty(get_option('logingpower_settings')['logingpower_loginlogo_hide'] ) ){
			$logingpower_style= "body.login div#login h1 a {
				background-image: none;
				color: #999;
				height: 80px;
				font-size: 20px;
				font-weight: normal;
				line-height: 1.3em;
				margin: 0 auto 25px;
				padding: 0;
				text-decoration: none;
				width: 80px;
				text-indent: 0px;
				outline: none;
				overflow: hidden;
				display: block;
						}";
			wp_add_inline_style('login',$logingpower_style);
		}else{
			if ( !empty(get_option('logingpower_settings')['logingpower_customlogo_show'] ) ){
				$logingpower_style='body.login div#login h1 a {
					background-image: url(' . esc_url( get_option('logingpower_settings')['logingpower_loginlogo_img'] ) . ')!important;
				}';
			wp_add_inline_style('login',$logingpower_style);	
			}
		}

	}add_action( 'login_enqueue_scripts', 'logingpower_loginlogo_hide') ;
	// add_action( 'login_head', 'logingpower_loginlogo_hide') ;
	
	function logingpower_loginlogo_text() {
		if ( !empty(get_option('logingpower_settings')['logingpower_loginlogo_text'] ) ){
			return sanitize_text_field(get_option('logingpower_settings')['logingpower_loginlogo_text']) ;
		}else{
			return sanitize_text_field('Powered by WordPress');
		}
	}add_filter( 'login_headertext', 'logingpower_loginlogo_text' );

	function logingpower_loginlogo_url(){
		if ( !empty(get_option('logingpower_settings')['logingpower_loginlogo_url']) ) {
			return  sanitize_url(get_option('logingpower_settings')['logingpower_loginlogo_url']) ;
		}else{
			return sanitize_url('https://wordpress.org/');
		}
	 }add_filter( 'login_headerurl', 'logingpower_loginlogo_url' );
	 // login message
	function logingpower_loginmessage() {
	
		$msg_bgcolor=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginmessage_bgcolor'] ??'#ffffff');
		$msg_padding=absint(get_option('logingpower_settings')['logingpower_loginmessage_paddding'] ??12);
		$msg_color= sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginmessage_color'] ??'#000000');
		$msg_fontsize=(get_option('logingpower_settings')['logingpower_loginmessage_fontsize'] )??'12';
		$msg_borderleft_width=absint(get_option('logingpower_settings')['logingpower_loginmessage_borderleft_width'] ??4);
		$msg_borderleft_style=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginmessage_borderleft_style'] ??'solid');
		$msg_borderleft_color=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginmessage_borderleft_color'] ??'#72aee6');
		$logingpower_style="
			body.login div#login .message,
			body.login div#login .notice,
			body.login div#login .success,
			body.login div#login .notice-error {
				border-left:".esc_attr($msg_borderleft_width).'px '. esc_attr($msg_borderleft_style). esc_attr($msg_borderleft_color)." !important ;
				padding: ". esc_attr($msg_padding)."px !important;
				margin-left: 0;
				margin-bottom: 20px;
				background-color:". esc_attr($msg_bgcolor)."!important ;
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
				word-wrap: break-word;
				color:". esc_attr($msg_color)."!important;
				font-size:". esc_attr($msg_fontsize)."px !important;
				
			}";

		wp_add_inline_style('login',$logingpower_style);
	}add_action( 'login_enqueue_scripts', 'logingpower_loginmessage') ;
	// add_action( 'login_head', 'logingpower_loginmessage') ;

	// login form
	function logingpower_loginform() {
	$form_bgcolor=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginform_background_color'] ??'#ffffff');
	$form_fontweight=absint(get_option('logingpower_settings')['logingpower_loginform_fontweight'] ??400);
	$form_borderwidth=absint(get_option('logingpower_settings')['logingpower_loginform_border_width'] ??1);
	$form_borderstyle=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_border_style'] ??'solid');
	$form_bordercolor=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginform_border_color'] ??'#c3c4c7');
	$form_border_radius_topleft=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_border_radius_topleft'] ??'none');
	$form_border_radius_topright=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_border_radius_topright'] ??'none');
	$form_border_radis_bottomright=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_border_radius_bottomright'] ??'none');
	$form_border_radis_bottomleft=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_border_radius_bottomleft'] ??'none');
	// form input 

	// form label
	$label_fontsize=absint(get_option('logingpower_settings')['logingpower_loginform_label_fontsize'] ??14);
	$label_cursor=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_label_cursor'] ??'pointer');
	$label_color=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginform_label_color'] ??'#3c434a');

	$form_background_img='none';
	$form_background_repeat='no-repeat';
	$form_background_imgsize_style='auto';

	if ( !empty(get_option('logingpower_settings')['logingpowerloginform_background_show'] ) )
	$form_background_img=sanitize_url(get_option('logingpower_settings')['logingpower_loginform_background_img'] ??plugins_url( 'imgs/loginform_bglaptop.jpg', __FILE__ ));
	$form_background_repeat=sanitize_text_field(get_option('logingpower_settings')[ 'logingpower_loginform_background_repeat' ]??'no-repeat');
	
	$form_background_imgsize=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_background_imgsize']??'auto');
	switch ($form_background_imgsize) {
			case 'auto':
			 	$form_background_imgsize_style='auto';
				break;
			case 'width':
			 $form_background_imgsize_style='100%  auto';
				break;
			case 'height':
				$form_background_imgsize_style='auto 100%';
				break;
			case 'both':
			 $form_background_imgsize_style='100%  100%';
				break;
			default:
				$form_background_imgsize_style='auto';
				break;
		}
		
	// form input 
	$form_input_border_width=absint(get_option('logingpower_settings')['logingpower_loginform_input_border_width'] ??1);
	$form_input_border_style=sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_input_style'] ??'solid');
	$form_input_border_color=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginform_input_border_color'] ??'#c3c4c7');
	$form_input_radius_topleft=absint(get_option('logingpower_settings')['logingpower_loginform_input_radius_topleft'] ??0);
	$form_input_border_radius_topright=absint(get_option('logingpower_settings')['logingpower_loginform_input_radius_topright'] ??0);
	$form_input_border_radis_bottomright=absint(get_option('logingpower_settings')['logingpower_loginform_input_radius_bottomright'] ??0);
	$form_input_border_radis_bottomleft=absint(get_option('logingpower_settings')['logingpower_loginform_input_radius_bottomleft'] ??0);
	$form_input_height=absint(get_option('logingpower_settings')['logingpower_loginform_input_height'] ??50);
	$form_input_color=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginform_input_color'] ??'#ffffff');
	// submit button 
	
	$form_submit_width=absint(get_option('logingpower_settings')['logingpower_loginform_submit_width']??25);
	$form_submit_height=absint(get_option('logingpower_settings')['logingpower_loginform_submit_height']??32);
	$form_submit_bgcolor=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginform_submit_bgcolor'] ??'#2271b1');
	$form_submit_lbcolor=sanitize_hex_color(get_option('logingpower_settings')['logingpower_loginform_submit_lbcolor'] ??'#ffffff');
	$form_submit_fontsize=absint(get_option('logingpower_settings')['logingpower_loginform_submit_fontsize'] ??13);
	// submit button radius 
	$form_submit_radius_topleft=absint(get_option('logingpower_settings')['logingpower_loginform_submit_radius_topleft'] ??0);
	$form_submit_radius_topright=absint(get_option('logingpower_settings')['logingpower_loginform_submit_radius_topright'] ??0);
	$form_submit_radius_bottomright=absint(get_option('logingpower_settings')['logingpower_loginform_submit_radius_bottomright'] ??0);
	$form_submit_radius_bottomleft=absint(get_option('logingpower_settings')['logingpower_loginform_submit_radius_bottomleft'] ??0);
		
	$logingpower_style="body.login div#login form#loginform {
		margin-top: 20px;
		margin-left: 0;
		padding: 26px 24px 34px;
		font-weight: ". esc_attr($form_fontweight)."!important;
		overflow: hidden;
		background: ". esc_attr($form_bgcolor).";
		border: ". esc_attr($form_borderwidth)."px ". esc_attr($form_borderstyle ). esc_attr($form_bordercolor) ." ;
		border-radius:". esc_attr($form_border_radius_topleft)."px ". esc_attr($form_border_radius_topright )."px ".  esc_attr($form_border_radis_bottomright )."px ". esc_attr($form_border_radis_bottomleft)."px ;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
		background-image:url(". esc_url($form_background_img).");
		background-size:". esc_attr( $form_background_imgsize_style)."!important;
		background-repeat: " .esc_attr($form_background_repeat)."!important;
	}";
	wp_add_inline_style('login',stripslashes($logingpower_style)); 	
	$logingpower_style="body.login div#login form#loginform p {
		font-weight: ". esc_attr($form_fontweight)."!important;}";
	wp_add_inline_style('login',stripslashes($logingpower_style));
	$logingpower_style="body.login div#login form#loginform  label {
		color:". esc_attr($label_color)."!important;
		font-size: ". esc_attr($label_fontsize)."px !important;
		cursor: ". esc_attr($label_cursor)."!important;}";
	wp_add_inline_style('login',stripslashes($logingpower_style));			
	$logingpower_style="body.login div#login form#loginform input#user_login,
					body.login div#login form#loginform input#user_pass{
			border: ". esc_attr($form_input_border_width)."px ". esc_attr($form_input_border_style) .esc_attr( $form_input_border_color) ." ;
			border-radius:". esc_attr($form_input_radius_topleft)."px ". esc_attr($form_input_border_radius_topright)."px ".  esc_attr($form_input_border_radis_bottomright)."px ". esc_attr($form_input_border_radis_bottomleft)."px !important ;
			background-color:". esc_attr($form_input_color)." !important;
			height:". esc_attr($form_input_height)."px !important;}";
	wp_add_inline_style('login',stripslashes($logingpower_style));
	$logingpower_style="body.login div#login form#loginform p.submit input#wp-submit {
			width:". esc_attr($form_submit_width)."% !important;
			height:". esc_attr($form_submit_height)."px !important;
			background:". esc_attr($form_submit_bgcolor)." !important;
			color:". esc_attr($form_submit_lbcolor)." !important;
			font-size:". esc_attr($form_submit_fontsize)."px !important;
			border-radius:". esc_attr($form_submit_radius_topleft)."px ". esc_attr($form_submit_radius_topright) ."px ".  esc_attr($form_submit_radius_bottomright )."px ". esc_attr($form_submit_radius_bottomleft)."px ;}";
			 
	wp_add_inline_style('login',stripslashes($logingpower_style));	   
			
	  add_filter( 'gettext', 'logingpower_form_labels_change', 20, 3 );
    function logingpower_form_labels_change( $translated_text, $text, $domain ) {
         if ($text === 'Username or Email Address') {
    	$translated_text= sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_username'] ??'Username or Email Address');
         }elseif($text === 'Password'){
         	$translated_text= sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_password'] ??'Password');
         }elseif($text === 'Remember Me'){
         	$translated_text= sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_rememberme'] ??'Remember Me');
         }elseif($text === 'Lost your password?'){
         	$translated_text= sanitize_text_field('Lost your password?');
         }elseif($text === 'Log In'){
         	$translated_text= sanitize_text_field(get_option('logingpower_settings')['logingpower_loginform_submit_label'] ??'Log In');
         }
        return $translated_text;
    }

	}add_action( 'login_enqueue_scripts', 'logingpower_loginform') ;
	//add_action( 'login_head', 'logingpower_loginform') ;
	
	// lost password
	function logingpower_lostpassword() {
		$logingpower_style="body.login div#login p#nav a {
			color:". esc_attr(( get_option('logingpower_settings')['logingpower_lostpassword_label_color'] )??'#50575e' )."!important;
			font-size:". esc_attr(( get_option('logingpower_settings')['logingpower_lostpassword_label_fontsize'] )??'13' )."px !important;}";
		wp_add_inline_style('login',$logingpower_style);
		$logingpower_style="body.login div#login p#nav a:hover {
			color:". esc_attr(( get_option('logingpower_settings')['logingpower_lostpassword_label_hover_color'] )??'#135e96' )."!important;}";
		wp_add_inline_style('login',$logingpower_style);
		$logingpower_style="body.login div#login p#backtoblog a {
			color:". esc_attr(( get_option('logingpower_settings')['logingpower_backtoblog_label_color'] )??'#50575e' )."!important;
			font-size:". esc_attr(( get_option('logingpower_settings')['logingpower_backtoblog_label_fontsize'] )??'13' )."px !important;}";
		wp_add_inline_style('login',$logingpower_style);
		$logingpower_style="body.login div#login p#backtoblog a:hover {
			color:". esc_attr(( get_option('logingpower_settings')['logingpower_backtoblog_label_hover_color'] )??'#135e96' )."!important;}";
		wp_add_inline_style('login',$logingpower_style);
		
		add_filter( 'gettext', 'logingpower_lostpassword_label', 20, 3 );
		    function logingpower_lostpassword_label( $translated_text, $text, $domain ) {
		         if ($text === 'Lost your password?') {
		    	$translated_text= sanitize_text_field(get_option('logingpower_settings')['logingpower_lostpassword_text'] ??'Lost your password?');
		         }
		        return $translated_text;
		    }

	}add_action( 'login_enqueue_scripts', 'logingpower_lostpassword') ;
	// add_action( 'login_head', 'logingpower_lostpassword') ;
	

	// Language Switcher 
	function logingpower_languageswitcher(){

		// language switcher background color
		if ( !empty(get_option('logingpower_settings')['logingpower_languageswitcher_background_color_show'] ) ){
			$logingpower_style= 'body.login div.language-switcher  {
				background-color:'.esc_attr( (get_option('logingpower_settings')['logingpower_languageswitcher_background_color'] )??'#c7ccd1' ).'!important;	 
			}';
		wp_add_inline_style('login',$logingpower_style);
		}
		// language switcher border width , border radius ,  padding, 
		$logingpower_style= 'body.login div.language-switcher  {
			width:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_width'])??'100').'%!important;
			border:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_border_style'])??'none').' '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_border_width'])??'0').'px'.' '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_border_color'])??'#2271b1').'!important;
			border-radius:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_border_radius_topleft'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_border_radius_topright'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_border_radius_bottomright'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_border_radius_bottomleft'])??'0').'px !important;
			padding:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_padding_top'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_padding_right'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_padding_bottom'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_padding_left'])??'0').'px !important;
			opacity:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_opacity'])??'1').' !important;
		}';
		wp_add_inline_style('login',$logingpower_style);

		//language switcher backgrund image 
		$languageswitcher_background_img='none';
		$languageswitcher_background_repeat='no-repeat';
		$languageswitcher_background_imgsize_style='auto';
		if ( !empty(get_option('logingpower_settings')['logingpower_languageswitcher_background_show'] ) )
		$languageswitcher_background_img=sanitize_text_field (get_option('logingpower_settings')['logingpower_languageswitcher_background_img'] ??plugins_url( 'imgs/laptop.JPG', __FILE__ ));
		$languageswitcher_background_repeat=sanitize_text_field(  get_option('logingpower_settings')[ 'logingpower_languageswitcher_background_repeat' ]??'no-repeat');
		$languageswitcher_background_imgsize=sanitize_text_field( get_option('logingpower_settings')['logingpower_languageswitcher_background_imgsize']??'auto');
			$languageswitcher_background_imgsize_style='auto';
		switch ($languageswitcher_background_imgsize) {
			case 'auto':
			 	$languageswitcher_background_imgsize_style='auto';
				break;
			case 'width':
			 $languageswitcher_background_imgsize_style='100%  auto';
				break;
			case 'height':
				$languageswitcher_background_imgsize_style='auto 100%';
				break;
			case 'both':
			 $languageswitcher_background_imgsize_style='100%  100%';
				break;
			default:
				$languageswitcher_background_imgsize_style='auto';
				break;
		}
		
		$logingpower_style= 'body.login div.language-switcher  {
			background-image:url('.esc_attr($languageswitcher_background_img ).');
				background-size:'. esc_attr( $languageswitcher_background_imgsize_style).'!important;
				background-repeat: ' .esc_attr($languageswitcher_background_repeat). '!important;
		}';
		wp_add_inline_style('login',$logingpower_style);

		$logingpower_style= 'body.login div.language-switcher form input {
			width:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_width'])??'65').'px !important;
			height:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_height'])??'30').'px !important;
			font-size:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_fontsize'])??'13').'px !important;
			background-color:'.esc_attr( (get_option('logingpower_settings')['logingpower_languageswitcher_change_background_color'] )??'#f6f7f7' ).'!important;	
			border:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_border_style'])??'solid').' '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_border_width'])??'1').'px '.' '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_border_color'])??'#2271b1').'!important;
			border-radius:'.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_border_radius_topleft'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_border_radius_topright'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_border_radius_bottomright'])??'0').'px'.' 
			   '.esc_attr((get_option('logingpower_settings')['logingpower_languageswitcher_change_border_radius_bottomleft'])??'0').'px !important;
			color:'.esc_attr( (get_option('logingpower_settings')['logingpower_languageswitcher_change_label_color'] )??'#2271b1' ).'!important;
			cursor:'.esc_attr( (get_option('logingpower_settings')['logingpower_languageswitcher_change_cursor'] )??'pointer' ).'!important;}';
		wp_add_inline_style('login',$logingpower_style);
		$logingpower_style= 'body.login div.language-switcher form input:hover{
			background-color:'.esc_attr( (get_option('logingpower_settings')['logingpower_languageswitcher_change_hover_color'] )??'#f6f7f7' ).'!important;}';
		wp_add_inline_style('login',$logingpower_style);
		     function logingpower_languageswitcher_label( $translated_text, $text, $domain ) {
		         if ($text === 'Change') {
		    	$translated_text=  sanitize_text_field(get_option('logingpower_settings')['logingpower_languageswitcher_change_label'] ??'Change');
		         }
		        return $translated_text;
		    }
		    add_filter( 'gettext', 'logingpower_languageswitcher_label', 20, 3 );
	}//add_action( 'login_head', 'logingpower_languageswitcher') ;
	 add_action( 'login_enqueue_scripts', 'logingpower_languageswitcher') ;
	// settings
	function logingpower_settings_option(){
		
	if ( !empty(get_option('logingpower_settings')['logingpower_settings_options'] ) ){
		
		delete_option('logingpower_settings');
		echo'';
	}
}add_action( 'login_head', 'logingpower_settings_option') ;
//add_action( 'login_enqueue_scripts', 'logingpower_settings_option') ;
    



}//endif all customization
/**
 * Summary of logingpower_deactivation
 * delete customized settings
 * */
function logingpower_deactivation(){
	delete_option( 'logingpower_settings' );
}
register_deactivation_hook( __FILE__, 'logingpower_deactivation' );

add_action('admin_menu',function(){
	   LogingPower:: logingpower_menu_page();
	});
	add_action('admin_init', function(){
	    new LogingPower();

	});







