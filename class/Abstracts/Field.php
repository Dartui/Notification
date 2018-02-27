<?php
/**
 * Field abstract class
 *
 * @package notification
 */

namespace BracketSpace\Notification\Abstracts;

use BracketSpace\Notification\Interfaces;

/**
 * Field abstract class
 */
abstract class Field implements Interfaces\Fillable {

    /**
     * Field value
     *
     * @var mixed
     */
    public $value;

    /**
     * Field label
     *
     * @var mixed
     */
    protected $label;

    /**
     * Field name
     *
     * @var mixed
     */
    protected $name;

    /**
     * Short description
     * Limited HTML support
     *
     * @var string
     */
    protected $description = '';

    /**
     * If field is resolvable with merge tags
     * Default: true
     *
     * @var boolean
     */
    protected $resolvable = true;

    /**
     * Field section name
     *
     * @var string
     */
    public $section = '';

    /**
     * If field is disabled
     *
     * @var boolean
     */
    public $disabled = false;

    /**
     * Additional css classes for field
     *
     * @var string
     */
    public $css_class = 'widefat notification-field '; // space here on purpose.

    /**
     * Field constructor
     *
     * @since [Next]
     * @param array $params field configuration params.
     */
    public function __construct( $params = array() ) {

    	if ( ! isset( $params['label'], $params['name'] ) ) {
    		trigger_error( 'Field requires label and name', E_USER_ERROR );
    	}

		$this->label = $params['label'];
		$this->name  = $params['name'];
		$this->id    = $this->name . '_' . uniqid();

		if ( isset( $params['description'] ) ) {
			$this->description = wp_kses( $params['description'], wp_kses_allowed_html( 'data' ) );
		}

		if ( isset( $params['resolvable'] ) ) {
			$this->resolvable = (bool) $params['resolvable'];
		}

		if ( isset( $params['value'] ) ) {
			$this->set_value( $params['value'] );
		}

		if ( isset( $params['disabled'] ) && $params['disabled'] ) {
			$this->disabled = true;
		}

		if ( isset( $params['css_class'] ) ) {
			$this->css_class .= $params['css_class'];
		}

    }

    /**
     * Returns field HTML
     *
     * @return string html
     */
    abstract public function field();

    /**
     * Sanitizes the value sent by user
     *
     * @param  mixed $value value to sanitize.
     * @return mixed        sanitized value
     */
    abstract public function sanitize( $value );

    /**
     * Gets description
     *
     * @return string description
     */
    public function get_description() {
    	return $this->description;
    }

    /**
	 * Gets field value
     *
	 * @return mixed
	 */
    public function get_value() {
    	return apply_filters( 'notification/field/' . $this->get_name() . '/value', $this->value, $this );
    }

    /**
	 * Sets field value
     *
	 * @param  mixed $value value from DB.
	 * @return void
	 */
	public function set_value( $value ) {
		$this->value = $value;
	}

    /**
	 * Gets field name
     *
	 * @return string
	 */
	public function get_name() {
		return $this->section . '[' . $this->name . ']';
	}

    /**
	 * Gets field raw name
     *
	 * @return string
	 */
	public function get_raw_name() {
		return $this->name;
	}

	/**
	 * Gets field label
     *
	 * @return string
	 */
	public function get_label() {
		return $this->label;
	}

	/**
	 * Gets field ID
     *
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Cheks if field should be resolved with merge tags
     *
	 * @return boolean
	 */
	public function is_resolvable() {
		return $this->resolvable;
	}

	/**
	 * Cheks if field is disabled
     *
	 * @return boolean
	 */
	public function is_disabled() {
		return $this->disabled;
	}

	/**
	 * Returns the disable HTML tag if field is disabled
     *
	 * @return string
	 */
	public function maybe_disable() {
		return $this->is_disabled() ? 'disabled="disabled"' : '';
	}

	/**
	 * Returns the additional field's css classes
     *
	 * @return string
	 */
	public function css_class() {
		return $this->css_class;
	}

}
