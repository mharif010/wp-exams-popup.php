<?php 

if ( !defined( 'ABSPATH' ) ) exit;

// $redirect_course_cat_directory = vibe_get_option('redirect_course_cat_directory');
// if(!empty($redirect_course_cat_directory)){
// 	locate_template( array( 'course/index.php' ), true );	
// 	exit;	
// }


get_header( vibe_get_header() ); ?>

<style>
	.mha-course-grid{
		border: 1px solid #E2E8F0;
		border-radius: 5px;
		margin-bottom: 30px;
	}
	.mha-course-grid img{
		width: 100%;
		height: 209px;
		padding: 5px;
	}
	.mha-title{
		margin: 0;
	}
	.mha-title a{
		font-weight: 700;
		font-size: 16px;
		line-height: 140%;
		text-transform: capitalize;
		color: #2B354E !important;
	}
	.mha-text{
		padding: 10px 20px;
	}
	.mha-buttons{
		background: #F8FAFC;
		border: 1px solid #E2E8F0;
		border-radius: 0px 0px 5px 5px;
		padding: 15px 20px;
		display: flex;
		justify-content: space-between;
	}
	.modal-backdrop{
		z-index: 0 !important;
	}
	.mha-modal .modal-dialog{
		top: 190px;
	}
	.mha-modal .modal-content{
		padding: 20px;
	}
	.mha-modal .modal-dialog{
		width: 970px !important;
	}
	.mha-buttons .quick-btn{
		background: #F1F5F9;
		border: 1px solid #E2E8F0;
		border-radius: 40px;
		padding: 10px 20px;
		color: #2B354E;
	}
	.mha-buttons .cart-btn{
		background: #ED4266;
		border-radius: 40px;
		padding: 10px 20px;
		color: #fff;
	}
	#mha-close{
		background: none;
		color: #2B354E;
		font-size: 30px;
		padding: 0px;
		width: 50px;
		height: 50px;
		float: right;
		position: relative;
		top: -20px;
		right: -20px;
	}
	#mha-modal-title{
		margin-top: 0px;
	}
	#mha-modal-title a{
		font-size: 28px;
		line-height: 140%;
		text-transform: capitalize;
		color: #2B354E;
		margin-top: 0;
	}
	.mha-modal.modal.fade {
		background: rgba(25, 31, 46, 0.5) !important;
		backdrop-filter: blur(5px);
	}
	.mha-modal-cart{
		background: #FFFFFF;
		border: 1px solid #ED4266;
		border-radius: 5px;
		padding: 20px 50px;
		font-weight: 600;
		font-size: 18px;
		line-height: 130%;
		text-transform: capitalize;
		color: #ED4266;
	}
	#mha-modal-addbox{
		margin-top: 15px;
		margin-bottom: 65px;
	}
	#mha-modal-addbox a:hover{
		color: #625FFF !important;
	}
	.mha-modal-buy{
		position: relative;
		background: #ED4266;
		border-radius: 5px;
		height: 64px;
		padding: 20px 135px;
		color: #fff;
		font-size: 18px;
	}
	#mha-modalImg img{
		max-height: 405px;
    	max-width: 100%;
	}
	#mha-contentbody{
		margin-top: -35px;
	}
	#modal-price span{
		font-size: 32px;
		line-height: 120%;
		text-transform: capitalize;
		color: #625FFF;
	}
	#mha-price span{
		font-size: 18px;
		line-height: 120%;
		text-transform: capitalize;
		color: #625FFF;
		font-weight: bold;
	}
	#mha-modal-addtocart{
		display: flex;
	}
	#mha-modal-addtocart .qty-modal-wrapper{
		width: 40%;
	}
	#mha-modal-addtocart .qty-modal-wrapper .qty{
		width: 60px;
		text-align: center;
    	padding-left: 18px;
	}
	#mha-modal-addtocart .qty-modal-wrapper .qty-minus, #mha-modal-addtocart .qty-modal-wrapper .qty-plus{
		border: 1px solid red !important;
		padding: 1px 12px;
		font-size: 17px !important;
		color: #ed4266 !important;
	}
	#mha-modal-addtocart .qty-modal-wrapper .qty-minus:hover, #mha-modal-addtocart .qty-modal-wrapper .qty-plus:hover{
		background: #ed4266 !important;
		color: #fff !important;
	}
	

</style>

<section id="title">
	<?php do_action('wplms_before_title'); ?>
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
             <div class="col-md-12">
                <div class="pagetitle">
                	<?php vibe_breadcrumbs(); ?> 
                   	<h1><?php single_cat_title(); ?></h1>
                    <h5><?php echo do_shortcode(category_description()); ?></h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="content">
	<div id="buddypress">
    <div class="<?php echo vibe_get_container(); ?>">
		<div class="padder">
		<?php do_action( 'bp_before_directory_course' ); ?>	
		<div class="row">
			<div class="col-md-3 col-sm-4">
				<?php
                    $sidebar = apply_filters('wplms_sidebar','coursesidebar');
                    if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar($sidebar) ) : ?>
                <?php endif; ?>
			</div>
			<div class="col-md-9 col-sm-8">
				<div class="content" id="mha-wrapper">
					
				<?php
				$i = 1;
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="mha-col col-md-4">
						<div class="mha-course-grid">
							<?php the_post_thumbnail(); ?>
							<div class="mha-text">
								<h1 class="mha-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								<?php 
								$product_ID = get_post_meta(get_the_ID(), 'vibe_product', true);
								$regular_price = get_post_meta($product_ID, '_regular_price', true);
								$sale_price = get_post_meta( $product_ID, '_sale_price', true);
								$current_currency = get_woocommerce_currency_symbol();

								if( $sale_price !== "" ){
									$m_price = '<del>'.$current_currency.$regular_price.'</del>'.' '.$current_currency.'<span>'.$sale_price.'</span>'.' Ex Vat';
								}elseif( $regular_price !== ""){
									$m_price = $current_currency.'<span>'.$regular_price.'</span>'.' Ex Vat';
								}else{
									$m_price = '';
								}
									
								$img_src = get_the_post_thumbnail_url();
								?>
								<p id="mha-price"><?php echo $m_price; ?> </p>
							</div>
							<div class="mha-buttons">
								
								<a href="" class="quick-btn" onclick="clickModal(<?php echo $i ?>)" data-toggle="modal" id="<?php echo $i ?>" data-target="#exampleModalCenter" data-title="<?php echo get_the_title(); ?>" data-imgel="<?php echo $img_src; ?>" data-price="<?php echo $m_price; ?>" data-prodID="<?php echo $product_ID ?>" data-permalink="<?php echo get_the_permalink(); ?>">Quick Shop</a>

								<a href="<?php home_url(); ?>cart/?add-to-cart=<?php echo $product_ID ?>" class="cart-btn">Add to cart</a>
								
							</div>
						</div>
					</div>


				<?php 
				$i++;
				endwhile;
				pagination();

		
				endif;
				
				?>
				
				<script>



					
					function clickModal(arg){

						const buttonId = document.getElementById(`${arg}`);
						const title = buttonId.getAttribute("data-title");
						const imgsrc = buttonId.getAttribute("data-imgel");
						const price = buttonId.getAttribute("data-price");
						const proId = buttonId.getAttribute("data-prodID");
						const permalink = buttonId.getAttribute("data-permalink");

						const modalTitle = document.getElementById('mha-modal-title');
						const modalImg = document.getElementById('mha-modalImg');
						const modalPrice = document.getElementById('modal-price');
						const modalProID = document.getElementById('mha-modal-addbox');
						const modalBuy = document.getElementById('mha-modal-buy');
						
						
						modalTitle.innerHTML = `<a href="${permalink}">${title}</a>`;
						modalImg.innerHTML = `<img src="${imgsrc}"/>`;
						modalPrice.innerHTML = price;
						modalProID.innerHTML = `<a href="<?php echo home_url(); ?>/cart/?add-to-cart=${proId}" class="mha-modal-cart">Add to Cart</a>`;
						modalBuy.innerHTML = `<a href="<?php echo home_url(); ?>/checkout/?add-to-cart=${proId}" class="mha-modal-buy">Buy It Now</a>`;

					}

					// add to cart quantity plus minus
					jQuery(document).on('click', '.qty-plus', function () {
						jQuery(this).prev().val(+jQuery(this).prev().val() + 1);
						var qtyVal = jQuery(this).prev().val();
						var getUrl = jQuery("#mha-modal-addbox a").attr('href');
						var getUrl2 = jQuery("#mha-modal-buy a").attr('href');
						var url = new URL(getUrl);
						var url2 = new URL(getUrl2);
						var search_params = url.searchParams;
						var search_params2 = url2.searchParams;
						search_params.set('quantity', qtyVal);
						search_params2.set('quantity', qtyVal);
						url.search = search_params.toString();
						url2.search = search_params2.toString();
						var new_url = url.toString();
						var new_url2 = url2.toString();
						getUrl = jQuery("#mha-modal-addbox a").attr('href', new_url);
						getUrl2 = jQuery("#mha-modal-buy a").attr('href', new_url2);
					});
					jQuery(document).on('click', '.qty-minus', function () {
						if (jQuery(this).next().val() > 0) jQuery(this).next().val(+jQuery(this).next().val() - 1);
						var qtyVal = jQuery(this).next().val();
						var getUrl = jQuery("#mha-modal-addbox a").attr('href');
						var getUrl2 = jQuery("#mha-modal-buy a").attr('href');
						var url = new URL(getUrl);
						var url2 = new URL(getUrl2);
						var search_params = url.searchParams;
						var search_params2 = url2.searchParams;
						search_params.set('quantity', qtyVal);
						search_params2.set('quantity', qtyVal);
						url.search = search_params.toString();
						url2.search = search_params2.toString();
						var new_url = url.toString();
						var new_url2 = url2.toString();
						getUrl = jQuery("#mha-modal-addbox a").attr('href', new_url);
						getUrl2 = jQuery("#mha-modal-buy a").attr('href', new_url2);
					});


					
				</script>
				<div class="modal fade mha-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						<button type="button" class="btn btn-dark" id="mha-close" data-dismiss="modal">&times;</button>
							<div class="row">
								<div class="col-md-7">
									<div id="mha-modalImg"></div>
								</div>
								<div class="col-md-5 p-0" id="mha-contentbody">
									<h2 id="mha-modal-title"></h2>
									<p>By One Education</p>
									
									<div id="modal-price">
									</div>
									<div id="mha-modal-addtocart">
										<div class="qty-modal-wrapper">
											<input type="button" value="-" class="qty-minus">
											<input type="number" value="1" class="qty" min="1" readonly="">
											<input type="button" value="+" class="qty-plus">
											<!-- <a href="https://www.oneeducation.org.uk/cart/?add-to-cart=213640" class="cart-btn">Add To Cart</a> -->
										</div>
										<div id="mha-modal-addbox">
										</div>
									</div>
									<div id="mha-modal-buy"></div>
								</div>
							</div>
						</div>
					</div>
				</div>



				</div>
			</div>	
			
		</div>	
		<?php do_action( 'bp_after_directory_course' ); ?>

		</div><!-- .padder -->
	
	<?php do_action( 'bp_after_directory_course_page' ); ?>
</div><!-- #content -->
</div>
</section>

<?php 

get_footer( vibe_get_footer() );  
