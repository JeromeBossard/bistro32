<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
 /*print_r($node);
 die();*/
?>
<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<?php endif; ?>
  <?php if (!$page): ?>
      <header>
  <?php endif; ?>
      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
      <h2 class="title" <?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

    <?php if (!$page): ?>
      </header>
  <?php endif; ?>
	
	<?php if($node->field_images && $node->field_images['und'] || $node->field_paragraphe && $node->field_paragraphe['und']){
		drupal_add_css('sites/all/themes/bistro32/js/fancybox/jquery.fancybox.css');
		drupal_add_js('sites/all/themes/bistro32/js/fancybox/jquery.fancybox.js');
		drupal_add_js('sites/all/themes/bistro32/js/bistro32.js');
	} ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // Hide comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      //print render($content);			
    ?>
		
		<?php if($node->body){ ?> 
			<div class="body"><?php print $node->body['und'][0]['safe_value']; ?></div>
		<?php } ?>
		
		<?php if($node->field_paragraphe && $node->field_paragraphe['und'] && $node->field_paragraphe['und'][0]){ ?>
		<div class="paragraphes">
			<?php // FieldCollection du paragraphe
			foreach($node->field_paragraphe['und'] as $content_block){
				$theContentBlock = entity_load('field_collection_item', array($content_block['value']));
				$the_content_block_image = '';
				$the_content_block_image_title = '';
				$the_content_block_image_alt = '';
				
				// Champ image
				$image = false;
				if($theContentBlock[$content_block['value']]->field_image_paragraphe && $theContentBlock[$content_block['value']]->field_image_paragraphe['und'][0]){
					$the_content_block_image = $theContentBlock[$content_block['value']]->field_image_paragraphe['und'][0]['uri'];
					$the_content_block_image_title = $theContentBlock[$content_block['value']]->field_image_paragraphe['und'][0]['title'];
					$the_content_block_image_alt = $theContentBlock[$content_block['value']]->field_image_paragraphe['und'][0]['alt'];
					$image = true;
				}
				
				// Couleur de fond du paragraphe
				$couleur = 'Transparent';
				if($theContentBlock[$content_block['value']]->field_couleur_de_fond && $theContentBlock[$content_block['value']]->field_couleur_de_fond['und'][0]){
					$couleur = $theContentBlock[$content_block['value']]->field_couleur_de_fond['und'][0]['value'];
				} ?>
				
				<div class="paragraphe <?php print $couleur ?>">
				<?php // Titre paragraphe
				if($theContentBlock[$content_block['value']]->field_titre_paragraphe && $theContentBlock[$content_block['value']]->field_titre_paragraphe['und'][0]){ ?>
					<div class="titre-paragraphe">
						<h2><?php print $theContentBlock[$content_block['value']]->field_titre_paragraphe['und'][0]['value'] ?></h2>
					</div>
					<?php } ?>
					<div class="contenu-paragraphe">
						<?php if($image){ ?>
						<div class="image-paragraphe <?php print $theContentBlock[$content_block['value']]->field_placement_image['und'][0]['value'] ?>">
							<a href="<?php print image_style_url('fancybox-desktop', $the_content_block_image) ?>" class="fancybox" data-fancybox-group="gallery" title="<?php print $the_content_block_image_title ?>">						
								<img src="<?php print image_style_url('paragraphe', $the_content_block_image) ?>" alt="<?php print $the_content_block_image_alt ?>" title="<?php print $the_content_block_image_title ?>"/>
							</a>
						</div>
						<?php }
						if($theContentBlock[$content_block['value']]->field_texte_paragraphe && $theContentBlock[$content_block['value']]->field_texte_paragraphe['und'][0]){ ?>
						<div><?php print $theContentBlock[$content_block['value']]->field_texte_paragraphe['und'][0]['value'] ?></div>
						<?php } ?>
						<div class="clear"></div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php } ?>
  </div>
		
	<?php if($node->field_images && $node->field_images['und']){ ?>
		<div class="slideshow">
		<?php foreach($node->field_images['und'] as $image){ ?>
				<a href="<?php print image_style_url('fancybox-desktop', $image['uri']) ?>" class="fancybox" data-fancybox-group="gallery" title="<?php print $image['title'] ?>">						
					<img src="<?php print image_style_url('miniature', $image['uri']) ?>" alt="<?php print $image['alt'] ?>" title="<?php print $image['title'] ?>"/>
				</a>
		<?php } ?>
		</div>
	<?php } ?>

  <?php if (!empty($content['links'])): ?>
    <footer>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>
<?php if (!$page): ?>
  </article> <!-- /.node -->
<?php endif; ?>