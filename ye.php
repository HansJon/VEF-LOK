<!DOCTYPE html>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    <body>
        <form id="ajax-contact" method="post" action="m.php">
		    <div class="field">
		        <label for="name">Name:</label>
		        <input type="text" id="name" name="name" required>
		    </div>

		    <div class="field">
		        <label for="email">Email:</label>
		        <input type="email" id="email" name="email" required>
		    </div>

		    <div class="field">
		        <label for="message">Message:</label>
		        <textarea id="message" name="message" required></textarea>
		    </div>

		    <div class="field">
		        <button type="submit">Send</button>
		    </div>
		</form>

		<div id="form-messages"></div>

		<script src="jquery-2.1.0.min.js"></script>

		<script type="text/javascript">
			$(function() {
			    // Get the form.
			    var form = $('#ajax-contact');

			    // Get the messages div.
			    var formMessages = $('#form-messages');

			    // TODO: The rest of the code will go here...
			});


			// Set up an event listener for the contact form.
			$(form).submit(function(event) {
			    // Stop the browser from submitting the form.
			    event.preventDefault();

			    // TODO
			});

			// Serialize the form data.
			var formData = $(form).serialize();


			// Submit the form using AJAX.
			$.ajax({
			    type: 'POST',
			    url: $(form).attr('action'),
			    data: formData
			}).done(function(response) {
			    // Make sure that the formMessages div has the 'success' class.
			    $(formMessages).removeClass('error');
			    $(formMessages).addClass('success');

			    // Set the message text.
			    $(formMessages).text(response);

			    // Clear the form.
			    $('#name').val('');
			    $('#email').val('');
			    $('#message').val('');
			}).fail(function(data) {
			    // Make sure that the formMessages div has the 'error' class.
			    $(formMessages).removeClass('success');
			    $(formMessages).addClass('error');

			    // Set the message text.
			    if (data.responseText !== '') {
			        $(formMessages).text(data.responseText);
			    } else {
			        $(formMessages).text('Oops! An error occured and your message could not be sent.');
			    }
			});
		</script>
    </body>
</html>