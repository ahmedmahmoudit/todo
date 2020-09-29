# ToDo App

Todo application by Laravel & Vue 

### Features & Technologies
- Laravel v8
- Vue.js v2
- Vuex
- Bootstrap
- Docker
- Authorization with passport
- Laravel unit tests
- Vue unit tests
- Cypress


![Laravel unit](https://github.com/ahmedmahmoudit/todo/blob/master/laravel-unit.png?raw=true)

![Vue unit](https://github.com/ahmedmahmoudit/todo/blob/master/vue-unit.png?raw=true)

![Vue unit](https://github.com/ahmedmahmoudit/todo/blob/master/cypress.gif?raw=true)


### Installation

 - Clone this repo.

```sh
git clone https://github.com/ahmedmahmoudit/todo.git
```

 - docker up.

```sh
docker-compose up
```
  - setup laravel 

```sh
docker-compose exec php composer update
```  
  - migrate DB then setup passport
  
```sh
docker-compose exec php php artisan passport:install
```  

- Finally npm run dev


Open [http://localhost:8080/](http://localhost:8080) to start your application.

