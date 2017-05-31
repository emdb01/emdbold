<?php 

require_once '/root/swift-mailer/lib/swift_required.php';

// Create the message
$message = Swift_Message::newInstance()

  // Give the message a subject
  ->setSubject('Your subject')

  // Set the From address with an associative array
  ->setFrom(array('mmurali.technodrive@gmail.com' => 'John Doe'))

  // Set the To addresses with an associative array
  ->setTo(array('karthik909004@gmail.com', 'mmurali.technodrive@gmail.com' => 'technodrive'))

  // Give it a body
  ->setBody('Here is the message itself')

  // And optionally an alternative body
  ->addPart('<q>Here is the message itself</q>', 'text/html')

  // Optionally add any attachments
  ->attach(Swift_Attachment::fromPath('my-document.pdf'))
  ;
?>