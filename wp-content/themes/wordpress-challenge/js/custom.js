$(function(){
	//actors search
	$('#clearSearch').click(function(){
		var queryParams = new URLSearchParams(window.location.search);
		$('#searchPeople').val('');
	});

	//movies search
	$('#genres').change(function(){
		var genre_id = $('#genres option:selected').val();
		var url = new URL(location.href)

		if (genre_id == 'noGenre'){
			url.searchParams.delete('genre');
			modifiedUrl = url.toString();
		} else {
			url.searchParams.set('genre', genre_id);
			modifiedUrl = url.toString();	
		}

			document.location = modifiedUrl;
	});


	$('#year').change(function(){
		var year_id = $('#year option:selected').val();
		var url = new URL(location.href)

		if (year_id == 'noYear'){
			url.searchParams.delete('year');
			modifiedUrl = url.toString();
		} else {
			url.searchParams.set('year', year_id);
			modifiedUrl = url.toString();	
		}

			document.location = modifiedUrl;
	});

	$('#sort_by').change(function(){
		var sort = $('#sort_by option:selected').val();
		var url = new URL(location.href)

		if (sort == 'asc'){
			url.searchParams.delete('sort_by');
			modifiedUrl = url.toString();
		} else {
			url.searchParams.set('sort_by', sort);
			modifiedUrl = url.toString();	
		}

			document.location = modifiedUrl;
	});


	//slider
	$('#slider-gallery').slick({
	    dots: false,
	    infinite: true,
	    speed: 7000,
	    slidesToShow: 4,
	    slidesToScroll: 1,
	    adaptiveHeight: false,
	    prevArrow: '',
	    nextArrow: '',
	    autoplay: true,
    	autoplaySpeed: 0,
    	fade: false,    
	});
});