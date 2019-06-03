<br>
<br>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                  <div class="col-md-8">
                      <h5 class="text-white"><?=$titulo_p?></h5>
                      <p class="text-white"><?=$dsc_p?>. </p>
                                    <table class="table table-borderless table-dark">
                                      <!--<thead>
                                        <tr>
                                          <th scope="col">Director</th>
                                          <th scope="col">Actores</th>
                                          <th scope="col">Genero</th>
                                          <th scope="col">Sub titulo forzado</th>
                                        </tr>
                                      </thead>-->

                                      <tbody>
                                          <tr>
                                          <th scope="row"  width="30%">Calidad</th>
                                          <td>  <img src="<?=base_url('img/fhd.png')?>" alt="FULL HD" class="img-thumbnail_carlnet " ></td>
                                          </tr>
                                        <tr>
                                          <th scope="row" width="30%">Director</th>
                                          <td><img src="<?=base_url($director_foto)?>" alt="<?=$director?>" class="img-thumbnail_carlnet rounded" tabindex="0" data-toggle="popover"  data-popover-content="#p_director_p"> <?=$director?>

                                            <!-- Content for Popover #1 -->    
                                            <div id="p_director_p" hidden>
                                               <div class="popover-heading"><?=$director?></div>

                                                <div class="popover-body">
                                                    <img src="<?=base_url($director_foto)?>" alt="<?=$director?>" class="img-thumbnail ">


                                                </div>
                                            </div>   

                                          </td>

                                        </tr>

                                        <tr>
                                          <th scope="row"  width="30%">Actores</th>
                                          <td>
                                              <?php

                                              if($actores){
                                                  foreach ($actores as $ac) {
                                                      echo '<img src="'.base_url($ac["actor_foto"]).'" alt="'.$ac["actor_nombres"]." ". $ac["actor_apellidos"].'" class="img-thumbnail_carlnet rounded" tabindex="0" data-toggle="popover"  data-popover-content="#'.$ac['actorID'].'"> '.$ac["actor_nombres"]." ". $ac["actor_apellidos"]." ";

                                                  ?>
                                               <!-- Content for Popover #1 -->    
                                                    <div id="<?=$ac["actorID"]?>" hidden>
                                                       <div class="popover-heading"><?=$ac["actor_nombres"]." ". $ac["actor_apellidos"]?></div>

                                                        <div class="popover-body">
                                                            <img src="<?=base_url($ac["actor_foto"])?>" alt="<?=$ac["actor_nombres"]." ". $ac["actor_apellidos"]?>" class="img-thumbnail " >


                                                        </div>
                                                    </div>   

                                              <?php



                                                  }
                                              }
                                              ?>

                                              </td>
                                        </tr>
                                        <tr>
                                          <th scope="row"  width="30%">Genero</th>
                                          <td colspan="2">
                                                <?php

                                              if($generos){
                                                  foreach ($generos as $gen) {
                                                      echo $gen["generoNombre"]." ";

                                                  }
                                              }
                                              ?>
                                              </td>

                                        </tr>
                                        <tr>
                                          <th scope="row"  width="30%">Idioma</th>
                                          <td colspan="2"> Latino         
                                          </td>

                                        </tr>
                                        <tr>
                                          <th scope="row"  width="30%">Sub titulo forzado</th>
                                          <td colspan="2">
                                              <?php
                                              if($upload_sub==""){
                                                  echo "NO CONTIENE";
                                              }else{
                                                  echo "SI CONTIENE";
                                              }

                                              ?>

                                          </td>

                                        </tr>
                                      </tbody>
                                    </table>
                      <p> 
                          <a href="#" role="button" class="btn btn-primary btn-lg launch-trailer" data-modal-id="modal-video">ver trailer</a>
                         <a href="#" role="button" class="btn btn-warning btn-lg launch-pelicula" data-modal-id="modal-pelicula">ver pelicula</a>
                      </p> 
                        <!-- MODAL -->
                        <div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-video">
                                            <div class="embed-responsive embed-responsive-21by9">
                                                <video width="320" height="240" controls id="trailer_p">
                                                    <source src="<?=base_url($upload)?>" type="video/mp4">
                                                  Your browser does not support the video tag.
                                                  </video>
                                              <!-- <iframe class="embed-responsive-item" src="<?=base_url($upload)?>"
                                                        webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <!-- MODAL -->
                        <div class="modal fade" id="modal-pelicula" tabindex="-1" role="dialog" aria-labelledby="modal-video-label">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-video">
                                            <div class="embed-responsive embed-responsive-21by9">
                                                <video width="320" height="240" controls id="pelicula_p">
                                                    <source src="<?=base_url($upload)?>" type="video/mp4">
                                                  Your browser does not support the video tag.
                                                  </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                  </div>
                  <div class="col-md-4">
                     <img src="<?=base_url($upload_poster);?>" alt="<?=$titulo_p?>" class="img-thumbnail">
                  </div>
            </div>
        </div>
    </div>

<script>
$('.launch-trailer').on('click', function(e){
    e.preventDefault();
    $( '#' + $(this).data('modal-id') ).modal();
    $('#trailer_p')[0].play();
});
$('#modal-video').on('hidden.bs.modal', function () {
$('#trailer_p')[0].pause();
});

$('.launch-pelicula').on('click', function(e){
    e.preventDefault();
    $( '#' + $(this).data('modal-id') ).modal();
    $('#pelicula_p')[0].play();
});
$('#modal-pelicula').on('hidden.bs.modal', function () {
$('#pelicula_p')[0].pause();
});


$(function(){
    $("[data-toggle=popover]").popover({
        html : true,
        trigger: 'hover',
        content: function() {
          var content = $(this).attr("data-popover-content");
          return $(content).children(".popover-body").html();
        },
        title: function() {
          var title = $(this).attr("data-popover-content");
          return $(title).children(".popover-heading").html();
        }
    }).on('hide.bs.popover', function () {
        if ($(".popover:hover").length) {
          return false;
        }                
    }); 
     $('body').on('mouseleave', '.popover', function(){
       	$('.popover').popover('hide');
    });
});
    



/*
/*

$('.launch-pelicula').on('click', function(e){
    e.preventDefault();
    $( '#' + $(this).data('modal-id') ).modal();
});*/


/*$('.launch-trailer').on('shown.bs.modal', function () {
$('#video1')[0].play();
})
/*$(‘#myModal’).on(‘hidden.bs.modal’, function () {
$(‘#video1’)[0].pause();
})*/
</script>