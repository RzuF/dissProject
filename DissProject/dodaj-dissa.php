
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
    		<div class="alert alert-danger" role="alert" ng-show="!ok">
                                    <strong>Błąd:</strong>{{ somethingwentwrong }} 
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
	            <textarea ng-model="dissText" class="form-control"></textarea>
	        </div>
	        <div class="form-group">
	        	<button ng-click="add()" type="submit" class="form-control btn btn-default">Dodaj</button>
	        </div>
        </form>

        <div class="container note-size">
    	<div class="space"></div>

    	<div class="note">
    		<!-- Note description -->
			<div class="row note-title">
				<div class="col-lg-8 col-xs-8">
					<div class="note-title-title">{{dissName || "Tytuł dissa"}}</div>
				</div>
				<div class="col-lg-4 col-xs-4">
					<div class="note-title-comments"><a href="#"><i class="fa fa-comments"></i> 123</a></div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8 col-xs-8">
					<div class="note-copright"><i class="fa fa-user"></i> <?php echo $_SESSION['login']?></div>
				</div>
				<div class="col-lg-4 col-xs-4">
					<div class="note-date"> <i class="fa fa-calendar"></i> 25.06.2015</div>
				</div>
			</div>

			<!-- Note image -->
			<img src="getImage.php?id=1" class="img-responsive img-rounded">

			<!-- Note rank -->
			<div class="note-rank">
				<div class="input-group">
         			<span class="input-group-btn">
              			<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                			<span class="fa fa-minus"></span>
              			</button>
          			</span>
          			<input type="text" name="quant[2]" class="form-control input-number" value="69" min="0" max="100" disabled>
          			<span class="input-group-btn">
              			<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  	<span class="fa fa-plus"></span>
              			</button>
          			</span>
      			</div>
			</div>
		</div> <!-- END NOTE -->
		</div>
	</div>

<script src="resources/js/addDiss.js"></script>
