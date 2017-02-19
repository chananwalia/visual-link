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
    	$("#selection-group").append('<div class="col-md-4"><a href="#" class="animal-selection" id="' + animals[i] + '"><div class="selection-button">' + animals[i] + '<img class="selection-image" src="http://vignette3.wikia.nocookie.net/clubpenguin/images/a/a9/Penguin_Player_card_look_1222333.png/revision/latest?cb=20140723221416" height="150px"></div></a></div>');
    }

    $("#selection-group").on("click", ".animal-selection", function() {
    	console.log("animal selected");
    	selected_animal = $(this).closest("a").prop("id");
		console.log(selected_animal);
    	$(".sub-menu").removeClass("active");
    	$("#color-tab").addClass("active");
    	$("#selection-group").empty();
    	for (var i = 0; i < colors.length; i++) {
    		$("#selection-group").append('<div class="col-md-4"><a href="#" class="color-selection" id="' + colors[i] + '"><div class="selection-button">' + colors[i] + '<img class="selection-image" src="http://vignette3.wikia.nocookie.net/clubpenguin/images/a/a9/Penguin_Player_card_look_1222333.png/revision/latest?cb=20140723221416" height="150px"></div></a></div>');	
    	}
    });

    $("#selection-group").on("click", ".color-selection", function() {
    	console.log("color selected");
    	selected_color = $(this).closest("a").prop("id");
		console.log(selected_color);
    	$(".sub-menu").removeClass("active");
    	$("#bg-tab").addClass("active");
    	$("#selection-group").empty();
    	for (var i = 0; i < bgs.length; i++) {
    		$("#selection-group").append('<div class="col-md-4"><a href="#" class="bg-selection" id="' + bgs[i] + '"><div class="selection-button">' + bgs[i] + '<img class="selection-image" src="http://vignette3.wikia.nocookie.net/clubpenguin/images/a/a9/Penguin_Player_card_look_1222333.png/revision/latest?cb=20140723221416" height="150px"></div></a></div>');	
    	}
    });

    $("#selection-group").on("click", ".bg-selection", function() {
    	console.log("bg selected");
    	selected_bg = $(this).closest("a").prop("id");
		console.log(selected_bg);
		$.ajax({
    	  url: "http://th.chisaz.com/backend/getter.php",
    	  type: "get",
    	  data: {
    	  	bg: selected_bg,
    	  	color: selected_color,
    	  	animal: selected_animal
    	  },
    	  dataType: "text",
    	  success: function(data) {
    	    var json = $.parseJSON(data);
    	    window.location.replace(json.link);
    	  }
    	});
    });

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
    	var link = $("#link-input").val();

    	$.ajax({
    	  url: "http://th.chisaz.com/backend/setter.php",
    	  type: "get",
    	  data: {
    	  	link: link
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