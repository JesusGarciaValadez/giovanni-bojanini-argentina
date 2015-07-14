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

    public function insertInfo ( )
    {
        try
        {
            $this->_PDOConn->beginTransaction();

            if ( $this->insert( $this->_info ) )
            {
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

            $this->_template    = ParserTemplate::parseTemplate( $this->_template, $this->_info );

            // $subject = '', $body = '', $to = array(), $cc = array(), $bcc = array(), $att = array()
            if ( Mailer::sendMail( $this->_subject, $this->_template, $to, $this->_cc ) )
            {
                return  $response       = array (
                            'success' => 'true',
                            'message' => utf8_encode( 'Muchas gracias por contestar esta encuesta. Nos pondremos en contacto contigo a la brevedad para contarte mas de nuestros beneficios.' )
                        );
            }
            else
            {
                return  $response       = array (
                            'success' => 'false',
                            'message' => utf8_encode( 'Hubo un error al enviar el correo.' )
                        );
            }

        }
        catch( phpmailerException $e )
        {
            $this->_PDOConn->rollBack();
            return false;
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
