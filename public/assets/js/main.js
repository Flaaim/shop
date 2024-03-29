$(function() {

	$('.open-search').click(function(e) {
		e.preventDefault();
		$('#search').addClass('active');
	});
	$('.close-search').click(function() {
		$('#search').removeClass('active');
	});

	$(window).scroll(function() {
		if ($(this).scrollTop() > 200) {
			$('#top').fadeIn();
		} else {
			$('#top').fadeOut();
		}
	});

	$('#top').click(function() {
		$('body, html').animate({scrollTop:0}, 700);
	});

	$('.sidebar-toggler .btn').click(function() {
		$('.sidebar-toggle').slideToggle();
	});

	$('.thumbnails').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled: true
		},
		removalDelay: 500,
		callbacks: {
			beforeOpen: function() {
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		}
	});

	$('#languages .dropdown-item').click(function(){
		const lang_code = $(this).data('langcode');
		
		window.location = PATH + '/language/change?lang='+ lang_code;
	});

	$("#input-sort").change(function(){
		window.location = PATH + window.location.pathname + '?'+ $(this).val();
	});
	$("#input-sort-count").change(function(){
		window.location = PATH + window.location.pathname + '?' + $(this).val();
	});


	// CART 
	function showCart(cart) {
		$("#cart-modal .modal-cart-content").html(cart);
		const myModalEL = document.querySelector("#cart-modal");
		const modal = bootstrap.Modal.getOrCreateInstance(myModalEL);
		modal.show();
		if($(".cart-qty").text()){
			$(".count-items").text($(".cart-qty").text());
		}else{
			$(".count-items").text(0);
		}
	}

	$("#cart-modal .modal-cart-content").on('click', '.del-item', function(e){
		e.preventDefault();
		const id = $(this).data('id');
		$.ajax({
			url: "cart/delete",
			type: "GET",
			data:{id:id},
			success: function(res){
				$(".add-to-cart #product-"+id).removeClass('fas fa-shopping-bag').addClass('fas fa-shopping-cart');
				let url = window.location.href
 				if(url.includes('cart/view')){
					window.location = url;
				}else{
					showCart(res)
				}
				
			},
			error: function(){
				alert("Error");
			}
		});
	});
	$("#cart-modal .modal-cart-content").on('click', '#clear-cart', function(e){
		e.preventDefault();
		$.ajax({
			url: "cart/clear",
			type: "GET",
			success: function(res){
				$(".add-to-cart i").removeClass("fas fa-shopping-bag").addClass("fas fa-shopping-cart");
				showCart(res);
			},error: function(){
				alert("Error");
			}
		});
	});
	$("#get-cart").on('click', function(e){
		e.preventDefault();
		
		$.ajax({
			url:"cart/show",
			type:"GET",
			success: function(res){
				showCart(res);
			},
			error: function(){
				alert("Error");
			}
		})
	})


	$('.add-to-cart').on('click', function(e){
		e.preventDefault();
		const id = $(this).data('id');
		const qty = $('#input-quantity').val() ?  $('#input-quantity').val() : 1;
		const $this = $(this);
		
		$.ajax({
			url:"cart/add",
			type:"GET",
			data:{id:id, qty:qty},
			success:function(res){
				$this.find("i").removeClass('fa-shopping-cart').addClass('fa-shopping-bag');
				showCart(res);
			},
			error:function(){
				alert('Error');
			}
		})
	});
	// CART

	//FEATURE
	$(".product-card").on('click', '.add-to-wishlist', function(e){
		e.preventDefault();
		const id = $(this).data('id');
		const $this = $(this);

		$.ajax({
			url: "wishlist/add",
			type: "GET",
			data: {id:id},
			success: function(res){
				res = JSON.parse(res);
				if(res.result == 'success'){
					$this.removeClass("add-to-wishlist").addClass('delete-from-wishlist');
					$this.children().removeClass("far fa-heart").addClass("fas fa-heart");
					Swal.fire(
						res.text,
						'',
						res.result
					)
				}
			},
			error: function(){
				alert("ERROR");
			}
		})
	})

	$(".product-card").on('click', '.delete-from-wishlist', function(e){
		e.preventDefault();
		const id = $(this).data('id');
		const $this = $(this);

		$.ajax({
			url: "wishlist/delete",
			type: "GET",
			data: {id:id},
			success: function(res){
				res = JSON.parse(res);
				const url = window.location.href
				if(url.includes('wishlist')){
					if(res.result == 'success'){
						$this.removeClass("delete-from-wishlist").addClass('add-to-wishlist');
						$this.children().removeClass("fas fa-heart").addClass("far fa-heart");
					}
					window.location = url;
				}else{
					if(res.result == 'success'){
						$this.removeClass("delete-from-wishlist").addClass('add-to-wishlist');
						$this.children().removeClass("fas fa-heart").addClass("far fa-heart");
					}
				}

			},
			error: function(){
				alert("ERROR");
			}
		})
	})
	
	//FEATURE
});