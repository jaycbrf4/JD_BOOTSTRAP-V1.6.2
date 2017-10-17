<?php
/* Template Name: Contact-Page
*
* A Custom PHP Contact us page. Add or change form fields on line 28 and in the form itself.
* Jquery is used to add/remove Bootstrap has-error class to invalid fields.
*/
 
// New Line Tag
$nL = "<br />";
 
// Response generation function
$response = "";
 
// Fuction to generate response
function my_contact_form_generate_response($type, $message)
{
	global $response;

	if($type == "success") $response = "<div class='success alert alert-success' role='alert' id='success-message'>{$message} <i class='glyphicon glyphicon-thumbs-up'></i></div>";
	else $response = "<div class='error alert alert-danger' role='alert' id='error-message'>{$message} <i class='glyphicon glyphicon-thumbs-down'></i> </div>";
}

// Response messages
$missing_content 	= "Please supply all information.";
$email_invalid   		= "Email Address Invalid.";
$message_unsent  	= "Message was not sent. Try Again.";
$message_sent    	= "Thanks! Your message has been sent.";
 
// Define the fields we use, title => field name
// This can be used to add fields into auto-validation below. 
$userVariables = [
	'First Name' 	=> 'first_name',
	'Last Name' 	=> 'last_name',
	'Phone' 			=> 'phone',
	'Email'				=> 'email',
	'Comment' 		=> 'comment'
];

// Instantiate variables for failed, successful validated fields
$failedFields 	= [];
$validFields 		= [];
$failedKeys			= [];
 
// Loop through each variable defined above, and check it's validity as a non-blank string. 
// If successful, add it to the message array and strip all tags for security, and trim whitespace
if(!empty($_POST))
{
	foreach($userVariables as $title => $userField)
	{
		// If our field did not pass validation, we push to failedFields array
		if(!isset($_POST[$userField]) || !is_string($_POST[$userField]) || $_POST[$userField] == '')
		{
			$failedFields[] 	= $title;
			$failedKeys[] 		= $userField;
		}
		// If successful, add this to validFields array and trim/clean the content
		else
		{
			$validFields[$title] = trim(strip_tags(($_POST[$userField])));
		}
	}	
}

// If we have > 0 failed fields, we will send a error response to the form
if(!empty($failedFields))
{
	// Concatenate message with failed fields in the message
	$failureMessage = "The following fields are required: " . implode(', ', $failedFields);
	my_contact_form_generate_response("error", $failureMessage);
}
// Create HTML message
$message  = '<html><head>';
// define the Google Font used in the message
$message .='<style>@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,600");</style>';
$message .='</head>';
$message .='<body style="font-family:Open Sans, sans-serif; font-weight:400;">';
$message .= "<h3>Message from contact form on" .get_bloginfo('name') ."</h3>";
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

// If we have valid fields listed above, we will concatenate a message for the email body then close the table, body, and html tags
if(!empty($validFields))
{
  foreach($validFields as $title => $value)
  {
    $message .= "<tr style='background: #eee;'><td style='width:200px; font-family: Open Sans, sans-serif; margin: 0px; padding:8px; font-weight: 600;'>" . $title . ":</td><td style='font-family: Open Sans, sans-serif; margin: 0px; padding:8px; font-weight: 400;'>" . $value . "</td></tr>";
  }
}
$message .= '</table></body></html>';

// end message


/**
 * Get Error Class
 *
 * @return string;
 */
function getErrorClass($failedKeys, $key)
{	
	if(isset($failedKeys) && is_array($failedKeys) && in_array($key, $failedKeys))
	{
		return 'has-error';
	}
	
	return '';
}

// Mailer variables
$to 			= get_option('admin_email');
$subject 	= "Message from contact form on ".get_bloginfo('name');
$headers 	= 'From: '. $email . "\r\n" . 'Reply-To: ' . $email . "\r\n";

if(empty($failedFields) && isset($_POST['gotcha']) && $_POST['gotcha'] == '')
{
	// Add HTML response type support to the email
	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
	
	// Create the message and send, returning success variable
	$sent = wp_mail($to, $subject, $message, $headers);
	
	// If successful, kick back success on form
	if($sent) 
	{
		my_contact_form_generate_response("success", $message_sent); 
	}
	// On failure, send error response back to the form
	else 
	{
		my_contact_form_generate_response("error", $message_unsent); 
	}
}
else if($_POST['submitted'] || !empty($failedFields)) 
{
	my_contact_form_generate_response("error", $failureMessage);
}
?>
<!-- End Form Logic -->


    <?php get_header(); ?>
    <div id="content">
        <div class="container-fluid">
            <div class="row">
                <div id="main" class="clearfix" role="main">
                    <div class="container wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="page-title">Contact Us</h1>
                                <div id="respond">
                                    <?php echo $response; ?>
                                    <form class="form-horizontal well" action="<?php the_permalink(); ?>" method="post" id="contact_form">
                                        <fieldset>
                                            <!-- Form Name -->
                                            <legend>Do you have questions, interested in a product or would like to place an order?</legend>
                                            <p>Please fill out the contact form and we will get back to you ASAP!</p>
                                            <div class="col-sm-6">
                                                <!-- Text input-->
                                                <div class="form-group <?php echo getErrorClass($failedKeys, 'first_name'); ?>">
                                                    <label class="control-label">First Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                        <input name="first_name" placeholder="First Name" class="form-control" type="text" value="<?php echo esc_attr($_POST['first_name']); ?>" required>
                                                    </div>
                                                </div>
                                                <!-- Text input-->
                                                <div class="form-group <?php echo getErrorClass($failedKeys, 'last_name'); ?>">
                                                    <label class="control-label">Last Name</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                        <input name="last_name" placeholder="Last Name" class="form-control" type="text" value="<?php echo esc_attr($_POST['last_name']); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.col-->
                                            <div class="col-sm-6">
                                                <!-- Text input-->
                                                <div class="form-group <?php echo getErrorClass($failedKeys, 'email'); ?>">
                                                    <label class="control-label">E-Mail</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                        <input name="email" placeholder="E-Mail Address" class="form-control" type="email" value="<?php echo esc_attr($_POST['email']); ?>" required>
                                                    </div>
                                                </div>
                                                <!-- Text input-->
                                                <div class="form-group <?php echo getErrorClass($failedKeys, 'phone'); ?>">
                                                    <label class="control-label">Phone #</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                        <input name="phone" placeholder="(855)555-1212" class="form-control" type="text" value="<?php echo esc_attr($_POST['phone']); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.col-->
                                            <div class="col-sm-12">
                                                <!-- Text area -->
                                                <div class="form-group <?php echo getErrorClass($failedKeys, 'comment'); ?>">
                                                    <label class="control-label">Your Message</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                        <textarea class="form-control" name="comment" required><?php echo esc_textarea($_POST['comment']); ?></textarea>
                                                    </div>
                                                </div>
                                                <!--Anti-Spam Field-->
                                                <div class="form-group hidden" id="gotcha">
                                                    <label class="control-label">Leave this field empty</label>
                                                    <div class="input-group">
                                                        <input name="gotcha" class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group hidden">
                                                    <input type="hidden" name="submitted" value="1">
                                                </div>
                                                <!-- Button -->
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info">Send
                                                        <span class="glyphicon glyphicon-send"></span>
                                                    </button>
                                                </div>
                                            </div><!--/.col-md-8-->
                                        </fieldset>
                                    </form>
																						
									<script>
										// Add/Remove Bootstrap "has-error" class from invalid fields on key-up and blur
										jQuery('#contact_form :input').keyup(function ()
										{
											var formElement 	= jQuery(this);
												  formGroup 	= formElement.closest('.form-group');
											
											if(formGroup.hasClass('has-error') && jQuery.trim(formElement.val()).length)
											{
												formGroup.removeClass('has-error');
											}
										});

										jQuery('#contact_form :input').blur(function ()
										{
											var formElement 	= jQuery(this);
												  formGroup 	= formElement.closest('.form-group');
											
											if(jQuery.trim(formElement.val()).length==0)
											{
												formGroup.addClass('has-error');
											}
										});
									</script>

                                </div><!--/.respond-->
                            </div><!--/.col-->
                        </div><!-- /.row-->
                    </div><!--/.container-->
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix'); ?> role="article">
                        <section class="post_content">
                            <?php the_content(); ?>
                        </section><!-- end article header -->
                    </article><!-- end article -->
                    <?php endwhile; ?>
                    <?php else : ?>
                    <article id="post-not-found">
                        <header>
                            <h1><?php _e("Not Found", "JD_BOOTSTRAP"); ?></h1>
                        </header>
                        <section class="post_content">
                            <p>
                                <?php _e("Sorry, but the requested resource was not found on this site.", "JD_BOOTSTRAP"); ?>
                            </p>
                        </section>
                    </article>
                    <?php endif; ?>
                </div><!-- /main -->
            </div><!--/row-->
        </div><!-- /container-fluid -->
    </div><!-- /content -->
    <?php get_footer(); ?>
