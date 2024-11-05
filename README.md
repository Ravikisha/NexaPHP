![NexaPHP](https://ravikisha.github.io/assets/nexaphp.png)
# NexaPHP


<p float="left">
    <img src="https://img.shields.io/badge/PHP-7.4%2B-blue" alt="PHP Version">
    <img src="https://img.shields.io/badge/Version-1.0.0-green" alt="Version">
    <img src="https://img.shields.io/badge/License-MIT-yellow" alt="License">
    <img src="https://img.shields.io/badge/Status-Development-red" alt="Status">
</p>

**NexaPHP** is a PHP MVC framework designed to provide a lightweight and flexible structure for building web applications. This document provides a detailed guide to understanding and utilizing the framework.

## Table of Contents
- [NexaPHP](#nexaphp)
  - [Table of Contents](#table-of-contents)
    - [1. Installation](#1-installation)
    - [2. Setup](#2-setup)
    - [3. Core Components](#3-core-components)
    - [4. Controllers](#4-controllers)
    - [5. Routing](#5-routing)
    - [6. Database Integration](#6-database-integration)
    - [7. Middleware](#7-middleware)
    - [8. Views](#8-views)
    - [9. Forms and Fields](#9-forms-and-fields)
    - [10. Session Management](#10-session-management)
    - [11. Exception Handling](#11-exception-handling)
    - [12. User Authentication](#12-user-authentication)
    - [13. Events](#13-events)
    - [14. Sample Application](#14-sample-application)
  - [License](#license)
  - [Open Source](#open-source)

---

### 1. Installation

Install NexaPHP via Composer:

```bash
composer require ravikisha/nexaphp
```

---

### 2. Setup

To start, initialize the **Application** class with the root directory and configuration:

```php
use ravikisha\nexaphp\Application;

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=testdb',
        'user' => 'root',
        'password' => 'password'
    ]
];

$app = new Application(__DIR__, $config);
```

- `userClass`: Defines the User model.
- `db`: Database configuration parameters (`dsn`, `user`, `password`).

---

### 3. Core Components

The NexaPHP framework includes several core components:

- **Application**: The main entry point to the application.
- **Router**: Manages route handling.
- **Request**: Handles HTTP requests.
- **Response**: Sends HTTP responses.
- **Database**: Manages database interactions.
- **Session**: Manages session data.

![NexaPHP Architecture](https://ravikisha.github.io/assets/nexaphpdiagram.png)

---

### 4. Controllers

Controllers in NexaPHP define how to handle different routes.

```php
namespace app\controllers;

use ravikisha\nexaphp\Controller;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home');
    }

    public function contact()
    {
        return $this->render('contact');
    }
}
```

- **Controller::render()**: Renders a view.
- **setLayout()**: Sets a custom layout.

---

### 5. Routing

Define routes using `Router::get()` for GET requests and `Router::post()` for POST requests:

```php
$app->router->get('/', [SiteController::class, 'home']);
$app->router->post('/contact', [SiteController::class, 'contact']);
```

NexaPHP supports dynamic route parameters:

```php
$app->router->get('/profile/{id}', [UserController::class, 'profile']);
```

- **Route parameters** can be accessed using `Request::getRouteParams()`.

---

### 6. Database Integration

NexaPHP integrates with PDO for database management.

1. **Define a Model**:

    ```php
    namespace app\models;

    use ravikisha\nexaphp\db\DBModel;

    class User extends DBModel
    {
        public string $id;
        public string $name;

        public static function tableName(): string
        {
            return 'users';
        }

        public function attributes(): array
        {
            return ['id', 'name'];
        }
    }
    ```

2. **Migrations**: Run migrations to manage the database structure.

    ```php
    $app->db->applyMigrations();
    ```

3. **Querying**:
   - **save()**: Save a model instance.
   - **findOne()**: Retrieve a record by criteria.

---

### 7. Middleware

Middleware allows filtering and controlling request handling.

1. **Create Middleware**:

    ```php
    namespace app\middlewares;

    use ravikisha\nexaphp\middlewares\BaseMiddleware;

    class AuthMiddleware extends BaseMiddleware
    {
        public function execute()
        {
            // Logic for authentication
        }
    }
    ```

2. **Apply Middleware**:

    ```php
    $this->registerMiddleware(new AuthMiddleware(['profile', 'settings']));
    ```

---

### 8. Views

Views define how content is rendered. The **View** class handles view rendering.

```php
// Render a view file located in views directory
return $this->render('viewName', ['param' => $value]);
```

1. **Layouts**:
   - Define layout files under `views/layouts`.
   - Use `{{content}}` to insert view content.

2. **Passing Parameters**:

   ```php
   return $this->render('profile', ['name' => 'John Doe']);
   ```

---

### 9. Forms and Fields

Forms and fields are handled through classes in `ravikisha\nexaphp\form`.

1. **Form**:

    ```php
    use ravikisha\nexaphp\form\Form;

    $form = Form::begin('/submit', 'post');
    echo $form->field($model, 'username');
    Form::end();
    ```

2. **Field Types**:

    ```php
    echo (new Field($model, 'password'))->passwordField();
    ```

    Supported types: `password`, `email`, `number`, `date`, `file`, etc.

---

### 10. Session Management

The **Session** class provides functions for handling sessions.

- **setFlash()**: Set flash messages.
- **getFlash()**: Retrieve flash messages.
- **set()** and **get()**: Manage session data.

Example:

```php
Application::$app->session->setFlash('success', 'Logged in successfully');
```

---

### 11. Exception Handling

The framework includes custom exceptions:
- **NotFoundException**: Triggered for invalid routes.
- **ForbiddenException**: Used for access control.

---

### 12. User Authentication

**UserModel** is an abstract class that provides basic functionality for user management.

```php
class User extends UserModel
{
    public static function primaryKey(): string
    {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return $this->username;
    }
}
```

- **login()**: Log in a user.
- **logout()**: Log out a user.
- **isGuest()**: Check if a user is logged in.

---

### 13. Events

The **Application** class supports custom events.

1. **Define an Event**:

    ```php
    Application::$app->on(Application::EVENT_BEFORE_REQUEST, function () {
        // Before request logic
    });
    ```

2. **Trigger Events**:

    Use `triggerEvent()` to initiate custom behavior at various points in the application.

---

### 14. Sample Application

Below is an example of setting up a simple application using NexaPHP:

```php
// Load NexaPHP classes
require_once __DIR__ . '/vendor/autoload.php';

use ravikisha\nexaphp\Application;
use app\controllers\SiteController;

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=testdb',
        'user' => 'root',
        'password' => 'password'
    ]
];

// Initialize the application
$app = new Application(__DIR__, $config);

// Define routes
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);

// Run the application
$app->run();
```

---

> This Project in for the purpose of learning and understanding the MVC architecture and how it works. It is not intended to be used in production environments. For production, it is recommended to use a well-established framework like Laravel, Symfony, or Yii.

---

## License
This Project is licensed under the [MIT License](LICENSE).

## Open Source
This Project is open source and contributions are welcome. Feel free to fork and submit a pull request. For major changes, please open an issue first to discuss what you would like to change.