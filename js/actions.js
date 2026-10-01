$(document).ready(function(){
	cat();
    cathome();
	brand();
	product();
    
    producthome();
    
    
	//cat() is a funtion fetching category record from database whenever page is load
	function cat(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{category:1},
			success	:	function(data){
				$("#get_category").html(data);
				
			}
		})
	}
    function cathome(){
		$.ajax({
			url	:	"homeaction.php",
			method:	"POST",
			data	:	{categoryhome:1},
			success	:	function(data){
				$("#get_category_home").html(data);
				
			}
		})
	}
	//brand() is a funtion fetching brand record from database whenever page is load
	function brand(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{brand:1},
			success	:	function(data){
				$("#get_brand").html(data);
			}
		})
	}
	//product() is a funtion fetching product record from database whenever page is load
		function product(){
		$.ajax({
			url	:	"action.php",
			method:	"POST",
			data	:	{getProduct:1},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	}
    gethomeproduts();
    function gethomeproduts(){
		$.ajax({
			url	:	"homeaction.php",
			method:	"POST",
			data	:	{gethomeProduct:1},
			success	:	function(data){
				$("#get_home_product").html(data);
			}
		})
	}
    function producthome(){
		$.ajax({
			url	:	"homeaction.php",
			method:	"POST",
			data	:	{getProducthome:1},
			success	:	function(data){
				$("#get_product_home").html(data);
				if(window.reObserveFadeIn) window.reObserveFadeIn();
			}
		})
	}
   
    
	/*	when page is load successfully then there is a list of categories when user click on category we will get category id and 
		according to id we will show products
	*/
	$("body").delegate(".category","click",function(event){
		$("#get_product").html("<h3>Loading...</h3>");
		event.preventDefault();
		var cid = $(this).attr('cid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{get_seleted_Category:1,cat_id:cid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})
    $("body").delegate(".categoryhome","click",function(event){
		event.preventDefault();
		var cid = $(this).attr('cid');
		var cname = $(this).text().trim();
		if (cid == 0) {
			if (typeof showStackedView === 'function') showStackedView();
		} else {
			if (typeof loadCategoryStack === 'function') loadCategoryStack(cid, cname);
		}
	});

	/*	when page is load successfully then there is a list of brands when user click on brand we will get brand id and 
		according to brand id we will show products
	*/
	$("body").delegate(".selectBrand","click",function(event){
		event.preventDefault();
		$("#get_product").html("<h3>Loading...</h3>");
		var bid = $(this).attr('bid');
		
			$.ajax({
			url		:	"action.php",
			method	:	"POST",
			data	:	{selectBrand:1,brand_id:bid},
			success	:	function(data){
				$("#get_product").html(data);
				if($("body").width() < 480){
					$("body").scrollTop(683);
				}
			}
		})
	
	})

	/*
		SEARCH — Global doSearch() function
		Dipanggil dari form onsubmit (header.php) maupun klik tombol Cari.
		Mendeteksi apakah pengguna ada di halaman utama (#product-grid-view) atau halaman shop (#get_product).
		Mendukung filter kategori dari dropdown #search-category.
		Jika keyword KOSONG: reset tampilan ke kondisi semula (sebelum pencarian).
	*/
	window.doSearch = function() {
		var keyword = $("#search").val().trim();
		var cat_id  = $("#search-category").val() || "0";

		// Deteksi halaman utama (ada elemen #product-grid-view)
		var isHomePage = $("#product-grid-view").length > 0;

		// ====== KEYWORD KOSONG → RESET KE TAMPILAN SEMULA ======
		if (keyword === "") {
			if (isHomePage) {
				// Kembalikan stacked category view
				$("#product-grid-view").hide();
				$("#stacked-view").show();
				// Reload produk default di grid (untuk saat grid aktif nanti)
				$.ajax({
					url    : "homeaction.php",
					method : "POST",
					data   : { getProducthome: 1 },
					success: function(data) {
						$("#get_product_home").html(data);
						if (window.reObserveFadeIn) window.reObserveFadeIn();
					}
				});
			} else {
				// Reset ke semua produk
				$.ajax({
					url    : "action.php",
					method : "POST",
					data   : { getProduct: 1 },
					success: function(data) {
						$("#get_product").html(data);
					}
				});
			}
			return;
		}

		// ====== ADA KEYWORD → LAKUKAN PENCARIAN ======
		if (isHomePage) {
			// --- HALAMAN UTAMA ---
			// Scroll ke section produk
			var $section = $("#new-arrivals");
			if ($section.length) {
				$("html, body").animate({ scrollTop: $section.offset().top - 80 }, 400);
			}

			// Tampilkan grid view & sembunyikan stacked view
			$("#stacked-view").hide();
			$("#product-grid-view").show();

			// Set judul hasil pencarian
			var catLabel = $("#search-category option:selected").text();
			var titleText = 'Hasil: "' + keyword + '"' + (cat_id !== "0" ? " — " + catLabel : "");
			$("#grid-cat-title").text(titleText);

			// Tampilkan loading state
			$("#get_product_home").html(
				'<div style="grid-column:1/-1; text-align:center; padding:40px; color:#86868b;">' +
				'<i class="fa fa-spinner fa-spin" style="font-size:28px;"></i>' +
				'<p style="margin-top:12px; font-size:14px;">Mencari produk...</p>' +
				'</div>'
			);

			$.ajax({
				url    : "homeaction.php",
				method : "POST",
				data   : { searchHome: 1, keyword: keyword, cat_id: cat_id },
				success: function(data) {
					$("#get_product_home").html(data);
					if (window.reObserveFadeIn) window.reObserveFadeIn();
				}
			});

		} else {
			// --- HALAMAN SHOP / LAINNYA (ada #get_product) ---
			$("#get_product").html("<h3>Loading...</h3>");

			var postData = { search: 1, keyword: keyword };
			if (cat_id !== "0") {
				postData.cat_id = cat_id;
			}

			$.ajax({
				url    : "action.php",
				method : "POST",
				data   : postData,
				success: function(data) {
					$("#get_product").html(data);
					if ($(window).width() < 480) {
						$("body").scrollTop(683);
					}
				}
			});
		}
	};

	// Dukung klik tombol Cari (juga sebagai backup selain onsubmit form)
	$("#search_btn").off("click").on("click", function(e) {
		e.preventDefault();
		window.doSearch();
	});
	//end search


	/*
		Here #login is login form id and this form is available in index.php page
		from here input data is sent to login.php page
		if you get login_success string from login.php page means user is logged in successfully and window.location is 
		used to redirect user from home page to profile.php page
	*/
	$("#login").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url	:	"login.php",
			method:	"POST",
			data	:$("#login").serialize(),
			success	:function(data){
				if(data == "login_success"){
					// Reload halaman agar session ter-refresh
					window.location.href = "index.php";
				}else if(data == "cart_login"){
					// Login berhasil, ada produk pending di keranjang
					$('#Modal_login').modal('hide');
					$(".overlay").hide();
					// Jika ada produk pending, tambahkan sekarang
					if(window._pendingCartPid) {
						var pid = window._pendingCartPid;
						window._pendingCartPid = null;
						addProductToCart(pid);
					} else {
						window.location.href = "index.php";
					}
				}else{
					$("#e_msg").html(data);
					$(".overlay").hide();
				}
			}
		})
	})
	//end

	//Get User Information before checkout
	$("#signup_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "register.php",
			method : "POST",
			data : $("#signup_form").serialize(),
			success : function(data){
				$(".overlay").hide();
				if (data == "register_success") {
					window.location.href = "cart.php";
				}else{
					$("#signup_msg").html(data);
				}
				
			}
		})
	})
	
	
    $("#offer_form").on("submit",function(event){
		event.preventDefault();
		$(".overlay").show();
		$.ajax({
			url : "offersmail.php",
			method : "POST",
			data : $("#offer_form").serialize(),
			success : function(data){
				$(".overlay").hide();
				$("#offer_msg").html(data);
				
			}
		})
	})
    
    
    
	//Get User Information before checkout end here

	//Add Product into Cart
	// Fungsi inti: kirim produk ke keranjang via AJAX
	window.addProductToCart = function(pid) {
		$(".overlay").show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {addToCart:1, proId:pid},
			success : function(data){
				count_item();
				getCartItem();
				$('.overlay').hide();
				// Tampilkan notifikasi dengan SweetAlert
				if (data.indexOf('alert-success') !== -1) {
					swal("Berhasil!", "Produk berhasil ditambahkan ke keranjang!", "success");
				} else if (data.indexOf('alert-info') !== -1) {
					swal("Info", "Jumlah produk diperbarui di keranjang!", "info");
				} else if (data.indexOf('alert-warning') !== -1) {
					// Belum login — buka modal login
					window._pendingCartPid = pid;
					$('#Modal_login').modal('show');
				} else {
					$('#product_msg').html(data);
				}
			}
		})
	};

	// Handler klik tombol Tambah ke Keranjang (gunakan class, bukan id)
	$("body").on("click", ".add-to-cart-btn", function(event){
		event.preventDefault();
		var pid = $(this).attr("pid");
		if (!pid) return;

		// Cek status login dari PHP (di-embed via variabel global)
		if (typeof window.IS_LOGGED_IN !== 'undefined' && !window.IS_LOGGED_IN) {
			// Simpan pid yang pending lalu buka modal login
			window._pendingCartPid = pid;
			$('#Modal_login').modal('show');
			return;
		}

		addProductToCart(pid);
	})

	// Tampilkan pesan info di modal login jika dibuka dari konteks keranjang
	$('#Modal_login').on('show.bs.modal', function() {
		if (window._pendingCartPid) {
			var $info = $('#e_msg');
			$info.html(
				'<div class="alert alert-info" style="margin-bottom:12px;">' +
				'<i class="fa fa-shopping-cart"></i> ' +
				'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.' +
				'</div>'
			);
		} else {
			$('#e_msg').html('');
		}
	});
	$('#Modal_login').on('hidden.bs.modal', function() {
		// Bersihkan pending cart jika modal ditutup tanpa login
		if (window._pendingCartPid && !window.IS_LOGGED_IN) {
			window._pendingCartPid = null;
			$('#e_msg').html('');
		}
	});
	//Add Product into Cart End Here
	//Count user cart items funtion
	count_item();
	function count_item(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {count_item:1},
			success : function(data){
				$(".badge").html(data);
			}
		})
	}
	//Count user cart items funtion end

	//Fetch Cart item from Database to dropdown menu
	getCartItem();
	function getCartItem(){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,getCartItem:1},
			success : function(data){
				$("#cart_product").html(data);
                net_total();
                
			}
		})
	}

	//Fetch Cart item from Database to dropdown menu

	/*
		Whenever user change qty we will immediate update their total amount by using keyup funtion
		but whenever user put something(such as ?''"",.()''etc) other than number then we will make qty=1
		if user put qty 0 or less than 0 then we will again make it 1 qty=1
		('.total').each() this is loop funtion repeat for class .total and in every repetation we will perform sum operation of class .total value 
		and then show the result into class .net_total
	*/
	$("body").delegate(".qty","keyup",function(event){
		event.preventDefault();
		var row = $(this).parent().parent();
		var price = row.find('.price').val();
		var qty = row.find('.qty').val();
		if (isNaN(qty)) {
			qty = 1;
		};
		if (qty < 1) {
			qty = 1;
		};
		var total = price * qty;
		row.find('.total').val(total);
		var net_total=0;
		$('.total').each(function(){
			net_total += ($(this).val()-0);
		})
		$('.net_total').text('Rp ' + net_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));


	})
	//Change Quantity end here 

	/*
		whenever user click on .remove class we will take product id of that row 
		and send it to action.php to perform product removal operation
	*/
    	   
    $("body").delegate(".remove","click",function(event){
        var remove = $(this).parent().parent().parent();
        var remove_id = remove.find(".remove").attr("remove_id");
        $.ajax({
            url	:	"action.php",
            method	:	"POST",
            data	:	{removeItemFromCart:1,rid:remove_id},
            success	:	function(data){
                $("#cart_msg").html(data);
                checkOutDetails();
                }
            })
    })
    
    
	/*
		whenever user click on .update class we will take product id of that row 
		and send it to action.php to perform product qty updation operation
	*/
	$("body").delegate(".update","click",function(event){
		var update = $(this).parent().parent().parent();
		var update_id = update.find(".update").attr("update_id");
		var qty = update.find(".qty").val();
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{updateCartItem:1,update_id:update_id,qty:qty},
			success	:	function(data){
				$("#cart_msg").html(data);
				checkOutDetails();
			}
		})


	})
	checkOutDetails();
	net_total();
	/*
		checkOutDetails() function work for two purposes
		First it will enable php isset($_POST["Common"]) in action.php page and inside that
		there is two isset funtion which is isset($_POST["getCartItem"]) and another one is isset($_POST["checkOutDetials"])
		getCartItem is used to show the cart item into dropdown menu 
		checkOutDetails is used to show cart item into Cart.php page
	*/
	function checkOutDetails(){
	 $('.overlay').show();
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {Common:1,checkOutDetails:1},
			success : function(data){
				$('.overlay').hide();
				$("#cart_checkout").html(data);
					net_total();
			}
		})
	}
	// Helper: format angka ke Rupiah (misal 1000000 → Rp 1.000.000)
	function formatRupiah(angka) {
		var num = Math.round(parseFloat(angka) || 0);
		return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
	}

	function net_total(){
		var total_sum = 0;
		$('.qty').each(function(){
			var row   = $(this).closest('tr');
			var price = parseFloat(row.find('.price').val()) || 0;
			var qty   = parseInt($(this).val()) || 1;
			var sub   = price * qty;
			row.find('.total').val(sub);
			row.find('.row-total').text(sub.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
		});
		$('.total').each(function(){
			total_sum += (parseFloat($(this).val()) || 0);
		});
		var formatted = formatRupiah(total_sum);
		$('.net_total').text(formatted);
	}

	//remove product from cart

	page();
	function page(){
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{page:1},
			success	:	function(data){
				$("#pageno").html(data);
			}
		})
	}
	$("body").delegate("#page","click",function(){
		var pn = $(this).attr("page");
		$.ajax({
			url	:	"action.php",
			method	:	"POST",
			data	:	{getProduct:1,setPage:1,pageNumber:pn},
			success	:	function(data){
				$("#get_product").html(data);
			}
		})
	})
})
