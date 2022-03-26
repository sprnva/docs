## Example Usage
```php
# in config.php you can add the ff:

$config = [

	// DATABASE
	'driver'	=> 'mysql',
	'host'		=> 'localhost',
	'database'	=> 'test',
	'username'	=> 'root',
	'password'	=> '',
	'charset'	=> 'utf8',
	'collation'	=> 'utf8_general_ci',
	'prefix'	 => ''


	// ...
];

$records = database()->table('users')
    ->select('id, name, surname, age')
    ->where('age', '>', 18)
    ->orderBy('id', 'desc')
    ->limit(20)
    ->getAll();

dd($records);
```
* * *

## Detailed Usage and Methods

## config
```php
$config = [
	# Database Driver Type (optional)
	# default value: mysql
	# values: mysql, pgsql, sqlite, oracle
	'driver'    => 'mysql',

	# Host name or IP Address (optional)
	# hostname:port (for Port Usage. Example: 127.0.0.1:1010)
	# default value: localhost
	'host'      => 'localhost',

	# IP Address for Database Host (optional)
	# default value: null
	'port'      => 3306,

	# Database Name (required)
	'database'  => 'test',

	# Database User Name (required)
	'username'  => 'root',

	# Database User Password (required)
	'password'  => '',

	# Database Charset (optional)
	# default value: utf8
	'charset'   => 'utf8',

	# Database Charset Collation (optional)
	# default value: utf8_general_ci
	'collation' => 'utf8_general_ci',

	# Database Prefix (optional)
	# default value: null
	'prefix'     => '',

	# Cache Directory of the Sql Result (optional)
	# default value: __DIR__ . '/cache/'
	'cachedir'	=> __DIR__ . '/cache/sql/',
];
```

## Contents

 * [select](#select)
 * [select functions (min, max, sum, avg, count)](#select-functions-min-max-sum-avg-count)
 * [table](#table)
 * [get AND getAll](#get-and-getall)
 * [join](#join)
 * [where](#where)
 * [grouped](#grouped)
 * [in](#in)
 * [findInSet](#findinset)
 * [between](#between)
 * [like](#like)
 * [groupBy](#groupby)
 * [having](#having)
 * [orderBy](#orderby)
 * [limit - offset](#limit---offset)
 * [pagination](#pagination)
 * [insert](#insert)
 * [update](#update)
 * [delete](#delete)
 * [analyze](#analyze) - [check](#check) - [checksum](#checksum) - [optimize](#optimize) - [repair](#repair)
 * [query](#query)
 * [insertId](#insertid)
 * [numRows](#numrows)
 * [cache](#cache)
 * [transaction](#transaction) - [commit](#transaction) - [rollBack](#transaction)
 * [error](#error)
 * [queryCount](#querycount)
 * [getQuery](#getquery)

## Methods

<a name='select' style='padding-top: 30px;'>&nbsp;</a>
### select

```php
# Usage 1: string parameter
database()->select('title, content')->table('test')->getAll();
# Output: "SELECT title, content FROM test"

database()->select('title AS t, content AS c')->table('test')->getAll();
# Output: "SELECT title AS t, content AS c FROM test"
```
```php
# Usage2: array parameter
database()->select(['title', 'content'])->table('test')->getAll();
# Output: "SELECT title, content FROM test"

database()->select(['title AS t', 'content AS c'])->table('test')->getAll();
# Output: "SELECT title AS t, content AS c FROM test"
```

<a name='select-functions-min-max-sum-avg-count' style='padding-top: 30px;'>&nbsp;</a>
### select functions (min, max, sum, avg, count)

```php
# Usage 1:
database()->table('test')->max('price')->get();
# Output: "SELECT MAX(price) FROM test"

# Usage 2:
database()->table('test')->count('id', 'total_row')->get();
# Output: "SELECT COUNT(id) AS total_row FROM test"
```

<a name='table' style='padding-top: 30px;'>&nbsp;</a>
### table

```php
### Usage 1: string parameter
database()->table('table');
# Output: "SELECT * FROM table"

database()->table('table1, table2');
# Output: "SELECT * FROM table1, table2"

database()->table('table1 AS t1, table2 AS t2');
# Output: "SELECT * FROM table1 AS t1, table2 AS t2"
```
```php
### Usage 2: array parameter
database()->table(['table1', 'table2']);
# Output: "SELECT * FROM table1, table2"

database()->table(['table1 AS t1', 'table2 AS t2']);
# Output: "SELECT * FROM table1 AS t1, table2 AS t2"
```

<a name='get-and-getall' style='padding-top: 30px;'>&nbsp;</a>
### get AND getAll

```php
# get(): return 1 record.
# getAll(): return multiple records.

database()->table('test')->getAll();
# Output: "SELECT * FROM test"

database()->select('username')->table('users')->where('status', 1)->getAll();
# Output: "SELECT username FROM users WHERE status='1'"

database()->select('title')->table('pages')->where('id', 17)->get();
# Output: "SELECT title FROM pages WHERE id='17' LIMIT 1"
```

<a name='join' style='padding-top: 30px;'>&nbsp;</a>
### join

```php
database()->table('test as t')->join('foo as f', 't.id', 'f.t_id')->where('t.status', 1)->getAll();
# Output: "SELECT * FROM test as t JOIN foo as f ON t.id=f.t_id WHERE t.status='1'"
```
You can use this method in 7 ways. These;
- join
- left_join
- right_join
- inner_join
- full_outer_join
- left_outer_join
- right_outer_join

Examples:
```php
database()->table('test as t')->leftJoin('foo as f', 't.id', 'f.t_id')->getAll();
# Output: "SELECT * FROM test as t LEFT JOIN foo as f ON t.id=f.t_id"
```

```php
database()->table('test as t')->fullOuterJoin('foo as f', 't.id', 'f.t_id')->getAll();
# Output: "SELECT * FROM test as t FULL OUTER JOIN foo as f ON t.id=f.t_id"
```

<a name='where' style='padding-top: 30px;'>&nbsp;</a>
### where

```php
$where = [
	'name' => 'Burak',
	'age' => 23,
	'status' => 1
];
database()->table('test')->where($where)->get();
# Output: "SELECT * FROM test WHERE name='Burak' AND age='23' AND status='1' LIMIT 1"

# OR

database()->table('test')->where('active', 1)->getAll();
# Output: "SELECT * FROM test WHERE active='1'"

# OR

database()->table('test')->where('age', '>=', 18)->getAll();
# Output: "SELECT * FROM test WHERE age>='18'"

# OR

database()->table('test')->where('age = ? OR age = ?', [18, 20])->getAll();
# Output: "SELECT * FROM test WHERE age='18' OR age='20'"
```

You can use this method in 4 ways. These;

- where
- orWhere
- notWhere
- orNotWhere
- whereNull
- whereNotNull

Example:
```php
database()->table('test')->where('active', 1)->notWhere('auth', 1)->getAll();
# Output: "SELECT * FROM test WHERE active = '1' AND NOT auth = '1'"

# OR

database()->table('test')->where('age', 20)->orWhere('age', '>', 25)->getAll();
# Output: "SELECT * FROM test WHERE age = '20' OR age > '25'"

database()->table('test')->whereNotNull('email')->getAll();
# Output: "SELECT * FROM test WHERE email IS NOT NULL"
```

<a name='grouped' style='padding-top: 30px;'>&nbsp;</a>
### grouped

```php
database()->table('users')
	->grouped(function($q) {
		$q->where('country', 'TURKEY')->orWhere('country', 'ENGLAND');
	})
	->where('status', 1)
	->getAll();
# Ouput: "SELECT * FROM users WHERE (country='TURKEY' OR country='ENGLAND') AND status ='1'"
```

<a name='in' style='padding-top: 30px;'>&nbsp;</a>
### in

```php
database()->table('test')->where('active', 1)->in('id', [1, 2, 3])->getAll();
# Output: "SELECT * FROM test WHERE active = '1' AND id IN ('1', '2', '3')"
```

You can use this method in 4 ways. These;

- in
- orIn
- notIn
- orNotIn

Example:
```php
database()->table('test')->where('active', 1)->notIn('id', [1, 2, 3])->getAll();
# Output: "SELECT * FROM test WHERE active = '1' AND id NOT IN ('1', '2', '3')"

# OR

database()->table('test')->where('active', 1)->orIn('id', [1, 2, 3])->getAll();
# Output: "SELECT * FROM test WHERE active = '1' OR id IN ('1', '2', '3')"
```

<a name='findinset' style='padding-top: 30px;'>&nbsp;</a>
### findInSet

```php
database()->table('test')->where('active', 1)->findInSet('selected_ids', 1)->getAll();
# Output: "SELECT * FROM test WHERE active = '1' AND FIND_IN_SET (1, selected_ids)"
```

You can use this method in 4 ways. These;

- findInSet
- orFindInSet
- notFindInSet
- orNotFindInSet

Example:
```php
database()->table('test')->where('active', 1)->notFindInSet('selected_ids', 1)->getAll();
# Output: "SELECT * FROM test WHERE active = '1' AND NOT FIND_IN_SET (1, selected_ids)"

# OR

database()->table('test')->where('active', 1)->orFindInSet('selected_ids', 1)->getAll();
# Output: "SELECT * FROM test WHERE active = '1' OR FIND_IN_SET (1, selected_ids)"
```

<a name='between' style='padding-top: 30px;'>&nbsp;</a>
### between

```php
database()->table('test')->where('active', 1)->between('age', 18, 25)->getAll();
# Output: "SELECT * FROM test WHERE active = '1' AND age BETWEEN '18' AND '25'"
```

You can use this method in 4 ways. These;

- between
- orBetween
- notBetween
- orNotBetween

Example:
```php
database()->table('test')->where('active', 1)->notBetween('age', 18, 25)->getAll();
# Output: "SELECT * FROM test WHERE active = '1' AND age NOT BETWEEN '18' AND '25'"

# OR

database()->table('test')->where('active', 1)->orBetween('age', 18, 25)->getAll();
# Output: "SELECT * FROM test WHERE active = '1' OR age BETWEEN '18' AND '25'"
```

<a name='like' style='padding-top: 30px;'>&nbsp;</a>
### like

```php
database()->table('test')->like('title', "%php%")->getAll();
# Output: "SELECT * FROM test WHERE title LIKE '%php%'"
```

You can use this method in 4 ways. These;

- like
- orLike
- notLike
- orNotLike

Example:
```php
database()->table('test')->where('active', 1)->notLike('tags', '%dot-net%')->getAll();
# Output: "SELECT * FROM test WHERE active = '1' AND tags NOT LIKE '%dot-net%'"

# OR

database()->table('test')->like('bio', '%php%')->orLike('bio', '%java%')->getAll();
# Output: "SELECT * FROM test WHERE bio LIKE '%php%' OR bio LIKE '%java%'"
```

<a name='groupby' style='padding-top: 30px;'>&nbsp;</a>
### groupBy

```php
# Usage 1: One parameter
database()->table('test')->where('status', 1)->groupBy('cat_id')->getAll();
# Output: "SELECT * FROM test WHERE status = '1' GROUP BY cat_id"
```

```php
# Usage 1: Array parameter
database()->table('test')->where('status', 1)->groupBy(['cat_id', 'user_id'])->getAll();
# Output: "SELECT * FROM test WHERE status = '1' GROUP BY cat_id, user_id"
```

<a name='having' style='padding-top: 30px;'>&nbsp;</a>
### having

```php
database()->table('test')->where('status', 1)->groupBy('city')->having('COUNT(person)', 100)->getAll();
# Output: "SELECT * FROM test WHERE status='1' GROUP BY city HAVING COUNT(person) > '100'"

# OR

database()->table('test')->where('active', 1)->groupBy('department_id')->having('AVG(salary)', '<=', 500)->getAll();
# Output: "SELECT * FROM test WHERE active='1' GROUP BY department_id HAVING AVG(salary) <= '500'"

# OR

database()->table('test')->where('active', 1)->groupBy('department_id')->having('AVG(salary) > ? AND MAX(salary) < ?', [250, 1000])->getAll();
# Output: "SELECT * FROM test WHERE active='1' GROUP BY department_id HAVING AVG(salary) > '250' AND MAX(salary) < '1000'"
```

<a name='orderby' style='padding-top: 30px;'>&nbsp;</a>
### orderBy

```php
# Usage 1: One parameter
database()->table('test')->where('status', 1)->orderBy('id')->getAll();
# Output: "SELECT * FROM test WHERE status='1' ORDER BY id ASC"

### OR

database()->table('test')->where('status', 1)->orderBy('id desc')->getAll();
# Output: "SELECT * FROM test WHERE status='1' ORDER BY id desc"
```

```php
# Usage 1: Two parameters
database()->table('test')->where('status', 1)->orderBy('id', 'desc')->getAll();
# Output: "SELECT * FROM test WHERE status='1' ORDER BY id DESC"
```

```php
# Usage 3: Rand()
database()->table('test')->where('status', 1)->orderBy('rand()')->limit(10)->getAll();
# Output: "SELECT * FROM test WHERE status='1' ORDER BY rand() LIMIT 10"
```

<a name='limit---offset' style='padding-top: 30px;'>&nbsp;</a>
### limit - offset

```php
# Usage 1: One parameter
database()->table('test')->limit(10)->getAll();
# Output: "SELECT * FROM test LIMIT 10"
```
```php
# Usage 2: Two parameters
database()->table('test')->limit(10, 20)->getAll();
# Output: "SELECT * FROM test LIMIT 10, 20"

# Usage 3: with offset method
database()->table('test')->limit(10)->offset(10)->getAll();
# Output: "SELECT * FROM test LIMIT 10 OFFSET 10"
```

<a name='pagination' style='padding-top: 30px;'>&nbsp;</a>
### pagination

```php
# First parameter: Data count of per page
# Second parameter: Active page

database()->table('test')->pagination(15, 1)->getAll();
# Output: "SELECT * FROM test LIMIT 15 OFFSET 0"

database()->table('test')->pagination(15, 2)->getAll();
# Output: "SELECT * FROM test LIMIT 15 OFFSET 15"
```

<a name='insert' style='padding-top: 30px;'>&nbsp;</a>
### insert

```php
$data = [
	'title' => 'test',
	'content' => 'Lorem ipsum dolor sit amet...',
	'time' => '2017-05-19 19:05:00',
	'status' => 1
];

database()->table('pages')->insert($data);
# Output: "INSERT INTO test (title, content, time, status) VALUES ('test', 'Lorem ipsum dolor sit amet...', '2017-05-19 19:05:00', '1')"
```

<a name='update' style='padding-top: 30px;'>&nbsp;</a>
### update

```php
$data = [
	'username' => 'izniburak',
	'password' => 'pass',
	'activation' => 1,
	'status' => 1
];

database()->table('users')->where('id', 10)->update($data);
# Output: "UPDATE users SET username='izniburak', password='pass', activation='1', status='1' WHERE id='10'"
```

<a name='delete' style='padding-top: 30px;'>&nbsp;</a>
### delete

```php
database()->table('test')->where("id", 17)->delete();
# Output: "DELETE FROM test WHERE id = '17'"

# OR

database()->table('test')->delete();
# Output: "TRUNCATE TABLE delete"
```

<a name='transaction' style='padding-top: 30px;'>&nbsp;</a>
### transaction

```php
database()->transaction();

$data = [
	'title' => 'new title',
	'status' => 2
];
database()->table('test')->where('id', 10)->update($data);

database()->commit();
# OR
database()->rollBack();
```

<a name='analyze' style='padding-top: 30px;'>&nbsp;</a>
### analyze

```php
database()->table('users')->analyze();
# Output: "ANALYZE TABLE users"
```

<a name='check' style='padding-top: 30px;'>&nbsp;</a>
### check

```php
database()->table(['users', 'pages'])->check();
# Output: "CHECK TABLE users, pages"
```

<a name='checksum' style='padding-top: 30px;'>&nbsp;</a>
### checksum

```php
database()->table(['users', 'pages'])->checksum();
# Output: "CHECKSUM TABLE users, pages"
```

<a name='optimize' style='padding-top: 30px;'>&nbsp;</a>
### optimize

```php
database()->table(['users', 'pages'])->optimize();
# Output: "OPTIMIZE TABLE users, pages"
```

<a name='repair' style='padding-top: 30px;'>&nbsp;</a>
### repair

```php
database()->table(['users', 'pages'])->repair();
# Output: "REPAIR TABLE users, pages"
```

<a name='query' style='padding-top: 30px;'>&nbsp;</a>
### query

```php
# Usage 1: Select all records
database()->query('SELECT * FROM test WHERE id=? AND status=?', [10, 1])->fetchAll();

# Usage 2: Select one record
database()->query('SELECT * FROM test WHERE id=? AND status=?', [10, 1])->fetch();

# Usage 3: Other queries like Update, Insert, Delete etc...
database()->query('DELETE FROM test WHERE id=?', [10])->exec();
```

<a name='insertid' style='padding-top: 30px;'>&nbsp;</a>
### insertId

```php
$data = [
	'title' => 'test',
	'content' => 'Lorem ipsum dolor sit amet...',
	'time' => time(),
	'status' => 1
];
database()->table('pages')->insert($data);

var_dump(database()->insertId());
```

<a name='numrows' style='padding-top: 30px;'>&nbsp;</a>
### numRows

```php
database()->select('id, title')->table('test')->where('status', 1)->orWhere('status', 2)->getAll();

var_dump(database()->numRows());
```

<a name='error' style='padding-top: 30px;'>&nbsp;</a>
### error

```php
database()->error();
```

<a name='cache' style='padding-top: 30px;'>&nbsp;</a>
### cache

```php
# Usage: ...->cache($time)->...
database()->table('pages')->where('slug', 'example-page')->cache(60)->get();
# cache time: 60 seconds
```

<a name='querycount' style='padding-top: 30px;'>&nbsp;</a>
### queryCount

```php
database()->queryCount();
# The number of all SQL queries on the page until the end of the beginning.
```

<a name='getquery' style='padding-top: 30px;'>&nbsp;</a>
### getQuery

```php
database()->getQuery();
# Last SQL Query.
```