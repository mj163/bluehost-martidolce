<div id="content">
	<h2 class="nav-tab-wrapper"> 
		<a data-tab-id="export" class="nav-tab<?php wc_subs_exporter_admin_active_tab( 'export' ); ?>" href="<?php echo add_query_arg( array( 'page' => 'wc-subs-exporter', 'tab' => 'export' ), 'admin.php' ); ?>">
		<?php _e( 'Export', 'wc-subs-exporter' ); ?>
		</a>
<?php
if ( 'step' == $tab )  {
?>	
		<a data-tab-id="step" class="nav-tab<?php wc_subs_exporter_admin_active_tab( 'step' ); ?>" href="<?php echo add_query_arg( array( 'page' => 'wc-subs-exporter', 'tab' => 'export'  ), 'admin.php' ); ?>">
		<?php printf( __( 'Export step %s', 'wc-subs-exporter') , $_GET['step'] ); ?>
		</a>
<?php
}
?>
		<a data-tab-id="options" class="nav-tab<?php wc_subs_exporter_admin_active_tab( 'options' ); ?>" href="<?php echo add_query_arg( array( 'page' => 'wc-subs-exporter', 'tab' => 'options' ), 'admin.php' ); ?>">
		<?php _e( 'Options', 'wc-subs-exporter' ); ?>
		</a>
		<a data-tab-id="archive" class="nav-tab<?php wc_subs_exporter_admin_active_tab( 'archive' ); ?>" href="<?php echo add_query_arg( array( 'page' => 'wc-subs-exporter', 'tab' => 'archive' ), 'admin.php' ); ?>">
		<?php _e( 'Archives', 'wc-subs-exporter' ); ?>
		</a> 
	</h2>
  <?php wc_subs_exporter_tab_template( $tab ); ?>
</div>
<!-- #content -->

<?php
/*
<div id="progress" style="display:none;">
  <p>
    <?php _e( 'Chosen WooCommerce details are being exported, this process can take awhile. Time for a beer?', 'wc-subs-exporter' ); ?>
  </p>
  <img src="<?php echo plugins_url( '/templates/admin/images/progress.gif', $wc_subs_exporter['relpath'] ); ?>" alt="" />
  <p>
    <?php _e( 'When the download is complete, return to <a href="' . $url . '">WooCommerce Subscription Exporter</a>.', 'wc-subs-exporter' ); ?>
</div>
<!-- #progress -->
*/
?>