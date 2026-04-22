<?php
/**
 * Add more WooCommerce products for Anjaney's Biryani House.
 * Safe to run once. It skips products that already exist.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'abh_seed_more_biryani_menu_items', 25 );

function abh_seed_more_biryani_menu_items() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	// Run only once.
	if ( get_option( 'abh_more_biryani_menu_seeded' ) ) {
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

	foreach ( $categories as $category_name ) {
		$term = term_exists( $category_name, 'product_cat' );

		if ( $term && ! is_wp_error( $term ) ) {
			$category_ids[ $category_name ] = is_array( $term ) ? $term['term_id'] : $term;
		}
	}

	$products = array(

		// BIRYANI SPECIALS
		array(
			'name'              => 'Hyderabadi Chicken Biryani',
			'price'             => '15.99',
			'category'          => 'Biryani Specials',
			'short_description' => 'Classic Hyderabadi-style chicken biryani with layered spices and basmati rice.',
			'description'       => 'A fragrant Hyderabadi-style biryani made with marinated chicken, aromatic basmati rice, herbs, and rich traditional spices.',
		),
		array(
			'name'              => 'Boneless Chicken Biryani',
			'price'             => '16.49',
			'category'          => 'Biryani Specials',
			'short_description' => 'Boneless chicken cooked with aromatic rice and bold biryani seasoning.',
			'description'       => 'Perfect for easy eating, this biryani is made with tender boneless chicken, fluffy basmati rice, and signature house masala.',
		),
		array(
			'name'              => 'Special Mixed Biryani',
			'price'             => '19.99',
			'category'          => 'Biryani Specials',
			'short_description' => 'A rich mixed biryani with multiple flavours in one hearty serving.',
			'description'       => 'A generous special biryani prepared for guests who want a fuller experience with rich spices, premium ingredients, and layered flavour.',
		),
		array(
			'name'              => 'Family Chicken Biryani Pack',
			'price'             => '32.99',
			'category'          => 'Biryani Specials',
			'short_description' => 'A larger serving of chicken biryani perfect for sharing.',
			'description'       => 'A family-size portion of chicken biryani prepared for sharing, ideal for small gatherings, family dinners, and weekend meals.',
		),

		// STARTERS
		array(
			'name'              => 'Pepper Chicken',
			'price'             => '11.99',
			'category'          => 'Starters',
			'short_description' => 'Tender chicken tossed in black pepper and bold seasoning.',
			'description'       => 'A flavourful starter made with juicy chicken, onions, black pepper, and a savoury spice mix.',
		),
		array(
			'name'              => 'Paneer Tikka',
			'price'             => '10.49',
			'category'          => 'Starters',
			'short_description' => 'Grilled paneer cubes marinated in aromatic spices.',
			'description'       => 'Soft paneer cubes marinated with spices and grilled until lightly charred for a smoky, satisfying starter.',
		),
		array(
			'name'              => 'Chicken Pakora',
			'price'             => '9.99',
			'category'          => 'Starters',
			'short_description' => 'Crispy chicken fritters with bold seasoning.',
			'description'       => 'A crunchy and flavourful starter made with marinated chicken coated and fried until golden and crisp.',
		),
		array(
			'name'              => 'Gobi 65',
			'price'             => '9.49',
			'category'          => 'Starters',
			'short_description' => 'Crispy cauliflower tossed in spicy South Indian flavours.',
			'description'       => 'A vegetarian twist on a classic favourite with crispy cauliflower, curry leaves, peppers, and bold spice.',
		),

		// VEG SPECIALS
		array(
			'name'              => 'Vegetable Biryani',
			'price'             => '13.49',
			'category'          => 'Veg Specials',
			'short_description' => 'Fresh vegetables and fragrant rice cooked with house masala.',
			'description'       => 'A balanced and aromatic vegetarian biryani with fresh vegetables, herbs, basmati rice, and traditional biryani seasoning.',
		),
		array(
			'name'              => 'Chilli Paneer',
			'price'             => '11.49',
			'category'          => 'Veg Specials',
			'short_description' => 'Paneer tossed with peppers and a spicy savoury sauce.',
			'description'       => 'A popular vegetarian dish with paneer, onions, peppers, and Indo-Chinese style spicy sauce.',
		),
		array(
			'name'              => 'Gobi Manchurian',
			'price'             => '9.99',
			'category'          => 'Veg Specials',
			'short_description' => 'Crispy cauliflower in tangy and spicy sauce.',
			'description'       => 'Golden fried cauliflower tossed in a flavourful sauce with onions and peppers for a satisfying vegetarian favourite.',
		),
		array(
			'name'              => 'Paneer Butter Masala',
			'price'             => '13.99',
			'category'          => 'Veg Specials',
			'short_description' => 'Creamy paneer curry with rich tomato and butter gravy.',
			'description'       => 'Soft paneer cubes served in a rich buttery tomato gravy, perfect for guests who enjoy smooth and comforting flavours.',
		),

		// SIDES
		array(
			'name'              => 'Mirchi Salan',
			'price'             => '3.99',
			'category'          => 'Sides',
			'short_description' => 'Traditional spicy and tangy curry served with biryani.',
			'description'       => 'A classic biryani side with a tangy, spicy, and slightly nutty flavour that complements rice dishes beautifully.',
		),
		array(
			'name'              => 'Plain Yogurt',
			'price'             => '2.99',
			'category'          => 'Sides',
			'short_description' => 'Simple cooling yogurt side.',
			'description'       => 'A plain and refreshing yogurt side that pairs nicely with spicy biryani and starters.',
		),
		array(
			'name'              => 'Extra Basmati Rice',
			'price'             => '4.49',
			'category'          => 'Sides',
			'short_description' => 'A side portion of aromatic basmati rice.',
			'description'       => 'Freshly prepared basmati rice served as an extra side for guests who want to complete their meal.',
		),
		array(
			'name'              => 'Onion Salad',
			'price'             => '2.99',
			'category'          => 'Sides',
			'short_description' => 'Fresh onion salad served as a light side.',
			'description'       => 'A simple fresh salad side with onions and seasoning to add crunch and balance to your meal.',
		),

		// BEVERAGES
		array(
			'name'              => 'Sweet Lassi',
			'price'             => '4.49',
			'category'          => 'Beverages',
			'short_description' => 'Smooth chilled yogurt drink with a sweet finish.',
			'description'       => 'A refreshing traditional sweet lassi served cold and perfect for balancing spicy dishes.',
		),
		array(
			'name'              => 'Salt Lassi',
			'price'             => '4.49',
			'category'          => 'Beverages',
			'short_description' => 'Classic salted yogurt drink served chilled.',
			'description'       => 'A savoury and refreshing yogurt-based drink that pairs especially well with bold biryani flavours.',
		),
		array(
			'name'              => 'Masala Chai',
			'price'             => '2.99',
			'category'          => 'Beverages',
			'short_description' => 'Indian-style tea brewed with warming spices.',
			'description'       => 'A comforting cup of masala chai made with tea, milk, and traditional warming spices.',
		),
		array(
			'name'              => 'Soft Drink Can',
			'price'             => '2.49',
			'category'          => 'Beverages',
			'short_description' => 'A chilled soft drink to enjoy with your order.',
			'description'       => 'A selection of cold soft drinks that pair well with biryani, starters, and combo meals.',
		),

		// DESSERTS
		array(
			'name'              => 'Double Ka Meetha',
			'price'             => '5.99',
			'category'          => 'Desserts',
			'short_description' => 'Traditional bread dessert with rich sweetness.',
			'description'       => 'A classic dessert made with fried bread, milk, nuts, and sweetness for a rich and memorable finish.',
		),
		array(
			'name'              => 'Kheer',
			'price'             => '4.99',
			'category'          => 'Desserts',
			'short_description' => 'Creamy rice pudding with traditional flavour.',
			'description'       => 'A comforting dessert made with rice, milk, and gentle sweetness for a classic ending to the meal.',
		),
		array(
			'name'              => 'Rasmalai',
			'price'             => '5.49',
			'category'          => 'Desserts',
			'short_description' => 'Soft milk dumplings served in sweet creamy milk.',
			'description'       => 'A soft and rich dessert made with delicate milk dumplings soaked in sweetened flavoured milk.',
		),
	);

	foreach ( $products as $product_data ) {
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

	update_option( 'abh_more_biryani_menu_seeded', 1 );
}