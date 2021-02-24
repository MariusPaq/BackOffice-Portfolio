<?php

function createCardComp($title,$img){
  echo '
  <div class="cardComp '.$title.'">
    <div class="topCardComp">
      <h5>'.$title.'</h5>
      <img src="'.$img.'" alt="imgComp">
    </div>
  </div>
  ';
}

?>
<script type="text/javascript">
$(document).ready(function( $ ){
  var title = $('.titleCardProj');
  var desc = $('.pCardProj');
  var hoverProj = $('.hover');
  hoverProj.hover(
    function(){
      $(this).css('background-color','rgba(0,0,0,0.6)');
      $(this).find("p").css('color','white');
      $(this).find("p").css('display','block');
      $(this).find("h5").css('color','white');
    },
    function (){
      $(this).css('background-color','rgba(0,0,0,0)');
      $(this).find("p").css('display','none');
      $(this).find("h5").css('color','#212529');
    }
  );
});
</script>
