$("a").on("click", function (e) {

    // Id of the element that was clicked
    var elementId = $(this).attr("id");
    services(elementId);

});

function services(elementId) {
	//document.write('in services function');
	var id_symbol = "#";
    var concat = " img";
	switch (elementId) 
    {
    	case 'all-work-example':
    		$(id_symbol.concat(elementId.concat(concat))).attr('src', "/assets/img/page3a_examples/all_work_icon_overlay.png");
    		//make rest not glow
    		$(id_symbol.concat('strategy-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/strategy_icon_example.png");
    		$(id_symbol.concat('creative-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/creative_icon_example.png");
    		$(id_symbol.concat('development-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/development_icon_example.png");
    		$(id_symbol.concat('experiential-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/experiential_icon_example.png");
    		//don't display other class portfolio
    		var strategy_portfolio = document.getElementsByClassName('strategy-portfolio');
    		for (var i = 0; i < strategy_portfolio.length; i++) {
    			strategy_portfolio[i].style.display = 'none';
    		};

    		var creative_portfolio = document.getElementsByClassName('creative-portfolio');
    		for (var i = 0; i < creative_portfolio.length; i++) {
    			creative_portfolio[i].style.display = 'none';
    		};

    		var development_portfolio = document.getElementsByClassName('development-portfolio');
    		for (var i = 0; i < development_portfolio.length; i++) {
    			development_portfolio[i].style.display = 'none';
    		};

    		var experiential_portfolio = document.getElementsByClassName('experiential-portfolio');
    		for (var i = 0; i < experiential_portfolio.length; i++) {
    			experiential_portfolio[i].style.display = 'none';
    		};

    		//display elements that are for this portfolio
    		var all_work_portfolio = document.getElementsByClassName('all-work-portfolio');
    		for (var i = 0; i < all_work_portfolio.length; i++) {
    			all_work_portfolio[i].style.display = 'block';
    		};

    		break;
    	case 'strategy-example':
    		$(id_symbol.concat(elementId.concat(concat))).attr('src', "/assets/img/page3a_examples/strategy_icon_example_overlay.png");
    		//make rest not glow
    		$(id_symbol.concat('all-work-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/all_work_icon.png");
    		$(id_symbol.concat('creative-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/creative_icon_example.png");
    		$(id_symbol.concat('development-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/development_icon_example.png");
    		$(id_symbol.concat('experiential-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/experiential_icon_example.png");
    		//don't display other class portfolio
    		var all_work_portfolio = document.getElementsByClassName('all-work-portfolio');
    		for (var i = 0; i < all_work_portfolio.length; i++) {
    			all_work_portfolio[i].style.display = 'none';
    		};

    		var creative_portfolio = document.getElementsByClassName('creative-portfolio');
    		for (var i = 0; i < creative_portfolio.length; i++) {
    			creative_portfolio[i].style.display = 'none';
    		};

    		var development_portfolio = document.getElementsByClassName('development-portfolio');
    		for (var i = 0; i < development_portfolio.length; i++) {
    			development_portfolio[i].style.display = 'none';
    		};

    		var experiential_portfolio = document.getElementsByClassName('experiential-portfolio');
    		for (var i = 0; i < experiential_portfolio.length; i++) {
    			experiential_portfolio[i].style.display = 'none';
    		};

    		//display elements that are for this portfolio
    		var strategy_portfolio = document.getElementsByClassName('strategy-portfolio');
    		for (var i = 0; i < strategy_portfolio.length; i++) {
    			strategy_portfolio[i].style.display = 'block';
    		};
    		break;
    	case 'creative-example':
    		$(id_symbol.concat(elementId.concat(concat))).attr('src', "/assets/img/page3a_examples/creative_icon_example_overlay.png");
    		//make rest not glow
    		$(id_symbol.concat('all-work-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/all_work_icon.png");
    		$(id_symbol.concat('strategy-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/strategy_icon_example.png");
    		$(id_symbol.concat('development-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/development_icon_example.png");
    		$(id_symbol.concat('experiential-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/experiential_icon_example.png");
    		//don't display other class portfolio
    		var all_work_portfolio = document.getElementsByClassName('all-work-portfolio');
    		for (var i = 0; i < all_work_portfolio.length; i++) {
    			all_work_portfolio[i].style.display = 'none';
    		};

    		var strategy_portfolio = document.getElementsByClassName('strategy-portfolio');
    		for (var i = 0; i < strategy_portfolio.length; i++) {
    			strategy_portfolio[i].style.display = 'none';
    		};

    		var development_portfolio = document.getElementsByClassName('development-portfolio');
    		for (var i = 0; i < development_portfolio.length; i++) {
    			development_portfolio[i].style.display = 'none';
    		};

    		var experiential_portfolio = document.getElementsByClassName('experiential-portfolio');
    		for (var i = 0; i < experiential_portfolio.length; i++) {
    			experiential_portfolio[i].style.display = 'none';
    		};

    		//display elements that are for this portfolio
    		var creative_portfolio = document.getElementsByClassName('creative-portfolio');
    		for (var i = 0; i < creative_portfolio.length; i++) {
    			creative_portfolio[i].style.display = 'block';
    		};
    		break;
    	case 'development-example':
    		$(id_symbol.concat(elementId.concat(concat))).attr('src', "/assets/img/page3a_examples/development_icon_example_overlay.png");
    		//make rest not glow
    		$(id_symbol.concat('all-work-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/all_work_icon.png");
    		$(id_symbol.concat('strategy-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/strategy_icon_example.png");
    		$(id_symbol.concat('creative-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/creative_icon_example.png");
    		$(id_symbol.concat('experiential-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/experiential_icon_example.png");
    		//don't display other class portfolio
    		var all_work_portfolio = document.getElementsByClassName('all-work-portfolio');
    		for (var i = 0; i < all_work_portfolio.length; i++) {
    			all_work_portfolio[i].style.display = 'none';
    		};

    		var strategy_portfolio = document.getElementsByClassName('strategy-portfolio');
    		for (var i = 0; i < strategy_portfolio.length; i++) {
    			strategy_portfolio[i].style.display = 'none';
    		};

    		var creative_portfolio = document.getElementsByClassName('creative-portfolio');
    		for (var i = 0; i < creative_portfolio.length; i++) {
    			creative_portfolio[i].style.display = 'none';
    		};

    		var experiential_portfolio = document.getElementsByClassName('experiential-portfolio');
    		for (var i = 0; i < experiential_portfolio.length; i++) {
    			experiential_portfolio[i].style.display = 'none';
    		};

    		//display elements that are for this portfolio
    		var development_portfolio = document.getElementsByClassName('development-portfolio');
    		for (var i = 0; i < development_portfolio.length; i++) {
    			development_portfolio[i].style.display = 'block';
    		};
    		break;
    	case 'experiential-example':
    		$(id_symbol.concat(elementId.concat(concat))).attr('src', "/assets/img/page3a_examples/experiential_icon_example_overlay.png");
    		//make rest not glow
    		$(id_symbol.concat('all-work-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/all_work_icon.png");
    		$(id_symbol.concat('strategy-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/strategy_icon_example.png");
    		$(id_symbol.concat('creative-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/creative_icon_example.png");
    		$(id_symbol.concat('development-example'.concat(concat))).attr('src', "/assets/img/page3a_examples/development_icon_example.png");
    		//don't display other class portfolio
    		var all_work_portfolio = document.getElementsByClassName('all-work-portfolio');
    		for (var i = 0; i < all_work_portfolio.length; i++) {
    			all_work_portfolio[i].style.display = 'none';
    		};

    		var creative_portfolio = document.getElementsByClassName('creative-portfolio');
    		for (var i = 0; i < creative_portfolio.length; i++) {
    			creative_portfolio[i].style.display = 'none';
    		};

    		var development_portfolio = document.getElementsByClassName('development-portfolio');
    		for (var i = 0; i < development_portfolio.length; i++) {
    			development_portfolio[i].style.display = 'none';
    		};

    		var strategy_portfolio = document.getElementsByClassName('strategy-portfolio');
    		for (var i = 0; i < strategy_portfolio.length; i++) {
    			strategy_portfolio[i].style.display = 'none';
    		};

    		//display elements that are for this portfolio
    		var experiential_portfolio = document.getElementsByClassName('experiential-portfolio');
    		for (var i = 0; i < experiential_portfolio.length; i++) {
    			experiential_portfolio[i].style.display = 'block';
    		};
    		break;
    }

}