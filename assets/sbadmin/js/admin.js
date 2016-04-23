jQuery().ready(function() {

  var rules = {};

  for (var i=1; i<=93; i++)
  {
    rules['response'+[i]] = {
      required: true
    };

  }

  var v = jQuery("#questionnaireform").validate({

  	
    rules: rules
  
        
    });
   $('#print_btn').click(function () {
        $('#printMe').printThis();
      });

   $("#start_date" ).datepicker({dateFormat:'yy-mm-dd'});
  $("#end_date" ).datepicker({dateFormat:'yy-mm-dd'});

  $("#end_date" ).change(function(){

 $("#start_date" ).val(this.value).datepicker('update');
  });

 $(".frm").hide("fast");
 $("#sf1").show("slow");
  	// Binding next button on first step
  $(".open1").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf2").show("slow");
      }
   });

   // Binding next button on second step
   $(".open2").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf3").show("slow");
      }
    });

   // Binding next button on third step

   $(".open3").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf4").show("slow");
      }
   });

   // Binding next button on fourth step

   $(".open4").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf5").show("slow");
      }
   });

   // Binding next button on fifth step

   $(".open5").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf6").show("slow");
      }
   });

   // Binding next button on six step

   $(".open6").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf7").show("slow");
      }
   });

   // Binding next button on seven step

   $(".open7").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf8").show("slow");
      }
   });


// Binding next button on eight step
   $(".open8").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf9").show("slow");
      }
   });


// Binding next button on nine step
   $(".open9").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf10").show("slow");
      }
   });

   // Binding next button on ten step
   $(".open10").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf11").show("slow");
      }
   });

     // Binding back button on second step
    $(".back2").click(function() {
      $(".frm").hide("fast");
      $("#sf1").show("slow");
    });

     // Binding back button on third step
     $(".back3").click(function() {
      $(".frm").hide("fast");
      $("#sf2").show("slow");
    });

      // Binding back button on fourth step
    $(".back4").click(function() {
      $(".frm").hide("fast");
      $("#sf3").show("slow");
    });

 // Binding back button on 5 step
    $(".back5").click(function() {
      $(".frm").hide("fast");
      $("#sf4").show("slow");
    });

 // Binding back button on 6 step
    $(".back6").click(function() {
      $(".frm").hide("fast");
      $("#sf5").show("slow");
    });

 // Binding back button on 7 step
    $(".back7").click(function() {
      $(".frm").hide("fast");
      $("#sf6").show("slow");
    });

 // Binding back button on 8 step
    $(".back8").click(function() {
      $(".frm").hide("fast");
      $("#sf7").show("slow");
    });

 // Binding back button on 9 step
    $(".back9").click(function() {
      $(".frm").hide("fast");
      $("#sf8").show("slow");
    });

 // Binding back button on 10 step
    $(".back10").click(function() {
      $(".frm").hide("fast");
      $("#sf9").show("slow");
    });

// Binding back button on 11 step
    $(".back11").click(function() {
      $(".frm").hide("fast");
      $("#sf10").show("slow");
    });



});
