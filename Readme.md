# :ambulance: Clinic CRM

Clinic CRM - system for convenient and quick control of the work of clinics, their employees, and the keeping reporting

## Installation

1) Install all project dependencies through composer

```bash
php composer.phar --ignore-platform-reqs install
```

2) Create a local copy of the .env.dist file. Local copy name must be __.env.local__ or __.env__

3) Set __.env__ (or __.env.local__) variables:

Name | Description
-----|-----
APP_ENV | current environment __(dev or prod)__
DEV_DATABASE_NAME | database name used for __development__
DEV_DATABASE_URL | database URL used for __development__
DATABASE_URL | database URL used for __production__
ADMIN_USERNAME | Admin username __(default: *admin*)__
ADMIN_EMAIL | Admin email __(default: *admin@example.com*)__
ADMIN_PASSWORD | Admin password __(default: *123*)__
ADMIN_SURNAME | Admin surname __(default: *Admin*)__
ADMIN_NAME | Admin name __(default: *Admin*)__
ADMIN_PATRONYMIC | Admin patronymic __(default: *Admin*)__

4)
    - __For development__
        - Fill dev database with the following command
        ```bash
        php bin\console base:fill-dev-database
        ```

    - __For production__
        1) Create a database
        ```bash
        php bin\console d:d:c
        ```

        2) Run migrations
        ```bash
        php bin\console d:m:m
        ```

        3) Create a default admin user with the following command:
        ```bash
        php bin\console base:create-admin-user
        ```