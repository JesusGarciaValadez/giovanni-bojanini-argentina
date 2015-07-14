<?php
if ( !empty( $action ) )
{
    $data      = array();
    try
    {
        switch ( $action )
        {
            case 'contact':
                $data[ "first_name" ]    = stripslashes ( strip_tags( trim( $_POST[ 'firstName' ] ) ) );
                $data[ "last_name" ]     = stripslashes ( strip_tags( trim( $_POST[ 'lastName' ] ) ) );
                $data[ "email" ]         = stripslashes ( strip_tags( trim( $_POST[ 'email' ] ) ) );
                $data[ "city" ]          = stripslashes ( strip_tags( trim( $_POST[ 'city' ] ) ) );
                $data[ "message" ]       = stripslashes ( strip_tags( trim( $_POST[ 'message' ] ) ) );
                /*
                $cc = array(
                    array( 'mail'  => 'jesus.garciav@me.com', 'name'  => 'Jesús' )
                );
                */
                $cc = [];

                $rules      = [ 'first_name' => [
                                    'requerido' => 1,
                                    'validador' => 'esAlfaNumerico',
                                    'mensaje'   => utf8_encode( 'La primera pregunta es obligatoria.' )
                                ],
                                'last_name' => [
                                    'requerido' => 1,
                                    'validador' => 'esAlfaNumerico',
                                    'mensaje'   => utf8_encode( 'La segunda pregunta es obligatoria.' )
                                ],
                                'email'     => [
                                    'requerido' => 1,
                                    'validador' => 'esEmail',
                                    'mensaje'   => utf8_encode( 'La tercera pregunta es obligatoria.' )
                                ],
                                'city' => [
                                    'requerido' => 1,
                                    'validador' => 'esAlfaNumerico',
                                    'mensaje'   => utf8_encode( 'La cuarta pregunta es obligatoria.' )
                                ],
                                'message' => [
                                    'requerido' => 1,
                                    'validador' => 'esAlfaNumerico',
                                    'mensaje'   => utf8_encode( 'La quinta pregunta es obligatoria.' )
                                ]
                            ];
                $config = Common::getConfig();


                $formValidated  = new Validator( $data, $rules );
                if ( $formValidated->validate() )
                {
                    $data[ "date_answer" ]      = date( "Y-m-d H:i:s" );

                    $contact   = new Contact( $dbh, $config['database']['db_table'] );
                    $contact->setTemplate( "share.tpl" );
                    $contact->setSubject( "Recuperá mas que el pelo" );
                    $contact->setCorreo( $config['inbox']['account'] );
                    $contact->setCC( $cc );

                    $contact->setInfo( $data );
                    $userSaved    = $contact->insertInfo( $formValidated );

                    if ( $userSaved )
                    {
                        $response = $contact->sendEmail( );
                    }
                    else
                    {
                        $response = false;
                    }
                }
                else
                {
                    $message    = $formValidated->getMessage();
                    $contact    = [ 'response' => 'error', 'message' => $message ];
                }
                $data = json_encode( $response );
                break;
            default:
                $data = $response       = array (
                            'success' => 'false',
                            'message' => utf8_encode( 'El servidor no sabe que hacer.' )
                        );
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