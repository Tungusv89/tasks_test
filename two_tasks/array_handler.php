<?php
function insert_listing_categories($listing_categories)
{
	foreach ($listing_categories as $category) {
		$category_hierarchy = explode('->', $category);
		$parent_category = 0;
	}

	foreach ($category_hierarchy as $single_category) {
		$existing_category = term_exists($single_category, 'job_listing_categories');

		if (!$existing_category) {
			$new_category = wp_insert_term($single_category, 'job_listing_categories', array(
				'parent' => $parent_category
			));
			$parent_category = $new_category['term_id'];
		} else {
			$parent_category = $existing_category['term_id'];
		}
	}
}
