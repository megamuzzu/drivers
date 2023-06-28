<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Lobster&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>


<section style="height:100vh; background-color: #e0ffef;">
  <div class="container">
    <div class="row">
     <div class="col-md-12 text-center thank_you">
      <h1 class="ml6">
      <span class="text-wrapper">
      <span class="letters">Thank You</span>
      </span>
      </h1>
     </div>
    </div>


    <div class="row text-center">
     <div class="col-md-12 my_thanks">
    <h4><strong><span style="color: #e31e24;">Thanks</span> for installing Driver Repair 24x7</strong></h4>
    <p class="enjoy pt-1">Enjoy with Driver Repair 24x7 software</p>
    <p style="font-size: 1.4vw;"><strong>If have any query call now</strong></p>
   
    <span style="font-size: 3vw; font-weight: 900;"><i class="fa fa-phone-square" aria-hidden="true"></i>&nbsp;&nbsp;(+1) 945-217-7400</span>
    </div>
  </div>
</div>
</section>






<style type="text/css">

.enjoy {
      font-size: 1.9vw;
}
.my_thanks h4{
    font-size: 2.5vw;
}  

.thank_you  {
  margin-top:8%;
}
.ml6 {
  position: relative;
  font-weight: 900;
  font-size: 3.3em;
}

.ml6 .text-wrapper {
  position: relative;
  display: inline-block;
  padding-top: 0.2em;
  padding-right: 0.05em;
  padding-bottom: 0.1em;
  overflow: hidden;
}

.ml6 .letter {
  display: inline-block;
  line-height: 1em;
}
.thank_you h1 {
  font-size: 6vw;
  font-family: Fjalla One;
  color: #087f00;

}




/*--------------------------------*/



</style>


<script type="text/javascript">
  // Wrap every letter in a span
var textWrapper = document.querySelector('.ml6 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: false})
  .add({
    targets: '.ml6 .letter',
    translateY: ["1.1em", 0],
    translateZ: 0,
    duration: 750,
    delay: (el, i) => 50 * i
  }).add({
    targets: '.ml6',
    opacity: 10,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });

</script>

      