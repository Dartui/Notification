<?php
/**
 * Taxonomy trigger abstract
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\Trigger\Taxonomy;

use BracketSpace\Notification\Abstracts;
use BracketSpace\Notification\Defaults\MergeTag;

/**
 * Taxonomy trigger class
 */
abstract class TermTrigger extends Abstracts\Trigger {

	/**
	 * Taxonomy slug
	 *
	 * @var string
	 */
	protected $taxonomy;

	/**
	 * Constructor
	 *
	 * @param array $params trigger configuration params.
	 */
	public function __construct( $params = [] ) {

		if ( ! isset( $params['taxonomy'], $params['slug'], $params['name'] ) ) {
			trigger_error( 'TaxonomyTrigger requires taxonomy slug, slug and name.', E_USER_ERROR );
		}

		$this->taxonomy = $params['taxonomy'];

		parent::__construct( $params['slug'], $params['name'] );

		$this->set_group( $this->get_current_taxonomy_name() );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		$this->add_merge_tag( new MergeTag\Taxonomy\TermID() );
		$this->add_merge_tag( new MergeTag\Taxonomy\TermDescription() );
		$this->add_merge_tag( new MergeTag\Taxonomy\TermName() );
		$this->add_merge_tag( new MergeTag\Taxonomy\TermSlug() );
		$this->add_merge_tag( new MergeTag\Taxonomy\TermPermalink() );

		$this->add_merge_tag( new MergeTag\Taxonomy\TaxonomyName( [
			'taxonomy' => $this->taxonomy,
		] ) );

		$this->add_merge_tag( new MergeTag\Taxonomy\TaxonomySlug( [
			'taxonomy' => $this->taxonomy,
		] ) );

	}

	/**
	 * Gets nice, translated taxonomy name
	 *
	 * @since  5.2.2
	 * @return string taxonomy
	 */
	public function get_current_taxonomy_name() {
		return self::get_taxonomy_name( $this->taxonomy );
	}

	/**
	 * Gets nice, translated taxonomy name for taxonomy slug
	 *
	 * @since  5.2.2
	 * @since  [Next] Using internal caching.
	 * @param  string $taxonomy Taxonomy slug.
	 * @return string
	 */
	public static function get_taxonomy_name( $taxonomy ) {
		$taxonomies = notification_cache( 'taxonomies' );
		return $taxonomies[ $taxonomy ] ?? '';
	}

}
