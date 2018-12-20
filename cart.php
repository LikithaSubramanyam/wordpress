<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_cart' ); ?>




<h1>nishanth</h1>

<form class="woocommerce-cart-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<table style="width:150%" class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
		
			<tr>
		
				<th class="product-remove">&nbsp;</th>
				<th class="product-packagetype"><?php esc_html_e( 'Package Type', 'woocommerce' ); ?></th>
				<th  ><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                <th class="product-length"><?php esc_html_e( 'Length(cm)', 'woocommerce' ); ?></th>
                <th class="product-width"><?php esc_html_e( 'Width(cm)', 'woocommerce' ); ?></th>
                <th class="product-height"><?php esc_html_e( 'Height(cm)', 'woocommerce' ); ?></th>
				<th class="product-tvw"><?php esc_html_e( 'Total Volumetirc Weigth(kg)', 'woocommerce' ); ?></th>
				<th class="product-weigth"><?php esc_html_e( 'Weigth(Per Piece)(Kg)', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php 
			$item_crat_cnt= 0;
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					
                    
				
						<td class="product-remove">
							<?php
								// @codingStandardsIgnoreLine
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
						</td>
                    
						<td  data-title="<?php esc_attr_e( 'Package Type', 'woocommerce' ); ?>">

						<select 
						   id="<?php echo esc_attr( uniqid( 'item_packagetype_' )); ?>"
							class="input-text item_packagetype text"
							required
							
							name="cart_<?php echo esc_attr( $cart_item_key ); ?>_item_packagetype"
							required 
							title="<?php echo esc_attr_x( 'item_packagetype', 'Product packagetype input tooltip', 'woocommerce' ); ?>">
						<option  value="">Select a Package Type</option>
                        <option value="bags" <?php if(esc_attr($cart_item['item_packagetype'])==='bags') {echo esc_attr('selected');} ?>  >Bags</option>
  						<option value="bales" <?php if(esc_attr($cart_item['item_packagetype'])==='bales') {echo esc_attr('selected');} ?> >Bales</option>
  						<option value="boxes" <?php if(esc_attr($cart_item['item_packagetype'])==='boxes') {echo esc_attr('selected');} ?> >Boxes</option>
  						<option value="pallet" <?php if(esc_attr($cart_item['item_packagetype'])==='pallet') {echo esc_attr('selected');} ?> >Pallets</option>	
						</select>
						</td>
						
						
						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => $cart_item['quantity'],
								'max_value'    => $_product->get_max_purchase_quantity(),
								'min_value'    => '0',
								'product_name' => $_product->get_name(),
							), $_product, false );
						}
						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
						</td>
						<td class="product-length" data-title="<?php esc_attr_e( 'Length', 'woocommerce' ); ?>">
						<input
							type="number"
							class="txt"
							id="num1<?php echo esc_attr($item_crat_cnt);?>" 
							id="<?php echo esc_attr( uniqid( 'item_length_' )); ?>"
							class="calc_input input-text item_length text"
							min="1" 
                            max="" 
							min="<?php echo esc_attr( $min_value ); ?>"
							max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
							name="cart_<?php echo esc_attr( $cart_item_key ); ?>_item_length" 
							value="<?php echo esc_attr($cart_item['item_length'] ); ?>"
							required
							title="<?php echo esc_attr_x( 'item_length', 'Product quantity input tooltip', 'woocommerce' ); ?>"
							style="width:50%"
							pattern="[0-9]*"
							pattern="<?php echo esc_attr( $pattern ); ?>"
							inputmode="<?php echo esc_attr( 'numeric' ); ?>"
							onfocusout="myfunction(<?php echo esc_attr($item_crat_cnt);?>)"
						
							/>
					
			
						</td>
						<td>
						<input
							type="number"
							id="num2<?php echo esc_attr($item_crat_cnt);?>"
							id="<?php echo esc_attr( uniqid( 'item_width_' )); ?>"
							class="calc_input input-text item_width text"
							min="1" 
                            max="" 
							min="<?php echo esc_attr( $min_value ); ?>"
							max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
							name="cart_<?php echo esc_attr( $cart_item_key ); ?>_item_width" 
							value="<?php echo esc_attr($cart_item['item_width'] ); ?>"
							title="<?php echo esc_attr_x( 'item_width', 'Product quantity input tooltip', 'woocommerce' ); ?>"
							style="width:50%"
							required
							pattern="[0-9]*"
							pattern="<?php echo esc_attr( $pattern ); ?>"
							inputmode="<?php echo esc_attr( 'numeric' ); ?>"
							onfocusout="myfunction(<?php echo esc_attr($item_crat_cnt);?>)"
							/>
							
						</td>
						<td  >
						<input
							type="number"
							id="num3<?php echo esc_attr($item_crat_cnt);?>"
							id="<?php echo esc_attr( uniqid( 'item_height_' )); ?>"
							class="calc_input input-text item_height text"
							min="1" 
                            max="" 
							min="<?php echo esc_attr( $min_value ); ?>"
							max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
							name="cart_<?php echo esc_attr( $cart_item_key ); ?>_item_height" 
							value="<?php echo esc_attr($cart_item['item_height'] ); ?>"
							title="<?php echo esc_attr_x( 'item_height', 'Product height input tooltip', 'woocommerce' ); ?>"
							style="width:50%"
							required
							pattern="[0-9]*"
							pattern="<?php echo esc_attr( $pattern ); ?>"
							inputmode="<?php echo esc_attr( 'numeric' ); ?>"
							onfocusout="myfunction(<?php echo esc_attr($item_crat_cnt);?>)"
							/>
						
						</td>

						<td  >
						<input
							type="number"
							id="sum<?php echo esc_attr($item_crat_cnt);?>"
							id="<?php echo esc_attr( uniqid( 'item_vol_weigth_' )); ?>"
							min="1" 
                            max="" 
							class="vol_weight input-text item_vol_weigth text"
							min="<?php echo esc_attr( $min_value ); ?>"
							max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
							name="cart_<?php echo esc_attr( $cart_item_key ); ?>_item_vol_weigth" 
							value="<?php echo esc_attr($cart_item['item_vol_weigth'] ); ?>"
							title="<?php echo esc_attr_x( 'item_vol_weigth', 'Product total volumetric weigth input tooltip', 'woocommerce' ); ?>"
							style="width:50%"
							required
							pattern="[0-9]*"
							pattern="<?php echo esc_attr( $pattern ); ?>"
							inputmode="<?php echo esc_attr( 'numeric' ); ?>"
							
							/>
						
						</td>
                        <td  >
						<input
							type="number"
							id="<?php echo esc_attr( uniqid( 'item_weigth_' )); ?>"
							class="input-text item_weigth text"
							min="1" 
                            max="" 
							required
							name="cart_<?php echo esc_attr( $cart_item_key ); ?>_item_weigth" 
							value="<?php echo esc_attr($cart_item['item_weigth'] ); ?>"
							title="<?php echo esc_attr_x( 'item_weigth', 'Product weigth input tooltip', 'woocommerce' ); ?>"
							style="width:50%"
							pattern="[0-9]*"
							pattern="<?php echo esc_attr( $pattern ); ?>"
							
							/>
						
						</td>

						<td  >
						
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'],  $cart_item['item_weigth']), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
					</tr>
					<?php
				}
				$item_crat_cnt = $item_crat_cnt + 1;
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
				
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>