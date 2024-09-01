<span class="pagination-links">
	<a href="<?php echo site_url() ?>/wp-admin/admin.php?page=domain-mapping-system&paged=1"
       class="next-page button <?php echo $prev_page ? '' : 'disabled' ?>">
		<span class="screen-reader-text">Next page</span>
		<span aria-hidden="true">«</span>
	</a>
	<a href="<?= site_url() ?>/wp-admin/admin.php?page=domain-mapping-system&paged=<?= $page - 1 ?>"
       class="last-page button <?php echo $prev_page ? '' : 'disabled' ?>">
		<span class="screen-reader-text">Last page</span>
		<span aria-hidden="true">‹</span>
	</a>
	<span class="screen-reader-text">Current Page</span>
	<span id="table-paging" class="paging-input">
		<span class="tablenav-paging-text">
			<?php echo $page ?> of <span class="total-pages"><?php echo ceil( $mappings_count / $items_per_page ) ?></span>
		</span>
	</span>
	<a href="<?php echo site_url() ?>/wp-admin/admin.php?page=domain-mapping-system&paged=<?php echo $page + 1 ?>"
       class="next-page button <?php echo $next_page ? '' : 'disabled' ?>">
		<span class="screen-reader-text">Next page</span>
		<span aria-hidden="true">›</span>
	</a>
	<a href="<?php echo site_url() ?>/wp-admin/admin.php?page=domain-mapping-system&paged=<?= ceil( $mappings_count / $items_per_page ) ?>"
       class="last-page button <?php echo $next_page ? '' : 'disabled' ?>">
		<span class="screen-reader-text">Last page</span>
		<span aria-hidden="true">»</span>
	</a>
</span>