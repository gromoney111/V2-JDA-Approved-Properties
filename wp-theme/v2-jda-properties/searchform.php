<?php /** @package V2JDA */ ?>
<form role="search" method="get" class="form" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="max-width:560px; margin: 0 auto">
	<div class="field" style="margin:0">
		<label for="s" class="screen-reader-text"><?php esc_html_e( 'Search', 'v2jda' ); ?></label>
		<div style="display:flex; gap:10px">
			<input type="search" id="s" name="s" placeholder="<?php esc_attr_e( 'Search projects, locations...', 'v2jda' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
			<button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
		</div>
	</div>
</form>
