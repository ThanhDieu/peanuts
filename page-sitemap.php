<?php
/*
Template Name: Sitemap Page
*/
get_header();

get_template_part('sections/title-main');
?>
<section class="pt-60 pb-60 sitemap-outer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 bold title-after d-inline-block">Trang</h2>
                <ul class="mb-5 d-flex flex-wrap sitemap-list color-blue">
                    <?php
					wp_list_pages(array(
						'exclude'  => '',
						'title_li' => '',
					)); ?>
                </ul>

            </div>
            <div class="col-12">
                <h2 class="mb-4 bold title-after d-inline-block">Bài Viết</h2>
                <?php
				$cats = get_categories('exclude=');
				foreach ($cats as $cat) {
					echo '<h3 class="ps-3 mb-3"><a class="color-grey-7 text-capitalize hover-under" href="' . get_category_link($cat->term_id) . '">' . $cat->cat_name . '</a></h3>';
					echo '<ul class="mb-5 d-flex flex-wrap color-blue">';
					query_posts('posts_per_page=-1&cat=' . $cat->cat_ID);
					while (have_posts()) {
						the_post();
						$category = get_the_category();
						if ($category[0]->cat_ID == $cat->cat_ID) {
							echo '<li class="w-33 mb-3 a-hover"><a class="a-hover text-capitalize" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
						}
					}
					echo '</ul>';
				}
				?>
            </div>
            <div class="col-12">
                <h2 class="mb-4 bold title-after d-inline-block">Sản Phẩm</h2>
                <?php
				$categories = get_terms(array(
					'taxonomy' => 'product_cat',
					'parent' => 0,
					'hide_empty' => false,
				));

				foreach ($categories as $category) {
					echo '<h3 class="ps-3 mb-3"><a class="color-grey-7 text-capitalize hover-under" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></h3>';
					$children = get_term_children($category->term_id, 'product_cat');

					$args = array(
						'post_type' => 'product',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'term_id',
								'terms' => $category->term_id,
								// 'include_children' => false
							)
						)
					);

					$products = new WP_Query($args);

					if ($products->have_posts()) {
						echo '<ul class="mb-0 d-flex flex-wrap color-blue ps-5">';

						while ($products->have_posts()) {
							$products->the_post();
							echo '<li class="w-33 mb-3 a-hover"><a class="a-hover text-capitalize" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
						}

						echo '</ul>';
					}

					if (count($children) > 0) {
						echo '<div class="px-4">';
						$subcategories = get_terms(array(
							'taxonomy' => 'product_cat',
							'hide_empty' => false,
							'parent' => $category->term_id,
						));

						foreach ($subcategories as $subcategory) {
							echo '<h4 class="ps-3 mb-3"><a class="color-grey-7 text-capitalize hover-under" href="' . get_category_link($subcategory->term_id) . '">' . $subcategory->name . '</a></h4>';

							$subargs = array(
								'post_type' => 'product',
								'posts_per_page' => -1,
								'tax_query' => array(
									array(
										'taxonomy' => 'product_cat',
										'field' => 'term_id',
										'terms' => $subcategory->term_id,
										// 'include_children' => false
									)
								)
							);

							$subproducts = new WP_Query($subargs);

							if ($subproducts->have_posts()) {
								echo '<ul class="d-flex flex-wrap color-blue">';

								while ($subproducts->have_posts()) {
									$subproducts->the_post();
									echo '<li class="w-33 mb-3 a-hover"><a class="a-hover text-capitalize" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
								}

								echo '</ul>';
							}
						}
						echo '</div>';
					}
					wp_reset_postdata();
				}

				?>


            </div>

        </div>
    </div>
</section>
<?php
get_footer()
?>