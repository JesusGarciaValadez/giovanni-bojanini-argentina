<?php
if ( !empty( $_GET['action'] ) )
{
    $action    = strip_tags( trim( $_GET[ 'action' ] ) );
    $data      = array();
    try
    {
        switch ( $action )
        {
            case 'contact':
                $data[ "first_name" ]   = trim( $_POST[ 'firstName' ] );
                $data[ "last_name" ]    = trim( $_POST[ 'lastName' ] );
                $data[ "email" ]        = trim( $_POST[ 'email' ] );
                $data[ "city" ]         = trim( $_POST[ 'city' ] );
                $data[ "message" ]      = trim( $_POST[ 'message' ] );
                $data[ "date_answer" ]  = date( "Y-m-d H:i:s" );
                /*
                $cc = array(
                    array( 'mail'  => 'jesus.garciav@me.com', 'name'  => 'Jesús' )
                );
                */

                $parameters[ 'first_name' ] = array(
                    'requerido' => 1,
                    'validador' => 'esAlfaNumerico',
                    'mensaje'   => utf8_encode( 'La primera pregunta es obligatoria.' )
                );
                $parameters[ 'last_name' ]  = array(
                    'requerido' => 1,
                    'validador' => 'esAlfaNumerico',
                    'mensaje'   => utf8_encode( 'La segunda pregunta es obligatoria.' )
                );
                $parameters[ 'email' ]      = array(
                    'requerido' => 1,
                    'validador' => 'esEmail',
                    'mensaje'   => utf8_encode( 'La tercera pregunta es obligatoria.' )
                );
                $parameters[ 'city' ]       = array(
                    'requerido' => 1,
                    'validador' => 'esEmail',
                    'mensaje'   => utf8_encode( 'La cuarta pregunta es obligatoria.' )
                );
                $parameters[ 'message' ]    = array(
                    'requerido' => 1,
                    'validador' => 'esEmail',
                    'mensaje'   => utf8_encode( 'La quinta pregunta es obligatoria.' )
                );
                $parameters[ 'message' ]    = array(
                    'requerido' => 1,
                    'validador' => 'esAlfaNumerico',
                    'mensaje'   => utf8_encode( 'La quinta pregunta es obligatoria.' )
                );
                $contact   = new Contact( $dbh, 'B0j4n1n1_C0n74c7_F0rm' );
                $contact->setInfo( $data );
                $contact->setTemplate( "email.tpl" );
                $contact->setSubject( "Hay un nuevo mensaje del sitio tu Foto con el Güero" );
                $contact->setCorreo( "contactos@tufotoconelguero.com" );
                $contact->setCC( $cc );

                $formValidated  = $contact->validateInfo( $parameters );
                echo $formValidated;
                //$contact        = $contact->insertInit( $formValidated );
                //$data           = json_encode ( $contact );
                break;
            default:
                $data = json_encode ( [ 'response' => 'error', 'message' => 'Hay un error en la peticion.' ] );
                break;
        }
        echo $data;
    }
    catch ( Exception $e )
    {
        switch ( $e->getCode() )
        {
            case 5910 :
                echo 'DATA BASE ERROR: '.$e->getMessage();
                $message = 'Lo sentimos, ocurrió un error inesperado al tratar de guardar los datos.';
                break;
            case 5810 :
                echo 'MAILER ERROR: '. $e->getMessage();
                $message = 'Lo sentimos, ocurrió un error inesperado al tratar de enviar el correo.';
                break;
            default : $message = $e->getMessage();
        }
        $data = [ 'response' => false , 'message' => $message ] ;
        echo json_encode( $data );
    }
}