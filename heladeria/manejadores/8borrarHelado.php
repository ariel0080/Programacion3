<?php

parse_str(file_get_contents('php://input'), $request_params);
Heladeria::removerUsuario($request_params);
Heladeria::guardarHelados();

?>