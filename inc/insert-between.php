<?php

if (!function_exists('insert_between') ) {

    /**
     * Insert an array with named keys at this position
     *
     * @param  [type] $array    [description]
     * @param  [type] $insert   [description]
     * @param  string $col_name [description]
     * @param  string $position [description]
     * @return [type]           [description]
     */
    function insert_between( $array , $insert , $key_name = 'title' , $position = 'after' ) {


        $key_pos = get_position( $array , $key_name );

        // if the key wasn't found, just add it to the end
        if ( !$key_pos === false ) return array_merge( $array , $insert );

        switch ( $position ) {

            case "after":
                $before = array_slice( $array , 0 , $key_pos + 1 );
                $after = array_slice( $array , $key_pos );

            break;

            case "before":

                $before = array_slice( $array , 0 , $key_pos );
                $after = array_slice( $array , $key_pos );

            break;

        }

        return $before + $insert + $after;

    }


}

if (!function_exists( 'get_position' ) ) {
    /**
     * get and return the position of a certain key in an array
     * @param  [type] $array [description]
     * @param  [type] $key   [description]
     * @return [type]        [description]
     */
    function get_position( $array , $key ) {

        if ( isset( $array[ $key ] ) || array_key_exists( $key , $array ) ) {
            return array_search( $key, array_keys( $array ) );
        }

        return false;
    }


}
