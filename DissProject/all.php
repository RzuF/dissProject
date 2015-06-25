<div class="container note-size" ng-controller="dbCtrl">

    <div ng-repeat="note in view">
        <div class="note">
            <!-- Note description -->
            <div class="row note-title">
                <div class="col-lg-8 col-xs-8">
                    <div class="note-title-title"> {{ note.title }} </div>
                </div>
                <div class="col-lg-4 col-xs-4">
                    <div class="note-title-comments"><a href="#"><i class="fa fa-comments"></i> 65</a></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-xs-8">
                    <div class="note-copright"><i class="fa fa-user"></i> {{ note.login }} </div>
                </div>
                <div class="col-lg-4 col-xs-4">
                    <div class="note-date"> <i class="fa fa-calendar"></i> {{ note.date }} </div>
                </div>
            </div>

            <!-- Note image -->
            <img src="getImage.php?id=1" class="img-responsive img-rounded">
            
            <div class="note-rank">
                <a href="#" class="action-button shadow animate green"><i class="fa fa-plus"></i></a>
                <a href="#" class="action-button shadow animate red"><i class="fa fa-minus"></i></a>
                <div class="note-rank-rank">{{ 1 * note.plus - note.minus * 1 }}, id: {{ note.id }}</div>
            </div>

        </div> <!-- END NOTE -->
        <div class="space"></div>
    </div> <!-- .ng-repeat -->

</div>

<!--
SELECT a.title, a.plus, a.minus, a.date, b.login, a.source 
-->