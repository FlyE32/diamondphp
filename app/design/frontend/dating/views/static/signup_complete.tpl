<div class="pricing_wrapper layout-3 padding-bottom-40 clearfix">
	<div class="col-xs-12 padding-right-5 padding-left-5">
		<div class="pricing-table">
			<div class="pricing-header padding-vertical-10">
				<h4>Registration complete</h4>
			</div>
			<div class="main_pricing">
				<div class="inside">
					<br>
					{if $signup_email_confirmation eq 'TRUE'}
						<p>Please check your email for a confirmation notification in order to activate your account.</p>
					{else}
						<p>You may now <a href="{$site_url}login">login to your account</a>
					</p>
					{/if}
				</div>
			</div>
		</div>
	</div>
</div>
