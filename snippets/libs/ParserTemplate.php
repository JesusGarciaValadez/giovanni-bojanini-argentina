<?php
//!defined( 'TEMPLATES_PATH' )  ? define(  'TEMPLATES_PATH' , LIBS_PATH.'templates'.DIRECTORY_SEPARATOR ) : '';
//!defined( 'CHUNKS_PATH' )  ? define(  'CHUNKS_PATH' , BASE_PATH.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'chunks'.DIRECTORY_SEPARATOR ): '';

class ParserTemplate {

    private function __construct() {}

    private static function parseData( $data, $template ) {

        if ( empty( $data ) ) {

            throw new Exception( 'No se ha especificado el conjunto de datos para el template.' );
        }
        if ( empty( $template ) ) {

            throw new Exception( 'El template especificado no es válido.' );
        }
        foreach ( $data  as $key => $value) {

            $template = str_replace( "[+$key+]" , $value , $template );
        }
        return $template ;
    }

    public static function parseTemplate( $type = '', $data = array() ) {

        $file = TEMPLATES_PATH . $type;

        if( file_exists($file) ){

            return self::parseData( $data , file_get_contents( $file ) );

        }else{

            throw new Exception( 'Lo sentimos, el template solicitado no existe.' );

        }

    }

    public static function parseChunk( $type = '' , $data = array() ){
        $file = CHUNKS_PATH . $type;

        if( file_exists($file) ){

            return self::parseData( $data , file_get_contents( $file ) );

        }else{

            throw new Exception( 'Lo sentimos, el template solicitado no existe.' );

        }

    }
}