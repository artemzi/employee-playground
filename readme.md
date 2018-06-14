## set up
1. clone project
2. add **.env** and **.env.testing** files
(you will find required variables in `docker-compose.yaml` file)
3. install composer dependencies
4. install yarn dependencies, build assets
5. if you want to use docker-compose and included docker images just run <br />
$ ```make docker-up```
6. run migrations
7. restore db from backup $ `make db-restore` or run seeder

## Implemented features

* User registration / authentication (default)
    - available command for creating user from console <br />
    $ `php artisan user:add demo demo@example.com secret`
* Tree view
    - Guest / User can visit
    - Guest cannot use drag-n-drop
    - User can edit parent / child relation with drag-n-drop
    - Tree received with lazy load, by default first level is opened.
* Table view
    - Only authenticated user can visit
    - Table built with datatables [*server-side processing*](https://datatables.net/manual/server-side)
    - included sorting / searching by each field with ajax
    (TODO: there is no search option for user avatar)
    - User can use **Add employee** button for creating new employee.
        - In employee create page user can select title (position) or
        add new one. (TODO: fix redirect path after creating new title)
        - Hire date must be set in format presented by default
        (TODO: make it user-friendly, datepicker?)
        - Parent can be specified from dropdown with search action
    - User can view employee details by click on his name.
    - On details page there is **Delete** button
        - Delete show alert on hover for remainder. Delete action
        removes full node with all children. It can be replaced with
        reassigning children to other parent or just reject deleting
        node where children presented. For now it works as was expected.
    - Details -> Edit action allow edit user details and upload image.
    - After image uploading it appears on details and generated thumbnail
    in table view.
    - Edit allows change parent with full children list or reassign children
    for new parent.
    - etc.
* Database
    - database kept as simple as possible
    - **Nested Sets** model was used
        - fast select
        - build tree without recursion
        - slow insert and update
    - Migrations generated from Mysql Workbench with [Laravel plugin](https://github.com/beckenrode/mysql-workbench-export-laravel-5-migrations)
    - Factory / seeder included (`db:seed` set for 55556 employees,
    work ~1-2 hours, depends on machine power. It must build tree relations.)
    - Database dump file (`backup.sql`) is presented for fast seeding.
    Database contains > 55000 employees and *demo* user.
    - Mysql Workbench model file (`schema.mwb`) included.
    Generated from version of workbench 6.3.6

## TODOs
    * add more tests
    ...