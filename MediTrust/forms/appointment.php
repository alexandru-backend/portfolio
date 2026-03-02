<?php
  /**
  * Formulário de marcações agora processado em appointment.php
  * Redireciona para evitar erro da biblioteca PHP Email Form (versão paga)
  */
  header("Location: ../appointment.php");
  exit;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = 'Online Appointment Form';

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'Name');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['phone'], 'Phone');
  isset($_POST['date']) && $contact->add_message($_POST['date'], 'Appointment Date');
  isset($_POST['time']) && $contact->add_message($_POST['time'], 'Appointment Time');
  isset($_POST['department']) && $contact->add_message($_POST['department'], 'Department');
  isset($_POST['doctor']) && $contact->add_message($_POST['doctor'], 'Doctor');
  $contact->add_message( $_POST['message'], 'Message');

  echo $contact->send();
?>
