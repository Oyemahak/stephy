<?php
/**
 * Seed a smaller starter menu for Anjaney's Biryani House in WooCommerce.
 * Run once, then disable the snippet.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'abh_seed_small_biryani_menu', 25 );

function abh_seed_small_biryani_menu() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// Prevent running more than once.
	if ( get_option( 'abh_small_biryani_menu_seeded' ) ) {
		return;
	}

	$categories = array(
		'Biryani Specials',
		'Starters',
		'Veg Specials',
		'Sides',
		'Beverages',
		'Desserts',
	);

	$category_ids = array();

	// Create categories if they do not exist.
	foreach ( $categories as $category_name ) {
		$term = term_exists( $category_name, 'product_cat' );

		if ( ! $term ) {
			$term = wp_insert_term(
				$category_name,
				'product_cat',
				array(
					'slug' => sanitize_title( $category_name ),
				)
			);
		}

		if ( ! is_wp_error( $term ) ) {
			$category_ids[ $category_name ] = is_array( $term ) ? $term['term_id'] : $term;
		}
	}

	$products = array(
		array(
			'name'              => 'Chicken Biryani',
			'price'             => '14.99',
			'category'          => 'Biryani Specials',
			'short_description' => 'Tender chicken layered with aromatic basmati rice and signature house spices.',
			'description'       => 'Tender chicken layered with aromatic basmati rice, herbs, and signature house spices for a rich and satisfying biryani experience.',
		),
		array(
			'name'              => 'Beef Biryani',
			'price'             => '16.99',
			'category'          => 'Biryani Specials',
			'short_description' => 'Rich beef biryani cooked slowly with fragrant rice and traditional spices.',
			'description'       => 'A flavourful beef biryani prepared with long-grain basmati rice, traditional biryani masala, and slow-cooked beef for deep, comforting taste.',
		),
		array(
			'name'              => 'Mutton Biryani',
			'price'             => '17.99',
			'category'          => 'Biryani Specials',
			'short_description' => 'Tender mutton layered with bold spices and fragrant rice.',
			'description'       => 'A premium biryani made with tender mutton, aromatic rice, and carefully balanced spices for a traditional biryani experience.',
		),
		array(
			'name'              => 'Egg Biryani',
			'price'             => '12.99',
			'category'          => 'Biryani Specials',
			'short_description' => 'Comforting biryani layered with boiled eggs and savoury masala.',
			'description'       => 'A delicious and budget-friendly biryani with boiled eggs, fluffy seasoned basmati rice, and house-made biryani masala.',
		),
		array(
			'name'              => 'Chicken 65',
			'price'             => '10.99',
			'category'          => 'Starters',
			'short_description' => 'Crispy fried chicken tossed in spicy South Indian flavours.',
			'description'       => 'Crispy chicken bites tossed with curry leaves, peppers, and bold South Indian spices. A perfect starter to begin your meal.',
		),
		array(
			'name'              => 'Veg Samosa',
			'price'             => '5.99',
			'category'          => 'Starters',
			'short_description' => 'Crisp pastry filled with seasoned potatoes and peas.',
			'description'       => 'Golden and crispy samosas filled with lightly spiced potatoes and peas. Served hot and perfect as a classic starter.',
		),
		array(
			'name'              => 'Paneer Biryani',
			'price'             => '14.49',
			'category'          => 'Veg Specials',
			'short_description' => 'Soft paneer and fragrant rice layered with warming spices.',
			'description'       => 'A rich vegetarian biryani made with paneer, aromatic basmati rice, herbs, and house seasoning for a satisfying flavour-packed meal.',
		),
		array(
			'name'              => 'Raita',
			'price'             => '3.49',
			'category'          => 'Sides',
			'short_description' => 'Creamy yogurt side with herbs and spices.',
			'description'       => 'A cooling yogurt side that pairs perfectly with spicy biryani and starter dishes.',
		),
		array(
			'name'              => 'Mango Lassi',
			'price'             => '4.99',
			'category'          => 'Beverages',
			'short_description' => 'Refreshing chilled mango yogurt drink.',
			'description'       => 'A smooth, sweet, and refreshing mango lassi that complements spicy dishes and completes the meal beautifully.',
		),
		array(
			'name'              => 'Gulab Jamun',
			'price'             => '4.99',
			'category'          => 'Desserts',
			'short_description' => 'Soft milk-solid dumplings soaked in sweet syrup.',
			'description'       => 'A traditional dessert made with soft gulab jamun soaked in fragrant sugar syrup, served as a sweet ending to your meal.',
		),
	);

	foreach ( $products as $product_data ) {
		// Skip if product already exists by title.
		$existing_product = get_page_by_title( $product_data['name'], OBJECT, 'product' );
		if ( $existing_product ) {
			continue;
		}

		$product = new WC_Product_Simple();
		$product->set_name( $product_data['name'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_description( $product_data['description'] );
		$product->set_short_description( $product_data['short_description'] );
		$product->set_regular_price( $product_data['price'] );
		$product->set_price( $product_data['price'] );
		$product->set_manage_stock( false );
		$product->set_stock_status( 'instock' );
		$product->set_sold_individually( false );

		if ( ! empty( $category_ids[ $product_data['category'] ] ) ) {
			$product->set_category_ids( array( $category_ids[ $product_data['category'] ] ) );
		}

		$product->save();
	}

	update_option( 'abh_small_biryani_menu_seeded', 1 );
}