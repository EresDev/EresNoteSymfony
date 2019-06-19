# hqCRUD

[![Build Status](https://travis-ci.org/EresDev/hqCRUD.svg?branch=master)](https://travis-ci.org/EresDev/hqCRUD)

This is a backend for a note taking application. The idea of its existence is to provide high quality CRUD code based on Symfony that can be reused for other applications easily. 

The internal quality of code is based on the idea of using test driven development with unit tests, integration tests and functional tests. This project is refactored continuously to test and implement new and awesome ideas. 

The development approaches includes usage of design patterns, continuous integration and continuous deployment. 

Feel free to fork, try things out, and recommend your ideas.  


## How to install
- Clone the repository
`git clone https://github.com/EresDev/hqCRUD.git `

- To override default environment variables based on your machine, create a new .env.local and env.test.local file and add variables in it to override. More info about this can be found here https://symfony.com/doc/4.2/configuration.html#configuring-environment-variables-in-development

- Use composer to install
`composer install `
- To run all tests (Unit+Integration+Functional) run the following command
`php bin/phpunit `
