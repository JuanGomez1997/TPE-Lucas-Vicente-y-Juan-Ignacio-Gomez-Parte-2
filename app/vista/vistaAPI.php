<?php
    class VistaApi {
        public function respuesta($dato, $estado = 200) {
            header('Content-type: application/json');
            header('HTTP/1.1 '.$estado." ".$this->_requestStatus($estado));
            echo json_encode($dato);
        }

        private function _requestStatus($code) {
            $estado = array(
                200 => "OK",
                201 => "Created",
                400 => "Bad request",
                404 => "Not found"
                
            );
            return (isset($estado[$code])) ? $estado[$code] : $estado[500];
        }

    }
