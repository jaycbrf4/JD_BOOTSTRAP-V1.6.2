<?php
/* Template Name: Contact-Page
*/
 
  //response generation function
  $response = "";
 
  //function to generate response
  function my_contact_form_generate_response($type, $message){
 
    global $response;
 
    if($type == "success") $response = "<div class='success alert alert-success' role='alert' id='success-message'>{$message} <i class='glyphicon glyphicon-thumbs-up'></i></div>";
    else $response = "<div class='error alert alert-danger' role='alert' id='error-message'>{$message} <i class='glyphicon glyphicon-thumbs-down'></i> </div>";
 
  }

  //response messages
$missing_content = "Please supply all information.";
$email_invalid   = "Email Address Invalid.";
$message_unsent  = "Message was not sent. Try Again.";
$message_sent    = "Thanks! Your message has been sent.";
 
//user posted variables
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message .= 'Contact from:' ."\r\n" . 'First Name: ' . $firstName . "\r\n" . 'Last Name: '  . $lastName . "\r\n" . 'Phone: ' . $phone . "\r\n" . 'Comment: ' . $_POST['comment'];
 
//php mailer variables
$to = get_option('admin_email'); 
$subject = "Message from contact us form on ".get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" .
  'Reply-To: ' . $email . "\r\n";

if(isset($_POST['gotcha']) && $_POST['gotcha'] == ''){

     
          $sent = wp_mail($to, $subject, strip_tags($message), $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
    }

  else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);
?>
<?php get_header(); ?>

<div id="content">
        <div  class="container-fluid">
                <div class="row">
                                <div id="main" class="clearfix" role="main">

                                            <div class="container">
                                                      <div class="row">
                                                                      <div class="col-sm-12">
                                                                              <h1 class="page-title">Contact Us</h1>               
                                                                                      <div id="respond">
                                                                                      <?php echo $response; ?>
                                                                                              <form class="form-horizontal well"  action="<?php the_permalink(); ?>" method="post" id="contact_form">
                                                                                                      <fieldset>

                                                                                                              <!-- Form Name -->
                                                                                                              <legend>Do you have questions or maybe you just want to tell us about your experience?</legend>
                                                                                                              <p>Please fill out the contact form and we will get in touch shortly.</p>

                                                                                                            <div class="col-sm-8">

                                                                                                              <!-- Text input-->
                                                                                                              <div class="form-group">
                                                                                                                  <label class="control-label">First Name</label>  
                                                                                                                         <div class="input-group">
                                                                                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                                                                                                <input  name="first_name" placeholder="First Name" class="form-control"  type="text" value="<?php echo esc_attr($_POST['first_name']); ?>" required>
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                              <!-- Text input-->
                                                                                                              <div class="form-group">
                                                                                                                  <label class="control-label" >Last Name</label> 
                                                                                                                       <div class="input-group">
                                                                                                                              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                                                                                              <input name="last_name" placeholder="Last Name" class="form-control"  type="text" value="<?php echo esc_attr($_POST['last_name']); ?>" required>
                                                                                                                          </div>
                                                                                                                      </div>

                                                                                                              <!-- Text input-->
                                                                                                              <div class="form-group">
                                                                                                                  <label class="control-label">E-Mail</label>  
                                                                                                                       <div class="input-group">
                                                                                                                              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                                                                                              <input name="email" placeholder="E-Mail Address" class="form-control"  type="email" value="<?php echo esc_attr($_POST['email']); ?>" required>
                                                                                                                          </div>
                                                                                                                      </div>

                                                                                                              <!-- Text input-->
                                                                                                              <div class="form-group">
                                                                                                                  <label class="control-label">Phone #</label>  
                                                                                                                       <div class="input-group">
                                                                                                                              <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                                                                                              <input name="phone" placeholder="(855)555-1212" class="form-control" type="text" value="<?php echo esc_attr($_POST['phone']); ?>">
                                                                                                                          </div>
                                                                                                                      </div>


                                                                                                              <!-- Text area -->
                                                                                                              <div class="form-group">
                                                                                                                  <label class="control-label">Your Message</label>
                                                                                                                      <div class="input-group">
                                                                                                                          <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                                                                                          <textarea class="form-control" name="comment" placeholder="Comment or Question" required><?php echo esc_textarea($_POST['comment']); ?></textarea>
                                                                                                                      </div>
                                                                                                                  </div>


                                                                                                              <!--Anti-Spam Field-->
                                                                                                              <div class="form-group hidden" id="gotcha">
                                                                                                                  <label class="control-label">Leave this field empty</label>  
                                                                                                                      <div class="input-group">
                                                                                                                          <input  name="gotcha"  class="form-control"  type="text">
                                                                                                                      </div>
                                                                                                                  </div>


                                                                                                              <div class="form-group hidden" >
                                                                                                              <input type="hidden" name="submitted" value="1">
                                                                                                              </div>

                                                                                                              <!-- Button -->
                                                                                                              <div class="form-group">
                                                                                                                    <button type="submit" class="btn btn-info" >Send <span class="glyphicon glyphicon-send"></span></button>
                                                                                                              </div>

                                                                                                  </div><!--/.col-md-8-->

                                                                                              </fieldset>
                                                                                          </form>
                                                                                        </div><!--/.respond-->
                                                                      </div><!--/.col-->
                                                      </div><!-- /.row-->
                                            </div><!--/.container-->

                                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

                                        <section class="post_content">

                                                <?php the_content(); ?>

                                        </section> <!-- end article header -->

                                </article> <!-- end article -->

                                <?php endwhile; ?>  

                                <?php else : ?>

                                <article id="post-not-found">
                                          <header>
                                                  <h1><?php _e("Not Found", "JD_BOOTSTRAP"); ?></h1>
                                          </header>
                                          <section class="post_content">
                                                  <p><?php _e("Sorry, but the requested resource was not found on this site.", "JD_BOOTSTRAP"); ?></p>
                                          </section>

                                </article>

                                <?php endif; ?>

                                </div> <!-- /main -->
                        </div><!--/row-->
                </div> <!-- /container-fluid -->  
</div> <!-- /content -->
<?php get_footer(); ?>