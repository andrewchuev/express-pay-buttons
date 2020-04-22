<?php

class Epb_Public {

	private $epb;
	private $version;
	public $paypal_client_id = 'AX8KbUiUkQr2-ec7asAdtOXkVveDRpbGJqTpzGXHtTKT7oVMKCKMeNUN0y83JlVu8z8VOTcPq0-YqH1d';

	public function __construct( $epb, $version ) {
		$this->epb     = $epb;
		$this->version = $version;
	}




	public function enqueue_styles() {
		wp_enqueue_style( $this->epb, plugin_dir_url( __FILE__ ) . 'css/epb-public.css', array(), time(), 'all' );
	}


	public function enqueue_scripts() {
		wp_enqueue_script( $this->epb, plugin_dir_url( __FILE__ ) . 'js/epb-public.js', array( 'jquery' ), time(), false );
		//wp_enqueue_script( 'paypal-js', "https://www.paypal.com/sdk/js?client-id=$this->paypal_client_id&currency=USD&locale=en_US&disable-funding=credit,card" );

	}

	public function beforeAddToCartForm() {
		global $product;
		$product_id = $product->get_id();
		?>
            <input type="hidden" id="epb-product-id" value="<?= $product_id ?>">
		<?php
		$this->epbPaypalButton();
		//stripe_pay_form();


	}


	public function epbPaypalButton() {
		?>
        <h1>paypal</h1>

        <div id="paypal-button-container"></div>

		<?php

	}

	public function modifyHeader() {
		?>
        <input type="hidden" id="ajaxurl" value="<?= admin_url( 'admin-ajax.php' ) ?>"/>
        <script src="https://www.paypal.com/sdk/js?client-id=<?= $this->paypal_client_id ?>&currency=USD&locale=en_US&disable-funding=credit,card"></script>
		<?php
	}

	function stripe_pay_form() {
		?>

        <script src="https://js.stripe.com/v3/"></script>
        <img src="<?= plugins_url( '/img/stripe-button.png', __FILE__ ); ?>" id="stripe-button">
        <div id="stripe-form">
            <form action="https://sooo.academweb.tech/wp-content/plugins/express-pay-buttons/charge.php" method="POST">
                <input type="hidden" name="token"/>
                <input type="hidden" name="product_id" value="43111">

                <div class="group">
                    <label>
                        <span>Card</span>
                        <div id="card-element" class="field"></div>
                    </label>
                </div>
                <div class="group">
                    <label>
                        <span>Name</span>
                        <input id="name" name="name" class="field" placeholder="Jane Doe" value="Jane Doe"/>
                    </label>
                    <label>
                        <span>Email</span>
                        <input id="email" name="email" class="field" placeholder="email@mail.com" value="email@mail.com"/>
                    </label>
                    <label>
                        <span>Phone</span>
                        <input id="phone" name="phone" class="field" placeholder="+1-404-111-1112" value="14041111112"/>
                    </label>
                </div>
                <div class="group">
                    <label>
                        <span>Address</span>
                        <input id="address-line1" name="address_line1" class="field" placeholder="77 Winchester Lane" value="77 Winchester Lane"/>
                    </label>
                    <label>
                        <span>Address (cont.)</span>
                        <input id="address-line2" name="address_line2" class="field" placeholder="" value="address line 2"/>
                    </label>
                    <label>
                        <span>City</span>
                        <input id="address-city" name="address_city" class="field" placeholder="Coachella" value="Coachella"/>
                    </label>
                    <label>
                        <span>State</span>
                        <input id="address-state" name="address_state" class="field" placeholder="CA" value="CA"/>
                    </label>
                    <label>
                        <span>ZIP</span>
                        <input id="address-zip" name="address_zip" class="field" placeholder="92236" value="92236"/>
                    </label>
                    <label>
                        <span>Country</span>
                        <input id="address-country" name="address_country" class="field" placeholder="United States" value="United States"/>
                    </label>
                </div>
                <button type="submit">Pay 1,150.00</button>
                <div class="close-stripe-form">[х]</div>
                <div class="outcome">
                    <div class="error"></div>
                    <div class="success">
                        Success! Your Stripe token is <span class="token"></span>
                    </div>
                </div>
            </form>
        </div>

		<?php
	}

}
