<?php

class beaverposts_by_meta {

	// do stuff to init the things we need
	public static function setup() {

		// add init here so we can check if certain plugins are loaded
		add_action( 'init' , __CLASS__ . '::init' );

		add_filter( 'fl_builder_loop_query_args' , __CLASS__ . '::filter_meta_key_if_exists' );

	}

	public static function init() {

		// return early if the FLBuilderModel (Beaver Builder) doesn't exist
		if ( !class_exists( 'FLBuilderModel' ) ) return;

		//FLPostGridModule
		self::extend_modules();
	}

	/**
	 * Add something to the query_args if the mk_meta_key setting is found and has a value
	 * @param  [type] $query_args [description]
	 * @return [type]             [description]
	 */
	public static function filter_meta_key_if_exists( $query_args ) {

		if ( $query_args['settings']->mk_meta_key ) {

			// create new variables to make it easier to read
			$metakey = $query_args['settings']->mk_meta_key;
			$metavalue = $query_args['settings']->mk_meta_value;

			// check if meta_query already exists in the query_args,
			// if not add it and set relation to AND
			if ( !isset( $query_args[ 'meta_query' ] ) ) {

				$query_args[ 'meta_query' ] = array( 'relation' => 'AND' );

			}
			// add our meta key and value to check for
			$query_args['meta_query'] = array_merge(
													$query_args['meta_query'] ,
													array(
															"{$metakey}_meta" => array(
																'key' 	=>  $metakey,
																'value'	=>	 $metavalue ?  $metavalue : '' ,
																'type'	=> 'CHAR',
																'compare' => '=',
															)
														)
												);

		}

		return $query_args;
	}


	/**
	 * Extend the module by adding a tab
	 * @return [type] [description]
	 */
	private static function extend_modules() {

			$extend_modules = apply_filters( 'beaverposts_by_meta_extend_modules' , array( 'FLPostGridModule' , 'FLPostSliderModule' , 'FLPostCarouselModule' ) );

			$modules = FLBuilderModel::$modules;

			// change byref
			foreach ($modules as $key =>&$module) {

				// skip if not in provided extend_modules array
				if ( !in_array( get_class($module), $extend_modules ) && count($extend_modules)>0 ) continue;

				// This is the section that adds something to listed modules
				if ( in_array( get_class($module) , array( 'FLPostGridModule' , 'FLPostSliderModule' , 'FLPostCarouselModule' ) ) ) {

					if( $form = $module->form ) :

						// create a new tab and settings
						$new = array( 'meta'      => array(
							'title'    => __( 'Meta', 'beaverposts-by-meta' ),
							'sections' => array(
								'meta_filter'      => array(
									'title'  => __( 'Meta', 'beaverposts-by-meta' ),
									'fields' => array(
											'mk_meta_key' => array(
											    'type'          => 'text',
											    'label'         => __( 'Meta Key', 'textdomain' ),
											    'default'       => '',
											    'placeholder'   => __( 'Meta Key to filter on', 'textdomain' ),
											),
											'mk_meta_value' => array(
											    'type'          => 'text',
											    'label'         => __( 'Meta Value', 'textdomain' ),
											    'default'       => '',
											    'placeholder'   => __( 'Meta Value to check for (exact match)', 'textdomain' ),
											),

										)
									),
								),
							) );

						$new_form = insert_between( $form , $new , 'content' , 'after' );

						$module->form = $new_form;

					endif;

				}
			}


	}

}

beaverposts_by_meta::setup();