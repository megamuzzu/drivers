<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Lobster&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>


<section class="thankyouBanner">
  <div class="container">
    <div class="row">
     <div class="col-md-12 text-center thank_you">
      <h1 class="ml6">
      <span class="text-wrapper">
      <span class="letters"  style="color:#326a8a";>Thank You</span>
        <span  class="installing" style="color: #000;">for installing Driver Repair 24x7</span>

      </span>
   
      </h1>

     </div>
    </div>


    <div class="row text-center">
     <div class="col-md-12 my_thanks">
<!--     <p class="enjoy pt-1">Enjoy with Driver Repair 24x7 software</p>
 -->    
 <p  class="mt-1 please_tec"><strong>Please call us, for any technical queries or support related to your PC.</strong></p>

    <span class="p-number" style=" font-weight: 900;"><i class="fa fa-phone-square" aria-hidden="true"></i>&nbsp;&nbsp;(+1) 945-217-7400</span>
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
  font-size: 3.1vw;


}

.letters  {
  color: #e31e24!important;

}


.installing {
    font-weight: 100;
    font-size: 45px;
    color: #000;
}

.please_tec  {
   font-size: 1.4vw; 
}

.p-number  {
  font-size: 3vw;
}
</style>








<script type="text/javascript">
  // Wrap every letter in a span
var textWrapper = document.querySelector('.ml6 .letters ');
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

      