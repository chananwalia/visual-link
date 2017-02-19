$(document).ready(function() {

	var colors = ["pink", "red", "orange", "yellow", "green", "blue", "purple", "teal", "maroon"];
	var animals = ["elephant", "penguin", "turtle", "pig", "dog", "cat", "unicorn", "monkey", "whale"];
	var bgs = ["beach", "jungle", "city", "snow", "space", "desert", "mountain", "garden", "underwater"];
	var selected_animal;
	var selected_color;
	var selected_bg;

	console.log("ready!");
	$("#create").hide();
    // $("#selections").hide();

    for (var i = 0; i < animals.length; i++) {
    	$("#selections").append('<div class="col-md-4"><a href="#" class="animal-selection"><div class="selection-button" id="' + animals[i] + '"><img class="selection-image" src="http://vignette3.wikia.nocookie.net/clubpenguin/images/a/a9/Penguin_Player_card_look_1222333.png/revision/latest?cb=20140723221416" height="150px"></div></a></div>');
    }

    $(".animal-selection").click(function(event) {
    	var selected_animal = event.target.id;
		console.log(selected_animal);
    	$(".sub-menu").removeClass("active");
    	$("#color-tab").addClass("active");
    	$("#selections").hide();
    	$("#selections").show();
    });

    $("#selection-group").append()

    $("#create-button").click(function() {
    	$("#selections").hide();
    	$("#create").show();
    	$("#create-button").addClass("active");
    	$("#go-to-button").removeClass("active");
    });

    $("#go-to-button").click(function() {
    	$("#create").hide();
    	$("#selections").show();
    	$("#go-to-button").addClass("active");
    	$("#create-button").removeClass("active");
    });

    $("#submit-form").submit(function(event) {
    	alert("Handler for .submit() called.");

    	$.ajax({
    	  url: "getter.php",
    	  type: "get",
    	  data: {
    	  	link: $("#link-input").value()
    	  },
    	  dataType: "text",
    	  success: function(data) {
    	    var json = $.parseJSON(data);

    	    console.log(json.animal);
    	    console.log(json.color);
    	    console.log(json.bg);
    	  }
    	});
    	event.preventDefault();
    });

});