
## About this project

After cloning this project you will need to run this command:

         php artisan migrate:fresh --seed

then run the following command to start the service:

        php artisan serve




Api routes:

- without authentication:
  - POST auth/login (parameters: email, password) will create a token for the authentication used in the apis
  - GET api/users will return all the users in the database
  - GET api/users/{user} will return the user with that id
  - POST api/users will create a user and return his api token
  - PUT api/users/{user} will update the selected user
- with authentication:
  - Customers:
    - GET api/customers will return all the customers in the database
    - GET api/customers/{customer} will return the customer with that id
    - POST api/customers will create a customer
    - PUT api/customers/{customer} will update the selected customer
  - Projects:
    - GET api/projects will return all the projects in the database
    - GET api/projects/{project} will return the project with that id
    - POST api/projects will create a project
    - PUT api/projects/{project} will update the selected project
  - Tasks:
    - GET api/tasks will return all the tasks in the database
    - GET api/tasks/{task} will return the task with that id
    - POST api/tasks will create a task
    - PUT api/tasks/{task} will update the selected task
    - PUT api/tasks/assign/{task} will check if the user assigned is a developer and will send an email to notify the assignment
    - PUT api/tasks/update/state/{task} will update the state of the task and if the task is done will send an email to the project manager assigned to the project
