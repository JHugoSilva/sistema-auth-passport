<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public const SUCCESS_MESSAGE = 'Solicitação processada com sucesso!';
    public const FAILED_MESSAGE = 'Não é possível processar a solicitação. Por favor, tente novamente!';
    public const EXCEPTION_MESSAGE = 'Ocorreu exceção. Por favor, tente novamente!';
    public const NOT_FOUND_MESSAGE = 'Usuário não localizado!';
    public const USER_LOGGED_OUT = 'Usuário deslogado com sucesso!';

    public const SUCCESS_STATUS = 'success';
    public const ERROR_STATUS = 'error';

    public const CREATED = 201;
    public const SUCCESS = 200;
    public const VALIDATION_ERROR = 422;
    public const VALIDATION_NOT_FOUND = 404;

}
