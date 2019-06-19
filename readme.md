# hqCRUD

[![Build Status](https://travis-ci.org/EresDev/hqCRUD.svg?branch=master)](https://travis-ci.org/EresDev/hqCRUD)

This is a backend for a note taking application. The idea of its existence is to provide high quality CRUD code based on Symfony that can be reused for other applications easily. 

The internal quality of code is based on the idea of using test driven development with unit tests, integration tests and functional tests. This project is refactored continuously to test and implement new and awesome ideas. 

The development approaches includes usage of design patterns, continuous integration and continuous deployment. 

Feel free to fork, try things out, and recommend your ideas.  


## How to install
- Clone the repository
`git clone https://github.com/EresDev/hqCRUD.git `

- Rename `.env.dist` to  `.env` and update the details inside the file.
- Use composer to install
`composer install `
- To run all tests (Unit+Integration+Functional) run the following command
`php bin/phpunit `
