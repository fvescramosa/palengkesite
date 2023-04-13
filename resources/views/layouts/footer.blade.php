        <footer class="footer-distributed">

			<div class="footer-center">

				<a href="#"><i class="fab fa-facebook-f"></i></a>
				<a href="#"><i class="fab fa-twitter"></i></a>
				<a href="#"><i class="fab fa-linkedin"></i></a>
				<a href="#"><i class="fas fa-link"></i></a>

        </div>

			<div class="footer-links-center">

				<p class="footer-links">
					<a class="link-1" href="{{ url('/') }}">Home</a>

					<a href="{{ route('shop.products.index') }}">Products</a>

					<a href="{{ route('shop.stores') }}">Stores</a>

					<a href="{{ route('about-us') }}">About</a>

					<a href="{{ route('contact-us') }}">Contact</a>
				</p>

				<p>PalengkeSite &copy; <?= date('Y'); ?> by <span>University of Batangas</span> | All Rights Reserved! </p>
			</div>

</footer>