<footer class="bg-dark mt-5">
	<div class="container pb-5 pt-3">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-card">
					<h3>Get In Touch</h3>
					<p>No dolore ipsum accusam no lorem. <br>
					123 Street, New York, USA <br>
					exampl@example.com <br>
					000 000 0000</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>Important Links</h3>
					<ul>
						{{-- <li><a href="about-us.php" title="About">About</a></li>
						<li><a href="contact-us.php" title="Contact Us">Contact Us</a></li>						
						<li><a href="#" title="Privacy">Privacy</a></li>
						<li><a href="#" title="Privacy">Terms & Conditions</a></li>
						<li><a href="#" title="Privacy">Refund Policy</a></li> --}}

						@if(!empty(staticPages()))
						@foreach (staticPages() as $page )
						<li><a href="{{ route('front.page',$page->slug) }}" title="{{ $page->name }}">{{ $page->name }}</a></li>	
						@endforeach
						@endif
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>My Account</h3>
					<ul>
						<li><a href="{{ route('account.login') }}" title="Sell">Login</a></li>
						<li><a href="{{ route('account.register') }}" title="Advertise">Register</a></li>
						<li><a href="{{ route('account.order') }}" title="Contact Us">My Orders</a></li>						
					</ul>
				</div>
			</div>			
		</div>
	</div>
	<div class="copyright-area">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p>© Copyright 2022 Amazing Shop. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Success</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('frontend-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('frontend-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('frontend-assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('frontend-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend-assets/js/custom.js') }}"></script>
<script src="{{ asset('frontend-assets/js/ion.rangeSlider.min.js') }}"></script>
<script>
	$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

function addToCart(id){
    //alert("hello");
   
    $.ajax({
        url:'{{ route("front.addToCart") }}',
        type:'post',
        data:{id:id},
        dataType:'json',
       
        success:function(response){

            if(response.status==true){
                window.location.href="{{ route('front.cart') }}";
            }
            else{
                alert(response.message);
            }

        }
    });

  }
//for add product in wishlist
  function addToWishList(id){

	$.ajax({
        url:'{{ route("front.addToWishList") }}',
        type:'post',
        data:{id:id},
        dataType:'json',
       
        success:function(response){

            if(response.status==true){
				$("#wishlistModal .modal-body").html(response.message);

				$("#wishlistModal").modal('show');
              
            }
            else{
				window.location.href="{{ route('account.login') }}";
            }

        }
    });

  }
</script>
@yield('customJS')
</body>
</html>