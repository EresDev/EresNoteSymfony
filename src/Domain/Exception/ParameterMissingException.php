<?php

namespace App\Domain\Exception;

final class ParameterMissingException extends HttpException
{
    public static function from(array $parameters, string $missingField) : self
    {
        if(isset($parameters['creationDatetime'])){
            $parameters['creationDatetime'] = $parameters['creationDatetime']->format(
                \DateTimeInterface::W3C
            );
        }

        if(isset($parameters['user'])){
            $parameters['user'] = $parameters['user']->getId();
        }


        return new self(
            422,
            sprintf(
                'Request was missing a required parameter "%s".\n ' .
                'Provided parameters are: %s',
                $missingField,
                http_build_query($parameters)
            )
            );
    }

    public function getMessageForEndUser(): string
    {
        return 'exception.text.unable.to.process.your.request.due.to.invalid.submission';
    }
}
