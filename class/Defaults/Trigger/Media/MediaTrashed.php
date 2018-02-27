<?php
/**
 * Media trashed trigger
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\Trigger\Media;

use BracketSpace\Notification\Defaults\MergeTag;
use BracketSpace\Notification\Abstracts;

/**
 * Media trashed trigger class
 */
class MediaTrashed extends Abstracts\Trigger {

	/**
	 * Constructor
	 */
	public function __construct() {

		parent::__construct( 'wordpress/media_trashed',  __( 'Media trashed', 'notification' ) );

		$this->add_action( 'delete_attachment', 10, 2 );
		$this->set_group( __( 'Media', 'notification' ) );
		$this->set_description( __( 'Fires when attachment is removed', 'notification' ) );

	}

	/**
	 * Assigns action callback args to object
	 *
	 * @return void
	 */
	public function action() {

		$this->attachment    = get_post( $this->callback_args[0] );
		$this->user_id       = get_current_user_id();
		$this->user_object   = get_userdata( $this->user_id );
		$this->trashing_user = get_userdata( get_current_user_id() );

		$this->attachment_creation_date = strtotime( $this->attachment->post_date );

	}

	/**
	 * Registers attached merge tags
	 *
	 * @return void
	 */
	public function merge_tags() {

		$this->add_merge_tag( new MergeTag\Media\AttachmentID() );
		$this->add_merge_tag( new MergeTag\Media\AttachmentPage() );
		$this->add_merge_tag( new MergeTag\Media\AttachmentTitle() );
		$this->add_merge_tag( new MergeTag\Media\AttachmentMimeType() );
		$this->add_merge_tag( new MergeTag\Media\AttachmentDirectUrl() );

		$this->add_merge_tag( new MergeTag\DateTime\DateTime( array(
			'slug' => 'attachment_creation_date',
			'name' => __( 'Attachment creation date', 'notification' ),
		) ) );

		// Author.
		$this->add_merge_tag( new MergeTag\User\UserID( array(
			'slug' => 'attachment_author_user_ID',
			'name' => __( 'Attachment author user ID', 'notification' ),
		) ) );

    	$this->add_merge_tag( new MergeTag\User\UserLogin( array(
			'slug' => 'attachment_author_user_login',
			'name' => __( 'Attachment author user login', 'notification' ),
		) ) );

        $this->add_merge_tag( new MergeTag\User\UserEmail( array(
			'slug' => 'attachment_author_user_email',
			'name' => __( 'Attachment author user email', 'notification' ),
		) ) );

		$this->add_merge_tag( new MergeTag\User\UserNicename( array(
			'slug' => 'attachment_author_user_nicename',
			'name' => __( 'Attachment author user nicename', 'notification' ),
		) ) );

        $this->add_merge_tag( new MergeTag\User\UserFirstName( array(
			'slug' => 'attachment_author_user_firstname',
			'name' => __( 'Attachment author user first name', 'notification' ),
		) ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( array(
			'slug' => 'attachment_author_user_lastname',
			'name' => __( 'Attachment author user last name', 'notification' ),
		) ) );

		// Trashing user.
		$this->add_merge_tag( new MergeTag\User\UserID( array(
			'slug'          => 'attachment_trashing_user_ID',
			'name'          => __( 'Attachment trashing user ID', 'notification' ),
			'property_name' => 'trashing_user',
		) ) );

    	$this->add_merge_tag( new MergeTag\User\UserLogin( array(
			'slug'          => 'attachment_trashing_user_login',
			'name'          => __( 'Attachment trashing user login', 'notification' ),
			'property_name' => 'trashing_user',
		) ) );

        $this->add_merge_tag( new MergeTag\User\UserEmail( array(
			'slug'          => 'attachment_trashing_user_email',
			'name'          => __( 'Attachment trashing user email', 'notification' ),
			'property_name' => 'trashing_user',
		) ) );

		$this->add_merge_tag( new MergeTag\User\UserNicename( array(
			'slug'          => 'attachment_trashing_user_nicename',
			'name'          => __( 'Attachment trashing user nicename', 'notification' ),
			'property_name' => 'trashing_user',
		) ) );

        $this->add_merge_tag( new MergeTag\User\UserFirstName( array(
			'slug'          => 'attachment_trashing_user_firstname',
			'name'          => __( 'Attachment trashing user first name', 'notification' ),
			'property_name' => 'trashing_user',
		) ) );

		$this->add_merge_tag( new MergeTag\User\UserLastName( array(
			'slug'          => 'attachment_trashing_user_lastname',
			'name'          => __( 'Attachment trashing user last name', 'notification' ),
			'property_name' => 'trashing_user',
		) ) );

    }

}
