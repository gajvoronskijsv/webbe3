<?php

if($_POST['sendform'] == 'Отправить'){
	
	if ($_POST['checkbox'] == ''){
		print('Ознакомтесь с контрактом');
		exit();
	}
	
    foreach($_POST as $key => $val){
        
        if(empty($val)){
			print('Не все поля заполнены');
			exit();
        }
    }
    
    extract($_POST);
    
    if(!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email'])){
    print('Email введен неправильно');
    exit();
    }
	
	$user = 'u20296';
	$pass = '1377191';
	$db = new PDO('mysql:host=localhost;dbname=u20296', $user, $pass);

	$name = $_POST['username'];
	$email = $_POST['email'];
	$date = $_POST['birthdate'];
	$gender = $_POST['sex'];
	$limb = $_POST['limbs'];
	$super = $_POST['superpower'];
	$message = $_POST['biography'];

	try {
		$stmt = $db->prepare("INSERT INTO form (name, email, date, gender, limb, super, message) VALUES (:name, :email, :date, :gender, :limb, :super, :message)");
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':date', $date);
		$stmt->bindParam(':gender', $gender);
		$stmt->bindParam(':limb', $limb);
		$stmt->bindParam(':super', $super);
		$stmt->bindParam(':message', $message);
		$stmt->execute();
		print('Форма заполнена корректно');
	}
	catch(PDOException $e){
		print('Error : ' . $e->getMessage());
		exit();
	}
}

header('Location: /web3');
?>