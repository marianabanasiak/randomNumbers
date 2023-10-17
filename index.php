<?php
	#uruchamiamy sesje
	session_start();
/*Stwórz formularz w php do którego użytkownik będzie miał
za zadanie wpisywać liczby od 1 do 100 skrypt php przy pierwszym 
wejściu na stronę wylosuje liczbę od 1-100 i celem użytkownika będzie 
odgadnięcie wylosowanej liczby. Użytkownik ma mieć możliwość wylosowanie 
nowej liczby (rozpoczęcia gry od nowa). 
Pamiętaj że wylosowaną liczbę do odgadnięcia 
lub rozpoczęcia nowej gry należy gdzieś przechowywać!
*na stronie ma być wyświetlana ulość prób odgadnięcia 
*/
		#wprowadzamy funkcje z paramentrami: liczba wygenerowana randomowo i liczba otrzymana z formularza i 
	function checkNumbers($randomedNumber, $received) {
		#spawdzamy, czy liczba randomowa jest większa od wysłanej w formularzu
		if ($_SESSION['randomNumber'] > $_POST['number']) {
			echo 'Your number is smaller than the randomed number';
		#spawdzamy, czy liczba randomowa jest mniejsza od wysłanej w formularzu
		} elseif ($_SESSION['randomNumber'] < $_POST['number']) {
			echo 'Your number is bigger than the randomed number';
		} else {
			#wyświetlamy komunikat jeśli liczba randomowa równa się wysłanej w formularzu
			echo 'Congratulations! YOU WON!';
		} 
	}
	#sprawdzamy, czy sessji istnieje
	if (empty($_SESSION['randomNumber'])) {
		#zapisujemy wygenerowaną liczbę do zmiennej
		$random = rand (1,100);
		#zapisujemy wygenerowaną liczbę do sessesji
		$_SESSION['randomNumber'] = $random;
		echo 'Type a number';
		#print_r($_SESSION);
	} else {
		#spawdzamy, czy wpropwadzona poprzez użytkownika liczba istnieje, jest większa od 0 i mniejsza od 100
		if (!empty($_POST['number']) && $_POST['number'] > 0 && $_POST['number'] <= 100) {
			#jesli warunek spełniony, uruchamiamy funkcję
			checkNumbers($_SESSION['randomNumber'], $_POST['number']);
		} else {
			#jeśli warunek nie jest spełniony wyświetlamy odpowiedni komunikat
			echo 'Type a number';
		}
	}
	/*echo '<br>';
	var_dump(empty($_SESSION['attempts']));
	var_dump($_SESSION['attempts'] ==0);
	echo '<br>';
	*/
	#wyświetlamy: "Attempts: "
	echo '<br>' . 'Attempts: ';
	#sprawdzamy warunek, jeśli formularz z wpisana liczą nie został wysłany lub sessja jest równa 0
	if (empty($_POST['number']) || $_SESSION['attempts'] == 0 ) {
		$_SESSION['attempts'] = 1;
	} else {
		$_SESSION['attempts'] += 1;
	}
	#wyświetlamy ilość prób
	print_r($_SESSION['attempts']);
	#$_SESSION['attempts'] = 0;
	#sprawdzamy, czy został naciśnięty guzik playAgain
	if (!empty($_POST['playAgain'])) {
		#jesli tak, resetujemy sesje wszystkie
		unset($_SESSION['attempts']);
		unset($_SESSION['randomNumber']);
		#odswieżamy stronę
		header("Refresh:0");
	} 
?>

<html>
	<head>
	</head>
	<body>
		<form method="post" action="index.php">
			<input type="number" name="number">
			<input type="submit" name="submitNumber" value="Check">
			<input type="submit" name="playAgain" value="Play again">
		</form>
	</body>
</html>
