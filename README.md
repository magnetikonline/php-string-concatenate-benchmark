# PHP string concatenation benchmarks
A quick and dirty (and possibly incorrect - pull requests appreciated!) test to see what is faster/leaner when joining strings in PHP:
- `method01.php`: create an empty string and simply keep adding strings onto it.
- `method02.php`: create an empty array, keep appending strings then `implode()` at the end.

Strings added are random sequences of ASCII `A-Z` characters to hopefully defeat any skewing introduced by PHP's (very excellent) implementation of [string interning](http://en.wikipedia.org/wiki/String_interning).

## Tests
Running on an `Intel(R) Core(TM) i5-2500 CPU @ 3.30GHz` - (of course cores doesn't matter here, PHP is single threaded).

### `method01.php`
```sh
$ time php -d memory_limit=512M method01.php
Memory use: 21000280 bytes

real    0m6.798s
user    0m6.764s
sys     0m0.028s
```

### `method02.php`
```sh
$ time php -d memory_limit=512M method02.php
Memory use: 21000304 bytes

real    0m7.093s
user    0m6.956s
sys     0m0.096s
```

## Conclusion
What does this all mean? Honestly very little:
- PHP string concatenation is implemented fast, *very* fast.
- Yes, `method01.php` proves to be faster and with a *tiny* memory saving, but running `1000000`(!) passes to produce any real amount of difference this isn't something you would ever do in the lifecycle of a real world PHP web request anyway.
- Don't bother with creating arrays and using `implode()` at the conclusion for the sole aim of improving speed. Obviously if concatenation logic can be better written using an array (e.g. backtracking/modifying string hunks as you move along) then do so.
- Concat a string or use arrays, it don't matter - worry about more important things.
- Anyway, you're probably getting confused with early .NET framework versions, it's rubbish memory allocation and the need for a <a href="http://msdn.microsoft.com/en-us/library/aa302329.aspx#vbnstrcatn_stringbuilder">`StringBuilder()`</a> class.

Fin.
