
    <div class="add-note" ng-app="addDiss">
    	<div class="page-header">
        <h1>Dodaj dissa:</h1>
    	</div>
    	<?php if(!$_SESSION['logged'])
    	 echo '<div class="alert alert-info" role="alert">Gdy dodajesz dissa będąc zajerestrowanym masz możliwość podlądu jego ocen i komentarzy.
    	 To tylko diwe z wielu przywilejów zajerestrowanych użytkowników. Jeśli chcesz dowiedzieć się więcej <b><a href="#" class="alert-link">kliknij.</a></b></div>';

    	 else { echo '<div class="alert alert-info" role="alert">Po dodaniu dissa będziesz otrzymywał powiadomienia o nowych komentarzach i ocenach twojego dissa.
    	 Będą one widoczne w menu po kliknięciu przycisku profil.</a></b></div>'; }

    	 ?>

    	<form ng-controller="add-diss" role="form">
    		<div class="alert" role="alert" ng-show="!ok" ng-class="myClass">
                <strong ng-show="errorMessage">Błąd:</strong><strong ng-show="!errorMessage">Sukces:</strong>{{ somethingwentwrong }} 
            </div>
    		<div class="form-group">
            	<label for="word" class="control-label">Tytuł:</label>
            	<input type="text" class="form-control" ng-model="dissName">
            </div>
            <div class="form-group">
	            <label for="word" class="control-label">Tagi:</label>
	            <input type="text" class="form-control" ng-model="dissTags">
	        </div>
	        <div class="form-group">
	            <label for="mainText" class="control-label">Tekst:</label>
	            <textarea style="resize: vertical;overflow: auto;" ng-model="dissText" class="form-control"></textarea>
	        </div>
	        <div class="form-group">
	        	<button ng-click="add()" type="submit" class="form-control btn btn-login">Dodaj</button>
	        </div>
        </form>
	</div>

<script src="resources/js/addDiss.js"></script>
