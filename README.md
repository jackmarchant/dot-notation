# Dot Notation

Implementation of dot notation syntax for accessing an array.

An example:
```
$array = ['hello' => ['world' => 'find me']];
DotNotation::get($array, 'hello.world'); // 'find me'
```

