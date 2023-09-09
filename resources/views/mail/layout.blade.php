<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="x-apple-disable-message-reformatting" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>YellowBeard</title>
	<style type="text/css" rel="stylesheet" media="all">
		/* Base ------------------------------ */

		@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

		body {
			width: 100% !important;
			height: 100%;
			margin: 0;
			-webkit-text-size-adjust: none;
		}

		a {
			color: #ffde00;
			text-decoration: none;
		}

		a img {
			border: none;
		}

		td {
			word-break: break-word;
		}

		.preheader {
			display: none !important;
			visibility: hidden;
			mso-hide: all;
			font-size: 1px;
			line-height: 1px;
			max-height: 0;
			max-width: 0;
			opacity: 0;
			overflow: hidden;
		}

		/* Type ------------------------------ */

		body,
		td,
		th {
			font-family: 'Roboto', sans-serif;
		}

		h1 {
			margin-top: 0;
			color: #333333;
			font-size: 22px;
			font-weight: bold;
			text-align: left;
		}

		h2 {
			margin-top: 0;
			color: #333333;
			font-size: 16px;
			font-weight: bold;
			text-align: left;
		}

		h3 {
			margin-top: 0;
			color: #333333;
			font-size: 14px;
			font-weight: bold;
			text-align: left;
		}

		td,
		th {
			font-size: 16px;
		}

		p,
		ul,
		ol,
		blockquote {
			margin: .4em 0 1.1875em;
			font-size: 16px;
			line-height: 1.625;
		}

		p.sub {
			font-size: 13px;
		}

		/* Utilities ------------------------------ */

		.align-right {
			text-align: right;
		}

		.align-left {
			text-align: left;
		}

		.align-center {
			text-align: center;
		}

		/* Buttons ------------------------------ */

		.button {
			background-color: #3869D4;
			border-top: 10px solid #3869D4;
			border-right: 18px solid #3869D4;
			border-bottom: 10px solid #3869D4;
			border-left: 18px solid #3869D4;
			display: inline-block;
			color: #FFF;
			text-decoration: none;
			border-radius: 3px;
			box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
			-webkit-text-size-adjust: none;
			box-sizing: border-box;
		}

		.button--green {
			background-color: #22BC66;
			border-top: 10px solid #22BC66;
			border-right: 18px solid #22BC66;
			border-bottom: 10px solid #22BC66;
			border-left: 18px solid #22BC66;
		}

		.button--red {
			background-color: #FF6136;
			border-top: 10px solid #FF6136;
			border-right: 18px solid #FF6136;
			border-bottom: 10px solid #FF6136;
			border-left: 18px solid #FF6136;
		}

		@media only screen and (max-width: 500px) {
			.button {
				width: 100% !important;
				text-align: center !important;
			}
		}

		/* Attribute list ------------------------------ */

		.attributes {
			margin: 0 0 21px;
		}

		.attributes_content {
			background-color: #F4F4F7;
			padding: 16px;
		}

		.attributes_item {
			padding: 0;
		}

		/* Related Items ------------------------------ */

		.related {
			width: 100%;
			margin: 0;
			padding: 25px 0 0 0;
			-premailer-width: 100%;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
		}

		.related_item {
			padding: 10px 0;
			color: #CBCCCF;
			font-size: 15px;
			line-height: 18px;
		}

		.related_item-title {
			display: block;
			margin: .5em 0 0;
		}

		.related_item-thumb {
			display: block;
			padding-bottom: 10px;
		}

		.related_heading {
			border-top: 1px solid #CBCCCF;
			text-align: center;
			padding: 25px 0 10px;
		}

		/* Discount Code ------------------------------ */

		.discount {
			width: 100%;
			margin: 0;
			padding: 24px;
			-premailer-width: 100%;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
			background-color: #F4F4F7;
			border: 2px dashed #CBCCCF;
		}

		.discount_heading {
			text-align: center;
		}

		.discount_body {
			text-align: center;
			font-size: 15px;
		}

		/* Social Icons ------------------------------ */

		.social {
			width: auto;
		}

		.social td {
			padding: 0;
			width: auto;
		}

		.social_icon {
			height: 20px;
			margin: 0 8px 10px 8px;
			padding: 0;
		}

		/* Data table ------------------------------ */

		.purchase {
			width: 100%;
			margin: 0;
			padding: 35px 0;
			-premailer-width: 100%;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
		}

		.purchase_content {
			width: 100%;
			margin: 0;
			padding: 25px 0 0 0;
			-premailer-width: 100%;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
		}

		.purchase_item {
			padding: 10px 0;
			color: #51545E;
			font-size: 15px;
			line-height: 18px;
		}

		.purchase_heading {
			padding-bottom: 8px;
			border-bottom: 1px solid #EAEAEC;
		}

		.purchase_heading p {
			margin: 0;
			color: #85878E;
			font-size: 12px;
		}

		.purchase_footer {
			padding-top: 15px;
			border-top: 1px solid #EAEAEC;
		}

		.purchase_total {
			margin: 0;
			text-align: right;
			font-weight: bold;
			color: #333333;
		}

		.purchase_total--label {
			padding: 0 15px 0 0;
		}

		body {
			background-image: url("{{ asset('images/rushbg.jpg') }}");
			background-size: 450px;
			color: #51545E;
		}

		p {
			color: #51545E;
		}

		.email-wrapper {
			width: 100%;
			margin: 0;
			padding: 0;
			-premailer-width: 100%;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
			background-image: url("{{ asset('images/rushbg.jpg') }}");
			background-size: 450px;
		}

		.email-content {
			width: 100%;
			margin: 0;
			padding: 0;
			-premailer-width: 100%;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
		}

		/* Masthead ----------------------- */

		.email-masthead {
			padding: 25px 0;
			text-align: center;
		}

		.email-masthead_logo {
			width: 94px;
		}

		.email-masthead_name {
			font-size: 16px;
			font-weight: bold;
			color: #A8AAAF;
			text-decoration: none;
			text-shadow: 0 1px 0 white;
		}

		/* Body ------------------------------ */

		.email-body {
			width: 100%;
			margin: 0;
			padding: 0;
			-premailer-width: 100%;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
		}

		.email-body_inner {
			width: 570px;
			margin: 0 auto;
			padding: 0;
			-premailer-width: 570px;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
			background-color: #000000;
		}

		.email-footer {
			width: 570px;
			margin: 0 auto;
			padding: 0;
			-premailer-width: 570px;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
			text-align: center;
		}

		.email-footer p {
			color: #A8AAAF;
		}

		.body-action {
			width: 100%;
			margin: 30px auto;
			padding: 0;
			-premailer-width: 100%;
			-premailer-cellpadding: 0;
			-premailer-cellspacing: 0;
			text-align: center;
		}

		.body-sub {
			margin-top: 25px;
			padding-top: 25px;
			border-top: 1px solid #ffde00;
		}

		.content-cell {
			padding: 40px;
		}

		.logo {
			width: 150px;
		}

		.title-area {
			background-color: #ffde00;padding: 20px 0;margin-bottom: 20px;
		}

		.title-area h3 {
			text-align: center;
			margin: 0;
			text-transform: uppercase;
			color: #000;
			font-size: 22px;
		}

		.title-area p {
			margin: 0;text-align: center;color: #000;font-size: 16px;text-transform: uppercase;
		}

		.store-logo {
			width: 220px;
		}

		.footer-branding {
			margin: 20px 0 0 0;background-color: #ffde00;text-align: center;padding: 5px 0;font-weight: 300;color: #000000;text-transform: uppercase;
		}

		.content {
			color: #FFFFFF;
		}

		#order {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#order td, #order th {
			border: 1px solid rgb(139, 139, 139);
			padding: 6px;
			color: #FFF;
		}

		#order tr:nth-child(even, odd){background-color: #ddd;}

		#order th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #4CAF50;
			color: white;
		}

		.btn {
			background-color: #ffde00;
			color: #000;
			padding: 5px 25px;
		}

		/*Media Queries ------------------------------ */

		@media only screen and (max-width: 600px) {

			.email-body_inner,
			.email-footer {
				width: 100% !important;
			}
		}
	</style>
	<!--[if mso]>
    <style type="text/css">
      .f-fallback  {
        font-family: Arial, sans-serif;
      }
    </style>
  <![endif]-->
</head>

<body>
	<table style="width: 100%;margin: 20px 0; padding: 0; background-image: url('{{ asset('images/rushbg.jpg') }}'); background-size: 450px;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
		<tr>
			<td align="center">
				<table  width="100%" cellpadding="0" cellspacing="0" role="presentation">
					{{-- <tr>
						<td style="text-align: center !important">
							<a href="https://onepilatesstudio.com" class="f-fallback email-masthead_name">
								<img  alt="One Pilates Studio" style="width: 500px; margin: 20px 0;" src="{{ asset('images/onepilatesstudio2.png') }}" />
							</a>
						</td>
					</tr> --}}
					<!-- Email Body -->
					<tr>
						<td style="width: 100%; margin: 0; padding: 0;" width="570" cellpadding="0" cellspacing="0">
							<table style="width: 570px; margin: 0 auto; padding: 0; background-color: #000000;" width="570" cellpadding="0" cellspacing="0"
								role="presentation">
								<!-- Body content -->
								<tr>
									<td style="padding: 40px; background-color: #676565;">
										<img  alt="One Pilates Studio" style="width: 500px; margin: 20px 0;" src="{{ asset('images/onepilatesstudio2.png') }}" />
										<div class="f-fallback">
											@if(trim($__env->yieldContent('title')))
											<div style="background-color: #ffde00; padding: 10px 10px; margin-bottom: 20px;">
												<h3 style="text-align: center;  margin-top: 0px; margin-bottom: 0px; text-transform: uppercase;" >@yield('title', 'Welcome to YellowBeard')</h3>
												<!-- <p>Damn Good Coffee</p> -->
											</div>
											@endif
											@if(trim($__env->yieldContent('header_image')))
											<div style="width: 100%">
												@yield('header_image')
											</div>
											@endif
											<p style="margin: 0; text-align: left; color: #101010 !important; font-size: 16px">
                                            @yield('content')
											</p>

											{{-- <table style="margin-top: 25px; padding-top: 25px; border-top: 1px solid #ffde00; width: 100%" role="presentation">
												<tr>
													<td>
														<a href="https://apps.apple.com/us/app/yellowbeard/id1496772417?ls=1" target="_blank">
															<img style="width: 220px;" src="{{ asset('images/applestore.png') }}" alt="">
														</a>
													</td>
													<td style="text-align: right !important">
														<a href="https://play.google.com/store/apps/details?id=com.yellowbeard.yb" target="_blank">
															<img style="margin-left: 30px; width:220px;" src="{{ asset('images/googlestore.png') }}" alt="">
														</a>
													</td>
												</tr>
											</table> --}}
											<p style="margin: 20px 0 0 0;background-color: #0d0d0c;text-align: center;padding: 5px 0;font-weight: 300;color: #FFC83D;text-transform: uppercase;">GET YOUR CLASESS AT ONEPILATESSTUDIO APP</p>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				
				</table>
			</td>
		</tr>
	</table>
</body>

</html>
