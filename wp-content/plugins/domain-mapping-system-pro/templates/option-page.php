<?php
if ( ! empty( $instance ) && ! empty( $dms_fs ) && $instance instanceof DMS && $dms_fs instanceof Freemius ):
    // Get screen options
	$items_per_page = get_option( 'dms_mappings_per_page', 10 );
	$values_per_mapping = get_option( 'dms_values_per_mapping', 5 );

	// Get platform
	$platform = $instance->platform;

    // Check if it's a Wpcs platform tenant
	$isWpcsPlatformTenant = ! empty( $platform ) && $platform instanceof DMS_Wpcs && DMS_Wpcs::isTenant();

    // Determine if save button should be disabled based on platform
	$save_button_disable = DMS_Helper::disableSaveButton( $platform );

    // Get current page number
	$page = isset( $_GET['paged'] ) ? (int) $_GET['paged'] : 1;

    // Fetch data for the current page
	$res = $instance->getData( $items_per_page, $values_per_mapping, $page );

    // Extract data and count from the result
	$data           = ! empty( $res ) ? $res['result'] : [];
	$mappings_count = ! empty( $res['count'] ) ? $res['count'] : 0;

    // Calculate pagination
	$next_page      = ceil( $mappings_count / $items_per_page ) > $page;
	$prev_page      = $page > 1;

    // Retrieve global mapping options
	$archive_global_mapping         = get_option( 'dms_archive_global_mapping' );
	$woo_shop_global_mapping        = get_option( 'dms_woo_shop_global_mapping' );
	$dms_global_parent_page_mapping = get_option( 'dms_global_parent_page_mapping' );
	include_once plugin_dir_path( __FILE__ ) . 'screen-options.php';
	?>
    <div class="dms-n">
        <form id="dms-map" method="post" action="<?= admin_url( 'admin-post.php' ); ?>">
            <div class="dms-n-row dms-n-config">
                <h3 class="dms-n-row-header"><?php _e( 'Domain Mapping System Configuration', $instance->plugin_name ) ?></h3>
                <p class="dms-n-row-subheader">
                    <span class="dms-n-row-subheader-important"><?php _e( 'Important!', $instance->plugin_name ) ?></span>
                    <span>
                    <?php
                    if ( empty( $platform ) ) {
	                    printf( __( 'This plugin requires configuration with your DNS host and on your server (cPanel, etc). Please see %1$sour documentation%2$s for configuration requirements.',
		                    $instance->plugin_name ), '<a class="dms-n-row-subheader-link" target="_blank" href="https://docs.domainmappingsystem.com">', '</a>' );
                    } else {
	                    $platform->printGeneralNotice();
                    }
                    ?>
                </span>
                </p>
                <div class="dms-n-config-in">
					<?php if ( $save_button_disable ): ?>
                        <div class="updated dms-disabled-delay-note">
                            <p><strong><?php _e( 'Important!', $instance->plugin_name ) ?></strong></p>
                            <p><span><?= __( 'It takes up to 3 minutes to process each domain change. Please wait...' ) ?> <b
                                            class="timer"><?= $save_button_disable ?></b></span></p>
                        </div>
					<?php endif;
					// Check and show mdm import
					if ( ! empty( $instance->mdm_import_instance ) && $instance->mdm_import_instance->showImportNote() ) {
						$instance->mdm_import_instance->show();
					}
					// Show admin notices
					DMS_Helper::showSunriseNotices();
					$instance->showAdminNotice();
					if ( is_null( $platform ) || ( ! empty( $platform ) && $platform->showNavigation() ) ):?>
                    <div class="nav-tab-wrapper-cont">
                        <nav class="nav-tab-wrapper">
                            <a href="#domains"
                               class="dms nav-tab <?= empty( $platform ) || $platform->showMappingForm() ? 'nav-tab-active' : '' ?>"><?php _e( 'Domain Mapping', $instance->plugin_name ) ?></a>
							<?php if ( ! empty( $platform ) ):
								// If platform is not WPCS, then not supported by us
								?>
                                <a href="#hosting-config"
                                   class="dms nav-tab <?= ! empty( $platform ) && ! $platform->showMappingForm() ? 'nav-tab-active' : '' ?>"><?php _e( 'Hosting Config', $instance->plugin_name ) ?></a>
							<?php endif; ?>
                            <a href="#api"
                               class="dms nav-tab"><?php _e( 'Developer Tools', $instance->plugin_name ) ?></a>
                        </nav>
                        <div class="dms-n-mappings-pagination"
                             class="tablenav-pages">
                            <span class="displaying-num"><?php echo $mappings_count . ($mappings_count == 1 ? __( ' item', $instance->plugin_name ) : __( ' items', $instance->plugin_name )) ?></span>
		                    <?php if ( ceil( $mappings_count / $items_per_page ) != 1 ): ?>
			                    <?php include plugin_dir_path( __FILE__ ) . 'pagination.php' ?>
		                    <?php endif; ?>
                        </div>
                    </div>
					<?php endif; ?>
                    <div id="domains" class="dms-n-config-container dms-tab-container">
						<?php if ( ! empty( $platform ) && ! $platform->showMappingForm() ): ?>
                            <div class="dms-hide-mapping-overlay"></div>
						<?php endif; ?>
                        <h3 class="dms-n-row-header dms-n-config-header"><?php _e( 'Domains', $instance->plugin_name ) ?></h3>
                        <!-- New Table START -->
	                    <?php
	                    if ( ! empty( $data ) ) {
							$data_count          = count( $data );
							$row_key             = 0;
		                    foreach ( $data as $key => $map ) {
			                    $mapping_values = $map->mapped_values;
			                    if ( ! empty( $map->primary ) ) {
				                    $primary        = $map->primary;
				                    $primary_hidden = !in_array($primary, $mapping_values);
			                    }
								if ( $key == 0 || ( ! empty( $data[ $key - 1 ] ) && $map->id != $data[ $key - 1 ]->id ) ) {
									$domains[] = [
										'id'   => $map->id,
										'host' => $map->host . ( ! empty( $map->path ) ? '/' . $map->path : '' ),
										'main' => $map->main
									];
									$values    = [];
								}
								if ( $key == $data_count - 1 || ( ! empty( $data[ $key + 1 ] ) && $map->id != $data[ $key + 1 ]->id ) ) {
									$row_key ++
									?>
                                    <div class="dms-n-config-table">
                                        <button class="dms-n-config-table-dropdown opened">
                                            <i></i>
                                        </button>
                                        <div class="dms-n-config-table-in">
                                            <div class="dms-n-config-table-row first">
                                                <div class="dms-n-config-table-column domain">
                                                    <div class="dms-n-config-table-header <?php echo ! $dms_fs->can_use_premium_code__premium_only() ? 'free-version' : '' ?>">
                                                        <p>
                                                            <span><?php _e( 'Enter Mapped Domain', $instance->plugin_name ) ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="dms-n-config-table-body">
                                                        <span class="dms-n-config-table-body-scheme"><?= DMS_Helper::getScheme() ?>://</span>
	                                                    <?php $host = function_exists( 'idn_to_utf8' ) ? idn_to_utf8( $map->host ) : $map->host ?>
                                                        <input type="text"
                                                               name="dms_map[domains][<?= $row_key ?>][host]"
                                                               class="dms-n-config-table-input"
                                                               placeholder="example.com"
                                                               value="<?php echo $host ?>"/>
                                                        <span class="slash">/</span>
                                                    </div>
                                                </div>
                                                <div class="dms-n-config-table-column subdirectory">
                                                    <div class="dms-n-config-table-header <?php echo ! $dms_fs->can_use_premium_code__premium_only() ? 'free-version' : '' ?>">
                                                        <p>
                                                            <span><?php _e( 'Enter Subdirectory (optional)', $instance->plugin_name ) ?></span>
															<?php if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                                                <a href="<?= $dms_fs->get_upgrade_url(); ?>">
																	<?php _e( 'Upgrade', $instance->plugin_name ) ?>
                                                                    &#8594;
                                                                </a>
															<?php endif; ?>
                                                        </p>
                                                    </div>
                                                    <div class="dms-n-config-table-body">
                                                        <input type="text"
                                                               name="dms_map[domains][<?= $row_key ?>][path]"
															<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled' : '' ?>
                                                               class="dms-n-config-table-input"
                                                               placeholder="Sub Directory"
                                                               value="<?php echo $map->path ?>"/>
                                                        <span class="slash">/</span>
                                                    </div>
                                                </div>
                                                <div class="dms-n-config-table-column content">
                                                    <div class="dms-n-config-table-header <?php echo ! $dms_fs->can_use_premium_code__premium_only() ? 'free-version' : '' ?>">
                                                        <p>
                                                            <span><?php _e( 'Select the Published Content to Map for this Domain.', $instance->plugin_name ) ?></span>
															<?php if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                                                <span><?php _e( ' To map multiple published resources to a single domain, please', $instance->plugin_name ) ?> .</span>
                                                                <a href="<?= $dms_fs->get_upgrade_url(); ?>">
																	<?php _e( 'Upgrade', $instance->plugin_name ) ?>
                                                                    &#8594;
                                                                </a>
															<?php endif; ?>
                                                        </p>
	                                                    <?php if( $dms_fs->can_use_premium_code__premium_only() ) : ?>
                                                            <div class="dms-n-config-table-info">
                                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="15" height="15" viewBox="0,0,256,256">
                                                                    <g fill="#0085ba" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-size="none" style="mix-blend-mode: normal"><g transform="scale(9.84615,9.84615)"><path d="M13,1.1875c-6.52344,0 -11.8125,5.28906 -11.8125,11.8125c0,6.52344 5.28906,11.8125 11.8125,11.8125c6.52344,0 11.8125,-5.28906 11.8125,-11.8125c0,-6.52344 -5.28906,-11.8125 -11.8125,-11.8125zM15.46094,19.49609c-0.60937,0.23828 -1.09375,0.42188 -1.45703,0.54688c-0.36328,0.125 -0.78125,0.1875 -1.26172,0.1875c-0.73437,0 -1.30859,-0.17969 -1.71875,-0.53906c-0.40625,-0.35547 -0.60937,-0.8125 -0.60937,-1.36719c0,-0.21484 0.01563,-0.43359 0.04688,-0.65625c0.02734,-0.22656 0.07813,-0.47656 0.14453,-0.76172l0.76172,-2.6875c0.06641,-0.25781 0.125,-0.5 0.17188,-0.73047c0.04688,-0.23047 0.06641,-0.44141 0.06641,-0.63281c0,-0.33984 -0.07031,-0.58203 -0.21094,-0.71484c-0.14453,-0.13672 -0.41406,-0.20312 -0.8125,-0.20312c-0.19531,0 -0.39844,0.03125 -0.60547,0.08984c-0.20703,0.0625 -0.38281,0.12109 -0.53125,0.17578l0.20313,-0.82812c0.49609,-0.20312 0.97266,-0.375 1.42969,-0.51953c0.45313,-0.14453 0.88672,-0.21875 1.28906,-0.21875c0.73047,0 1.29688,0.17969 1.69141,0.53125c0.39453,0.35156 0.59375,0.8125 0.59375,1.375c0,0.11719 -0.01172,0.32422 -0.03906,0.61719c-0.02734,0.29297 -0.07812,0.5625 -0.15234,0.8125l-0.75781,2.67969c-0.0625,0.21484 -0.11719,0.46094 -0.16797,0.73438c-0.04687,0.27344 -0.07031,0.48438 -0.07031,0.625c0,0.35547 0.07813,0.60156 0.23828,0.73047c0.15625,0.12891 0.43359,0.19141 0.82813,0.19141c0.18359,0 0.39063,-0.03125 0.625,-0.09375c0.23047,-0.06641 0.39844,-0.12109 0.50391,-0.17187zM15.32422,8.61719c-0.35156,0.32813 -0.77734,0.49219 -1.27344,0.49219c-0.49609,0 -0.92578,-0.16406 -1.28125,-0.49219c-0.35547,-0.32812 -0.53125,-0.72656 -0.53125,-1.19141c0,-0.46484 0.17969,-0.86719 0.53125,-1.19922c0.35547,-0.33203 0.78516,-0.49609 1.28125,-0.49609c0.49609,0 0.92188,0.16406 1.27344,0.49609c0.35547,0.33203 0.53125,0.73438 0.53125,1.19922c0,0.46484 -0.17578,0.86328 -0.53125,1.19141z"></path></g></g>
                                                                </svg>
                                                                <div class="dms-n-config-table-info-text"><?php echo sprintf( __( 'Use the radio button to select a Microsite homepage. Read our %s documentation %s for details.',
					                                                    $instance->plugin_name ), '<a target="_blank" href="https://docs.domainmappingsystem.com/features/creating-microsites-multisite-alternative">', '</a>' ) ?>
                                                                </div>
                                                            </div>
	                                                    <?php endif; ?>
                                                    </div>
                                                    <div class="dms-n-config-table-body">
                                                        <select class="dms dms-n-config-table-select dms-domain-mapping-values"
                                                                data-map-id="dms-map-<?php echo $map->id ?>"
                                                                name="dms_map[domains][<?= $row_key ?>][mappings][values][]"
                                                                data-index="<?php echo $row_key ?>"
                                                                data-placeholder="The choice is yours."
                                                                value="<?php echo $map->value ?>"
															<?= $dms_fs->can_use_premium_code__premium_only() ? 'multiple' : '' ?>>
                                                            <option></option>
                                                            <optgroup class="dms-selected-values" id="dms-selected-values-<?php echo $map->id ?>" label="<?php _e('Selected') ?>">
		                                                        <?php foreach ( $mapping_values as $ind => $value ): ?>
                                                                    <option selected data-primary="<?= $primary == $value ?>"
                                                                            class="level-0"
                                                                            value="<?= $value ?>"><?php echo DMS_Helper::getTitleOfValue($value) ?></option>
		                                                        <?php endforeach; ?>
	                                                            <?php $disable_load_more = $map->total_mappings <= $values_per_mapping ?>
	                                                            <?php if ( ! $disable_load_more ): ?>
                                                                    <option selected class="load-more-opt" value="load-more"
                                                                            data-map-id="dms-host-<?php echo $map->id ?>"><?php echo __( 'Load more', $instance->plugin_name ) ?></option>
	                                                            <?php endif; ?>
                                                            </optgroup>
                                                        </select>
                                                        <div class="">
                                                            <input class="dms-count-inp" id="dms-count-inp-<?php echo $row_key ?>" name="dms_map[domains][<?= $row_key?>][count]" value="<?php echo $values_per_mapping ?>" type="hidden">
                                                        </div>
                                                        <?php if($primary_hidden): ?>
                                                        <input class="dms-primary-hidden" name="dms_map[domains][<?= $row_key ?>][primary_hidden]" type="hidden" value="<?= (int) $primary_hidden ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dms-n-config-table-row">
                                                <div class="dms-n-config-table-column code">
                                                    <div class="dms-n-config-table-header">
                                                        <p>
                                                            <span><?php _e( 'Custom HTML Code', $instance->plugin_name ) ?></span>
															<?php if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                                                <a href="<?= $dms_fs->get_upgrade_url(); ?>">
																	<?php _e( 'Upgrade', $instance->plugin_name ) ?>
                                                                    &#8594;
                                                                </a>
															<?php endif; ?>
                                                        </p>
                                                    </div>
                                                    <div class="dms-n-config-table-body">
                                                        <input type="text"
                                                               name="dms_map[domains][<?= $row_key ?>][custom_html]"
                                                               class="dms-n-config-table-input-code"
                                                               placeholder="</Code here>"
                                                               value="<?php echo esc_html( stripslashes( ( ! empty( $map->custom_html ) ? $map->custom_html : '' ) ) ) ?>"
															<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled' : '' ?>/>
                                                    </div>
                                                </div>
                                                <div class="dms-n-config-table-column favicon">
                                                    <div class="dms-n-config-table-header">
                                                        <p>
                                                            <span><?php _e( 'Favicon per Domain', $instance->plugin_name ) ?></span>
															<?php if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                                                <a href="<?= $dms_fs->get_upgrade_url(); ?>">
																	<?php _e( 'Upgrade', $instance->plugin_name ) ?>
                                                                    &#8594;
                                                                </a>
															<?php endif; ?>
                                                        </p>
                                                    </div>
                                                    <div class="dms-n-config-table-body">
                                                        <div class="dms-n-config-table-favicon">
															<?php if ( ! empty( $map->attachment_id ) ) { ?>
                                                                <img class="favicon <?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled' : '' ?>"
                                                                     src="<?= wp_get_attachment_image_url( $map->attachment_id ) ?>"
                                                                     alt=""
                                                                     width="25px">
															<?php } ?>
                                                            <input type="button" name="upload-btn"
                                                                   class="<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled' : '' ?> upload upload-btn"
                                                                   id="<?= $row_key ?>"
                                                                   value="<?= __( 'Upload Image', $instance->plugin_name ) ?>">
															<?php if ( $dms_fs->can_use_premium_code__premium_only() ) : ?>
                                                                <input class="dms-attachment-id" type="hidden"
                                                                       name="dms_map[domains][<?= $row_key ?>][attachment_id]"
                                                                       value="<?= $map->attachment_id ?>">
                                                                <button class="dms-delete-img"
                                                                        title="<?php _e( 'Delete', $instance->plugin_name ) ?>"
                                                                        style="display: <?= ! empty( wp_get_attachment_image_url( $map->attachment_id ) ) ? 'block' : 'none' ?>"
                                                                >&times;
                                                                </button>
															<?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="dms-n-config-table-delete">
                                            <i></i>
                                        </button>
										<?php
										if ( $isWpcsPlatformTenant ) {
											$platform->drawSetTenantMainDomainButton( $map->id, $save_button_disable );
										}
										?>
                                        <div style="display: none">
                                            <input type="hidden" class="dms-map-id"
                                                   name="dms_map[domains][<?= $row_key ?>][id]"
                                                   value="<?= $map->id ?>">
                                        </div>
                                    </div>
									<?php
								}
							}
						} ?>
                        <!-- New Table END -->
                        <div class="dms-n-row-footer">
							<?php
							if ( empty( $platform ) || ! ( $platform instanceof DMS_Wpcs ) ) {
								?>
                                <div class="dms-n-row-add">
                                    <input type="hidden" id="dms-domains-to-remove" name="dms_map[domains_to_remove]"
                                           value=""
                                           style="display: none">
                                    <a class="dms-add-row" href="#">
										<?php _e( '+ Add Domain Map Entry', $instance->plugin_name ) ?>
                                    </a>
                                </div>
								<?php
							}
							?>
                            <div class="dms-n-mappings-pagination"
                                 class="tablenav-pages">
                                <span class="displaying-num"><?php echo $mappings_count . ($mappings_count == 1 ? __( ' item', $instance->plugin_name ) : __( ' items', $instance->plugin_name )) ?></span>
		                        <?php if ( ceil( $mappings_count / $items_per_page ) != 1 ): ?>
			                        <?php include plugin_dir_path( __FILE__ ) . 'pagination.php' ?>
		                        <?php endif; ?>
                            </div>
                        </div>
                        <div class="dms-n-post-types-footer">
                            <div class="dms-n-row-submit">
                                <input type="submit" <?= $save_button_disable ? 'disabled data-disabled_delay="' . $save_button_disable . '"' : '' ?> value="Save" class="dms-submit">
                            </div>
                        </div>
                        <div id="dms-default-select" class="dms-domain-mapping-values" style="display: none" data-index="<?= $row_key + 1 ?>">
                            <select <?= $dms_fs->can_use_premium_code__premium_only() ? 'multiple' : '' ?>
                                    data-placeholder="<?php _e( 'The choice is yours.', $instance->plugin_name ) ?>">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div id="api" class="dms-tab-container">
                        <ul class="dms-n-api">
                            <li class="dms-n-row-subheader">
                                <a class="dms-n-row-subheader-link"
                                   href="https://docs.domainmappingsystem.com/features/rest-api"
                                   target="_blank"><?php echo __( 'See our documentation for more', $instance->plugin_name ) ?></a>
                            </li>
                        </ul>
                    </div>
					<?php
					if ( is_null( $platform ) || ( ! empty( $platform ) && $platform->showConfigForm() ) ): ?>
                        <div id="hosting-config" class="dms-tab-container dms-hosting-platform-container">
                            <h3 class="dms-n-row-header dms-n-config-header"><?php _e( 'Allow Domain Mapping System to automatically manage Addon or Alias Domains in your hosting platform by setting up the configuration details below.',
									$instance->plugin_name ); ?>
                            </h3>
                            <p class="dms-n-row-subheader"><?= __( 'Detected Hosting Platform', $instance->plugin_name ) ?></p>
                            <div class="updated">
                                <p><?= ! empty( $platform ) ? $platform->getName() : __( 'Hosting Platform Not Yet Integrated - Manual Configuration Required', $instance->plugin_name ) ?></p>
                            </div>
                            <p class="dms-n-row-subheader"><?= sprintf( __( 'We are currently building integrations for multiple hosting platforms. Check currently %s Supported Hosting Platforms %s or contact us at support@domainmappingsystem.com to request yours.',
									$instance->plugin_name ), '<a class="dms-n-row-subheader-link" target="_blank" href="https://docs.domainmappingsystem.com/faqs/what-hosting-companies-are-supported">', '</a>' ) ?></p>
							<?php
							if ( ! empty( $platform ) ) {
								$platform->drawForm();
							}
							?>
                        </div>
					<?php endif;
					if ( $isWpcsPlatformTenant ) {
						$platform->drawSetTenantDomainAsMainForm();
					}
					?>
                </div>
            </div>
            <div class="dms-n-row dms-n-additional">
				<?php if ( ! empty( $platform ) && ! $platform->showMappingForm() ): ?>
                    <div class="dms-hide-mapping-overlay"></div>
				<?php endif; ?>
                <div class="dms-n-additional-accordion opened">
                    <div class="dms-n-additional-accordion-header">
                        <h3>
                            <span><?php _e( 'Additional Options', $instance->plugin_name ) ?></span>
                        </h3>
                        <i></i>
                    </div>
                    <div class="dms-n-additional-accordion-body">
                        <ul>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_enable_query_strings"
                                                name="dms_enable_query_strings"
											<?php $opt = get_option( 'dms_enable_query_strings' );
											if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo "checked=\"checked\"";
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Support for query string parameters (e.g. - UTM, etc).', $instance->plugin_name ) ?>
                                        </span>
										<?php if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
												<?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
										<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_force_site_visitors"
                                                name="dms_force_site_visitors"
											<?php $opt = get_option( 'dms_force_site_visitors' );
											if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo "checked=\"checked\"";
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Force site visitors to see only mapped domains of a page (e.g. - disallow visitors to see the primary domain of a page).', $instance->plugin_name ) ?>
                                        </span>
										<?php if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
												<?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
										<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_global_mapping"
                                                name="dms_global_mapping"
											<?php $opt = get_option( 'dms_global_mapping' );
											if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo "checked=\"checked\"";
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Enable Global Domain Mapping (all pages will be served for your mapped domains).', $instance->plugin_name ) ?>
                                        </span>
                                        <span class="dms-main-domain-container">
                                            <?php if ( ! empty( $domains ) && count( $domains ) > 1 ) { ?>
	                                            <?php _e( 'Select the domain [+path] to serve for all unmapped pages:', $instance->plugin_name ) ?>
                                                <select name="dms_main_domain"
                                                        class="dms-main-domain" <?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>>
                                                        <option value="0"><?= __( 'Select domain', $instance->plugin_name ) ?></option>
                                                        <?php
                                                        foreach ( $domains as $domain ) {
	                                                        if ( ! empty( $domain['host'] ) && ! empty( $domain['path'] ) && ! empty( $domain['values'] ) )
		                                                        ?>
                                                                <option value="<?= $domain['host'] ?>" <?= $domain['main'] ? 'selected' : '' ?> ><?= $domain['host'] ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                            <?php }
                                            ?>
                                        </span>
										<?php
										if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
												<?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
										<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_archive_global_mapping"
                                                name="dms_archive_global_mapping"
											<?php if ( $archive_global_mapping === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo "checked=\"checked\"";
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Global Archive Mapping - All posts within an archive or category automatically map to the specified domain (archive mappings override Global Domain Mapping).',
	                                            $instance->plugin_name ) ?>
                                        </span>
										<?php
										if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
												<?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
										<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_woo_shop_global_mapping"
                                                name="dms_woo_shop_global_mapping"
											<?php $opt = get_option( 'dms_woo_shop_global_mapping' );
											if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo "checked=\"checked\"";
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Global Product Mapping - When you map a domain to the Shop page, all products on your site will be available through that domain.', $instance->plugin_name ) ?>
                                        </span>
										<?php
										if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
												<?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
										<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_global_parent_page_mapping"
                                                name="dms_global_parent_page_mapping"
											<?php $opt = get_option( 'dms_global_parent_page_mapping' );
											if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo "checked=\"checked\"";
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Global Parent Page Mapping - Automatically map all pages attached to a Parent Page.', $instance->plugin_name ) ?>
                                        </span>
										<?php
										if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
												<?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
										<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_rewrite_urls_on_mapped_page"
                                                name="dms_rewrite_urls_on_mapped_page"
											<?php $opt = get_option( 'dms_rewrite_urls_on_mapped_page' );
											if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo "checked=\"checked\"";
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Rewrite all URLs on a mapped domain with:', $instance->plugin_name );
                                            $rewrite_scenario = get_option( 'dms_rewrite_urls_on_mapped_page_sc' ); ?>
                                            <select name="dms_rewrite_urls_on_mapped_page_sc"
                                                    <?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>>
                                                    <option value="1" <?= $rewrite_scenario == '1' && $dms_fs->can_use_premium_code__premium_only() ? 'selected' : '' ?>><?= __( 'Global Rewriting',
                                                            $instance->plugin_name ) ?></option>
                                                    <option value="2" <?= $rewrite_scenario == '2' && $dms_fs->can_use_premium_code__premium_only() ? 'selected' : '' ?>><?= __( 'Selective Rewriting',
                                                            $instance->plugin_name ) ?></option>
                                                </select>
                                                <?php echo sprintf( __( '%s Warning: %s Global Rewriting may create dead links if you haven’t mapped internally linked pages properly. Read more in our %s Documentation > %s',
                                                    $instance->plugin_name ), '<strong>', '</strong>', '<a class="info" href="https://docs.domainmappingsystem.com/features/url-rewriting" target="_blank" >', '</a>' ); ?>
                                            <?php
                                            if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                                <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
                                                    <?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                                </a>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
			                                <?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_remove_parent_page_slug_from_child"
                                                name="dms_remove_parent_page_slug_from_child"
			                                <?php $opt = get_option( 'dms_remove_parent_page_slug_from_child' );
			                                if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
				                                echo "checked=\"checked\"";
			                                } ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Remove Parent Page slugs from mapped Child Page URLs.', $instance->plugin_name ) ?>
                                        </span>
		                                <?php
		                                if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
				                                <?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
		                                <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <strong><?php _e( 'Yoast SEO', $instance->plugin_name ); ?></strong>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_seo_options_per_domain"
                                                name="dms_seo_options_per_domain"
											<?php $opt = get_option( 'dms_seo_options_per_domain' );
											if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo 'checked="checked"';
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Duplicate SEO Options - Each mapped page will have duplicated Yoast SEO options for each mapped domain tied to it.', $instance->plugin_name ) ?>
                                        </span>
										<?php
										if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
												<?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
										<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
											<?= ! $dms_fs->can_use_premium_code__premium_only() ? 'disabled=disabled' : '' ?>
                                                id="dms_seo_sitemap_per_domain"
                                                name="dms_seo_sitemap_per_domain"
											<?php $opt = get_option( 'dms_seo_sitemap_per_domain' );
											if ( $opt === 'on' && $dms_fs->can_use_premium_code__premium_only() ) {
												echo "checked=\"checked\"";
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Sitemap per Domain - Dynamically generate a unique sitemap per domain.', $instance->plugin_name ) ?>
                                        </span>
										<?php
										if ( ! $dms_fs->can_use_premium_code__premium_only() ): ?>
                                            <a class="upgrade" href="<?= $dms_fs->get_upgrade_url(); ?>">
												<?php _e( 'Upgrade', $instance->plugin_name ) ?>&#8594;
                                            </a>
										<?php endif; ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dms-n-additional-accordion-li del">
                                    <div class="dms-n-additional-accordion-checkbox">
                                        <input
                                                class="checkbox"
                                                type="checkbox"
                                                id="dms_delete_upon_uninstall"
                                                name="dms_delete_upon_uninstall"
											<?php $opt = get_option( 'dms_delete_upon_uninstall' );
											if ( $opt === 'on' ) {
												echo 'checked="checked"';
											} ?>
                                        />
                                    </div>
                                    <div class="dms-n-additional-accordion-content">
                                        <span class="label">
                                            <?php _e( 'Delete plugin, data, and settings (full removal) when uninstalling.', $instance->plugin_name ) ?>
                                            <?php echo sprintf( __( '%s Warning: %s This action is irreversible.', $instance->plugin_name ), '<strong>', '</strong>' ); ?>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="dms-n-row-submit">
                            <input type="submit" <?= $save_button_disable ? 'disabled data-disabled_delay="' . $save_button_disable . '"' : '' ?>
                                   value="<?php _e( 'Save', $instance->plugin_name ) ?>"
                                   class="dms-submit"/>
                        </div>
                        <input name="action" value="save_dms_mapping" type="hidden">
						<?php wp_nonce_field( 'save_dms_mapping_action', 'save_dms_mapping_nonce' ) ?>
                    </div>
                </div>
            </div>
            <div class="dms-n-row dms-n-post-types">
                <h3 class="dms-n-row-header"><?php _e( 'Available Post Types', $instance->plugin_name ); ?></h3>
                <p class="dms-n-row-subheader"><?php _e( 'Select the Post Types or Custom Taxonomies that should be available for Domain Mapping System.', $instance->plugin_name ); ?></p>
                <div class="dms-n-post-types-in">
                    <div class="dms-n-post-types-container">
                        <label class="dms-n-post-types-label <?= get_option( 'dms_use_page' ) == 'on' ? 'checked' : ''; ?>"
                               for="dms_use_page">
                            <input class="dms-n-post-types-checkbox" name="dms_use_page" type="checkbox" id="dms_use_page"
								<?= get_option( 'dms_use_page' ) == 'on' ? ' checked="checked"' : ''; ?>>
                            <span>
                                <?php _e( 'Pages', $instance->plugin_name ); ?>
                            </span>
                        </label>
	                    <?php if ( $dms_fs->can_use_premium_code__premium_only() ): ?>
		                    <?php $page_taxonomies = DMS_Helper::getCustomTaxonomies( 'page' );
		                    foreach ( $page_taxonomies as $key => $taxonomy ): ?>
			                    <?php $value = get_option( "dms_use_cat_page_" . $key ) ?>
                                <label class="dms-n-post-types-label <?= ( $value == "on" ) ? ' checked' : '' ?>"
                                       for="dms_use_cat_page_<?= $key ?>">
                                    <input class="dms-n-post-types-checkbox" name="dms_use_cat_page_<?= $key ?>"
                                           type="checkbox" id="dms_use_cat_page_<?= $key ?>"
					                    <?= $value == 'on' ? 'checked="checked"' : '' ?>>
                                    <span><?= $taxonomy ?></span>
                                </label>
		                    <?php endforeach; ?>
	                    <?php endif; ?>
                        <label class="dms-n-post-types-label <?= get_option( 'dms_use_post' ) == 'on' ? 'checked' : ''; ?>"
                               for="dms_use_post">
                            <input class="dms-n-post-types-checkbox" name="dms_use_post" type="checkbox" id="dms_use_post"
								<?= get_option( 'dms_use_post' ) == 'on' ? ' checked="checked"' : ''; ?>>
                            <span>
                                <?php _e( 'Posts', $instance->plugin_name ); ?>
                            </span>
                        </label>
	                    <?php if ( $dms_fs->can_use_premium_code__premium_only() ): ?>
		                    <?php $post_taxonomies = DMS_Helper::getCustomTaxonomies( 'post' );
		                    foreach ( $post_taxonomies as $key => $taxonomy ): ?>
			                    <?php $value = get_option( "dms_use_cat_post_" . $key ) ?>
                                <label class="dms-n-post-types-label <?= ( $value == "on" ) ? ' checked' : '' ?>"
                                       for="dms_use_cat_post_<?= $key ?>">
                                    <input class="dms-n-post-types-checkbox" name="dms_use_cat_post_<?= $key ?>"
                                           type="checkbox" id="dms_use_cat_post_<?= $key ?>"
					                    <?= $value == 'on' ? 'checked="checked"' : '' ?>>
                                    <span><?= $taxonomy ?></span>
                                </label>
		                    <?php endforeach; ?>
	                    <?php endif; ?>
                        <label class="dms-n-post-types-label <?= get_option( 'dms_use_categories' ) == 'on' ? 'checked' : ''; ?>"
                               for="dms_use_categories">
                            <input class="dms-n-post-types-checkbox" name="dms_use_categories" type="checkbox" id="dms_use_categories"
								<?= get_option( 'dms_use_categories' ) == 'on' ? ' checked="checked"' : ''; ?>>
                            <span>
                        <?php _e( 'Blog Categories', $instance->plugin_name ); ?>
                    </span>
                        </label>
						<?php
						$types = DMS::getCustomPostTypes();
						foreach ( $types as $type ) {
							$value = get_option( "dms_use_{$type['name']}" );
							?>
                            <label class="dms-n-post-types-label <?= ( $value == "on" ) ? ' checked' : '' ?>" for="dms_use_<?= $type['name'] ?>">
                                <input class="dms-n-post-types-checkbox" name="dms_use_<?= $type['name'] ?>" type="checkbox" id="dms_use_<?= $type['name'] ?>"
									<?= $value == 'on' ? 'checked="checked"' : '' ?>>
                                <span><?= $type["label"] ?></span>
                            </label>
							<?php
							if ( ! empty( $type['has_archive'] ) ) {
								$value = get_option( "dms_use_{$type['name']}_archive" );
								?>
                                <label class="dms-n-post-types-label <?= ( $value == "on" ) ? ' checked' : '' ?>" for="dms_use_<?= $type['name'] ?>_archive">
                                    <input class="dms-n-post-types-checkbox" name="dms_use_<?= $type['name'] ?>_archive" type="checkbox"
                                           id="dms_use_<?= $type['name'] ?>_archive" <?= $value == 'on' ? 'checked="checked"' : '' ?>>
                                    <span><?= $type['label'] ?><strong><?= __( 'Archive', $instance->plugin_name ) ?></strong></span>
                                </label>
								<?php
							}
							if ( $dms_fs->can_use_premium_code__premium_only() && ! empty( $type['taxonomies'] ) ) : ?>
								<?php foreach ( $type['taxonomies'] as $taxonomy ): ?>
									<?php $value = get_option( "dms_use_cat_" . $type['name'] . "_" . $taxonomy['name'] ) ?>
                                    <label class="dms-n-post-types-label <?= ( $value == "on" ) ? ' checked' : '' ?>" for="dms_use_cat_<?= $type['name']?>_<?=$taxonomy['name']?>">
                                        <input class="dms-n-post-types-checkbox" name="dms_use_cat_<?= $type['name']?>_<?=$taxonomy['name']?>" type="checkbox" id="dms_use_cat_<?= $type['name']?>_<?=$taxonomy['name']?>"
											<?= $value == 'on' ? 'checked="checked"' : '' ?>>
                                        <span><?= $taxonomy['label'] ?></span>
                                    </label>
								<?php endforeach ?>
							<?php endif; ?>
							<?php
						}
						?>
                    </div>
                    <div class="dms-n-post-types-footer">
                        <div class="dms-n-row-submit">
                            <input type="submit" class="dms-submit"
								<?= $save_button_disable ? 'disabled data-disabled_delay="' . $save_button_disable . '"' : '' ?>
                                   value="<?php _e( 'Save', $instance->plugin_name ) ?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
