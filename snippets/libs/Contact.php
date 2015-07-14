<?php

class Contact extends Model
{
    private $_PDOConn   = null;
    private $_info       = '';
    private $_template   = '';
    private $_subject    = '';
    private $_correo     = '';
    private $_cc         = array();

    public function __construct( $conn, $db_table )
    {
        $this->_tableName = $db_table;
        $this->_primaryKey = 'id';
        $this->setMysqlConn( $conn );
        $this->_PDOConn = $conn;
    }

    public function validateInfo ( $parameters = [] ) {
        return new Validator( $this->_info, $parameters );
    }

    public function insertInfo ( $formValidated )
    {
        // Si el formulario no es válido
        if ( !$form->validate() )
        {
            return false;
        }
        else
        {
            try
            {
                $this->_PDOConn->beginTransaction();

                if ( $this->insert( $info ) )
                {
                    $this->sendEmail( $info );
                    $this->_PDOConn->commit();
                    return true;
                }
                else
                {
                    throw new PDOException( 'No fu$eacute; posible insertar el registro.' );
                }
            }
            catch ( PDOException $e )
            {
                $this->_PDOConn->rollBack();
                $response   = array ( 'success'=>'false', 'msg'=>'el servicio de DB no esta disponible' );
            }
        }
        return $response;
    }

    public function sendEmail ( )
    {
        try
        {
            $emails = explode( ',' , $this->_correo );
            $to     = [];

            foreach ( $emails as $email )
            {
                $params = [
                    'mail' => [
                        'requerido' => 1 ,
                        'validador' => 'esEmail',
                        'mensaje' => utf8_encode( 'El correo no es v&aacute;lido.' )
                    ]
                ];

                $destinatario = [
                    'name' => $email,
                    'mail' => $email
                ];

                $form   = new Validator( $destinatario, $params );
                if ( ( $form->validate() ) === false )
                {
                    throw new Exception('El correo ' . $email . ' no es v&aacute;lido.');
                }
                $to[] = $destinatario;
            }

            $tpl    = ParserTemplate::parseTemplate( $template, $this->_info );

            $_cc    = $cc;

            if ( Mailer::sendMail( $this->_subject, $this->_template, $this->_ , '' , $_cc ) )
            {
                $response       = [
                    'success'   => 'true',
                    'message'   => utf8_encode( 'Muchas gracias por contestar esta encuesta.' )
                ];
            }
            else
            {
                $response = [
                    'success'   =>'false',
                    'message'   =>utf8_encode( 'El servicio de correo no esta disponible' )
                ];
            }

        }
        catch( phpmailerException $e )
        {
            $this->_PDOConn->rollBack();
            $response   = array ( 'success'=>'false', 'msg'=>'el servicio de correo no esta disponible' );
        }
    }

    public function setInfo ( $info )
    {
        $this->_info         = $info;
    }

    public function setTemplate ( $template )
    {
        $this->_template     = $template;
    }

    public function setSubject ( $subject )
    {
        $this->_subject      = $subject;
    }

    public function setCorreo ( $correo )
    {
        $this->_correo       = $correo;
    }

    public function setCC ( $cc )
    {
        $this->_cc           = $cc;
    }

    public function getInfo ( )
    {
        return $this->_info;
    }

    public function getTemplate ( )
    {
        return $this->_template;
    }

    public function getSubject ( )
    {
        return $this->_subject;
    }

    public function getCorreo ( )
    {
        return $this->_correo;
    }

    public function getCC ( )
    {
        return $this->_cc;
    }
}
