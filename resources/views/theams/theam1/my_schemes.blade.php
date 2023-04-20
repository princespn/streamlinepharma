@extends('theams/theam1/layouts.app')
@section('theme1Content')
<style>
.share_container a{
	display: inline-block;
    margin: 5px;
    border: 1px solid black;
    text-align: center;
    padding: 5px 10px;
    border-radius: 50%;
}
</style>
<!-- Page Banner -->
<div class="page-banner container-fluid no-padding">
   <!-- Container -->
   <div class="container">
      <div class="banner-content">
         <h3>My Schemes</h3>
         
      </div>
      <ol class="breadcrumb">
         <li><a href="/" title="Home">Home</a></li>
         <li class="active">My Schemes</li>
      </ol>
   </div>
   <!-- Container /- -->
</div>
<!-- Page Banner /- -->
<!-- Checkout -->
<div class="container-fluid contact-us no-left-padding no-right-padding woocommerce-checkout">
   <!-- Container -->
   <div class="container">
      <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <table class='table table-bordered table-striped'>
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Scheme Name</th>
				  <th>Validity</th>
				  <th>Cashback</th>
				  <th>Share</th>
				</tr>
			  </thead>
			  <tbody>
			  @if(count($scheme))
			  @foreach($scheme as $key=>$row)
		      @php $url = url('detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id))).'&r=urlencode(base64_decode($register_id))'; @endphp
			    <tr>
				   <td>{{ ($key+1) }}</td>
				   <td>{{ $row->scheme_name }}</td>
				   <td>{{ $row->scheme_validity }}</td>
				   <td>{{ $row->referral_wallet_benefits }}</td>
				   <td>
				   <a  href="https://wa.me/?text={{ $row->description.' '.$url }}" data-action="share/whatsapp/share"  class="link-whatsapp"  target='_blank'><i class="fa fa-whatsapp"> </i> </a>

					 
					 <a href="https://www.facebook.com/sharer.php?u={{ $url }}"   class="link-facebook" target='_blank'><i class="fa fa-facebook"> </i> </a> 
					 
					 
					 <script type="IN/Share" data-url="$url"></script>

					 
					 
					 <a href="http://twitter.com/share?text={{ urlencode($row->description.' '.$url) }}"   class="link-linkedin" target='_blank'><i class="fa fa-twitter"> </i> </a>
					 
					 <br>
					 <span style='color:red;font-family:bold'>Link : </span>{{ $url }}
				   </td>
				</tr>
			  @endforeach
			  @else
				 <tr>
			       <td colspan='5'>No Scheme Found for your account.</td>
			     </tr>
			  @endif
			  </tbody>
			</table>
            
         </div>
         <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div id="footer-main" class="footer-main container-fluid" style="padding-left:20px;margin-top:30px;">
               <!-- Container -->
               <div class="container">
                  <div class="row">
                     <!-- Widget Links -->
                     <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links">
                        <h4 style="margin-top: -45px;padding-bottom:10px;">Useful Link</h4>
                        @include('theams.theam1.account_menu');
                     </aside>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Container /- -->
</div>
<!-- Checkout /- -->
@endsection
<script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>