# CodeIgniter Base Model
This is a CodeIgniter base model that provides a set of useful features to handle database operations.

### Features
- CRUD operations
- Soft deletes
- Automatic timestamps
- Eager loading of relationships
- Scopes
- Query caching

### Requirements
 CodeIgniter 3.x or 4.x

### Installation
1. Download the MY_Model.php file.
2. Copy the MY_Model.php file into your CodeIgniter application's application/core directory.
3. Extend your model classes from MY_Model instead of CodeIgniter's CI_Model.

### Usage
#### Loading the model
```php
$this->load->model('User_model');
```
#### Retrieving records
```php
$this->user_model->get(1);
$this->user_model->get_by('email', 'john@example.com');
$this->user_model->get_many([1, 2, 3]);
$this->user_model->get_all();
```
#### Creating records
```php
$data = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
];
$this->user_model->insert($data);
```
#### Updating records
```php
$data = [
    'name' => 'Jane Doe',
    'email' => 'jane@example.com',
];

$this->user_model->update(1, $data);
```
#### Deleting records
```php
$this->user_model->delete(1);
```
#### Soft deletes
```php
$this->user_model->soft_delete(1);
$this->user_model->with_deleted()->get(1);
$this->user_model->only_deleted()->get_all();
```
#### Automatic timestamps
```php
$data = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
];

$this->user_model->insert($data);

echo $this->user_model->created_at;
echo $this->user_model->updated_at;
```

#### Eager loading of relationships
```php
class User_model extends MY_Model
{
    public $has_many = [
        'posts' => [
            'model' => 'Post_model',
            'primary_key' => 'id',
            'foreign_key' => 'user_id',
        ],
    ];
}

$user = $this->user_model->with('posts')->get(1);
echo $user->posts[0]->title;
```

#### Scopes
```php

class User_model extends MY_Model
{
    public function scope_active()
    {
        $this->db->where('status', 'active');
        return $this;
    }
}

$users = $this->user_model->active()->get_all();
```

#### Query caching
```php

$this->user_model->cache_on();
$this->user_model->get(1);
$this->user_model->cache_off();
```
### License
This project is licensed under the MIT License - see the [LICENSE.md](docs/LICENSE.md) file for details.

Acknowledgments
This base model is heavily inspired by the Laravel Eloquent ORM.
